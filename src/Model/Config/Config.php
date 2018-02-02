<?php

namespace Devotionalium\Model\Config;

use Devotionalium\Model\Api\DevotionaliumApi;
use Devotionalium\Model\Config\Preference\BooleanPreference;
use Devotionalium\Model\Config\Preference\SelectPreference;
use Devotionalium\Model\Config\Preference\TextboxPreference;
use Devotionalium\Model\Config\Preference\TextfieldPreference;

/**
 * Class for generic preference
 */
class Config
{
    const OPTION_PREFIX = 'devotionalium_';

    /**
     * @var PreferenceInterface[]
     */
    protected $options;

    /**
     * @var string
     */
    public $configName;

    /**
     * Config constructor.
     *
     * @param string $configName
     */
    public function __construct($configName)
    {
        $preferenceStorage = new \Devotionalium\Model\Storage\Config\Preference();

        $versions = (new DevotionaliumApi())->loadVersions();
        $versionsArray = [];
        foreach ($versions as $version) {
            $versionsArray[$version->getId()] = $version->getName();
        }

        $this->configName = $configName;
        $this->options = [
            new BooleanPreference(
                $preferenceStorage,
                'isOriginalLanguage',
                __('Original languages', 'devotionalium'),
                __('Display bible verses in original languages greek and hebrew as well.', 'devotionalium')
            ),
            new SelectPreference(
                $preferenceStorage,
                'lang',
                __('Language', 'devotionalium'),
                [
                    'en' => __('English', 'devotionalium'),
                    'de' => __('German', 'devotionalium')
                ],
                __('Choose a language for text displayed by the plugin.', 'devotionalium')
            ),
            new SelectPreference(
                $preferenceStorage,
                'version',
                __('Bible Version', 'devotionalium'),
                $versionsArray,
                __('Choose a bible Version to display the bible verses in.', 'devotionalium')
            ),
            new BooleanPreference(
                $preferenceStorage,
                'useOutgoingLinks',
                __('Outgoing links', 'devotionalium'),
                __('Include hyperlinks to the full readings on devotionalium.com (recommended).', 'devotionalium')
            ),
            new TextboxPreference(
                $preferenceStorage,
                'customCss',
                __('Custom CSS', 'devotionalium'),
                __(
                    'Define custom styles for displaying Devotionalium. Use class ".devotionalium-wp" to limit changes to the plugin',
                    'devotionalium'
                )
            ),
            new TextfieldPreference(
                $preferenceStorage,
                'dayOffset',
                __('Day Offset (Experimental!)', 'devotionalium'),
                __('Offset the displayed Devotionalium by the given amount of days (-7 to 7).', 'devotionalium')
            ),
        ];
    }

    /**
     * @return PreferenceInterface[]
     */
    public function getConfigArray()
    {
        return $this->options;
    }

    /**
     * @param string $slug
     * @return PreferenceInterface
     */
    public function getPreferenceBySlug($slug)
    {
        if (strpos($slug, Config::OPTION_PREFIX) === false) {
            $slug = Config::OPTION_PREFIX . $slug;
        }
        /** @var PreferenceInterface $option */
        foreach ($this->options as $option) {
            if ($option->getSlug() === $slug) {
                return $option;
            }
        }
        return null;
    }

    /**
     * @param PreferenceInterface $preference
     * @return mixed
     */
    public function getConfigValue($preference)
    {
        return $preference->getValue();
    }

    /**
     * Update a config value
     *
     * @param PreferenceInterface $preference
     * @param mixed $value
     */
    public function updateConfigValue($preference, $value)
    {
        $preference->setValue($value);
    }
}
