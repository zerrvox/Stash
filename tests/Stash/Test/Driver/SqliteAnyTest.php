<?php

/*
 * This file is part of the Stash package.
 *
 * (c) Robert Hafner <tedivm@tedivm.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Stash\Test\Driver;

use Stash\Driver\Sqlite;
use Stash\Item;
use Stash\Utilities;

/**
 * @package Stash
 * @author  Robert Hafner <tedivm@tedivm.com>
 */
class SqliteAnyTest extends \PHPUnit_Framework_TestCase
{
    protected $driverClass = 'Stash\Driver\Sqlite';

    protected function setUp()
    {
        $driverClass = $this->driverClass;

        if (!$driverClass::isAvailable()) {
            $this->markTestSkipped('Driver class unsuited for current environment');

            return;
        }
    }

    public function testConstruction()
    {
        $key = array('apple', 'sauce');

        $options = array();
        $driver = new Sqlite($options);

        $stash = new Item();
        $stash->setDriver($driver);
        $stash->setKey($key);
        $this->assertTrue($stash->set($key), 'Able to load and store with unconfigured extension.');
    }

    public static function tearDownAfterClass()
    {
        Utilities::deleteRecursive(Utilities::getBaseDirectory());
    }
}
