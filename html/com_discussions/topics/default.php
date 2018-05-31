<?php
/**
 * @package    Nerudas Template
 * @version    4.9.13
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Factory;
use Joomla\CMS\Layout\LayoutHelper;

HTMLHelper::_('jquery.framework');
HTMLHelper::_('formbehavior.chosen', 'select');

$filters = array_keys($this->filterForm->getGroup('filter'));
?>
<div id="discussions" class="list">
	<?php echo LayoutHelper::render('template.title', array('add' => $this->addLink)); ?>
	<div class="uk-panel uk-panel-box uk-margin-bottom uk-panel-box-secondary">
		<form action="<?php echo htmlspecialchars(Factory::getURI()->toString()); ?>" method="get" name="adminForm"
			  class="uk-form filter">
			<div class="uk-form-row">
				<div class="uk-grid uk-grid-small" data-uk-margin>
					<div class="uk-width-small-1-2 uk-width-medium-2-5">
						<?php
						$class = $this->filterForm->getFieldAttribute('category', 'class', '', 'filter') . ' uk-width-1-1';
						$this->filterForm->setFieldAttribute('category', 'class', $class, 'filter');
						echo $this->filterForm->getInput('category', 'filter'); ?>
					</div>
					<div class="uk-width-small-1-2 uk-width-medium-3-5 uk-flex uk-flex-space-between">
						<?php
						$class = $this->filterForm->getFieldAttribute('search', 'class', '', 'filter') . ' uk-width-1-1';
						$this->filterForm->setFieldAttribute('search', 'class', $class, 'filter');
						echo $this->filterForm->getInput('search', 'filter'); ?>
						<div class="uk-button-group left-input">
							<a href="<?php echo $this->link; ?>"
							   class="uk-button uk-text-danger uk-icon-times">
							</a>
							<button type="submit" class="uk-button uk-text-primary uk-icon-search"
									title="<?php echo Text::_('JSEARCH_FILTER_SUBMIT'); ?>" data-uk-tooltip>
							</button>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
	<?php if ($this->items) : ?>
		<div class="items uk-panel uk-panel-box uk-margin-bottom">
			<?php $i = 0;
			foreach ($this->items as $item):
				if ($i > 0) echo '<hr>';
				?>
				<?php //echo '<pre>', print_r($item, true), '</pre>';
				?>
				<div class="item">
					<div class="uk-grid uk-grid-small" data-uk-grid-match data-uk-grid-margin>
						<div class="uk-width-medium-3-5 uk-flex uk-flex-middle">
							<div>
								<h2 class="uk-text-normal uk-margin-small-bottom">
									<a href="<?php echo $item->link; ?>"><?php echo $item->title; ?></a>
								</h2>
								<div class="uk-text-muted uk-text-small uk-text-lowercase">
									<span>
										<?php echo Text::_('COM_DISCUSSIONS_TOPIC_POSTS_COUNT'); ?>
										 <?php echo $item->postsCount; ?>
									</span>
								</div>
								<div class="uk-text-small uk-text-muted uk-hidden">
									<?php echo JHtmlString::truncate($item->text, 40, false, false); ?>
								</div>
								<?php if (!empty($item->tags->itemTags)): ?>
									<div class="uk-margin-small-top tags uk-hidden">
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
						<div class="uk-width-medium-2-5 uk-flex uk-flex-middle">
							<div class="last_post uk-clearfix uk-width-1-1">
								<div class="avatar uk-position-relative uk-display-inline-block uk-align-left  uk-margin-bottom-remove">
									<a class="image uk-avatar-48"
									   style="background-image: url('<?php echo $item->last_post_author->avatar; ?>');"
									   href="<?php echo $item->last_post_link; ?>">
									</a>
									<?php if ($item->last_post_author->online): ?>
										<i class="uk-position-bottom-right uk-icon-profile-state-online"></i>
									<?php endif; ?>
								</div>
								<div class="text uk-text-ellipsis">
									<div class="name">
										<a href="<?php echo $item->last_post_link; ?>">
											<?php echo $item->last_post_author->name; ?>
										</a>
									</div>
									<div class="uk-text-muted uk-text-small uk-text-nowrap uk-text-lowercase">
										<span>
											<?php echo Text::_('COM_DISCUSSIONS_TOPIC_LAST_POST_DATE'); ?>
										</span>
										<time class="timeago"
											  data-uk-tooltip
											  datetime="<?php echo HTMLHelper::date($item->last_post_created, 'c'); ?>"
											  title="<?php echo HTMLHelper::date($item->last_post_created, 'd.m.Y H:i'); ?>"></time>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php $i++;
			endforeach; ?>
			<?php if (!empty($this->pagination->getPagesLinks())): ?>
				<hr>
				<?php echo $this->pagination->getListFooter(); ?>
			<?php endif; ?>
		</div>
	<?php endif; ?>
</div>
