<?php
/**
 * @package    Nerudas Template
 * @version    5.0.0
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2017 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;

$app = Factory::getApplication();
$doc = Factory::getDocument();
if (is_array($displayData['msgList']) && !empty($displayData['msgList']))
{
	$script = '<script>';
	foreach ($displayData['msgList'] as $key => $messages)
	{
		foreach ($messages as $message)
		{
			if ($message == Text::_('JGLOBAL_AUTH_INVALID_PASS')
				|| $message == Text::_('JGLOBAL_AUTH_NO_USER'))
			{
				$key = 'error';
			}
			$type = 'success';
			$icon = 'check';
			if ($key == 'notice')
			{
				$type = 'primary';
				$icon = 'info';
			}
			if ($key == 'warning')
			{
				$type = 'warning';
				$icon = 'bell';
			}
			if ($key == 'error')
			{
				$type = 'danger';
				$icon = 'close';
			}
			$icon   = '<span class="uk-notification-message-icon uk-icon-button" data-uk-icon="icon: ' . $icon . '" ></span>';
			$script .= "UIkit.notification({message: '" . $icon . $message . "',status: '" . $type . "'});";
		}
	}
	$script .= '</script>';
	echo $script;
}