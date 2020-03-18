<?php declare(strict_types=1);

namespace paveldanilin\PhpUtil;

abstract class Arr
{
    public static function find(string $path, array $data, string $delimiter = '.')
    {
        $temp = &$data;
        $pathChunks = \explode($delimiter, $path);

        foreach ($pathChunks as $key) {
            if (\is_array($temp)) {
                if (! \array_key_exists($key, $temp)) {
                    throw new \OutOfRangeException(
                        \sprintf('Path not found `%s`', \implode($delimiter, $pathChunks))
                    );
                }
                $temp = &$temp[$key];
            } elseif (\is_object($temp)) {
                if (! isset($temp->{$key})) {
                    throw new \OutOfRangeException(
                        \sprintf('Path not found `%s`', \implode($delimiter, $pathChunks))
                    );
                }
                $temp = &$temp->{$key};
            }
        }
        return $temp;
    }

    public static function get(string $path, array $data, $def = null, string $delimiter = '.')
    {
        try {
            return static::find($path, $data, $delimiter);
        } catch (\OutOfRangeException $exception) {
            return $def;
        }
    }

    public static function has(string $path, array $data, string $delimiter = '.'): bool
    {
        try {
            static::find($path, $data, $delimiter);
            return true;
        } catch (\OutOfRangeException $exception) {
            return false;
        }
    }

    public static function set(string $path, $value, array $data = [], string $delimiter = '.'): array
    {
        $pathChunks = \explode($delimiter, $path);
        $temp = &$data;
        foreach ($pathChunks as $key) {
            $temp = &$temp[$key];
        }
        $temp = $value;
        unset($temp);
        return $data;
    }
}
