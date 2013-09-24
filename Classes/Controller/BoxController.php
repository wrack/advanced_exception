<?php
namespace EricDepta\AdvancedException\Controller;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

/**
 *
 * @author Eric Depta
 * @package advanced_exception
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class BoxController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {
	/**
	 * @var \EricDepta\AdvancedException\Service\SessionService
	 */
	protected $sessionService;
	
	/**
	 * @param \EricDepta\AdvancedException\Service\SessionService $sessionService
	 */
	public function injectSessionService(\EricDepta\AdvancedException\Service\SessionService $sessionService) {
		$this->sessionService = $sessionService;
	}
	
	/**
	 * Show Error Box
	 *
	 * @return void
	 */
	public function showAction(){
		$assign = unserialize($this->sessionService->restoreFromSession());
		if(is_array($assign)){
			$this->view->assignMultiple($assign);
			$this->view->assign('Error',1);
		}else{
			$this->view->assign('noError',1);
		}
		$this->sessionService->cleanUpSession();
	}
}
?>