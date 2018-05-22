<?php
/**
 * @package    Nerudas Template
 * @version    4.9.10
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;
?>
<?php if (!JFactory::getUser()->guest) :
	$commentsAuthor = NerudasProfilesHelper::getProfile(JFactory::getUser()->id);
	?>

	<div class="form uk-grid uk-grid-small">
		<div class="uk-width-1-1 uk-width-small-1-1 uk-width-medium-1-10 uk-hidden-small">
			<a class="image uk-avatar-48 <?php echo $commentsAutho->status; ?>"
			   style=" background-image:url('<?php echo $commentsAuthor->avatar->small; ?>')"
			   href="<?php echo $commentsAuthor->link; ?>" target="_blank">
			</a>
		</div>
		<div class="uk-width-1-1 uk-width-small-1-1 uk-width-medium-9-10">
			<form action="<?php echo JURI::root(true); ?>/index.php" method="post" id="comment-form"
				  class="form-validate uk-form uk-form-stacked">
				<div class="uk-form-row">
					<div class="uk-form-controls">
						<textarea id="commentText" class="uk-width-1-1" name="commentText" rows="5"
								  placeholder="<?php echo JText::_('NERUDAS_COMEMNTS_TEXT'); ?>"></textarea>
					</div>
				</div>
				<?php if ($this->params->get('recaptcha') && (JFactory::getUser()->guest || $this->params->get('recaptchaForRegistered', 1))): ?>
					<div class="uk-form-row">
						<div class="uk-form-controls uk-text-right">
							<?php if (!$this->params->get('recaptchaV2')): ?>
							<?php endif; ?>
							<div id="recaptcha" class="<?php echo $this->recaptchaClass; ?> uk-float-right">
							</div>
						</div>
					</div>
				<?php endif; ?>
				<div class="uk-form-row">
					<div class="uk-form-controls uk-text-right">
					<span id="formLog">
					</span>
						<button id="submitCommentButton" class="uk-button uk-button-success"
								type="submit"><?php echo JText::_('NERUDAS_COMEMNTS_ADD'); ?></button>
					</div>
				</div>
				<input class="inputbox" type="hidden" name="userName" id="userName" value="none"/>
				<input class="inputbox" type="hidden" name="commentEmail" id="commentEmail" value="none@none.com"/>
				<input type="hidden" name="option" value="com_k2"/>
				<input type="hidden" name="view" value="item"/>
				<input type="hidden" name="task" value="comment"/>
				<input type="hidden" name="itemID" value="<?php echo JRequest::getInt('id'); ?>"/>
				<?php echo JHTML::_('form.token'); ?>
			</form>
		</div>
	</div>
<?php else: ?>
	<div class="uk-text-large uk-text-center uk-margin-bottom">
		<a href="#login" class="login" data-uk-modal="{center:true}">
			<i class="uk-icon-lock uk-icon-small uk-icon-justify"></i>
			<span>
			<?php echo JText::_('NERUDAS_LOGIN_TO_POST_COMMENT'); ?>
		</span>
		</a>
	</div>
<?php endif; ?>
<hr>
