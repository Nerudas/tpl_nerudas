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
$app                 = JFactory::getApplication();
$doc                 = JFactory::getDocument();
$modules             = $doc->loadRenderer('modules');
$this->item->mintext = NerudasUtility::minimalizeText($this->item->introtext);
if (!$this->item->image)
{
	$this->item->image = '/templates/' . $app->getTemplate() . '/images/noimages/' . $this->item->catid . '.jpg';
}
if ($this->item->extra_fields)
{
	$this->item->extra = NerudasK2Helper::getItemExtra($this->item->extra_fields);
}
$this->item->mapicon             = '/templates/' . $app->getTemplate() . '/images/icons/24x24/map.png';
$this->item->company             = new stdClass();
$this->item->company->get        = 'child';
$this->item->company->parent     = new stdClass();
$this->item->company->parent->id = $this->item->id;
$this->item->company             = NerudasK2Helper::getRelatedItem($this->item->company);

?>
<div id="news-company" class="article" itemscope itemtype="http://schema.org/Article">
	<div class="head uk-text-right">
		<span class="uk-text-muted"><?php echo JHTML::_('date', $this->item->publish_up, 'd.m.y H:i'); ?></span>
		<?php if ($this->item->company): ?>
			<span class="uk-margin-small-left uk-margin-small-right">
			-
		</span>
			<a href="<?php echo $this->item->company->url; ?>">
				<?php echo $this->item->company->title; ?>
			</a>
		<?php endif; ?>
	</div>
	<div class="uk-grid uk-grid-small">
		<div class="uk-width-xsmall-1-1 uk-width-small-1-3 uk-width-medium-1-4 uk-width-large-1-4 uk-width-xlarge-1-4">
			<a href="<?php echo $this->item->image; ?>"
			   data-uk-lightbox="{group:'company-news-<?php echo $this->item->id; ?>'}"
			   class="uk-align-medium-left uk-margin-small-top">
				<img src="<?php echo $this->item->image; ?>" alt="<?php echo $this->item->title; ?>" class=""/>
			</a>
		</div>
		<div class="uk-width-xsmall-1-1 uk-width-small-2-3 uk-width-medium-3-4 uk-width-large-3-4 uk-width-xlarge-3-4">
			<?php echo $this->item->introtext; ?>
		</div>
	</div>
	<div class="uk-grid uk-grid-small uk-margin-top" data-uk-grid-match="">
		<div class="uk-text-muted uk-width-xsmall-1-1 uk-width-small-1-2 uk-width-medium-1-2 uk-width-large-1-2 uk-width-xlarge-1-2 uk-vertical-align">
			<?php if (isset($this->item->editLink)): ?>
				<div class="uk-vertical-align-middle">
					<a class="uk-button" href="/forms/news-company?cid=<?php echo $this->item->id; ?>">
						<i class="uk-icon-pencil uk-margin-small-right"></i>
						<?php echo JText::_('NERUDAS_EDIT'); ?>
					</a>
				</div>
			<?php endif; ?>
		</div>
		<div class="uk-text-muted uk-width-xsmall-1-1 uk-width-small-1-2 uk-width-medium-1-2 uk-width-large-1-2 uk-width-xlarge-1-2 uk-vertical-align uk-text-right">
			<div class="uk-claerfix uk-vertical-align-middle uk-text-right">
				<?php if (!empty($this->item->latitude) && !empty($this->item->longitude)): ?>
					<div class="uk-float-right uk-margin-small-left">
						<a class="show-modal-map"
						   data-map-latitude="<?php echo $this->item->latitude; ?>"
						   data-map-longitude="<?php echo $this->item->longitude; ?>"
						   data-map-zoom="10"
						   data-map-title="<?php echo $this->item->title; ?>"
						   data-map-text="<?php echo $this->item->mintext; ?>"
						   data-map-url="<?php echo $this->item->link; ?>"
						   data-uk-tooltip=""
						   title="<?php echo JText::_('NERUDAS_SHOW_ON_MAP'); ?>"
						>
							<img src="<?php echo $this->item->mapicon; ?>"
								 alt="<?php echo JText::_('NERUDAS_SHOW_ON_MAP'); ?>"/>
						</a>
					</div>
				<?php endif; ?>
				<div class="ya-share2 uk-float-right"
					 data-services="vkontakte,facebook,odnoklassniki,moimir,gplus,twitter" data-counter="">
				</div>
			</div>
		</div>
	</div>

	<?php if (!empty($modules->render('bottom-k2-item'))): ?>
		<?php echo $modules->render('bottom-k2-item', array('style' => 'blank')); ?>
	<?php endif; ?>
	<div class="hidden-microdata">
		<img class="uk-thumbnail uk-width-1-1" src="<?php echo $this->item->image; ?>"
			 alt="<?php echo $this->item->title; ?>" itemprop="image"/>
		<div itemprop="description">
			<?php echo $this->item->mintext; ?>
		</div>
	</div>
	<?php if (!empty($this->item->latitude) && !empty($this->item->longitude)): ?>
		<div class="hidden-microdata">
			<div itemscope itemtype="http://schema.org/Place">
				<div itemprop="name">
					<?php echo $this->item->title; ?>
				</div>

				<div itemprop="address">
					<?php echo NerudasRegionsHelper::getAddress($this->item->latitude, $this->item->longitude); ?>
				</div>
				<div itemprop="geo" itemscope itemtype="http://schema.org/GeoCoordinates">
					<div itemprop="latitude">
						<?php echo $this->item->latitude; ?>
					</div>
					<div itemprop="longitude">
						<?php echo $this->item->longitude; ?>
					</div>
				</div>
			</div>
		</div>
		<div id="map-modal" class="uk-modal">
			<div class="uk-modal-dialog">
				<a class="uk-modal-close uk-close">
				</a>
				<h4 class="uk-modal-header">
					<?php echo JText::_('NERUDAS_SHOW_ON_MAP'); ?>
				</h4>
				<div id="modal-map" class="uk-width-1-1">
				</div>
			</div>
		</div>
	<?php endif; ?>
	<?php if (!empty($this->item->extra['comments']->value)): ?>
		<div class="uk-margin-top">
			<strong class="uk-text-xlarge"><?php echo $this->item->extra['comments']->value; ?></strong>
		</div>
	<?php endif; ?>
	<hr class="uk-article-divider uk-width-1-1">
	<?php include 'templates/' . $app->getTemplate() . '/html/com_k2/item_comments.php'; ?>
</div>
