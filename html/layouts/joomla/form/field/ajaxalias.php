<?php
/**
 * @package    Nerudas Template
 * @version    4.9.32
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;

HTMLHelper::_('jquery.framework');
HTMLHelper::_('script', 'media/plg_fieldtypes_ajaxalias/js/ajaxalias.min.js', array('version' => 'auto'));

extract($displayData);

$value = (!empty($value)) ? $value : '';
?>
<div id="<?php echo $id; ?>" data-input-ajaxalias>
	<div class="input-append">
		<input id="<?php echo $id; ?>_field" type="text" name="<?php echo $name; ?>" value="<?php echo $value; ?>"
			   class="<?php echo $class; ?>"
			   placeholder="<?php echo Text::_($hint); ?>">
		<span class="add-on loading status uk-button uk-flex-inline uk-flex-middle">
			<i class="uk-icon-refresh uk-icon-spin"></i></span>
		<span class="add-on status success uk-button uk-flex-inline uk-flex-middle">
			<i class="uk-icon-check uk-text-success"></i></span>
		<span class="add-on status error uk-button uk-flex-inline uk-flex-middle">
			<i class="uk-icon-close uk-text-danger"></i></span>
	</div>
	<div class="error description status  uk-alert uk-alert-danger uk-form-help-block"></div>
</div>
