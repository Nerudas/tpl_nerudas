<?php
/**
 * @package     JoomlaZen Nerudas Template
 * @version     4.3
 * @author      JoomlaZen - www.joomlazen.com
 * @copyright   Copyright (c) 2016 - 2016 JoomlaZen. All rights reserved.
 * @license     GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */
defined('_JEXEC') or die('Restricted access');
$app = JFactory::getApplication();
$doc = JFactory::getDocument();
$type = 'company';
require_once(realpath(__DIR__.'/..').'/default/itemform_head.php');
$doc->addScript('/templates/'.$app->getTemplate().'/scripts/phones_add.js');
if (empty($this->row->image)) {
	$this->row->thumb = '/templates/'.$app->getTemplate().'/images/noimages/1.jpg'; 
}
if ($isNew) {
	$this->row->title = '';
}

$froala->buttons = array();
$froala->buttons[] = 'bold';
$froala->buttons[] = 'italic';
$froala->buttons[] = 'underline';
if ($permissions->moderator) {
	$froala->buttons[] = '|';
	$froala->buttons[] = 'html';
}
$froala->buttons = json_encode($froala->buttons);
// Check copmany
if (!$permissions->moderator && empty($this->row->id)) {
	$data = new stdClass();
	$data->categories = array(3);
	$data->user = JFactory::getUser()->id;
	$data->order = 'publish_up DESC';
	$data->limit = 1;
	$companies = NerudasK2Helper::getItems($data);
	if (isset($companies[0])) {
		$app->redirect('/company/'.$companies[0]->id.'.html');
	}
}
$this->item = $this->row;
$this->navs = array();
$this->navs['contacts'] = JText::_('NERUDAS_CONTACTS');
$this->navs['about'] = JText::_('NERUDAS_COMPANY_TEXT');
$this->navs['scope'] = $this->extra['company_scope']->name;
$this->navs['map'] = JText::_('NERUDAS_ON_MAP');
if ($permissions->moderator) {
	$this->navs['staff'] = JText::_('NERUDAS_STAFF');
}
?>
<script>
(function($){
	$(document).ready(function() {
		$('#introtext').froalaEditor({
			key: '<?php echo $froala->key; ?>',
			toolbarButtons: <?php echo $froala->buttons; ?>,
			toolbarButtonsMD: <?php echo $froala->buttons; ?>,
			toolbarButtonsSM: <?php echo $froala->buttons; ?>,
			toolbarButtonsXS: <?php echo $froala->buttons; ?>,
			heightMin: 240,
			heightMax: 480,
			placeholderText: '<?php echo JText::_('NERUDAS_COMPANY_TEXT'); ?>'	
		})
	});
})(jQuery);
</script>

