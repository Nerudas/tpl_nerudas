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

use Joomla\CMS\Language\Text;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Factory;

require_once JPATH_THEMES . '/nerudas/helper.php';
$showAdvansedFiler = tplNerudasHelper::checkAdvansedFilterActivity($this->filterForm,
	array('for_when', 'price', 'payment_method', 'prepayment', 'allregion', 'onlymy'));

HTMLHelper::_('formbehavior.chosen', 'select');
?>

<div id="board" class="itemlist">
	<?php echo LayoutHelper::render('template.title', array('add' => $this->addLink)); ?>
	<div class="uk-panel uk-panel-box uk-margin-bottom uk-panel-box-secondary">
		<form action="<?php echo htmlspecialchars(Factory::getURI()->toString()); ?>" method="get" name="adminForm"
			  class="uk-form filter">
			<div class="uk-form-row">
				<div class="uk-grid uk-grid-small" data-uk-margin>
					<div class="uk-width-small-1-2 uk-width-medium-3-5 uk-flex uk-flex-space-between">
						<?php
						$class = $this->filterForm->getFieldAttribute('search', 'class', '', 'filter') . ' uk-width-1-1';
						$this->filterForm->setFieldAttribute('search', 'class', $class, 'filter');
						echo $this->filterForm->getInput('search', 'filter'); ?>
						<div class="uk-button-group left-input advanced-fiter
							<?php echo ($showAdvansedFiler) ? 'uk-hidden' : ''; ?>">
							<a href="<?php echo $this->category->link; ?>"
							   class="uk-button uk-text-danger uk-icon-times">
							</a>
							<button type="submit" class="uk-button uk-text-primary uk-icon-search"
									title="<?php echo Text::_('JSEARCH_FILTER_SUBMIT'); ?>" data-uk-tooltip>
							</button>
						</div>
					</div>
					<div class="uk-width-small-1-2 uk-width-medium-2-5">
						<?php
						$class = $this->filterForm->getFieldAttribute('category', 'class', '', 'filter') . ' uk-width-1-1';
						$this->filterForm->setFieldAttribute('category', 'class', $class, 'filter');
						echo $this->filterForm->getInput('category', 'filter'); ?>
					</div>
				</div>
			</div>
			<div class="uk-form-row advanced-fiter uk-text-right <?php echo ($showAdvansedFiler) ? 'uk-hidden' : ''; ?>">
				<a data-uk-toggle="{target:'.advanced-fiter'}">
					<?php echo Text::_('TPL_NERUDAS_ADVANCED_FITER'); ?>
				</a>
			</div>
			<div class="uk-form-row advanced-fiter <?php echo (!$showAdvansedFiler) ? ' uk-hidden' : ''; ?>">
				<?php echo $this->filterForm->getInput('price', 'filter'); ?>
			</div>
			<div class="advanced-fiter <?php echo (!$showAdvansedFiler) ? ' uk-hidden' : ''; ?>">
				<div class="uk-grid uk-grid-small" data-uk-margin>
					<div class="uk-width-medium-1-3">
						<?php echo $this->filterForm->renderField('payment_method', 'filter'); ?>
					</div>
					<div class="uk-width-medium-1-3">
						<?php echo $this->filterForm->renderField('prepayment', 'filter'); ?>
					</div>
					<div class="uk-width-medium-1-3">
						<?php echo $this->filterForm->renderField('for_when', 'filter'); ?>
					</div>
				</div>
			</div>
			<div class="uk-form-row advanced-fiter <?php echo (!$showAdvansedFiler) ? ' uk-hidden' : ''; ?>">
				<div class="uk-flex uk-flex-wrap uk-flex-space-between uk-flex-middle">
					<div class="">
						<div class="uk-flex-inline uk-margin-right uk-margin-top">
							<?php $allregions = $this->filterForm->getField('allregions', 'filter'); ?>
							<label for="<?php echo $allregions->id; ?>">
								<?php echo $this->filterForm->getInput('allregions', 'filter'); ?>
								<?php echo Text::_($allregions->label); ?>
							</label>
						</div>
						<?php if (!Factory::getUser()->guest):
							$onlymy = $this->filterForm->getField('onlymy', 'filter');
							?>
							<div class="uk-flex-inline uk-flex-middle uk-margin-top">
								<label for="<?php echo $onlymy->id; ?>">
									<?php echo $this->filterForm->getInput('onlymy', 'filter'); ?>
									<?php echo Text::_('COM_BOARD_ONLYMY_ITEMS'); ?>
								</label>
							</div>
						<?php endif; ?>
					</div>
					<div class="uk-flex-inline uk-margin-top">
						<div class="uk-button-group">
							<a href="<?php echo $this->category->link; ?>" class="uk-button uk-button-danger">
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
			$i = 1;
			foreach ($this->items as $id => $item):?>
				<?php if ($i == $half): ?>

				<?php endif; ?>

				<div class="uk-panel uk-panel-box uk-margin-bottom">
					<div class="uk-flex uk-flex-space-between">
						<?php echo LayoutHelper::render('content.author.horizontal', $item->created_by); ?>
						<div class="uk-text-right">
							<div class="uk-text-nowrap">
								<time class="timeago uk-text-muted uk-text-small uk-text-nowrap uk-margin-small-left"
									  data-uk-tooltip
									  datetime="<?php echo HTMLHelper::date($item->created, 'c'); ?>"
									  title="<?php echo HTMLHelper::date($item->created, 'd.m.Y H:i'); ?>"></time>
							</div>
							<div class="uk-text-right uk-margin-small-bottom uk-text-nowrap">
								<span href="<?php echo $item->link; ?>"
									  class="uk-badge uk-badge-white uk-margin-small-left">
									<i class="uk-icon-eye uk-margin-small-right"></i><?php echo $item->hits; ?>
								</span>
								<span href="<?php echo $item->link; ?>"
									  class="uk-badge uk-badge-white uk-margin-small-left">
									<i class="uk-icon-comment-o uk-margin-small-right"></i>0
								</span>
							</div>
						</div>
					</div>

					<div class="uk-margin-top uk-grid uk-grid-small">
						<div class="uk-width-small-2-3">
							<h2 class="uk-h4 uk-link-muted uk-margin-small-bottom">
								<a class="uk-display-block" href="<?php echo $item->link; ?>">
									<?php echo $item->title; ?>
									<?php if ($item->for_when == 'today'): ?>
										<sup class="uk-badge uk-badge-success uk-margin-small-left">
											<?php echo Text::_('COM_BOARD_ITEM_FOR_WHEN_TODAY'); ?></sup>
									<?php elseif ($item->for_when == 'tomorrow'): ?>
										<sup class="uk-badge uk-badge-notification uk-margin-small-left">
											<?php echo Text::_('COM_BOARD_ITEM_FOR_WHEN_TOMORROW'); ?></sup>
									<?php endif; ?>
								</a>
							</h2>
							<div class="uk-text-small">
								<?php echo HTMLHelper::_('string.truncate', (strip_tags($item->text)), 100); ?>
							</div>
						</div>
						<div class="uk-width-small-1-3 uk-flex uk-flex-top uk-flex-right">
							<?php if (!empty($item->price) ||
								$item->payment_method == 'cashless' || $item->payment_method == 'cash' ||
								$item->prepayment == 'required' || $item->prepayment == 'no') : ?>
								<div href="<?php echo $item->link; ?>" class="uk-price uk-text-right">
									<?php if (!empty($item->price)) : ?>
										<div class="text">
											<?php echo ($item->price == '-0') ? Text::_('JGLOBAL_FIELD_PRICE_CONTRACT_PRICE') :
												$item->price . ' ' . Text::_('JGLOBAL_FIELD_PRICE_CURRENCY_RUB'); ?>
										</div>
									<?php endif; ?>
									<div class="uk-text-right">
										<?php if ($item->payment_method == 'cashless')
										{
											echo HTMLHelper::image('icons/payment_method_cashless.png',
												Text::_('COM_BOARD_ITEM_PAYMENT_METHOD_CASHLESS'),
												array('title'           => Text::_('COM_BOARD_ITEM_PAYMENT_METHOD_CASHLESS'),
												      'data-uk-tooltip' => ''),
												true);

										}
										elseif ($item->payment_method == 'cash')
										{
											echo HTMLHelper::image('icons/payment_method_cash.png',
												Text::_('COM_BOARD_ITEM_PAYMENT_METHOD_CASH'),
												array('title'           => Text::_('COM_BOARD_ITEM_PAYMENT_METHOD_CASH'),
												      'data-uk-tooltip' => ''),
												true);
										} ?>


										<?php if ($item->prepayment == 'required')
										{
											echo HTMLHelper::image('icons/prepayment_required.png',
												Text::_('COM_BOARD_ITEM_PREPAYMENT_REQUIRED'),
												array('title'           => Text::_('COM_BOARD_ITEM_PREPAYMENT_REQUIRED'),
												      'data-uk-tooltip' => ''),
												true);

										}
										elseif ($item->prepayment == 'no')
										{
											echo HTMLHelper::image('icons/prepayment_no.png',
												Text::_('COM_BOARD_ITEM_PREPAYMENT_NO'),
												array('title'           => Text::_('COM_BOARD_ITEM_PREPAYMENT_NO'),
												      'data-uk-tooltip' => ''),
												true);
										} ?>
									</div>
								</div>
							<?php endif; ?>
						</div>
					</div>
					<div class="uk-margin-top uk-grid uk-grid-small">
						<div class="uk-width-small-2-3 uk-flex uk-flex-bottom">
							<?php if ($item->contacts->get('phones', false)) : ?>
								<?php foreach ($item->contacts->get('phones') as $phone): ?>
									<a class="uk-text-xlarge uk-display-block"
									   href="tel:<?php echo $phone->code . $phone->number; ?>">
										<?php $phone->display = (!empty($phone->display)) ?
											$phone->display : $phone->code . $phone->number;
										$regular              = "/(\\+\\d{1})(\\d{3})(\\d{3})(\\d{2})(\\d{2})/";
										$subst                = '$1($2)$3-$4-$5';
										echo preg_replace($regular, $subst, $phone->display); ?>
									</a>
									<?php break; endforeach; ?>
							<?php endif; ?>
						</div>
						<div class="uk-width-small-1-3 uk-flex uk-flex-right uk-flex-bottom">
							<?php
							$item->region = ($item->region == '*') ? 100 : $item->region;
							echo HTMLHelper::image('regions/' . $item->region . '.png', $item->region_name,
								array('title' => $item->region_name, 'data-uk-tooltip' => ''), true); ?>
							<?php if ($item->map): ?>
								<a data-uk-tooltip title="<?php echo Text::_('TPL_NERUDAS_ON_MAP'); ?>"
								   data-map-modal="board_<?php echo $item->id; ?>">
									<?php echo HTMLHelper::image('icons/map_30.png', Text::_('TPL_NERUDAS_ON_MAP'),
										'', true); ?>
								</a>
							<?php endif; ?>
						</div>
					</div>
					<?php if ($item->image) : ?>
						<div class="uk-margin-top">
							<div class="uk-grid uk-grid-small image">
								<?php
								$count = count($item->images);
								foreach ($item->images as $image): ?>
									<div class="uk-container-center
									<?php echo 'uk-width-small-1-' . $count; ?>">
										<a class="uk-position-relative uk-display-block"
										   href="<?php echo $item->link; ?>">
											 <span class="image uk-thumbnail uk-display-block uk-cover-background"
												   style="background-image: url('<?php echo $image['src']; ?>')"
												   data-ratio-height="[166,125]"></span>
										</a>
									</div>
								<?php endforeach; ?>
							</div>
						</div>
					<?php endif; ?>
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
				<?php $i++; endforeach; ?>
		</div>
		<div>
			<?php echo $this->pagination->getPagesLinks(); ?>
		</div>
	<?php endif; ?>
</div>



