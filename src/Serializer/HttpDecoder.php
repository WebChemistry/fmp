<?php declare(strict_types = 1);

namespace WebChemistry\Fmp\Serializer;

use LogicException;
use Symfony\Component\Serializer\Encoder\DecoderInterface;

final class HttpDecoder
{

	/** @var DecoderInterface[] */
	private array $decoders = [];

	private DecoderInterface $default;

	/**
	 * @param string[] $contentTypes
	 * @return static
	 */
	public function setDecoder(DecoderInterface $decoder, array $contentTypes, bool $default = false): self
	{
		foreach ($contentTypes as $contentType) {
			$this->decoders[$contentType] = $decoder;
		}

		if (!isset($this->default) || $default) {
			$this->default = $decoder;
		}

		return $this;
	}

	/**
	 * @param mixed[] $context
	 */
	public function decode(string $data, ?string $contentType, array $context = []): mixed
	{
		$decoder = $this->default ?? throw new LogicException('One decoder have to be set at least.');

		if ($contentType) {
			foreach ($this->decoders as $requiredContentType => $dec) {
				if (str_starts_with($contentType, $requiredContentType)) {
					$decoder = $dec;

					break;
				}
			}
		}

		return $decoder->decode($data, '', $context);
	}

}
