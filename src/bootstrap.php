<?php

if (PHP_VERSION_ID < 70300) {
    if (!defined('JSON_THROW_ON_ERROR')) {
        define('JSON_THROW_ON_ERROR', 4194304);
    }

    class JsonException extends \Exception
    {
    }
}
