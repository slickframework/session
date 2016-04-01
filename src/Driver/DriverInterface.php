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
 * Interface for Session driver (Backward compatibility)
 *
 * @package Slick\Session\Driver
 * @author  Filipe Silva <silvam.filipe@gmail.com>
 *
 * @deprecated You should use Slick\Session\SessionDriverInterface
 */
interface DriverInterface extends SessionDriverInterface
{

}