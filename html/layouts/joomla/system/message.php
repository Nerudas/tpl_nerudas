<?php
/**
 * @package    Nerudas Template
 * @version    4.9.27
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;
$app            = JFactory::getApplication();
$doc            = JFactory::getDocument();
$delay          = new stdClass();
$delay->start   = 0;
$delay->i       = 500;
$timeout        = new stdClass();
$timeout->start = 3500;
$timeout->i     = 50000;
$position       = 'top-center';
$showIcon       = true;
$d              = 0;
$t              = 1;
if (is_array($displayData['msgList']) && !empty($displayData['msgList']))
{
	$script = '<script>';
	foreach ($displayData['msgList'] as $key => $messages)
	{
		foreach ($messages as $message)
		{
			if ($message == JText::_('JGLOBAL_AUTH_INVALID_PASS') || $message == JText::_('JGLOBAL_AUTH_NO_USER'))
			{
				$key = 'error';
			}
			$type = 'success';
			$icon = '<i class="uk-icon-check-circle uk-icon-small uk-display-inline-block uk-margin-right"></i>';
			if ($key == 'notice')
			{
				$type = 'info';
				$icon = '<i class="uk-icon-info-circle uk-icon-small uk-display-inline-block uk-margin-right"></i>';
			}
			if ($key == 'warning')
			{
				$type = 'warning';
				$icon = '<i class="uk-icon-warning uk-icon-small uk-display-inline-block uk-margin-right"></i>';
			}
			if ($key == 'error')
			{
				$type = 'danger';
				$icon = '<i class="uk-icon-times-circle uk-icon-small uk-display-inline-block uk-margin-right"></i>';
			}
			if (!$showIcon)
			{
				$icon = '';
			}
			$thisDelay   = $delay->i * $d;
			$thisDelay   = $delay->start + $thisDelay;
			$thisTimeout = $timeout->i * $t;
			$thisTimeout = $timeout->start + $thisTimeout;
			$script      .= "setTimeout(function(){UIkit.notify({message: '" . $icon . $message . "',status: '" . $type . "',timeout: " . $thisTimeout . ",pos: '" . $position . "'});}, " . $thisDelay . ");";
			$d++;
			$t++;
		}
	}
	$script .= '</script>';
	echo $script;
}
?>