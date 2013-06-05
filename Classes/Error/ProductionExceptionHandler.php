<?php
namespace EricDepta\AdvancedException\Error;

/**
 * @author Eric Depta
 */
class ProductionExceptionHandler extends \TYPO3\CMS\Core\Error\ProductionExceptionHandler {
	
	/**
	 * @return array
	 */
	protected function getSettings(){
		$objectManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Object\\ObjectManager');
		$configurationManager = $objectManager->get('TYPO3\\CMS\\Extbase\\Configuration\\ConfigurationManagerInterface');
		$configuration = $configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK, 'advanced_exception');
		return $configuration;
	}

	/**
	 * Echoes an exception for the web.
	 *
	 * @param Exception $exception The exception
	 * @return void
	 */
	public function echoExceptionWeb(\Exception $exception) {
		$this->writeLogEntries($exception, self::CONTEXT_WEB);

		$view = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('EricDepta\\AdvancedException\\View\\StandaloneView');

		$settings = $this->getSettings();

		$assign = array(
			'title' => $this->getTitle($exception),
			'message' => $this->getMessage($exception),
			'exception' => $exception,
			'baseurl' => \TYPO3\CMS\Core\Utility\GeneralUtility::getIndpEnv('TYPO3_SITE_URL'),
			'backurl' => \TYPO3\CMS\Core\Utility\GeneralUtility::getIndpEnv('TYPO3_REQUEST_URL'),
		);

		//-- Redirect --//
		if($settings['settings']['methode'] == 'redirect'){
			$rset = $settings['settings']['redirect'];
			if(!empty($rset['pageUid'])){
				$ss = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('EricDepta\\AdvancedException\\Service\\SessionService');
				$ss->writeToSession(serialize($assign));

				$uriBuilder = $view->getControllerContext()->getUriBuilder();
				\TYPO3\CMS\Core\Utility\HttpUtility::redirect(
					$uriBuilder->reset()->setTargetPageUid($rset['pageUid'])->setTargetPageType($rset['pageType'])->setNoCache($rset['noCache'])->setUseCacheHash(!((boolean)$rset['noCacheHash']))->setSection($rset['section'])->setArguments($rset['additionalParams'])->build()
				);
			}
		}

		//-- Custom Template --/
		if($settings['settings']['methode'] == 'template'){
			$vset = $settings['view'];
			$template = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($vset['templateRootPath']) . 'Exception.html';
			if(file_exists($template)){
				$view->setTemplatePathAndFilename($template);
				$view->setPartialRootPath(\TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($vset['partialRootPath']));
				$view->setLayoutRootPath(\TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($vset['layoutRootPath']));
				$view->getRequest()->setControllerExtensionName('advanced_exception');
				$view->setFormat('html');
				$view->assignMultiple($assign);
				echo $view->render();
				return;
			}
		}
		
		//-- Default --//
		parent::echoExceptionWeb($exception);
	}
}
?>