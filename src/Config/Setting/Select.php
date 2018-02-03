<?php

namespace Devotionalium\Config\Setting;

use Devotionalium\Block;
use Devotionalium\Config\Setting;

class Select extends Setting
{
    /**
     * string[]
     */
    private $options;

    /**
     * Select constructor.
     *
     * @param string $id
     * @param string $title
     * @param string $description
     * @param string[] $options
     * @param Block\Setting $block
     */
    public function __construct($id, $title, $description, $options, Block\Setting $block)
    {
        $this->options = $options;

        parent::__construct($id, $title, $description, $block);
    }


    /**
     * @return string[]
     */
    public function getOptions()
    {
        return $this->options;
    }
}
