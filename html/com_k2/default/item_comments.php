<?php
/**
 * @package    Nerudas Template
 * @version    4.9.11
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;

use Joomla\CMS\Router\Route;

$app = JFactory::getApplication();
$doc = JFactory::getDocument();

JLoader::register('ProfilesHelperRoute', JPATH_SITE . '/components/com_profiles/helpers/route.php');
?>
<?php if (isset($this->item->comments)) : ?>
	<div id="comments" class="itemlist">
		<?php echo $this->loadTemplate('comments_form'); ?>
		<?php foreach ($this->item->comments as $key => $comment):
			$comment->authorLink = Route::_(ProfilesHelperRoute::getProfileRoute($comment->userID));
			?>
			<div id="comment-<?php echo $comment->id; ?>" class="item">
				<div class="uk-grid uk-grid-small">

					<div class="uk-width-1-1 uk-width-small-1-1 uk-width-medium-1-10 uk-hidden-small">

					</div>
					<div class="uk-width-1-1 uk-width-small-1-1 uk-width-medium-9-10">
						<div class="header">
							<a class="name uk-link-muted" href="<?php echo $comment->authorLink; ?>" target="_blank">
								<?php echo $comment->userName; ?>
							</a>
							<span class="date uk-text-muted uk-float-right">
						<?php echo JHTML::_('date', $comment->commentDate, 'd M H:i'); ?>
					</span>
						</div>
						<div class="text">
							<?php echo $comment->commentText; ?>
						</div>
					</div>


				</div>
				<hr class="uk-article-divider uk-width-1-1">
			</div>
		<?php endforeach; ?>
		<?php echo $this->pagination->getPagesLinks(); ?>
		<div class="uk-text-center">
			<?php echo $this->pagination->getPagesCounter(); ?>
		</div>
	</div>
<?php else: ?>
	<?php echo $this->item->event->K2CommentsBlock; ?>
<?php endif; ?>
