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
$app                 = JFactory::getApplication();
$doc                 = JFactory::getDocument();
$modules             = $doc->loadRenderer('modules');
$this->item->mintext = NerudasUtility::minimalizeText($this->item->introtext);
if ($this->item->extra_fields)
{
	$this->item->extra  = NerudasK2Helper::getItemExtra($this->item->extra_fields);
	$this->item->phones = NerudasK2Helper::getPhones($this->item->extra);
}
if (!$this->item->image)
{
	$this->item->image = '/templates/' . $app->getTemplate() . '/images/noimages/' . $this->item->catid . '.jpg';
}
if (isset($this->item->editLink))
{
	$this->item->editLink = '/forms/ads?cid=' . $this->item->id;
}
$this->author          = NerudasProfilesHelper::getProfile($this->item->created_by);
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
<script>
	(function ($) {
		function authorBlock() {
			if ($('body').innerWidth() >= 1220) {
				$('#adsitem-author').appendTo($('#appendRight'));
			}
			else {
				$('#adsitem-author').appendTo($('authorAppend'));
			}
		}

		$(document).ready(function () {
			authorBlock();
		});
		$(window).resize(function () {
			authorBlock();
		});

	})(jQuery);
</script>

<div id="nerads" class="article">
	<div class="uk-panel uk-panel-box uk-margin-bottom">
		<div class="uk-clearfix">
			<h1 class="uk-text-large uk-display-inline-block">
				<?php echo $this->item->title; ?>
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
			</h1>
			<?php if (isset($this->item->editLink)): ?>
				<div class="uk-float-right uk-margin-left uk-position-relative" data-uk-dropdown="{mode:'click'}">
					<a class="uk-icon-ellipsis-h uk-icon-small uk-icon-hover  uk-text-muted">
					</a>
					<div class="uk-dropdown">
						<ul class="uk-nav uk-nav-dropdown">

							<li>
								<a href="<?php echo $this->item->editLink; ?>">
									<i class="uk-icon-pencil uk-margin-small-right"></i>
									<?php echo JText::_('NERUDAS_EDIT'); ?>
								</a>
							</li>

						</ul>
					</div>
				</div>
			<?php endif; ?>
		</div>
		<div class="uk-grid uk-margin-bottom" data-uk-grid-math>
			<div class="uk-width-1-1 uk-width-small-1-1 uk-width-medium-1-3">
				<div class="uk-position-relative">

					<div class="uk-position-top-right">
						<?php if (!empty($this->item->extra['price']->value)) : ?>
							<div class="price uk-text-large uk-badge uk-badge-success uk-width-1-1">
							<span itemprop="price">
								<?php echo $this->item->extra['price']->value; ?>
							</span>
								<?php if (is_numeric($this->item->extra['price']->value)): ?>
									<i class="uk-icon-rub"></i>
								<?php endif; ?>
							</div>

						<?php endif; ?>

					</div>
					<img class="uk-thumbnail uk-width-1-1" src="<?php echo $this->item->image; ?>"
						 alt="<?php echo $this->item->title; ?>"/>
				</div>

				<?php if (!empty($this->item->phones)): ?>
					<?php foreach ($this->item->phones as $phone) : ?>
						<div class="phones uk-margin-top">
							<a class="uk-text-xlarge" href="tel:+7<?php echo $phone->sysnumber; ?>">
								<?php echo $phone->number; ?>
							</a>
						</div>
					<?php endforeach; ?>
				<?php endif; ?>
				<div class="icons uk-margin-top">
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
			<div class="uk-width-1-1 uk-width-small-1-1 uk-width-medium-2-3">
				<div class="uk-text-muted">
					<?php echo $this->item->introtext; ?>
				</div>
			</div>
		</div>
		<div class="uk-hidden">
			<div class="ya-share2 uk-text-right" data-services="vkontakte,facebook,odnoklassniki,moimir,twitter"
				 data-counter="">
			</div>
		</div>
		<div class="uk-grid uk-margin-top" data-uk-grid-match>
			<div class="uk-width-medium-1-2 uk-flex uk-flex-middle">
			</div>
			<div class="uk-width-medium-1-2 uk-flex uk-flex-right uk-flex-middle  uk-text-right">
				<span class="">
				<?php echo JHTML::_('date', $this->item->publish_up, 'd.m.y'); ?>
				</span>
				<span class="uk-margin-left">
				<?php echo JHTML::_('date', $this->item->publish_up, 'H:i'); ?>
				</span>
			</div>
		</div>
		<div id="authorAppend">
		</div>
	</div>
	<?php echo $this->loadTemplate('author'); ?>
	<div class="uk-panel uk-panel-box uk-margin-bottom">
		<?php echo $this->loadTemplate('comments'); ?>
	</div>
</div>
<?php echo $this->loadTemplate('map_modal'); ?>
