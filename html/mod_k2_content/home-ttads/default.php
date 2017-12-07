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
$doc = JFactory::getDocument();
//if ($params->get('itemCustomLinkMenuItem'))
//{
//	$menu     = JMenu::getInstance('site');
//	$menuLink = $menu->getItem($params->get('itemCustomLinkMenuItem'));
//	$params->set('itemCustomLinkURL', JRoute::_('index.php?&Itemid=' . $menuLink->id));
//}
if ($params->get('tt'))
{

	$date = '';
	if ($params->get('tt', 'today') == 'tomorrow')
	{
		$date = new JDate('now');
		$date = new JDate('now + 1 day');
	}
	$date = JHTML::_('date', $date, 'j F');
}
?>
<div class="ttads">
	<div class="mtitle uk-clearfix">
		<a href="<?php echo $params->get('itemCustomLinkURL'); ?>"
		   class="uk-text-xlarge uk-link-muted uk-margin-small-top">
			<?php echo $params->get('itemCustomLinkTitle'); ?> <span
					class="uk-text-medium uk-text-muted "><?php echo $date; ?></span>
		</a>
	</div>
	<div>
		<?php echo $params->get('itemPreText'); ?>
	</div>
	<ul class="uk-list uk-list-space uk-list-line uk-margin-bottom-remove">
		<?php foreach ($items as $key => $item):
			//$item->mintext = NerudasUtility::minimalizeText($item->introtext, '40');
			$item->mintext = JHTML::_('string.truncate', (strip_tags($item->introtext)), 75);
			if ($item->extra_fields)
			{
				$item->extra  = NerudasK2Helper::getItemExtra($item->extra_fields);
				$item->phones = NerudasK2Helper::getPhones($item->extra);
				$item->phone  = false;
				if (isset($item->phones[0]))
				{
					$item->phone = $item->phones[0];
				}
			}
			if (empty($item->image))
			{
				$item->image = '/templates/' . $app->getTemplate() . '/images/noimages/' . $item->catid . '.jpg';
			}
			$item->author = NerudasProfilesHelper::getProfile($item->created_by);
			?>
			<li class="item">
				<div class="">

					<div class="title uk-text-medium">
						<a href="<?php echo $item->link; ?>"
						   class="uk-link-muted"><?php echo $item->title; ?></a>
					</div>
					<div class="uk-text-muted uk-text-small"><?php echo $item->mintext; ?></div>


				</div>
				<?php if ($item->phone): ?>
					<div class="uk-margin-top uk-margin-bottom uk-text-right">
						<a href="tel:+7<?php echo $item->phone->sysnumber; ?>"
						   class="uk-margin-small-right uk-link-muted">
							<?php echo $item->phone->number; ?>
						</a>

						<?php echo $item->phone->contact; ?>

					</div>
				<?php endif; ?>
				<?php if (empty($date)): ?>
					<div>
						<?php echo JHTML::_('date', $item->publish_up, 'j F'); ?>
					</div>
				<?php endif; ?>
			</li>
		<?php endforeach; ?>
	</ul>
</div>
