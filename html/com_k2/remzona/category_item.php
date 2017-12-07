<?php
/**
 * @package    Nerudas Template
 * @version    4.9.3
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
$this->item->mintext             = JHTML::_('string.truncate', (strip_tags($this->item->introtext)), 150);
$this->item->company             = new stdClass();
$this->item->company->get        = 'child';
$this->item->company->parent     = new stdClass();
$this->item->company->parent->id = $this->item->id;
$this->item->company             = NerudasK2Helper::getRelatedItem($this->item->company);
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
							<?php echo $this->item->introtext; ?>
							</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<hr class="uk-margin-remove">
	<div class="uk-panel uk-panel-box uk-padding-top uk-padding-bottom">
		<div class="uk-grid uk-grid-small" data-uk-grid-match>
			<div class="uk-width-1-3 uk-flex uk-flex-middle uk-text-muted">
				<div class="uk-float-right uk-margin-right uk-text-muted">
					<i class="uk-margin-small-right uk-icon-eye"></i>
					<?php echo $this->item->hits; ?>
				</div>
				<div class="uk-float-right uk-margin-right">
					<i class="uk-margin-small-right   uk-icon-comments  uk-text-muted"></i>
					<?php echo $this->item->numOfComments; ?>
				</div>
			</div>
			<div class="uk-width-2-3 uk-flex uk-flex-right uk-flex-middle  uk-text-right">
				<div class=" ">
					<?php if (!empty($this->item->company)): ?>
						<a href="<?php echo $this->item->company->url; ?>"
						   target="_blank" class="uk-text-muted"><?php echo $this->item->company->title; ?></a>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>