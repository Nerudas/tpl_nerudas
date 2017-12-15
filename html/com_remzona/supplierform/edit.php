<?php
/**
 * @package    Remzona Component
 * @version    1.0.0
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2017 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;


use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\LayoutHelper;

$app = Factory::getApplication();
$doc = Factory::getDocument();

HTMLHelper::_('behavior.formvalidator');
HTMLHelper::_('behavior.keepalive');
HTMLHelper::_('formbehavior.chosen', 'select');

$doc->addScriptDeclaration('Joomla.submitbutton = function(task){
	if (task == "supplier.cancel" || document.formvalidator.isValid(document.getElementById("remzona")))
	{
		Joomla.submitform(task, document.getElementById("remzona"));
	}};');
?>
<form action="<?php echo Route::_('index.php?option=com_remzona&view=suppliers&id=' . $this->item->id); ?>"
	  method="post" name="adminForm" id="remzona" class="supplier form form-validate uk-form"
	  enctype="multipart/form-data">
	<?php echo LayoutHelper::render('template.title', array('form' => 'supplier')); ?>

	<div class="uk-panel uk-panel-box  uk-form-horizontal uk-margin-bottom">
		<?php echo $this->form->renderField('title'); ?>
		<div class="uk-form-row">
			<div class="uk-from-label uk-margin-small-bottom">
				<?php echo Text::_('COM_REMZONA_SUPPLIER_ABOUT'); ?>
			</div>
			<div>
				<?php echo $this->form->getInput('about'); ?>
			</div>
		</div>
	</div>
	<div class="uk-panel uk-panel-box uk-margin-bottom">
		<div class="uk-panel-title uk-h3">
			<?php echo Text::_('JGLOBAL_FIELD_SPECTECHBRANDS_LABEL'); ?>
		</div>
		<div>
			<?php echo $this->form->getInput('brands'); ?>
		</div>
	</div>
	<div class="uk-panel uk-panel-box uk-margin-bottom">
		<div class="uk-panel-title uk-h3">
			<?php echo Text::_('JTAG'); ?>
		</div>
		<div>
			<?php echo $this->form->getInput('tags'); ?>
		</div>
	</div>
	<div class="uk-panel uk-panel-box uk-form-horizontal uk-margin-bottom">
		<div class="uk-panel-title uk-h3">
			<?php echo Text::_('COM_REMZONA_CONTACTS_FIELDSET_LABEL'); ?>
		</div>
		<div class="uk-form-horizontal">
			<?php echo $this->form->renderFieldset('contacts'); ?>
		</div>
	</div>
	<div class="uk-form-row uk-text-center">
		<button onclick="Joomla.submitbutton('<?php echo $form; ?>.cancel');"
				class="uk-button uk-button-danger">
			<?php echo Text::_('TPL_NERUDAS_ACTIONS_CANCEL'); ?>
		</button>
		<button onclick="Joomla.submitbutton('<?php echo $form; ?>.save');" class="uk-button uk-button-success">
			<?php echo Text::_('TPL_NERUDAS_ACTIONS_SAVE'); ?>
		</button>
	</div>


	<?php echo $this->form->getInput('region'); ?>
	<?php echo $this->form->getInput('created_by'); ?>
	<?php echo $this->form->getInput('created'); ?>
	<?php echo $this->form->getInput('published'); ?>

	<input type="hidden" name="task" value=""/>
	<input type="hidden" name="return" value="<?php echo $app->input->getCmd('return'); ?>"/>
	<?php echo HTMLHelper::_('form.token'); ?>

</form>