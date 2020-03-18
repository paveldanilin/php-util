<?php declare(strict_types=1);

namespace paveldanilin\PhpUtil;

abstract class Str
{
    public static function startsWith(string $str, string $start, bool $caseSensitive = true): bool
    {
        if (false === $caseSensitive) {
            $str = \strtolower($str);
            $start = \strtolower($start);
        }
        return (\substr($str, 0, \strlen($start)) === $start);
    }

    public static function endsWith(string $str, string $end, bool $caseSensitive = true): bool
    {
        if (false === $caseSensitive) {
            $str = \strtolower($str);
            $end = \strtolower($end);
        }
        $len = \strlen($end);
        if (0 === $len) {
            return true;
        }
        return (\substr($str, -$len) === $end);
    }

    /**
     * Splits string into array of chunks and returns the last chunk
     * @param string $str
     * @param string $delimiter
     * @return string
     */
    public static function lastChunk(string $str, string $delimiter): string
    {
        $parts = \explode($delimiter, $str);
        return \end($parts);
    }

    public static function contains(string $str, string $substring, bool $caseSensitive = true): bool
    {
        if (false === $caseSensitive) {
            $str = \strtolower($str);
            $substring = \strtolower($substring);
        }
        return false !== \strpos($str, $substring);
    }
}
