<?php
/**
 * @package    Nerudas Template
 * @version    4.9.32
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;

extract($displayData);

/**
 * Layout variables
 * -----------------
 * @var   \Joomla\Registry\Registry $item   Item data
 * @var  \Joomla\Registry\Registry  $author Author data
 * @var   \Joomla\Registry\Registry $preset Author data
 */
?>
<div class="item uk-grid uk-grid-margin uk-grid-small uk-margin-top-remove" data-uk-grid-margin="" data-uk-grid-match=""
	 data-prototype-item="<?php echo $item->get('id'); ?>">
	<div class="uk-width-medium-1-12 uk-text-center">
		<?php if ($preset->get('icon')): ?>
			<?php echo HTMLHelper::image($preset->get('icon'), $preset->get('title', $item->get('title'))); ?>
		<?php endif; ?>
	</div>
	<div class="uk-width-medium-4-12">
		<a class="uk-display-block uk-link-muted" data-prototype-shortcodes-show-balloon="<?php echo $item->get('id'); ?>">
			<div class="uk-h3">
				<?php echo $item->get('title'); ?>
			</div>
			<?php if (!empty($item->get('text'))): ?>
				<div class="uk-text-small uk-text-muted">
					<?php echo JHtmlString::truncate($item->get('text'), 70, false, false); ?>
				</div>
			<?php endif; ?>
		</a>
	</div>
	<div class="uk-width-medium-1-12 uk-text-center">
		<a class="uk-display-block uk-link-muted" data-prototype-shortcodes-show-balloon="<?php echo $item->get('id'); ?>">
			<div class="uk-text-nowrap uk-text-bold uk-text-xlarge">
				<?php if (!empty($item->get('price'))) : ?>
					<?php echo $item->get('price'); ?> ₽
				<?php endif; ?>
			</div>
			<div class="uk-text-muted">
				<?php if (!empty($preset->get('price'))) : ?>
					<?php echo $preset->get('price')->title; ?>
				<?php endif; ?>
			</div>
		</a>
	</div>
	<div class="uk-width-medium-2-12 uk-text-center uk-text-muted">
		<?php echo HTMLHelper::image('templates/nerudas/images/prototype-map-icon.png', ''); ?>
		<?php if (!empty($preset->get('delivery'))) : ?>
			<span> <?php echo $preset->get('delivery')->title; ?></span>
		<?php endif; ?>
		<?php if (!empty($item->get('location'))): ?>
			<span> <?php echo $item->get('location'); ?></span>
		<?php endif; ?>
	</div>
	<div class="uk-width-medium-3-12 uk-flex uk-flex-top">
		<a class="author uk-link-muted uk-display-inline-block"
		   data-prototype-shortcodes-show-author="<?php echo $item->get('id'); ?>">
			<div class="name uk-link">
				<?php echo $author->get('name'); ?>
			</div>
			<?php if (!empty($author->get('signature'))): ?>
				<div class="job uk-text-uppercase-letter uk-text-small  uk-text-small uk-text-muted uk-text-ellipsis">
					[ <?php echo $author->get('signature'); ?> ]
				</div>
			<?php endif; ?>
		</a>
	</div>
	<div class="uk-width-medium-1-12 uk-text-center uk-flex uk-flex-top uk-flex-center">
		<a class="author uk-link-muted uk-display-inline-block"
		   data-prototype-shortcodes-show-author="<?php echo $item->get('id'); ?>">
			<?php echo HTMLHelper::image('templates/nerudas/images/prototype-call-icon.png', ''); ?>
		</a>
	</div>
</div>
