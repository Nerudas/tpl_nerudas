<?php
/**
 * @package    Nerudas Template
 * @version    4.9.22
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;

use Joomla\CMS\Router\Route;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\HTML\HTMLHelper;

$children = array();
$actives  = array();
$root     = array();

foreach ($this->categories as $category)
{
	if ($category->level == 1)
	{
		$root[$category->id] = $category;
	}

	if (!isset($children[$category->parent_id]))
	{
		$children[$category->parent_id] = array();
	}
	$children[$category->parent_id][$category->id] = $category;
}
?>
<div id="add" class="itemlist uk-margin-large-bottom">
	<form action="<?php echo Route::_(BoardHelperRoute::getFormRoute()); ?>"
		  id="board" class="form-cartegories form form-validate" method="get">
		<?php echo LayoutHelper::render('template.title', array('cancel' => Route::_(BoardHelperRoute::getListRoute()))); ?>
		<div class="itemlist uk-panel uk-panel-box uk-margin-bottom">
			<?php foreach ($root as $item): ?>
				<div class="item uk-margin-large-bottom">
					<h2><?php echo $item->title; ?></h2>

					<?php if (!empty($children[$item->id])): ?>
						<div class="uk-grid uk-grid-small" data-uk-grid-margin data-uk-grid-match>
							<?php foreach ($children[$item->id] as $child) : ?>
								<div class="uk-text-center uk-width-xsmall-1-3 uk-width-small-1-4 uk-width-medium-1-5 uk-width-large-1-5 uk-width-xlarge-1-5">
									<label for="category_<?php echo $child->id; ?>"
										   class="uk-display-block uk-link-muted">
										<div>
											<input id="category_<?php echo $child->id; ?>" type="radio" name="category"
												   value="<?php echo $child->id; ?>" onchange="this.form.submit();"
												   class="uk-hidden">
											<?php if (!empty($child->icon))
											{
												echo HTMLHelper::_('image', $child->icon, $child->title, array('title' => $child->title));
											}
											?>
											<div class="uk-text-small"><?php echo $child->title; ?></div>
										</div>
									</label>
								</div>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>

				</div>
			<?php endforeach; ?>
		</div>
	</form>
</div>