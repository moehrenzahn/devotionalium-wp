<?php

namespace Devotionalium\Model\Config\Preference;

use Devotionalium\Model\Config\Preference;
use Devotionalium\Model\Storage\StorageInterface;

/**
 * Class SelectPreference
 *
 * @package Devotionalium\Model\Config\Preference
 */
class SelectPreference extends Preference
{
    /**
     * string[]
     */
    public $options;

    /**
     * @var string
     */
    public $value;

    /**
     * SelectPreference constructor.
     *
     * @param StorageInterface $storage
     * @param string $slug
     * @param string $title
     * @param array $options
     * @param string $description
     */
    public function __construct(
        StorageInterface $storage,
        $slug,
        $title,
        array $options,
        $description = ''
    ) {
        $this->options = $options;
        parent::__construct($storage, $slug, $title, $description);
    }

    /**
     * @param bool|string $value
     * @param int $postId
     */
    public function setValue($value, $postId = 0)
    {
        if (in_array($value, array_keys($this->options))) {
            parent::setValue($value, $postId);
        }
    }
}
