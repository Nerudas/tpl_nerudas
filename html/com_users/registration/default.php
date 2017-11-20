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
$app = JFactory::getApplication();
$doc = JFactory::getDocument();
$doc->addScriptDeclaration("
	(function($){
		$(document).ready(function() {
			var error = $('#system-messages .warning:first p .text');
			if (error.length > 0) {
				$('#flogin .error').html('<p>'+error.html()+'</p>');	
			}
			$('#login .uk-modal-header').html($('#flogin .header').html());
			$('#login .inner-form').html($('#flogin .form').html());	
			$('#flogin').remove();
			UIkit.modal('#login').show();
			$('#login').on({'hide.uk.modal': function(){
				window.location.href = '/login';
			}});
			document.getElementById('jform_email1').addEventListener('input', function(e){
				document.getElementById('jform_email2').value = this.value;
				document.getElementById('jform_username').value = this.value;
			});	
		});
	})(jQuery);
");
?>

<div id="flogin">
	<div class="header">
		<?php echo JText::_('NERUDAS_REGISTRATION') ?>
	</div>
	<div class="form">
		<div class="error uk-text-danger">
		</div>
		<form id="member-registration"
			  action="<?php echo JRoute::_('index.php?option=com_users&task=registration.register'); ?>" method="post"
			  class="form-validate uk-form uk-form-horizontal uk-text-center uk-container uk-container-center"
			  enctype="multipart/form-data">
			<div class="uk-form-row">
				<input name="jform[name]" id="jform_name" value="" size="30" required="" aria-required="true"
					   type="text" placeholder="<?php echo JText::_('NERUDAS_FIO') ?>" class="required uk-width-1-1">
			</div>
			<div class="uk-form-row uk-hidden">
				<input name="jform[username]" id="jform_username" value=""
					   class="validate-username required uk-width-1-1" size="30" required="" aria-required="true"
					   placeholder="<?php echo JText::_('NERUDAS_LOGIN_SYS') ?>" type="text">
			</div>
			<div class="uk-form-row">
				<input name="jform[email1]" class="validate-email required uk-width-1-1" id="jform_email1" value=""
					   size="30" autocomplete="email" required="" aria-required="true" type="email"
					   placeholder="<?php echo JText::_('NERUDAS_EMAIL') ?>">
			</div>
			<div class="uk-form-row uk-hidden">
				<input name="jform[email2]" class="validate-email required  uk-width-1-1" id="jform_email2" value=""
					   size="30" required="" aria-required="true" type="email"
					   placeholder="<?php echo JText::_('NERUDAS_EMAIL_REPEAT') ?>">
			</div>
			<div class="uk-form-row">
				<div class="uk-width-1-1 uk-form-password">
					<input name="jform[password1]" id="jform_password1" value="" autocomplete="off"
						   class="validate-password required uk-width-1-1" size="30" maxlength="99" required=""
						   aria-required="true" type="password"
						   placeholder="<?php echo JText::_('NERUDAS_PASSWORD') ?>">
				</div>
			</div>
			<div class="uk-form-row ">
				<div class="uk-width-1-1 uk-form-password">
					<input name="jform[password2]" id="jform_password2" value="" autocomplete="off"
						   class="validate-password uk-width-1-1 required" size="30" maxlength="99" required=""
						   aria-required="true" type="password"
						   placeholder="<?php echo JText::_('NERUDAS_PASSWORD_REPEAT') ?>">
				</div>
			</div>
			<div class="uk-form-row">
				<button type="submit"
						class="uk-button uk-button-meddium uk-button-success validate"><?php echo JText::_('NERUDAS_REGISTER'); ?></button>
			</div>
			<input type="hidden" name="option" value="com_users"/>
			<input type="hidden" name="task" value="registration.register"/>
			<?php echo JHtml::_('form.token'); ?>
		</form>
	</div>
</div>
