<?php
/**
 * @package    Nerudas Template
 * @version    4.9.5
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2017 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;
?>

<div id="anchor-system" class="uk-anchor">
</div>
<div id="k2FormSystem"
	 class="uk-margin-bottom uk-form uk-form-horizontal uk-panel uk-panel-box <?php echo $this->systemFields->css; ?>">
	<h3>
		<?php echo JText::_('NERUDAS_SYSTEM_FIELDS'); ?>
	</h3>
	<div class="uk-form-row">
		<label class="uk-form-label">
			<?php echo JText::_('K2_ALIAS'); ?>
		</label>
		<div class="uk-form-controls">

			<input type="text" id="alias" name="alias" maxlength="250" class="uk-width-1-1"
				   value="<?php echo $this->row->alias; ?>"/>

		</div>
	</div>

	<div class="uk-form-row">
		<label class="uk-form-label">
			<?php echo JText::_('K2_PUBLISHED'); ?>
		</label>
		<div class="uk-form-controls">
			<div class="uk-button-group" data-uk-button-radio>
				<?php echo $this->lists['published']; ?>
			</div>
		</div>
	</div>
	<div class="uk-form-row">
		<label class="uk-form-label">
			<?php echo JText::_('K2_FEATURED'); ?>
		</label>
		<div class="uk-form-controls">
			<div class="uk-button-group" data-uk-button-radio>
				<?php echo $this->lists['featured']; ?>
			</div>
		</div>
	</div>
	<?php if (isset($this->K2PluginsItemOther['kunenadiscuss'])) : ?>
		<div class="uk-form-row">
			<label class="uk-form-label">
				<?php echo JText::_('NERUDAS_K2_TOPIC_ID'); ?>
			</label>
			<div class="uk-form-controls">
				<?php echo $this->K2PluginsItemOther['kunenadiscuss']->fields; ?>
			</div>
		</div>
	<?php endif; ?>
	<div class="uk-form-row">
		<label class="uk-form-label">
			<?php echo JText::_('K2_CREATION_DATE'); ?>
		</label>
		<div class="uk-form-controls">
			<?php echo $this->lists['createdCalendar']; ?>
		</div>
	</div>
	<div class="uk-form-row">
		<label class="uk-form-label">
			<?php echo JText::_('K2_START_PUBLISHING'); ?>
		</label>
		<div class="uk-form-controls">
			<?php echo $this->lists['publish_up']; ?>
		</div>
	</div>
	<div class="uk-form-row">
		<label class="uk-form-label">
			<?php echo JText::_('K2_FINISH_PUBLISHING'); ?>
		</label>
		<div class="uk-form-controls">
			<?php echo $this->lists['publish_down']; ?>
		</div>
	</div>
	<div class="uk-form-row">
		<label class="uk-form-label">
			<?php echo JText::_('NERUDAS_AUTHOR'); ?>
		</label>
		<div class="uk-form-controls uk-form-controls-text">
			<span data-change-author-new-name class="uk-text-muted">
			<?php echo $this->row->author; ?>
			</span>
			<?php if ($this->mainframe->isAdmin() || ($this->mainframe->isSite() && $this->permissions->get('editAll'))): ?>
				<a class="modal" rel="{handler:'iframe', size: {x: 1000, y: 520}}"
				   href="index.php?option=com_k2&amp;view=users&amp;task=element&amp;tmpl=component">
					<?php echo JText::_('NERUDAS_AUTHOR_CHANGE'); ?>
				</a>
				<input type="hidden" name="created_by" value="<?php echo $this->row->created_by; ?>"/>
			<?php else: ?>
				<input type="hidden" readonly name="created_by" value="<?php echo $this->row->created_by; ?>"/>
			<?php endif; ?>
		</div>

	</div>
	<div class="uk-form-row">
		<label class="uk-form-label">
			<?php echo JText::_('K2_ACCESS_LEVEL'); ?>
		</label>
		<div class="uk-form-controls">
			<?php echo $this->lists['access']; ?>
		</div>
	</div>
	<div id="k2FrontendContainer" class="uk-hidden">
		<div id="k2Frontend">
			<?php echo $this->lists['language']; ?>

			<input type="hidden" name="created_by_alias" maxlength="250" value=""/>
			<input type="hidden" name="isSite" value="<?php echo (int) $this->mainframe->isSite(); ?>"/>
			<?php if ($this->mainframe->isSite()): ?>
				<input type="hidden" name="lang" value="<?php echo JRequest::getCmd('lang'); ?>"/>
			<?php endif; ?>
			<input type="hidden" name="id" value="<?php echo $this->row->id; ?>"/>
			<input type="hidden" name="option" value="com_k2"/>
			<input type="hidden" name="view" value="item"/>
			<input type="hidden" name="task" value="<?php echo JRequest::getVar('task'); ?>"/>
			<input type="hidden" name="Itemid" value="<?php echo JRequest::getInt('Itemid'); ?>"/>
			<?php echo JHTML::_('form.token'); ?>
		</div>
	</div>
</div>
