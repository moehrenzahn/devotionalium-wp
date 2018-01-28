<?php

namespace Devotionalium\Model\Config;

use Devotionalium\Model\Storage\StorageInterface;

/**
 * Generic Preference Item
 *
 * @package Eule\Model\Preference
 */
class Preference implements PreferenceInterface
{
    /**
     * @var string
     */
    public $slug;

    /**
     * @var string
     */
    public $title;

    /**
     * @var string
     */
    public $description;

    /**
     * @var string|null
     */
    public $value;

    /**
     * @var StorageInterface
     */
    protected $storage;

    /**
     * Preference constructor.
     *
     * @param StorageInterface $storage
     * @param string $slug
     * @param string $title
     * @param string $description
     */
    public function __construct(
        StorageInterface $storage,
        string $slug,
        string $title,
        string $description = ''
    ) {
        $this->storage = $storage;
        $this->slug = $this->initSlug($slug);
        $this->title = $title;
        $this->description = $description;
        $this->value = $this->initValue();
    }

    protected function initValue()
    {
        return $this->storage->load($this);
    }

    protected function initSlug($slug)
    {
        if (strpos($slug, Config::OPTION_PREFIX) === false) {
            $slug = Config::OPTION_PREFIX . $slug;
        }
        return $slug;
    }

    /**
     * @param bool|string $value
     * @param null|int $postId
     */
    public function setValue($value, $postId = null)
    {
        if ($value === $this->value) {
            return;
        }
        $this->value = $value;
        $this->storage->save($this);
    }

    /**
     * @param null|int $postId
     * @return bool|null|string
     */
    public function getValue($postId = null)
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }
}
