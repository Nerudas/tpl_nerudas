<?php
/**
 * @package    Nerudas Template
 * @version    4.9.7
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;
$app = JFactory::getApplication();
// Home
if ($this->item->id == 1 || $this->item->id == 154908)
{
	echo $this->loadTemplate('home');
}
// Add
if ($this->item->id == 10001 || $this->item->id == 10002 || $this->item->id == 10003)
{
	echo $this->loadTemplate('add');
}

?>