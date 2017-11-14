<?php
/**
 * @package    Nerudas Template
 * @version    4.9.1
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2017 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;
$app  = JFactory::getApplication();
$doc  = JFactory::getDocument();
$type = 'profiles';
if (empty($this->row->id))
{
	$app->redirect(JURI::current() . '?cid=' . NerudasProfilesHelper::getProfile(JFactory::getUser()->id)->id);
}
require_once(realpath(__DIR__ . '/..') . '/default/itemform_head.php');
$doc->addScript('/templates/' . $app->getTemplate() . '/scripts/phones_add.js');
if (empty($this->row->image))
{
	$this->row->thumb = '/templates/' . $app->getTemplate() . '/images/noimages/1.jpg';
}
if ($isNew)
{
	$this->row->title = '';
}

$froala->buttons   = array();
$froala->buttons[] = 'bold';
$froala->buttons[] = 'italic';
$froala->buttons[] = 'underline';
if ($permissions->moderator)
{
	$froala->buttons[] = '|';
	$froala->buttons[] = 'html';
}
$froala->buttons = json_encode($froala->buttons);

$this->item             = $this->row;
$this->navs             = array();
$this->navs['contacts'] = JText::_('NERUDAS_CONTACTS');
$this->navs['about']    = JText::_('NERUDAS_PROFILE_TEXT');
?>
<script>
	(function ($) {
		$(document).ready(function () {
			$('#introtext').froalaEditor({
				key: '<?php echo $froala->key; ?>',
				toolbarButtons: <?php echo $froala->buttons; ?>,
				toolbarButtonsMD: <?php echo $froala->buttons; ?>,
				toolbarButtonsSM: <?php echo $froala->buttons; ?>,
				toolbarButtonsXS: <?php echo $froala->buttons; ?>,
				heightMin: 240,
				heightMax: 480,
				placeholderText: '<?php echo JText::_('NERUDAS_PROFILE_TEXT'); ?>'
			})
		});
	})(jQuery);
</script>

<div id="company" class="itemform">
	<form action="<?php echo JURI::root(true); ?>/index.php" enctype="multipart/form-data" method="post" id="adminForm"
		  name="adminForm">
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
				<a class="uk-button uk-button-success" onclick="Joomla.submitbutton('save'); return false;"
				   title="<?php echo JText::_('NERUDAS_SAVE'); ?>">
					<?php echo JText::_('NERUDAS_SAVE'); ?>
				</a>
			</div>
			<div class="uk-form-row">
				<label class="uk-form-label">
					<?php echo JText::_('NERUDAS_TITLE'); ?>
				</label>
				<div class="uk-form-controls">
					<input type="text" id="mtitle" name="title" maxlength="250"
						   placeholder="<?php echo JText::_('NERUDAS_TITLE'); ?>"
						   value="<?php echo $this->row->title; ?>" class=" uk-width-1-1"/>
				</div>
			</div>
			<div class="uk-form-row">
				<label class="uk-form-label"><?php echo JText::_('NERUDAS_JOB'); ?></label>
				<div class="uk-form-controls">
					<?php echo $this->K2PluginsItemOther['job']->fields; ?>
				</div>
			</div>
			<div class="uk-form-row">
				<label class="uk-form-label"><?php echo $this->extra['job_post']->name; ?></label>
				<div class="uk-form-controls">
					<?php echo $this->extra['job_post']->element; ?>
				</div>
			</div>
			<div class="uk-form-row">
				<label class="uk-form-label">
					<?php echo JText::_('NERUDAS_IMAGE'); ?>
				</label>
				<div class="uk-form-controls">
					<img id="k2thumb" class="uk-thumbnail" alt="<?php echo $this->row->title; ?>"
						 src="<?php echo $this->row->thumb; ?>"/>
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
						<input type="file" name="image" class="uk-form-file-input"/>
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
							<div class="uk-form-icon uk-width-1-1 uk-width-small-1-2 uk-width-medium-1-2 uk-margin-small-bottom"
								 data-phone-number>
								<i class="uk-icon-phone"></i>
								<?php echo $this->extra['phone_a']->element; ?>
							</div>
							<div class="uk-form-icon uk-width-1-1 uk-width-small-1-2 uk-width-medium-1-2 uk-margin-small-bottom"
								 data-phone-contact>
								<i class="uk-icon-user"></i>
								<?php echo $this->extra['contact_a']->element; ?>
							</div>
						</div>
					</div>
					<div class="uk-form-controls-condensed uk-hidden" data-phone>
						<div class="uk-grid uk-grid-small">
							<div class="uk-form-icon uk-width-1-1 uk-width-small-1-2 uk-width-medium-1-2 uk-margin-small-bottom"
								 data-phone-number>
								<i class="uk-icon-phone"></i>
								<?php echo $this->extra['phone_b']->element; ?>
							</div>
							<div class="uk-form-icon uk-width-1-1 uk-width-small-1-2 uk-width-medium-1-2 uk-margin-small-bottom"
								 data-phone-contact>
								<i class="uk-icon-user"></i>
								<?php echo $this->extra['contact_b']->element; ?>
							</div>
						</div>
					</div>
					<div class="uk-form-controls-condensed uk-hidden" data-phone>
						<div class="uk-grid uk-grid-small">
							<div class="uk-form-icon uk-width-1-1 uk-width-small-1-2 uk-width-medium-1-2 uk-margin-small-bottom"
								 data-phone-number>
								<i class="uk-icon-phone"></i>
								<?php echo $this->extra['phone_c']->element; ?>
							</div>
							<div class="uk-form-icon uk-width-1-1 uk-width-small-1-2 uk-width-medium-1-2 uk-margin-small-bottom"
								 data-phone-contact>
								<i class="uk-icon-user"></i>
								<?php echo $this->extra['contact_c']->element; ?>
							</div>
						</div>
					</div>
					<div class="uk-form-controls-condensed uk-hidden" data-phone>
						<div class="uk-grid uk-grid-small">
							<div class="uk-form-icon uk-width-1-1 uk-width-small-1-2 uk-width-medium-1-2 uk-margin-small-bottom"
								 data-phone-number>
								<i class="uk-icon-phone"></i>
								<?php echo $this->extra['phone_d']->element; ?>
							</div>
							<div class="uk-form-icon uk-width-1-1 uk-width-small-1-2 uk-width-medium-1-2 uk-margin-small-bottom"
								 data-phone-contact>
								<i class="uk-icon-user"></i>
								<?php echo $this->extra['contact_d']->element; ?>
							</div>
						</div>
					</div>
					<div class="uk-form-controls-condensed uk-hidden" data-phone>
						<div class="uk-grid uk-grid-small">
							<div class="uk-form-icon uk-width-1-1 uk-width-small-1-2 uk-width-medium-1-2 uk-margin-small-bottom"
								 data-phone-number>
								<i class="uk-icon-phone"></i>
								<?php echo $this->extra['phone_e']->element; ?>
							</div>
							<div class="uk-form-icon uk-width-1-1 uk-width-small-1-2 uk-width-medium-1-2 uk-margin-small-bottom"
								 data-phone-contact>
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
			<div class="uk-form-row <?php echo $this->systemFields->css; ?>">
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
				<?php echo JText::_('NERUDAS_PROFILE_TEXT'); ?>
			</h3>
			<?php echo $this->introtext; ?>
		</div>

		<?php echo $this->loadTemplate('system'); ?>
		<?php echo $this->loadTemplate('actions'); ?>
		<input name="catid" type="hidden" value="<?php echo $category->id; ?>"/>
	</form>
</div>