<?php
/**
 * @package    Nerudas Template
 * @version    4.9.26
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;

HTMLHelper::_('jquery.framework');
HTMLHelper::_('script', 'media/com_location/js/regions.min.js', array('version' => 'auto'));
HTMLHelper::_('script', 'media/mod_location_regions/js/ajax.min.js', array('version' => 'auto'));
HTMLHelper::_('script', 'mod_location_regions.min.js', array('version' => 'auto', 'relative' => true));
?>

<li class="region">
	<a href="#locationSelect" data-uk-modal="" data-uk-tooltip="pos:'bottom-right', cls:'big'"
	   title="<?php echo Text::sprintf('MOD_LOCATION_REGIONS_CURRENT', $current->name); ?>">
		<img src="<?php echo $current->icon; ?>" alt="<?php echo $current->name; ?>"/>
	</a>
	<?php if ($new): ?>
		<div id="locationNewRegion" class="new region">
			<div class="uk-text-nowrap uk-text-small">
				<?php echo Text::sprintf('MOD_LOCATION_REGIONS_NEW', $current->name); ?>
			</div>
			<div class="uk-text-right uk-margin-small-top uk-text-nowrap">
				<a class="uk-button uk-button-white uk-button-small"
				   data-uk-toggle="{target:'#locationNewRegion'}">
					<?php echo Text::_('JYES'); ?>
				</a>
				<a class="uk-button uk-button-white uk-button-small"
				   href="#locationSelect" data-uk-modal="" data-uk-tooltip="pos:'bottom-right', cls:'big'">
					<?php echo Text::_('MOD_LOCATION_REGIONS_SELECT'); ?>
				</a>
			</div>
		</div>
	<?php endif; ?>
</li>

<div id="locationSelect" class="uk-modal" data-mod-location-regions="<?php echo $module->id; ?>">
	<div class="uk-modal-dialog uk-modal-dialog-large">
		<a class="uk-modal-close uk-close">
		</a>
		<div class="uk-h4 uk-modal-header">
			<?php echo Text::sprintf('MOD_LOCATION_REGIONS_CURRENT', $current->name); ?>
		</div>
		<div>
			<div class="success uk-alert uk-alert-success"></div>
			<div class="loading"><i class="uk-icon-spinner uk-icon-spin uk-icon-large"></i></div>
			<div class="error uk-alert uk-alert-danger"></div>
			<div class="items uk-overflow-container"></div>
		</div>
	</div>
</div>
