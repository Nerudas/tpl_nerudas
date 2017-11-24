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

use Joomla\CMS\Language\Text;
use Joomla\CMS\HTML\HTMLHelper;

?>

<div data-mod-remozona-request>
	<div class="result">
		<div class="error uk-alert uk-alert-danger">

		</div>
		<div class="success uk-alert uk-alert-success">
		</div>
	</div>
	<form class="form-validate uk-form uk-form-stacked" enctype="multipart/form-data">
		<div class="uk-form-row">
			<div class="uk-form-controls">
				<?php echo $form->getInput('text'); ?>
			</div>
		</div>
		<div class="uk-form-row">
			<div class="uk-form-controls">
				<?php echo $form->getInput('brand'); ?>
				<?php echo $form->getInput('model'); ?>
				<?php echo $form->getInput('year'); ?>
			</div>
		</div>
		<div class="uk-form-row">
			<div class="uk-form-controls">
				<?php echo $form->getInput('region'); ?>
				<?php echo $form->getInput('suppliertypes'); ?>
			</div>
		</div>
		<div class="uk-form-row uk-margin-bottom-remove">
			<div class="uk-form-controls uk-margin-bottom-remove uk-clearfix">
				<div class="uk-align-medium-left uk-margin-small-bottom">
				<?php echo $form->getInput('phones'); ?>
				</div>
				<div class="uk-align-medium-right uk-margin-small-bottom">
					<a class="submit uk-button uk-button-success"><?php echo Text::_('JSUBMIT'); ?></a>
				</div>
			</div>
		</div>
		<input type="hidden" name="return" value="<?php echo (string) JUri::getInstance(); ?>"/>
		<?php echo HTMLHelper::_('form.token'); ?>
	</form>
</div>