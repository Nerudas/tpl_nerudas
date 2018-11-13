<?php
/**
 * @package    Nerudas Template
 * @version    4.9.33
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
		if (task == "item.cancel" || document.formvalidator.isValid(document.getElementById("prototype")))
		{
			Joomla.submitform(task, document.getElementById("prototype"));
		}
	};
');
?>
<form action="<?php echo Route::_(PrototypeHelperRoute::getFormRoute($this->item->id, $this->category->id,
	$app->input->getCmd('return_view'))); ?>" method="post" name="adminForm" id="prototype"
	  class="form form-validate uk-form uk-margin-bottom" enctype="multipart/form-data">
	<?php echo LayoutHelper::render('template.title', array('form' => 'item')); ?>
	<?php if (!empty($this->presets)): ?>
		<?php echo LayoutHelper::render('components.com_prototype.form.presets',
			array('form' => $this->form, 'presets' => $this->presets)); ?>
	<?php endif; ?>
	<div data-prototype-form="form" <?php echo (!empty($this->presets)) ? 'style="display: none"' : ''; ?>>
		<?php if (!empty($this->presets)): ?>
			<div class="uk-text-right uk-margin-bottom uk-hidden">
				<span data-preset-title="label" class="uk-text-muted uk-margin-small-right"></span>
				<a data-prototype-form="change-preset">
					<?php echo Text::_('TPL_NERUDAS_ACTIONS_CHANGE'); ?>
				</a>
			</div>
		<?php endif; ?>
		<div class="uk-panel uk-panel-box uk-form-horizontal uk-margin-bottom">
			<?php echo $this->form->renderField('title'); ?>
			<?php echo $this->form->renderField('price'); ?>
			<?php $this->form->setFieldAttribute('text', 'class', 'uk-width-1-1');
			echo $this->form->renderField('text'); ?>
		</div>
		<?php echo LayoutHelper::render('components.com_prototype.form.author',
			array('form' => $this->form, 'author' => $this->author, 'isNew' => (!empty($this->item->id)))); ?>
		<div class="uk-panel uk-panel-box uk-margin-bottom">
			<div class="uk-panel-title uk-h3">
				<?php echo Text::_('JGLOBAL_FIELD_MAP_LABEL'); ?>
			</div>
			<div>
				<?php echo $this->form->getInput('map'); ?>
			</div>
		</div>
		<div class="uk-panel uk-panel-box uk-margin-bottom">
			<div class="uk-panel-title uk-h3">
				<?php echo Text::_('COM_PROTOTYPE_ITEM_IMAGES'); ?>
			</div>
			<div>
				<?php echo $this->form->getInput('images'); ?>
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
	</div>
</form>