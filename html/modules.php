<?php
/**
 * @package    Nerudas Template
 * @version    4.9.2
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

?>