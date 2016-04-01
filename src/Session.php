<?php

/**
 * This file is part of slick/session package
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Slick\Session;

use Slick\Common\Base;
use Slick\Session\Driver\Server;
use Slick\Session\Exception\DriverClassNotFoundException;
use Slick\Session\Exception\InvalidSessionDriverClassException;

/**
 * Session session factory
 *
 * @package Slick\Session
 * @author  Filipe Silva <silvam.filipe@gmail.com>
 */
final class Session extends Base
{

    /**
     * @readwrite
     * @var string FQ driver class name or alias
     */
    protected $driver = 'server';

    /**
     * @readwrite
     * @var array Driver initialization options
     */
    protected $options = [];

    /**
     * @var array List of known session drivers
     */
    private static $knownDrivers = [
        'server' => Server::class
    ];

    /**
     * Sets a custom driver class to session factory
     * 
     * @param string $alias
     * @param string $className
     */
    public static function addClass($alias, $className)
    {
        self::$knownDrivers[$alias] = self::checkClass($className);
    }

    /**
     * Creates a session driver with  provided options
     * 
     * @param array $options
     * @return SessionDriverInterface
     */
    public static function create(array $options = [])
    {
        $factory = new static($options);
        return $factory->getDriver();
    }

    /**
     * Creates the driver for current 
     * 
     * @return SessionDriverInterface
     */
    public function getDriver()
    {
        $className = $this->getClassName($this->driver);
        return new $className($this->options);
    }

    /**
     * Verifies and returns the FQ session driver class name
     * 
     * @param string $alias
     * @return string
     */
    private function getClassName($alias)
    {
        $className = array_key_exists($alias, self::$knownDrivers)
            ? self::$knownDrivers[$alias]
            : self::checkClass($alias);
        
        return $className;
    }

    /**
     * Check if provided class exists and implements SessionDriverInterface
     * 
     * @param string $className
     * 
     * @return string
     */
    private static function checkClass($className)
    {
        if (! class_exists($className)) {
            throw new DriverClassNotFoundException(
                "The session driver class {$className} was not found."
            );
        }

        if (! is_subclass_of($className, SessionDriverInterface::class)) {
            $itf = SessionDriverInterface::class;
            throw new InvalidSessionDriverClassException(
                "The class provided does not implements the '{$itf}' interface"
            );
        }
        
        return $className;
    }
}