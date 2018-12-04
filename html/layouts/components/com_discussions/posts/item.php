<?php
/**
 * @package    Nerudas Template
 * @version    4.9.36
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;

use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;

$item = $displayData;

$editToggle = "{target:'#discussion-post-" . $item->topic_id . "_" . $item->id . " .edit-toggle'}";
?>

<div id="discussion-post-<?php echo $item->topic_id . '_' . $item->id; ?>" class="item uk-anchor">

	<div class="head uk-margin-bottom uk-flex uk-flex-wrap uk-flex-space-between">
		<div>
			<?php echo LayoutHelper::render('content.author.horizontal', $item); ?>
		</div>
		<div class="uk-text-muted uk-text-small uk-text-right">
			<div>#<?php echo $item->id; ?></div>
			<time class="timeago uk-text-muted uk-text-small"
				  data-uk-tooltip
				  datetime="<?php echo HTMLHelper::date($item->created, 'c'); ?>"
				  title="<?php echo HTMLHelper::date($item->created, 'd.m.Y H:i'); ?>"></time>
		</div>
	</div>
	<div class="edit-toggle"><?php echo $item->text; ?></div>
	<?php //echo '<pre>', print_r($item, true), '</pre>'; ?>
	<?php if ($item->form): ?>
		<div class="edit-toggle uk-hidden">
			<?php
			$data           = array();
			$data['form']   = $item->form;
			$data['action'] = $item->editLink;
			$data['cancel'] = $editToggle;
			echo LayoutHelper::render('components.com_discussions.posts.form', $data); ?>
		</div>
	<?php endif; ?>
	<div class="actions edit-toggle uk-text-small uk-margin-top uk-text-muted uk-text-right">
		<?php if ($item->form): ?>
			<a class="uk-link-muted uk-margin-right" data-uk-toggle="<?php echo $editToggle; ?>">
				<?php echo Text::_('TPL_NERUDAS_ACTIONS_EDIT'); ?>
			</a>
		<?php endif; ?>
		<a class="uk-link-muted" href="#discussion-post-add-<?php echo $item->topic_id; ?>">
			<?php echo Text::_('TPL_NERUDAS_ACTIONS_REAPLY'); ?>
		</a>
	</div>
</div>
