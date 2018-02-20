<?php
/**
 * @package    Nerudas Template
 * @version    4.9.6
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;
?>

	<ul id="company-navigation" class="tabs-hash uk-tab"
		data-uk-switcher="{connect:'#company-tabs'}">
		<li class="contacts " data-hash="contacts">
			<a href="">
				<?php echo JText::_('NERUDAS_CONTACTS'); ?>
			</a>
		</li>
		<?php if (!empty($this->item->extra['pricelist']->value)): ?>
			<li class="pricelist" data-hash="pricelist">
				<a href="">
					<?php echo $this->item->extra['pricelist']->name; ?>
				</a>
			</li>
		<?php endif; ?>
		<?php if (!empty($this->item->gallery)): ?>
			<li class="license" data-hash="license">
				<a href="">
					<?php echo JText::_('NERUDAS_LICENSE'); ?>
				</a>
			</li>
		<?php endif; ?>
		<li class="comments" data-hash="comments">
			<a href="">
				<?php echo JText::_('NERUDAS_REVIEWS'); ?>
			</a>
		</li>
		<? /*
	<li class="news uk-width-xsmall-1-2" data-hash="news">
		<a href="">
			<?php echo JText::_('NERUDAS_NEWS'); ?>
		</a>
	</li>
	*/ ?>
	</ul>

<?php
/*
defined('_JEXEC') or die;
?>
<ul id="nerudka-navigation" class="uk-tab" data-uk-tab="{connect:'#nerudka-tabs'}">
	<li class="contacts" data-hash="contacts">
		<a href="">
			<?php echo JText::_('NERUDAS_CONTACTS'); ?>
		</a>
	</li>
	<?php if (!empty($this->item->extra['pricelist']->value)):?>
	<li class="pricelist" data-hash="pricelist">
		<a href="">
			<?php echo $this->item->extra['pricelist']->name; ?>
		</a>
	</li>
	<?php endif; ?>
	<?php if(!empty($this->item->gallery)): ?>
	<li class="license" data-hash="license">
		<a href="">
			<?php echo JText::_('NERUDAS_LICENSE');?>
		</a>
	</li>
	<?php endif; ?>
	<?php if($this->item->company): ?>
	<li class="company" data-hash="company">
		<a href="">
			<?php echo JText::_('NERUDAS_COMPANY');?>
		</a>
	</li>
	<?php endif; ?>
	<li class="comments" data-hash="comments">
		<a href="">
			<?php echo JText::_('NERUDAS_REVIEWS'); ?> (<?php echo $this->count->comments; ?>)
		</a>
	</li>
</ul>
*/ ?>