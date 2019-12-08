<?php
/**
 * @copyright  Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

namespace Joomla\Http\Tests;

use Joomla\Http\Http;
use Joomla\Http\HttpFactory;
use Joomla\Http\TransportInterface;
use PHPUnit\Framework\TestCase;

/**
 * Test class for Joomla\Http\HttpFactory.
 */
class HttpFactoryTest extends TestCase
{
	/**
	 * Object being tested
	 *
	 * @var  HttpFactory
	 */
	private $instance;

	/**
	 * Sets up the fixture, for example, open a network connection.
	 *
	 * @return  void
	 */
	protected function setUp(): void
	{
		parent::setUp();

		$this->instance = new HttpFactory;
	}

	/**
	 * Tests the getHttp method.
	 *
	 * @covers  Joomla\Http\HttpFactory::getHttp
	 */
	public function testGetHttp()
	{
		$this->assertInstanceOf(
			Http::class,
			$this->instance->getHttp()
		);
	}

	/**
	 * Tests the getHttp method to ensure only arrays or ArrayAccess objects are allowed
	 *
	 * @covers  Joomla\Http\HttpFactory::getHttp
	 */
	public function testGetHttpDisallowsNonArrayObjects()
	{
		$this->expectException(\InvalidArgumentException::class);

		$this->instance->getHttp(new \stdClass);
	}

	/**
	 * Tests the getHttp method.
	 *
	 * @covers  Joomla\Http\HttpFactory::getHttp
	 */
	public function testGetHttpException()
	{
		$this->expectException(\RuntimeException::class);

		$this->assertInstanceOf(
			Http::class,
			$this->instance->getHttp([], [])
		);
	}

	/**
	 * Tests the getAvailableDriver method.
	 *
	 * @covers  Joomla\Http\HttpFactory::getAvailableDriver
	 */
	public function testGetAvailableDriver()
	{
		$this->assertInstanceOf(
			TransportInterface::class,
			$this->instance->getAvailableDriver([], null)
		);

		$this->assertFalse(
			$this->instance->getAvailableDriver([], []),
			'Passing an empty array should return false due to there being no adapters to test'
		);

		$this->assertFalse(
			$this->instance->getAvailableDriver([], ['fopen']),
			'A false should be returned if a class is not present or supported'
		);

		include_once __DIR__ . '/stubs/DummyTransport.php';

		$this->assertFalse(
			$this->instance->getAvailableDriver([], ['DummyTransport']),
			'Passing an empty array should return false due to there being no adapters to test'
		);
	}

	/**
	 * Tests the getAvailableDriver method to ensure only arrays or ArrayAccess objects are allowed
	 *
	 * @covers  Joomla\Http\HttpFactory::getAvailableDriver
	 */
	public function testGetAvailableDriverDisallowsNonArrayObjects()
	{
		$this->expectException(\InvalidArgumentException::class);

		$this->instance->getAvailableDriver(new \stdClass);
	}

	/**
	 * Tests the getHttpTransports method.
	 *
	 * @covers  Joomla\Http\HttpFactory::getHttpTransports
	 */
	public function testGetHttpTransports()
	{
		$transports = ['Stream', 'Socket', 'Curl'];
		sort($transports);

		$this->assertEquals(
			$transports,
			$this->instance->getHttpTransports()
		);
	}
}
