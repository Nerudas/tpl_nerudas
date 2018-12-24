<?php
/**
 * @package    Nerudas Template
 * @version    4.9.38
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;
use Joomla\CMS\HTML\HTMLHelper;

?>
<div class="discussions-lastes-topics-module uk-margin-small-top uk-panel uk-panel-box uk-margin-bottom">
	<div class="uk-margin-bottom uk-text-right">
		<a href="<?php echo $addLink; ?>" class="uk-button uk-button uk-button-success">
			<?php echo Text::_('TPL_NERUDAS_ACTIONS_ADD'); ?>
		</a>
	</div>
	<?php if ($items) : ?>
		<div class="items uk-margin-bottom">
			<?php $i = 0;
			foreach ($items as $item):
				if ($i > 0) echo '<hr>';
				?>
				<div class="item">
					<div class="uk-grid uk-grid-small" data-uk-grid-match data-uk-grid-margin>
						<div class="uk-width-medium-2-3 uk-flex uk-flex-middle">
							<div>
								<h2 class="uk-text-normal uk-margin-small-bottom">
									<a href="<?php echo $item->link; ?>">
										<?php echo $item->title; ?>
										<?php if ($item->postsCount > 0): ?>
											<sup class="uk-text-muted uk-hidden">[<?php echo $item->postsCount; ?>
												]</sup>
										<?php endif; ?>
									</a>
								</h2>
								<div class="uk-text-small">
									<?php echo JHtmlString::truncate($item->text, 100, false, false); ?>
								</div>
								<?php if (!empty($item->images)): ?>
									<div class="uk-margin-small-top uk-grid uk-grid-small">
										<?php foreach ($item->images as $image): ?>
											<div class="uk-width-1-3 uk-width-medium-1-5">

												<div class="image uk-display-block uk-cover-background"
													 data-ratio-height="[4,3]"
													 style="background-image: url('<?php echo $image->src; ?>');"></div>

											</div>
										<?php endforeach; ?>
									</div>
								<?php endif; ?>
								<?php if (!empty($item->tags->itemTags)): ?>
									<div class="uk-margin-small-top tags uk-text-small uk-text-muted uk-hidden">
										<?php if ($item->tags): ?>
											<?php foreach ($item->tags->itemTags as $tag): ?>
												<span class="uk-margin-small-right uk-text-nowrap">#<?php echo $tag->title; ?></span>
											<?php endforeach; ?>
										<?php endif; ?>
									</div>
								<?php endif; ?>
								<div class="uk-text-small uk-text-muted uk-margin-small-top uk-flex uk-flex-wrap uk-flex-middle">
									<a href="<?php echo $item->link; ?>"
									   class="uk-text-nowrap uk-text-small uk-text-muted">
										<?php echo $item->author->name; ?>
									</a>

									<a href="<?php echo $item->link; ?>"
									   class="uk-margin-small-left uk-text-nowrap uk-text-small uk-text-muted">
										<?php echo HTMLHelper::date($item->created, 'd.m.y'); ?>
									</a>

									<a href="<?php echo $item->link; ?>"
									   class="uk-badge uk-badge-white uk-margin-small-left uk-text-nowrap uk-text-small uk-text-muted">
										<i class="uk-icon-eye uk-margin-small-right"></i><?php echo $item->hits; ?>
									</a>
									<a href="<?php echo $item->last_post_link; ?>"
									   class="uk-badge uk-badge-white uk-margin-small-left uk-text-nowrap uk-text-small uk-text-muted">
										<i class="uk-icon-comment-o uk-margin-small-right"></i>
										<?php echo $item->postsCount; ?>
									</a>

								</div>
							</div>
						</div>
						<div class="uk-width-medium-1-3 uk-flex uk-flex-top">
							<div class="last_post uk-clearfix uk-width-1-1 uk-text-small">
								<div class="avatar uk-position-relative uk-display-inline-block uk-align-left
								uk-margin-small-top  uk-margin-bottom-remove">
									<a class="image uk-avatar-36"
									   style="background-image: url('<?php echo $item->last_post_author->avatar; ?>');"
									   href="<?php echo $item->last_post_link; ?>">
									</a>
									<?php if ($item->last_post_author->online): ?>
										<i class="uk-position-bottom-right uk-icon-profile-state-online"></i>
									<?php endif; ?>
								</div>
								<div class="text uk-text-ellipsis">
									<div class="name">
										<a href="<?php echo $item->last_post_link; ?>" class="uk-link-muted">
											<?php echo $item->last_post_author->name; ?>
										</a>
									</div>
									<div class="uk-text-muted uk-text-small uk-text-nowrap uk-text-lowercase">
										<time class="timeago"
											  data-uk-tooltip
											  datetime="<?php echo HTMLHelper::date($item->last_post_created, 'c'); ?>"
											  title="<?php echo HTMLHelper::date($item->last_post_created, 'd.m.Y H:i'); ?>"></time>
										<a href="<?php echo $item->last_post_link; ?>" class="uk-text-muted">
											...
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php $i++;
			endforeach; ?>
		</div>
		<div class="more uk-text-center">
			<a href="<?php echo $tagLink; ?>"
			   class="uk-button uk-button-large uk-width-1-1 uk-text-center">
				<?php echo Text::_('TPL_NERUDAS_SHOWMORE'); ?>
			</a>
		</div>
	<?php endif; ?>
</div>
