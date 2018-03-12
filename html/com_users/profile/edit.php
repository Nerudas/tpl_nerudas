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
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Factory;
use Joomla\CMS\Layout\LayoutHelper;

$app = Factory::getApplication();
$doc = Factory::getDocument();

HTMLHelper::_('behavior.keepalive');
HTMLHelper::_('behavior.formvalidator');
HTMLHelper::_('formbehavior.chosen', 'select');

$doc->addScriptDeclaration('
	Joomla.submitbutton = function(task)
	{
		if (task == "profile.cancel" || document.formvalidator.isValid(document.getElementById("profile")))
		{
			Joomla.submitform(task, document.getElementById("profile"));
		}
	};
');
$cancelLink = Route::_('index.php?option=com_users&view=profile');

?>

<form id="profile" action="<?php echo Route::_('index.php?option=com_users'); ?>"
	  method="post" class="form form-validate uk-form  uk-margin-bottom" enctype="multipart/form-data">
	<?php echo LayoutHelper::render('template.title', array('form' => 'profile', 'cancelLink' => $cancelLink)); ?>
	<ul class="uk-tab-new uk-margin-bottom-remove" data-uk-switcher="{connect:'#profileTabs', swiping: false}"
		data-save-tabs="profileTabs">
		<li><a href="#about"><?php echo Text::_('COM_PROFILES_PROFILE_ABOUT'); ?></a></li>
		<li><a href="#tags"><?php echo Text::_('JTAG'); ?></a></li>
		<li><a href="#images"><?php echo Text::_('COM_PROFILES_PROFILE_AVATAR'); ?></a></li>
		<li><a href="#contacts"><?php echo Text::_('COM_PROFILES_PROFILE_CONTACTS'); ?></a></li>
		<li><a href="#site_access"><?php echo Text::_('COM_PROFILES_PROFILE_SITE_ACCESS'); ?></a></li>
		<li><a href="#settings"><?php echo Text::_('TPL_NERUDAS_SETTINGS'); ?></a></li>
	</ul>

	<ul id="profileTabs" class="uk-switcher uk-margin-bottom" data-uk-switcher-tabs="">
		<li data-tab="about" class="uk-panel uk-panel-box">
			<div class="uk-form-horizontal uk-margin-bottom">
				<?php echo $this->form->renderField('name'); ?>
				<?php
				$class = $this->form->getFieldAttribute('status', 'class', '', '') . ' wrap';
				$class .= ' uk-width-1-1';
				$this->form->setFieldAttribute('status', 'class', $class, '');
				$this->form->setFieldAttribute('status', 'hint', Text::sprintf('TPL_NERUDAS_TEXT_MAXIMUМ', 100));
				echo $this->form->renderField('status');
				?>
			</div>
			<div class="uk-margin-bottom">
				<div class="uk-text-medium uk-margin-small-bottom">
					<?php echo $this->form->getLabel('about'); ?>
				</div>
				<div>
					<?php echo $this->form->getInput('about'); ?>
				</div>
			</div>

		</li>
		<li data-tab="tags" class="uk-panel uk-panel-box uk-form-horizontal">
			<?php echo $this->form->getInput('tags'); ?>
			<div class="uk-clearfix uk-margin-large-bottom"></div>
		</li>
		<li data-tab="images" class="uk-panel uk-panel-box uk-form-horizontal">
			<?php echo $this->form->renderFieldset('images'); ?>
		</li>
		<li data-tab="contacts" class="uk-panel uk-panel-box uk-form-horizontal">
			<?php echo $this->form->renderFieldset('contacts'); ?>
		</li>
		<li data-tab="site_access" class="uk-panel uk-panel-box uk-form-horizontal">
			<?php echo $this->form->renderFieldset('site_access'); ?>
		</li>
		<li data-tab="settings" class="uk-panel uk-panel-box uk-form-horizontal">
			<?php echo $this->form->renderField('alias'); ?>
			<?php echo $this->form->renderFieldset('settings'); ?>
		</li>
	</ul>

	<?php echo $this->form->renderFieldset('hidden'); ?>
	<input type="hidden" name="task" value=""/>
	<input type="hidden" name="return" value="<?php echo $app->input->getCmd('return'); ?>"/>
	<?php echo HTMLHelper::_('form.token'); ?>

	<div class="uk-form-row uk-text-center">
		<a href="<?php echo $cancelLink; ?>" class="uk-button uk-button-danger">
			<?php echo Text::_('TPL_NERUDAS_ACTIONS_CANCEL'); ?>
		</a>
		<button onclick="Joomla.submitbutton('profile.save');" class="uk-button uk-button-success">
			<?php echo Text::_('TPL_NERUDAS_ACTIONS_SAVE'); ?>
		</button>
	</div>
</form>


