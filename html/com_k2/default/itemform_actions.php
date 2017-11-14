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
?>

<div id="k2FormActions" class="uk-margin-bottom uk-form uk-form-horizontal uk-panel">
	<div class="uk-text-right">
		<a href="javascript:history.go(-1)" class="uk-button uk-button-danger">
			<?php echo JText::_('NERUDAS_CANCEL'); ?>
		</a>
		<a class="uk-button uk-button-success" onclick="Joomla.submitbutton('save'); return false;" title="<?php echo JText::_('NERUDAS_SAVE'); ?>">
			<?php echo JText::_('NERUDAS_SAVE'); ?>
		</a>
	</div>
	<div class="uk-actions-fixed uk-text-small uk-clearfix uk-active" data-uk-scrollspy-nav="{closest:'a', smoothscroll:true}">
		<?php if(isset($this->navs) && is_array($this->navs)):?>
		<?php foreach ($this->navs as $anchor => $title): ?>
		<a href="#anchor-<?php echo $anchor;?>" class="uk-button" data-uk-smooth-scroll data-uk-tooltip title="<?php echo $title;?>">
			<i class="uk-icon-anchor-<?php echo $anchor;?>"></i>
		</a>
		<?php endforeach; ?>
		<?php endif; ?>
		<a href="#anchor-system" class="uk-button <?php echo $this->systemFields->css; ?>" data-uk-smooth-scroll data-uk-tooltip title="<?php echo JText::_('NERUDAS_SYSTEM_FIELDS');?>">
			<i class="uk-icon-cog"></i>
		</a>
		<a href="#anchor-top" class="uk-button" data-uk-smooth-scroll data-uk-tooltip title="<?php echo JText::_('NERUDAS_TO_TOP'); ?>">
			<i class="uk-icon-arrow-up"></i>
		</a>
		<a href="javascript:history.go(-1)" class="uk-button uk-button-danger" data-uk-tooltip title="<?php echo JText::_('NERUDAS_CANCEL'); ?>">
			<i class="uk-icon-close"></i>
		</a>
		<a class="uk-button uk-button-success" onclick="Joomla.submitbutton('save'); return false;" data-uk-tooltip title="<?php echo JText::_('NERUDAS_SAVE'); ?>">
			<i class="uk-icon-check"></i>
		</a>
	</div>
</div>
