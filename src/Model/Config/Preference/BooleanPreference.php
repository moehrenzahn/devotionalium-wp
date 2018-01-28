<?php

namespace Devotionalium\Model\Config\Preference;

use Devotionalium\Model\Config\Preference;

/**
 * Class BooleanPreference
 *
 * @package Eule\Model\Config\Preference
 */
class BooleanPreference extends Preference
{
    const BOOL_TRUE = ['on', 'true', '1', 'yes', 1];

    const BOOL_FALSE = ['off', 'false', '0', 'no', 0];

    /**
     * @var boolean
     */
    public $value;

    /**
     * Resolve config value to boolean
     *
     * @param null|int $postId
     * @return bool|null
     */
    public function getValue($postId = null)
    {
        $result = parent::getValue($postId);
        if (is_bool($result)) {
            return $result;
        };
        if (is_null($result)) {
            return null;
        }
        if (in_array($result, self::BOOL_FALSE, true)) {
            return false;
        } elseif (in_array($result, self::BOOL_TRUE, true)) {
            return true;
        } else {
            return null;
        }
    }
}
