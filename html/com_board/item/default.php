<?php
/**
 * @package    Nerudas Template
 * @version    4.9.8
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

HTMLHelper::_('jquery.framework');

HTMLHelper::_('script', '//api-maps.yandex.ru/2.1/?lang=ru-RU', array('version' => 'auto', 'relative' => true));


if ($this->item->map)
{
	HTMLHelper::_('script', '//api-maps.yandex.ru/2.1/?lang=ru-RU', array('version' => 'auto', 'relative' => true));
	HTMLHelper::_('script', 'tabsmap.min.js', array('version' => 'auto', 'relative' => true));
	$map                        = $this->item->map->toArray();
	$map['params']['container'] = 'mapTab';
	Factory::getDocument()->addScriptOptions('board_' . $this->item->id, $map);
}

?>
<div id="board" class="item">
	<?php echo LayoutHelper::render('template.title', array('edit' => $this->editLink)); ?>
	<?php if ($this->item->image) : ?>
		<div class="uk-slidenav-position uk-slidenav-imagenavs uk-position-relative uk-header-slideshow"
			 data-uk-slideshow="{autoplay:true}">
			<ul class="uk-slideshow">
				<?php foreach ($this->item->images as $image): ?>
					<li>
						<div class="image uk-display-block uk-cover-background"
							 style="background-image: url('<?php echo $image['src']; ?>');">
						</div>
					</li>
				<?php endforeach; ?>
			</ul>
			<a href="" class="uk-slidenav uk-slidenav-previous" data-uk-slideshow-item="previous"></a>
			<a href="" class="uk-slidenav uk-slidenav-next" data-uk-slideshow-item="next"></a>
			<div class="uk-position-bottom-right uk-position-z-index navigation">
				<ul class=" uk-grid uk-grid-collapse">
					<?php $i = 0;
					foreach ($this->item->images as $image): ?>
						<li data-uk-slideshow-item="<?php echo $i; ?>">
							<a href="">
								<div class="image uk-display-block uk-cover-background"
									 style="background-image: url('<?php echo $image['src']; ?>');"></div>
							</a>
						</li>
						<?php $i++; ?>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
	<?php endif; ?>
	<div class="uk-panel uk-panel-box uk-margin-bottom">
		<div class="uk-flex uk-flex-space-between">
			<?php echo LayoutHelper::render('content.author.horizontal', $this->item); ?>
			<div class="uk-text-right">
				<div class="uk-text-nowrap">
					<time class="timeago uk-text-muted uk-text-small uk-text-nowrap uk-margin-small-left"
						  data-uk-tooltip
						  datetime="<?php echo HTMLHelper::date($this->item->created, 'c'); ?>"
						  title="<?php echo HTMLHelper::date($this->item->created, 'd.m.Y H:i'); ?>"></time>
				</div>
				<div class="uk-text-right uk-margin-small-bottom uk-text-nowrap">
					<span class="uk-badge uk-badge-white uk-margin-small-left">
						<i class="uk-icon-eye uk-margin-small-right"></i><?php echo $this->item->hits; ?>
					</span>
					<a href="<?php echo $this->item->link; ?>#comments"
					   class="uk-badge uk-badge-white uk-margin-small-left">
						<i class="uk-icon-comment-o uk-margin-small-right"></i>0
					</a>
				</div>
			</div>
		</div>
	</div>
	<ul class="uk-tab-new uk-margin-bottom-remove" data-uk-switcher="{connect:'#boardTabs', swiping: false}">
		<li><a href="#text"><?php echo Text::_('COM_BOARD_ITEM'); ?></a></li>
		<?php if ($this->item->contacts) : ?>
			<li><a href="#contacts"><?php echo Text::_('COM_BOARD_ITEM_CONTACTS'); ?></a></li>
		<?php endif; ?>
		<?php if ($this->item->image) : ?>
			<li><a href="#images"><?php echo Text::_('COM_BOARD_ITEM_IMAGES'); ?></a></li>
		<?php endif; ?>
		<?php if ($this->item->map): ?>
			<li><a href="#map"><?php echo Text::_('TPL_NERUDAS_ON_MAP'); ?></a></li>
		<?php endif; ?>
		<li><a href="#comments"><?php echo Text::_('TPL_NERUDAS_COMMENTS'); ?></a></li>
	</ul>

	<ul id="boardTabs" class="uk-switcher" data-uk-switcher-tabs="">
		<li data-tab="text" class="uk-panel uk-panel-box">
			<div>
				<div class="uk-grid uk-grid-small">
					<div class="uk-width-small-2-3">
						<?php echo $this->item->text; ?>
					</div>
					<div class="uk-width-small-1-3">
						<?php if (!empty($this->item->price) ||
							$this->item->payment_method == 'cashless' || $this->item->payment_method == 'cash' ||
							$this->item->prepayment == 'required' || $this->item->prepayment == 'no') : ?>
							<div class="uk-price uk-text-right">
								<?php if (!empty($this->item->price)) : ?>
									<div class="text">
										<?php echo ($this->item->price == '-0') ? Text::_('JGLOBAL_FIELD_PRICE_CONTRACT_PRICE') :
											$this->item->price . ' ' . Text::_('JGLOBAL_FIELD_PRICE_CURRENCY_RUB'); ?>
									</div>
								<?php endif; ?>
								<div class="uk-text-right">
									<?php if ($this->item->payment_method == 'cashless')
									{
										echo HTMLHelper::image('icons/payment_method_cashless.png',
											Text::_('COM_BOARD_ITEM_PAYMENT_METHOD_CASHLESS'),
											array('title'           => Text::_('COM_BOARD_ITEM_PAYMENT_METHOD_CASHLESS'),
											      'data-uk-tooltip' => ''),
											true);

									}
									elseif ($this->item->payment_method == 'cash')
									{
										echo HTMLHelper::image('icons/payment_method_cash.png',
											Text::_('COM_BOARD_ITEM_PAYMENT_METHOD_CASH'),
											array('title'           => Text::_('COM_BOARD_ITEM_PAYMENT_METHOD_CASH'),
											      'data-uk-tooltip' => ''),
											true);
									} ?>


									<?php if ($this->item->prepayment == 'required')
									{
										echo HTMLHelper::image('icons/prepayment_required.png',
											Text::_('COM_BOARD_ITEM_PREPAYMENT_REQUIRED'),
											array('title'           => Text::_('COM_BOARD_ITEM_PREPAYMENT_REQUIRED'),
											      'data-uk-tooltip' => ''),
											true);

									}
									elseif ($this->item->prepayment == 'no')
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
			</div>
			<?php if ($this->item->contacts) : ?>
				<div>
					<dl class="uk-description-list-horizontal">
						<?php if ($this->item->contacts->get('phones', false)) : ?>
							<dt><?php echo Text::_('JGLOBAL_FIELD_PHONES_LABEL'); ?></dt>
							<dd class="uk-margin-bottom">
								<?php foreach ($this->item->contacts->get('phones') as $phone): ?>
									<div class="uk-margin-small-bottom uk-display-block">
										<a class="uk-text-xlarge "
										   href="tel:<?php echo $phone->code . $phone->number; ?>">
											<?php $phone->display = (!empty($phone->display)) ?
												$phone->display : $phone->code . $phone->number;

											$regular = "/(\\+\\d{1})(\\d{3})(\\d{3})(\\d{2})(\\d{2})/";
											$subst   = '$1($2)$3-$4-$5';
											echo preg_replace($regular, $subst, $phone->display); ?>
										</a>
									</div>
								<?php endforeach; ?>
							</dd>
						<?php endif; ?>
						<?php if (!empty($this->item->contacts->get('email', ''))) : ?>
							<dt><?php echo Text::_('JGLOBAL_EMAIL'); ?></dt>
							<dd class="uk-margin-bottom">
								<a class="uk-margin-small-bottom"
								   href="mailto:<?php echo $this->item->contacts->get('email'); ?>">
									<?php echo $this->item->contacts->get('email'); ?>
								</a>
							</dd>
						<?php endif; ?>
						<?php if (!empty($this->item->contacts->get('site', ''))) : ?>
							<dt><?php echo Text::_('COM_PROFILES_PROFILE_SITE'); ?></dt>
							<dd class="uk-margin-bottom">
								<a class="uk-margin-small-bottom"
								   href="<?php echo $this->item->contacts->get('site'); ?>"
								   target="_blank">
									<?php echo trim(str_replace(array('http://', 'https://'), '', $this->item->contacts->get('site')), '/'); ?>
								</a>
							</dd>
						<?php endif; ?>
						<?php if (!empty($this->item->contacts->get('vk', ''))) : ?>
							<dt><?php echo Text::_('JGLOBAL_FIELD_SOCIAL_LABEL_VK'); ?></dt>
							<dd class="uk-margin-bottom">
								<a class="uk-margin-small-bottom"
								   href="https://vk.com/<?php echo $this->item->contacts->get('vk'); ?>"
								   target="_blank">
									vk.com/<?php echo $this->item->contacts->get('vk'); ?>
								</a>
							</dd>
						<?php endif; ?>
						<?php if (!empty($this->item->contacts->get('facebook', ''))) : ?>
							<dt><?php echo Text::_('JGLOBAL_FIELD_SOCIAL_LABEL_FB'); ?></dt>
							<dd class="uk-margin-bottom">
								<a class="uk-margin-small-bottom"
								   href="https://facebook.com/<?php echo $this->item->contacts->get('facebook'); ?>"
								   target="_blank">
									facebook.com/<?php echo $this->item->contacts->get('facebook'); ?>
								</a>
							</dd>
						<?php endif; ?>
						<?php if (!empty($this->item->contacts->get('instagram', ''))) : ?>
							<dt><?php echo Text::_('JGLOBAL_FIELD_SOCIAL_LABEL_INST'); ?></dt>
							<dd class="uk-margin-bottom">
								<a class="uk-margin-small-bottom"
								   href="https://instagram.com/<?php echo $this->item->contacts->get('instagram'); ?>"
								   target="_blank">
									instagram.com/<?php echo $this->item->contacts->get('instagram'); ?>
								</a>
							</dd>
						<?php endif; ?>
					</dl>
				</div>
			<?php endif; ?>
			<?php if (!empty($this->item->tags->itemTags)): ?>
				<hr>
				<div class="uk-margin-small-top tags">
					<?php if ($this->item->tags): ?>
						<?php foreach ($this->item->tags->itemTags as $tag): ?>
							<span class="uk-tag"><?php echo $tag->title; ?></span>
						<?php endforeach; ?>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		</li>
		<?php if ($this->item->contacts) : ?>
			<li data-tab="contacts" class="uk-panel uk-panel-box">
				<div class="uk-text-right">
					<span class="uk-badge uk-badge-white uk-margin-small-left">
						<?php echo $this->item->region_name; ?>
					</span>
				</div>
				<dl class="uk-description-list-horizontal">
					<?php if ($this->item->contacts->get('phones', false)) : ?>
						<dt><?php echo Text::_('JGLOBAL_FIELD_PHONES_LABEL'); ?></dt>
						<dd class="uk-margin-bottom">
							<?php foreach ($this->item->contacts->get('phones') as $phone): ?>
								<div class="uk-margin-small-bottom uk-display-block">
									<a class="uk-text-xlarge "
									   href="tel:<?php echo $phone->code . $phone->number; ?>">
										<?php $phone->display = (!empty($phone->display)) ?
											$phone->display : $phone->code . $phone->number;

										$regular = "/(\\+\\d{1})(\\d{3})(\\d{3})(\\d{2})(\\d{2})/";
										$subst   = '$1($2)$3-$4-$5';
										echo preg_replace($regular, $subst, $phone->display); ?>
									</a>
								</div>
							<?php endforeach; ?>
						</dd>
					<?php endif; ?>
					<?php if (!empty($this->item->contacts->get('email', ''))) : ?>
						<dt><?php echo Text::_('JGLOBAL_EMAIL'); ?></dt>
						<dd class="uk-margin-bottom">
							<a class="uk-margin-small-bottom"
							   href="mailto:<?php echo $this->item->contacts->get('email'); ?>">
								<?php echo $this->item->contacts->get('email'); ?>
							</a>
						</dd>
					<?php endif; ?>
					<?php if (!empty($this->item->contacts->get('site', ''))) : ?>
						<dt><?php echo Text::_('COM_PROFILES_PROFILE_SITE'); ?></dt>
						<dd class="uk-margin-bottom">
							<a class="uk-margin-small-bottom" href="<?php echo $this->item->contacts->get('site'); ?>"
							   target="_blank">
								<?php echo trim(str_replace(array('http://', 'https://'), '', $this->item->contacts->get('site')), '/'); ?>
							</a>
						</dd>
					<?php endif; ?>
					<?php if (!empty($this->item->contacts->get('vk', ''))) : ?>
						<dt><?php echo Text::_('JGLOBAL_FIELD_SOCIAL_LABEL_VK'); ?></dt>
						<dd class="uk-margin-bottom">
							<a class="uk-margin-small-bottom"
							   href="https://vk.com/<?php echo $this->item->contacts->get('vk'); ?>"
							   target="_blank">
								vk.com/<?php echo $this->item->contacts->get('vk'); ?>
							</a>
						</dd>
					<?php endif; ?>
					<?php if (!empty($this->item->contacts->get('facebook', ''))) : ?>
						<dt><?php echo Text::_('JGLOBAL_FIELD_SOCIAL_LABEL_FB'); ?></dt>
						<dd class="uk-margin-bottom">
							<a class="uk-margin-small-bottom"
							   href="https://facebook.com/<?php echo $this->item->contacts->get('facebook'); ?>"
							   target="_blank">
								facebook.com/<?php echo $this->item->contacts->get('facebook'); ?>
							</a>
						</dd>
					<?php endif; ?>
					<?php if (!empty($this->item->contacts->get('instagram', ''))) : ?>
						<dt><?php echo Text::_('JGLOBAL_FIELD_SOCIAL_LABEL_INST'); ?></dt>
						<dd class="uk-margin-bottom">
							<a class="uk-margin-small-bottom"
							   href="https://instagram.com/<?php echo $this->item->contacts->get('instagram'); ?>"
							   target="_blank">
								instagram.com/<?php echo $this->item->contacts->get('instagram'); ?>
							</a>
						</dd>
					<?php endif; ?>
				</dl>
			</li>
		<?php endif; ?>
		<?php if ($this->item->image) : ?>
			<li data-tab="images" class="uk-panel uk-panel-box">
				<div class="uk-grid uk-grid-small image">
					<?php $count = count($this->item->images);
					foreach ($this->item->images as $image): ?>
						<div class="uk-width-small-1-<?php echo ($count > 1) ? 3 : 1; ?> uk-flex uk-flex-center uk-flex-middle">
							<a class="uk-position-relative uk-display-inline-block" href="/<?php echo $image['src']; ?>"
							   data-uk-lightbox="{group:'board_<?php echo $this->item->id; ?>'}">
								<?php echo HTMLHelper::image($image['src'], '', 'class="uk-thumbnail"'); ?>
							</a>
						</div>
					<?php endforeach; ?>
				</div>
			</li>
		<?php endif; ?>
		<?php if ($this->item->map): ?>
			<li data-tab="map" id="mapTab" class="uk-panel uk-panel-box uk-padding-remove"
				data-tabmap="<?php echo 'board_' . $this->item->id; ?>">
			</li>
		<?php endif; ?>
		<li data-tab="comments" class="uk-panel uk-panel-box">
			<div class="uk-text-muted uk-text-large uk-text-center">
				<?php echo Text::_('TPL_NERUDAS_IN_DEVELOPING'); ?>
			</div>
		</li>
	</ul>
</div>
