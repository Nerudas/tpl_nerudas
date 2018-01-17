<?php
/**
 * @package    Nerudas Template
 * @version    4.9.5
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;

HTMLHelper::_('jquery.framework');

HTMLHelper::_('script', 'com_board/formcategories.min.js', array('version' => 'auto', 'relative' => true));

$form       = $displayData->getForm();
$categories = $displayData->getCategories();
$model      = $displayData->getModel();

$children = array();
$actives  = array();
$root     = array();

$i = 0;
foreach ($categories as $category)
{
	if ($i == 0)
	{
		$first = $category->id;
	}

	if ($category->active)
	{
		$actives[$category->id] = $category->title;
	}

	if ($category->level == 1)
	{
		$root[$category->id] = $category;
	}

	if (!isset($children[$category->parent_id]))
	{
		$children[$category->parent_id] = array();
	}
	$children[$category->parent_id][$category->id] = $category;

	$i++;
}
if (empty($first))
{
	$first = 'extd';
}


$show = ($model->getState('item.id', 0) && !empty($actives)) ? '' : 'show';
?>
<div class="uk-form-row " data-input-boardcategories="<?php echo $show; ?>">
	<div class="uk-form-row field">
		<div class="uk-flex uk-flex-space-between uk-flex-top">
			<ul class="actives uk-list uk-flex-inline">
				<?php foreach ($actives as $active): ?>
					<li class="item">
						<?php echo $active; ?>
					</li>
				<?php endforeach; ?>
			</ul>
			<div class="uk-display-inline-block">
				<a href="#categorySelect" role="button" class="uk-button change" data-uk-modal>
					<?php echo Text::_('JACTION_EDIT'); ?>
				</a>
			</div>
		</div>
	</div>
	<div id="categorySelect" class="uk-modal">
		<div class="uk-modal-dialog uk-modal-dialog-large">
			<a class="uk-modal-close uk-close"></a>
			<div class="uk-h4 uk-modal-header">
				<h3><?php echo Text::_('COM_BOARD_ITEM_CATEGORIES'); ?></h3>
			</div>
			<div class="uk-modal-contnet-large">
				<div class="uk-grid uk-grid-small">
					<div class="uk-width-xsmall-1-1 uk-width-small-2-5 uk-width-medium-1-3 uk-width-large-1-4 uk-width-xlarge-1-4 uk-hidden-xsmall">
						<ul id="categoriesSelectFilter" class="uk-nav uk-nav-side"
							data-uk-tab="{connect:'#categoriesTabs'}">
							<?php foreach ($root as $item): ?>
								<li><a href=""><?php echo $item->title; ?></a></li>
							<?php endforeach; ?>
							<li><a href=""><?php echo Text::_('COM_BOARD_ITEM_CATEGORIES_EXTENDED'); ?></a></li>
						</ul>
					</div>
					<div class="uk-width-xsmall-1-1 uk-width-small-3-5 uk-width-medium-2-3 uk-width-large-3-4 uk-width-xlarge-3-4">
						<div id="categoriesTabs" class="uk-switcher">
							<?php foreach ($root as $item): ?>
								<div class="categories ">
									<?php if (!empty($children[$item->id])): ?>
										<div class="uk-grid uk-grid-collapse uk-margin-small-top">
											<?php foreach ($children[$item->id] as $child) : ?>
												<div class="uk-width-1-2 uk-width-small-1-4 uk-width-medium-1-5">
													<a class="uk-display-block uk-margin-small-bottom uk-margin-small-right
													 item <?php if ($child->active) echo 'active'; ?> uk-text-center uk-link-muted"
													   data-tags="[<?php echo implode(',', $child->tags); ?>]"
													   data-title="<?php echo $child->title; ?>">
														<?php if (!empty($child->icon))
														{
															echo HTMLHelper::_('image', $child->icon, $child->title, array('title' => $child->title));
														}
														?>
														<div class="title"><?php echo $child->title; ?></div>
													</a>
												</div>
											<?php endforeach; ?>
										</div>
									<?php endif; ?>
								</div>
							<?php endforeach; ?>
							<div>
								<div>
									<ul class="actives uk-list inline">
										<?php foreach ($actives as $active): ?>
											<li class="item">
												<?php echo $active; ?>
											</li>
										<?php endforeach; ?>
									</ul>
								</div>
								<?php echo $form->getInput('tags'); ?>
								<div class="uk-margin-top uk-text-right uk-margin-right">
									<button class="uk-button uk-button-primary uk-modal-close">
										<?php echo Text::_('JSAVE'); ?>
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
