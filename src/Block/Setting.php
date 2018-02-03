<?php

namespace Devotionalium\Block;

use Devotionalium\Block;

class Setting extends Block
{
    /**
     * @var \Devotionalium\Config\Setting
     */
    private $setting;

    /**
     * Setting constructor.
     *
     * @param \Devotionalium\Config\Setting|null $setting
     * @param string $templatePath
     */
    public function __construct($templatePath, $setting = null)
    {
        $this->setting = $setting;

        parent::__construct($templatePath);
    }

    /**
     * @return \Devotionalium\Config\Setting
     */
    public function getSetting()
    {
        return $this->setting;
    }

    /**
     * @param \Devotionalium\Config\Setting $setting
     */
    public function setSetting(\Devotionalium\Config\Setting $setting)
    {
        $this->setting = $setting;
    }
}
