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
				<?php echo JText::_('NERUDAS_COMPANY_TEXT'); ?>
			</a>
		</li>
	<?php endif; ?>
	<li class="staff" data-hash="staff">
		<a href="">
			<?php echo JText::_('NERUDAS_STAFF'); ?>
		</a>
	</li>
	<li class="comments" data-hash="comments">
		<a href="">
			<?php echo JText::_('NERUDAS_REVIEWS'); ?>
		</a>
	</li>
	<? /*
	<li class="news" data-hash="news">
		<a href="">
			<?php echo JText::_('NERUDAS_NEWS'); ?>
		</a>
	</li>
	*/ ?>
</ul>

