<?php
/**
 * @package    Nerudas Template
 * @version    4.9.15
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
		if (task == "topic.cancel" || document.formvalidator.isValid(document.getElementById("item-form")))
		{
			Joomla.submitform(task, document.getElementById("item-form"));
		}
	};
');
?>
<form action="<?php echo Route::_(DiscussionsHelperRoute::getTopicFormRoute($this->item->id)); ?>"
	  method="post"
	  name="adminForm" id="item-form" class="form-validate uk-form" enctype="multipart/form-data">
	<?php echo LayoutHelper::render('template.title', array('form' => 'topic')); ?>
	<div class="uk-panel uk-panel-box  uk-form-horizontal uk-margin-bottom">
		<?php echo $this->form->renderField('title'); ?>
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
			<?php echo Text::_('COM_DISCUSSIONS_TOPIC_IMAGES'); ?>
		</div>
		<div>
			<?php echo $this->form->getInput('images'); ?>
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
		<button onclick="Joomla.submitbutton('topic.cancel');"
				class="uk-button uk-button-danger">
			<?php echo Text::_('TPL_NERUDAS_ACTIONS_CANCEL'); ?>
		</button>
		<button onclick="Joomla.submitbutton('topic.save');" class="uk-button uk-button-success">
			<?php echo Text::_('TPL_NERUDAS_ACTIONS_SAVE'); ?>
		</button>
	</div>
</form>