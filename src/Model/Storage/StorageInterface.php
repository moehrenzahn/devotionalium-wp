<?php

namespace Devotionalium\Model\Storage;

use Devotionalium\Model\Config\PreferenceInterface;

/**
 * Interface StorageInterface
 *
 * Store preferences in their respective Wordpress storage mechanism
 */
interface StorageInterface
{
    /**
     * @param PreferenceInterface $preference
     * @param string $value
     * @param int $postId
     */
    public function update(PreferenceInterface $preference, $value, $postId = 0);

    /**
     * @param PreferenceInterface $preference
     * @param int $postId
     */
    public function save(PreferenceInterface $preference, $postId = 0);

    /**
     * @param PreferenceInterface $preference
     * @param int $postId
     * @return string|null
     */
    public function load(PreferenceInterface $preference, $postId = 0);

    /**
     * @param PreferenceInterface $preference
     * @param int $postId
     */
    public function delete(PreferenceInterface $preference, $postId = 0);
}
