<?php

namespace Devotionalium;

use Devotionalium\Block\Backend\Config\Config;
use Devotionalium\Controller\Backend\SaveConfig;
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
     * @var \Devotionalium\Model\Config\Config
     */
    private $configModel;

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
        $this->configModel = new \Devotionalium\Model\Config\Config('devotionalium');
        $this->config = new ConfigAccessor($this->configModel);
        $this->api = new DevotionaliumApi();

        if (is_admin()) {
            $this->initConfigPage();
        } else {
            $this->initCss();
            $this->initShortcode();
        }
        $this->initWidget();

        $this->loader->run();
    }


    private function initConfigPage()
    {
        $title = 'Devotionalium';
        $configBlock = new Config(
            '/View/config.phtml',
            $title,
            $this->configModel
        );
        $adminPage = new \Devotionalium\AdminPage(
            $title,
            $configBlock
        );

        $this->loader->addFilter(
            'plugin_action_links_devotionalium-wp/devotionalium-wp.php',
            $adminPage,
            'addConfigLinkToPluginPage'
        );

        // register save controller with admin page
        new SaveConfig($this->configModel);
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
