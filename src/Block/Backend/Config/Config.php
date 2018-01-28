<?php

namespace Devotionalium\Block\Backend\Config;

use Devotionalium\Block;
use Devotionalium\Model\Config\PreferenceInterface;

/**
 * Class Config
 *
 * @package Devotionalium\Block\Backend\Config
 */
class Config extends Block
{
    /**
     * @var \Devotionalium\Model\Config\Config
     */
    protected $configModel;

    /**
     * @var string
     */
    protected $title;

    /**
     * Preference constructor.
     *
     * @param string $templatePath
     * @param string $title
     * @param \Devotionalium\Model\Config\Config $configModel
     */
    public function __construct(
        $templatePath,
        $title,
        \Devotionalium\Model\Config\Config $configModel
    ) {
        $this->title = $title;
        $this->configModel = $configModel;
        parent::__construct($templatePath);
    }

    /**
     * @return PreferenceInterface[]
     */
    public function getConfigEntries()
    {
        $result = $this->configModel->getConfigArray();

        return $result;
    }

    public function getActionName()
    {
        return $this->configModel->configName;
    }

    public function getTitle()
    {
        return __('Settings').' › '.__($this->title);
    }
}
