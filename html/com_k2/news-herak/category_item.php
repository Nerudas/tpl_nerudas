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
<div class="item herak uk-text-center uk-width-medium-1-2">
	<a class="uk-overlay uk-overlay-hover uk-display-block" href="<?php echo $this->item->link; ?>">
		<div class="uk-text-center">
			<img src="<?php echo $this->item->image; ?>" alt="<?php echo str_replace('"', '', $this->item->title); ?>"
				 class="uk-width-1-1"/>
		</div>
		<div class="uk-overlay-panel uk-overlay-panel-small uk-overlay-background ">
			<div class="title">
				<?php echo $this->item->extra['city']->value; ?>
			</div>
			<div class="uk-text-small text">
				<?php echo $this->item->mintext; ?>
			</div>
		</div>
	</a>
</div> 