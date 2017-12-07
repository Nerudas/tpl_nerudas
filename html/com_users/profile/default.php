<?php
/**
 * @package    Nerudas Template
 * @version    4.9.3
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2017 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;
$app      = JFactory::getApplication();
$redirect = NerudasProfilesHelper::getProfile(JFactory::getUser()->id)->link;
if (!empty($app->input->cookie->get('redirect')))
{
	$redirect = $app->input->cookie->getAray('redirect');
	$app->input->cookie->set('redirect', null, time() - 1);
}
$app->redirect($url = $redirect, $moved = true);
?>