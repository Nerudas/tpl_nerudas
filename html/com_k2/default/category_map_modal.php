<?php
/**
 * @package    Nerudas Template
 * @version    4.9.14
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */
$app = JFactory::getApplication();
$doc = JFactory::getDocument();
JHtml::_('script', '//api-maps.yandex.ru/2.1/?lang=ru-RU', array('version' => 'auto', 'relative' => true));
?>
<div id="mapModal" class="uk-modal">
	<div class="uk-modal-dialog">
		<a class="uk-modal-close uk-close uk-position-z-index uk-position-top-right" style="color: #fff; opacity: 1">
		</a>
		<h4 class="uk-modal-header uk-hidden">
			<?php echo JText::_('NERUDAS_SHOW_ON_MAP'); ?>
		</h4>
		<div id="modal-map" class="uk-modal-contnet-large map">
		</div>
	</div>
</div>