<?php
/**
 * @package    Nerudas Template
 * @version    4.9.33
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;
?>

<div id="add" class="itemlist uk-margin-large-bottom"
	 data-uk-scrollspy="{cls:'uk-animation-fade uk-invisible', target:' .item', delay:50}">
	<div class="uk-grid uk-grid-small" data-uk-grid-margin data-uk-grid-match>
		<?php foreach ($list as $item): ?>
			<?php if ($item->type == 'heading'): ?>
				<div id="item-<?php echo $item->id; ?>" class="anchor item uk-invisible uk-width-1-1">
					<div class="uk-deviver-linetext uk-text-center ">
						<span class="uk-text-mlarge">
							<?php echo $item->title; ?>
						</span>
					</div>
				</div>
			<?php endif; ?>
			<?php if ($item->type == 'url'): ?>
				<div id="item-<?php echo $item->id; ?>"
					 class="item uk-invisible uk-text-center uk-width-xsmall-1-3 uk-width-small-1-4 uk-width-medium-1-5 uk-width-large-1-5 uk-width-xlarge-1-5">
					<a href="<?php echo $item->flink; ?>" class="uk-display-block uk-link-muted">
						<img src="<?php echo $item->menu_image; ?>" alt="<?php echo $item->title; ?>"
							 data-uk-tooltip="{pos:'bottom'}" title="<?php echo $item->title; ?>"/>
						<br/>
						<?php echo $item->title; ?>
					</a>
				</div>
			<?php endif; ?>
		<?php endforeach; ?>
	</div>
</div>
