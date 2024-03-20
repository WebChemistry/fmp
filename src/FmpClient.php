<?php declare(strict_types = 1);

namespace WebChemistry\Fmp;

use DateTimeInterface;
use DateTimeZone;
use InvalidArgumentException;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpClient\Retry\GenericRetryStrategy;
use Symfony\Component\HttpClient\RetryableHttpClient;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Encoder\DecoderInterface;
use Symfony\Component\Serializer\Encoder\JsonDecode;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;
use WebChemistry\Fmp\Exception\EmptyResponseException;
use WebChemistry\Fmp\Exception\NotFoundException;
use WebChemistry\Fmp\Request\RequestArguments;
use WebChemistry\Fmp\Request\RequestSymbolLimit;
use WebChemistry\Fmp\Response\ChildrenResponse;
use WebChemistry\Fmp\Response\ChildResponse;
use WebChemistry\Fmp\Response\MergedObjectsResponse;
use WebChemistry\Fmp\Response\ObjectResponse;
use WebChemistry\Fmp\Response\ObjectsResponse;
use WebChemistry\Fmp\Result\DiscountedCashFlow;
use WebChemistry\Fmp\Result\EarningCallTranscriptRow;
use WebChemistry\Fmp\Result\EndOfDayPrice;
use WebChemistry\Fmp\Result\FmpResult;
use WebChemistry\Fmp\Result\GradeConsensus;
use WebChemistry\Fmp\Result\HistoricalChart;
use WebChemistry\Fmp\Result\HistoricalPriceFull;
use WebChemistry\Fmp\Result\HistoricalPriceFullLine;
use WebChemistry\Fmp\Result\IncomeStatement;
use WebChemistry\Fmp\Result\IncomeStatementGrowth;
use WebChemistry\Fmp\Result\KeyMetrics;
use WebChemistry\Fmp\Result\MarketOpen;
use WebChemistry\Fmp\Result\PriceTarget;
use WebChemistry\Fmp\Result\PriceTargetConsensus;
use WebChemistry\Fmp\Result\Profile;
use WebChemistry\Fmp\Result\Quote;
use WebChemistry\Fmp\Result\Rating;
use WebChemistry\Fmp\Result\Ratios;
use WebChemistry\Fmp\Result\Score;
use WebChemistry\Fmp\Result\SplitCalendarRecord;
use WebChemistry\Fmp\Result\StockPriceChange;
use WebChemistry\Fmp\Result\SymbolItem;
use WebChemistry\Fmp\Serializer\HttpDecoder;

final class FmpClient
{

	private HttpClientInterface $client;

	private HttpDecoder $decoder;

	public function __construct(
		private string $apiKey,
		?HttpClientInterface $client = null,
	)
	{
		$this->client = $client ?? HttpClient::create();

		$this->decoder = new HttpDecoder();
		$this->decoder->setDecoder(new JsonDecode([
			JsonDecode::ASSOCIATIVE => true,
		]), ['application/json']);
		$this->decoder->setDecoder(new CsvEncoder(), [], true);
	}

	public function withRetryStrategy(int $maxRetries = 3, int $delayMs = 1000, float $multiplier = 2.0): self
	{
		$clone = clone $this;
		$clone->client = new RetryableHttpClient($clone->client, new GenericRetryStrategy([
			423, 425, 429,
		], $delayMs, $multiplier), $maxRetries);

		return $clone;
	}

	/**
	 * @param string[] $contentTypes
	 * @return static
	 */
	public function setDecoder(DecoderInterface $decoder, array $contentTypes, bool $default = false): self
	{
		$this->decoder->setDecoder($decoder, $contentTypes, $default);

		return $this;
	}

	/**
	 * @return ChildResponse<HistoricalPriceFullLine>
	 */
	public function historicalPriceFullLine(string $symbol): ChildResponse
	{
		return $this->requestObject(HistoricalPriceFullLine::class, $this->createV3(['historical-price-full', $symbol], ['serietype' => 'line']));
	}

	/**
	 * @return ChildResponse<HistoricalChart>
	 */
	public function historicalChart(string $symbol, string $interval = '1min', ?DateTimeZone $dateTimeZone = null): ChildResponse
	{
		return $this->requestObject(HistoricalChart::class, $this->createV3(['historical-chart', $interval, $symbol]), [
			'timeZone' => $dateTimeZone,
		]);
	}

	/**
	 * @param string[] $symbols
	 * @return ChildrenResponse<HistoricalPriceFullLine>
	 */
	public function historicalPricesFullLine(array $symbols): ChildrenResponse
	{
		if (count($symbols) > 3) {
			throw new InvalidArgumentException('Symbols have to be less than 3');
		}

		return $this->requestObjects(
			HistoricalPriceFullLine::class,
			$this->createV3(['historical-price-full', implode(',', $symbols)], ['serietype' => 'line']),
			fn (array $result) => $result['historicalStockList'],
		);
	}

	/**
	 * @return ChildResponse<MarketOpen>
	 */
	public function isMarketOpen(): ChildResponse
	{
		return $this->requestObject(MarketOpen::class, $this->createV3('is-the-market-open'));
	}

