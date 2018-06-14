<?php
/**
 * @package    Nerudas Template
 * @version    4.9.14
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;

extract($displayData);

/**
 * Layout variables
 * -----------------
 * @var   array  $options    Options available for this field.
 * @var   array  $categories Roots options available for this field.
 * @var   array  $value      Value attribute of the field.
 * @var   string $id         DOM id of the field.
 * @var   string $name       Name of the input field.
 * @var   string $class      Classes for the input.
 */

HTMLHelper::_('jquery.framework');

?>

<div id="<?php echo $id; ?>" data-input-spectechbrands="categories" class="<?php echo $class; ?>">
	<div class="categories uk-grid" data-uk-grid-match data-uk-grid-margin>
		<?php foreach ($categories as $category): ?>
			<?php if ($category->id !== 0): ?>
				<div class="category uk-width-medium-1-3">
					<div class="title uk-h4 uk-margin-small-bottom">
						<strong><?php echo $category->title; ?></strong>
					</div>
					<?php if (!empty($category->options)): ?>
						<ul class="uk-list uk-margin-top-remove uk-margin-bottom-remove uk-margin-left">
							<?php foreach ($category->options as $option): ?>
								<li class="item option-<?php echo $option->key; ?>">
									<label for="<?php echo $option->id; ?>" class="checkbox">
										<input type="checkbox" name="<?php echo $option->name; ?>"
											   id="<?php echo $option->id; ?>"
											   value="<?php echo $option->value; ?>" <?php echo $option->checked; ?>>
										<?php echo $option->text; ?>
									</label>
								</li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		<?php endforeach; ?>
	</div>
</div>
