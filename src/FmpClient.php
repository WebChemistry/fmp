<?php declare(strict_types = 1);

namespace WebChemistry\Fmp;

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
use WebChemistry\Fmp\Request\RequestArguments;
use WebChemistry\Fmp\Request\RequestSymbolLimit;
use WebChemistry\Fmp\Response\ChildrenResponse;
use WebChemistry\Fmp\Response\ChildResponse;
use WebChemistry\Fmp\Response\MergedObjectsResponse;
use WebChemistry\Fmp\Response\ObjectResponse;
use WebChemistry\Fmp\Response\ObjectsResponse;
use WebChemistry\Fmp\Response\Response;
use WebChemistry\Fmp\Result\FmpResult;
use WebChemistry\Fmp\Result\GradeConsensus;
use WebChemistry\Fmp\Result\HistoricalChart;
use WebChemistry\Fmp\Result\HistoricalPriceFull;
use WebChemistry\Fmp\Result\HistoricalPriceFullLine;
use WebChemistry\Fmp\Result\KeyMetrics;
use WebChemistry\Fmp\Result\MarketOpen;
use WebChemistry\Fmp\Result\PriceTarget;
use WebChemistry\Fmp\Result\Profile;
use WebChemistry\Fmp\Result\Quote;
use WebChemistry\Fmp\Result\Ratios;
use WebChemistry\Fmp\Result\Score;
use WebChemistry\Fmp\Result\StockPriceChange;
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
	 * @param RequestArguments[] $arguments
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
	 * @return RequestArguments[]
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
		$urls = [];

		foreach ($limiter->getUrls() as $url) {
			$url = $url . ($httpQuery ? '?' . $httpQuery : '');

			$urls[] = new RequestArguments($this->client, 'GET', $url);
		}

		return $urls;
	}

	/**
	 * @param string|string[] $path
	 * @param mixed[] $query
	 */
	private function createV3(array|string $path, array $query = []): RequestArguments
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

		return new RequestArguments($this->client, 'GET', $url);
	}

	/**
	 * @param string|string[] $path
	 * @param mixed[] $query
	 */
	private function createV4(array|string $path, array $query = []): RequestArguments
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

		return new RequestArguments($this->client, 'GET', $url);
	}

	/**
	 * @template T of FmpResult
	 * @param class-string<T> $className
	 * @param (callable(mixed[]): mixed[])|null $getter
	 * @return ChildrenResponse<T>
	 */
	private function requestObjects(
		string $className,
		RequestArguments $arguments,
		?callable $getter = null,
	): ChildrenResponse
	{
		$this->applyRepeatable($response = new ObjectsResponse($className, $this->decoder, $arguments, $getter));

		return $response;
	}

	/**
	 * @template T of FmpResult
	 * @param class-string<T> $className
	 * @param mixed[] $options
	 * @return ChildResponse<T>
	 */
	private function requestObject(string $className, RequestArguments $arguments, array $options = []): ChildResponse
	{
		$this->applyRepeatable($response = new ObjectResponse($className, $this->decoder, $arguments, $options));

		return $response;
	}

	private function applyRepeatable(Response $response): void
	{
		$response->repeatable(2, fn (ResponseInterface $response) => $response->getStatusCode() === 429);
	}

}
