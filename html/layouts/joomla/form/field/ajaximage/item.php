<?php
/**
 * @package    Nerudas Template
 * @version    4.9.20
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;

extract($displayData);

?>
<div id="<?php echo $id; ?>" class="item uk-width-small-1-2 uk-width-medium-1-3" data-key="<?php echo $key; ?>">
	<div class="block">
		<div class="actions uk-clearfix">
			<a class="remove uk-button uk-button-small uk-button-danger uk-float-right uk-icon-remove">
			</a>
			<a class="move uk-button uk-button-small  uk-button-primary uk-float-left uk-icon-arrows">
			</a>
		</div>
		<div class="image">
			<img src="/<?php echo $value['src']; ?>">
			<input id="<?php echo $id; ?>_file" type="hidden" readonly name="<?php echo $name; ?>[file]"
				   value="<?php echo $value['file']; ?>">
		</div>
		<input id="<?php echo $id; ?>_src" type="hidden" name="<?php echo $name; ?>[src]"
			   value="<?php echo $value['src']; ?>">
		<?php if ($text): ?>
			<textarea id="<?php echo $id; ?>_description" type="text" name="<?php echo $name; ?>[text]"
					  placeholder="<?php echo Text::_('PLG_FIELDTYPES_AJAXIMAGE_TEXT_PLACEHOLDER'); ?>"
					  class="description"><?php echo $value['text']; ?></textarea>
		<?php endif; ?>

	</div>
</div>
