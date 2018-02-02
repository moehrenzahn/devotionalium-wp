<?php
namespace Devotionalium;

use Devotionalium\Model\Config\Config;

/**
 * Class ConfigAccessor
 *
 * @package Eule
 */
class ConfigAccessor
{
    /**
     * @var Config
     */
    private $configModel;

    /**
     * ConfigAccessor constructor.
     *
     * @param Config $configModel
     */
    public function __construct(Config $configModel)
    {
        $this->configModel = $configModel;
    }

    /**
     * @return bool
     */
    public function isOriginallanguage()
    {
        return $this->getConfigValue('isOriginalLanguage') ?? false;
    }

    /**
     * @return string
     */
    public function getLanguage()
    {
        if ($language = $this->getConfigValue('lang')) {
            return $language;
        }
        if (strpos(get_locale(), 'de_') !== false) {
            return 'de';
        }
        return 'en';
    }

    /**
     * @return string
     */
    public function getVersion()
    {
        if ($version = $this->getConfigValue('version')) {
            return $version;
        }
        if ($this->getLanguage() === 'de') {
            return 'schla';
        }

        return 'web';
    }

    /**
     * @return bool
     */
    public function useOutgoingLinks()
    {
        return $this->getConfigValue('useOutgoingLinks') ?? false;
    }

    /**
     * @return int
     */
    public function getDayOffset()
    {
        return $this->getConfigValue('dayOffset') ?? 0;
    }

    /**
     * @return string
     */
    public function getCustomCss()
    {
        return $this->getConfigValue('customCss') ?? '.devotionalium-wp {}';
    }

    /**
     * @param $key
     * @return mixed|null
     */
    private function getConfigValue($key)
    {
        $preference = $this->configModel->getPreferenceBySlug($key);
        if ($preference && $preference->getValue()) {
            return $preference->getValue();
        } else {
            return null;
        }
    }
}
