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
 * Session Server driver (Default php session handling)
 *
 * @package Slick\Session\Driver
 * @author  Filipe Silva <silvam.filipe@gmail.com>
 */
class Server extends Driver implements SessionDriverInterface
{

    /**
     * @var string Session cookie name
     */
    protected $name = 'SLICKSID';

    /**
     * @var string Session cookie domain
     */
    protected $domain = null;

    /**
     * @var integer Session cookie lifetime
     */
    protected $lifetime = 0;

    /**
     * Overrides base constructor to set parameters and initialize session.
     *
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        parent::__construct($options);

        session_set_cookie_params($this->lifetime, '/', $this->domain);
        session_name($this->name);
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }
}