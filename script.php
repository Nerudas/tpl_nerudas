<?php
/**
 * @package    Nerudas Template
 * @version    4.9.27
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;

class nerudasInstallerScript
{
	/**
	 * Runs right after any installation action is preformed on the component.
	 *
	 * @param  string $type      Type of PostFlight action. Possible values are:
	 *                           - * install
	 *                           - * update
	 *                           - * discover_install
	 * @param         $parent    Parent object calling object.
	 *
	 * @return bool
	 *
	 * @since    4.9.1
	 */
	function postflight($type, $parent)
	{
		$path = JPATH_SITE . '/templates/nerudas';

		return true;
	}

	/**
	 * Runs right after any installation action is preformed on the component.
	 *
	 * @param  string $type      Type of PostFlight action. Possible values are:
	 *                           - * install
	 *                           - * update
	 *                           - * discover_install
	 * @param         $parent    Parent object calling object.
	 *
	 * @return bool
	 *
	 * @since    4.9.6
	 */
	function preflight($type, $parent)
	{
		$path = JPATH_SITE . '/templates/nerudas';
		if (JFolder::exists($path))
		{
			JFolder::delete($path);
		}

		return true;
	}

}