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

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\LayoutHelper;

HTMLHelper::_('behavior.keepalive');
HTMLHelper::_('behavior.formvalidator');

?>

<form action="<?php echo Route::_('index.php?option=com_users&task=registration.register'); ?>" method="post"
	  class="form-validate uk-form uk-form-horizontal">
	<?php echo LayoutHelper::render('template.title', array()); ?>
	<ul id="#registation_as" class="uk-tab-new uk-margin-bottom-remove"
		data-uk-switcher="{connect:'#registationTabs', swiping: false}">
		<li>
			<a href="#user" onclick="document.getElementById('jform_register_as0').click();">
				<?php echo Text::_('COM_PROFILES_REGISTRATION_AS_USER'); ?>
			</a>
		</li>
		<li>
			<a href="#company" onclick="document.getElementById('jform_register_as1').click();">
				<?php echo Text::_('COM_PROFILES_REGISTRATION_AS_COMPANY'); ?>
			</a>
		</li>
	</ul>
	<div class="uk-panel uk-panel-box">
		<ul id="registationTabs" class="uk-switcher uk-margin-bottom">
			<li data-tab="user">
				<?php echo $this->form->renderField('name'); ?>
			</li>
			<li data-tab="company">
				<?php echo $this->form->renderField('company_name'); ?>
				<?php echo $this->form->renderField('company_position'); ?>
			</li>
		</ul>
		<?php echo $this->form->renderField('email'); ?>
		<?php echo $this->form->renderField('password1'); ?>
		<?php echo $this->form->renderField('password2'); ?>
		<?php echo $this->form->renderField('captcha'); ?>
		<div class="uk-form-row">
			<div class="uk-form-label"></div>
			<div class="uk-form-controls">
				<a class="uk-button uk-button-danger"
				   href="<?php echo Route::_('index.php?option=com_users&view=login'); ?>">
					<?php echo Text::_('JCANCEL'); ?>
				</a>
				<button type="submit" class="uk-button uk-button-primary validate">
					<?php echo Text::_('JREGISTER'); ?>
				</button>
			</div>
		</div>
	</div>
	<div class="uk-hidden">
		<?php echo $this->form->getInput('register_as'); ?>
	</div>
	<input type="hidden" name="option" value="com_users"/>
	<input type="hidden" name="task" value="registration.register"/>
	<?php echo JHtml::_('form.token'); ?>
</form>


