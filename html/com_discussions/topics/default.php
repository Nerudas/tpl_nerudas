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
	<?php echo LayoutHelper::render('template.title',
		array('add' => $this->addLink, 'addText' => 'TPL_NERUDAS_ACTION_NEW_TOPIC')); ?>
	<div class="uk-panel uk-panel-box uk-margin-bottom uk-panel-box-secondary">
		<form action="<?php echo htmlspecialchars(Factory::getURI()->toString()); ?>" method="get" name="adminForm"
			  class="uk-form filter">
			<div class="uk-form-row">
				<div class="uk-grid uk-grid-small" data-uk-margin>
					<div class="uk-width-small-1-2 uk-width-medium-2-5 uk-hidden-large">
						<?php
						$class = $this->filterForm->getFieldAttribute('category', 'class', '', 'filter') . ' uk-width-1-1';
						$this->filterForm->setFieldAttribute('category', 'class', $class, 'filter');
						echo $this->filterForm->getInput('category', 'filter'); ?>
					</div>
					<div class="uk-width-small-1-2 uk-width-medium-3-5 uk-width-large-1-1 uk-flex uk-flex-space-between">
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
				<div class="item">
					<div class="uk-grid uk-grid-small" data-uk-grid-match data-uk-grid-margin>
						<div class="uk-width-medium-1-2 uk-flex uk-flex-top">
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
								<div class="uk-text-small uk-text-muted uk-margin-small-top">
									<a href="<?php echo $item->link; ?>"
									   class="uk-text-nowrap uk-text-small uk-text-muted">
										<?php echo $item->author->name; ?>
									</a>
									<div class="uk-flex uk-flex-wrap uk-flex-middle">
										<a href="<?php echo $item->link; ?>"
										   class="uk-text-nowrap uk-text-small uk-text-muted">
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
								<?php if (!empty($item->images)): ?>
									<div class="uk-margin-small-top uk-grid uk-grid-small">
										<?php foreach ($item->images as $image): ?>
											<div class="uk-width-1-3 uk-width-medium-1-5">
												<div class="image uk-display-block uk-cover-background"
													 data-ratio-height="[4,3]"
													 style="background-image: url('<?php echo $image['src']; ?>');"></div>

											</div>
										<?php endforeach; ?>
									</div>
								<?php endif; ?>
							</div>
						</div>
						<div class="uk-width-medium-1-2 uk-flex uk-flex-top">
							<div>
								<div class="uk-width-1-1 uk-margin-bottom">
									<a href="<?php echo $item->last_post_link; ?>" class="uk-text-muted uk-text-small">
										<?php echo JHtmlString::truncate($item->last_post_text, 70, false, false); ?>
									</a>
								</div>
								<div class="last_post_author uk-clearfix uk-width-1-1 uk-text-small">
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
