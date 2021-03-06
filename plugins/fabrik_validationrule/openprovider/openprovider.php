<?php
/**
 * Domain name look up against open provider service
 *
 * @package     Joomla.Plugin
 * @subpackage  Fabrik.validationrule.openprodiver
 * @copyright   Copyright (C) 2005 Fabrik. All rights reserved.
 * @license     http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

// Require the abstract plugin class
require_once COM_FABRIK_FRONTEND . '/models/validation_rule.php';

// Require the Open Provider API
require_once JPATH_SITE . '/plugins/fabrik_validationrule/openprovider/api.php';

/**
 * Domain name look up against open provider service
 *
 * @package     Joomla.Plugin
 * @subpackage  Fabrik.validationrule.openprodiver
 * @since       3.0
 */

class PlgFabrik_ValidationruleOpenprovider extends PlgFabrik_Validationrule
{

	/**
	 * Plugin name
	 *
	 * @var string
	 */
	protected $pluginName = 'openprovider';

	/**
	 * Validate the elements data against the rule
	 *
	 * @param   string  $data           To check
	 * @param   object  &$elementModel  Element Model
	 * @param   int     $pluginc        Plugin sequence ref
	 * @param   int     $repeatCounter  Repeat group counter
	 *
	 * @return  bool  true if validation passes, false if fails
	 */

	public function validate($data, &$elementModel, $pluginc, $repeatCounter)
	{
		$params = $this->getParams();
		$username = (array) $params->get('openprovider_username', array());
		$username = $username[$pluginc];
		$password = (array) $params->get('openprovider_password', array());
		$password = $password[$pluginc];
		$data = strtolower($data);

		// Strip www. from front
		if (substr($data, 0, 4) == 'www.')
		{
			$data = substr($data, 4, strlen($data));
		}
		list($domain, $extension) = explode('.', $data, 2);

		$api = new OP_API('https://api.openprovider.eu');

		$args = array(
			'domains' => array(
				array(
					'name' => $domain,
					'extension' => $extension
				)
			)
		);
		$request = new OP_Request;
		$request->setCommand('checkDomainRequest')
		->setAuth(array('username' => $username, 'password' => $password))
		->setArgs($args);

		$reply = $api->setDebug(0)->process($request);
		$res = $reply->getValue();
		return $res[0]['status'] === 'active' ? false : true;
	}

}
