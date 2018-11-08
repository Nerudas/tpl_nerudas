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

use Joomla\CMS\Language\Text;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Factory;


require_once JPATH_THEMES . '/nerudas/helper.php';

HTMLHelper::_('jquery.framework');
HTMLHelper::_('formbehavior.chosen', 'select');
HTMLHelper::_('script', '//api-maps.yandex.ru/2.1/?lang=ru-RU', array('version' => 'auto', 'relative' => true));
HTMLHelper::_('script', 'modalmap.min.js', array('version' => 'auto', 'relative' => true));

?>

<div id="board" class="itemlist">
	<?php echo LayoutHelper::render('template.title', array('add' => $this->addLink)); ?>
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
		<div class="items uk-panel uk-panel-box uk-margin-bottom">
			<?php foreach ($this->items as $id => $item): ?>
				<div class="item">
					<div class="title uk-flex uk-flex-space-between">
						<?php $item->author_link = $item->link;
						echo LayoutHelper::render('content.author.horizontal', $item); ?>
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
							</div>
						</div>
					</div>
					<a class="uk-margin-top-remove uk-grid uk-grid-small uk-link-muted"
					   href="<?php echo $item->link; ?>">
						<div class="uk-width-small-1-1">
							<div class="uk-margin-small-bottom">
								<?php if ($item->for_when == 'today'): ?>
									<span class="uk-badge uk-badge-success uk-margin-small-right">
										<?php echo Text::_('COM_BOARD_ITEM_FOR_WHEN_TODAY'); ?>
									</span>
								<?php elseif ($item->for_when == 'tomorrow'): ?>
									<span class="uk-badge uk-badge-notification uk-margin-small-right">
										<?php echo Text::_('COM_BOARD_ITEM_FOR_WHEN_TOMORROW'); ?>
									</span>
								<?php endif; ?>
								<?php if (!$item->state): ?>
									<span class="uk-badge uk-badge-warning uk-margin-small-right">
										<?php echo Text::_('TPL_NERUDAS_ONMODERATION'); ?>
									</span>
								<?php endif; ?>
								<?php if ($item->publish_down !== '0000-00-00 00:00:00' &&
									$item->publish_down < Factory::getDate()->toSql()): ?>
									<span class="uk-badge uk-badge-danger uk-margin-small-right">
										<?php echo Text::_('TPL_NERUDAS_PUBLISH_TIMEOUT'); ?>
									</span>
								<?php endif; ?>
							</div>
							<div>
								<?php
								$text = JHtmlString::truncate($item->text, 100, false, false);
								$text = str_replace('...', '', $text);
								?>
								<span class="uk-text-small"><?php echo !empty($text) ? $text . '... ' : ''; ?></span>
							</div>
						</div>
					</a>
					<div class="uk-margin-small-top uk-grid uk-grid-small">
						<div class="uk-width-small-2-3 uk-flex uk-flex-bottom">
							<?php if (!empty($item->tags->itemTags)): ?>
								<div class="tags">
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
						<div class="uk-width-small-1-3 uk-flex uk-flex-right uk-flex-top">
							<?php if ($item->region_icon): ?>
								<img src="<?php echo $item->region_icon; ?>" alt="<?php echo $item->region_name; ?>"
									 data-uk-tooltip title="<?php echo $item->region_name; ?>"/>
							<?php endif; ?>

							<?php if ($item->map):
								$item->map = $item->map->toArray();
								$item->map['link'] = $item->link;
								Factory::getDocument()->addScriptOptions('board_' . $item->id, $item->map);
								?>
								<a data-uk-tooltip title="<?php echo Text::_('TPL_NERUDAS_ON_MAP'); ?>"
								   data-modalmap="board_<?php echo $item->id; ?>">
									<?php echo HTMLHelper::image('icons/map_30.png', Text::_('TPL_NERUDAS_ON_MAP'),
										'', true); ?>
								</a>
							<?php endif; ?>
						</div>
					</div>
				</div>
				<hr>
			<?php endforeach; ?>
			<div>
				<?php echo $this->pagination->getPagesLinks(); ?>
			</div>
		</div>

	<?php endif; ?>
</div>



