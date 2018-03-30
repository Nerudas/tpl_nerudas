<?php
/**
 * @package    Nerudas Template
 * @version    4.9.7
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;
$app = JFactory::getApplication();
$doc = JFactory::getDocument();
if ($this->item->extra_fields)
{
	$this->item->extra = NerudasK2Helper::getItemExtra($this->item->extra_fields);
}
K2HelperUtilities::setDefaultImage($this->item, 'itemlist', $this->params);
if (!$this->item->image)
{
	$this->item->image = '/templates/' . $app->getTemplate() . '/images/noimages/' . $this->item->catid . '.jpg';
}
$this->item->mintext = JHTML::_('string.truncate', (strip_tags($this->item->introtext)), 150);
?>
<div class="item rabotaem uk-margin-bottom uk-panel uk-panel-box">
	<div class="uk-text-large uk-margin-small-bottom uk-link-muted uk-text-uppercase">
		<a href="<?php echo $this->item->link; ?>" class="uk-link-muted"><?php echo $this->item->title; ?></a>
	</div>
	<div class="uk-grid uk-grid-small">
		<div class="uk-width-xsmall-1-4 uk-width-small-1-5 uk-width-medium-1-10 uk-width-large-1-10 uk-width-xlarge-1-6">
			<a class="uk-text-muted" href="<?php echo $this->item->link; ?>">
				<?php echo JHTML::_('date', $this->item->publish_up, 'd.m'); ?>
			</a>
		</div>
		<div class="uk-width-xsmall-3-4 uk-width-small-4-5 uk-width-medium-9-10 uk-width-large-9-10 uk-width-xlarge-5-6">
			<a class="uk-display-block text uk-link-muted" href="<?php echo $this->item->link; ?>">
				<span>
					<?php echo $this->item->introtext; ?>
				</span>
			</a>
		</div>
	</div>
</div>