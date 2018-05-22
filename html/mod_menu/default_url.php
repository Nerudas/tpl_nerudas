<?php
/**
 * @package    Nerudas Template
 * @version    4.9.10
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;

$attributes = array();
if ($item->anchor_title)
{
	$attributes['title'] = $item->anchor_title;
}
if ($item->anchor_css)
{
	$attributes['class'] = $item->anchor_css;
}
if ($item->anchor_rel)
{
	$attributes['rel'] = $item->anchor_rel;
}
if ($item->browserNav == 1)
{
	$attributes['target'] = '_blank';
}
elseif ($item->browserNav == 2)
{
	$options               = 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes';
	$attributes['onclick'] = "window.open(this.href, 'targetWindow', '" . $options . "'); return false;";
}
echo HTMLHelper::_('link', $item->flink, $item->title, $attributes);