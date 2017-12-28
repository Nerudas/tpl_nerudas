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
$app = JFactory::getApplication();
if ($this->item->extra_fields)
{
	$this->item->extra = NerudasK2Helper::getItemExtra($this->item->extra_fields);
}
$this->author = NerudasProfilesHelper::getProfile($this->item->created_by);
K2HelperUtilities::setDefaultImage($this->item, 'itemlist', $this->params);
if (!$this->item->image)
{
	$this->item->image = '/templates/' . $app->getTemplate() . '/images/noimages/' . $this->item->catid . '.jpg';
}
if (isset($this->item->editLink))
{
	$this->item->editLink = '/forms/ads?cid=' . $this->item->id;
}
$this->item->mintext = JHTML::_('string.truncate', (strip_tags($this->item->introtext)), 150);;
$this->item->mapicon   = '/templates/' . $app->getTemplate() . '/images/icons/32x32/map.png';
$this->item->nomapicon = '/templates/' . $app->getTemplate() . '/images/icons/32x32/mapa.png';
if (!empty($this->item->latitude) && !empty($this->item->longitude))
{
	$this->item->mapModal             = new stdClass();
	$this->item->mapModal->latitude   = $this->item->latitude;
	$this->item->mapModal->longitude  = $this->item->longitude;
	$this->item->mapModal->zoom       = $this->item->region->zoom;
	$this->item->mapModal->link       = $this->item->link;
	$this->item->mapModal->title      = $this->item->title;
	$this->item->mapModal->text       = $this->item->mintext;
	$this->item->mapModal->mark       = 'templates/nerudas/images/map/' . $this->item->catid . '.png';
	$this->item->mapModal->markSize   = getimagesize($this->item->mapModal->mark);
	$this->item->mapModal->markOffset = json_encode(array(-1 * round($this->item->mapModal->markSize[0] / 2), -1 * round($this->item->mapModal->markSize[1])));
	$this->item->mapModal->mark       = JURI::root() . 'templates/nerudas/images/map/' . $this->item->catid . '.png';
	$this->item->mapModal->markSize   = json_encode(array($this->item->mapModal->markSize[0], $this->item->mapModal->markSize[1]));
	$this->item->mapModal             = json_encode($this->item->mapModal);
}

?>

