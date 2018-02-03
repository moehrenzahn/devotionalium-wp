<?php

namespace Devotionalium;

/**
 * Generic block class for template management.
 *
 * @package Devotionalium
 */
class WidgetBlock extends Block
{
    /**
     * @var string
     */
    private $beforeWidget;

    /**
     * @var string
     */
    private $afterWidget;

    /**
     * @var string
     */
    private $beforeTitle;

    /**
     * @var string
     */
    private $afterTitle;

    public function __construct(
        $templatePath,
        $beforeWidget,
        $afterWidget,
        $beforeTitle,
        $afterTitle
    ) {
        $this->beforeWidget = $beforeWidget;
        $this->afterWidget = $afterWidget;
        $this->beforeTitle = $beforeTitle;
        $this->afterTitle = $afterTitle;

        parent::__construct($templatePath);
    }

    /**
     * @return string
     */
    public function getBeforeWidget()
    {
        return $this->beforeWidget;
    }

    /**
     * @return string
     */
    public function getAfterWidget()
    {
        return $this->afterWidget;
    }

    /**
     * @return string
     */
    public function getBeforeTitle()
    {
        return $this->beforeTitle;
    }

    /**
     * @return string
     */
    public function getAfterTitle()
    {
        return $this->afterTitle;
    }
}
