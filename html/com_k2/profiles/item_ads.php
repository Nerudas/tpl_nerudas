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
$app = JFactory::getApplication();
$doc = JFactory::getDocument();
$data = new stdClass();
$data->categories = NerudasK2Helper::getCategoryTree(177);
$data->user = $this->item->created_by;
$data->order = 'publish_up DESC';
$data->limit = 10;
$ads = NerudasK2Helper::getItems($data);
$map_icon =  '/templates/'.$app->getTemplate().'/images/icons/24x24/map.png';
$mapa_icon =  '/templates/'.$app->getTemplate().'/images/icons/24x24/mapa.png';
$ads_count = NerudasK2Helper::getCategoryTotal(177,  0, $this->item->created_by);
?>

<div class="uk-panel uk-panel-box uk-padding-top uk-padding-bottom uk-hidden">
	<h2 class="uk-text-large">
		<?php echo JText::_('NERUDAS_ADS'); ?>
			<?php if ($this->author->me): ?>
	
		<a class="uk-button uk-button-success uk-float-right" href="/ads/add">
			<?php echo JText::_('NERUDAS_ADD_ADS'); ?>
		</a>
	
	<?php endif; ?>
	</h2>
</div>
<hr class="uk-margin-remove uk-hidden">
<div class="uk-panel uk-panel-box">

	<?php if ($ads_count > 0): ?>
	<div class="uk-overflow-container">
		<hr class="uk-margin-bottom-remove uk-margin-top-remove uk-width-1-1">
		<table class="uk-margin-top-remove uk-table uk-table-hover uk-table-striped uk-table-condensed">
			<tbody>
				<?php foreach ($ads as $item): 
				$item->mintext = NerudasUtility::minimalizeText($item->introtext);
			?>
				<tr>
					<td class="uk-text-middle">
						<div class="title uk-text-slarge">
							<a href="<?php echo $item->url; ?>" class="uk-link-muted"  data-uk-tooltip="pos:'bottom-left', cls:'big'" title="<?php echo $item->mintext;?>">
								<?php echo $item->title; ?>
							</a>
							<sup class="uk-margin-small-left">
							<?php echo JHTML::_('date', $item->publish_up, 'd.m.y'); ?>
							</sup>
						</div>
						<div class="">
							<span class="category uk-text-muted">
							<?php if ($item->region) :?>
							<span class="reigon">
							<?php echo $item->region->name; ?> / </span>
							<?php endif; ?>
							<?php echo $item->category->name; ?>
							</span>
						</div>
					</td>
					<td class="uk-text-middle uk-text-right uk-text-mlarge uk-text-nowrap">
						<?php if (!empty($item->extra['price']->value)) : ?>
						<?php echo $item->extra['price']->value; ?>
						<?php if (is_numeric($item->extra['price']->value)):?>
						<i class="uk-icon-rub"></i>
						<?php endif; ?>
						<?php endif; ?>
					</td>
					<td class="uk-text-right uk-text-middle">
						<?php if ($item->latitude != 0 && $item->longitude != 0 ): 
							$item->mapModal = new stdClass();
							$item->mapModal->latitude = $item->latitude;
							$item->mapModal->longitude = $item->longitude;
							$item->mapModal->zoom = $item->region->zoom;
							$item->mapModal->link = $item->url;
							$item->mapModal->title = $item->title;
							$item->mapModal->text = $item->mintext;
							$item->mapModal->mark = 'templates/nerudas/images/map/'.$item->catid.'.png';
							$item->mapModal->markSize = getimagesize($item->mapModal->mark);
							$item->mapModal->markOffset = json_encode(array(-1 * round($item->mapModal->markSize[0] / 2), -1 * round($item->mapModal->markSize[1])));
							$item->mapModal->mark = JURI::root().'templates/nerudas/images/map/'.$item->catid.'.png';
							$item->mapModal->markSize = json_encode(array($item->mapModal->markSize[0],$item->mapModal->markSize[1]));
							$item->mapModal = json_encode($item->mapModal);
						?>
						<a class="show-modal-map" 
							data-nerudas-modal-map='<?php echo $item->mapModal; ?>'
							data-uk-tooltip=""
							title="<?php echo JText::_('NERUDAS_SHOW_ON_MAP'); ?>">
							<img src="<?php echo $map_icon; ?>" alt="<?php echo JText::_('NERUDAS_SHOW_ON_MAP'); ?>" />
						</a>
						<?php else: ?>
						<img src="<?php echo $mapa_icon; ?>" alt="<?php echo JText::_('NERUDAS_SHOW_ON_MAP_NO'); ?>" />
						<?php endif;?>
					</td>
					<?php if(isset($this->item->editLink)): ?>
					<td  style="vertical-align: middle;"class="uk-text-right">
						<a class="uk-icon-pencil uk-icon-small uk-text-muted" href="/forms/ads?cid=<?php echo $item->id; ?>" data-uk-tooltip="" title="<?php echo JText::_('NERUDAS_EDIT'); ?>">
						</a>
					</td>
					<?php endif; ?>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		<?php if ($ads_count > 10): ?>
		<div class="uk-text-right">
			<a href="/ads?filter=true&profile=<?php echo $this->author->id; ?>" class="uk-text-mlarge uk-link-muted uk-text-uppercase">
				<?php echo JText::_('NERUDAS_ALL_USER_ADS'); ?>
				<i class="uk-icon-angle-double-right uk-icon-small"></i>
			</a>
		</div>
		<?php endif; ?>
	</div>
	<?php endif; ?>
</div>
