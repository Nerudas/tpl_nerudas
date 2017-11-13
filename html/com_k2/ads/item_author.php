<?php
/**
 * @package    Nerudas Template
 * @version    4.9
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2017 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */
defined('_JEXEC') or die('Restricted access');
?>
<?php if ($this->author->id != 115159): ?>
<div id="adsitem-author" class="uk-panel uk-panel-box uk-margin-bottom">


	<div class="uk-clearfix uk-width-1-1">
		<div class="avatar uk-position-relative uk-display-inline-block uk-align-medium-left uk-margin-bottom-remove">
			<a class="image uk-avatar-60 " style="background-image: url('<?php echo $this->author->avatar->small; ?>');"
			   href="<?php echo $this->author->link; ?>" target="_blank">
			</a>
		</div>
		<div class="text uk-text-ellipsis">
			<div class="name uk-text-ellipsis ">
				<a class="uk-link-muted" href="<?php echo $this->author->link; ?>" target="_blank">
					<?php echo $this->author->name; ?>
				</a>
			</div>
			<?php if ($this->author->job): ?>
				<div class="job uk-text-uppercase-letter uk-text-small uk-text-ellipsis">
					<a class="uk-text-muted" href="<?php echo $this->author->job->link; ?>" target="_blank">
						<?php echo $this->author->job->name; ?>
					</a>


				</div>
				<div>
					<?php if ($this->author->job && $this->author->job->post): ?>
						<i class="uk-text-small">( <?php echo $this->author->job->post; ?> )</i>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
	<ul class="uk-list uk-list-space">
		<li class="uk-text-large">
			<?php if ($this->author->phone): ?>
				<a href="tel:+7<?php echo $this->author->phone->sysnumber; ?>" class="uk-flex uk-flex-middle">
					<span class="uk-margin-right uk-icon-phone uk-icon-small"></span>
					<?php echo $this->author->phone->number; ?>
				</a>
			<?php else: ?>
				<a class="uk-text-danger" href="<?php echo $this->author->editlink; ?>">
					<span class="uk-text-muted uk-margin-right uk-icon-phone uk-icon-small"></span>
					<?php echo JText::_('NERUDAS_NO_VALUE'); ?>
				</a>
			<?php endif; ?>
		</li>
		<?php if (!empty($this->author->extra['vk']->value)): ?>
			<li>
				<a class="uk-link-muted " href="<?php echo $this->author->extra['vk']->value; ?>" target="_blank">
					<i class="uk-icon-vk uk-margin-small-right"></i>
					<?php echo $this->author->extra['vk']->tsvalue; ?>
				</a>

			</li>
		<?php endif; ?>
		<?php if (!empty($this->author->extra['site']->value)): ?>
			<li>
				<a class="uk-link-muted" href="<?php echo $this->author->extra['site']->value; ?>" target="_blank">
					<i class="uk-icon-external-link uk-margin-small-right"></i>
					<?php echo $this->author->extra['site']->tsvalue; ?>
				</a>

			</li>
		<?php endif; ?>
		<?php if (!empty($this->author->extra['fb']->value)): ?>
			<li>
				<a class="uk-link-muted" href="<?php echo $this->author->extra['fb']->value; ?>" target="_blank">
					<i class="uk-icon-facebook-official uk-margin-small-right"></i>
					<?php echo $this->author->extra['fb']->tsvalue; ?>
				</a>

			</li>
		<?php endif; ?>
		<?php if (!empty($this->author->extra['ok']->value)): ?>
			<li>
				<a class="uk-link-muted uk-text-mlarge" href="<?php echo $this->author->extra['ok']->value; ?>"
				   target="_blank">
					<i class="uk-icon-odnoklassniki uk-margin-small-right"></i>
					<?php echo $this->author->extra['ok']->tsvalue; ?>
				</a>
			</li>
		<?php endif; ?>
		<?php /*
		<li class="">
			<?php if ($this->author->email): ?>
				<a href="mailto:<?php echo $this->author->email; ?>">
					<span class="uk-margin-small-right uk-icon-envelope-o uk-icon"></span>
					<?php echo $this->author->email; ?>
				</a>
			<?php else: ?>
				<a class="uk-text-danger" href="<?php echo $this->author->editlink; ?>">
					<?php echo JText::_('NERUDAS_NO_VALUE'); ?>
				</a>
			<?php endif; ?>
		</li>
		*/ ?>
	</ul>

</div>
<?php endif;?>