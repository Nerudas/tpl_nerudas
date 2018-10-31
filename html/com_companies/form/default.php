<?php
/**
 * @package    Nerudas Template
 * @version    4.9.31
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
<form action="<?php echo Route::_(CompaniesHelperRoute::getFormRoute($this->item->id)); ?>" method="post"
	  name="adminForm" id="companies" class="form form-validate uk-form  uk-margin-bottom"
	  enctype="multipart/form-data">
	<?php echo LayoutHelper::render('template.title', array('form' => 'company')); ?>
	<ul class="uk-tab-new uk-margin-bottom-remove" data-uk-switcher="{connect:'#companyTabs', swiping: false}"
		data-save-tabs="companyTabs">
		<li><a href="#about"><?php echo Text::_('COM_COMPANIES_COMPANY_ABOUT'); ?></a></li>
		<li><a href="#portfolio"><?php echo Text::_('COM_COMPANIES_COMPANY_PORTFOLIO'); ?></a></li>
		<?php if (!empty($this->item->id)): ?>
			<li><a href="#employees"><?php echo Text::_('COM_COMPANIES_EMPLOYEES'); ?></a></li>
		<?php endif; ?>
	</ul>

	<ul id="companyTabs" class="uk-switcher" data-uk-switcher-tabs="">
		<li data-tab="about" class="uk-panel uk-panel-box uk-form-horizontal ">
			<?php echo $this->form->renderField('name'); ?>
			<?php echo $this->form->renderField('alias'); ?>
			<div class="uk-form-row">
				<div class="uk-text-large"><?php echo Text::_('COM_COMPANIES_COMPANY_ABOUT'); ?></div>
				<div><?php echo $this->form->getInput('about'); ?></div>
			</div>
			<div class="uk-margin-large-top uk-form-horizontal">
				<?php echo $this->form->renderFieldSet('images'); ?>
			</div>
			<div class="uk-margin-large-top uk-form-horizontal">
				<div class="uk-h2">
					<?php echo Text::_('COM_COMPANIES_COMPANY_CONTACTS'); ?>
				</div>
				<?php echo $this->form->renderFieldset('contacts'); ?>
			</div>
			<div class="uk-margin-large-top uk-form-horizontal">
				<div class="uk-h2">
					<?php echo Text::_('COM_COMPANIES_COMPANY_REQUISITES'); ?>
				</div>
				<?php echo $this->form->renderFieldSet('requisites'); ?>
			</div>
			<div class="uk-margin-large-top uk-form-horizontal">
				<div class="uk-h2">
					<?php echo Text::_('COM_COMPANIES_COMPANY_TAGS'); ?>
				</div>
				<?php echo $this->form->getInput('tags'); ?>
			</div>
			<div class="uk-margin-top uk-text-right">
				<button onclick="Joomla.submitbutton('company.cancel');"
						class="uk-button uk-button-danger">
					<?php echo Text::_('TPL_NERUDAS_ACTIONS_CANCEL'); ?>
				</button>
				<button onclick="Joomla.submitbutton('company.save');" class="uk-button uk-button-success">
					<?php echo Text::_('TPL_NERUDAS_ACTIONS_SAVE'); ?>
				</button>
			</div>
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
</form>