<?php
/**
 * @package     JoomlaZen Nerudas Template
 * @version     4.3
 * @author      JoomlaZen - www.joomlazen.com
 * @copyright   Copyright (c) 2016 - 2016 JoomlaZen. All rights reserved.
 * @license     GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */
defined('_JEXEC') or die('Restricted access');
$app = JFactory::getApplication();
$doc = JFactory::getDocument();

JHtml::_('behavior.keepalive');
JHtml::_('behavior.formvalidator');
?>

<div id="users" class="reset itemform">
	<form action="<?php echo JRoute::_('index.php?option=com_users&task=reset.complete'); ?>" method="post" class="form-validate uk-form uk-form-horizontal uk-panel uk-panel-box">
		<h2 class="uk-h3 uk-margin-top-remove"><?php echo $doc->getTitle();?></h2>
		
		<div class="uk-form-row">
			<label class="uk-form-label"><?php echo JText::_('NERUDAS_NEW_PASSWORD') ?></label>
			<div class="uk-form-controls">
				<input aria-invalid="true" name="jform[password1]" id="jform_password1" value="" autocomplete="off" class="validate-password required invalid" size="30" maxlength="99" required="required" aria-required="true" type="password">
			</div>
		</div>
		<div class="uk-form-row">
			<label class="uk-form-label"><?php echo JText::_('NERUDAS_NEW_PASSWORD_REPEAT') ?></label>
			<div class="uk-form-controls">
				<input aria-invalid="true" name="jform[password2]" id="jform_password2" value="" autocomplete="off" class="validate-password required invalid" size="30" maxlength="99" required="required" aria-required="true" type="password">
			</div>
		</div>
		<div class="uk-form-row">
			<div class="uk-form-controls">
				<button class="uk-button uk-button-success validate"><?php echo JText::_('NERUDAS_SAVE') ?></button>
			</div>
		</div>
		<?php echo JHtml::_('form.token'); ?>
	</form>
</div>
