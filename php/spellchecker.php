<?php
/**
 * Spellchecker class
 *
 * @package    jQuery Spellchecker (https://github.com/badsyntax/jquery-spellchecker)
 * @category   Core
 * @author     Richard Willis
 * @copyright  (c) Richard Willis
 * @license    MIT
 */

ini_set('display_errors', 1);

class SpellChecker {

	public function __construct()
	{
		if (!$_POST)
		{
			exit;
		}

		$driver = $_POST['driver'];
		$action = $_POST['action'];

		if (!$driver)
		{
			exit('Driver not found');
		}

		if (!$action)
		{
			exit('Action not found');
		}

		$this->load_driver($driver);
		$this->execute_action($action);
	}

	public function load_driver($driver = NULL)
	{
		require_once 'spellchecker/driver.php';
		require_once 'spellchecker/driver/'.strtolower($driver).'.php';

		$spellchecker_driver = 'Spellchecker_Driver_'.ucfirst($driver);
		
		$this->driver = new $spellchecker_driver;
	}

	public function execute_action($action = NULL)
	{
		if (!method_exists($this->driver, $action))
		{
			die('Action does not exist');
		}

		$this->driver->{$action}();
	}
}

new SpellChecker();