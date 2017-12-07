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
$app           = JFactory::getApplication();
$doc           = JFactory::getDocument();
$user          = JFactory::getUser();
$accesslevel   = JAccess::getAuthorisedViewLevels($user->id);
$administrator = 3;
/* Bot check
========================================================================== */
$isBot  = false;
$bots   = array();
$bots[] = 'rambler';
$bots[] = 'googlebot';
$bots[] = 'aport';
$bots[] = 'yahoo';
$bots[] = 'msnbot';
$bots[] = 'turtle';
$bots[] = 'mail.ru';
$bots[] = 'omsktele';
$bots[] = 'yetibot';
$bots[] = 'picsearch';
$bots[] = 'sape.bot';
$bots[] = 'sape_context';
$bots[] = 'gigabot';
$bots[] = 'snapbot';
$bots[] = 'alexa.com';
$bots[] = 'megadownload.net';
$bots[] = 'askpeter.info';
$bots[] = 'igde.ru';
$bots[] = 'ask.com';
$bots[] = 'qwartabot';
$bots[] = 'yanga.co.uk';
$bots[] = 'scoutjet';
$bots[] = 'similarpages';
$bots[] = 'oozbot';
$bots[] = 'shrinktheweb.com';
$bots[] = 'aboutusbot';
$bots[] = 'followsite.com';
$bots[] = 'dataparksearch';
$bots[] = 'google-sitemaps';
$bots[] = 'appEngine-google';
$bots[] = 'feedfetcher-google';
$bots[] = 'liveinternet.ru';
$bots[] = 'xml-sitemaps.com';
$bots[] = 'agama';
$bots[] = 'metadatalabs.com';
$bots[] = 'h1.hrn.ru';
$bots[] = 'googlealert.com';
$bots[] = 'seo-rus.com';
$bots[] = 'yaDirectBot';
$bots[] = 'yandeG';
$bots[] = 'yandex';
$bots[] = 'yandexSomething';
$bots[] = 'Copyscape.com';
$bots[] = 'AdsBot-Google';
$bots[] = 'domaintools.com';
$bots[] = 'Nigma.ru';
$bots[] = 'bing.com';
$bots[] = 'dotnetdotcom';
foreach ($bots as $bot)
{
	if (stripos($_SERVER['HTTP_USER_AGENT'], $bot) !== false)
	{
		$isBot = true;
	}
}
if (in_array($administrator, $accesslevel) || $isBot)
{
	require_once JPATH_THEMES . '/system/error.php';
}
else
{
	$message = $this->error->getCode() . ' - ' . htmlspecialchars($this->error->getMessage(), ENT_QUOTES, 'UTF-8');
	$app->redirect($url = '/', $msg = $message, $msgType = 'error', $moved = true);
}
?>
