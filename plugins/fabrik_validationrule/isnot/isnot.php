<?php
/**
 * Is Not Validation Rule
 *
 * @package     Joomla.Plugin
 * @subpackage  Fabrik.validationrule.isnot
 * @copyright   Copyright (C) 2005 Fabrik. All rights reserved.
 * @license     http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 */

// Check to ensure this file is included in Joomla!

defined('_JEXEC') or die();

// Require the abstract plugin class
require_once COM_FABRIK_FRONTEND . '/models/validation_rule.php';

/**
 * Is Not Validation Rule
 *
 * @package     Joomla.Plugin
 * @subpackage  Fabrik.validationrule.isnot
 * @since       3.0
 */

class PlgFabrik_ValidationruleIsNot extends PlgFabrik_Validationrule
{

	/**
	 * Plugin name
	 *
	 * @var string
	 */
	protected $pluginName = 'isnot';

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
		if (is_array($data))
		{
			$data = implode('', $data);
		}
		$params = $this->getParams();
		$isnot = $params->get('isnot-isnot');
		$isnot = $isnot[$pluginc];
		$isnot = explode('|', $isnot);
		foreach ($isnot as $i)
		{
			if ((string) $data === (string) $i)
			{
				return false;
			}
		}
		return true;
	}

	/**
	 * Gets the hover/alt text that appears over the validation rule icon in the form
	 *
	 * @param   object  $elementModel  Element model
	 * @param   int     $pluginc       Validation render order
	 *
	 * @return  string	label
	 */

	protected function getLabel($elementModel, $pluginc)
	{
		$params = $this->getParams();
		$isnot = $params->get('isnot-isnot');
		return JText::sprintf('PLG_VALIDATIONRULE_ISNOT_LABEL', $isnot[$pluginc]);
	}
}
