<?php

namespace Devotionalium;

class Autoloader
{
    const FILE_EXTENSION = '.php';
    const ROOT = 'Devotionalium';

    /**
     * @param string $classname
     * @return bool
     */
    public static function load(string $classname): bool
    {
        $parts = explode('\\', $classname);

        $base = array_shift($parts);
        if ($base !== self::ROOT) {
            return false;
        }
        $name = array_pop($parts);
        $path = '';
        foreach ($parts as $part) {
            $path .= $part . '/';
        }
        $filename = __DIR__.'/'.$path . $name . self::FILE_EXTENSION;
        if (file_exists($filename)) {
            require_once($filename);
            return true;
        } else {
            return false;
        }
    }
}