	/**
	 * @return ChildrenResponse<Quote>
	 */
	public function quotes(string $exchange): ChildrenResponse
	{
		return $this->requestObjects(Quote::class, $this->createV3(['quotes', $exchange]));
	}

	/**
	 * @return ChildrenResponse<Ratios>
	 */
	public function ratiosTtmBulk(): ChildrenResponse
	{
		return $this->requestObjects(Ratios::class, $this->createV4('ratios-ttm-bulk'));
	}

	/**
	 * @return ChildrenResponse<KeyMetrics>
	 */
	public function keyMetricsTtmBulk(): ChildrenResponse
	{
		return $this->requestObjects(KeyMetrics::class, $this->createV4('key-metrics-ttm-bulk'));
	}

	/**
	 * @return ChildrenResponse<Score>
	 */
	public function scores(): ChildrenResponse
	{
		return $this->requestObjects(Score::class, $this->createV4('scores-bulk'));
	}

	/**
	 * @return ChildrenResponse<PriceTarget>
	 */
	public function priceTargetsBulk(): ChildrenResponse
	{
		return $this->requestObjects(PriceTarget::class, $this->createV4('price-target-summary-bulk'));
	}

	/**
	 * @return ChildrenResponse<Profile>
	 */
	public function profiles(): ChildrenResponse
	{
		return $this->requestObjects(Profile::class, $this->createV4('profile/all'));
	}

	/**
	 * @return ChildrenResponse<IncomeStatement>
	 */
	public function incomeStatementBulk(string|int|null $year = null, string $period = 'annual'): ChildrenResponse
	{
		return $this->requestObjects(IncomeStatement::class, $this->createV4('income-statement-bulk', [
			'year' => $year ?? date('Y'),
			'period' => $period,
		]));
	}

	/**
	 * @return ChildrenResponse<EarningCallTranscriptRow>
	 */
	public function earningCallTranscriptList(string $symbol): ChildrenResponse
	{
		return $this->requestObjects(EarningCallTranscriptRow::class, $this->createV4('earning_call_transcript', [
			'symbol' => $symbol,
		]));
	}

	/**
	 * @return ChildrenResponse<SplitCalendarRecord>
	 */
	public function stockSplitCalendar(DateTimeInterface $from, DateTimeInterface $to): ChildrenResponse
	{
		return $this->requestObjects(SplitCalendarRecord::class, $this->createV3('stock_split_calendar', [
			'from' => $from->format('Y-m-d'),
			'to' => $to->format('Y-m-d'),
		]));
	}

	/**
	 * Updated every 23:00 UTC
	 *
	 * @return ChildrenResponse<EndOfDayPrice>
	 */
	public function endOfDayPrices(DateTimeInterface $dateTime): ChildrenResponse
	{
		return $this->requestObjects(EndOfDayPrice::class, $this->createV4('batch-request-end-of-day-prices', [
			'date' => $dateTime->format('Y-m-d'),
		]));
	}

	/**
	 * @return ChildrenResponse<PriceTargetConsensus>
	 */
	public function priceTargetConsensus(string $symbol): ChildrenResponse
	{
		return $this->requestObjects(PriceTargetConsensus::class, $this->createV4('price-target-consensus', [
			'symbol' => $symbol,
		]));
	}

	/**
	 * @return ChildrenResponse<Rating>
	 */
	public function ratingBulk(): ChildrenResponse
	{
		return $this->requestObjects(Rating::class, $this->createV4('rating-bulk'));
	}

	/**
	 * @return ChildrenResponse<SymbolItem>
	 */
	public function symbolList(): ChildrenResponse
	{
		return $this->requestObjects(SymbolItem::class, $this->createV3('stock/list'));
	}

	/**
	 * @return ChildrenResponse<IncomeStatementGrowth>
	 */
	public function incomeStatementGrowthBulk(string|int|null $year = null, string $period = 'annual'): ChildrenResponse
	{
		return $this->requestObjects(IncomeStatementGrowth::class, $this->createV4('income-statement-growth-bulk', [
			'year' => $year ?? date('Y'),
			'period' => $period,
		]));
	}

	/**
	 * @throws EmptyResponseException
	 * @return ChildResponse<DiscountedCashFlow>
	 */
	public function discountedCashFlow(string $symbol): ChildResponse
	{
		return $this->requestObject(
			DiscountedCashFlow::class,
			$this->createV3(['discounted-cash-flow', $symbol]),
			itemAsArray: true,
			callback: function (array $result): array {
				if (!isset($result['dcf'])) {
					$symbol = $result['symbol'] ?? null;
					$symbol = is_string($symbol) ? $symbol : null;

					throw new NotFoundException(sprintf('DCF for symbol %s not found.', $symbol));
				}

				if (!is_numeric($result['dcf'])) {
					$message = sprintf('DCF for symbol %s is invalid. ', $result['symbol']);

					if (is_string($result['dcf'])) {
						$message .= $result['dcf'];
					}

					throw new NotFoundException($message);
				}

				return $result;
			},
		);
	}

