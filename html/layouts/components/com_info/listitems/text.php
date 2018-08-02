<?
/**
 * @package    Nerudas Template
 * @version    4.9.24
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;

$item = $displayData;

?>

<div class="item text uk-panel uk-panel-box uk-margin-bottom">
	<div class="meta-info uk-flex uk-flex-space-between">
		<div class="uk-text-right">
			<div class="uk-text-nowrap">
				<time class="timeago uk-text-muted uk-text-small uk-text-nowrap uk-margin-small-left"
					  data-uk-tooltip
					  datetime="<?php echo HTMLHelper::date($item->created, 'c'); ?>"
					  title="<?php echo HTMLHelper::date($item->created, 'd.m.Y H:i'); ?>"></time>
			</div>
		</div>
		<div class="uk-text-left uk-margin-small-bottom uk-text-nowrap">
			<a href="<?php echo $item->link; ?>"
			   class="uk-badge uk-badge-white uk-margin-small-left">
				<i class="uk-icon-eye uk-margin-small-right"></i><?php echo $item->hits; ?>
			</a>
			<a href="<?php echo $item->link; ?>#comments"
			   class="uk-badge uk-badge-white uk-margin-small-left">
				<i class="uk-icon-comment-o uk-margin-small-right"></i><?php echo $item->commentsCount; ?>
			</a>
		</div>
	</div>
	<div class="uk-h2 title uk-margin-small-bottom">
		<a href="<?php echo $item->link; ?>" class="uk-link-muted">
			<?php echo $item->title; ?>
		</a>
		<?php if ($item->in_work): ?>
			<sup class="uk-badge uk-badge-danger uk-margin-small-left">
				<?php echo Text::_('COM_INFO_ITEM_IN_WORK'); ?>
			</sup>
		<?php endif; ?>
	</div>
	<div class="text uk-margin-small-bottom uk-text-muted"><?php echo $item->introtext; ?></div>
	<div class="uk-margin-small-top">
		<?php if (!empty($item->tags->itemTags)): ?>
			<div class="tags">
				<?php foreach ($item->tags->itemTags as $tag): ?>
					<span class="uk-tag<?php echo ($tag->main) ? ' uk-tag-primary' : '' ?>">
						<?php echo $tag->title; ?>
					</span>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</div>
