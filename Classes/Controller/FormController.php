<?php

namespace VMeC\VmecCsvform\Controller;

/* * *************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2014 Christoph Fischer <christoph.fischer@volksmission.de>, Volksmission entschiedener Christen e.V.
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
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
 * ************************************************************* */

/**
 * FormController
 */
class FormController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * action show
     *
     * @return void
     */
    public function showAction()
    {
        
    }

    /**
     * action process
     *
     * @return void
     */
    public function processAction()
    {
        $arguments = $this->request->getArguments();
        $fields = explode(',', $this->settings['csvFields']);
        $csv = array();
        $header = array();

        // create csv contents
        foreach ($fields as $field) {
            $o = $arguments[$field];
            if (!is_numeric($o))
                $o = '"' . $o . '"';
            $csv[$field] = $o;
            $header[$field] = '"' . str_replace('_', ' ', $field) . '"';
        }

        // write to CSV
        $csvFile = PATH_site . $this->settings['csvPath'];
        $fileExists = file_exists($csvFile);
        $fp = fopen($csvFile, 'a');
        if (!$fileExists)
            fwrite($fp, join(';', $header) . "\r\n");
        fwrite($fp, join(';', $csv) . "\r\n");
        fclose($fp);


        // registration email
        if ($this->settings['emailRegister'])
            $this->sendTemplateEmail(array($this->settings['emailRegister']), array($this->settings['emailSenderAddress'] => $this->settings['emailSenderName']), $this->settings['emailRegisterSubject'], 'Anmeldung', array(
                'arguments' => $arguments, 'settings' => $this->settings));

        if ($this->settings['emailConfirmField'])
            if ($arguments[$this->settings['emailConfirmField']])
                $this->sendTemplateEmail(array($arguments[$this->settings['emailConfirmField']]), array(
                    $this->settings['emailSenderAddress'] => $this->settings['emailSenderName']), $this->settings['emailConfirmSubject'], 'Bestaetigung', array(
                    'arguments' => $arguments, 'settings' => $this->settings));



        // pass to view
        $this->view->assign('csvFile', $csvFile);
        $this->view->assign('header', $header);
        $this->view->assign('fields', $fields);
        $this->view->assign('csv', $csv);
        $this->view->assign('arguments', $arguments);
    }

    /**
     * Send an email from a fluid template
     *
     * @param array $recipient recipient of the email in the format array('recipient@domain.tld' => 'Recipient Name')
     * @param array $sender sender of the email in the format array('sender@domain.tld' => 'Sender Name')
     * @param string $subject subject of the email
     * @param string $templateName template name (UpperCamelCase)
     * @param array $variables variables to be passed to the Fluid view
     * @return boolean TRUE on success, otherwise false
     */
    protected function sendTemplateEmail(array $recipient, array $sender, $subject, $templateName, array $variables = array())
    {
        $emailView = $this->objectManager->get('TYPO3\\CMS\\Fluid\\View\\StandaloneView');

        // set correct extension name
        $emailView->getRequest()->setControllerExtensionName($this->request->getControllerExtensionName());

        $extbaseFrameworkConfiguration = $this->configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);
        $templateRootPath = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($extbaseFrameworkConfiguration['view']['templateRootPath']);
        //die ($templateRootPath);
        $templatePathAndFilename = $templateRootPath . '/Email/' . $templateName . '.html';
        $emailView->setTemplatePathAndFilename($templatePathAndFilename);
        $emailView->assignMultiple($variables);
        $emailBody = $emailView->render();

        $message = $this->objectManager->get('TYPO3\\CMS\\Core\\Mail\\MailMessage');
        $message->setTo($recipient)
                ->setFrom($sender)
                ->setSubject($subject);

        // Possible attachments here
        //foreach ($attachments as $attachment) {
        //	$message->attach($attachment);
        //}
        // Plain text example
        //$message->setBody($emailBody, 'text/plain');
        // HTML Email
        $message->setBody($emailBody, 'text/html');

        $message->send();
        return $message->isSent();
    }

}
