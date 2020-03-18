<?php declare(strict_types=1);

namespace paveldanilin\PhpUtil;

abstract class Os
{
    public const FAMILY = PHP_OS_FAMILY;

    public static function isWindows(): bool
    {
        return 0 === \stripos(static::FAMILY, 'windows');
    }

    public static function isLinux(): bool
    {
        return 0 === \stripos(static::FAMILY, 'linux');
    }

    public static function isDarwin(): bool
    {
        return 0 === \stripos(static::FAMILY, 'darwin');
    }

    public static function isSolaris(): bool
    {
        return 0 === \stripos(static::FAMILY, 'solaris');
    }

    public static function isBSD(): bool
    {
        return 0 === \stripos(static::FAMILY, 'bsd');
    }

    public static function isUnix(): bool
    {
        return \in_array(static::FAMILY, ['linux', 'darwin', 'solaris', 'bsd'], true);
    }
}
