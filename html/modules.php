<?php
/**
 * @package    Nerudas Template
 * @version    4.9.4
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2017 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;
// Blank
function modChrome_blank($module, &$params, &$attribs)
{
	if ($module->content)
	{
		echo $module->content;
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

// home
function modChrome_home($module, &$params, &$attribs)
{
	if ($module->content)
	{
		echo '<div id="mod-' . $module->id . '" class="module uk-panel uk-panel-box uk-panel-box-min uk-margin-bottom' . htmlspecialchars($params->get('moduleclass_sfx')) . '">';
		if ($module->showtitle)
		{
			echo '<h3 class="uk-margin-small-bottom uk-text-center">' . $module->title . '</h3>';
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
		echo '<div class="title uk-panel-title uk-h3">' . $module->title . '</div>';
	}

	echo '<div class="content">' . $module->content . '</div>';
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