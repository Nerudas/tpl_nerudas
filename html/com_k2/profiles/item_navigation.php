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
?>
<ul id="company-navigation" class="tabs-hash uk-tab"
	data-uk-switcher="{connect:'#company-tabs'}">
	<li class="contacts" data-hash="contacts">
		<a href="">
			<?php echo JText::_('NERUDAS_CONTACTS'); ?>
		</a>
	</li>
	<?php if ($this->item->introtext): ?>
		<li class="about" data-hash="about">
			<a href="">
				<?php echo JText::_('NERUDAS_PROFILES_TEXT'); ?>
			</a>
		</li>
	<?php endif; ?>
	<li class="comments" data-hash="comments">
		<a href="">
			<?php echo JText::_('NERUDAS_REVIEWS'); ?>
		</a>
	</li>
	<li class="ads" data-hash="ads">
		<a href="">
			<?php echo JText::_('NERUDAS_ADS'); ?>
		</a>
	</li>
</ul>

<? /*
<hr class="uk-visible-xsmall uk-margin-top uk-margin-small-bottom">
<ul id="profile-navigation" class="uk-nav tabs-hash uk-nav-side uk-grid uk-grid-collapse" data-uk-switcher="{connect:'#profile-tabs'}">
	<li class="contacts" data-hash="contacts">
		<a href="">
			<?php echo JText::_('NERUDAS_CONTACTS'); ?>
		</a>
	</li>
	<li class="job" data-hash="job">
		<a href="">
			<?php echo JText::_('NERUDAS_JOB'); ?>
		</a>
	</li>
	<?php if ($this->item->introtext): ?>
	<li class="about" data-hash="about">
		<a href="">
			<?php echo JText::_('NERUDAS_PROFILES_TEXT'); ?>
		</a>
	</li>
	<?php endif; ?>
	<li class="comments" data-hash="comments">
		<a href="">
			<?php echo JText::_('NERUDAS_REVIEWS'); ?> (<?php echo $this->count->comments; ?>)
		</a>
	</li>
	<li class="ads" data-hash="ads">
		<a href="">
			<?php echo JText::_('NERUDAS_ADS'); ?> (<?php echo $this->count->ads; ?>)
		</a>
	</li>
	<?php if ($this->author->me): ?>
	<li class="settings" data-hash="settings">
		<a href="" target="_blank">
			<?php echo JText::_('NERUDAS_SETTINGS'); ?>
		</a>
	</li>
	<?php endif; ?>
</ul>
<hr class="uk-visible-xsmall uk-margin-bottom uk-margin-small-top">
*/ ?>


