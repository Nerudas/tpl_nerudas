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
if (count($plugins))
{
	foreach ($plugins as $link)
	{
		$item         = new stdClass();
		$item->title  = $link['plugin_title'];
		$item->params = '';
		if (isset($link['params']))
		{
			foreach ($link['params'] as $k => $v)
			{
				$item->params .= ' ' . $k . '="' . $v . '"';
			}
		}
		$item->icon  = $link['plugin_name'];
		$item->class = $link['class'];
		$item->link  = $link['link'];
		if ($link['plugin_name'] == 'vkontakte')
		{
			$item->icon = 'vk';
		}
		$sbuttons[] = $item;
	}
}
?>

<div id="login" class="uk-modal login jlslogin">
	<div class="uk-modal-dialog">
		<a class="uk-modal-close uk-close">
		</a>
		<h4 class="uk-modal-header">
			<?php echo JText::_('NERUDAS_LOGIN_TITLE') ?>
		</h4>
		<?php if ($params->get('show_login_form')): ?>
			<div class="inner-form">
				<form action="<?php echo JRoute::_('index.php', true, $params->get('usesecure')); ?>" method="post"
					  class="uk-form">
					<div class="uk-form-row">
						<div class="uk-form-icon uk-width-1-1">
							<i class="uk-icon-at uk-form-large"></i>
							<input type="text" name="username" placeholder="<?php echo JText::_('NERUDAS_EMAIL') ?>"
								   class="uk-width-1-1 uk-form-large" size="18">
						</div>
					</div>
					<div class="uk-form-row uk-form-password uk-width-1-1">
						<div class="uk-form-icon uk-width-1-1">
							<i class="uk-icon-lock uk-form-large"></i>
							<input type="password" name="password"
								   placeholder="<?php echo JText::_('NERUDAS_PASSWORD') ?>"
								   class="uk-form-large uk-width-1-1">
							<a href="" class="uk-form-password-toggle"
							   data-uk-form-password="{lblShow:'<?php echo JText::_('NERUDAS_SHOW'); ?>', lblHide:'<?php echo JText::_('NERUDAS_HIDE'); ?>'}">
								<?php echo JText::_('NERUDAS_SHOW'); ?>
							</a>
						</div>
					</div>
					<div class="uk-form-row uk-clearfix">
						<div class="uk-float-right">
							<a rel="nofollow" href="<?php echo JRoute::_('index.php?option=com_users&view=reset'); ?>">
								<?php echo JText::_('NERUDAS_FORGOT_PASSWORD'); ?>
							</a>
						</div>
						<?php if (JPluginHelper::isEnabled('system', 'remember')) : ?>
							<div class="uk-float-left">
								<input type="checkbox" name="remember" class="inputbox" checked value="yes"/>
								<label class="uk-text-middle">
									<?php echo JText::_('MOD_SLOGIN_REMEMBER_ME') ?>
								</label>
							</div>
						<?php endif; ?>
					</div>
					<div class="uk-form-row uk-text-right">
						<button type="submit" name="Submit" class="uk-button uk-button-primary">
							<?php echo JText::_('NERUDAS_LOGIN') ?>
						</button>
					</div>
					<input type="hidden" name="option" value="com_users"/>
					<input type="hidden" name="task" value="user.login"/>
					<input type="hidden" name="return" value="<?php echo $return; ?>"/>
					<?php echo JHtml::_('form.token'); ?>
				</form>
			</div>
		<?php endif; ?>
		<?php if (count($plugins)): ?>
			<div class="slogin-buttons uk-margin-bottom uk-margin-top ">
				<div class="uk-deviver-linetext">
				<span class="uk-text-muted uk-text-mlarge">
				<?php echo JText::_('NERUDAS_OR') ?>
				</span>
				</div>
				<div id="slogin-buttons" class="uk-margin-top uk-text-center">
					<?php foreach ($sbuttons as $sbutton): ?>
						<a rel="nofollow"
						   class="link<?php echo $sbutton->class; ?> uk-vertical-align" <?php echo $sbutton->params; ?>
						   href="<?php echo JRoute::_($sbutton->link); ?>">
							<i class="uk-vertical-align-middle"></i>
							<span class="text-socbtn uk-hidden">
					<?php echo $sbutton->title; ?>
					</span>
						</a>
					<?php endforeach; ?>
				</div>
			</div>
		<?php endif; ?>
		<div class="uk-modal-footer uk-text-mutted uk-text-center">
			<?php if (JComponentHelper::getParams('com_users')->get('allowUserRegistration')): ?>
				<?php echo JText::_('NERUDAS_LOGIN_NO_ACCOUNT') ?>
				<a class="" rel="nofollow"
				   href="<?php echo JRoute::_('index.php?option=com_users&view=registration'); ?>">
					<?php echo JText::_('NERUDAS_LOGIN_REGISTER'); ?>
				</a>
			<?php endif; ?>
		</div>
	</div>
</div>
