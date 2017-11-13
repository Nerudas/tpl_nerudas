<?php
/**
 * @package     JZ Excuse
 * @version     0.5
 * @author      JoomlaZen - www.joomlazen.com
 * @copyright   Copyright (c) 2016 - 2017 JoomlaZen. All rights reserved.
 * @license     GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */
defined( '_JEXEC' )or die( 'Restricted access' );
if ( $this->character->id == 1 ) {
	echo $this->loadTemplate('mikhalych');
	
}
if ( $this->character->id == 2 ) {
	echo $this->loadTemplate('george');
}
?>
