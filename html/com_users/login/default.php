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
$cookieLogin = $this->user->get('cookieLogin');
if ($this->user->get('guest') || !empty($cookieLogin)) {
	echo $this->loadTemplate('login');
}
else {
	$url = '/';
	if ($app->input->get('return')) {
	 $url =  base64_decode($app->input->get('return'));
	}
	$app->redirect($url);
}
?>