<?php
/**
 * @package    Nerudas Template
 * @version    4.9.22
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;

use Joomla\CMS\Form\Form;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;

extract($displayData);

/**
 * Layout variables
 * -----------------
 * @var  Form   $form   Form object
 * @var  string $action Action link;
 * @var string  $cancel Cancel botom;
 */

?>
<?php if ($form): ?>
	<form action="<?php echo $action; ?>" method="post" class="uk-form">
		<div class="uk-form-row">
			<?php
			$class = $form->getFieldAttribute('text', 'class', '', '') . ' uk-width-1-1';
			$form->setFieldAttribute('text', 'class', $class, '');
			echo $form->getInput('text'); ?>
		</div>
		<div class="uk-form-row uk-text-right">

			<?php if (!empty($form->getInput('captcha'))): ?>
				<div class="uk-flex uk-flex-right uk-margin-small-bottom">
					<?php echo $form->getInput('captcha'); ?>
				</div>
			<?php endif; ?>
			<div>
				<?php if (!empty($cancel)): ?>
					<a class="uk-button uk-button-danger" data-uk-toggle="<?php echo $cancel; ?>">
						<?php echo Text::_('TPL_NERUDAS_ACTIONS_CANCEL'); ?>
					</a>
				<?php endif; ?>
				<button class="uk-button uk-button-success">
					<?php echo (!empty($cancel)) ? Text::_('JAPPLY') : Text::_('JSUBMIT'); ?>
				</button>
			</div>
		</div>


		<input type="hidden" name="task" value="post.save">
		<input type="hidden" name="return" value="<?php echo base64_encode(Factory::getUri()->toString()); ?>">
		<?php echo HTMLHelper::_('form.token'); ?>
		<?php echo $form->renderFieldSet('hidden'); ?>
	</form>
<?php endif; ?>