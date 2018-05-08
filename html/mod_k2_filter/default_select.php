<?php
/**
 * @package    Nerudas Template
 * @version    4.9.9
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;
?>

<div class="uk-form-row">
	<?php if (!empty($field->title)): ?>
		<label class="uk-form-label"><?php echo $field->title; ?></label>
	<?php endif; ?>
	<div class="uk-form-controls">
		<select name="extra[<?php echo $field->id; ?>]">
			<option value="0" <?php if ($field->zeroActive)
			{
				echo 'selected';
			} ?> class="uk-text-muted"><?php echo JText::_('NERUDAS_CHOSEN_SINGLE'); ?></option>
			<?php foreach ($field->values as $val): ?>
				<option value="<?php echo $val->value; ?>" <?php if ($val->active)
				{
					echo 'selected';
				} ?>><?php echo $val->name; ?></option>
			<?php endforeach; ?>
		</select>
	</div>
</div>
