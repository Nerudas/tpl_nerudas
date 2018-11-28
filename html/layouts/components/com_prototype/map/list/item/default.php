<?php
/**
 * @package    Nerudas Template
 * @version    4.9.35
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;


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
				<div class=" uk-text-medium">
					<?php echo $item->get('title'); ?>
					<?php if (!empty($item->get('images'))): ?>
						<i class="uk-icon-photo"></i>
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
								<?php echo $item->get('price'); ?>
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
</div>