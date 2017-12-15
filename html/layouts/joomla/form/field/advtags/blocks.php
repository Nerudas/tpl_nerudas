<?php
/**
 * @package    Field Types - Advanced Tags Plugin
 * @version    1.0.0
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2017 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Layout\LayoutHelper;

extract($displayData);

/**
 * Layout variables
 * -----------------
 * @var   array  $options  Options available for this field.
 * @var   array  $children Childrens options available for this field.
 * @var   array  $root     Roots ptions available for this field.
 * @var   array  $value    Value attribute of the field.
 * @var   string $id       DOM id of the field.
 * @var   string $name     Name of the input field.
 * @var   string $class    Classes for the input.
 */

HTMLHelper::_('jquery.framework');
//HTMLHelper::_('stylesheet', 'media/plg_fieldtypes_advtags/field.min.css', array('version' => 'auto'));
HTMLHelper::_('script', 'media/plg_fieldtypes_advtags/field.min.js', array('version' => 'auto'));
?>

<div id="<?php echo $id; ?>" data-input-advtags="blocks" class="<?php echo $class; ?>">
	<ul class="level-<?php echo $level; ?>uk-list  uk-grid childs uk-margin-left-remove" data-uk-grid-math
		data-uk-grid-margin>
		<?php foreach ($root as $option): ?>
			<li class="item option-<?php echo $option->key; ?> level-<?php echo $option->level; ?> uk-width-medium-1-2">
				<label for="<?php echo $option->id; ?>" class=" uk-h4 uk-margin-small-bottom uk-display-block">
					<strong><?php echo $option->text; ?></strong>
					<input type="checkbox" name="<?php echo $option->name; ?>" id="<?php echo $option->id; ?>"
						   value="<?php echo $option->value; ?>" class="uk-hidden"
						   data-parent="<?php echo $option->parent; ?>" <?php echo $option->checked; ?>>
				</label>
				<?php if (!empty($children[$option->key]))
				{
					$data            = $displayData;
					$data['options'] = $children[$option->key];
					$data['level']   = $option->level + 1;
					echo LayoutHelper::render('joomla.form.field.advtags.options.default', $data);
				}
				?>
			</li>
		<?php endforeach; ?>
	</ul>
</div>
