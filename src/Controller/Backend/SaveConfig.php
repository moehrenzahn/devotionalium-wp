<?php

namespace Devotionalium\Controller\Backend;

use Devotionalium\Model\Config\Config;

/**
 * Class SaveConfig
 *
 * @package Devotionalium\Controller\Backend
 */
class SaveConfig
{
    const ACTION_NAME_PREFIX = 'devotionalium_';

    /**
     * @var Config
     */
    private $config;

    /**
     * SaveConfig constructor.
     *
     * @param Config $config
     */
    public function __construct($config)
    {
        $this->config = $config;
        add_action(
            'admin_post_' . $this->config->configName,
            [$this, 'processRequest']
        );
    }

    public function processRequest()
    {
        foreach ($_REQUEST as $key => $value) {
            $preference = $this->config->getPreferenceBySlug($key);
            if ($preference) {
                $preference->setValue($value);
            }
        }
        wp_redirect(admin_url('admin.php?page=' . $this->config->configName));
    }
}
