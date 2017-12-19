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
$app = JFactory::getApplication();
$doc = JFactory::getDocument();
if ($this->item->extra_fields)
{
	$this->item->extra = NerudasK2Helper::getItemExtra($this->item->extra_fields);
}
K2HelperUtilities::setDefaultImage($this->item, 'itemlist', $this->params);
if (!$this->item->image)
{
	$this->item->image = '/templates/' . $app->getTemplate() . '/images/noimages/' . $this->item->catid . '.jpg';
}
$this->item->mintext = JHTML::_('string.truncate', (strip_tags($this->item->introtext)), 150);
if ($this->item->category->id == 40)
{

	echo $this->loadTemplate('item_rabotaem');
}
if ($this->item->category->id == 315)
{
	echo $this->loadTemplate('item_herak');
}
?>