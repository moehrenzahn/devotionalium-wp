<?php
namespace Devotionalium;

/**
 * Class ConfigAccessor
 *
 * @package Eule
 */
class ConfigAccessor
{
    const CONFIG_PREFIX = 'devotionalium_';

    const KEY_IS_ORIGINAL_LANGUAGE = self::CONFIG_PREFIX.'isOriginalLanguage';

    const KEY_LANGUAGE = self::CONFIG_PREFIX.'lang';

    const KEY_VERSION = self::CONFIG_PREFIX.'version';

    const KEY_OUTGOING_LINKS = self::CONFIG_PREFIX.'useOutgoingLinks';

    const KEY_DAY_OFFSET = self::CONFIG_PREFIX.'dayOffset';

    const KEY_CUSTOM_CSS = self::CONFIG_PREFIX.'customCss';

    const DEFAULTS = [
        self::KEY_IS_ORIGINAL_LANGUAGE => false,
        self::KEY_OUTGOING_LINKS => false,
        self::KEY_DAY_OFFSET => 0,
        self::KEY_CUSTOM_CSS => '.devotionalium {}',
    ];

    /**
     * @return bool
     */
    public function isOriginallanguage()
    {
        return $this->getConfigValue(self::KEY_IS_ORIGINAL_LANGUAGE);
    }

    /**
     * @return string
     */
    public function getLanguage()
    {
        return $this->getConfigValue(self::KEY_LANGUAGE);
    }

    /**
     * @return string
     */
    public function getVersion()
    {
         return $this->getConfigValue(self::KEY_VERSION);
    }

    /**
     * @return bool
     */
    public function useOutgoingLinks()
    {
        return $this->getConfigValue(self::KEY_OUTGOING_LINKS);
    }

    /**
     * @return int
     */
    public function getDayOffset()
    {
        return $this->getConfigValue(self::KEY_DAY_OFFSET);
    }

    /**
     * @return string
     */
    public function getCustomCss()
    {
        return $this->getConfigValue(self::KEY_CUSTOM_CSS);
    }

    /**
     * @param $key
     * @return mixed|null
     */
    public function getConfigValue($key)
    {
        if (substr($key, 0, strlen(self::CONFIG_PREFIX)) !== self::CONFIG_PREFIX) {
            $key = self::CONFIG_PREFIX.$key;
        }
        $value = get_option($key, null);
        if (is_null($value)) {
            $value = $this->getDefaultValue($key);
        }

        return $value;
    }

    /**
     * @param string $key
     * @return mixed|string
     * @throws \Exception
     */
    private function getDefaultValue($key)
    {
        if (null !== self::DEFAULTS[$key]) {
            $value = self::DEFAULTS[$key];
        } elseif ($key === self::KEY_LANGUAGE) {
            $value = $this->getDefaultLanguage();
        } elseif ($key === self::KEY_VERSION) {
            $value = $this->getDefaultVersion();
        } else {
            throw new \Exception('No default set for '.$key);
        }

        return $value;
    }

    /**
     * @return string
     */
    private function getDefaultLanguage()
    {
        if (strpos(get_locale(), 'de_') !== false) {
            return 'de';
        }
        return 'en';
    }

    /**
     * @return string
     */
    private function getDefaultVersion()
    {
        if ($this->getLanguage() === 'de') {
            return 'schla';
        }

        return 'web';
    }
}
