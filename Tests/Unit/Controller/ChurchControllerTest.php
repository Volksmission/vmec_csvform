<?php
namespace VMeC\VmecChurches\Tests\Unit\Controller;
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
 * Test case for class VMeC\VmecChurches\Controller\ChurchController.
 *
 * @author Christoph Fischer <christoph.fischer@volksmission.de>
 */
class ChurchControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {

	/**
	 * @var \VMeC\VmecChurches\Controller\ChurchController
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = $this->getMock('VMeC\\VmecChurches\\Controller\\ChurchController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllChurchesFromRepositoryAndAssignsThemToView() {

		$allChurches = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$churchRepository = $this->getMock('VMeC\\VmecChurches\\Domain\\Repository\\ChurchRepository', array('findAll'), array(), '', FALSE);
		$churchRepository->expects($this->once())->method('findAll')->will($this->returnValue($allChurches));
		$this->inject($this->subject, 'churchRepository', $churchRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('churches', $allChurches);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenChurchToView() {
		$church = new \VMeC\VmecChurches\Domain\Model\Church();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('church', $church);

		$this->subject->showAction($church);
	}
}
