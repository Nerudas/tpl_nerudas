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

/* General
========================================================================== */
$app             = JFactory::getApplication();
$doc             = JFactory::getDocument();
$config          = JFactory::getConfig();
$this->language  = $doc->language;
$this->direction = $doc->direction;
require_once JPATH_ADMINISTRATOR . '/components/com_users/helpers/users.php';
$ukTheme       = '';
$ukCompression = '';
if ($this->params->get('uk-theme'))
{
	$ukTheme = '.' . $this->params->get('uk-theme');
}
if ($this->params->get('uk-compression'))
{
	$ukCompression = '.min';
}

/* Site Settings
========================================================================== */
$site       = new stdClass();
$site->name = $config->get('sitename');
$site->logo = '/templates/' . $this->template . '/images/logo.png';

/* StyleSheets
========================================================================== */
// Uikit
$this->addStyleSheet('https://cdnjs.cloudflare.com/ajax/libs/uikit/' . $app->getTemplate(true)->params->get('uk-version') . '/css/uikit' . $ukTheme . $ukCompression . '.css');
$this->addStyleSheet('https://cdnjs.cloudflare.com/ajax/libs/uikit/' . $this->params->get('uk-version') . '/css/components/form-password' . $ukTheme . $ukCompression . '.css');

/* Scripts
========================================================================== */
// Uikit
$this->addScript('https://cdnjs.cloudflare.com/ajax/libs/uikit/' . $this->params->get('uk-version') . '/js/uikit' . $ukCompression . '.js');
$this->addScript('https://cdnjs.cloudflare.com/ajax/libs/uikit/' . $this->params->get('uk-version') . '/js/components/form-password' . $ukCompression . '.js');


?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>"
	  lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>" class="uk-height-1-1">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<jdoc:include type="head"/>
</head>
<body class="uk-height-1-1">
<jdoc:include type="message"/>
<div class="uk-vertical-align uk-text-center uk-height-1-1">
	<div class="uk-vertical-align-middle uk-width-small-1-1 uk-width-medium-1-2 uk-width-large-1-4">
		<a href="#modal" data-uk-modal>
			<img src="<?php echo $site->logo; ?>" alt="<?php echo $site->name ?>"/>
		</a>
		<?php if ($app->get('display_offline_message')) : ?>
			<p class="uk-text-left">
				<?php if ($app->get('display_offline_message', '1') == '1'): ?>
					<?php echo $app->get('offline_message'); ?>
				<?php elseif ($app->get('display_offline_message', '1') == '2'): ?>
					<?php echo JText::_('NERUDAS_OFFLINE_MESAGE'); ?>
				<?php endif; ?>
			</p>
		<?php endif; ?>
		<div id="modal" class="uk-modal">
			<div class="uk-modal-dialog">
				<a class="uk-modal-close uk-close">
				</a>
				<div class="uk-modal-header">
					<h2><?php echo JText::_('NERUDAS_STUFF_LOGIN'); ?></h2>
				</div>
				<form action="<?php echo JRoute::_('index.php', true); ?>" method="post" id="form-login"
					  class="uk-form">
					<div id="form-login-username" class="uk-form-row">
						<input type="text" name="username" id="username" class="uk-width-1-1 uk-form-large"
							   autocomplete="off" autocapitalize="none"
							   placeholder="<?php echo JText::_('NERUDAS_EMAIL'); ?>"/>
					</div>
					<div id="form-login-password" class="uk-form-row uk-form-password uk-width-1-1">
						<input type="password" name="password" id="passwd" class="uk-width-1-1 uk-form-large"
							   placeholder="<?php echo JText::_('NERUDAS_PASSWORD'); ?>"/>
						<a href="" class="uk-form-password-toggle" data-uk-form-password>
							Show
						</a>
					</div>
					<div id="submit-buton" class="uk-form-row">
						<button type="submit" name="Submit"
								class="uk-width-1-1 uk-button uk-button-primary uk-button-large"><?php echo JText::_('NERUDAS_LOGIN'); ?></button>
					</div>
					<input type="hidden" name="option" value="com_users"/>
					<input type="hidden" name="task" value="user.login"/>
					<input type="hidden" name="return" value="<?php echo base64_encode(JUri::base()); ?>"/>
					<?php echo JHtml::_('form.token'); ?>
				</form>
			</div>
		</div>
	</div>
</div>
</body>
</html>
