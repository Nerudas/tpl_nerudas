<?php
/**
 * @package    Nerudas Template
 * @version    4.9.6
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;
if ($this->character->id == 1)
{
	echo $this->loadTemplate('mikhalych');

}
if ($this->character->id == 2)
{
	echo $this->loadTemplate('george');
}
?>
