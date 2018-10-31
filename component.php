<?php
/**
 * @package    Nerudas Template
 * @version    4.9.31
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;

$app        = JFactory::getApplication();
$doc        = JFactory::getDocument();
$layout     = 'system';
$layoutPath = JPATH_THEMES . '/protostar/component.php';
if ($app->input->get('option') == 'com_k2' && $app->input->get('layout') == 'itemform')
{
	$layout     = 'index';
	$layoutPath = JPATH_THEMES . '/' . $this->template . '/index.php';
}
if ($app->input->get('option') == 'com_users' && $app->input->get('view') == 'login')
{
	$layout     = 'index';
	$layoutPath = JPATH_THEMES . '/' . $this->template . '/index.php';
}
if ($layout == 'system')
{
	$doc->addStyleSheetVersion($this->baseurl . '/templates/protostar/css/template.css');
}
require_once $layoutPath;
?>