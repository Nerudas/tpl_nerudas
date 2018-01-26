<?php
/**
 * @package    Nerudas Template
 * @version    4.9.5
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;

HTMLHelper::_('formbehavior.chosen', 'select');
HTMLHelper::_('script', '//api-maps.yandex.ru/2.1/?lang=ru-RU', array('version' => 'auto', 'relative' => true));
HTMLHelper::_('script', 'media/com_board/js/map.min.js', array('version' => 'auto'));

$filters = array_keys($this->filterForm->getGroup('filter'));
?>
<div id="board" class="map">

	<div id="map" data-board-map>
		<div class="zoom " data-afterInit="show">
			<a data-board-map-zoom="plus"
			   class="uk-flex uk-flex-middle uk-flex-center uk-icon-small uk-icon-plus uk-text-success"></a>
			<span data-board-map-zoom="current" class="uk-flex uk-flex-middle uk-flex-center uk-hidden-small"></span>
			<a data-board-map-zoom="minus"
			   class="uk-flex uk-flex-middle uk-flex-center uk-icon-small uk-icon-minus uk-text-danger"></a>
		</div>
	</div>
	<div data-board-itemlist="container" class="uk-panel uk-panel-box uk-padding-remove">
		<div class="uk-hidden-medium  uk-hidden-large uk-text-right">
			<a data-board-itemlist="close" title="<?php echo Text::_('JLIB_HTML_BEHAVIOR_CLOSE'); ?>"
			   class="uk-icon-close uk-icon-small">

			</a>
		</div>
		<div data-board-itemlist="items"></div>
		<div data-board-itemlist="back" class="uk-margin-top">
			<a class="uk-button uk-width-1-1">
				<i class="uk-icon-chevron-left"></i> <?php echo Text::_('JPREV'); ?>
			</a>
		</div>

	</div>
</div>

