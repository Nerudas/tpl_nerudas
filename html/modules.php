<?php
/**
 * @package    Nerudas Template
 * @version    5.0.0
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2017 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;

use Joomla\Registry\Registry;

function modChrome_no($module, &$params, &$attribs)
{
	if ($module->content)
	{
		echo $module->content;
	}
}

function modChrome_toppanel_center($module, &$params, &$attribs)
{
	if ($module->content)
	{
		$params = new Registry($params);
		$class  = 'item-' . $module->id;
		$class  .= ' level-1';
		$class  .= ' ' . $params->get('moduleclass_sfx');
		$class  .= ' uk-height-1-1';

		echo '<li class="' . $class . '">';
		echo '<a class="uk-flex uk-flex-center uk-flex-middle uk-height-1-1">' . $module->title
			. '<i data-uk-icon="icon: chevron-down; ratio: 0.8" class="uk-margin-small-left"></i>' . '</a>';
		echo '<div data-uk-dropdown="mode: click">' . $module->content . '</div>';
		echo '</li>';
		//echo '<pre>', print_r($module, true), '</pre>';
		//echo ;
	}
}