<?php
/**
 * @package    Nerudas Template
 * @version    4.9.40
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;

use Joomla\Registry\Registry;

// Blank
function modChrome_blank($module, &$params, &$attribs)
{
	if ($module->content)
	{
		echo $module->content;
	}
}

// home
function modChrome_home($module, &$params, &$attribs)
{
	if ($module->content)
	{
		echo '<div id="mod-' . $module->id . '" class="module ' . htmlspecialchars($params->get('moduleclass_sfx')) . '">';
		if ($module->showtitle)
		{
			echo '<h3 class="uk-margin-small-bottom">' . $module->title . '</h3>';
		}
		echo $module->content;
		echo '</div>';
	}
}

// Sidebar
function modChrome_sidebar($module, &$params, &$attribs)
{
	if ($module->content)
	{
		echo '<div id="mod-' . $module->id . '" class="module uk-panel uk-panel-box uk-panel-box-min uk-margin-bottom' . htmlspecialchars($params->get('moduleclass_sfx')) . '">';
		if ($module->showtitle)
		{
			echo '<h3 class="uk-margin-small-bottom">' . $module->title . '</h3>';
		}
		echo $module->content;
		echo '</div>';
	}
}


// Mobile
function modChrome_mobile($module, &$params, &$attribs)
{
	if ($module->content)
	{
		echo '<div id="mod-' . $module->id . '" class="module uk-margin-bottom' . htmlspecialchars($params->get('moduleclass_sfx')) . '">';
		if ($module->showtitle)
		{
			echo '<div class="uk-margin-small-bottom uk-margin-small-left uk-margin-top uk-contrast uk-h4">' . $module->title . '</div>';
		}
		echo $module->content;
		echo '</div>';
	}
}


// Sidebar NEW
function modChrome_sidebar_new($module, &$params, &$attribs)
{
	echo '<div id="mod-' . $module->id . '" class="module uk-width-small-1-2 uk-width-medium-1-2 uk-width-large-1-1 '
		. htmlspecialchars($params->get('moduleclass_sfx')) . '"><div class="uk-panel uk-panel-box">';

	if ($module->showtitle)
	{
		echo '<div class="module-title"><span>' . $module->title . '</span></div>';
	}

	echo '<div class="module-content">' . $module->content . '</div>';
	echo '</div></div>';
}

// Footer
function modChrome_footer($module, &$params, &$attribs)
{
	echo '<div id="mod-' . $module->id . '" class="module' . htmlspecialchars($params->get('moduleclass_sfx')) . '">';
	if ($module->showtitle)
	{
		echo '<div class="title uk-h3 uk-margin-small-bottom">' . $module->title . '</div>';
	}
	echo '<div class="content">' . $module->content . '</div>';
	echo '</div>';
}

// Top - Panel Center
function modChrome_toppanel_center($module, &$params, &$attribs)
{
	if ($module->content)
	{
		$params = new Registry($params);
		$class  = 'module-' . $module->id . ' ' . $params->get('moduleclass_sfx');
		echo '<li class="' . $class . '" data-uk-dropdown="{mode:\'click\'}">';
		echo '<a>' . $module->title . '<i class="uk-icon-angle-down uk-margin-left"></i>' . '</a>';
		echo '<div class="uk-dropdown ">' . $module->content . '</div>';
		echo '</li>';
	}
}

// Top - Panel Right
function modChrome_toppanel_right($module, &$params, &$attribs)
{
	if ($module->content)
	{
		$params = new Registry($params);
		$class  = 'module-' . $module->id . ' ' . $params->get('moduleclass_sfx');
		echo '<li class="' . $class . '"  data-uk-dropdown="{mode:\'click\', pos:\'bottom-right\'}">' . $module->content . '</li>';
	}
}

// Top - Panel Mobile
function modChrome_toppanel_mobile($module, &$params, &$attribs)
{
	echo '<div class="module mod_' . $module->id . '' . htmlspecialchars($params->get('moduleclass_sfx')) . '">';
	if ($module->showtitle)
	{
		echo '<div class="module-title"  data-uk-toggle="{target:\'.mod_' . $module->id . '\', 
		cls:\'show\'}">';

		echo '<span>' . $module->title . '</span>';
		echo '<i class="uk-icon-angle-down uk-icon-small"></i>';
		echo '<i class="uk-icon-angle-up uk-icon-small"></i>';
		echo '</div>';
	}
	echo '<div class="module-content">' . $module->content . '</div>';
	echo '</div>';
}

