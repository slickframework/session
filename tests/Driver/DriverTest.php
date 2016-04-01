<?php

/**
 * This file is part of slick/session package
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Slick\Tests\Session\Driver;

use PHPUnit_Framework_TestCase as TestCase;
use PHPUnit_Framework_MockObject_MockObject as MockObject;
use Slick\Session\Driver\Driver;

/**
 * Driver Test case
 *
 * @package Slick\Tests\Session\Driver
 * @author  Filipe Silva <silvam.filipe@gmail.com>
 */
class DriverTest extends TestCase
{

    /**
     * @var Driver|MockObject
     */
    protected $driver;

    /**
     * Sets the SUT driver object
     */
    protected function setUp()
    {
        parent::setUp();
        $this->driver = $this->getMockBuilder(Driver::class)
            ->getMockForAbstractClass();
    }

    /**
     * Clean after each test
     */
    protected function tearDown()
    {
        $_SESSION = [];
        $this->driver = null;
        parent::tearDown();
    }

    /**
     * Should use the super global $_SESSION to store a value
     * @test
     */
    public function setAValue()
    {
        $this->driver
            ->setPrefix('test_')
            ->set('test', 'test2');
        $this->assertEquals($_SESSION['test_test'], 'test2');
    }

    /**
     * Should retrieve a values previously save in $_SESSION super global
     * @test
     */
    public function getAValue()
    {
        $_SESSION['test'] = 'value';
        $this->assertEquals('value', $this->driver->get('test'));
    }

    /**
     * Should return the passed default value if the key is not found
     * @test
     */
    public function getDefaultValue()
    {
        $this->assertFalse($this->driver->get('test1', false));
    }

    /**
     * Should clear the value stored under provided key
     * @test
     */
    public function eraseValue()
    {
        $_SESSION['test'] = 'value';
        $this->driver->erase('test');
        $this->assertEmpty($_SESSION);
    }
}
