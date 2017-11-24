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
?>

<div class="uk-form-row">
	<?php if (!empty($field->title)): ?>
		<label class="uk-form-label"><?php echo $field->title; ?></label>
	<?php endif; ?>
	<div class="uk-form-controls uk-button-group" data-uk-button-radio>
		<div class="controls">
			<?php foreach ($field->values as $val): ?>
				<label for="K2ExtraField_331" id="K2ExtraField_331-lbl" class="radio uk-button<?php if ($val->active)
				{
					echo ' uk-active';
				} ?>">
					<input type="radio" name="extra[<?php echo $field->id; ?>][]"
						   value="<?php echo $val->value; ?>" <?php if ($val->active)
					{
						echo 'checked clas="uk-active"';
					} ?> >
					<?php echo $val->name; ?>
				</label>
			<?php endforeach; ?>
		</div>
	</div>
</div>