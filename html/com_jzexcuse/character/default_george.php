<?php
/**
 * @package     JZ Excuse
 * @version     0.5
 * @author      JoomlaZen - www.joomlazen.com
 * @copyright   Copyright (c) 2016 - 2017 JoomlaZen. All rights reserved.
 * @license     GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */
defined( '_JEXEC' )or die( 'Restricted access' );
if ($this->answer) {
	echo $this->loadTemplate('george_answer');
	
}
else {
	echo $this->loadTemplate('george_character');
}
?>