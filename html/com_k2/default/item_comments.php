<?php
/**
 * @package    Nerudas Template
 * @version    4.9.1
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2017 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;
$app = JFactory::getApplication();
$doc = JFactory::getDocument();
?>
<?php if (isset($this->item->comments)) : ?>
	<div id="comments" class="itemlist">
		<?php echo $this->loadTemplate('comments_form'); ?>
		<?php foreach ($this->item->comments as $key => $comment):
			$comment->author = NerudasProfilesHelper::getProfile($comment->userID);
			?>
			<div id="comment-<?php echo $comment->id; ?>" class="item">
				<div class="uk-grid uk-grid-small">

					<div class="uk-width-1-1 uk-width-small-1-1 uk-width-medium-1-10 uk-hidden-small">
						<a class="uk-text-middle uk-avatar-48 <?php echo $comment->author->status; ?>"
						   href="<?php echo $comment->author->link; ?>"
						   style="background-image: url('<?php echo $comment->author->avatar->small; ?>')">
						</a>
					</div>
					<div class="uk-width-1-1 uk-width-small-1-1 uk-width-medium-9-10">
						<div class="header">
							<a class="name uk-link-muted" href="<?php echo $comment->author->link; ?>" target="_blank">
								<?php echo $comment->author->name; ?>
							</a>
							<?php if ($comment->author->job): ?>
								<a class="job uk-text-muted" href="<?php echo $comment->author->job->link; ?>"
								   target="_blank">
									<?php echo $comment->author->job->name; ?>
								</a>

							<?php endif; ?>
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
