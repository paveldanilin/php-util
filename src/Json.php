<?php declare(strict_types=1);

namespace paveldanilin\PhpUtil;

abstract class Json
{
    public const THROW_ON_ERROR = JSON_THROW_ON_ERROR;

    public const DECODE_BIGINT_AS_STRING = JSON_BIGINT_AS_STRING;
    public const DECODE_INVALID_UTF8_IGNORE = JSON_INVALID_UTF8_IGNORE;
    public const DECODE_INVALID_UTF8_SUBSTITUTE = JSON_INVALID_UTF8_SUBSTITUTE;
    public const DECODE_OBJECT_AS_ARRAY = JSON_OBJECT_AS_ARRAY;

    public const ENCODE_HEX_QUOT = JSON_HEX_QUOT;
    public const ENCODE_HEX_TAG = JSON_HEX_TAG;
    public const ENCODE_HEX_AMP = JSON_HEX_AMP;
    public const ENCODE_HEX_APOS = JSON_HEX_APOS;
    public const ENCODE_NUMERIC_CHECK = JSON_NUMERIC_CHECK;
    public const ENCODE_PRETTY_PRINT = JSON_PRETTY_PRINT;
    public const ENCODE_UNESCAPED_SLASHES = JSON_UNESCAPED_SLASHES;
    public const ENCODE_FORCE_OBJECT = JSON_FORCE_OBJECT;
    public const ENCODE_UNESCAPED_UNICODE = JSON_UNESCAPED_UNICODE;
    public const ENCODE_THROW_ON_ERROR = JSON_THROW_ON_ERROR;

    /**
     * @param string $json
     * @param bool $assoc
     * @param int $options
     * @param int $depth
     * @return mixed
     * @throws \JsonException
     */
    public static function decode(string $json, bool $assoc = false, int $options = 0, int $depth = 512)
    {
        $decoded = \json_decode($json, $assoc, $depth, $options);
        if (!($options & Json::THROW_ON_ERROR) && JSON_ERROR_NONE != \json_last_error()) {
            throw new \JsonException(\json_last_error_msg());
        }
        return $decoded;
    }

    /**
     * @param string $json
     * @param int $options
     * @param int $depth
     * @return array
     * @throws \JsonException
     */
    public static function toArray(string $json, int $options = 0, int $depth = 512): array
    {
        return Json::decode($json, true, $options, $depth);
    }

    /**
     * @param string $json
     * @param int $options
     * @param int $depth
     * @return object
     * @throws \JsonException
     */
    public static function toObject(string $json, int $options = 0, int $depth = 512): object
    {
        return Json::decode($json, false, $options, $depth);
    }

    /**
     * @param $data
     * @param int $options
     * @param int $depth
     * @return string
     * @throws \JsonException
     */
    public static function encode($data, int $options = 0, int $depth = 512): string
    {
        $encoded = \json_encode($data, $options, $depth);
        if (!($options & Json::THROW_ON_ERROR) && false === $encoded) {
            throw new \JsonException(\json_last_error_msg());
        }
        return $encoded;
    }
}
