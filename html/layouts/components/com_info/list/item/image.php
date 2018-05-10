<?
/**
 * @package    Nerudas Template
 * @version    4.9.9
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

<div class="item image  uk-margin-bottom">
	<a class="uk-overlay uk-overlay-hover uk-display-block uk-container-center uk-width-medium-1-2"
	   href="<?php echo $item->link; ?>">
		<div class="uk-text-center">
			<img src="<?php echo $item->introimage; ?>" alt="<?php echo $item->title; ?>">
		</div>
		<div class="uk-overlay-panel uk-overlay-panel-small uk-overlay-background uk-contras uk-flex uk-flex-space-between-vertical">
			<div class="meta-info uk-flex uk-flex-space-between uk-margin-bottom">
				<div class="uk-text-right">
					<div class="uk-text-nowrap">
						<time class="timeago uk-badge uk-badge-white uk-text-nowrap"
							  data-uk-tooltip
							  datetime="<?php echo HTMLHelper::date($item->created, 'c'); ?>"
							  title="<?php echo HTMLHelper::date($item->created, 'd.m.Y H:i'); ?>"></time>
					</div>
				</div>
				<div class="uk-text-left uk-margin-small-bottom uk-text-nowrap">
					<span class="uk-badge uk-badge-white uk-margin-small-left">
						<i class="uk-icon-eye uk-margin-small-right"></i><?php echo $item->hits; ?>
					</span>
					<span class="uk-badge uk-badge-white uk-margin-small-left">
						<i class="uk-icon-comment-o uk-margin-small-right"></i>0
					</span>
					<?php if ($item->in_work): ?>
						<span class="uk-badge uk-badge-danger uk-margin-small-left">
							<?php echo Text::_('COM_INFO_ITEM_IN_WORK'); ?>
						</span>
					<?php endif; ?>
				</div>
			</div>
			<div class="uk-h2title uk-text-medium">
				<span><?php echo $item->title; ?></span>
			</div>
			<div class="text uk-text-small uk-margin-small-bottom"><?php echo $item->introtext; ?></div>
			<?php if (!empty($item->tags->itemTags)): ?>
				<div class="tags uk-margin-small-bottom">
					<?php foreach ($item->tags->itemTags as $tag): ?>
						<span class="uk-tag<?php echo ($tag->main) ? ' uk-tag-primary' : '' ?>">
							<?php echo $tag->title; ?>
						</span>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>
	</a>
</div>
