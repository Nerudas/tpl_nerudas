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

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Layout\LayoutHelper;

HTMLHelper::_('jquery.framework');

?>
<div id="discussions" class="topic">
	<?php echo LayoutHelper::render('template.title', array('edit' => $this->editLink)); ?>
	<div class="uk-panel uk-panel-box">
		<div class="first">
			<div class="uk-grid">
				<div class="uk-width-medium-1-4">
					<div class="author uk-text-center">
						<div class="avatar uk-position-relative uk-display-inline-block">
							<a class="image uk-avatar-128"
							   style="background-image: url('<?php echo $this->topic->author_avatar; ?>');"
							   href="<?php echo $this->topic->author_link; ?>">
							</a>
							<?php if ($this->topic->author_online): ?>
								<i class="uk-position-bottom-right uk-icon-small uk-icon-profile-state-online"></i>
							<?php endif; ?>
						</div>
						<div class="text">
							<div class="name">
								<a href="<?php echo $this->topic->author_link; ?>">
									<?php echo $this->topic->author_name; ?>
								</a>
							</div>
							<?php if ($this->topic->author_job): ?>
								<div class="job uk-text-uppercase-letter uk-text-small">
									<a class="uk-text-muted" href="<?php echo $this->topic->author_job_link; ?>"
									   target="_blank">
										<?php echo $this->topic->author_job_name; ?>
									</a>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
				<div class="uk-width-medium-3-4">
					<div class="uk-text-nowrap uk-text-right">
						<time class="timeago uk-text-muted uk-text-small uk-text-nowrap uk-margin-small-left"
							  data-uk-tooltip
							  datetime="<?php echo HTMLHelper::date($this->topic->created, 'c'); ?>"
							  title="<?php echo HTMLHelper::date($this->topic->created, 'd.m.Y H:i'); ?>"></time>
					</div>
					<div>
						<?php echo $this->topic->text; ?>
					</div>
				</div>
			</div>
			<?php if (!empty($this->topic->images)): ?>
				<div class="uk-margin-top uk-grid uk-grid-small">
					<?php foreach ($this->topic->images as $image): ?>
						<div class="uk-width-1-3 uk-width-medium-1-5">
							<a href="<?php echo $image->src; ?>"
							   data-uk-lightbox="{group:'topic-<?php echo $this->topic->id; ?>'}">
								<div class="image uk-display-block uk-cover-background"
									 data-ratio-height="[4,3]"
									 style="background-image: url('<?php echo $image->src; ?>');"></div>
							</a>
						</div>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
			<div class="uk-margin-top uk-flex uk-flex-space-between uk-flex-wrap">
				<div>
					<?php if (!empty($this->topic->tags->itemTags)): ?>
						<div class="tags">
							<?php if ($this->topic->tags): ?>
								<?php foreach ($this->topic->tags->itemTags as $tag): ?>
									<span class="uk-tag"><?php echo $tag->title; ?></span>
								<?php endforeach; ?>
							<?php endif; ?>
						</div>
					<?php endif; ?>
				</div>
				<div class="uk-text-right">
					<div class="uk-text-right uk-margin-small-bottom uk-text-nowrap">
						<span class="uk-badge uk-badge-white uk-margin-small-left">
							<i class="uk-icon-eye uk-margin-small-right"></i><?php echo $this->topic->hits; ?>
						</span>
						<a href="<?php echo $this->topic->link; ?>#comments"
						   class="uk-badge uk-badge-white uk-margin-small-left">
							<i class="uk-icon-comment-o uk-margin-small-right"></i>
							<?php echo $this->total; ?>
						</a>
					</div>
				</div>
			</div>
		</div>
		<hr>
		<?php
		$data               = array();
		$data['topic_id']   = $this->topic->id;
		$data['items']      = $this->items;
		$data['total']      = $this->total;
		$data['pagination'] = $this->pagination;
		$data['addForm']    = $this->addPostForm;
		echo LayoutHelper::render('components.com_discussions.posts.list', $data); ?>
	</div>
</div>
