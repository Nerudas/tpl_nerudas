<?php
/**
 * @package    Nerudas Template
 * @version    4.9.17
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
						$class = $this->filterForm->getFieldAttribute('tag', 'class', '', 'filter') . ' uk-width-1-1';
						$this->filterForm->setFieldAttribute('tag', 'class', $class, 'filter');
						echo $this->filterForm->getInput('tag', 'filter'); ?>
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
		<div class="items">
			<?php foreach ($this->items as $item):
				//echo '<pre>', print_r($item, true), '</pre>'; ?>
				<div class="item uk-panel uk-panel-box uk-margin-bottom">
					<div class="title uk-flex uk-flex-space-between">
						<?php $authorData            = new stdClass();
						$authorData->author_link     = $item->last_post_link;
						$authorData->author_name     = $item->last_post_author->name;
						$authorData->author_avatar   = $item->last_post_author->avatar;
						$authorData->author_online   = $item->last_post_author->online;
						$authorData->author_job      = $item->last_post_author->job;
						$authorData->author_job_link = $item->last_post_author->job_link;
						$authorData->author_job_name = $item->last_post_author->job_name;
						echo LayoutHelper::render('content.author.horizontal', $authorData); ?>

						<div class="uk-text-right">
							<div class="uk-text-nowrap">
								<time class="timeago uk-text-muted uk-text-small uk-text-nowrap uk-margin-small-left"
									  data-uk-tooltip
									  datetime="<?php echo HTMLHelper::date($item->last_post_created, 'c'); ?>"
									  title="<?php echo HTMLHelper::date($item->last_post_created, 'd.m.Y H:i'); ?>"></time>
							</div>
							<div class="uk-text-right uk-margin-small-bottom uk-text-nowrap">
								<a href="<?php echo $item->link; ?>"
								   class="uk-badge uk-badge-white uk-margin-small-left">
									<i class="uk-icon-eye uk-margin-small-right"></i><?php echo $item->hits; ?>
								</a>
								<a href="<?php echo $item->link; ?>"
								   class="uk-badge uk-badge-white uk-margin-small-left">
									<i class="uk-icon-comment-o uk-margin-small-right"></i><?php echo $item->postsCount; ?>
								</a>
							</div>
						</div>
					</div>
					<div class="uk-margin-top">

						<h2 class="uk-h4 uk-margin-small-bottom">
							<a class="uk-display-block uk-link-muted" href="<?php echo $item->link; ?>">
								<?php echo $item->title; ?>
								<?php if (!$item->state): ?>
									<sup class="uk-badge uk-badge-warning uk-margin-small-left">
										<?php echo Text::_('TPL_NERUDAS_ONMODERATION'); ?>
									</sup>
								<?php endif; ?>
							</a>
						</h2>
						<a class="uk-display-block uk-link-muted" href="<?php echo $item->last_post_link; ?>">
							<?php
							$text = JHtmlString::truncate($item->last_post_text, 150, false, false);
							$text = str_replace('...', '', $text);
							?>
							<span class="uk-text-small"><?php echo !empty($text) ? $text . '... ' : ''; ?></span>
							<span class="uk-link"><?php echo Text::_('TPL_NERUDAS_READMORE'); ?></span>
						</a>
					</div>
					<?php if (!empty($item->tags->itemTags)): ?>
						<div class="tags uk-margin-top">
							<?php foreach ($item->tags->itemTags as $tag): ?>
								<span class="uk-tag<?php echo ($tag->main) ? ' uk-tag-primary' : '' ?>">
									<?php echo $tag->title; ?>
								</span>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>
				</div>
			<?php endforeach; ?>
		</div>
		<?php if (!empty($this->pagination->getPagesLinks())): ?>
			<?php echo $this->pagination->getListFooter(); ?>
		<?php endif; ?>
	<?php endif; ?>
</div>
