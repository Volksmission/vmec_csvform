<?php

namespace VMeC\VmecChurches\Tests\Unit\Domain\Model;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2014 Christoph Fischer <christoph.fischer@volksmission.de>, Volksmission entschiedener Christen e.V.
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * Test case for class \VMeC\VmecChurches\Domain\Model\Address.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Christoph Fischer <christoph.fischer@volksmission.de>
 */
class AddressTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \VMeC\VmecChurches\Domain\Model\Address
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = new \VMeC\VmecChurches\Domain\Model\Address();
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getStreetReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getStreet()
		);
	}

	/**
	 * @test
	 */
	public function setStreetForStringSetsStreet() {
		$this->subject->setStreet('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'street',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getZipReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getZip()
		);
	}

	/**
	 * @test
	 */
	public function setZipForStringSetsZip() {
		$this->subject->setZip('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'zip',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getCityReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getCity()
		);
	}

	/**
	 * @test
	 */
	public function setCityForStringSetsCity() {
		$this->subject->setCity('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'city',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getGeoLatReturnsInitialValueForFloat() {
		$this->assertSame(
			0.0,
			$this->subject->getGeoLat()
		);
	}

	/**
	 * @test
	 */
	public function setGeoLatForFloatSetsGeoLat() {
		$this->subject->setGeoLat(3.14159265);

		$this->assertAttributeEquals(
			3.14159265,
			'geoLat',
			$this->subject,
			'',
			0.000000001
		);
	}

	/**
	 * @test
	 */
	public function getGeoLongReturnsInitialValueForFloat() {
		$this->assertSame(
			0.0,
			$this->subject->getGeoLong()
		);
	}

	/**
	 * @test
	 */
	public function setGeoLongForFloatSetsGeoLong() {
		$this->subject->setGeoLong(3.14159265);

		$this->assertAttributeEquals(
			3.14159265,
			'geoLong',
			$this->subject,
			'',
			0.000000001
		);
	}
}
