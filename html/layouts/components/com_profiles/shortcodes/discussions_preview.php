<?php
/**
 * @package    Nerudas Template
 * @version    4.9.29
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;

$item = $displayData;

echo JHtmlString::truncate((!empty($item->status)) ? $item->status : $item->about, 70, false, false);