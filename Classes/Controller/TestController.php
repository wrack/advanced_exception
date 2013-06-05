<?php
namespace EricDepta\AdvancedException\Controller;

/**
 *
 * @author Eric Depta
 * @package advanced_exception
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class TestController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {
	
	/**
	 * Throw Test Exception
	 *
	 * @throws \Exception
	 */
	public function showAction(){
		throw new \Exception('Advanced Exception Test Error');
	}
}
?>