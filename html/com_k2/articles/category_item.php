<?php
/**
 * @package    Nerudas Template
 * @version    4.9.5
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2017 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;
$text = $this->item->introtext;
// {hits}
$text = str_replace('{hits}', $this->item->hits, $text);
// {commentsCount}
$text = str_replace('{commentsCount}', $this->item->numOfComments, $text);
// {link}
$text = str_replace('{link}', $this->item->link, $text);
// {date}
$text = str_replace('{date}', JHTML::_('date', $this->item->publish_up, 'd F'), $text);
echo $text;
?>