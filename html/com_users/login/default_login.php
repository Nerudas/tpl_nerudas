<?php
/**
 * @package    Nerudas Template
 * @version    4.9.3
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2017 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;
$app = JFactory::getApplication();
$doc = JFactory::getDocument();
$doc->addScriptDeclaration("
	(function($){
		$(document).ready(function() {
			$('#system-messages .login-error').appendTo($('#flogin .error'));
			$('#login .inner-form').html($('#flogin').html());
			$('#flogin').remove();
			UIkit.modal('#login').show();
			$('#login').on({'hide.uk.modal': function(){
				window.location.href = '/';
			}});
		});
	})(jQuery);
");
?>
<div class="uk-hidden">
	<div id="flogin">
		<div class="error">
		</div>
		<form action="<?php echo JRoute::_('index.php?option=com_users&task=user.login'); ?>" method="post"
			  class="uk-form uk-form-horizontal uk-text-center uk-container uk-container-center">
			<div class="uk-form-row">
				<input type="text" name="username" placeholder="<?php echo JText::_('NERUDAS_EMAIL') ?>"
					   class="uk-width-1-1" size="18">
			</div>
			<div class="uk-form-row">
				<div class="uk-width-1-1 uk-form-password">
					<input type="password" name="password" placeholder="<?php echo JText::_('NERUDAS_PASSWORD') ?>"
						   class="uk-width-1-1">
				</div>
			</div>
			<?php if (JPluginHelper::isEnabled('system', 'remember')) : ?>
				<div class="uk-form-row">
					<div class="uk-clearfix">
						<label class="uk-float-left">
							<input type="checkbox" name="remember" class="inputbox" checked value="yes"/>
							<?php echo JText::_('NERUDAS_REMEMBER_ME') ?>
						</label>
						<a class="uk-float-right" rel="nofollow"
						   href="<?php echo JRoute::_('index.php?option=com_users&view=reset'); ?>">
							<?php echo JText::_('NERUDAS_FORGOT_PASSWORD'); ?>
						</a>
					</div>
				</div>
			<?php endif; ?>
			<div class="uk-form-row">
				<button type="submit" name="Submit"
						class="uk-button uk-button-meddium uk-button-success"><?php echo JText::_('NERUDAS_LOGIN') ?></button>
			</div>
			<input type="hidden" name="return"
				   value="<?php echo base64_encode($this->params->get('login_redirect_url', $this->form->getValue('return'))); ?>"/>
			<?php echo JHtml::_('form.token'); ?>
			<?php echo JHtml::_('form.token'); ?>
		</form>
	</div>
</div>
