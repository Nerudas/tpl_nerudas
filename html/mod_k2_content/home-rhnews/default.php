<?php
/**
 * @package    Nerudas Template
 * @version    4.9.1
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2017 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;
$app = JFactory::getApplication();
$doc = JFactory::getDocument();
if ($params->get('itemCustomLinkMenuItem'))
{
	$menu     = JMenu::getInstance('site');
	$menuLink = $menu->getItem($params->get('itemCustomLinkMenuItem'));
	$params->set('itemCustomLinkURL', JRoute::_('index.php?&Itemid=' . $menuLink->id));
}
?>

<div class="rhnews">
	<ul class="uk-list uk-list-space">
		<?php foreach ($items as $key => $item):
			$item->mintext = NerudasUtility::minimalizeText($item->introtext);
			if ($item->extra_fields)
			{
				$item->extra = NerudasK2Helper::getItemExtra($item->extra_fields);
			}
			if (empty($item->image))
			{
				$item->image = '/templates/' . $app->getTemplate() . '/images/noimages/' . $item->catid . '.jpg';
			}
			?>

			<?php if ($item->catid == 315): ?>
			<li class="herak item">
				<a class="uk-overlay uk-overlay-hover uk-display-block" href="<?php echo $item->link; ?>">
					<div class="uk-text-large uk-margin-small-bottom uk-link-muted uk-text-uppercase">
						<?php echo $item->categoryname; ?> ¡
					</div>
					<div class="uk-text-center">
						<img src="<?php echo $item->image; ?>" alt="<?php echo str_replace('"', '', $item->title); ?>"/>
					</div>
					<div class="uk-overlay-panel uk-overlay-panel-small uk-overlay-background ">
						<div class="title">
							<?php echo $item->extra['city']->value; ?>
						</div>
						<div class="uk-text-small text">
							<?php echo $item->mintext; ?>
						</div>
					</div>
				</a>
			</li>
		<?php endif; ?>
			<?php if ($item->catid == 40): ?>
			<li class="rabotaem item">
				<div class="uk-text-large uk-margin-small-bottom uk-link-muted uk-text-uppercase">
					<?php echo $item->title; ?>
				</div>
				<div class="uk-grid uk-grid-small">
					<div class="uk-width-xsmall-1-4 uk-width-small-1-5 uk-width-medium-1-10 uk-width-large-1-10 uk-width-xlarge-1-6">
						<a class="uk-text-muted" href="<?php echo $item->link; ?>">
							<?php echo JHTML::_('date', $item->publish_up, 'd.m'); ?>
						</a>
					</div>
					<div class="uk-width-xsmall-3-4 uk-width-small-4-5 uk-width-medium-9-10 uk-width-large-9-10 uk-width-xlarge-5-6">
						<a class="uk-display-block text uk-link-muted" href="<?php echo $item->link; ?>">
					<span>
						<?php echo strip_tags($item->introtext); ?>
					</span>
						</a>
					</div>
				</div>
			</li>
		<?php endif; ?>

		<?php endforeach; ?>
	</ul>
</div>
