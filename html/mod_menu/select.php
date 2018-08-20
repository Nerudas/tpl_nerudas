<?php
/**
 * @package    Nerudas Template
 * @version    4.9.25
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;

$items   = $list;
$options = array();
$value   = '';
foreach ($list as $item)
{
	$item->flink = JFilterOutput::ampReplace($item->flink);

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
	}

	if ($active)
	{
		$value = $item->flink;
	}
	$options[] = HTMLHelper::_('select.option', $item->flink, $item->title);
}
$attributes = 'onchange="if (this.value) window.location.href=this.value"';
echo HTMLHelper::_('select.genericlist', $options, '', $attributes, 'value', 'text', $value);