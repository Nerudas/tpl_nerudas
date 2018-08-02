<?php
/**
 * @package    Nerudas Template
 * @version    4.9.24
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Factory;

HTMLHelper::_('jquery.framework');
HTMLHelper::_('formbehavior.chosen', 'select');

?>
<div id="profiles" class="itemlist">
	<?php echo LayoutHelper::render('template.title', array()); ?>
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
						<div class="uk-button-group left-input advanced-fiter">
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
			<?php foreach ($this->items as $id => $item): ?>
				<div class="item uk-margin-large-bottom ">
					<div class="avatar <?php echo ($item->online) ? ' online' : '' ?>">
						<a href="<?php echo $item->link; ?>" class="image"
						   style="background-image: url('<?php echo $item->avatar; ?>')">
						</a>
					</div>
					<div class="content">
						<div class="uk-grid uk-grid-small">
							<div class="uk-width-small-3-4">
								<h2 class="uk-text-large uk-margin-small-bottom">
									<a href="<?php echo $item->link; ?>" class="uk-link-muted uk-display-block">
										<?php echo $item->name; ?></a>
								</h2>
								<?php if ($item->job) : ?>
									<div class="job">
										<a href="<?php echo $item->job_link; ?>"><?php echo $item->job_name; ?></a>
									</div>
									<?php if (!empty($item->position)): ?>
										<div class="position">
											<i>(<?php echo $item->position; ?>)</i>
										</div>
									<?php endif; ?>
								<?php endif; ?>
								<blockquote>
									<?php echo $item->status; ?>
								</blockquote>
							</div>
							<div class="uk-width-small-1-4">
								<div class="uk-text-right">
									<div class="uk-text-nowrap">
										<time class="timeago uk-text-muted uk-text-small uk-text-nowrap uk-margin-small-left"
											  data-uk-tooltip
											  datetime="<?php echo HTMLHelper::date($item->created, 'c'); ?>"
											  title="<?php echo HTMLHelper::date($item->created, 'd.m.Y H:i'); ?>"></time>
									</div>
									<div class="uk-text-right uk-margin-small-bottom uk-text-nowrap">
										<a href="<?php echo $item->link; ?>"
										   class="uk-badge uk-badge-white uk-margin-small-left">
											<i class="uk-icon-eye uk-margin-small-right"></i><?php echo $item->hits; ?>
										</a>
										<a href="<?php echo $item->link; ?>#comments"
										   class="uk-badge uk-badge-white uk-margin-small-left">
											<i class="uk-icon-comment-o uk-margin-small-right"></i>
											<?php echo $item->commentsCount; ?>
										</a>
										<div class="region uk-margin-top uk-text-small">
											<?php
											echo HTMLHelper::image('regions/' . $item->region . '.png', $item->region_name,
												array('title' => $item->region_name, 'data-uk-tooltip' => ''), true); ?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
		<div>
			<?php echo $this->pagination->getPagesLinks(); ?>
		</div>
	<?php endif; ?>
</div>
