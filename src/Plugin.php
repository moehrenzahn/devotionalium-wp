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
    const WP_TEXTDOMAIN = 'devotionalium';

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
        $this->api = new DevotionaliumApi($this->config->getEndpointUrl());

        $this->initLocalisation();

        if (is_admin()) {
            $configPage = $this->initConfigPage();
            $this->loader->addAction(
                'admin_init',
                $configPage,
                'registerSettings'
            );
            $this->loader->addFilter(
                "plugin_action_links_devotionalium/devotionalium.php",
                $configPage,
                'addConfigLinkToPluginPage'
            );
        } else {
            $this->initCss();
            $this->initShortcode();
        }

        $this->initWidget();
        $this->loader->run();
    }

    /**
     * @return Settings
     */
    public function initConfigPage()
    {
        $communicator = new DevotionaliumApi($this->config->getEndpointUrl());
        $versions = $communicator->loadVersions();
        $versionsArray = [];
        foreach ($versions as $version) {
            $versionsArray[$version->getId()] = $version->getName();
        }
        $generalSettings = [
            new Setting(
                ConfigAccessor::KEY_IS_ORIGINAL_LANGUAGE,
                __('Original languages', Plugin::WP_TEXTDOMAIN),
                __('Display bible verses in original languages greek and hebrew as well.', Plugin::WP_TEXTDOMAIN),
                new \Devotionalium\Block\Setting('/View/config/setting/boolean.phtml')
            ),
            new Setting\Select(
                ConfigAccessor::KEY_VERSION,
                __('Bible Version', Plugin::WP_TEXTDOMAIN),
                __('Choose a bible version to display the bible verses in.', Plugin::WP_TEXTDOMAIN),
                $versionsArray,
                new \Devotionalium\Block\Setting('/View/config/setting/select.phtml')
            ),
            new Setting(
                ConfigAccessor::KEY_OUTGOING_LINKS,
                __('Outgoing links', Plugin::WP_TEXTDOMAIN),
                __('Include hyperlinks to the full readings on devotionalium.com (recommended).', Plugin::WP_TEXTDOMAIN),
                new \Devotionalium\Block\Setting('/View/config/setting/boolean.phtml')
            ),
        ];
        $experimentalSettings = [
            new Setting(
                ConfigAccessor::KEY_ENDPOINT_URL,
                __('Endpoint URL', Plugin::WP_TEXTDOMAIN),
                __('Choose the API endpoint URL to request Devotionalium from. Default: "https://devotionalium.com/api"', Plugin::WP_TEXTDOMAIN),
                new \Devotionalium\Block\Setting('/View/config/setting/text-wide.phtml')
            ),
            new Setting\Select(
                ConfigAccessor::KEY_LANGUAGE,
                __('Language', Plugin::WP_TEXTDOMAIN),
                __('Choose a language for text displayed by the plugin.', Plugin::WP_TEXTDOMAIN),
                [
                    'en' => __('English', Plugin::WP_TEXTDOMAIN),
                    'de' => __('German', Plugin::WP_TEXTDOMAIN)
                ],
                new \Devotionalium\Block\Setting('/View/config/setting/select.phtml')
            ),
            new Setting(
                ConfigAccessor::KEY_DAY_OFFSET,
                __('Day Offset', Plugin::WP_TEXTDOMAIN),
                __('Offset the displayed Devotionalium by the given amount of days (-7 to 7).', Plugin::WP_TEXTDOMAIN),
                new \Devotionalium\Block\Setting('/View/config/setting/text.phtml')
            ),
            new Setting(
                ConfigAccessor::KEY_CUSTOM_CSS,
                __('Custom CSS', Plugin::WP_TEXTDOMAIN),
                __(
                    'Define custom styles for displaying Devotionalium. Use class ".devotionalium" to limit changes to the plugin.',
                    Plugin::WP_TEXTDOMAIN
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
                __('Experimental', Plugin::WP_TEXTDOMAIN),
                $experimentalSettings,
                new \Devotionalium\Block\Section('/View/config/section.phtml'),
                __("Don't touch this if you don't know what you are doing.", Plugin::WP_TEXTDOMAIN)
            )
        ];
        $configPage = new Settings(__('Devotionalium', Plugin::WP_TEXTDOMAIN), $sections);

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

    private function initLocalisation()
    {
        load_plugin_textdomain(
            self::WP_TEXTDOMAIN,
            false,
            'devotionalium/languages'
        );
    }

    /**
     * @return Devotionalium
     */
    public function getDevotionalium()
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
