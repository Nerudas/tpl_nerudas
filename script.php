<?php
/**
 * @package    Nerudas Template
 * @version    4.9.1
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2017 Nerudas. All rights reserved.
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
		$this->update491($path);

		return true;
	}


	/**
	 * Update to 4.9.1 version
	 *
	 * @param string $path path to tempalte
	 *
	 * @since    4.9.1
	 */
	protected function update491($path)
	{
		// Delete index.html
		$index_files = JFolder::files($path, 'index.html', true, true);
		foreach ($index_files as $file)
		{
			JFile::delete($file);
		}
		// Delete Scripts folder
		JFolder::delete($path . '/scripts');

		// Delete jw_sigpro
		JFolder::delete($path . '/html/jw_sigpro');
	}

}