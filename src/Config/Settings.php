<?php

namespace Devotionalium\Config;

use Devotionalium\AdminPage;
use Devotionalium\Block;

/**
 * Class Settings
 *
 * Wrapper around the Wordpress Settings API
 *
 * @package Devotionalium
 */
class Settings extends AdminPage
{
    /**
     * @var Section[]
     */
    private $sections;

    /**
     * Settings constructor.
     *
     * @param string $title
     * @param Section[] $sections
     */
    public function __construct($title, $sections)
    {
        $this->sections = $sections;
        $block = new Block\Settings($title, $this->generateSlug($title));

        parent::__construct($title, $block);
    }

    public function registerSettings()
    {
        foreach ($this->sections as $section) {
            add_settings_section(
                $section->getId(),
                $section->getTitle(),
                [$section->block, 'renderTemplate'],
                $this->slug
            );
            foreach ($section->getSettings() as $setting) {
                add_settings_field(
                    $setting->getId(),
                    $setting->getTitle(),
                    [$setting->block, 'renderTemplate'],
                    $this->slug,
                    $section->getId()
                );
                register_setting(
                    $this->slug,
                    $setting->getId()
                );
            }
        }
    }
}
