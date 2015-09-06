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
 * Test case for class \VMeC\VmecChurches\Domain\Model\Church.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Christoph Fischer <christoph.fischer@volksmission.de>
 */
class ChurchTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \VMeC\VmecChurches\Domain\Model\Church
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = new \VMeC\VmecChurches\Domain\Model\Church();
	}

	protected function tearDown() {
		unset($this->subject);
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
	public function getNameReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getName()
		);
	}

	/**
	 * @test
	 */
	public function setNameForStringSetsName() {
		$this->subject->setName('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'name',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getUrlReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getUrl()
		);
	}

	/**
	 * @test
	 */
	public function setUrlForStringSetsUrl() {
		$this->subject->setUrl('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'url',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getImageReturnsInitialValueForFileReference() {
		$this->assertEquals(
			NULL,
			$this->subject->getImage()
		);
	}

	/**
	 * @test
	 */
	public function setImageForFileReferenceSetsImage() {
		$fileReferenceFixture = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
		$this->subject->setImage($fileReferenceFixture);

		$this->assertAttributeEquals(
			$fileReferenceFixture,
			'image',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getLocationReturnsInitialValueForAddress() {
		$this->assertEquals(
			NULL,
			$this->subject->getLocation()
		);
	}

	/**
	 * @test
	 */
	public function setLocationForAddressSetsLocation() {
		$locationFixture = new \VMeC\VmecChurches\Domain\Model\Address();
		$this->subject->setLocation($locationFixture);

		$this->assertAttributeEquals(
			$locationFixture,
			'location',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getOfficeReturnsInitialValueForAddress() {
		$this->assertEquals(
			NULL,
			$this->subject->getOffice()
		);
	}

	/**
	 * @test
	 */
	public function setOfficeForAddressSetsOffice() {
		$officeFixture = new \VMeC\VmecChurches\Domain\Model\Address();
		$this->subject->setOffice($officeFixture);

		$this->assertAttributeEquals(
			$officeFixture,
			'office',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getLeadersReturnsInitialValueForLeader() {
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getLeaders()
		);
	}

	/**
	 * @test
	 */
	public function setLeadersForObjectStorageContainingLeaderSetsLeaders() {
		$leader = new \VMeC\VmecChurches\Domain\Model\Leader();
		$objectStorageHoldingExactlyOneLeaders = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneLeaders->attach($leader);
		$this->subject->setLeaders($objectStorageHoldingExactlyOneLeaders);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneLeaders,
			'leaders',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addLeaderToObjectStorageHoldingLeaders() {
		$leader = new \VMeC\VmecChurches\Domain\Model\Leader();
		$leadersObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$leadersObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($leader));
		$this->inject($this->subject, 'leaders', $leadersObjectStorageMock);

		$this->subject->addLeader($leader);
	}

	/**
	 * @test
	 */
	public function removeLeaderFromObjectStorageHoldingLeaders() {
		$leader = new \VMeC\VmecChurches\Domain\Model\Leader();
		$leadersObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$leadersObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($leader));
		$this->inject($this->subject, 'leaders', $leadersObjectStorageMock);

		$this->subject->removeLeader($leader);

	}
}
