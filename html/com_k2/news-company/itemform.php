<?php
/**
 * @package    Nerudas Template
 * @version    4.9.1
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2017 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */
defined('_JEXEC') or die('Restricted access');
$app = JFactory::getApplication();
$doc = JFactory::getDocument();
$type = 'news-company';
include 'templates/'.$app->getTemplate().'/html/com_k2/form_head.php';
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
			placeholderText: '<?php echo JText::_('NERUDAS_PREVIEW'); ?>'	
		})
	});
})(jQuery);
</script>

<div id="news-company" class="itemform">
	<form action="<?php echo JURI::root(true); ?>/index.php" enctype="multipart/form-data" method="post" id="adminForm" name="adminForm">
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
					<label class="uk-form-label"><?php echo JText::_('NERUDAS_TITLE'); ?></label>
					<div class="uk-form-controls">
						<input type="text" id="mtitle" name="title" maxlength="250" placeholder="<?php echo JText::_('NERUDAS_TITLE'); ?>" value="<?php echo $this->row->title; ?>"  class=" uk-width-1-1" />
					</div>
				</div>
				<div class="uk-form-row <?php echo $systemFields->css; ?>">
					<label class="uk-form-label"><?php echo JText::_('NERUDAS_SELECT_REGION'); ?></label>
					<div class="uk-form-controls">
						<?php echo $this->K2PluginsItemOther['region']->fields; ?>
						<input name="catid" type="hidden" value="<?php echo $category->id; ?>" />
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
					<label class="uk-form-label"><?php echo JText::_('NERUDAS_NEWS_COMPANY_TEXT'); ?></label>
					<div class="uk-clearfix uk-margin-small-bottom"></div>
					<div>
						<?php echo $this->introtext ; ?>
					</div>
				</div>
				<div class="uk-form-row">
					<label class="uk-form-label"><?php echo JText::_('NERUDAS_IMAGE'); ?></label>
					<div class="uk-form-controls">
						<img id="k2thumb" class="uk-thumbnail" alt="<?php echo $this->row->title; ?>" src="<?php echo $this->row->thumb; ?>" />
					</div>
				</div>
				<div class="uk-form-row">
					<label class="uk-form-label"><?php echo JText::_('NERUDAS_IMAGE_UPLOAD'); ?></label>
					<div class="uk-form-controls">
						<div class="uk-form-file">
							<button class="uk-button uk-button-primary"><?php echo JText::_('NERUDAS_SELECT_FILE'); ?></button>
							<span class="uk-form-file-text">
								<?php echo JText::_('NERUDAS_SELECT_FILE_NONE'); ?>
							</span>
							<input type="file" name="image" class="uk-form-file-input" />
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
