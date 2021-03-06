<?php
/**
 * @package    Nerudas Template
 * @version    4.9.42
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;

extract($displayData);

/**
 * Layout variables
 * -----------------
 * @var   array  $value    Value attribute of the field.
 * @var   bool   $checkbox show contract price checkbox
 * @var   string $checked  checkbox checked
 * @var   string $id       DOM id of the field.
 * @var   string $name     Name of the input field.
 * @var   string $class    Classes for the input.
 */


HTMLHelper::_('jquery.framework');
HTMLHelper::_('script', 'media/plg_fieldtypes_price/field.min.js', array('version' => 'auto'));

?>

<div id="<?php echo $id; ?>" data-input-price="default"
	 class="uk-flex uk-flex-middle uk-flex-wrap <?php echo $class; ?>">
	<div class="text-field ">
		<div class="input-append uk-margin-right uk-margin-small-bottom">
			<input id="<?php echo $id; ?>_text" type="text" name="<?php echo $name; ?>" value="<?php echo $value; ?>">
			<span class="currency"><?php echo Text::_('JGLOBAL_FIELD_PRICE_CURRENCY_RUB'); ?></span>
		</div>
	</div>
	<?php if ($checkbox) : ?>
		<div class="checkbox-field uk-margin-small-bottom">
			<label for="<?php echo $id; ?>_checkbox">
				<input id="<?php echo $id; ?>_checkbox" type="checkbox" name="<?php echo $name; ?>"
					   value="-0" <?php echo $checked; ?>>
				<?php echo Text::_('JGLOBAL_FIELD_PRICE_CONTRACT_PRICE'); ?>
			</label>
		</div>
	<?php endif; ?>
</div>
