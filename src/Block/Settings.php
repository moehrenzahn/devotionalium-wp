<?php

namespace Devotionalium\Block;

use Devotionalium\Block;
use Devotionalium\Config\Section;

class Settings extends Block
{
    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $page;

    /**
     * Settings constructor.
     *
     * @param string $title
     * @param string $page
     */
    public function __construct($title, $page)
    {
        $this->title = $title;
        $this->page = $page;

        parent::__construct('/View/settings.phtml');
    }

    /**
     * @return Section[]
     */
    public function getSections()
    {
        return $this->sections;
    }

    /**
     * @return string
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }
}
