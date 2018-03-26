<?php
/**
 * @package    Nerudas Template
 * @version    4.9.6
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Factory;

require_once JPATH_THEMES . '/nerudas/helper.php';
$showAdvansedFiler = tplNerudasHelper::checkAdvansedFilterActivity($this->filterForm,
	array('tags', 'regions'));

HTMLHelper::_('jquery.framework');
HTMLHelper::_('formbehavior.chosen', 'select');

?>
<div id="companies" class="itemlist">
	<?php echo LayoutHelper::render('template.title', array('add' => $this->addLink)); ?>
	<div class="uk-panel uk-panel-box uk-margin-bottom uk-panel-box-secondary">
		<form action="<?php echo htmlspecialchars(Factory::getURI()->toString()); ?>" method="get" name="adminForm"
			  class="uk-form filter">
			<div class="uk-form-row">
				<div class="uk-flex uk-flex-space-between">
					<?php
					$class = $this->filterForm->getFieldAttribute('search', 'class', '', 'filter') . ' uk-width-1-1';
					$this->filterForm->setFieldAttribute('search', 'class', $class, 'filter');
					echo $this->filterForm->getInput('search', 'filter'); ?>
					<div class="uk-button-group left-input advanced-fiter
							<?php echo ($showAdvansedFiler) ? 'uk-hidden' : ''; ?>">
						<a href="<?php echo $this->link; ?>"
						   class="uk-button uk-text-danger uk-icon-times">
						</a>
						<button type="submit" class="uk-button uk-text-primary uk-icon-search"
								title="<?php echo Text::_('JSEARCH_FILTER_SUBMIT'); ?>" data-uk-tooltip>
						</button>
					</div>
				</div>

			</div>
			<div class="uk-form-row advanced-fiter uk-text-right <?php echo ($showAdvansedFiler) ? 'uk-hidden' : ''; ?>">
				<a data-uk-toggle="{target:'.advanced-fiter'}">
					<?php echo Text::_('TPL_NERUDAS_ADVANCED_FITER'); ?>
				</a>
			</div>
			<div class="uk-form-row advanced-fiter <?php echo (!$showAdvansedFiler) ? ' uk-hidden' : ''; ?>">
				<?php echo $this->filterForm->getInput('tags', 'filter'); ?>
			</div>
			<div class="uk-form-row advanced-fiter <?php echo (!$showAdvansedFiler) ? ' uk-hidden' : ''; ?>">
				<div class="uk-flex uk-flex-wrap uk-flex-space-between uk-flex-middle">
					<div class="">
						<div class="uk-flex-inline uk-margin-right uk-margin-top">
							<?php $region = $this->filterForm->getField('region', 'filter'); ?>
							<label for="<?php echo $region->id; ?>">
								<?php echo $this->filterForm->getInput('region', 'filter'); ?>
							</label>
						</div>
					</div>
					<div class="uk-flex-inline uk-margin-top">
						<div class="uk-button-group">
							<a href="<?php echo $this->link; ?>" class="uk-button uk-button-danger">
								<?php echo Text::_('JCLEAR'); ?>
							</a>
							<button type="submit" class="uk-button uk-button-primary">
								<?php echo Text::_('JSEARCH_FILTER_SUBMIT'); ?>
							</button>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>

	<?php if ($this->items) : ?>
		<div class="items">
			<?php
			$count = count($this->items);
			$half  = round($count / 2);
			$i     = 1;
			foreach ($this->items as $id => $item): ?>
				<?php if ($i == $half): ?>

				<?php endif; ?>
				<div class="item uk-margin-bottom uk-panel uk-panel-box">
					<div class="uk-grid uk-grid-small">
						<div class="uk-width-small-3-4">
							<div>
								<h2 class="uk-h3 uk-margin-small-bottom">
									<a class="uk-display-block uk-link-muted" href="<?php echo $item->link; ?>">
										<?php echo $item->name; ?>
										<?php if ($item->logo): ?>
											<img class="logo" src="<?php echo $item->logo; ?>"
												 alt="<?php echo $item->name; ?>">
										<?php endif; ?>
									</a>
								</h2>
							</div>

							<div class="uk-text-muted">
								<?php echo HTMLHelper::_('string.truncate', (strip_tags($item->about)), 100); ?>
							</div>

						</div>
						<div class="uk-width-small-1-4">
							<div class="uk-text-right">
								<div class="uk-text-nowrap">
									<time class="timeago uk-text-muted uk-text-small uk-text-nowrap uk-margin-small-left"
										  data-uk-tooltip
										  datetime="<?php echo HTMLHelper::date($item->created, 'c'); ?>"
										  title="<?php echo HTMLHelper::date($item->created, 'd.m.Y H:i'); ?>"></time>
								</div>
								<div class="uk-text-right uk-margin-small-bottom uk-text-nowrap">
									<a href="<?php echo $item->link; ?>"
									   class="uk-badge uk-badge-white uk-margin-small-left">
										<i class="uk-icon-eye uk-margin-small-right"></i><?php echo $item->hits; ?>
									</a>
									<a href="<?php echo $item->link; ?>#comments"
									   class="uk-badge uk-badge-white uk-margin-small-left">
										<i class="uk-icon-comment-o uk-margin-small-right"></i>0
									</a>
									<div class="region uk-margin-top uk-text-small">
										<?php
										echo HTMLHelper::image('regions/' . $item->region . '.png', $item->region_name,
											array('title' => $item->region_name, 'data-uk-tooltip' => ''), true); ?>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php if (!empty($item->tags->itemTags)): ?>
						<div class="uk-margin-small-top tags">
							<?php if ($item->tags): ?>
								<?php foreach ($item->tags->itemTags as $tag): ?>
									<span class="uk-tag">
											<?php echo $tag->title; ?>
										</span>
								<?php endforeach; ?>
							<?php endif; ?>
						</div>
					<?php endif; ?>
				</div>

			<?php endforeach; ?>
		</div>
		<div>
			<?php echo $this->pagination->getPagesLinks(); ?>
		</div>
	<?php endif; ?>
</div>
