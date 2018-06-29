<?php
/**
 * @package    Nerudas Template
 * @version    4.9.18
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;

HTMLHelper::_('jquery.framework');

HTMLHelper::_('script', 'com_board/form-categories.min.js', array('version' => 'auto', 'relative' => true));

$form       = $displayData->getForm();
$categories = $displayData->getCategories();
$model      = $displayData->getModel();

$children     = array();
$actives      = array();
$actives_full = array();
$root         = array();

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

	if ($category->active && $category->active_full)
	{
		$actives_full[$category->id] = $category->title;
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

?>
<div class="uk-form-row " data-input-boardcategories="<?php echo (!empty($actives)) ? '' : 'show'; ?>">
	<div class="uk-form-row field">
		<div class="uk-flex uk-flex-top uk-flex-wrap">
			<ul class="actives uk-list uk-flex-inline uk-margin-bottom-remove not-extd"
				data-title-extd="<?php echo Text::_('COM_BOARD_ITEM_CATEGORIES_EXTENDED'); ?>">
				<?php foreach ($actives_full as $active): ?>
					<li class="item"><?php echo $active; ?></li>
				<?php endforeach; ?>
				<?php if (empty($actives_full)) : ?>
					<li class="item">
						<?php echo Text::_('COM_BOARD_ITEM_CATEGORIES_EXTENDED'); ?>
					</li>
				<?php endif; ?>
			</ul>
			<div class="uk-display-inline-block">
				<a href="#categorySelect" class="uk-button change" data-uk-modal>
					<?php echo Text::_('TPL_NERUDAS_ACTIONS_CLARIFY'); ?>
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

			<div id="categoriesTabs">
				<?php foreach ($root as $item): ?>
					<div class="categories uk-hidden">
						<?php if (!empty($children[$item->id])): ?>
							<div class="uk-grid uk-grid-small" data-uk-grid-margin data-uk-grid-match>
								<?php foreach ($children[$item->id] as $child) : ?>
									<div class="uk-text-center uk-width-xsmall-1-3 uk-width-small-1-4 uk-width-medium-1-5 uk-width-large-1-5 uk-width-xlarge-1-5">
										<a class="uk-display-block uk-link-muted item <?php if ($child->active) echo 'active'; ?>"
										   data-tags="[<?php echo implode(',', $child->tags); ?>]"
										   data-title="<?php echo $child->title; ?>">
											<div>
												<?php if (!empty($child->icon))
												{
													echo HTMLHelper::_('image', $child->icon, $child->title, array('title' => $child->title));
												}
												?>
												<div class="uk-text-small"><?php echo $child->title; ?></div>
											</div>
										</a>
									</div>
								<?php endforeach; ?>
							</div>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
				<div>
					<div>
						<ul class="actives extd uk-list inline">
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

