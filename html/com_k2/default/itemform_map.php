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
?>
<div id="k2FormMap" class="uk-margin-bottom uk-form uk-form-horizontal uk-panel uk-panel-box">
	<h3><?php echo JText::_('NERUDAS_ON_MAP'); ?></h3>
	<div id="anchor-map" class="uk-anchor"></div>
	<div class="uk-form-row">
		<?php echo $this->K2PluginsItemOther['ymap']->fields; ?>
	</div>
	<div class="uk-form-row <?php echo $this->systemFields->css; ?>">
		<label class="uk-form-label">
			<?php echo JText::_('NERUDAS_MAP_MARK_ICON'); ?>
		</label>
		<div class="uk-form-controls">
			<?php echo $this->K2PluginsItemOther['markicon']->fields; ?>
		</div>
	</div>
</div>
