<?php

namespace Devotionalium\Model;

use Devotionalium\Block;
use Devotionalium\Block\Devotionalium;
use Devotionalium\ConfigAccessor;
use Devotionalium\WidgetBlock;

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
        try {
            $block = new Block\DevotionaliumWidget(
                $this->config,
                '/View/devotionalium-widget.phtml',
                $this->devotionalium,
                $args['before_widget'],
                $args['after_widget'],
                $args['before_title'],
                $args['after_title']
            );
            echo $block->getHtml();
        } catch (\Exception $e) {
            error_log($e->getMessage());
            $block = new WidgetBlock(
                '/View/error-widget.phtml',
                $args['before_widget'],
                $args['after_widget'],
                $args['before_title'],
                $args['after_title']
            );
            echo $block->getHtml();
        }
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
