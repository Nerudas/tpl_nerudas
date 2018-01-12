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

HTMLHelper::_('formbehavior.chosen', 'select');

?>

<div id="board" class="itemlist">
	<?php echo LayoutHelper::render('template.title', array('add' => $this->addLink)); ?>
	<div class="uk-panel uk-panel-box uk-margin-bottom uk-panel-box-secondary">
		<form action="<?php echo htmlspecialchars(Factory::getURI()->toString()); ?>" method="get" name="adminForm"
			  class="uk-form filter">
			<div class="uk-form-row">
				<div class="uk-grid uk-grid-small" data-uk-margin>
					<div class="uk-width-small-1-2 uk-width-medium-3-5">
						<?php
						$class = $this->filterForm->getFieldAttribute('search', 'class', '', 'filter') . ' uk-width-1-1';
						$this->filterForm->setFieldAttribute('search', 'class', $class, 'filter');
						$this->filterForm->setFieldAttribute('search', 'onchange', 'this.form.submit();', 'filter');
						echo $this->filterForm->getInput('search', 'filter'); ?>
					</div>
					<div class="uk-width-small-1-2 uk-width-medium-2-5">
						<?php
						$class = $this->filterForm->getFieldAttribute('category', 'class', '', 'filter') . ' uk-width-1-1';
						$this->filterForm->setFieldAttribute('category', 'class', $class, 'filter');
						echo $this->filterForm->getInput('category', 'filter'); ?>
					</div>
				</div>
			</div>
			<div class="uk-form-row advanced-fiter uk-text-right">
				<a data-uk-toggle="{target:'.advanced-fiter'}">
					<?php echo Text::_('TPL_NERUDAS_ADVANCED_FITER'); ?>
				</a>
			</div>
			<div class="uk-form-row uk-hidden advanced-fiter">
				<?php echo $this->filterForm->getInput('price', 'filter'); ?>
			</div>
			<div class="uk-hidden advanced-fiter">
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
			<div class="uk-form-row uk-hidden advanced-fiter">
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
			<?php foreach ($this->items as $id => $item):
				//echo '<pre>', print_r($item, true), '</pre>';
				?>
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
								<a href="<?php echo $item->link; ?>"
								   class="uk-badge uk-badge-white uk-margin-small-left">
									<i class="uk-icon-eye uk-margin-small-right"></i><?php echo $item->hits; ?>
								</a>
								<a href="<?php echo $item->link; ?>"
								   class="uk-badge uk-badge-white uk-margin-small-left">
									<i class="uk-icon-comment-o uk-margin-small-right"></i>0
								</a>
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
								<a href="<?php echo $item->link; ?>" class="uk-price uk-text-right">
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
												Text::_('COM_BOARD_ITEM_PAYMENT_METHOD_CASHLESS'), '', true);

										}
										elseif ($item->payment_method == 'cash')
										{
											echo HTMLHelper::image('icons/payment_method_cash.png',
												Text::_('COM_BOARD_ITEM_PAYMENT_METHOD_CASH'), '', true);
										} ?>


										<?php if ($item->prepayment == 'required')
										{
											echo HTMLHelper::image('icons/prepayment_required.png',
												Text::_('COM_BOARD_ITEM_PREPAYMENT_REQUIRED'), '', true);

										}
										elseif ($item->prepayment == 'no')
										{
											echo HTMLHelper::image('icons/prepayment_no.png',
												Text::_('COM_BOARD_ITEM_PREPAYMENT_NO'), '', true);
										} ?>
									</div>
								</a>
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
								'', true); ?>
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
			<?php endforeach; ?>
		</div>
	<?php endif; ?>
</div>

<? /*
 <?php echo ($count > 1) ? 'uk-width-small-1-' . $count : 'uk-width-small-1-2'; ?>">
 <?php echo HTMLHelper::image($image['src'], $item->title, '', false); ?>
 <span class="image uk-thumbnail uk-display-block uk-cover-background"
										  style="background-image: url('<?php echo $item->image; ?>')"
										  data-ratio-height="[166,125]"></span>
 				<div class="uk-position-top-right">
										<?php if (!empty($item->price)) : ?>
											<div class="price uk-text-medium uk-badge uk-badge-white uk-widht-1-1">
												<?php echo $item->price; ?>
												<?php echo Text::_('JGLOBAL_FIELD_PRICE_CURRENCY_RUB'); ?>
											</div>
										<?php else: ?>
										<?php endif; ?>
									</div>
<?php echo '<pre>', print_r($this->category, true), '</pre>'; ?>
<form action="<?php echo htmlspecialchars(Factory::getURI()->toString()); ?>" method="get" name="adminForm">
	<?php foreach ($filters as $filter): ?>
		<?php echo $this->filterForm->renderField(str_replace('filter_', '', $filter), 'filter'); ?>
	<?php endforeach; ?>
	<button type="submit"><?php echo Text::_('JSEARCH_FILTER_SUBMIT'); ?></button>
	<a href="<?php echo $this->category->link; ?>"><?php echo Text::_('JCLEAR'); ?></a>
</form>
<?php if (!empty($this->items))
{
	foreach ($this->items as $item)
	{
		echo '<pre>', print_r($item, true), '</pre>';
	}
}; ?>


<?php echo $this->pagination->getListFooter(); ?>
*/ ?>


