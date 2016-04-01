<?php

/**
 * This file is part of slick/session package
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Slick\Tests\Session;

use PHPUnit_Framework_TestCase as TestCase;
use Slick\Session\Driver\Server;
use Slick\Session\Session;

/**
 * Session factory test case
 * 
 * @package Slick\Tests\Session
 * @author  Filipe Silva <silvam.filipe@gmail.com>
 */
class SessionTest extends TestCase
{

    /**
     * @test
     * @runInSeparateProcess 
     */
    public function createServerDriver()
    {
        $options = [
            'driver' => 'server',
            'options' => [
                'domain' => 'example.org'
            ]
        ];
        $driver = Session::create($options);
        $this->assertInstanceOf(Server::class, $driver);
    }

    /**
     * @test
     * @expectedException \Slick\Session\Exception\InvalidSessionDriverClassException
     */
    public function createInvalidClass()
    {
        Session::addClass('test', 'stdClass');
    }

    /**
     * @test
     * @expectedException \Slick\Session\Exception\DriverClassNotFoundException
     */
    public function createUnknownClass()
    {
        Session::create(['driver' => 'Libs\Shared\Session\Driver\Unknown']);
    }

    /**
     * @test
     * @runInSeparateProcess 
     */
    public function createCustomClass()
    {
        Session::addClass('test', MyDriver::class);
        $driver = Session::create(['driver' => 'test']);
        $this->assertInstanceOf(Server::class, $driver);
    }
    
}

/**
 * Class MyDriver
 * @package Slick\Tests\Session
 */
class MyDriver extends Server {
    
}