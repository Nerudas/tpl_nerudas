<?php
/**
 * @package    Nerudas Template
 * @version    4.9.2
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2017 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;
JHtml::_('behavior.keepalive');
$app = JFactory::getApplication();
$doc = JFactory::getDocument();
$doc->addScriptDeclaration("
	(function($){
		$(document).ready(function() {
			var error = $('#system-messages .warning:first p .text');
			if (error.length > 0) {
				$('#flogin .error').html('<p>'+error.html()+'</p>');	
			}
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

<div id="flogin" class="uk-panel uk-panel-box">
	<div class="error uk-text-danger">
		<p>
			<?php echo JText::sprintf('COM_SLOGIN_COMPARISON_DESC', $this->email); ?>
		</p>
	</div>
	<form action="<?php echo JRoute::_('index.php?option=com_slogin&task=join_mail'); ?>" method="post"
		  class="uk-form uk-form-horizontal uk-text-center uk-container uk-container-center">
		<div class="uk-form-row">
			<input type="text" name="username" id="username" value="" class="validate-username uk-width-1-1 required"
				   size="25" placeholder="<?php echo JText::_('NERUDAS_EMAIL') ?>">
		</div>
		<div class="uk-form-row">
			<input type="password" name="password" id="password" value=""
				   class="validate-password required uk-width-1-1"
				   placeholder="<?php echo JText::_('NERUDAS_PASSWORD') ?>" size="25">
		</div>
		<div class="uk-form-row">
			<div class="uk-clearfix">
				<a class="uk-float-right" rel="nofollow"
				   href="<?php echo JRoute::_('index.php?option=com_users&view=reset'); ?>">
					<?php echo JText::_('NERUDAS_FORGOT_PASSWORD'); ?>
				</a>
			</div>
		</div>
		<div class="uk-form-row">
			<button type="submit"
					class="uk-button uk-button-meddium uk-button-success"><?php echo JText::_('NERUDAS_LOGIN') ?></button>
		</div>
		<input type="hidden" name="return"
			   value="<?php echo base64_encode($this->params->get('login_redirect_url', $this->form->getValue('return'))); ?>"/>
		<input type="hidden" name="user_id" value="<?php echo $this->id; ?>"/>
		<input type="hidden" name="provider" value="<?php echo $this->provider; ?>"/>
		<input type="hidden" name="slogin_id" value="<?php echo $this->slogin_id; ?>"/>
		<?php echo JHtml::_('form.token'); ?>
	</form>
</div>
