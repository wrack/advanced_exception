<?php
namespace EricDepta\AdvancedException\Controller;

/**
 *
 * @author Eric Depta
 * @package advanced_exception
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class BoxController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {
	/**
	 * @var \HoA\Stagedeal\Service\TransloaditService
	 */
	protected $transloaditService;

	/**
	 * @param \HoA\Stagedeal\Service\TransloaditService $transloaditService
	 */
	public function injectTransloaditService(\HoA\Stagedeal\Service\TransloaditService $transloaditService) {
		$this->transloaditService = $transloaditService;
	}

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
	

	public function showAction(){
		$assign = unserialize($this->sessionService->restoreFromSession());
		if(is_array($assign)){
			$this->view->assignMultiple(unserialize($this->sessionService->restoreFromSession()));
		}else{
			$this->view->assign('noError',1);
		}
		//$this->sessionService->cleanUpSession();
	}
}
?>