<?php
if (!defined('TYPO3_MODE'))	die ('Access denied.');

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	$_EXTKEY,
	'ExceptionBox',
	'Advanced Exception Box'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	$_EXTKEY,
	'ExceptionTest',
	'Advanced Exception Tester'
);
?>
