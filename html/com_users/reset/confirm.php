<?php
/**
 * @package    Nerudas Template
 * @version    4.9.6
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;
$app = JFactory::getApplication();
$doc = JFactory::getDocument();
JHtml::_('behavior.keepalive');
JHtml::_('behavior.formvalidator');
$token = '';
if (!empty ($app->input->get('token')))
{
	$token = $app->input->get('token');
}
?>

<div id="users" class="reset itemform">
	<form action="<?php echo JRoute::_('index.php?option=com_users&task=reset.confirm'); ?>" method="post"
		  class="form-validate uk-form uk-form-horizontal uk-panel uk-panel-box">
		<h2 class="uk-h3 uk-margin-top-remove"><?php echo $doc->getTitle(); ?></h2>
		<div class="uk-form-row">
			<label class="uk-form-label"><?php echo JText::_('NERUDAS_EMAIL') ?></label>
			<div class="uk-form-controls">
				<input aria-invalid="true" name="jform[username]" id="jform_username" value="" class="required invalid"
					   size="30" required="required" aria-required="true" type="text">
			</div>
		</div>
		<div class="uk-form-row">
			<label class="uk-form-label"><?php echo JText::_('NERUDAS_CONFIRMATION_CODE'); ?></label>
			<div class="uk-form-controls">
				<input aria-invalid="true" name="jform[token]" id="jform_token" value="<?php echo $token; ?>"
					   class="required invalid" size="32" required="required" aria-required="true" type="text">
			</div>
		</div>
		<div class="uk-form-row">
			<div class="uk-form-controls">
				<div class="input">
					<button type="submit"
							class="uk-button uk-button-success validate"><?php echo JText::_('NERUDAS_SUBMIT') ?></button>
				</div>
			</div>
		</div>
		<?php echo JHtml::_('form.token'); ?>
	</form>
</div>
