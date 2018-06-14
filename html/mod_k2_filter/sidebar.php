<?php
/**
 * @package    Nerudas Template
 * @version    4.9.14
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;
$html = '<form name="filter_' . $mod_id . '" class="uk-form"><input type="hidden" name="filter" value="true">';
if ($searchtext)
{
	$html .= '<div class="uk-form-row">';
	if (!empty($searchtext->label))
	{
		$html .= '<label class="uk-form-label">' . $searchtext->label . '</label>';
	}
	$html .= '<div class="uk-form-controls"><input name="' . $searchtext->name . '" class="uk-width-1-1" value="' . $searchtext->value . '" placeholder="' . $searchtext->placeholder . '" /></div></div>';
}
foreach ($extraFields as $field)
{
	$qa = '';
	ob_start();
	require JModuleHelper::getLayoutPath('mod_k2_filter', 'default_' . $field->type);
	$qa = ob_get_contents();
	ob_end_clean();
	$html .= $qa;
}
$html .= '<div class="uk-form-row">
<div class="uk-form-controls">
<button type="reset" class="uk-button uk-button-danger">' . JText::_('NERUDAS_RESET') . '</button>
<button type="submit" class="uk-button uk-button-success">' . JText::_('NERUDAS_SHOW') . '</button>
</div>
</div>
</form>';
echo $html;
echo '<div id="filter" class="uk-offcanvas"><div class="uk-offcanvas-bar uk-offcanvas-bar-flip uk-padding">' . $html . '</div></div>';
?>


	

	
	
	
