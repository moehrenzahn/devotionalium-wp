<?php

namespace Devotionalium;

/**
 * Generic block class for template management.
 *
 * @package Devotionalium
 */
class Block
{
    /**
     * @var string
     */
    protected $templatePath;

    /**
     * Block constructor.
     *
     * @param string $templatePath
     */
    public function __construct($templatePath)
    {
        $this->templatePath = $templatePath;
    }

    /**
     * Output template into output
     */
    public function renderTemplate()
    {
        if (!$this->templatePath) {
            return;
        }
        $block = $this; // make the block instance avaliable as $block in the template
        require(__DIR__.$this->templatePath);
    }

    /**
     * @param string $path
     */
    public function setTemplatePath($path)
    {
        $this->templatePath = $path;
    }

    /**
     * @param $slug
     * @param \WP_Post|null $postObject
     */
    public function renderTemplatePart($slug, $postObject = null)
    {
        if ($postObject) {
            global $post;
            $post = $postObject;
        }
        get_template_part($slug);
    }

    /**
     * Retrieve Template html
     *
     * @return string
     * @throws \Exception
     */
    public function getHtml()
    {
        ob_start();
        try {
            $this->renderTemplate();
            $html = ob_get_contents();
        } catch (\Exception $e) {
            ob_end_clean();
            throw $e;
        }
        ob_end_clean();

        return $html;
    }

    /**
     * @param $path
     * @param null|\WP_Post $postObject
     */
    public function renderPartial($path, $postObject = null)
    {
        global $post;
        if ($postObject) {
            $post = $postObject;
        }
        $block = $this; // make the block instance avaliable as $block in the template
        require(__DIR__.'/View/' . $path .'.phtml');
    }
}
