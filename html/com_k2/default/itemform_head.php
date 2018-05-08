<?php
/**
 * @package    Nerudas Template
 * @version    4.9.9
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;

$app     = JFactory::getApplication();
$doc     = JFactory::getDocument();
$modules = $doc->loadRenderer('modules');
// Action 
$isNew  = false;
$action = 'edit';
if (empty($this->row->id))
{
	$isNew         = true;
	$action        = 'add';
	$this->row->id = 0;
}
// Category
$category         = NerudasK2Helper::getCategory($this->row->catid);
$category->root   = $app->getMenu()->getActive()->params->get('category');
$category->select = NerudasK2Helper::getCategorySelect($this->row->catid, $category->root);
// Auto title
if ($type == 'ads' && $isNew)
{
	$this->row->title = $category->name;
}
// Title
if ($isNew)
{
	$this->title = JText::sprintf('NERUDAS_FORM_TITLE_' . mb_strtoupper(str_replace('-', '_', $type), 'UTF-8') . '_ADD', $category->name);
}
else
{
	$this->title = JText::sprintf('NERUDAS_FORM_TITLE_' . mb_strtoupper(str_replace('-', '_', $type), 'UTF-8') . '_EDIT', $this->row->title);
}
$doc->setTitle($this->title);
// User
$user        = JFactory::getUser();
$permissions = NerudasProfilesHelper::getPermissions($user);
if ($isNew)
{
	$this->row->created_by = $user->id;
	$author                = NerudasProfilesHelper::getProfile($user->id);

}
else
{
	$author = NerudasProfilesHelper::getProfile($this->row->created_by);
}
$this->author = $author;
// Default dields
foreach ($this->lists as $key => $list)
{
	$list              = str_replace('class="radio"', 'class="radio uk-button"', $list);
	$list              = str_replace('icon-calendar', 'uk-icon-calendar', $list);
	$list              = str_replace('btn', 'uk-button', $list);
	$this->lists[$key] = $list;
}
$this->extra  = NerudasK2Helper::getFormExtra($this->row->id, $this->extraFields);
$systemFields = new stdClass();
if ($permissions->moderator)
{
	$systemFields->css      = '';
	$systemFields->textType = 'text';
	$systemFields->readonly = 'readonly="false"';
}
else
{
	$systemFields->css      = 'uk-hidden readonly';
	$systemFields->textType = 'hidden';
	$systemFields->readonly = 'readonly="true"';
}
$this->systemFields = $systemFields;
if (empty($this->row->image))
{
	$this->row->thumb = '/templates/' . $app->getTemplate() . '/images/noimages/' . $category->id . '.jpg';
}
// Plugins 
foreach ($this->K2PluginsItemOther as $plugin)
{
	$this->K2PluginsItemOther[$plugin->get('name')] = $plugin;
}
// Media Fields
echo '<script>
(function($){
	$( document ).ready(function() {
		if($(".field-media-input").length > 0) {
			setAutoTextFieldWidth($(".field-media-input"));
			$(".field-media-input").change(function() {
				setAutoTextFieldWidth($(this));
			});
		}
	});
})(jQuery);
</script>';

$this->K2PluginsItemOther[2]->fields = NerudasUtility::setUIKitMediaField($this->K2PluginsItemOther[2]->fields);

/* Submit
========================================================================== */
$doc->addScriptDeclaration("
Joomla.submitbutton = function(pressbutton){
		if (\$K2.trim(\$K2('#mtitle').val()) == '') {
			UIkit.notify({message: '" . JText::_('K2_ITEM_MUST_HAVE_A_TITLE') . "',status: 'danger'});
			\$K2('#mtitle').addClass('uk-form-danger');
			return false;
		}
		else if (\$K2.trim(\$K2('#catid').val()) == '0') {
			alert('" . JText::_('K2_PLEASE_SELECT_A_CATEGORY', true) . "');
			UIkit.notify({message: '" . JText::_('K2_PLEASE_SELECT_A_CATEGORY') . "',status: 'danger'});
			return false;
		}
		else {
			var validation = validateExtraFields();
			if(validation === true) {
				\$K2('#selectedTags option').attr('selected', 'selected');
				submitform(pressbutton);
			}
		}
	}
");
?>