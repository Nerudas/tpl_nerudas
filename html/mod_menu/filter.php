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
JLoader::register('modMenuFilterHelper', __DIR__ . '/filter_helper.php');
$list    = modMenuFilterHelper::getList($active, $default, $list, $path);
$current = modMenuFilterHelper::getCurrentItem($active, $list);
$items   = modMenuFilterHelper::getItems($current, $list);
$id      = 'modMenu-' . $module->id;
if ($params->get('tag_id'))
{
	$id = $params->get('tag_id');
}
$list   = modMenuFilterHelper::getListHTML($items);
$filter = JFactory::getDocument()->loadRenderer('modules')->render('filter', array('style' => 'blank'));
echo '<ul id="' . $id . '" class="uk-nav filter uk-nav-side" data-uk-nav>' . $list . '<li class="filter">' . $filter . '</li></ul>';
// Mobile
echo '<div id="filter" class="uk-offcanvas"><div class="uk-offcanvas-bar uk-offcanvas-bar-flip"><ul id="' . $id . 'Mobile" class="uk-nav filter uk-nav-offcanvas" data-uk-nav>' . $list . '<li class="filter">' . $filter . '</li></ul></div></div>';