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
$doc = JFactory::getDocument();
if ($this->category->id == 13) {
	echo $this->loadTemplate('news');
}
?>