	/**
	 * @return ChildrenResponse<GradeConsensus>
	 */
	public function gradeConsensusBulk(): ChildrenResponse
	{
		return $this->requestObjects(GradeConsensus::class, $this->createV4('upgrades-downgrades-consensus-bulk'));
	}

	/**
	 * @param string[]|string $symbols
	 * @return ChildrenResponse<StockPriceChange>
	 */
	public function stockPriceChange(array|string $symbols): ChildrenResponse
	{
		$symbols = (array) $symbols;

		if (!$symbols) {
			throw new InvalidArgumentException('Symbols have to be non-empty array.');
		}

		return $this->requestObjectsAndMerge(StockPriceChange::class, $this->createV3WithSymbolLimit(['stock-price-change'], $symbols));
	}

	/**
	 * @template T of FmpResult
	 * @param class-string<T> $className
	 * @param ResponseInterface[] $arguments
	 * @param (callable(mixed[]): mixed[])|null $getter
	 * @return MergedObjectsResponse<T>
	 */
	private function requestObjectsAndMerge(string $className, array $arguments, ?callable $getter = null): MergedObjectsResponse
	{
		$responses = [];

		foreach ($arguments as $argument) {
			$responses[] = $this->requestObjects($className, $argument, $getter);
		}

		return $this->mergeObjects($className, $responses);
	}

	/**
	 * @template T of FmpResult
	 * @param class-string<T> $className
	 * @param ChildrenResponse<T>[] $responses
	 * @return MergedObjectsResponse<T>
	 */
	public function mergeObjects(string $className, array $responses): MergedObjectsResponse
	{
		return new MergedObjectsResponse($className, $responses);
	}

	/**
	 * @param string[]|string $path
	 * @param non-empty-array<string> $symbols
	 * @param mixed[] $query
	 * @return ResponseInterface[]
	 */
	private function createV3WithSymbolLimit(array|string $path, array $symbols, array $query = []): array
	{
		$httpQuery = http_build_query(array_merge([
			'apikey' => $this->apiKey,
		], $query));
		$path = implode('/', array_map(fn (string $path) => urlencode(trim($path, '/')), (array) $path));

		$url = sprintf(
			'https://financialmodelingprep.com/api/v3%s',
			$path ? '/' . $path : '',
		);

		$limiter = new RequestSymbolLimit($url . '/%s%', implode(',', $symbols), max(1, 7000 - strlen($httpQuery)));
		$responses = [];

		foreach ($limiter->getUrls() as $url) {
			$url = $url . ($httpQuery ? '?' . $httpQuery : '');

			$responses[] = $this->client->request('GET', $url);
		}

		return $responses;
	}

	/**
	 * @param string|string[] $path
	 * @param mixed[] $query
	 */
	private function createV3(array|string $path, array $query = []): ResponseInterface
	{
		$httpQuery = http_build_query(array_merge([
			'apikey' => $this->apiKey,
		], $query));
		$path = implode('/', array_map(fn (string $path) => urlencode(trim($path, '/')), (array) $path));

		$url = sprintf(
			'https://financialmodelingprep.com/api/v3%s%s',
			$path ? '/' . $path : '',
			$httpQuery ? '?' . $httpQuery : '',
		);

		return $this->client->request('GET', $url);
	}

	/**
	 * @param string|string[] $path
	 * @param mixed[] $query
	 */
	private function createV4(array|string $path, array $query = []): ResponseInterface
	{
		$query = array_merge([
			'apikey' => $this->apiKey,
		], $query);
		$httpQuery = http_build_query($query);

		$path = !is_string($path) ? implode('/', array_map(fn (string $path) => urlencode(trim($path, '/')), $path)) : trim($path, '/');

		$url = sprintf(
			'https://financialmodelingprep.com/api/v4%s%s',
			$path ? '/' . $path : '',
			$httpQuery ? '?' . $httpQuery : '',
		);

		return $this->client->request('GET', $url);
	}

	/**
	 * @template T of FmpResult
	 * @param class-string<T> $className
	 * @param (callable(mixed[]): mixed[])|null $getter
	 * @return ChildrenResponse<T>
	 */
	private function requestObjects(
		string $className,
		ResponseInterface $response,
		?callable $getter = null,
	): ChildrenResponse
	{
		return new ObjectsResponse($className, $this->decoder, $response, $getter);
	}

	/**
	 * @template T of FmpResult
	 * @param class-string<T> $className
	 * @param mixed[] $options
	 * @param (callable(mixed[]): mixed[])|null $callback
	 * @return ChildResponse<T>
	 */
	private function requestObject(string $className, ResponseInterface $response, array $options = [], bool $itemAsArray = false, ?callable $callback = null): ChildResponse
	{
		$options['metadata'] = [
			'callback' => $callback,
		];

		if ($itemAsArray) {
			$options['metadata']['itemAsArray'] = true;
		}

		return new ObjectResponse($className, $this->decoder, $response, $options);
	}

}
