<?php
namespace EricDepta\AdvancedException\View;

/**
 * @author Eric Depta
 */
class StandaloneView extends \TYPO3\CMS\Fluid\View\StandaloneView {
	/**
	 * @return \TYPO3\CMS\Extbase\Mvc\Controller\ControllerContext
	 */
	public function getControllerContext(){
		return $this->controllerContext;
	}
}

?>