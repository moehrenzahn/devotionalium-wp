<?php

namespace Devotionalium\Config;

use Devotionalium\Block;

class Section
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $description;

    /**
     * @var Setting[]
     */
    private $settings;

    /**
     * @var Block\Section
     */
    public $block;

    /**
     * Section constructor.
     *
     * @param string $id
     * @param string $title
     * @param Setting[] $settings
     * @param Block\Section $block
     * @param string $description
     */
    public function __construct($id, $title, $settings, $block, $description = '')
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->settings = $settings;
        $this->block = $block;
        $this->block->setSection($this);
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return Setting[]
     */
    public function getSettings(): array
    {
        return $this->settings;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
}
