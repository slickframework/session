<?php

/**
 * This file is part of slick/session package
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Slick\Session\Driver;

use Slick\Session\SessionDriverInterface;

/**
 * Session driver, base class for all session drivers
 *
 * @package Slick\Session\Driver
 * @author  Filipe Silva <silvam.filipe@gmail.com>
 */
abstract class Driver implements SessionDriverInterface
{

    /**
     * @var string Session prefix on key names
     */
    protected $prefix;

    /**
     * Driver constructor.
     * 
     * The $options parameter is an associative array where key will be matched
     * with the driver property and if property exists the correspondent value
     * will be assigned.
     * 
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        foreach ($options as $name => $option) {
            if (property_exists($this, $name)) {
                $this->{$name} = $option;
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function set($key, $value)
    {
        $prefix = $this->prefix;
        $_SESSION[$prefix.$key] = $value;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function get($key, $default = null)
    {
        $key = $this->prefix.$key;
        $value = $default;
        if (array_key_exists($key, $_SESSION)) {
            $value = $_SESSION[$key];
        }
        return $value;
    }

    /**
     * {@inheritdoc}
     */
    public function erase($key)
    {
        $prefix = $this->prefix;
        unset($_SESSION[$prefix.$key]);
        return $this;
    }

    /**
     * Sets the prefix for session key names
     * 
     * @param string $prefix
     * 
     * @return $this
     */
    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;
        return $this;
    }
}