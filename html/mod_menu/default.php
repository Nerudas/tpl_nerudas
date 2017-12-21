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

require_once JPATH_THEMES . '/nerudas/helper.php';
$actives = tplNerudasHelper::getMenuActiveItems($active_id, $path, $list);

$id = ($params->get('tag_id', 0)) ? $params->get('tag_id') : 'modMenu-' . $module->id;

echo '<ul id="' . $id . '" class="uk-nav uk-nav-side uk-nav-parent-icon new' . $class_sfx . '" data-uk-nav>';
foreach ($list as $i => &$item)
{
	$class = array();

	$class[] = 'item-' . $item->id;

	if ($item->id == $default_id)
	{
		$class[] = 'default';
	}

	$active = false;
	if ($item->id == $active_id || ($item->type === 'alias' && $item->params->get('aliasoptions') == $active_id))
	{
		$active = true;
	}
	if (in_array($item->id, $path))
	{
		$active = true;
	}
	elseif ($item->type === 'alias')
	{
		$aliasToId = $item->params->get('aliasoptions');

		if (count($path) > 0 && $aliasToId == $path[count($path) - 1])
		{
			$active = true;
		}
		elseif (in_array($aliasToId, $path))
		{
			$active = true;
		}
	}

	if (in_array($item->id, $actives))
	{

		$class[] = 'uk-active';
		if (!$active)
		{
			$class[] = 'uk-active-parent';
		}
	}


	if ($item->type == 'separator')
	{
		$class[] = 'uk-nav-divider';
	}
	if ($item->type == 'heading')
	{
		$class[] = 'uk-nav-header';
	}
	if ($item->parent)
	{
		$class[] = 'uk-parent';

	}
	$class = implode(' ', $class);
	if ($item->type == 'component')
	{
		$item->flink = htmlspecialchars($item->flink, ENT_COMPAT, 'UTF-8');
	}
	else
	{
		$item->flink = htmlspecialchars($item->flink);
	}
	$item->title = $item->icon . $item->title;
	$item->flink = JFilterOutput::ampReplace($item->flink);
	echo '<li class="' . $class . '"' . $item->liData . '>';
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
		echo '<ul class="submenu uk-nav-sub level-' . ($item->level + 1) . $item->submenuClass . ' ">';
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