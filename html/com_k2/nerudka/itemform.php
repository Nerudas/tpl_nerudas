<?php
/**
 * @package    Nerudas Template
 * @version    4.9.3
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2017 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;
$app  = JFactory::getApplication();
$doc  = JFactory::getDocument();
$type = 'nerudka';
require_once(realpath(__DIR__ . '/..') . '/default/itemform_head.php');

if (empty($this->row->image))
{
	$this->row->thumb = '/templates/' . $app->getTemplate() . '/images/noimages/1.jpg';
}
if ($isNew)
{
	$this->row->title = '';
}

$froala->buttons = array();
if ($permissions->moderator)
{
	$froala->buttons[] = '|';
	$froala->buttons[] = 'html';
}
$froala->buttons        = json_encode($froala->buttons);
$this->item             = $this->row;
$this->navs             = array();
$this->navs['contacts'] = JText::_('NERUDAS_CONTACTS');
$this->navs['about']    = JText::_('NERUDAS_NERUDAS_TEXT');
$this->navs['price']    = $this->extra['pricelist']->name;
if ($permissions->moderator)
{
	$this->navs['license'] = JText::_('NERUDAS_LICENSE');
}
$this->navs['map'] = JText::_('NERUDAS_ON_MAP');

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
					placeholderText: '<?php echo JText::_('NERUDAS_NERUDKA_TEXT'); ?>'
				});
				$('#K2ExtraField_50').froalaEditor({
					key: '<?php echo $froala->key; ?>',
					toolbarButtons: <?php echo $froala->buttons; ?>,
					toolbarButtonsMD: <?php echo $froala->buttons; ?>,
					toolbarButtonsSM: <?php echo $froala->buttons; ?>,
					toolbarButtonsXS: <?php echo $froala->buttons; ?>,
					heightMin: 240,
					heightMax: 480,
					placeholderText: '<?php echo $this->extra['pricelist']->name; ?>'
				});
			});
		})(jQuery);
	</script>

	<div id="company" class="itemform">
		<form action="<?php echo JURI::root(true); ?>/index.php" enctype="multipart/form-data" method="post"
			  id="adminForm" name="adminForm">
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
					<label class="uk-form-label">
						<?php echo JText::_('NERUDAS_CATEGORY'); ?>
					</label>
					<div id="category-change" class="uk-form-controls">
						<?php if ($isNew) : ?>
							<div class="uk-form-controls-condensed">
								<strong><?php echo $category->name; ?></strong>
								<a class="uk-button uk-margin-small-left" href="/nerudka/add">
									<?php echo JText::_('NERUDAS_CATEGORY_CHANGE'); ?>
								</a>
								<input name="catid" type="hidden" value="<?php echo $category->id; ?>"/>
							</div>
						<?php else: ?>
							<div class="toggle uk-form-controls-condensed">
								<strong><?php echo $category->name; ?></strong>
								<a class=" uk-button uk-margin-small-left"
								   data-uk-toggle="{target:'#category-change .toggle'}">
									<?php echo JText::_('NERUDAS_CATEGORY_CHANGE'); ?>
								</a>
							</div>
							<div class="toggle uk-form-controls-condensed uk-hidden">
								<?php echo $category->select; ?>
							</div>
						<?php endif; ?>
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
				<?php if ($this->K2PluginsItemOther['relateditems']->fields['company']): ?>
					<div class="uk-form-row">
						<label class="uk-form-label"><?php echo JText::_('NERUDAS_COMPANY'); ?></label>
						<div class="uk-form-controls">
							<?php echo $this->K2PluginsItemOther['relateditems']->fields['company']; ?>
						</div>
					</div>
				<?php endif; ?>

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
					<?php echo JText::_('NERUDAS_NERUDKA_TEXT'); ?>
				</h3>
				<?php echo $this->introtext; ?>
			</div>
			<div id="anchor-price" class="uk-anchor">
			</div>
			<div id="k2FormPrice" class="uk-form uk-form-horizontal uk-panel uk-panel-box uk-margin-bottom">
				<h3>
					<?php echo $this->extra['pricelist']->name; ?>
				</h3>
				<?php echo $this->extra['pricelist']->element; ?>
			</div>
			<div id="anchor-license" class="uk-anchor">
			</div>
			<?php if ($this->sigPro): ?>
				<div id="k2FormLicense"
					 class="uk-form uk-form-horizontal uk-panel uk-panel-box uk-margin-bottom  <?php echo $this->systemFields->css; ?>">
					<h3>
						<?php echo JText::_('NERUDAS_LICENSE'); ?>
					</h3>
					<div class="uk-form-row <?php echo $systemFields->css; ?>">
						<a class="modal uk-button uk-button-large" rel="{handler: 'iframe', size: {x: 940, y: 560}}"
						   href="index.php?option=com_sigpro&view=galleries&task=create&newFolder=<?php echo $this->sigProFolder; ?>&type=k2&tmpl=component&template=system">
							<?php echo JText::_('NERUDAS_LICENSE'); ?>
						</a>
						<input name="sigProFolder" type="hidden" value="<?php echo $this->sigProFolder; ?>"/>
					</div>
				</div>
			<?php endif; ?>


			<?php echo $this->loadTemplate('map'); ?>
			<?php echo $this->loadTemplate('system'); ?>
			<?php echo $this->loadTemplate('actions'); ?>
		</form>
	</div>
<?php
/*
defined('_JEXEC') or die;
$app = JFactory::getApplication();
$doc = JFactory::getDocument();
$type = 'nerudka';
include 'templates/'.$app->getTemplate().'/html/com_k2/form_head.php';
$doc->addScript('/templates/'.$app->getTemplate().'/scripts/phones_add.js');
/*
$froala->buttons = array();
$froala->buttons[] = 'bold';
$froala->buttons[] = 'italic';
$froala->buttons[] = 'underline';
if ($permissions->moderator) {
	$froala->buttons[] = '|';
	$froala->buttons[] = 'html';
}
$froala->buttons = json_encode($froala->buttons);

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
			placeholderText: '<?php echo JText::_('NERUDAS_NERUDKA_TEXT'); ?>'	
		});
		$('#K2ExtraField_50').froalaEditor({
			key: '<?php echo $froala->key; ?>',
			toolbarButtons: <?php echo $froala->buttons; ?>,
			toolbarButtonsMD: <?php echo $froala->buttons; ?>,
			toolbarButtonsSM: <?php echo $froala->buttons; ?>,
			toolbarButtonsXS: <?php echo $froala->buttons; ?>,
			heightMin: 240,
			heightMax: 480,
			placeholderText: '<?php echo $this->extra['pricelist']->name; ?>'	
		});
	});
})(jQuery);
</script>

<div id="nerudka" class="itemform">
	<form action="<?php echo JURI::root(true); ?>/index.php" enctype="multipart/form-data" method="post" id="adminForm" name="adminForm">
		<input type="file" name="image" class="uk-hidden" />
		<div class="uk-grid uk-grid-collapse">
			<aside class="tm-left sidebar uk-width-xsmall-1-1 uk-width-small-1-1 uk-width-medium-1-1 uk-width-large-1-4 uk-width-xlarge-1-5 uk-visible-large">
				<div id="appendLeftBottom">
				</div>
			</aside>
			<div class="uk-container uk-form uk-form-horizontal uk-width-xsmall-1-1 uk-width-small-1-1 uk-width-medium-1-1 uk-width-large-3-4 uk-width-xlarge-3-5">
				<header class="tm-title">
					<h2>
						<?php echo $this->title; ?>
					</h2>
				</header>
				<div class="uk-form-row">
					<label class="uk-form-label"><?php echo JText::_('NERUDAS_NERUDKA_TITLE'); ?></label>
					<div class="uk-form-controls">
						<input type="text" id="mtitle" name="title" maxlength="250" placeholder="<?php echo JText::_('NERUDAS_TITLE'); ?>" value="<?php echo $this->row->title; ?>"  class=" uk-width-1-1" />
					</div>
				</div>
				<div class="uk-form-row <?php echo $systemFields->css; ?>">
					<label class="uk-form-label"><?php echo JText::_('NERUDAS_SELECT_REGION'); ?></label>
					<div class="uk-form-controls">
						<?php echo $this->K2PluginsItemOther['region']->fields; ?>
					</div>
				</div>
				<div class="uk-form-row <?php echo $systemFields->css; ?>">
					<label class="uk-form-label"><?php echo JText::_('NERUDAS_CATEGORY'); ?></label>
					<div id="category-change" class="uk-form-controls">
						<?php if ($isNew) : ?>
						<div class="uk-form-controls-condensed">
							<strong><?php echo $category->name; ?></strong>
							<a class="uk-button uk-margin-small-left" href="/reestr/add" >
								<?php echo JText::_('NERUDAS_CATEGORY_CHANGE'); ?>
							</a>
							<input name="catid" type="hidden" value="<?php echo $category->id; ?>" />
						</div>
						<?php else: ?>
						<div class="toggle uk-form-controls-condensed">
							<strong><?php echo $category->name; ?></strong>
							<a class="uk-button uk-margin-small-left"  data-uk-toggle="{target:'#category-change .toggle'}">
								<?php echo JText::_('NERUDAS_CATEGORY_CHANGE'); ?>
							</a>
						</div>
						<div  class="toggle uk-form-controls-condensed uk-hidden" >
							<?php echo $category->select; ?>
						</div>
						<?php endif; ?>
					</div>
				</div>
				<?php if ($this->K2PluginsItemOther['relateditems']->fields['company']): ?>
				<div class="uk-form-row">
					<label class="uk-form-label"><?php echo JText::_('NERUDAS_COMPANY'); ?></label>
					<div class="uk-form-controls">
						<?php echo $this->K2PluginsItemOther['relateditems']->fields['company']; ?>
					</div>
				</div>
			 	<?php endif; ?>

				<hr class="uk-article-divider uk-width-1-1">
				<div class="uk-form-row">
					<label class="uk-form-label"><?php echo $this->extra['email']->name; ?></label>
					<div class="uk-form-controls">
						<?php echo $this->extra['email']->element; ?>
					</div>
				</div>
				<div class="uk-form-row">
					<label class="uk-form-label"><?php echo $this->extra['site']->name; ?></label>
					<div class="uk-form-controls">
						<?php echo $this->extra['site']->element; ?>
					</div>
				</div>	
				<div class="uk-form-row">
					<label class="uk-form-label"><?php echo JText::_('NERUDAS_PHONE'); ?></label>
					<a class="add-phone uk-hidden">
						<i class="uk-icon-plus"></i>
					</a>
					<div id="add-phones" class="uk-form-controls">
						<div class="uk-form-controls-condensed block">
							<div class="uk-form-icon phone">
								<i class="uk-icon-phone"></i>
								<span class="code">
									+7
								</span>
								<?php echo $this->extra['phone_a']->element; ?>
							</div>
							<?php echo $this->extra['contact_a']->element; ?>
						</div>
						<div class="uk-form-controls-condensed block">
							<div class="uk-form-icon phone">
								<i class="uk-icon-phone"></i>
								<span class="code">
									+7
								</span>
								<?php echo $this->extra['phone_b']->element; ?>
							</div>
							<?php echo $this->extra['contact_b']->element; ?>
						</div>
						<div class="uk-form-controls-condensed block">
							<div class="uk-form-icon phone">
								<i class="uk-icon-phone"></i>
								<span class="code">
									+7
								</span>
								<?php echo $this->extra['phone_c']->element; ?>
							</div>
							<?php echo $this->extra['contact_c']->element; ?>
						</div>
						<div class="uk-form-controls-condensed block">
							<div class="uk-form-icon phone">
								<i class="uk-icon-phone"></i>
								<span class="code">
									+7
								</span>
								<?php echo $this->extra['phone_d']->element; ?>
							</div>
							<?php echo $this->extra['contact_d']->element; ?>
						</div>
						<div class="uk-form-controls-condensed block">
							<div class="uk-form-icon phone">
								<i class="uk-icon-phone"></i>
								<span class="code">
									+7
								</span>
								<?php echo $this->extra['phone_e']->element; ?>
							</div>
							<?php echo $this->extra['contact_e']->element; ?>
						</div>
						<div class="uk-form-controls-condensed add uk-hidden">
							<a class="uk-button ">
								<i class="uk-icon-plus"></i>
								<?php echo JText::_('NERUDAS_ADD_PHONE'); ?>
							</a>
						</div>
					</div>
				</div>
				<hr class="uk-article-divider uk-width-1-1">
				<div class="uk-form-row">
					<?php echo $this->K2PluginsItemOther['ymap']->fields; ?>
				</div>
				<div class="uk-form-row <?php echo $systemFields->css; ?>">
					<label class="uk-form-label"><?php echo JText::_('NERUDAS_MAP_MARK_ICON'); ?></label>
					<div class="uk-form-controls">
						<?php echo $this->K2PluginsItemOther['markicon']->fields; ?>
					</div>
				</div>
				<div class="uk-form-row">
					<label class="uk-form-label">
						<?php echo JText::_('NERUDAS_NERUDKA_TEXT'); ?>
					</label>
					<div  class="uk-clearfix uk-margin-small-bottom">
					</div>
					<div>
						<?php echo $this->introtext ; ?>
					</div>
				</div>
				<hr class="uk-article-divider uk-width-1-1">
				<div class="uk-form-row">
					<label class="uk-form-label">
						<?php echo $this->extra['pricelist']->name; ?>
					</label>
					<div class="uk-clearfix uk-margin-small-bottom">
					</div>
					<div>
						<?php echo $this->extra['pricelist']->element; ?>
					</div>
				</div>
				<?php if($this->sigPro): ?>
				<div class="uk-form-row <?php echo $systemFields->css; ?>">
					<a class="modal uk-button uk-button-large" rel="{handler: 'iframe', size: {x: 940, y: 560}}" href="index.php?option=com_sigpro&view=galleries&task=create&newFolder=<?php echo $this->sigProFolder; ?>&type=k2&tmpl=component&template=system">
						<?php echo JText::_('NERUDAS_LICENSE');?>
					</a>
					<input name="sigProFolder" type="hidden" value="<?php echo $this->sigProFolder; ?>" />
				</div>
				<?php endif; ?>
				<hr class="uk-article-divider uk-width-1-1">
				<div id="appendBeforeSave">
				</div>
				<div class="uk-form-row uk-text-center uk-margin-large-bottom">
					<a href="javascript:history.go(-1)" class="uk-button uk-button-danger uk-button-large">
						<?php echo JText::_('NERUDAS_CANCEL'); ?>
					</a>
					<a class="uk-button uk-button-success uk-button-large" onclick="Joomla.submitbutton('save'); return false;" title="<?php echo JText::_('NERUDAS_SAVE'); ?>">
						<?php echo JText::_('NERUDAS_SAVE'); ?>
					</a>
				</div>
			</div>
			<aside class="tm-right sidebar uk-width-xsmall-1-1 uk-width-small-1-1 uk-width-medium-1-1 uk-width-large-1-1 uk-width-xlarge-1-5 uk-visible-xlarge">
				<p class="uk-margin-top">
					<a href="javascript:history.go(-1)" class="uk-button uk-button-danger">
						<?php echo JText::_('NERUDAS_CANCEL'); ?>
					</a>
					<a class="uk-button uk-button-success" onclick="Joomla.submitbutton('save'); return false;" title="<?php echo JText::_('NERUDAS_SAVE'); ?>">
						<?php echo JText::_('NERUDAS_SAVE'); ?>
					</a>
				</p>
				<div id="appendRightBottom">
				</div>
				<?php include 'templates/'.$app->getTemplate().'/html/com_k2/form_system.php'; ?>
			</aside>
		</div>
	</form>
</div>
*/
