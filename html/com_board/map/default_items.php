<?php
/**
 * @package    Nerudas Template
 * @version    4.9.15
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;

use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;

?>

<?php if ($this->items): ?>
	<?php foreach ($this->items as $item): ?>
		<div class="item" data-show="false" data-board-item="<?php echo $item->id; ?>">
			<div class="ifnotshow">
				<a class="uk-link-muted uk-display-block  uk-padding uk-text-medium"
				   data-board-show="<?php echo $item->id; ?>">
					<?php echo $item->title; ?>
				</a>
			</div>
			<div class="ifshow uk-padding">
				<?php $item->author_link = $item->link;
				echo LayoutHelper::render('content.author.horizontal', $item); ?>
				<div class="uk-margin-top">
					<div class="">
						<div class="uk-text-nowrap">
							<time class="timeago uk-text-muted uk-text-small uk-text-nowrap uk-margin-small-left"
								  data-uk-tooltip
								  datetime="<?php echo HTMLHelper::date($item->created, 'c'); ?>"
								  title="<?php echo HTMLHelper::date($item->created, 'd.m.Y H:i'); ?>"></time>
						</div>
						<div class=" uk-margin-small-bottom uk-text-nowrap">
							<a href="<?php echo $item->link; ?>"
							   class="uk-badge uk-badge-white uk-margin-small-left">
								<i class="uk-icon-eye uk-margin-small-right"></i><?php echo $item->hits; ?>
							</a>
							<a href="<?php echo $item->link; ?>#comments"
							   class="uk-badge uk-badge-white uk-margin-small-left">
								<i class="uk-icon-comment-o uk-margin-small-right"></i>0
							</a>
						</div>
					</div>
					<h2 class="uk-h4 uk-margin-top uk-margin-small-bottom">
						<a href="<?php echo $item->link; ?>" class="uk-link-muted uk-display-block">
							<?php echo $item->title; ?>
						</a>
					</h2>
					<div class="uk-margin-top">
						<a href="<?php echo $item->link; ?>" class="uk-link-muted uk-display-block">
							<?php
							$text = JHtmlString::truncate($item->text, 100, false, false);
							$text = str_replace('...', '', $text);
							?>
							<span class="uk-text-small"><?php echo !empty($text) ? $text . '... ' : ''; ?></span>
							<span class="uk-link"><?php echo Text::_('TPL_NERUDAS_READMORE'); ?></span>
						</a>
					</div>

					<div class="uk-margin-top">
						<?php if (!empty($item->price) ||
							$item->payment_method == 'cashless' || $item->payment_method == 'cash' ||
							$item->prepayment == 'required' || $item->prepayment == 'no') : ?>
							<div class="uk-price ">
								<?php if (!empty($item->price)) : ?>
									<div class="text">
										<?php echo ($item->price == '-0') ? Text::_('JGLOBAL_FIELD_PRICE_CONTRACT_PRICE') :
											$item->price . ' ' . Text::_('JGLOBAL_FIELD_PRICE_CURRENCY_RUB'); ?>
									</div>
								<?php endif; ?>
								<div class="">
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
									}

									if ($item->prepayment == 'required')
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
						</div>
					</div>
					<?php if ($item->image) : ?>
						<div class="uk-margin-top">
							<a class="uk-display-block image uk-thumbnail" href="<?php echo $item->link; ?>">
								<?php echo HTMLHelper::image($item->image, $item->title, ''); ?>
							</a>
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
			</div>
		</div>
	<?php endforeach; ?>
<?php endif; ?>
<script>
	jQuery('time.timeago').timeago();
</script>


