<?php
/**
 * @package    Nerudas Template
 * @version    4.9.35
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;
Use Joomla\CMS\Router\Route;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\Factory;

JLoader::register('UsersHelperRoute', JPATH_SITE . '/components/com_users/helpers/route.php');

Factory::getLanguage()->load('com_users', JPATH_SITE);


?>
<div id="mdoalLogin" class="uk-modal login">
	<div class="uk-modal-dialog uk-padding-remove">

		<div class="uk-modal-body">
			<ul class="uk-tab-new uk-margin-bottom-remove"
				data-uk-switcher="{connect:'#mdoalLoginTabs', swiping: false}">
				<li class="uk-padding-top ">
					<a href="#social"><?php echo Text::_('TPL_NERUDAS_LOGIN_SOCIAL'); ?></a></li>
				<li class="uk-padding-top ">
					<a href="#password"><?php echo Text::_('TPL_NERUDAS_LOGIN_PASSWORD'); ?></a></li>
				<?php if (ComponentHelper::getParams('com_users')->get('allowUserRegistration')) : ?>
					<li class="uk-padding-top ">
						<a onclick="location.href='<?php echo Route::_('index.php?option=com_users&view=registration'); ?>'">
							<?php echo Text::_('MOD_LOGIN_REGISTER'); ?></a>
					</li>
				<?php endif; ?>
			</ul>
			<ul id="mdoalLoginTabs" class="uk-switcher">
				<li data-tab="social" class="uk-padding-large uk-text-center">
					<?php echo LayoutHelper::render('components.com_profiles.sociallogin', array()); ?>
				</li>
				<li data-tab="password" class="uk-padding">
					<form action="<?php echo Route::_('index.php', true, $params->get('usesecure')); ?>"
						  method="post" id="modlal-login-form" class="uk-form">
						<div class="uk-form-row">
							<div class="uk-form-icon uk-width-1-1">
								<i class="uk-icon-user uk-form-large"></i>
								<input type="text" name="username" class="uk-width-1-1 uk-form-large" size="18"
									   placeholder="<?php echo Text::_('COM_PROFILES_LOGIN_USERNAME_HINT'); ?>"/>
							</div>
						</div>
						<div class="uk-form-row uk-form-password uk-width-1-1">
							<div class="uk-form-icon uk-width-1-1">
								<i class="uk-icon-lock uk-form-large"></i>
								<input type="password" name="password"
									   placeholder="<?php echo JText::_('JGLOBAL_PASSWORD') ?>"
									   class="uk-form-large uk-width-1-1">
							</div>

						</div>
						<div class="uk-form-row">
							<a href="<?php echo Route::_('index.php?option=com_users&view=reset'); ?>">
								<?php echo Text::_('COM_USERS_LOGIN_RESET'); ?>
							</a>
						</div>
						<div class="uk-form-row  uk-text-right">
							<button name="Submit" type="submit" class="uk-button uk-button-primary">
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

						<input type="hidden" name="option" value="com_users"/>
						<input type="hidden" name="task" value="user.login"/>
						<input type="hidden" name="return" value="<?php echo $return; ?>"/>
						<?php echo JHtml::_('form.token'); ?>
					</form>
				</li>
			</ul>
		</div>
	</div>
</div>
