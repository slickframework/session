<?php

/**
 * This file is part of slick/session package
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Slick\Session\Exception;

use LogicException;
use Slick\Session\Exception;

/**
 * Session Invalid Session Driver Class Exception
 * 
 * @package Slick\Session\Exception
 * @author  Filipe Silva <silvam.filipe@gmail.com>
 */
class InvalidSessionDriverClassException extends LogicException implements
    Exception
{

}