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

    public function isOriginallanguage()
    {
        return $this->getConfigValue('isOriginalLanguage') ?? false;
    }

    public function getLanguage()
    {
        return $this->getConfigValue('lang');
    }

    public function getVersion()
    {
        return $this->getConfigValue('version') ?? 'web';
    }

    public function getDayOffset()
    {
        return $this->getConfigValue('dayOffset') ?? 0;
    }

    public function getCustomCss()
    {
        return $this->getConfigValue('customCss') ?? '';
    }

    /**
     * @param $key
     * @return bool|string
     */
    private function getConfigValue($key)
    {
        $preference = $this->configModel->getPreferenceBySlug($key);
        if ($preference) {
            return $preference->getValue();
        } else {
            return null;
        }
    }
}
