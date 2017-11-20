<?php
/**
 * @package    Nerudas Template
 * @version    4.9.2
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2017 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;
$app  = JFactory::getApplication();
$doc  = JFactory::getDocument();
$type = 'news-rabotaem';
require_once(realpath(__DIR__ . '/..') . '/default/itemform_head.php');
$this->navs        = array();
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
				heightMin: 80,
				heightMax: 120,
				placeholderText: '<?php echo JText::_('NERUDAS_PREVIEW'); ?>'
			})
			var htmleditor = UIkit.htmleditor(fulltext);
		});
	})(jQuery);
</script>

<div id="news" class="itemform">
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
					<?php echo JText::_('NERUDAS_SELECT_REGION'); ?>
				</label>
				<div class="uk-form-controls">
					<?php echo $this->K2PluginsItemOther['region']->fields; ?>
				</div>
			</div>
			<div class="uk-form-row">
				<label class="uk-form-label"><?php echo $this->extra['city']->name; ?></label>
				<div class="uk-form-controls">
					<?php echo $this->extra['city']->element; ?>
				</div>
			</div>
			<div class="uk-form-row">
				<label class="uk-form-label">
					<?php echo JText::_('NERUDAS_PREVIEW'); ?>
				</label>
				<div class="uk-clearfix uk-margin-small-bottom">
				</div>
				<div>
					<?php echo $this->introtext; ?>
				</div>
			</div>
			<div class="uk-form-row">
				<label class="uk-form-label">
					<?php echo JText::_('NERUDAS_TEXT'); ?>
				</label>
				<div class="uk-clearfix uk-margin-small-bottom">
				</div>
				<div>
					<?php echo $this->fulltext; ?>
				</div>
			</div>
			<div class="uk-form-row">
				<label class="uk-form-label"><?php echo $this->extra['comments']->name; ?></label>
				<div class="uk-form-controls">
					<?php echo $this->extra['comments']->element; ?>
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
		<input name="catid" type="hidden" value="<?php echo $category->id; ?>"/>
		<?php echo $this->loadTemplate('map'); ?>
		<?php echo $this->loadTemplate('system'); ?>
		<?php echo $this->loadTemplate('actions'); ?>
	</form>
</div>