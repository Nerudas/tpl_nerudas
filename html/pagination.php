<?php
/**
 * @package    Nerudas Template
 * @version    4.9.35
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;
function pagination_list_footer($list)
{
	$html = "<div class=\"pagination\">\n";
	$html .= $list['pageslinks'];
	$html .= "\n<input type=\"hidden\" name=\"" . $list['prefix'] . "limitstart\" value=\"" . $list['limitstart'] . "\" />";
	$html .= "\n</div>";

	return $html;
}

function pagination_list_render($list)
{
	$currentId = 0;
	foreach ($list['pages'] as $id => $page)
	{
		if (!$page['active'])
		{
			$currentId = $id;
		}
	}
	$range = 3;
	$html  = array('<ul class="uk-pagination">');
	if ($list['start']['active'] == 1)
	{
		$html[] = $list['start']['data'];
	}
	if ($list['previous']['active'] == 1)
	{
		$html[] = $list['previous']['data'];
	}
	foreach ($list['pages'] as $id => $page)
	{
		if ($id <= $currentId + $range && $id >= $currentId - $range)
		{
			$html[] = $page['data'];
		}
	}
	if ($list['next']['active'] == 1)
	{
		$html[] = $list['next']['data'];
	}
	if ($list['end']['active'] == 1)
	{
		$html[] = $list['end']['data'];
	}
	$html[] = "</ul>";

	return implode("\n", $html);
}

function pagination_item_active($item)
{
	$cls   = '';
	$title = '';
	if ($item->text == JText::_('JNEXT'))
	{
		$item->text = '<i class="uk-icon-angle-right"></i>';
		$cls        = "next";
		$title      = JText::_('JNEXT');
	}
	elseif ($item->text == JText::_('JPREV'))
	{
		$item->text = '<i class="uk-icon-angle-left"></i>';
		$cls        = "previous";
		$title      = JText::_('JPREV');
	}
	elseif ($item->text == JText::_('JLIB_HTML_START'))
	{
		$item->text = '<i class="uk-icon-angle-double-left"></i>';
		$cls        = "first";
		$title      = JText::_('JLIB_HTML_START');
	}
	elseif ($item->text == JText::_('JLIB_HTML_END'))
	{
		$item->text = '<i class="uk-icon-angle-double-right"></i>';
		$cls        = "last";
		$title      = JText::_('JLIB_HTML_END');
	}

	return '<li><a class="' . $cls . '" href="' . $item->link . '" title="' . $title . '">' . $item->text . '</a></li>';
}

function pagination_item_inactive(&$item)
{
	return '<li class="uk-active"><span>' . $item->text . '</span></li>';
}