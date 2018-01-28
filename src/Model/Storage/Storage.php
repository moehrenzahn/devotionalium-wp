<?php

namespace Devotionalium\Model\Storage;

use Devotionalium\Model\Config\Config;

/**
 * Class Storage Generic
 *
 * @package Eule\Model\Storage
 */
abstract class Storage implements StorageInterface
{
    /**
     * @param string $key
     * @return string
     */
    protected function compileKey($key)
    {
        if (strpos($key, Config::OPTION_PREFIX) === false) {
            $key = Config::OPTION_PREFIX . $key;
        }
        return $key;
    }
}
