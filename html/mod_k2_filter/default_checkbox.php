<?php
/**
 * @package    Nerudas Template
 * @version    4.9.1
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
	<div class="uk-form-controls">
		<?php foreach ($field->values as $val): ?>
			<p class="uk-form-controls-condensed uk-margin-small-bottom">
				<input type="checkbox" name="extra[<?php echo $field->id; ?>][]"
					   value="<?php echo $val->value; ?>" <?php if ($val->active) {
					echo ' checked ';
				} ?> >
				<span class="uk-margin-small-left"><?php echo $val->name; ?></span>
			</p>
		<?php endforeach; ?>
	</div>
</div>

