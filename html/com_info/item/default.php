<?php
/**
 * @package    Nerudas Template
 * @version    4.9.37
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Factory;

HTMLHelper::_('script', '//yastatic.net/es5-shims/0.0.2/es5-shims.min.js', array('version' => 'auto', 'relative' => true));
HTMLHelper::_('script', '//yastatic.net/share2/share.js', array('version' => 'auto', 'relative' => true));

?>
<div id="info" class="item">
	<?php echo LayoutHelper::render('template.title'); ?>
	<div class="header uk-margin-bottom">
		<?php if ($this->item->header): ?>
			<div class="bg uk-flex uk-flex-middle uk-flex-center">
				<img src="<?php echo $this->item->header; ?>" alt="<?php echo $this->item->title; ?>">
			</div>
		<?php endif; ?>
		<div class="info uk-flex uk-flex-middle uk-padding-small">
			<div class="content uk-grid uk-grid-small uk-width-1-1" data-uk-grid-match data-uk-grid-margin>
				<div class="uk-width-small-1-2 uk-width-medium-3-4 uk-text-large uk-text-uppercase-letter uk-flex uk-flex-middle">
					<div class="uk-padding-left">
						<?php echo $this->item->params->get('alternative_title', $this->item->title); ?>
					</div>
				</div>
				<div class="uk-width-small-1-2 uk-width-medium-1-4 uk-flex uk-flex-middle uk-flex-right">
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
		<div class="text uk-margin-large-bottom">
			<?php echo $this->item->fulltext; ?>
		</div>
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
	<?php
	$user = Factory::getUser();
	if ($user->authorise('core.edit', 'com_prototype') && $user->authorise('core.manage', 'com_prototype') && $user->authorise('core.admin')): ?>
		<div class=" uk-margin-large-bottom">
			<a href="/administrator/index.php?option=com_info&task=item.edit&id=<?php echo $this->item->id; ?>"
			   target="_blank" class="uk-margin-right">
				#<?php echo $this->item->id; ?>
			</a>
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
