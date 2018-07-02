<?php
/**
 * @package    Nerudas Template
 * @version    4.9.18
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

use Joomla\CMS\Language\Text;
use Joomla\Registry\Registry;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Router\Route;

defined('_JEXEC') or die;

extract($displayData);

/**
 * Layout variables
 * -----------------
 * @var   Registry $item      Item data
 * @var   Registry $extra     Item extra data
 * @var   Registry $category  Category data
 * @var   Registry $placemark Placemark data
 * @var   Registry $map       Map data
 */

$image = ($item->get('image', false)) ? $item->get('image') : 'templates/nerudas/images/noimage.jpg';

$text = '';

if (!empty($extra->get('why_you')))
{
	$text = $extra->get('why_you');
}
elseif (!empty($extra->get('comment')))
{
	$text = $extra->get('comment');
}

$text = JHtmlString::truncate($text, 150, false, false);
$text = str_replace('...', '', $text);


//echo '<pre>', print_r($item, true), '</pre>';
//echo '<pre>', print_r($extra, true), '</pre>';
//echo '<pre>', print_r($category, true), '</pre>';
//echo '<pre>', print_r($placemark, true), '</pre>';
//echo '<pre>', print_r($map, true), '</pre>';

?>

<div class="item default uk-panel uk-panel-box uk-margin-bottom">
	<div class="title uk-flex uk-flex-space-between uk-margin-bottom">
		<div>
			<div class="uk-h3 title uk-margin-bottom-remove">
				<a data-prototype-show="<?php echo $item->get('id'); ?>" class="uk-link-muted">
					<?php echo $item->get('title', Text::_('JGLOBAL_TITLE')); ?>
				</a>
			</div>
			<div class="uk-text-small">
				<?php if ($category->get('parent_id') > 1): ?>
					<span><?php echo $category->get('parent_title'); ?></span>
					<span> / </span>
				<?php endif; ?>
				<span><?php echo $category->get('title'); ?></span>
			</div>
		</div>
		<div>
			<div class="uk-text-right">
				<div class="uk-text-nowrap">
					<time class="timeago uk-text-muted uk-text-small uk-text-nowrap uk-margin-small-left"
						  data-uk-tooltip
						  datetime="<?php echo HTMLHelper::date($item->get('created'), 'c'); ?>"
						  title="<?php echo HTMLHelper::date($item->get('created'), 'd.m.Y H:i'); ?>"></time>
				</div>
			</div>
			<div class="uk-text-left uk-margin-small-bottom uk-text-nowrap">
				<a data-prototype-show="<?php echo $item->get('id'); ?>"
				   class="uk-button uk-button-white uk-button-mini uk-margin-small-left">
					<i class="uk-icon-eye uk-margin-small-right"></i><?php echo $item->get('hits'); ?>
				</a>
				<?php if (!empty($extra->get('discussion_link'))): ?>
					<a href="<?php echo Route::_($extra->get('discussion_link')); ?>"
					   class="uk-button uk-button-primary uk-button-mini">
						<i class="uk-icon-comment-o uk-margin-small-right"></i>
						<?php echo Text::_('TPL_NERUDAS_ACTIONS_DISCUSS'); ?>
					</a>
				<?php endif; ?>
			</div>
		</div>
	</div>

	<div class="uk-grid uk-grid-small" data-uk-grid-match data-uk-grid-margin>
		<div class="uk-width-medium-1-3">
			<a class="uk-display-block uk-height-1-1" data-prototype-show="<?php echo $item->get('id'); ?>">
				<?php echo HTMLHelper::image($image,
					$item->get('title', Text::_('JGLOBAL_TITLE')), array('class' => 'uk-width-1-1')); ?>
			</a>
		</div>
		<div class="uk-width-medium-2-3">
			<a class="uk-link-muted uk-display-block uk-height-1-1"
			   data-prototype-show="<?php echo $item->get('id'); ?>">
				<span class="uk-text-small"><?php echo !empty($text) ? $text . '... ' : ''; ?></span>
			</a>
		</div>
	</div>
	<div class="uk-margin-top uk-flex uk-flex-middle uk-flex-space-between uk-flex-wrap">
		<?php if (!empty($item->get('tags')->itemTags)): ?>
			<div class="tags">
				<?php foreach ($item->get('tags')->itemTags as $tag): ?>
					<span class="uk-tag"><?php echo $tag->title; ?></span>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
		<div class="uk-flex-right">
			<?php
			echo HTMLHelper::image('regions/' . $item->get('region') . '.png', $item->get('region_name'),
				array('title' => $item->get('region_name'), 'data-uk-tooltip' => ''), true); ?>
			<?php if ($map): ?>
				<a data-uk-tooltip title="<?php echo Text::_('TPL_NERUDAS_ON_MAP'); ?>"
				   href="<?php echo $map->get('link'); ?>">
					<?php echo HTMLHelper::image('icons/map_30.png', Text::_('TPL_NERUDAS_ON_MAP'), '', true); ?>
				</a>
			<?php endif; ?>
		</div>
	</div>
</div>