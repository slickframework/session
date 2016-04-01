<?php

/**
 * This file is part of slick/session package
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Slick\Tests\Session\Driver;

use PHPUnit_Framework_TestCase as TestCase;
use Slick\Session\Driver\Server;
use Slick\Session\SessionDriverInterface;

/**
 * Server session driver test case
 *
 * @package Slick\Tests\Session\Driver
 * @author  Filipe Silva <silvam.filipe@gmail.com>
 */
class ServerTest extends TestCase
{

    /**
     * @test
     * @runInSeparateProcess 
     */
    public function createDriver()
    {
        $driver = new Server(['domain' => 'example.com']);
        $this->assertInstanceOf(SessionDriverInterface::class, $driver);
    }
}
