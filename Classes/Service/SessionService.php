<?php
namespace EricDepta\AdvancedException\Service;

/**
 * @author Eric Depta
 */
class SessionService implements \TYPO3\CMS\Core\SingletonInterface {
	
	protected $name = 'advanced_exception';
	
	/**
	 * Returns the object stored in the user´s PHP session
	 * @return Object the stored object
	 */
	public function restoreFromSession() {
		$sessionData = $GLOBALS['TSFE']->fe_user->getKey('ses', $this->name);
		return unserialize($sessionData);
	}
 
	/**
	 * Writes an object into the PHP session
	 * @param	$object	any serializable object to store into the session
	 * @return	Tx_Akbevents_Domain_Session_SessionHandler this
	 */
	public function writeToSession($object) {
		$sessionData = serialize($object);
		$GLOBALS['TSFE']->fe_user->setKey('ses', $this->name, $sessionData);
		$GLOBALS['TSFE']->fe_user->storeSessionData();
		return $this;
	}
 
	/**
	 * Cleans up the session: removes the stored object from the PHP session
	 * @return	Tx_Akbevents_Domain_Session_SessionHandler this
	 */
	public function cleanUpSession() {
		$GLOBALS['TSFE']->fe_user->setKey('ses', $this->name, NULL);
		$GLOBALS['TSFE']->fe_user->storeSessionData();
		return $this;
	}
}
?>