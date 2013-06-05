<?php
if (!defined('TYPO3_MODE')) die ('Access denied.');
$GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects']['TYPO3\\CMS\\Core\\Error\\ProductionExceptionHandler'] = array('className' => 'EricDepta\\AdvancedException\\Error\\ProductionExceptionHandler');
//$GLOBALS['TYPO3_CONF_VARS']['SYS']['productionExceptionHandler'] = 'EricDepta\\AdvancedException\\Error\\ProductionExceptionHandler'; // does only work if you put it into localconf

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'EricDepta.' . $_EXTKEY,
	'ExceptionBox',
	array(
		'Box' => 'show',
	),
	array(
		'Box' => 'show',
	)	
);
?>
