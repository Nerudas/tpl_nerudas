<?php
/**
 * @package    Nerudas Template
 * @version    4.9.18
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;
?>

<div class="uk-panel uk-panel-box uk-padding-top uk-padding-bottom uk-hidden">
	<h2 class="uk-text-large">
		<?php echo JText::_('NERUDAS_CONTACTS'); ?>
	</h2>
</div>
<hr class="uk-margin-remove uk-hidden">
<div class="uk-panel uk-panel-box">
	<div class="uk-grid uk-grid-small" data-uk-grid-match data-uk-grid-margin>
		<?php if (isset($this->item->extraFields->email) && !empty($this->item->extraFields->email->value)): ?>
			<div class="uk-width-1-1 uk-width-small-1-1 uk-width-medium-1-2">
				<a class="uk-link-muted uk-text-mlarge"
				   href="mailto:<?php echo $this->item->extraFields->email->value; ?>" target="_blank">
					<i class="uk-icon-envelope-o uk-margin-right"></i>
					<?php echo $this->item->extraFields->email->value; ?>
				</a>
			</div>
		<?php endif; ?>
		<?php if (!empty($this->item->phones)): ?>
			<?php foreach ($this->item->phones as $phone) : ?>
				<div class="uk-width-1-1 uk-width-small-1-1 uk-width-medium-1-2">
					<a class="uk-link-muted uk-text-mlarge" href="tel:+7<?php echo $phone->sysnumber; ?>">
						<i class="uk-icon-phone uk-margin-right"></i>
						<?php echo $phone->number; ?>
						<?php if (!empty($phone->contact)): ?>
							<span class="uk-text-muted uk-margin-small-left">
				<?php echo $phone->contact; ?>
				</span>
						<?php endif; ?>
					</a>

				</div>
			<?php endforeach; ?>
		<?php endif; ?>
		<?php if (!empty($this->item->extra['address']->value)): ?>
			<div class="uk-width-1-1 uk-width-small-1-1 uk-width-medium-1-2">
				<i class="uk-icon-map-o uk-margin-right"></i>
				<?php echo $this->item->extra['address']->value; ?>
			</div>
		<?php endif; ?>
		<?php if (!empty($this->item->extra['vk']->value)): ?>
			<div class="uk-width-1-1 uk-width-small-1-1 uk-width-medium-1-2">
				<a class="uk-link-muted " href="<?php echo $this->item->extra['vk']->value; ?>" target="_blank">
					<i class="uk-icon-vk uk-margin-small-right"></i>
					<?php echo $this->item->extra['vk']->tsvalue; ?>
				</a>

			</div>
		<?php endif; ?>
		<?php if (!empty($this->item->extra['site']->value)): ?>
			<div class="uk-width-1-1 uk-width-small-1-1 uk-width-medium-1-2">
				<a class="uk-link-muted" href="<?php echo $this->item->extra['site']->value; ?>" target="_blank">
					<i class="uk-icon-external-link uk-margin-small-right"></i>
					<?php echo $this->item->extra['site']->tsvalue; ?>
				</a>

			</div>
		<?php endif; ?>
		<?php if (!empty($this->item->extra['fb']->value)): ?>
			<div class="uk-width-1-1 uk-width-small-1-1 uk-width-medium-1-2">
				<a class="uk-link-muted" href="<?php echo $this->item->extra['fb']->value; ?>" target="_blank">
					<i class="uk-icon-facebook-official uk-margin-small-right"></i>
					<?php echo $this->item->extra['fb']->tsvalue; ?>
				</a>

			</div>
		<?php endif; ?>
		<?php if (!empty($this->item->extra['ok']->value)): ?>
			<div class="uk-width-1-1 uk-width-small-1-1 uk-width-medium-1-2">
				<a class="uk-link-muted uk-text-mlarge" href="<?php echo $this->item->extra['ok']->value; ?>"
				   target="_blank">
					<i class="uk-icon-odnoklassniki uk-margin-small-right"></i>
					<?php echo $this->item->extra['ok']->tsvalue; ?>
				</a>
			</div>
		<?php endif; ?>
	</div>
	<?php if ($this->item->map): ?>
		<div id="map" class="uk-width-1-1 ">
		</div>
	<?php endif; ?>
</div>