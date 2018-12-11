<?php
/**
 * @package    Nerudas Template
 * @version    4.9.37
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('JPATH_BASE') or die;

extract($displayData);

/**
 * Layout variables
 * -----------------
 * @var   string  $autocomplete   Autocomplete attribute for the field.
 * @var   boolean $autofocus      Is autofocus enabled?
 * @var   string  $class          Classes for the input.
 * @var   string  $description    Description of the field.
 * @var   boolean $disabled       Is this field disabled?
 * @var   string  $group          Group the field belongs to. <fields> section in form XML.
 * @var   boolean $hidden         Is this field hidden in the form?
 * @var   string  $hint           Placeholder for the field.
 * @var   string  $id             DOM id of the field.
 * @var   string  $label          Label of the field.
 * @var   string  $labelclass     Classes to apply to the label.
 * @var   boolean $multiple       Does this field support multiple values?
 * @var   string  $name           Name of the input field.
 * @var   string  $onchange       Onchange attribute for the field.
 * @var   string  $onclick        Onclick attribute for the field.
 * @var   string  $pattern        Pattern (Reg Ex) of value of the form field.
 * @var   boolean $readonly       Is this field read only?
 * @var   boolean $repeat         Allows extensions to duplicate elements.
 * @var   boolean $required       Is this field required?
 * @var   integer $size           Size attribute of the input.
 * @var   boolean $spellcheck     Spellcheck state for the form field.
 * @var   string  $validate       Validation rules to apply.
 * @var   string  $value          Value attribute of the field.
 * @var   array   $checkedOptions Options that will be set as checked.
 * @var   boolean $hasValue       Has this field a value assigned?
 * @var   array   $options        Options available for this field.
 */

// Including fallback code for HTML5 non supported browsers.
JHtml::_('jquery.framework');
JHtml::_('script', 'system/html5fallback.js', array('version' => 'auto', 'relative' => true, 'conditional' => 'lt IE 9'));

/**
 * The format of the input tag to be filled in using sprintf.
 *     %1 - id
 *     %2 - name
 *     %3 - value
 *     %4 = any other attributes
 */
$format = '<input type="checkbox" id="%1$s" name="%2$s" value="%3$s" %4$s />';

// The alt option for JText::alt
$alt = preg_replace('/[^a-zA-Z0-9_\-]/', '_', $name);
?>

<fieldset id="<?php echo $id; ?>" class="<?php echo trim($class . ' uk-form-controls-text checkboxes'); ?>"
	<?php echo $required ? 'required aria-required="true"' : ''; ?>
	<?php echo $autofocus ? 'autofocus' : ''; ?>>

	<?php foreach ($options as $i => $option) :
		$oid = $id . $i;
		$value = htmlspecialchars($option->value, ENT_COMPAT, 'UTF-8');
		$attributes = array();
		if (in_array((string) $option->value, $checkedOptions, true))
		{
			$attributes['checked'] = 'checked';
		}
		if (!$hasValue && $option->checked)
		{
			$attributes['checked'] = 'checked';
		}

		$classes   = array();
		$classes[] = 'uk-margin-small-right';
		if (!empty($option->class))
		{
			$classes[] = $option->class;
		}
		$attributes['class'] = 'class="' . implode(' ', $classes) . '"';

		if (!empty($option->disable))
		{
			$attributes['disabled'] = 'disabled';
		}

		if (!empty($option->onclick))
		{
			$attributes['onclick'] = 'onclick="' . $option->onclick . '"';
		}

		if (!empty($option->onchange))
		{
			$attributes['onchange'] = 'onchange="' . $option->onchange . '"';
		}

		?>
		<p class="uk-form-controls-condensed">
			<label for="<?php echo $oid; ?>" class="checkbox">
				<?php echo sprintf($format, $oid, $name, $value, implode(' ', $attributes)); ?>
				<?php echo $option->text; ?>
			</label>
		</p>
	<?php endforeach; ?>
</fieldset>
