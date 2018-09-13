<?php
/**
 * @package    Nerudas Template
 * @version    4.9.26
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\HTML\HTMLHelper;

?>
<?php if (!$module->showtitle): ?>
	<div class="uk-h2 uk-clearfix">
		<a href="<?php echo $tagLink; ?>" class="uk-link-muted">
			<?php echo $module->title; ?>
		</a>
		<a href="<?php echo $addLink; ?>"
		   class="uk-button uk-button uk-button-success uk-float-right">
			<?php echo Text::_('TPL_NERUDAS_ACTION_NEW_TOPIC'); ?>
		</a>
	</div>
<?php endif; ?>
<ul class="uk-list">
	<?php $i = 0;
	foreach ($items as $key => $item): ?>
		<li class="">
			<?php if ($i != 0): ?>
				<div class="uk-text-large uk-text-center uk-margin-top uk-margin-bottom ">· · ·</div>
			<?php endif; ?>

			<?php
			$post                  = new stdClass();
			$post->author_name     = $item->last_post_author->name;
			$post->author_avatar   = $item->last_post_author->avatar;
			$post->author_online   = $item->last_post_author->online;
			$post->author_link     = $item->last_post_link;
			$post->author_job      = $item->last_post_author->job;
			$post->author_job_name = $item->last_post_author->job_name;
			$post->author_job_link = $item->last_post_author->job_link;
			echo LayoutHelper::render('content.author.horizontal', $post); ?>


			<div class="uk-margin-small-top uk-text-small">
				<?php echo JHtmlString::truncate($item->last_post_text, 200, false, false); ?>
			</div>

			<div class="uk-text-small uk-margin-small-top uk-flex uk-flex-space-between">
				<div>
					<a href="<?php echo $item->link; ?>">
						<?php echo JHtmlString::truncate($item->title, 40, false, false); ?>
					</a>
				</div>
				<div class="uk-text-right uk-margin-small-left">
					<a href="<?php echo $item->last_post_link; ?>"
					   class="uk-text-muted uk-text-small">
						<time class="timeago uk-text-nowrap"
							  data-uk-tooltip
							  datetime="<?php echo HTMLHelper::date($item->last_post_created, 'c'); ?>"
							  title="<?php echo HTMLHelper::date($item->last_post_created, 'd.m.Y H:i'); ?>"></time>
					</a>
				</div>
			</div>
		</li>
		<?php $i++;
	endforeach;; ?>
</ul>
