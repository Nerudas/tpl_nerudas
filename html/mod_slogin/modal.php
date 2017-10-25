<?php
/**
 * @package    Nerudas Template
 * @version    5.0.0
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2017 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;


?>
<?php if ($type == 'login'): ?>
	<noindex>
		<div id="login" class="jlslogin" data-uk-modal>
			<div class="uk-modal-dialog uk-modal-body">
				<? echo '<pre>', print_r($type, true), '</pre>'; ?>
				<?php if ($params->get('inittext')): ?>
					<div class="pretext">
						<p><?php echo $params->get('inittext'); ?></p>
					</div>
				<?php endif; ?>
				<div id="slogin-buttons" class="slogin-buttons slogin-default">

					<?php if (count($plugins)): ?>
						<?php
						foreach ($plugins as $link):
							$linkParams = '';
							if (isset($link['params']))
							{
								foreach ($link['params'] as $k => $v)
								{
									$linkParams .= ' ' . $k . '="' . $v . '"';
								}
							}
							$title = (!empty($link['plugin_title'])) ? ' title="' . $link['plugin_title'] . '"' : '';
							?>
							<a rel="nofollow"
							   class="link<?php echo $link['class']; ?>" <?php echo $linkParams . $title; ?>
							   href="<?php echo JRoute::_($link['link']); ?>"><span
										class="<?php echo $link['class']; ?> slogin-ico">&nbsp;</span><span
										class="text-socbtn"><?php echo $link['plugin_title']; ?></span></a>
						<?php endforeach; ?>
					<?php endif; ?>

				</div>
				<div class="slogin-clear"></div>
				<?php if ($params->get('pretext')): ?>
					<div class="pretext">
						<p><?php echo $params->get('pretext'); ?></p>
					</div>
				<?php endif; ?>
				<?php if ($params->get('show_login_form')): ?>
					<form action="<?php echo JRoute::_('index.php', true, $params->get('usesecure')); ?>" method="post"
						  id="login-form">
						<fieldset class="userdata">
							<p id="form-login-username">
								<label for="modlgn-username"><?php echo JText::_('MOD_SLOGIN_VALUE_USERNAME') ?></label>
								<input id="modlgn-username" type="text" name="username" class="inputbox" size="18"/>
							</p>
							<p id="form-login-password">
								<label for="modlgn-passwd"><?php echo JText::_('JGLOBAL_PASSWORD') ?></label>
								<input id="modlgn-passwd" type="password" name="password" class="inputbox" size="18"/>
							</p>
							<?php if (JPluginHelper::isEnabled('system', 'remember')) : ?>
								<p id="form-login-remember">
									<label for="modlgn-remember">
										<input id="modlgn-remember" type="checkbox" name="remember" class="inputbox"
											   value="yes"/>
										<?php echo JText::_('MOD_SLOGIN_REMEMBER_ME') ?>
									</label>
								</p>
								<div class="slogin-clear"></div>
							<?php endif; ?>
							<input type="submit" name="Submit" class="button" value="<?php echo JText::_('JLOGIN') ?>"/>
							<input type="hidden" name="option" value="com_users"/>
							<input type="hidden" name="task" value="user.login"/>
							<input type="hidden" name="return" value="<?php echo $return; ?>"/>
							<?php echo JHtml::_('form.token'); ?>
						</fieldset>
						<ul class="ul-jlslogin">
							<li>
								<a rel="nofollow"
								   href="<?php echo JRoute::_('index.php?option=com_users&view=reset'); ?>">
									<?php echo JText::_('MOD_SLOGIN_FORGOT_YOUR_PASSWORD'); ?></a>
							</li>
							<li>
								<a rel="nofollow"
								   href="<?php echo JRoute::_('index.php?option=com_users&view=remind'); ?>">
									<?php echo JText::_('MOD_SLOGIN_FORGOT_YOUR_USERNAME'); ?></a>
							</li>
							<?php
							$usersConfig = JComponentHelper::getParams('com_users');
							if ($usersConfig->get('allowUserRegistration')) : ?>
								<li>
									<a rel="nofollow"
									   href="<?php echo JRoute::_('index.php?option=com_users&view=registration'); ?>">
										<?php echo JText::_('MOD_SLOGIN_REGISTER'); ?></a>
								</li>
							<?php endif; ?>
						</ul>
						<?php if ($params->get('posttext')): ?>
							<div class="posttext">
								<p><?php echo $params->get('posttext'); ?></p>
							</div>
						<?php endif; ?>
					</form>
				<?php endif; ?>
			</div>
		</div>
	</noindex>
<?php endif; ?>