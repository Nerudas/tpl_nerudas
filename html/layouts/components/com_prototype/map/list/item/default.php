<?php
/**
 * @package    Nerudas Template
 * @version    4.9.40
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;
use Joomla\CMS\Language\Text;

extract($displayData);

/**
 * Layout variables
 * -----------------
 * @var   \Joomla\Registry\Registry $item     Item data
 * @var  \Joomla\Registry\Registry  $author   Author data
 * @var   \Joomla\Registry\Registry $category Author data
 * @var   \Joomla\Registry\Registry $preset   Author data
 */
?>
<div class="item" data-show="false" data-prototype-item="<?php echo $item->get('id'); ?>">
	<a class="uk-link-muted uk-display-block  uk-padding"
	   data-prototype-map-show-balloon="<?php echo $item->get('id'); ?>">
		<div class="title uk-grid uk-grid-small">
			<div class="uk-width-medium-<?php echo ($item->get('price', false)) ? '3-5' : '1-1'; ?>">
				<div class="uk-text-medium">
					<?php echo $item->get('title'); ?>
					<?php if (!empty($item->get('images'))): ?>
						<i class="uk-icon-photo"></i>
					<?php endif; ?>
					<?php if (!$item->get('active')): ?>
						<span class="uk-badge uk-badge-danger">
							<?php echo Text::_('TPL_NERUDAS_PROTOTYPE_NOACTIVE'); ?>
						</span>
					<?php endif; ?>
				</div>
				<div class="uk-text-small uk-text-muted uk-text-lowercase">
					<?php if ($category->get('parent_level') > 1): ?>
						<span><?php echo $category->get('parent_title'); ?> </span>
					<?php endif; ?>
					<span><?php echo $category->get('title'); ?></span>
				</div>
			</div>
			<?php if ($item->get('price', false)) : ?>
				<div class="uk-width-medium-2-5 uk-text-right">
					<div class="price uk-margin-small-top">
						<div>
							<span class="uk-text-bold">
								<?php echo ($item->get('price') > 0) ? $item->get('price') : '---'; ?>
							</span>
							<span class="uk-text-muted uk-text-uppercase uk-text-mini">
								<span>₽</span>
								<?php if (!empty($preset->get('price'))) : ?>
									<span> / </span>
									<?php echo $preset->get('price')->title; ?>
								<?php endif; ?>
							</span>
						</div>
					</div>
				</div>
			<?php endif; ?>
		</div>
		<?php if (!empty($item->get('text'))): ?>
			<div class="text uk-text-small uk-margin-small-top">
				<?php echo JHtmlString::truncate($item->get('text'), 70, false, false); ?>
			</div>
		<?php endif; ?>
	</a>
	<?php if ($author->get('contacts', false) && is_object($item->get('payment_down', false))
		&& !$item->get('payment_down')->end) : ?>
		<div class="uk-text-center">
			<?php if (!empty($author->get('contacts')->phones)) : ?>
				<?php foreach ($author->get('contacts')->phones as $phone): ?>
					<a class="uk-display-block uk-margin-bottom"
					   href="tel:<?php echo $phone->code . $phone->number; ?>">
						<?php $phone->display = (!empty($phone->display)) ?
							$phone->display : $phone->code . $phone->number;

						$regular = "/(\\+\\d{1})(\\d{3})(\\d{3})(\\d{2})(\\d{2})/";
						$subst   = '$1($2)$3-$4-$5';
						$display = preg_replace($regular, $subst, $phone->display); ?>
						<span class="uk-text-large uk-hidden-small">
							<?php echo $display; ?>
						</span>
						<span class="uk-text-medium uk-hidden-medium uk-hidden-large">
							<?php echo $display; ?>
						</span>
					</a>
					<?php break;
				endforeach; ?>
			<?php endif; ?>
		</div>
	<?php endif; ?>
</div>