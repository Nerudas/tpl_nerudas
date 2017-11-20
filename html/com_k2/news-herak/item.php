<?php
/**
 * @package    Nerudas Template
 * @version    4.9.2
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
if ($this->item->extra_fields)
{
	$this->item->extra = NerudasK2Helper::getItemExtra($this->item->extra_fields);
}
if (!$this->item->image)
{
	$this->item->image = '/templates/' . $app->getTemplate() . '/images/noimages/' . $this->item->catid . '.jpg';
}
if (isset($this->item->editLink))
{
	$this->item->editLink = '/forms/news-herak?cid=' . $this->item->id;
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

$text = $this->item->fulltext;
// {comments}
$text                 = str_replace('{comments}', $this->loadTemplate('comments'), $text);
$this->item->fulltext = $text;
?>

<div id="news" class="article">
	<div class="uk-panel uk-panel-box uk-margin-bottom">
		<div class="uk-clearfix">
			<h1 class="uk-text-large uk-display-inline-block">
				<span>
				<?php echo $this->item->title; ?>
				</span>
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
		<div class="uk-margin-bottom uk-text-muted">
			<span class="">
				<?php echo JHTML::_('date', $this->item->publish_up, 'd F'); ?>,
			</span>
			<?php if (!empty($this->item->extra['city']->value)): ?>
				<span>
					<?php echo $this->item->extra['city']->value; ?>
				</span>
			<?php endif; ?>
		</div>
		<div>
			<?php echo $this->item->fulltext; ?>
		</div>
		<? /*
		<div class="uk-margin-top uk-margin-bottom uk-clearfix">
			<?php if (!empty($this->item->latitude) && !empty($this->item->longitude)): ?>
				<div class="uk-float-right uk-margin-small-left">
					<a data-nerudas-modal-map='<?php echo $this->item->mapModal; ?>' data-uk-tooltip=""
					   title="<?php echo JText::_('NERUDAS_SHOW_ON_MAP'); ?>">
						<img src="<?php echo $this->item->mapicon; ?>"
							 alt="<?php echo JText::_('NERUDAS_SHOW_ON_MAP'); ?>"/>
					</a>
				</div>
			<?php endif; ?>
			<div class="ya-share2 uk-float-right" data-services="vkontakte,facebook,odnoklassniki"
				 data-counter="">
			</div>
		</div>
 */ ?>
	</div>
	<? /*
	<div class="uk-panel uk-panel-box uk-margin-bottom">
		<?php if (!empty($this->item->extra['comments']->value)): ?>
			<div class="uk-margin-bottom">
				<strong class="uk-text-xlarge"><?php echo $this->item->extra['comments']->value; ?></strong>
			</div>
		<?php endif; ?>
		<?php echo $this->loadTemplate('comments'); ?>
	</div>
*/ ?>
</div>
