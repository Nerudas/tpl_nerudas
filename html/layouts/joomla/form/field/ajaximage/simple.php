<?php
/**
 * @package    Nerudas Template
 * @version    4.9.21
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;

extract($displayData);

HTMLHelper::_('jquery.framework');
HTMLHelper::_('script', 'media/plg_fieldtypes_ajaximage/js/ajaximage.min.js', array('version' => 'auto'));
?>
<div id="<?php echo $id; ?>" class="<?php echo $class; ?> uk-margin-large-bottom" data-input-ajaximage="simple">
	<div class="form uk-postion-ralitive uk-placeholder">
		<img src=""/>
		<input id="<?php echo $id; ?>_file" class="file" type="file" accept="image/*"/>
		<label for="<?php echo $id; ?>_file">
			<a class="uk-button uk-button-large uk-button-primary uk-width-1-1">
				<?php echo Text::_('PLG_FIELDTYPES_AJAXIMAGE_CHOOSE_BUTTON'); ?>
			</a>
		</label>
	</div>
	<a class="remove uk-button uk-button-small uk-button-danger uk-float-right uk-icon-remove"></a>
	<div id="<?php echo $id; ?>_progress" class="uk-progress uk-progress-success">
		<div class="bar uk-progress-bar">
			<div class="text"></div>
		</div>
	</div>
	<input id="<?php echo $id; ?>_result" type="hidden" class="result" name="<?php echo $name; ?>"
		   value="<?php echo $value; ?>">
</div>
