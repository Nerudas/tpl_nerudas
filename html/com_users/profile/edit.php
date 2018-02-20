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
$doc->addScriptDeclaration("
(function($){
	$(document).ready(function() {
		document.getElementById('jform_email1').addEventListener('input', function(e){
			document.getElementById('jform_email2').value = this.value;
			document.getElementById('jform_username').value = this.value;
		});	
	});
})(jQuery);
");
foreach ($this->form->getFieldsets() as $key => $row)
{
	$items = $this->form->getFieldset($key);
	if (count($items))
	{
		foreach ($items as $item)
		{
			$result        = new stdClass();
			$result->id    = $item->id;
			$result->label = $item->label;
			$result->input = $item->input;
			if ($result->id == 'jform_password1' || $result->id == 'jform_password2' || $result->id == 'jform_email1' || $result->id == 'jform_params_timezone')
			{
				$myfields[$result->id] = $result;
			}
			else
			{
				$otherFields[] = $result;
			}
		}
	}
}
?>

<div id="users" class="edit itemform">
	<form id="member-profile" action="<?php echo JRoute::_('index.php?option=com_users&task=profile.save'); ?>"
		  method="post" class="form-validate uk-form uk-form-horizontal" enctype="multipart/form-data">
		<div class="uk-form uk-form-horizontal uk-panel uk-panel-box uk-margin-bottom">
			<h2 class="uk-h3 uk-margin-top-remove">
				<?php echo JText::_('NERUDAS_LOGIN_SETTINGS') ?>
			</h2>


			<div class="uk-form-row">
				<label class="uk-form-label"><?php echo JText::_('NERUDAS_EMAIL') ?></label>
				<div class="uk-form-controls">
					<?php echo $myfields['jform_email1']->input; ?>
				</div>
			</div>
			<div class="uk-form-row">
				<label class="uk-form-label"><?php echo JText::_('NERUDAS_NEW_PASSWORD') ?></label>
				<div class="uk-form-controls">
					<?php echo $myfields['jform_password1']->input; ?>
				</div>
			</div>
			<div class="uk-form-row">
				<label class="uk-form-label"><?php echo JText::_('NERUDAS_NEW_PASSWORD_REPEAT') ?></label>
				<div class="uk-form-controls">
					<?php echo $myfields['jform_password2']->input; ?>
				</div>
			</div>

			<div class="uk-form-row uk-text-center uk-margin-large-bottom">
				<a href="<?php echo JRoute::_('index.php?option=com_users&view=profile'); ?>"
				   class="uk-button uk-button-danger uk-button-large">
					<?php echo JText::_('NERUDAS_CANCEL'); ?>
				</a>
				<button type="submit" class="uk-button uk-button-success uk-button-large validate">
					<?php echo JText::_('NERUDAS_SAVE') ?>
				</button>
			</div>
		</div>
		<?php echo JHtml::_('form.token'); ?>
		<div class="uk-hidden">
			<?php echo $myfields['jform_params_timezone']->input; ?>
			<?php foreach ($otherFields as $field): ?>
				<?php echo $field->label; ?> : <?php echo $field->input; ?><br/>
			<?php endforeach; ?>
		</div>
		<input type="hidden" name="option" value="com_users"/>
		<input type="hidden" name="task" value="profile.save"/>
	</form>
</div>