<div id="k2item-<?php echo $this->item->id; ?>" class="item uk-margin-bottom">
	<div class="uk-panel uk-panel-box">
		<div class="uk-grid uk-margin-bottom uk-text-semi" data-uk-grid-math>
			<div class="uk-width-medium-2-4">
				<span class="uk-text-muted">
				<?php echo JHTML::_('date', $this->item->publish_up, 'd.m.y'); ?>
				</span>
				<span class="uk-text-muted uk-margin-left">
				<?php echo JHTML::_('date', $this->item->publish_up, 'H:i'); ?>
				</span>
			</div>
			<div class="uk-width-medium-2-4">
				<div class="uk-float-right uk-margin-left uk-position-relative" data-uk-dropdown="{mode:'click'}">
					<a class="uk-icon-ellipsis-h uk-icon-small uk-icon-hover  uk-text-muted">
					</a>
					<div class="uk-dropdown">
						<ul class="uk-nav uk-nav-dropdown">
							<?php if (isset($this->item->editLink)): ?>
								<li>
									<a href="<?php echo $this->item->editLink; ?>">
										<i class="uk-icon-pencil uk-margin-small-right"></i>
										<?php echo JText::_('NERUDAS_EDIT'); ?>
									</a>
								</li>
							<?php endif; ?>
							<li>
								<a class="uk-toggle"
								   data-uk-toggle="{target:'#ads.itemlist #k2item-<?php echo $this->item->id; ?> .uk-toggle'}">
									<i class="uk-icon-angle-up uk-margin-small-right"></i>
									<?php echo JText::_('NERUDAS_HIDE'); ?>
								</a>
							</li>
							<li>
								<a class="uk-hidden uk-toggle"
								   data-uk-toggle="{target:'#ads.itemlist #k2item-<?php echo $this->item->id; ?> .uk-toggle'}">
									<i class="uk-icon-angle-down uk-margin-small-right"></i>
									<?php echo JText::_('NERUDAS_SHOW'); ?>
								</a>
							</li>
						</ul>
					</div>
				</div>
				<div class="uk-float-right uk-margin-right uk-text-muted">
					<i class="uk-margin-small-right uk-icon-eye"></i>
					<?php echo $this->item->hits; ?>
				</div>
				<div class="uk-float-right uk-margin-right">
					<i class="uk-margin-small-right   uk-icon-comments  uk-text-muted"></i>
					<?php echo $this->item->numOfComments; ?>
				</div>
			</div>
		</div>
		<div class="uk-clearfix">
		</div>
		<div class="contnent uk-toggle uk-margin-small-top">
			<div class="uk-grid" data-uk-grid-math>
				<div class="uk-width-medium-4-12">
					<a class="uk-position-relative uk-display-block" href="<?php echo $this->item->link; ?>"
					   title="<?php echo $this->item->mintext; ?>" data-uk-tooltip="pos:'bottom-left'">
						<div class="uk-position-top-right">
							<?php if (!empty($this->item->extra['price']->value)) : ?>
								<div class="price uk-text-large uk-badge uk-badge-success uk-widht-1-1">
									<?php echo $this->item->extra['price']->value; ?>
									<?php if (is_numeric($this->item->extra['price']->value)): ?>
										<i class="uk-icon-rub"></i>
									<?php endif; ?>
								</div>
							<?php else: ?>
							<?php endif; ?>
						</div>
						<span class="image uk-thumbnail uk-display-block uk-cover-background"
							  style="background-image: url('<?php echo $this->item->image; ?>')"
							  data-ratio-height="[166,125]">
						</span>
					</a>
				</div>
				<div class="uk-width-medium-8-12">
					<div class="uk-position-relative uk-height-1-1">
						<h2 class="uk-margin-remove uk-text-ellipsis uk-text-large">
							<a href="<?php echo $this->item->link; ?>" class="uk-link-muted uk-text-ellipsis "
							   title="<?php echo $this->item->mintext; ?>"
							   data-uk-tooltip="pos:'bottom-left', cls:'big'">
								<?php echo $this->item->title; ?>
							</a>
							<?php if (isset($this->item->extra['adswhen']) && !empty($this->item->extra['adswhen']->value)) :
								$lang = JLanguage::getInstance('ru-RU');
								$val = str_replace(' ', '-', $lang->transliterate($this->item->extra['adswhen']->value));
								$class = 'uk-hidden';
								if ($val == 'na-segodnya')
								{
									$class = 'uk-badge-success';
								}
								if ($val == 'na-zavtra')
								{
									$class = 'uk-badge-warning';
								}
								?>
								<sup class="uk-badge <?php echo $class; ?>"><?php echo $this->item->extra['adswhen']->value; ?></sup>
							<?php endif; ?>
						</h2>
						<div class="uk-width-1-1">
							<a href="<?php echo $this->item->category->link; ?>" class="uk-margin-right">
								<?php echo $this->item->category->name; ?>
								<?php if ($this->item->region) : ?>
									<span class="uk-margin-small-right uk-margin-small-left">/</span>
									<span class="reigon">
								<?php echo $this->item->region->name; ?>
								</span>
								<?php endif; ?>
							</a>
						</div>
						<div class="text uk-text-muted uk-margin-small-top">
							<span class="uk-display-block uk-text-justify" title="<?php echo $this->item->mintext; ?>"
								  data-uk-tooltip="pos:'bottom-left'">
							<?php echo JHTML::_('string.truncate', (strip_tags($this->item->introtext)), 120); ?>
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
			<div class="uk-width-2-3 uk-flex uk-flex-middle">
				<?php if ($this->author->id != 115159): ?>
					<div class="author uk-clearfix uk-width-1-1">
						<div class="avatar uk-position-relative uk-display-inline-block uk-align-medium-left  uk-margin-bottom-remove">
							<a class="image uk-avatar-48 "
							   style="background-image: url('<?php echo $this->author->avatar->small; ?>');"
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
									<a class="uk-text-muted" href="<?php echo $this->author->job->link; ?>"
									   target="_blank">
										<?php echo $this->author->job->name; ?>
									</a>
								</div>
							<?php endif; ?>
						</div>
					</div>
				<?php endif; ?>
			</div>
			<div class="uk-width-1-3 uk-flex uk-flex-right uk-flex-middle uk-text-right">
				<div class="icons">
					<?php
					if (!empty($this->item->extra['prepayment']->value))
					{
						echo $this->item->extra['prepayment']->image;
					}
					if (!empty($this->item->extra['payment_method']->value))
					{
						echo $this->item->extra['payment_method']->image;
					}
					if (!empty($this->item->extra['day_mode']->value))
					{
						echo $this->item->extra['day_mode']->image;
					}
					?>
					<?php if (!empty($this->item->latitude) && !empty($this->item->longitude)): ?>
						<a data-nerudas-modal-map='<?php echo $this->item->mapModal; ?>' data-uk-tooltip=""
						   title="<?php echo JText::_('NERUDAS_SHOW_ON_MAP'); ?>">
							<img src="<?php echo $this->item->mapicon; ?>"
								 alt="<?php echo JText::_('NERUDAS_SHOW_ON_MAP'); ?>"/>
						</a>
					<?php else: ?>
						<a data-uk-tooltip="" title="<?php echo JText::_('NERUDAS_SHOW_ON_MAP_NO'); ?>">
							<img src="<?php echo $this->item->nomapicon; ?>"
								 alt="<?php echo JText::_('NERUDAS_SHOW_ON_MAP_NO'); ?>"/>
						</a>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>
