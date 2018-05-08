<?php
/**
 * @package    Nerudas Template
 * @version    4.9.9
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Component\ComponentHelper;

$app = Factory::getApplication();

if (!$this->user->get('guest'))
{
	$redirect = (Factory::getSession()->get('afterLoginReturn')) ?
		base64_decode(Factory::getSession()->get('afterLoginReturn')) :
		Route::_('index.php?option=com_users&view=profile');

	$app->redirect($redirect);
}

HTMLHelper::_('behavior.keepalive');
HTMLHelper::_('behavior.formvalidator');

?>

<form action="<?php echo Route::_('index.php?option=com_users&task=user.login'); ?>" method="post"
	  class="form-validate uk-form uk-form-horizontal">
	<?php echo LayoutHelper::render('template.title', array()); ?>
	<ul class="uk-tab-new uk-margin-bottom-remove" data-uk-switcher="{connect:'#loginTabs', swiping: false}"
		data-save-tabs="loginTabs">
		<li><a href="#social"><?php echo Text::_('TPL_NERUDAS_LOGIN_SOCIAL'); ?></a></li>
		<li><a href="#password"><?php echo Text::_('TPL_NERUDAS_LOGIN_PASSWORD'); ?></a></li>
		<?php if (ComponentHelper::getParams('com_users')->get('allowUserRegistration')) : ?>
			<li><a onclick="location.href='<?php echo Route::_('index.php?option=com_users&view=registration'); ?>'">
					<?php echo Text::_('TPL_NERUDAS_REGISTRATION'); ?></a></li>
		<?php endif; ?>
	</ul>
	<ul id="loginTabs" class="uk-switcher uk-margin-bottom" data-uk-switcher-tabs="">
		<li data-tab="social" class="uk-panel uk-panel-box uk-flex uk-flex-center uk-flex-middle">
			<?php echo $this->form->getInput('socials'); ?>
		</li>
		<li data-tab="password" class="uk-panel uk-panel-box">
			<?php
			$class = $this->form->getFieldAttribute('username', 'class', '', '') . ' wrap';
			$class .= ' uk-width-1-1';
			$this->form->setFieldAttribute('username', 'class', $class, '');
			echo $this->form->renderField('username'); ?>
			<div class="uk-form-row ">
				<?php echo $this->form->getLabel('password'); ?>
				<div class="uk-form-controls">
					<?php
					$class = $this->form->getFieldAttribute('password', 'class', '', '') . ' wrap';
					$class .= ' uk-width-1-1';
					$this->form->setFieldAttribute('password', 'class', $class, '');
					echo $this->form->getInput('password'); ?>
					<p class="uk-form-help-block">
						<a href="<?php echo Route::_('index.php?option=com_users&view=reset'); ?>">
							<?php echo Text::_('COM_USERS_LOGIN_RESET'); ?>
						</a>
					</p>
				</div>
			</div>
			<div class="uk-form-row uk-text-right">
				<button type="submit" class="uk-button uk-button-primary">
					<?php echo Text::_('JLOGIN'); ?>
				</button>
			</div>
			<?php if (ComponentHelper::getParams('com_users')->get('allowUserRegistration')) : ?>
				<hr>

				<div class="uk-text-center uk-text-medium uk-link-muted">
					<a href="<?php echo Route::_('index.php?option=com_users&view=registration'); ?>">
						<?php echo Text::_('COM_USERS_LOGIN_REGISTER'); ?>
					</a>
				</div>
			<?php endif; ?>
		</li>
	</ul>
	<?php $return = $this->form->getValue('return', '', $this->params->get('login_redirect_url', $this->params->get('login_redirect_menuitem'))); ?>
	<input type="hidden" name="return" value="<?php echo base64_encode($return); ?>"/>
	<?php echo HTMLHelper::_('form.token'); ?>
</form>
