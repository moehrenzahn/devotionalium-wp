<?php
namespace Devotionalium\Model\Storage\Config;

use Devotionalium\Model\Config\PreferenceInterface;
use Devotionalium\Model\Storage\Storage;

class Preference extends Storage
{
    public function update(PreferenceInterface $preference, $value, $postId = 0)
    {
        $key = $this->compileKey($preference->getSlug());
        update_option($key, $value);
    }

    /**
     * @param PreferenceInterface $preference
     */
    public function save(PreferenceInterface $preference, $postId = 0)
    {
        $key = $this->compileKey($preference->getSlug());
        update_option($key, $preference->getValue());
    }

    /**
     * @param PreferenceInterface $preference
     * @return string|null
     */
    public function load(PreferenceInterface $preference, $postId = 0)
    {
        $key = $this->compileKey($preference->getSlug());
        return get_option($key);
    }

    public function delete(PreferenceInterface $preference, $postId = 0)
    {
        $key = $this->compileKey($preference->getSlug());
        delete_option($key);
    }
}
