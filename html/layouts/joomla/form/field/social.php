<?php
/**
 * @package    Nerudas Template
 * @version    4.9.39
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
HTMLHelper::_('stylesheet', 'media/plg_fieldtypes_social/field.min.css', array('version' => 'auto'));
HTMLHelper::_('script', 'media/plg_fieldtypes_social/field.min.js', array('version' => 'auto'));

?>

<div class="input-prepend <?php echo $class; ?>" data-input-social="<?php echo $network; ?>">
	<span class="add-on"><?php echo $network; ?>/</span>
	<input id="<?php echo $id; ?>" type="text" name="<?php echo $name; ?>"
		   value="<?php echo $value; ?>">
</div>

