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
use Joomla\CMS\Language\Text;
use Joomla\CMS\Factory;
use Joomla\CMS\Layout\LayoutHelper;

HTMLHelper::_('jquery.framework');
HTMLHelper::_('script', '//api-maps.yandex.ru/2.1/?lang=ru-RU', array('version' => 'auto', 'relative' => true));
HTMLHelper::_('script', 'modalmap.min.js', array('version' => 'auto', 'relative' => true));

?>
<div class="board-lastes-module">
	<div class="title uk-margin-bottom uk-flex uk-flex-middle uk-flex-wrap">
		<h2 class="uk-margin-bottom-remove uk-margin-right">
			<a class="uk-text-muted" href="<?php echo $categoryLink; ?>"><?php echo $module->title; ?></a>
		</h2>
		<a href="<?php echo $addLink; ?>" class="uk-button uk-button uk-button-success">
			<?php echo Text::_('TPL_NERUDAS_ACTIONS_ADD'); ?>
		</a>
	</div>
	<?php if ($items) : ?>
		<div class="items uk-panel uk-panel-box uk-margin-bottom">
			<?php foreach ($items as $id => $item): ?>
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
					<a class="uk-margin-top-remove uk-link-muted" href="<?php echo $item->link; ?>">
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

					</a>
					<div class="uk-margin-small-top uk-grid uk-grid-small">
						<div class="uk-width-small-2-3 uk-flex uk-flex-bottom">
							<?php if (!empty($item->tags->itemTags)): ?>
								<div class="uk-margin-small-top tags">
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
			<div class="more uk-text-center">
				<a href="<?php echo $categoryLink; ?>"
				   class="uk-button uk-button-large uk-width-1-1 uk-text-center uk-panel-box">
					<?php echo Text::_('TPL_NERUDAS_SHOWMORE'); ?>
				</a>
			</div>
		</div>
	<?php endif; ?>
</div>