<?php

namespace Devotionalium\Model;

use Devotionalium\Block;
use Devotionalium\ConfigAccessor;
use Devotionalium\Devotionalium\Devotionalium;
use Devotionalium\Loader;

/**
 * Class ShortCode
 *
 * @package Eule\Model
 */
class ShortCode
{
    /**
     * @var string
     */
    private $shortCode;

    /**
     * @var Block
     */
    private $block;


    /**
     * ShortCode constructor.
     *
     * @param ConfigAccessor $config
     * @param string $shortCode
     * @param string $templatePath
     * @param Devotionalium $devotionalium
     */
    public function __construct(
        ConfigAccessor $config,
        $shortCode,
        $templatePath,
        Devotionalium $devotionalium
    ) {
        $this->shortCode = $shortCode;
        $this->block = new Block\Devotionalium($config, $templatePath, $devotionalium);
    }

    public function getTemplate()
    {
        try {
            return $this->block->getHtml();
        } catch (\Exception $e) {
            error_log($e->getMessage());
            $this->block = new Block('/View/error.phtml');
            return $this->block->getHtml();
        }
    }
}
