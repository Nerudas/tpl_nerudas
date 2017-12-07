<?php
/**
 * @package    Nerudas Template
 * @version    4.9.4
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2017 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;
$app = JFactory::getApplication();
K2HelperUtilities::setDefaultImage($this->item, 'itemlist', $this->params);
$this->item->mintext = NerudasUtility::minimalizeText($this->item->introtext);
if ($this->item->extra_fields)
{
	$this->item->extra = NerudasK2Helper::getItemExtra($this->item->extra_fields);
}
if (!$this->item->image)
{
	$this->item->image = '/templates/' . $app->getTemplate() . '/images/noimages/' . $this->item->catid . '.jpg';
}
$this->item->company             = new stdClass();
$this->item->company->get        = 'child';
$this->item->company->parent     = new stdClass();
$this->item->company->parent->id = $this->item->id;
$this->item->company             = NerudasK2Helper::getRelatedItem($this->item->company);
if ($this->item->company)
{
	$this->item->title = $this->item->company->title . ': ' . $this->item->title;
}
?>

<div id="item-<?php echo $this->item->id; ?>" class="item uk-invisible" itemscope itemtype="http://schema.org/Article">
	<div class="date uk-text-muted uk-text-right">

	</div>
	<div class="uk-grid uk-grid-small">
		<div class="uk-width-xsmall-1-2 uk-width-small-1-3 uk-width-medium-1-4 uk-width-large-1-4 uk-width-xlarge-1-4">
			<a class="image uk-thumbnail uk-display-block uk-cover-background" href="<?php echo $this->item->link; ?>"
			   style="background-image: url('<?php echo $this->item->image; ?>');"
			   data-uk-tooltip="pos:'bottom-left', cls:'big'" title="<?php echo $this->item->title; ?>">
			</a>
		</div>
		<div class="uk-width-xsmall-1-2 uk-width-small-2-3 uk-width-medium-3-4 uk-width-large-3-4 uk-width-xlarge-3-4">
			<h3 class="uk-margin-small-bottom">
				<a href="<?php echo $this->item->link; ?>" class="uk-link-muted">
					<?php echo $this->item->title; ?>
				</a>
			</h3>
			<div><?php echo $this->item->mintext; ?></div>
			<div class="uk-grid uk-grid-small uk-margin-small-top" data-uk-grid-match="">
				<div class="uk-width-xsmall-1-1 uk-width-small-1-2 uk-width-medium-1-2 uk-width-large-1-2 uk-width-xlarge-1-2 uk-vertical-align">
					<div class="uk-claerfix uk-vertical-align-middle ">
						<span class="uk-margin-small-right">
							<i class="uk-icon-justify uk-icon-small uk-icon-clock-o"></i>
							<?php echo JHTML::_('date', $this->item->created, 'd F'); ?>
						</span>
						<span class="uk-margin-small-right">
							<i class="uk-icon-justify uk-icon-small uk-icon-eye"></i>
							<?php echo $this->item->hits; ?>
						</span>
						<span class="uk-margin-small-right">
							<i class="uk-icon-justify uk-icon-small uk-icon-comments"></i>
							<?php echo $this->item->numOfComments; ?>
						</span>
					</div>
				</div>
				<div class="uk-width-xsmall-1-1 uk-width-small-1-2 uk-width-medium-1-2 uk-width-large-1-2 uk-width-xlarge-1-2 uk-vertical-align uk-text-right">
					<div class="uk-vertical-align-middle">
						<a class="uk-button" href="<?php echo $this->item->link; ?>">
							<?php echo JText::_('NERUDAS_READMORE'); ?>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="hidden-microdata">
		<div itemprop="name">
			<?php echo $this->item->title; ?>
			<img src="<?php echo $this->item->image; ?>" alt="<?php echo $this->item->title; ?>" itemprop="image"/>
		</div>
	</div>
	<hr class="uk-article-divider uk-width-1-1">
</div>
