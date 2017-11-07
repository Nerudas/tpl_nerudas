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

function modChrome_default($module, &$params, &$attribs)
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
		$class  = 'module-' . $module->id . ' ' . $params->get('moduleclass_sfx');
		echo '<li class="' . $class . '">';
		echo '<a>' . $module->title . '<i data-uk-icon="icon: chevron-down; ratio: 0.8"></i>' . '</a>';
		echo '<div data-uk-dropdown="mode: click">' . $module->content . '</div>';
		echo '</li>';
	}
}

function modChrome_toppanel_right($module, &$params, &$attribs)
{
	if ($module->content)
	{
		$params = new Registry($params);
		$class  = 'module-' . $module->id . ' ' . $params->get('moduleclass_sfx');
		echo '<li class="' . $class . '">' . $module->content . '</li>';;
	}
}

function modChrome_sidebar_right($module, &$params, &$attribs)
{
	if ($module->content)
	{
		$params = new Registry($params);
		$class  = 'module-' . $module->id . ' ' . $params->get('moduleclass_sfx');
		echo $module->content;
	}
}

function modChrome_sidebar_left($module, &$params, &$attribs)
{
	if ($module->content)
	{
		$params = new Registry($params);
		$class  = 'module-' . $module->id . ' ' . $params->get('moduleclass_sfx');
		echo $module->content;
	}
}