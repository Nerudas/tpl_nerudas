<?php
/**
 * @package    Nerudas Template
 * @version    4.9.4
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2017 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;
$app  = JFactory::getApplication();
$doc  = JFactory::getDocument();
$type = 'ads';
require_once(realpath(__DIR__ . '/..') . '/default/itemform_head.php');

if (empty($this->row->image))
{
	$this->row->thumb = '/templates/' . $app->getTemplate() . '/images/noimages/1.jpg';
}
$ds_tech             = array(15, 156, 16, 17, 18, 20, 19, 21, 23, 28, 25, 27, 24, 26, 22, 170);
$ds_nerud            = array(5, 30, 32, 33, 43, 44, 45, 162, 163, 46, 47, 48, 42, 316, 317, 318, 49, 50, 51, 52, 53, 54, 171);
$ds_prod             = array(270, 79, 272, 159, 277, 278, 279, 280, 281, 282, 283, 284, 285, 286, 287, 288, 289, 290);
$ds_usl              = array(332, 333, 131, 179, 178, 180, 182, 181, 331, 330, 107, 326, 334, 183, 324);
$this->navs          = array();
$this->navs['price'] = JText::_('NERUDAS_FORM_ADS_PRICE');
$this->navs['map']   = JText::_('NERUDAS_ON_MAP');
?>
<script>
	(function ($) {
		$(document).ready(function () {
			$('#adsitem-author').appendTo($('aside.tm-left'));
		});
		<?php if (empty($this->row->id) && isset($author->formphone) && !empty($author->formphone)) : ?>
		$(document).ready(function () {
			$("#K2ExtraField_5").val('<?php echo $author->formphone->sysnumber; ?>');
			$("#K2ExtraField_6").val('<?php echo $author->formphone->contact; ?>');

		});
		<?php endif; ?>
	})(jQuery);
</script>
<?php require_once(__DIR__ . '/item_author.php'); ?>

<div id="nerads" class="itemform">
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
				<label class="uk-form-label">
					<?php echo JText::_('NERUDAS_CATEGORY'); ?>
				</label>
				<div id="category-change" class="uk-form-controls">
					<?php if ($isNew) : ?>
						<div class="uk-form-controls-condensed">
							<strong><?php echo $category->name; ?></strong>
							<a class="uk-button uk-margin-small-left" href="/ads/add">
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
					<?php echo $this->extra['adswhen']->name; ?>
				</label>
				<div class="uk-form-controls uk-button-group" data-uk-button-radio>
					<?php echo $this->extra['adswhen']->element; ?>
				</div>
			</div>
			<?php if (in_array($category->id, $ds_tech)): ?>
				<div class="uk-form-row">
					<label class="uk-form-label">
						<?php echo $this->extra['ds_tech']->name; ?>
					</label>
					<div class="uk-form-controls uk-button-group" data-uk-button-radio>
						<?php echo $this->extra['ds_tech']->element; ?>
					</div>
				</div>
			<?php endif; ?>
			<?php if (in_array($category->id, $ds_nerud)): ?>
				<div class="uk-form-row">
					<label class="uk-form-label">
						<?php echo $this->extra['ds_nerud']->name; ?>
					</label>
					<div class="uk-form-controls uk-button-group" data-uk-button-radio>
						<?php echo $this->extra['ds_nerud']->element; ?>
					</div>
				</div>
			<?php endif; ?>
			<?php if (in_array($category->id, $ds_prod)): ?>
				<div class="uk-form-row">
					<label class="uk-form-label">
						<?php echo $this->extra['ds_prod']->name; ?>
					</label>
					<div class="uk-form-controls uk-button-group" data-uk-button-radio>
						<?php echo $this->extra['ds_prod']->element; ?>
					</div>
				</div>
			<?php endif; ?>
			<?php if (in_array($category->id, $ds_usl)): ?>
				<div class="uk-form-row">
					<label class="uk-form-label">
						<?php echo $this->extra['ds_usl']->name; ?>
					</label>
					<div class="uk-form-controls uk-button-group" data-uk-button-radio>
						<?php echo $this->extra['ds_usl']->element; ?>
					</div>
				</div>
			<?php endif; ?>
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
					<?php echo JText::_('NERUDAS_ADS_TEXT'); ?>
				</label>
				<div class="uk-clearfix uk-margin-small-bottom">
				</div>
				<div>
					<?php echo $this->introtext; ?>
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
		<div id="anchor-price" class="uk-anchor">
		</div>
		<div id="k2FormPrice" class="uk-form uk-form-horizontal uk-panel uk-panel-box uk-margin-bottom">
			<div class="uk-form-row">
				<label class="uk-form-label">
					<?php echo $this->extra['price']->name; ?>
				</label>
				<div class="uk-form-controls">
					<div class="uk-form-icon">
						<i class="uk-icon-rub"></i>
						<?php echo $this->extra['price']->element; ?>
					</div>
				</div>
			</div>
			<div class="uk-form-row">
				<label class="uk-form-label">
					<?php echo $this->extra['payment_method']->name; ?>
				</label>
				<div class="uk-form-controls uk-button-group" data-uk-button-radio>
					<?php echo $this->extra['payment_method']->element; ?>
				</div>
			</div>
			<div class="uk-form-row">
				<label class="uk-form-label">
					<?php echo $this->extra['prepayment']->name; ?>
				</label>
				<div class="uk-form-controls uk-button-group" data-uk-button-radio>
					<?php echo $this->extra['prepayment']->element; ?>
				</div>
			</div>
			<div class="uk-form-row">
				<label class="uk-form-label">
					<?php echo $this->extra['day_mode']->name; ?>
				</label>
				<div class="uk-form-controls uk-button-group" data-uk-button-radio>
					<?php echo $this->extra['day_mode']->element; ?>
				</div>
			</div>
		</div>
		<?php echo $this->loadTemplate('map'); ?>
		<?php echo $this->loadTemplate('system'); ?>
		<?php echo $this->loadTemplate('actions'); ?>
	</form>
</div>
