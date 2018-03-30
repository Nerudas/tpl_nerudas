<?php
/**
 * @package    Nerudas Template
 * @version    4.9.7
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;

HTMLHelper::_('jquery.framework');
HTMLHelper::_('script', 'media/mod_randomvideo/js/ajax.min.js', array('version' => 'auto'));
HTMLHelper::_('stylesheet', 'templates/nerudas/html/mod_randomvideo/call-george/style.min.css', array('version' => 'auto'));

?>
<div class="call-george-module uk-flex uk-flex-middle uk-flex-center">
	<div id="<?php echo $module->module . '_' . $module->id; ?>" class="phone"
		 data-mod_randomvideo='<?php echo $ajax_data; ?>'>
		<div class="display">
			<div class="page_ready inner">
				<a class="get_video"></a>
			</div>
			<div class="before_play inner">
				<a class="stop_load"></a>
			</div>
			<div class="on_play inner">
				<video src="" ></video>
				<a class="stop_video"></a>
			</div>
			<div class="after_play inner">
				<div>
					<a class="get_video"></a>
				</div>
			</div>
		</div>
	</div>
</div>