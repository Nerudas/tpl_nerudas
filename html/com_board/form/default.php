<?php
/**
 * @package    Nerudas Template
 * @version    4.9.37
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
		if (task == "item.cancel" || document.formvalidator.isValid(document.getElementById("board")))
		{
			Joomla.submitform(task, document.getElementById("board"));
		}
	};
');


?>
<form action="<?php echo Route::_(BoardHelperRoute::getFormRoute($this->item->id)); ?>" method="post"
	  name="adminForm" id="board" class="form form-validate uk-form uk-margin-bottom"
	  enctype="multipart/form-data">

	<?php echo LayoutHelper::render('template.title', array('form' => 'item')); ?>

	<div class="uk-panel uk-panel-box  uk-form-horizontal uk-margin-bottom">
		<?php echo $this->form->renderField('title'); ?>
		<?php echo $this->form->renderField('for_when'); ?>
		<?php
		$class = $this->form->getFieldAttribute('actual', 'class', '', '') . ' wrap';
		$this->form->setFieldAttribute('actual', 'class', $class, '');
		echo $this->form->renderField('actual'); ?>
		<div class="uk-form-row">
			<?php echo $this->form->getInput('text'); ?>
		</div>

	</div>
	<div class="uk-panel uk-panel-box uk-margin-bottom">
		<div class="uk-panel-title uk-h3">
			<?php echo Text::_('COM_BOARD_ITEM_CONTACTS'); ?>
		</div>
		<div class="uk-form-horizontal">
			<?php echo $this->form->renderFieldSet('contacts'); ?>
		</div>
	</div>

	<div class="uk-panel uk-panel-box uk-margin-bottom">
		<div class="uk-panel-title uk-h3">
			<?php echo Text::_('COM_BOARD_ITEM_PAYMENT'); ?>
		</div>
		<div class="uk-form-horizontal">
			<?php echo $this->form->renderFieldSet('payment'); ?>
		</div>
	</div>

	<div class="uk-panel uk-panel-box uk-margin-bottom">
		<div class="uk-panel-title uk-h3">
			<?php echo Text::_('COM_BOARD_ITEM_IMAGES'); ?>
		</div>
		<div>
			<?php echo $this->form->getInput('images'); ?>
		</div>
	</div>
	<div class="uk-panel uk-panel-box uk-margin-bottom">
		<div class="uk-panel-title uk-h3">
			<?php echo Text::_('JGLOBAL_FIELD_MAP_LABEL'); ?>
		</div>
		<div>
			<?php echo $this->form->getInput('map'); ?>
		</div>
	</div>
	<div class="uk-panel uk-panel-box uk-margin-bottom">
		<div class="uk-h3">
			<?php echo Text::_('JTAG'); ?>
		</div>
		<div>
			<?php echo $this->form->getInput('tags'); ?>
		</div>
	</div>

	<?php echo $this->form->renderFieldSet('hidden'); ?>

	<input type="hidden" name="task" value=""/>
	<input type="hidden" name="return" value="<?php echo $app->input->getCmd('return'); ?>"/>
	<?php echo HTMLHelper::_('form.token'); ?>

	<div class="uk-form-row uk-text-center">
		<button onclick="Joomla.submitbutton('item.cancel');"
				class="uk-button uk-button-danger">
			<?php echo Text::_('TPL_NERUDAS_ACTIONS_CANCEL'); ?>
		</button>
		<button onclick="Joomla.submitbutton('item.save');" class="uk-button uk-button-success">
			<?php echo Text::_('TPL_NERUDAS_ACTIONS_SAVE'); ?>
		</button>
	</div>
</form>