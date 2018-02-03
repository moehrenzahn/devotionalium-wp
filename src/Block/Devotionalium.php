<?php

namespace Devotionalium\Block;

use Devotionalium\ConfigAccessor;

/**
 * Class Devotionalium
 *
 * @package Devotionalium\Block
 */
class Devotionalium extends \Devotionalium\Block
{
    /**
     * @var \Devotionalium\Devotionalium\Devotionalium
     */
    private $devotionalium;

    /**
     * @var ConfigAccessor
     */
    private $config;

    /**
     * Devotionalium constructor.
     *
     * @param ConfigAccessor $config
     * @param string $templatePath
     * @param \Devotionalium\Devotionalium\Devotionalium $devotionalium
     */
    public function __construct(
        ConfigAccessor $config,
        $templatePath,
        \Devotionalium\Devotionalium\Devotionalium $devotionalium
    ) {
        $this->config = $config;
        $this->devotionalium = $devotionalium;
        parent::__construct($templatePath);
    }

    /**
     * @return \Devotionalium\Devotionalium\Devotionalium
     */
    public function getDevotionalium()
    {
        return $this->devotionalium;
    }

    /**
     * @return bool
     */
    public function showOriginalLanguages()
    {
        return $this->config->isOriginallanguage();
    }

    /**
     * @return string
     */
    public function getCustomCss()
    {
        return esc_html($this->config->getCustomCss());
    }

    /**
     * @return bool
     */
    public function useLinks()
    {
        return $this->config->useOutgoingLinks();
    }
}
