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

HTMLHelper::_('behavior.formvalidator');
HTMLHelper::_('behavior.keepalive');
HTMLHelper::_('formbehavior.chosen', 'select');

$doc->addScriptDeclaration('
	Joomla.submitbutton = function(task)
	{
		if (task == "company.cancel" || document.formvalidator.isValid(document.getElementById("companies")))
		{
			Joomla.submitform(task, document.getElementById("companies"));
		}
	};
');
?>
<form action="<?php echo Route::_('index.php?option=com_companies&view=list&id=' . $this->item->id); ?>"
	  method="post"
	  name="adminForm" id="companies" class="form form-validate uk-form  uk-margin-bottom"
	  enctype="multipart/form-data">
	<?php echo LayoutHelper::render('template.title', array('form' => 'company')); ?>
	<ul class="uk-tab-new uk-margin-bottom-remove" data-uk-switcher="{connect:'#companyTabs', swiping: false}"
		data-save-tabs="companyTabs">
		<li><a href="#about"><?php echo Text::_('COM_COMPANIES_COMPANY_ABOUT'); ?></a></li>
		<li><a href="#images"><?php echo Text::_('COM_COMPANIES_COMPANY_IMAGES'); ?></a></li>
		<li><a href="#contacts"><?php echo Text::_('COM_COMPANIES_COMPANY_CONTACTS'); ?></a></li>
		<li><a href="#requisites"><?php echo Text::_('COM_COMPANIES_COMPANY_REQUISITES'); ?></a></li>
		<li><a href="#tags"><?php echo Text::_('COM_COMPANIES_COMPANY_TAGS'); ?></a></li>
		<li><a href="#portfolio"><?php echo Text::_('COM_COMPANIES_COMPANY_PORTFOLIO'); ?></a></li>
		<?php if (!empty($this->item->id)): ?>
			<li><a href="#employees"><?php echo Text::_('COM_COMPANIES_EMPLOYEES'); ?></a></li>
		<?php endif; ?>
	</ul>

	<ul id="companyTabs" class="uk-switcher" data-uk-switcher-tabs="">
		<li data-tab="about" class="uk-panel uk-panel-box uk-form-horizontal ">
			<?php echo $this->form->renderField('title'); ?>
			<?php echo $this->form->renderField('alias'); ?>
			<div class="uk-form-row">
				<div class="uk-text-large"><?php echo Text::_('COM_COMPANIES_COMPANY_ABOUT'); ?></div>
				<div><?php echo $this->form->getInput('about'); ?></div>
			</div>
		</li>
		<li data-tab="images" class="uk-panel uk-panel-box uk-form-horizontal ">
			<?php echo $this->form->renderFieldSet('images'); ?>
		</li>
		<li data-tab="contacts" class="uk-panel uk-panel-box uk-form-horizontal ">
			<?php echo $this->form->renderFieldSet('contacts'); ?>
		</li>
		<li data-tab="requisites" class="uk-panel uk-panel-box uk-form-horizontal ">
			<?php echo $this->form->renderFieldSet('requisites'); ?>
		</li>
		<li data-tab="tags" class="uk-panel uk-panel-box">
			<?php echo $this->form->getInput('tags'); ?>
		</li>
		<li data-tab="portfolio" class="uk-panel uk-panel-box">
			<?php echo $this->form->getInput('portfolio'); ?>
		</li>
		<?php if (!empty($this->item->id)): ?>
			<li data-tab="employees" class="uk-padding-small-top">
				<?php echo $this->form->getInput('employees'); ?>
			</li>
		<?php endif; ?>
	</ul>

	<?php echo $this->form->renderFieldSet('hidden'); ?>

	<input type="hidden" name="task" value=""/>
	<input type="hidden" name="return" value="<?php echo $app->input->getCmd('return'); ?>"/>
	<?php echo HTMLHelper::_('form.token'); ?>


	<div class="uk-form-row uk-text-center uk-margin-top">
		<button onclick="Joomla.submitbutton('company.cancel');"
				class="uk-button uk-button-danger">
			<?php echo Text::_('TPL_NERUDAS_ACTIONS_CANCEL'); ?>
		</button>
		<button onclick="Joomla.submitbutton('company.save');" class="uk-button uk-button-success">
			<?php echo Text::_('TPL_NERUDAS_ACTIONS_SAVE'); ?>
		</button>
	</div>
</form>