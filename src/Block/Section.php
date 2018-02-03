<?php

namespace Devotionalium\Block;

use Devotionalium\Block;

class Section extends Block
{
    /**
     * @var \Devotionalium\Config\Section
     */
    private $section;

    /**
     * Section constructor.
     *
     * @param string $templatePath
     * @param \Devotionalium\Config\Section $section
     */
    public function __construct($templatePath, \Devotionalium\Config\Section $section = null)
    {
        $this->section = $section;

        parent::__construct($templatePath);
    }

    /**
     * @return \Devotionalium\Config\Section
     */
    public function getSection()
    {
        return $this->section;
    }

    /**
     * @param \Devotionalium\Config\Section $section
     */
    public function setSection(\Devotionalium\Config\Section $section)
    {
        $this->section = $section;
    }
}
