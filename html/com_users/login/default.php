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
$app         = JFactory::getApplication();
$doc         = JFactory::getDocument();
$cookieLogin = $this->user->get('cookieLogin');
if ($this->user->get('guest') || !empty($cookieLogin))
{
	echo $this->loadTemplate('login');
}
else
{
	$url = '/';
	if ($app->input->get('return'))
	{
		$url = base64_decode($app->input->get('return'));
	}
	$app->redirect($url);
}
?>