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
$app = JFactory::getApplication();
$doc = JFactory::getDocument();
?>
<div id="form" class="uk-modal">
	<div class="uk-modal-dialog">
		<button class="uk-modal-close uk-close" type="button"></button>
		<h4 class="uk-modal-header">
			<?php echo JText::_('NERUDAS_ADD_MAP'); ?>
		</h4>
		<form id="addMarkForm" class="uk-form uk-form-horizontal">
			<div class="uk-form-row">
				<label class="uk-form-label"><?php echo JText::_('NERUDAS_TITLE'); ?></label>
				<div class="uk-form-controls">
					<input id="addMarkTitle" type="text" name="title" class="uk-width-1-1"
						   placeholder="<?php echo JText::_('NERUDAS_TITLE'); ?>">
				</div>
			</div>
			<div class="uk-form-row">
				<label class="uk-form-label"><?php echo JText::_('NERUDAS_CATEGORY'); ?></label>
				<div class="uk-form-controls">
					<?php echo $this->get('params')->form->categories; ?>
				</div>
			</div>
			<div class="uk-form-row">
				<label class="uk-form-label"><?php echo JText::_('NERUDAS_TEXT'); ?></label>
				<div class="uk-form-controls">
					<textarea id="addMarkText" name="text" rows="5" class="uk-width-1-1"
							  placeholder="<?php echo JText::_('NERUDAS_TEXT'); ?>"></textarea>
				</div>
			</div>
			<div id="addMarkmap" class="uk-form-row">
			</div>
			<div class="uk-form-row uk-text-right">
				<button type="submit"
						class="uk-button uk-button-large uk-button-success"><?php echo JText::_('NERUDAS_SUBMIT'); ?></button>
			</div>
			<input id="addMarkLatitude" name="latitude" type="hidden" value=""/>
			<input id="addMarLongitude" name="longitude" type="hidden" value=""/>
		</form>
	</div>
</div>
