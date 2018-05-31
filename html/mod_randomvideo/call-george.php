<?php
/**
 * @package    Nerudas Template
 * @version    4.9.13
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Environment\Browser;
use Joomla\Utilities\ArrayHelper;
use Joomla\CMS\Uri\Uri;
use Joomla\CMS\Language\Text;

$browser = Browser::getInstance();
$mac     = ($browser->getPlatform() == 'mac');

if ($mac)
{
	$videos = $params->get('videos', 0);
	$videos = ArrayHelper::fromObject($videos, false);
	$count  = count($videos);
	$keys   = array_keys($videos);

	$key        = $keys[rand(0, ($count - 1))];
	$video      = $videos[$key];
	$video->src = trim($video->src, '/\/');

	$video->type = JFile::getExt(JPATH_ROOT . '/' . $video->src);
	$video->src  = Uri::root(true) . '/' . $video->src;
}

if (!$mac)
{
	HTMLHelper::_('jquery.framework');
	HTMLHelper::_('script', 'media/mod_randomvideo/js/ajax.min.js', array('version' => 'auto'));
}
HTMLHelper::_('stylesheet', 'templates/nerudas/html/mod_randomvideo/call-george/style.min.css', array('version' => 'auto'));

?>
<?php if (!$mac) : ?>
	<div class="call-george-module uk-flex uk-flex-middle uk-flex-center">
		<div id="<?php echo $module->module . '_' . $module->id; ?>" class="phone not-mac"
			 data-mod_randomvideo='<?php echo $ajax_data; ?>'>
			<div class="display">
				<div class="page_ready inner">
					<img src="/templates/nerudas/html/mod_randomvideo/call-george/page_ready.jpg">
					<a class="get_video"></a>
				</div>
				<div class="before_play inner">
					<img src="/templates/nerudas/html/mod_randomvideo/call-george/before_play.jpg">
					<a class="stop_load"></a>
				</div>
				<div class="on_play inner">
					<video src=""></video>
					<img src="/templates/nerudas/html/mod_randomvideo/call-george/on_play.jpg">
					<a class="stop_video"></a>
				</div>
				<div class="after_play inner">
					<img src="/templates/nerudas/html/mod_randomvideo/call-george/after_play.jpg">
					<a class="get_video"></a>
				</div>
			</div>
			<img src="/templates/nerudas/html/mod_randomvideo/call-george/phone.png">
		</div>
	</div>
<?php else: ?>
	<div class="call-george-module uk-flex uk-flex-middle uk-flex-center">
		<div id="<?php echo $module->module . '_' . $module->id; ?>" class="phone mac">
			<div class="display">
				<div class="on_play inner">
					<video controls src="<?php echo $video->src; ?>" type="video/<?php echo $video->type; ?>"></video>
				</div>
			</div>
			<img src="/templates/nerudas/html/mod_randomvideo/call-george/phone.png">
		</div>
	</div>
	<div class="uk-text-center uk-margin-small-top">
		<a onclick="location.reload();" class="uk-button uk-button-success uk-button-large">
			<?php echo Text::_('TPL_NERUDAS_CALL_GEORGE_RECALL'); ?>
		</a>
	</div>
<?php endif; ?>