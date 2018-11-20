<?php
/**
 * @package    Nerudas Template
 * @version    4.9.34
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Language\Text;

HTMLHelper::_('script', '//yastatic.net/es5-shims/0.0.2/es5-shims.min.js', array('version' => 'auto', 'relative' => true));
HTMLHelper::_('script', '//yastatic.net/share2/share.js', array('version' => 'auto', 'relative' => true));

?>
<div id="info" class="item">
	<?php echo LayoutHelper::render('template.title'); ?>
	<div class="header uk-margin-bottom">
		<?php if ($this->item->header): ?>
			<div class="bg uk-cover-background uk-flex uk-flex-middle uk-flex-center"
				 style="background-image: url('<?php echo $this->item->header; ?>');">
			</div>
		<?php endif; ?>
		<div class="info uk-flex uk-flex-middle uk-padding-small">
			<div class="content uk-grid uk-grid-small uk-width-1-1" data-uk-grid-match>
				<div class="uk-width-1-2 uk-width-medium-3-4 uk-text-large uk-text-uppercase-letter uk-flex uk-flex-middle">
					<div class="uk-padding-left">
						<?php echo $this->item->params->get('alternative_title', $this->item->title); ?>
					</div>
				</div>
				<div class="uk-width-1-2 uk-width-medium-1-4 uk-flex uk-flex-middle uk-flex-right">
					<div class="uk-width-1-1 uk-text-right">
						<div class="uk-text-nowrap">
							<time class="timeago uk-text-muted uk-text-small uk-text-nowrap uk-margin-small-left"
								  data-uk-tooltip
								  datetime="<?php echo HTMLHelper::date($this->item->created, 'c'); ?>"
								  title="<?php echo HTMLHelper::date($this->item->created, 'd.m.Y H:i'); ?>"></time>
						</div>
						<div class="uk-text-right uk-margin-small-bottom uk-text-nowrap">
							<span class="uk-badge uk-badge-white uk-margin-small-left">
								<i class="uk-icon-eye uk-margin-small-right"></i><?php echo $this->item->hits; ?>
							</span>
							<a href="#comments"
							   class="uk-badge uk-badge-white uk-margin-small-left">
								<i class="uk-icon-comment-o uk-margin-small-right"></i>
								<?php echo ($this->comments && $this->comments->total) ? $this->comments->total : 0; ?>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="item-content uk-panel uk-panel-box uk-margin-large-bottom">
		<?php if (!empty($this->item->images)): ?>
			<div class="uk-slidenav-position uk-margin-large-bottom" data-uk-slideshow>
				<ul class="uk-slideshow">
					<?php foreach ($this->item->images as $key => $image): ?>
						<li>
							<div>
								<img src="<?php echo $image->src; ?>"
									 alt="<?php echo $this->item->title . ' ' . ($key + 1) ?>">
								<div>
									<?php echo $image->text; ?>
								</div>
							</div>
						</li>
					<?php endforeach; ?>
				</ul>
				<a href="" class="uk-slidenav uk-slidenav-contrast uk-slidenav-previous"
				   data-uk-slideshow-item="previous"></a>
				<a href="" class="uk-slidenav uk-slidenav-contrast uk-slidenav-next" data-uk-slideshow-item="next"></a>
				<ul class="uk-pagination">
					<?php
					$count = count($this->item->images);
					for ($i = 1; $i <= $count; $i++): ?>
						<li data-uk-slideshow-item="<?php echo $i - 1 ?>">
							<a href="">
								<?php echo $i ?>
							</a>
						</li>
					<?php endfor; ?>
				</ul>
			</div>
		<?php endif; ?>
		<?php if (!empty($this->item->fulltext)): ?>
			<div class="text uk-margin-large-bottom">
				<?php echo $this->item->fulltext; ?>
			</div>
		<?php endif; ?>
		<hr>
		<div class="uk-flex uk-flex-wrap uk-flex-space-between uk-flex-middle">
			<div>
				<?php if (!empty($this->item->tags->itemTags)): ?>
					<div class="tags uk-margin-small-bottom">
						<?php foreach ($this->item->tags->itemTags as $tag): ?>
							<span class="uk-tag<?php echo ($tag->main) ? ' uk-tag-primary' : '' ?>">
								<?php echo $tag->title; ?>
							</span>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			</div>
			<div>
				<div class="ya-share2" data-services="vkontakte,facebook,odnoklassniki,moimir,twitter"
					 data-counter="">
				</div>
			</div>
		</div>
	</div>
	<?php if (!empty($this->related)) : ?>
		<div class="uk-panel uk-panel-box uk-margin-large-bottom">
			<h2>
				<?php echo $this->item->params->get('related_title', Text::_('COM_INFO_ITEM_RELATED')); ?>
			</h2>
			<div class="uk-grid" data-uk-grid-match data-uk-grid-margin>
				<?php foreach ($this->related as $item): ?>
					<?php echo LayoutHelper::render('components.com_info.item.related', $item); ?>
				<?php endforeach; ?>
			</div>
		</div>
	<?php endif; ?>

	<?php if ($this->comments): ?>
		<div id="comments" class="uk-panel uk-panel-box uk-margin-large-bottom uk-anchor">
			<h2>
				<?php echo $this->item->params->get('comments_title', Text::_('COM_INFO_ITEM_COMMENTS')); ?>
			</h2>
			<?php echo $this->comments->render; ?>
		</div>
	<?php endif; ?>
</div>
