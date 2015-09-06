<?php

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'VMeC.' . $_EXTKEY, 'CSVForms', array(
    'Form' => 'show, process',
        ),
        // non-cacheable actions
        array(
    'Form' => 'process',
        )
);
