<?php
/**
 * @package    Nerudas Template
 * @version    4.9.34
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;

extract($displayData);


$attributes        = array();
$attributes['id']  = 'id="' . $for . '-lbl"';
$attributes['for'] = 'for="' . $for . '"';
if ((!empty($description)))
{
	$attributes['title']   = 'title="' . $description . '"';
	$attributes['tooltip'] = 'data-uk-tooltip="pos:\'bottom-left\'"';
}
$classes   = array_filter((array) $classes);
$classes[] = 'uk-form-label';
if ($required)
{
	$classes[] = 'required';
}
$attributes['class'] = 'class="' . implode(' ', $classes) . '"';

?>
<label <?php echo implode(' ', $attributes); ?>>
	<?php echo $text; ?>
</label>
