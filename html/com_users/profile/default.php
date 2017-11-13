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
$redirect = NerudasProfilesHelper::getProfile(JFactory::getUser()->id)->link;
if (!empty($app->input->cookie->get('redirect'))) {
	$redirect = $app->input->cookie->getAray('redirect');
	$app->input->cookie->set('redirect', null, time() - 1);
}
$app->redirect($url = $redirect, $moved= true);
?>