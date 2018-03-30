<?php
/**
 * @package    Nerudas Template
 * @version    4.9.7
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\LayoutHelper;

HTMLHelper::_('behavior.keepalive');
HTMLHelper::_('behavior.formvalidator');

?>
<form action="<?php echo Route::_('index.php?option=com_users&task=reset.request'); ?>" method="post"
	  class="form-validate uk-form uk-form-horizontal">
	<?php echo LayoutHelper::render('template.title', array()); ?>
	<div class="uk-panel uk-panel-box">
		<div class="uk-form-row">
			<?php echo Text::_('COM_USERS_RESET_REQUEST_LABEL'); ?>
		</div>
		<?php echo $this->form->renderField('email'); ?>
		<?php echo $this->form->renderField('captcha'); ?>
		<div class="uk-form-row">
			<div class="uk-form-label"></div>
			<div class="uk-form-controls">
				<a class="uk-button uk-button-danger"
				   href="<?php echo Route::_('index.php?option=com_users&view=login'); ?>">
					<?php echo Text::_('JCANCEL'); ?>
				</a>
				<button type="submit" class="uk-button uk-button-primary validate">
					<?php echo Text::_('JSUBMIT'); ?>
				</button>
			</div>
		</div>
		<?php echo HTMLHelper::_('form.token'); ?>
	</div>
</form>

