<?php

namespace Devotionalium\Block;

use DateTime;
use Devotionalium\Block;
use Devotionalium\ConfigAccessor;
use Devotionalium\Plugin;
use Exception;

class Devotionalium extends Block
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

    /**
     * @return string
     */
    public function getHeading()
    {
        if ($this->useLinks()) {
            $parts[] = '<a href="https://devotionalium.com">'.__('Devotionalium', Plugin::WP_TEXTDOMAIN).'</a>';
        } else {
            $parts[] = __('Devotionalium', Plugin::WP_TEXTDOMAIN);
        }
        $parts[] = _x('for', 'for a date', Plugin::WP_TEXTDOMAIN);

        try {
            $date = $this->getDevotionalium()->getDate();
        } catch (Exception $exception) {
            $date = new DateTime();
        }

        $parts[] = date_i18n(
            get_option('date_format'),
            $date->getTimestamp()
        );

        return implode(' ', $parts);
    }
}
