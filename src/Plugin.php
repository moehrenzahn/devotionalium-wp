<?php

namespace Devotionalium;

use Devotionalium\Config\Section;
use Devotionalium\Config\Setting;
use Devotionalium\Config\Settings;
use Devotionalium\Devotionalium\Devotionalium;
use Devotionalium\Model\Api\DevotionaliumApi;
use Devotionalium\Model\ShortCode;
use Devotionalium\Model\Widget;

class Plugin
{
    /**
     * @var Devotionalium
     */
    private $devotionalium;

    /**
     * @var DevotionaliumApi
     */
    private $api;

    /**
     * @var ConfigAccessor
     */
    private $config;

    /**
     * @var Loader
     */
    private $loader;

    /**
     * Plugin constructor.
     */
    public function __construct()
    {
        $this->loader = new Loader();
        $this->config = new ConfigAccessor();
        $this->api = new DevotionaliumApi();

        if (is_admin()) {
            $configPage = $this->initConfigPage();
            $this->loader->addAction(
                'admin_init',
                $configPage,
                'registerSettings'
            );
            $this->loader->addFilter(
                "plugin_action_links_devotionalium-wp/devotionalium-wp.php",
                $configPage,
                'addConfigLinkToPluginPage'
            );
        } else {
            $this->initCss();
            $this->initShortcode();
            $this->initWidget();
        }

        $this->loader->run();
    }

    /**
     * @return Settings
     */
    public function initConfigPage()
    {
        $versions = (new DevotionaliumApi())->loadVersions();
        $versionsArray = [];
        foreach ($versions as $version) {
            $versionsArray[$version->getId()] = $version->getName();
        }
        $generalSettings = [
            new Setting(
                ConfigAccessor::KEY_IS_ORIGINAL_LANGUAGE,
                __('Original languages', 'devotionalium'),
                __('Display bible verses in original languages greek and hebrew as well.', 'devotionalium'),
                new \Devotionalium\Block\Setting('/View/config/setting/boolean.phtml')
            ),
            new Setting\Select(
                ConfigAccessor::KEY_LANGUAGE,
                __('Language', 'devotionalium'),
                __('Choose a language for text displayed by the plugin.', 'devotionalium'),
                [
                    'en' => __('English', 'devotionalium'),
                    'de' => __('German', 'devotionalium')
                ],
                new \Devotionalium\Block\Setting('/View/config/setting/select.phtml')
            ),
            new Setting\Select(
                ConfigAccessor::KEY_VERSION,
                __('Bible Version', 'devotionalium'),
                __('Choose a bible Version to display the bible verses in.', 'devotionalium'),
                $versionsArray,
                new \Devotionalium\Block\Setting('/View/config/setting/select.phtml')
            ),
            new Setting(
                ConfigAccessor::KEY_OUTGOING_LINKS,
                __('Outgoing links', 'devotionalium'),
                __('Include hyperlinks to the full readings on devotionalium.com (recommended).', 'devotionalium'),
                new \Devotionalium\Block\Setting('/View/config/setting/boolean.phtml')
            ),
        ];
        $experimentalSettings = [
            new Setting(
                ConfigAccessor::KEY_DAY_OFFSET,
                __('Day Offset', 'devotionalium'),
                __('Offset the displayed Devotionalium by the given amount of days (-7 to 7).', 'devotionalium'),
                new \Devotionalium\Block\Setting('/View/config/setting/text.phtml')
            ),
            new Setting(
                ConfigAccessor::KEY_CUSTOM_CSS,
                __('Custom CSS', 'devotionalium'),
                __(
                    'Define custom styles for displaying Devotionalium. Use class ".devotionalium-wp" to limit changes to the plugin',
                    'devotionalium'
                ),
                new \Devotionalium\Block\Setting('/View/config/setting/textarea.phtml')
            ),
        ];
        $sections = [
            new Section(
                'general',
                '',
                $generalSettings,
                new \Devotionalium\Block\Section('/View/config/section.phtml')
            ),
            new Section(
                'experimental',
                'Experimental',
                $experimentalSettings,
                new \Devotionalium\Block\Section('/View/config/section.phtml'),
                __("Don't touch this if you don't know what you are doing.")
            )
        ];
        $configPage = new Settings('Devotionalium', $sections);

        return $configPage;
    }

    private function initCss()
    {
        $pluginUrl = plugin_dir_url(__FILE__);
        wp_enqueue_style(
            'devotionalium',
            $pluginUrl.'css/devotionalium.css'
        );
    }

    public function initWidget()
    {
        $widget = new Widget(
            $this->config,
            $this->getDevotionalium()
        );
        $this->loader->addAction('widgets_init', $widget, 'register');
    }

    private function initShortcode()
    {
        $shortcode = new ShortCode(
            $this->config,
            'devotionalium',
            '/View/devotionalium.phtml',
            $this->getDevotionalium()
        );
        $this->loader->addShortcode('devotionalium', $shortcode, 'getTemplate');
    }

    /**
     * @return Devotionalium
     */
    public function getDevotionalium(): Devotionalium
    {
        if (!isset($this->devotionalium)) {
            $this->devotionalium = new Devotionalium(
                $this->api,
                $this->config
            );
        }
        return $this->devotionalium;
    }
}
