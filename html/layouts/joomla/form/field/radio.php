<?php
/**
 * @package    Nerudas Template
 * @version    4.9.16
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('JPATH_BASE') or die;

use Joomla\CMS\HTML\HTMLHelper;

extract($displayData);

HTMLHelper::_('jquery.framework');
HTMLHelper::_('script', 'system/html5fallback.js', array('version' => 'auto', 'relative' => true, 'conditional' => 'lt IE 9'));

$format = '<input type="radio" id="%1$s" name="%2$s" value="%3$s" %4$s />';
$alt    = preg_replace('/[^a-zA-Z0-9_\-]/', '_', $name);

$btn_group = (preg_match('/btn-group/', $class));
if ($btn_group)
{
	$class = str_replace('btn-group-yesno', '', $class);
	$class = str_replace('btn-group', 'uk-button-group', $class);
}


?>
<fieldset id="<?php echo $id; ?>" class="<?php echo trim($class . ' radio'); ?>"
	<?php echo ($disabled) ? 'disabled' : ''; ?>
	<?php echo ($required) ? 'required aria-required="true"' : ''; ?>
	<?php echo ($autofocus) ? 'autofocus' : ''; ?>
	<?php echo ($btn_group) ? '  data-uk-button-radio' : '' ?>>
	<?php if (!empty($options)) : ?>
		<?php foreach ($options as $i => $option) : ?>
			<?php
			$oid      = $id . $i;
			$checked  = ((string) $option->value === $value) ? 'checked="checked"' : '';
			$disabled = !empty($option->disable) || ($disabled && !$checked) ? 'disabled' : '';
			$onclick  = !empty($option->onclick) ? 'onclick="' . $option->onclick . '"' : '';
			$onchange = !empty($option->onchange) ? 'onchange="' . $option->onchange . '"' : '';
			$ovalue   = htmlspecialchars($option->value, ENT_COMPAT, 'UTF-8');

			$optionClass = !empty($option->class) ? $option->class : '';
			if ($btn_group)
			{
				$optionClass .= ' uk-button';
				if ((string) $option->value === $value)
				{
					$optionClass .= ' uk-active';
				}
			}
			$optionClass = 'class="' . $optionClass . '"';
			$attributes  = array_filter(array($checked, $optionClass, $disabled, $onchange, $onclick));
			if ($required)
			{
				$attributes[] = 'required aria-required="true"';
			}
			?>
			<label for="<?php echo $oid; ?>" <?php echo $optionClass; ?>>
				<?php echo sprintf($format, $oid, $name, $ovalue, implode(' ', $attributes)); ?>
				<?php echo $option->text; ?>
			</label>
		<?php endforeach; ?>
	<?php endif; ?>
</fieldset>
