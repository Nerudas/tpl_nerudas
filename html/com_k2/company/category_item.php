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
$app = JFactory::getApplication();
if ($this->item->extra_fields)
{
	$this->item->extra  = NerudasK2Helper::getItemExtra($this->item->extra_fields);
	$this->item->phones = NerudasK2Helper::getPhones($this->item->extra);
}
K2HelperUtilities::setDefaultImage($this->item, 'itemlist', $this->params);
if (empty($this->item->image))
{
	$this->item->image = '/templates/' . $app->getTemplate() . '/images/noimages/' . $this->item->catid . '.jpg';
}
$this->item->mintext = JHTML::_('string.truncate', (strip_tags($this->item->introtext)), 150);;
?>

<div id="k2item-<?php echo $this->item->id; ?>" class="item uk-margin-bottom">
	<div class="uk-panel uk-panel-box">
		<div class="contnent uk-toggle uk-margin-small-top">
			<div class="uk-grid" data-uk-grid-math>
				<div class="uk-width-medium-4-12">
					<a class="image uk-thumbnail uk-display-block uk-cover-background"
					   style="background-image: url('<?php echo $this->item->image; ?>')" data-ratio-height="[166,125]"
					   href="<?php echo $this->item->link; ?>" title="<?php echo $this->item->mintext; ?>"
					   data-uk-tooltip="pos:'bottom-left'">
					</a>
				</div>
				<div class="uk-width-medium-8-12">
					<div class="uk-position-relative uk-height-1-1">
						<h2 class="uk-margin-top-remove uk-text-ellipsis uk-text-large">
							<a href="<?php echo $this->item->link; ?>" class="uk-link-muted uk-text-ellipsis "
							   title="<?php echo $this->item->mintext; ?>"
							   data-uk-tooltip="pos:'bottom-left', cls:'big'">
								<?php echo $this->item->title; ?>
							</a>
						</h2>
						<div class="text uk-text-muted">
							<span title="<?php echo $this->item->mintext; ?>" data-uk-tooltip="pos:'bottom-left'">
							<?php echo JHTML::_('string.truncate', (strip_tags($this->item->introtext)), 120); ?>
							</span>
						</div>
						<div class="uk-grid uk-grid-small">
							<?php if (isset($this->item->extraFields->director) && !empty($this->item->extraFields->director->value)): ?>
								<div class="uk-width-medium-1-3 uk-link">
									<?php echo $this->item->extraFields->director->name; ?>
								</div>
								<div class="uk-width-medium-2-3  uk-text-muted">
									<?php echo $this->item->extraFields->director->value; ?>
								</div>
							<?php endif; ?>
							<?php if (isset($this->item->phones[0]) && !empty($this->item->phones[0]->number)): ?>
								<div class="uk-width-medium-1-3 uk-link">
									<?php echo JText::_('NERUDAS_PHONE'); ?>
								</div>
								<div class="uk-width-medium-2-3 uk-text-muted">
									<?php echo $this->item->phones[0]->number; ?>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<hr class="uk-margin-remove">
	<div class="uk-panel uk-panel-box uk-padding-top uk-padding-bottom">
		<div class="uk-grid uk-grid-small" data-uk-grid-match>
			<div class="uk-width-2-3 uk-flex uk-flex-middle uk-text-muted">
				<?php echo JHTML::_('date', $this->item->publish_up, 'd F Y' . ' ' . JText::_('NERUDAS_IN') . ' H:i'); ?>
			</div>
			<div class="uk-width-1-3 uk-flex uk-flex-right uk-flex-middle  uk-text-right">
				<div class=" ">
					<?php if (!empty($this->item->extra['site']->value)): ?>
						<a href="<?php echo $this->item->extra['site']->url; ?>"
						   target="_blank"><?php echo $this->item->extra['site']->tvalue; ?></a>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>