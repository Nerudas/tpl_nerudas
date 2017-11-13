<?php 
/**
 * @package     JoomlaZen Nerudas Template
 * @version     4.3
 * @author      JoomlaZen - www.joomlazen.com
 * @copyright   Copyright (c) 2016 - 2016 JoomlaZen. All rights reserved.
 * @license     GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */
defined('_JEXEC') or die('Restricted access');
$app = JFactory::getApplication();
// Home
if ($this->item->id == 1 || $this->item->id == 154908) {
	echo $this->loadTemplate('home');
}
// Add
if ($this->item->id == 10001 || $this->item->id == 10002 || $this->item->id == 10003) {
	echo $this->loadTemplate('add');
}

?>