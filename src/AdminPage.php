<?php

namespace Devotionalium;

/**
 * Generic Admin Page in Wordpress Dashboard
 *
 * @package Devotionalium\Plugins\AdminPage
 */
class AdminPage
{
    const ACTION = 'admin_menu';

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $slug;

    /**
     * @var Block
     */
    private $block;

    /**
     * AdminPage constructor.
     *
     * @param string $title
     * @param Block $block
     */
    public function __construct(
        $title,
        $block
    ) {
        $this->title = $title;
        $this->slug = $this->generateSlug($title);
        $this->block = $block;

        add_action(self::ACTION, [$this, 'register']);
    }

    /**
     * Register backend page with wordpress
     */
    public function register()
    {
        add_options_page(
            $this->title,
            $this->title,
            "read",
            $this->slug,
            [$this, 'renderContent']
        );
    }

    /**
     *
     */
    public function renderContent()
    {
        $this->block->renderTemplate();
    }

    /**
     * @param $title
     * @return mixed|string
     */
    private function generateSlug($title)
    {
        $result = strtolower($title);
        $result = str_replace(' ', '_', $result);

        return $result;
    }

    /**
     * @param array $links
     * @return array
     */
    public function addConfigLinkToPluginPage($links)
    {
        $settingsLink = '<a href="options-general.php?page=devotionalium">' . __('Settings') . '</a>';
        array_push($links, $settingsLink);

        return $links;
    }
}
