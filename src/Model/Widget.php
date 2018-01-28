<?php

namespace Devotionalium\Model;

use Devotionalium\Block\Devotionalium;
use Devotionalium\ConfigAccessor;

class Widget extends \WP_Widget
{
    /**
     * @var ConfigAccessor
     */
    private $config;

    /**
     * @var \Devotionalium\Devotionalium\Devotionalium
     */
    private $devotionalium;

    /**
     * Widget constructor.
     *
     * @param ConfigAccessor $config
     * @param \Devotionalium\Devotionalium\Devotionalium $devotionalium
     */
    public function __construct(
        ConfigAccessor $config,
        \Devotionalium\Devotionalium\Devotionalium $devotionalium
    ) {
        $this->config = $config;
        $this->devotionalium = $devotionalium;
        parent::__construct(
            'devotionalium',
            'Devotionalium',
            ['description' => __('Displays daily bible verses from devotionalium.com')]
        );
    }

    /**
     * Echo widget content. Called via loader class
     *
     * @param array $args
     * @param array $instance
     */
    public function widget($args, $instance)
    {
        $block = new Devotionalium(
            $this->config,
            '/View/devotionalium.phtml',
            $this->devotionalium
        );
        $block->renderTemplate();
    }

    /**
     * Echo content of widget configuration area.
     *
     * @param array $instance
     * @return string
     */
    public function form($instance)
    {
        echo '<p>'._('You can configure this widget via the Plugin options page.').'</p>';
        return 'noform';
    }

    public function register()
    {
        register_widget($this);
    }
}
