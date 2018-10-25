<?php
/**
 * @package    Nerudas Template
 * @version    4.9.30
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;
$id = 'modMenu-' . $module->id;
if ($params->get('tag_id'))
{
	$id = $params->get('tag_id');
}
echo '<ul id="' . $id . '" class="uk-nav uk-nav-parent-icon' . $class_sfx . '" data-uk-nav="{multiple:true}" >';
foreach ($list as $i => &$item)
{
	$item->liClass = 'item-' . $item->id . ' level-' . $item->level;
	$item->liData  = '';
	if ($item->id == $default_id)
	{
		$item->liClass .= ' default';
	}
	if (($item->id == $active_id) || ($item->type == 'alias' && $item->params->get('aliasoptions') == $active_id))
	{
		$item->liClass .= ' current';
	}
	if (in_array($item->id, $path))
	{
		$item->liClass .= ' uk-active';
	}
	elseif ($item->type == 'alias')
	{
		if (count($path) > 0 && $item->params->get('aliasoptions') == $path[count($path) - 1])
		{
			$item->liClass .= ' uk-active';
		}
		elseif (in_array($item->params->get('aliasoptions'), $path))
		{
			$item->liClass .= ' uk-active uk-active-parent';
		}
	}
	if ($item->type == 'separator')
	{
		$item->liClass .= ' uk-nav-divider';
	}
	if ($item->type == 'heading')
	{
		$item->liClass .= ' uk-nav-header';
	}
	if ($item->parent && $item->level == 1)
	{
		$item->liClass .= ' uk-parent';

	}
	if ($item->type == 'component')
	{
		$item->flink = htmlspecialchars($item->flink, ENT_COMPAT, 'UTF-8');
	}
	else
	{
		$item->flink = htmlspecialchars($item->flink);
	}
	// Icons
	$item->icon        = '';
	$item->icon_regexp = '/uk-icon-([^"\'!\s]+)/';
	preg_match_all($item->icon_regexp, $item->anchor_css, $item->icon_css);
	if ($item->icon_css[0] > 0)
	{
		$item->anchor_css = preg_replace($item->icon_regexp, '', $item->anchor_css);
		$item->icon_css   = $item->icon_css[0];
		$item->icon_css   = implode(' ', $item->icon_css);
		$item->icon_css   = str_replace('uk-icon-margin', 'uk-margin', $item->icon_css);
		$item->icon       = '<i class="' . $item->icon_css . '"></i>';
	}
	$item->title = $item->icon . $item->title;
	$item->flink = JFilterOutput::ampReplace($item->flink);
	echo '<li class="' . $item->liClass . '"' . $item->liData . '>';
	switch ($item->type) :
		case 'separator':
			break;
		case 'heading':
			echo $item->title;
			break;
		default:
			require JModuleHelper::getLayoutPath('mod_menu', 'default_url');
			break;
	endswitch;
	if ($item->deeper)
	{
		$item->submenuClass = 'submenu level-' . ($item->level + 1);
		if ($item->level == 1)
		{
			$item->submenuClass .= ' uk-nav-sub';
		}
		echo '<ul class="' . $item->submenuClass . ' ">';
	}
	elseif ($item->shallower)
	{
		echo '</li>';
		echo str_repeat('</ul></li>', $item->level_diff);
	}
	else
	{
		echo '</li>';
	}
}
echo '</ul>';