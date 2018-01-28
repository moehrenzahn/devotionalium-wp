<?php

namespace Devotionalium\Model\Config;

/**
 * Generic preference item
 *
 * @package Devotionalium\Model\Config
 */
interface PreferenceInterface
{
    /**
     * @param null|int $postId
     * @param string $value
     */
    public function setValue($value, $postId = null);

    /**
     * @param null|int $postId
     * @return string|bool
     */
    public function getValue($postId = null);

    /**
     * @return mixed
     */
    public function getSlug();
}
