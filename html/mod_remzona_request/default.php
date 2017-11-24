<?php
/**
 * @package    Nerudas Template
 * @version    4.9.3
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2017 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;

use Joomla\CMS\Router\Route;
use Joomla\CMS\Language\Text;
use Joomla\CMS\HTML\HTMLHelper;

?>

<div data-mod-remozona-request>
	<div class="result">
		<div class="error">

		</div>
		<div class="success">
		</div>
	</div>
	<form class="form-validate" enctype="multipart/form-data">
		<?php echo $form->renderField('text'); ?>
		<?php echo $form->renderField('phones'); ?>
		<?php echo $form->renderField('region'); ?>
		<div class="control-group">
			<div class="control-label">
				<?php echo Text::_('COM_REMZONA_REQUEST_CAR'); ?>
			</div>
			<div class="controls">
				<?php echo $form->getInput('brand'); ?>
				<?php echo $form->getInput('model'); ?>
				<?php echo $form->getInput('year'); ?>
			</div>
		</div>
		<?php echo $form->renderField('suppliertypes'); ?>
		<div class="control-group">
			<a class="submit"><?php echo Text::_('JSUBMIT'); ?></a>
		</div>
		<input type="hidden" name="return" value="<?php echo (string) JUri::getInstance(); ?>"/>
		<?php echo HTMLHelper::_('form.token'); ?>
	</form>
</div>