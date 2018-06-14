<?php
/**
 * @package    Nerudas Template
 * @version    4.9.14
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;

?>
<div class="board-lastes-module uk-margin-small-top">
	<div class="uk-margin-bottom uk-text-right">
		<a href="<?php echo $addLink; ?>" class="uk-button uk-button uk-button-success">
			<?php echo Text::_('TPL_NERUDAS_ACTIONS_ADD'); ?>
		</a>
	</div>
	<?php if ($items) : ?>
		<div class="items">
			<?php foreach ($items as $id => $item): ?>
				<div class="item uk-margin-bottom uk-panel uk-panel-box uk-padding-remove">
					<div class="uk-grid uk-grid-collapse" data-uk-grid-match="" data-uk-grid-margin="">
						<div class="uk-width-medium-1-4">
							<?php if ($item->image) : ?>
								<a class="uk-display-block image uk-thumbnail uk-display-block uk-cover-background"
								   href="<?php echo $item->link; ?>" target="_blank"
								   style="background-image: url('<?php echo $item->image; ?>'); min-height: 90px"
								>
								</a>
							<?php endif; ?>
						</div>
						<div class="uk-width-medium-3-4">
							<div class="uk-padding">
								<div class=" uk-margin-small-bottom uk-flex-wrap uk-flex uk-flex-space-between uk-flex-middle">
									<a class="uk-link-muted uk-text-large" href="<?php echo $item->link; ?>"
									   target="_blank">
										<?php echo $item->title; ?>
									</a>
									<a href="<?php echo $item->editLink; ?>"
									   class=" uk-icon-pencil uk-link-muted"></a>
								</div>
								<div class="uk-flex-wrap uk-flex uk-flex-space-between uk-flex-middle">
									<div>
									<span class="uk-badge uk-badge-white uk-margin-small-right">
										<?php echo $item->region_name; ?></span>

										<span class="uk-badge uk-badge-white uk-margin-small-right">
										<i class="uk-icon-eye uk-margin-small-right"></i><?php echo $item->hits; ?></span>

										<span class="uk-badge uk-badge-white">
										<i class="uk-icon-comment-o uk-margin-small-right"></i>0</span>
									</div>
									<div>
										<time class="timeago uk-text-muted uk-text-small uk-text-nowrap uk-margin-small-left"
											  data-uk-tooltip
											  datetime="<?php echo HTMLHelper::date($item->created, 'c'); ?>"
											  title="<?php echo HTMLHelper::date($item->created, 'd.m.Y H:i'); ?>"></time>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
			<div class="more uk-text-center">
				<a href="<?php echo $categoryLink; ?>"
				   class="uk-button uk-button-large uk-width-1-1 uk-text-center">
					<?php echo Text::_('TPL_NERUDAS_SHOWMORE'); ?>
				</a>
			</div>
		</div>
	<?php endif; ?>
</div>