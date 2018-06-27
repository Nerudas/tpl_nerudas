<?php
/**
 * @package    Nerudas Template
 * @version    4.9.17
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;
?>

<form name="filter_<?php echo $mod_id; ?>" class="uk-form">
	<input type="hidden" name="filter" value="true">
	<?php if ($searchtext): ?>
		<div class="uk-form-row">
			<?php if (!empty($searchtext->label)): ?>
				<label class="uk-form-label"><?php echo $searchtext->label; ?></label>
			<?php endif; ?>
			<div class="uk-form-controls">
				<input name="<?php echo $searchtext->name; ?>" class="uk-width-1-1"
					   value="<?php echo $searchtext->value; ?>" placeholder="<?php echo $searchtext->placeholder; ?>"/>
			</div>
		</div>
	<?php endif; ?>
	<?php foreach ($extraFields as $field): ?>
		<?php require JModuleHelper::getLayoutPath('mod_k2_filter', 'default_' . $field->type); ?>
	<?php endforeach; ?>
	<div class="uk-form-row">
		<div class="uk-form-controls">
			<button type="reset" class="uk-button uk-button-danger"><?php echo JText::_('NERUDAS_RESET') ?></button>
			<button type="submit" class="uk-button uk-button-success"><?php echo JText::_('NERUDAS_SHOW') ?></button>
		</div>
	</div>
</form>