<div id="company" class="itemform">
	<form action="<?php echo JURI::root(true); ?>/index.php" enctype="multipart/form-data" method="post" id="adminForm" name="adminForm">
		<div id="anchor-top" class="uk-anchor">
		</div>
		<div id="k2FormTop" class="uk-form uk-form-horizontal uk-panel uk-panel-box uk-margin-bottom">
			<h1 data-change-category-new-title class="uk-h3 uk-margin-top-remove">
				<?php echo $this->title; ?>
			</h1>
			<div class="uk-text-right uk-margin-bottom">
				<a href="javascript:history.go(-1)" class="uk-button uk-button-danger">
					<?php echo JText::_('NERUDAS_CANCEL'); ?>
				</a>
				<a class="uk-button uk-button-success" onclick="Joomla.submitbutton('save'); return false;" title="<?php echo JText::_('NERUDAS_SAVE'); ?>">
					<?php echo JText::_('NERUDAS_SAVE'); ?>
				</a>
			</div>
			<div class="uk-form-row">
				<label class="uk-form-label">
					<?php echo JText::_('NERUDAS_TITLE'); ?>
				</label>
				<div class="uk-form-controls">
					<input type="text" id="mtitle" name="title" maxlength="250" placeholder="<?php echo JText::_('NERUDAS_TITLE'); ?>" value="<?php echo $this->row->title; ?>"  class=" uk-width-1-1" />
				</div>
			</div>
			<div class="uk-form-row">
				<label class="uk-form-label">
					<?php echo $this->extra['inn']->name; ?>
				</label>
				<div class="uk-form-controls">
					<?php echo $this->extra['inn']->element; ?>
				</div>
			</div>
			<div class="uk-form-row">
				<label class="uk-form-label">
					<?php echo $this->extra['director']->name; ?>
				</label>
				<div class="uk-form-controls">
					<?php echo $this->extra['director']->element; ?>
				</div>
			</div>
			<div class="uk-form-row">
				<label class="uk-form-label">
					<?php echo JText::_('NERUDAS_IMAGE'); ?>
				</label>
				<div class="uk-form-controls">
					<img id="k2thumb" class="uk-thumbnail" alt="<?php echo $this->row->title; ?>" src="<?php echo $this->row->thumb; ?>" />
				</div>
			</div>
			<div class="uk-form-row">
				<label class="uk-form-label">
					<?php echo JText::_('NERUDAS_IMAGE_UPLOAD'); ?>
				</label>
				<div class="uk-form-controls">
					<div class="uk-form-file">
						<button class="uk-button uk-button-primary">
							<?php echo JText::_('NERUDAS_SELECT_FILE'); ?>
						</button>
						<span class="uk-form-file-text">
						<?php echo JText::_('NERUDAS_SELECT_FILE_NONE'); ?>
						</span>
						<input type="file" name="image" class="uk-form-file-input" />
					</div>
				</div>
			</div>
		</div>
		<div id="anchor-contacts" class="uk-anchor">
		</div>
		<div id="k2FormContacts" class="uk-form uk-form-horizontal uk-panel uk-panel-box uk-margin-bottom">
			<h3>
				<?php echo JText::_('NERUDAS_CONTACTS'); ?>
			</h3>
			<div class="uk-form-row">
				<label class="uk-form-label">
					<?php echo JText::_('NERUDAS_PHONE'); ?>
				</label>
				<div class="uk-form-controls" data-phones>
					<div class="uk-form-controls-condensed uk-hidden" data-phone>
						<div class="uk-grid uk-grid-small">
							<div class="uk-form-icon uk-width-1-1 uk-width-small-1-2 uk-width-medium-1-2 uk-margin-small-bottom" data-phone-number>
								<i class="uk-icon-phone"></i>
								<?php echo $this->extra['phone_a']->element; ?>
							</div>
							<div class="uk-form-icon uk-width-1-1 uk-width-small-1-2 uk-width-medium-1-2 uk-margin-small-bottom" data-phone-contact>
								<i class="uk-icon-user"></i>
								<?php echo $this->extra['contact_a']->element; ?>
							</div>
						</div>
					</div>
					<div class="uk-form-controls-condensed uk-hidden" data-phone>
						<div class="uk-grid uk-grid-small">
							<div class="uk-form-icon uk-width-1-1 uk-width-small-1-2 uk-width-medium-1-2 uk-margin-small-bottom" data-phone-number>
								<i class="uk-icon-phone"></i>
								<?php echo $this->extra['phone_b']->element; ?>
							</div>
							<div class="uk-form-icon uk-width-1-1 uk-width-small-1-2 uk-width-medium-1-2 uk-margin-small-bottom" data-phone-contact>
								<i class="uk-icon-user"></i>
								<?php echo $this->extra['contact_b']->element; ?>
							</div>
						</div>
					</div>
					<div class="uk-form-controls-condensed uk-hidden" data-phone>
						<div class="uk-grid uk-grid-small">
							<div class="uk-form-icon uk-width-1-1 uk-width-small-1-2 uk-width-medium-1-2 uk-margin-small-bottom" data-phone-number>
								<i class="uk-icon-phone"></i>
								<?php echo $this->extra['phone_c']->element; ?>
							</div>
							<div class="uk-form-icon uk-width-1-1 uk-width-small-1-2 uk-width-medium-1-2 uk-margin-small-bottom" data-phone-contact>
								<i class="uk-icon-user"></i>
								<?php echo $this->extra['contact_c']->element; ?>
							</div>
						</div>
					</div>
					<div class="uk-form-controls-condensed uk-hidden" data-phone>
						<div class="uk-grid uk-grid-small">
							<div class="uk-form-icon uk-width-1-1 uk-width-small-1-2 uk-width-medium-1-2 uk-margin-small-bottom" data-phone-number>
								<i class="uk-icon-phone"></i>
								<?php echo $this->extra['phone_d']->element; ?>
							</div>
							<div class="uk-form-icon uk-width-1-1 uk-width-small-1-2 uk-width-medium-1-2 uk-margin-small-bottom" data-phone-contact>
								<i class="uk-icon-user"></i>
								<?php echo $this->extra['contact_d']->element; ?>
							</div>
						</div>
					</div>
					<div class="uk-form-controls-condensed uk-hidden" data-phone>
						<div class="uk-grid uk-grid-small">
							<div class="uk-form-icon uk-width-1-1 uk-width-small-1-2 uk-width-medium-1-2 uk-margin-small-bottom" data-phone-number>
								<i class="uk-icon-phone"></i>
								<?php echo $this->extra['phone_e']->element; ?>
							</div>
							<div class="uk-form-icon uk-width-1-1 uk-width-small-1-2 uk-width-medium-1-2 uk-margin-small-bottom" data-phone-contact>
								<i class="uk-icon-user"></i>
								<?php echo $this->extra['contact_e']->element; ?>
							</div>
						</div>
					</div>
					<div class="uk-form-controls-condensed" data-phone-add>
						<a class="uk-button">
							<i class="uk-icon-plus"></i>
							<?php echo JText::_('NERUDAS_ADD_PHONE'); ?>
						</a>
					</div>
				</div>
			</div>
			<div class="uk-form-row">
				<label class="uk-form-label">
					<?php echo $this->extra['address']->name; ?>
				</label>
				<div class="uk-form-controls">
					<?php echo $this->extra['address']->element; ?>
				</div>
			</div>
			<div class="uk-form-row">
				<label class="uk-form-label">
					<?php echo JText::_('NERUDAS_SELECT_REGION'); ?>
				</label>
				<div class="uk-form-controls">
					<?php echo $this->K2PluginsItemOther['region']->fields; ?>
				</div>
			</div>
			<div class="uk-form-row">
				<label class="uk-form-label">
					<?php echo $this->extra['email']->name; ?>
				</label>
				<div class="uk-form-controls">
					<?php echo $this->extra['email']->element; ?>
				</div>
			</div>
			<div class="uk-form-row">
				<label class="uk-form-label">
					<?php echo $this->extra['site']->name; ?>
				</label>
				<div class="uk-form-controls">
					<?php echo $this->extra['site']->element; ?>
				</div>
			</div>
			<div class="uk-form-row">
				<label class="uk-form-label">
					<?php echo $this->extra['vk']->name; ?>
				</label>
				<div class="uk-form-controls">
					<?php echo $this->extra['vk']->element; ?>
				</div>
			</div>
			<div class="uk-form-row">
				<label class="uk-form-label">
					<?php echo $this->extra['fb']->name; ?>
				</label>
				<div class="uk-form-controls">
					<?php echo $this->extra['fb']->element; ?>
				</div>
			</div>
			<div class="uk-form-row">
				<label class="uk-form-label">
					<?php echo $this->extra['ok']->name; ?>
				</label>
				<div class="uk-form-controls">
					<?php echo $this->extra['ok']->element; ?>
				</div>
			</div>
		</div>
		<div id="anchor-about" class="uk-anchor">
		</div>
		<div id="k2FormAbout" class="uk-form uk-form-horizontal uk-panel uk-panel-box uk-margin-bottom">
			<h3>
				<?php echo JText::_('NERUDAS_COMPANY_TEXT'); ?>
			</h3>
			<?php echo $this->introtext ; ?>
		</div>
		<div id="anchor-scope" class="uk-anchor">
		</div>
		<div id="k2FormScope" class="uk-form uk-form-horizontal uk-panel uk-panel-box uk-margin-bottom">
			<h3>
				<?php echo $this->extra['company_scope']->name; ?>
			</h3>
			<table class="uk-table uk-table-hover uk-margin-top-remove">
				<tbody>
					<tr>
						<th scope="row" class="uk-text-center" rowspan="9">
							<?php echo JText::_('NERUDAS_NERUDKA'); ?>
						</th>
						<td>
							<?php echo $this->extra['company_scope']->element[2]->label; ?>
						</td>
						<td width="1%">
							<?php echo $this->extra['company_scope']->element[2]->checkbox; ?>
						</td>
					</tr>
					<tr>
						<td>
							<?php echo $this->extra['company_scope']->element[3]->label; ?>
						</td>
						<td width="1%">
							<?php echo $this->extra['company_scope']->element[3]->checkbox; ?>
						</td>
					</tr>
					<tr>
						<td>
							<?php echo $this->extra['company_scope']->element[4]->label; ?>
						</td>
						<td width="1%">
							<?php echo $this->extra['company_scope']->element[4]->checkbox; ?>
						</td>
					</tr>
					<tr>
						<td>
							<?php echo $this->extra['company_scope']->element[5]->label; ?>
						</td>
						<td width="1%">
							<?php echo $this->extra['company_scope']->element[5]->checkbox; ?>
						</td>
					</tr>
					<tr>
						<td>
							<?php echo $this->extra['company_scope']->element[6]->label; ?>
						</td>
						<td width="1%">
							<?php echo $this->extra['company_scope']->element[6]->checkbox; ?>
						</td>
					</tr>
					<tr>
						<td>
							<?php echo $this->extra['company_scope']->element[7]->label; ?>
						</td>
						<td width="1%">
							<?php echo $this->extra['company_scope']->element[7]->checkbox; ?>
						</td>
					</tr>
					<tr>
						<td>
							<?php echo $this->extra['company_scope']->element[8]->label; ?>
						</td>
						<td width="1%">
							<?php echo $this->extra['company_scope']->element[8]->checkbox; ?>
						</td>
					</tr>
					<tr>
						<td>
							<?php echo $this->extra['company_scope']->element[9]->label; ?>
						</td>
						<td width="1%">
							<?php echo $this->extra['company_scope']->element[9]->checkbox; ?>
						</td>
					</tr>
					<tr>
						<td>
							<?php echo $this->extra['company_scope']->element[10]->label; ?>
						</td>
						<td width="1%">
							<?php echo $this->extra['company_scope']->element[10]->checkbox; ?>
						</td>
					</tr>
					<tr>
						<th scope="row"  class="uk-text-center" rowspan="7">
							<?php echo JText::_('NERUDAS_USLIGI_TECH'); ?>
						</th>
						<td>
							<?php echo $this->extra['company_scope']->element[11]->label; ?>
						</td>
						<td width="1%">
							<?php echo $this->extra['company_scope']->element[11]->checkbox; ?>
						</td>
					</tr>
					<tr>
						<td>
							<?php echo $this->extra['company_scope']->element[12]->label; ?>
						</td>
						<td width="1%">
							<?php echo $this->extra['company_scope']->element[12]->checkbox; ?>
						</td>
					</tr>
					<tr>
						<td>
							<?php echo $this->extra['company_scope']->element[13]->label; ?>
						</td>
						<td width="1%">
							<?php echo $this->extra['company_scope']->element[13]->checkbox; ?>
						</td>
					</tr>
					<tr>
						<td>
							<?php echo $this->extra['company_scope']->element[14]->label; ?>
						</td>
						<td width="1%">
							<?php echo $this->extra['company_scope']->element[14]->checkbox; ?>
						</td>
					</tr>
					<tr>
						<td>
							<?php echo $this->extra['company_scope']->element[15]->label; ?>
						</td>
						<td width="1%">
							<?php echo $this->extra['company_scope']->element[15]->checkbox; ?>
						</td>
					</tr>
					<tr>
						<td>
							<?php echo $this->extra['company_scope']->element[16]->label; ?>
						</td>
						<td width="1%">
							<?php echo $this->extra['company_scope']->element[16]->checkbox; ?>
						</td>
					</tr>
					<tr>
						<td>
							<?php echo $this->extra['company_scope']->element[17]->label; ?>
						</td>
						<td width="1%">
							<?php echo $this->extra['company_scope']->element[17]->checkbox; ?>
						</td>
					</tr>
					<tr>
						<th scope="row"  class="uk-text-center" rowspan="4">
							<?php echo JText::_('NERUDAS_PROISVOD_TECH'); ?>
						</th>
						<td>
							<?php echo $this->extra['company_scope']->element[18]->label; ?>
						</td>
						<td width="1%">
							<?php echo $this->extra['company_scope']->element[18]->checkbox; ?>
						</td>
					</tr>
					<tr>
						<td>
							<?php echo $this->extra['company_scope']->element[19]->label; ?>
						</td>
						<td width="1%">
							<?php echo $this->extra['company_scope']->element[19]->checkbox; ?>
						</td>
					</tr>
					<tr>
						<td>
							<?php echo $this->extra['company_scope']->element[20]->label; ?>
						</td>
						<td width="1%">
							<?php echo $this->extra['company_scope']->element[20]->checkbox; ?>
						</td>
					</tr>
					<tr>
						<td>
							<?php echo $this->extra['company_scope']->element[21]->label; ?>
						</td>
						<td width="1%">
							<?php echo $this->extra['company_scope']->element[21]->checkbox; ?>
						</td>
					</tr>
					<tr>
						<th scope="row"  class="uk-text-center" rowspan="8">
							<?php echo JText::_('NERUDAS_TECH'); ?>
						</th>
						<td>
							<?php echo $this->extra['company_scope']->element[22]->label; ?>
						</td>
						<td width="1%">
							<?php echo $this->extra['company_scope']->element[22]->checkbox; ?>
						</td>
					</tr>
					<tr>
						<td>
							<?php echo $this->extra['company_scope']->element[23]->label; ?>
						</td>
						<td width="1%">
							<?php echo $this->extra['company_scope']->element[23]->checkbox; ?>
						</td>
					</tr>
					<tr>
						<td>
							<?php echo $this->extra['company_scope']->element[24]->label; ?>
						</td>
						<td width="1%">
							<?php echo $this->extra['company_scope']->element[24]->checkbox; ?>
						</td>
					</tr>
					<tr>
						<td>
							<?php echo $this->extra['company_scope']->element[25]->label; ?>
						</td>
						<td width="1%">
							<?php echo $this->extra['company_scope']->element[25]->checkbox; ?>
						</td>
					</tr>
					<tr>
						<td>
							<?php echo $this->extra['company_scope']->element[26]->label; ?>
						</td>
						<td width="1%">
							<?php echo $this->extra['company_scope']->element[26]->checkbox; ?>
						</td>
					</tr>
					<tr>
						<td>
							<?php echo $this->extra['company_scope']->element[27]->label; ?>
						</td>
						<td width="1%">
							<?php echo $this->extra['company_scope']->element[27]->checkbox; ?>
						</td>
					</tr>
					<tr>
						<td>
							<?php echo $this->extra['company_scope']->element[28]->label; ?>
						</td>
						<td width="1%">
							<?php echo $this->extra['company_scope']->element[28]->checkbox; ?>
						</td>
					</tr>
					<tr>
						<td>
							<?php echo $this->extra['company_scope']->element[29]->label; ?>
						</td>
						<td width="1%">
							<?php echo $this->extra['company_scope']->element[29]->checkbox; ?>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<?php if ($this->K2PluginsItemOther['relateditems']->fields['staff']): ?>
		<div id="anchor-staff" class="uk-anchor">
		</div>
		<div id="k2FormStaff" class="uk-form uk-form-horizontal uk-panel uk-panel-box uk-margin-bottom <?php echo $systemFields->css; ?>">
			<h3>
				<?php echo JText::_('NERUDAS_STAFF'); ?>
			</h3>
			<div>
				<?php echo $this->K2PluginsItemOther['relateditems']->fields['staff']; ?>
			</div>
		</div>
		<?php endif; ?>
		<?php echo $this->loadTemplate('map'); ?>
		<?php echo $this->loadTemplate('system'); ?>
		<?php echo $this->loadTemplate('actions'); ?>
		<input name="catid" type="hidden" value="<?php echo $category->id; ?>" />
	</form>
</div>