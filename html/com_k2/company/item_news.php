<?php
/**
 * @package    Nerudas Template
 * @version    4.9.1
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2017 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */
defined( '_JEXEC' )or die( 'Restricted access' );
$app = JFactory::getApplication();
$doc = JFactory::getDocument();
$this->item->news = new stdClass();
$this->item->news->get = 'parent';
$this->item->news->child =  new stdClass();
$this->item->news->child->id = $this->item->id;
$this->item->news->parent =  new stdClass();
$this->item->news->parent->catid = 342;
$this->item->news->limit = 10;
$this->item->news = NerudasK2Helper::getRelatedItems($this->item->news);
?>
<?php if (($this->user && $this->user->job && $this->user->job->id == $this->item->id) || NerudasProfilesHelper::getPermissions(JFactory::getUser())->moderator) :?>
<div class="uk-text-right">
	<a class="uk-button uk-button-success" href="/forms/news-company">
		<?php echo JText::_('NERUDAS_ADD_NEWS'); ?>
	</a>
</div>
<?php endif; ?>
<div class="itemlist">
	<?php foreach ($this->item->news as $news): 
		$news->mintext = NerudasUtility::minimalizeText($news->introtext);	
	?>
	<div id="item-<?php echo $news->id; ?>" class="item">
		<div class="date uk-text-muted uk-text-right">
		</div>
		<div class="uk-grid uk-grid-small">
			<div class="uk-width-xsmall-1-2 uk-width-small-1-3 uk-width-medium-1-4 uk-width-large-1-4 uk-width-xlarge-1-4">
				<a class="image uk-thumbnail uk-display-block uk-cover-background"  href="<?php echo $news->url; ?>"data-uk-tooltip="pos:'bottom-left', cls:'big'" title="<?php echo $news->title;?>">
					<img src="<?php echo $news->image; ?>" alt="<?php echo $news->title; ?>" />
				</a>
			</div>
			<div class="uk-width-xsmall-1-2 uk-width-small-2-3 uk-width-medium-3-4 uk-width-large-3-4 uk-width-xlarge-3-4">
				<div class="uk-h3 uk-margin-small-bottom">
					<a href="<?php echo $news->url; ?>" class="uk-link-muted"> 
						<?php echo $news->title; ?>
					</a>
				</div>
				<div><?php echo $news->mintext;?></div>	
				<div class="uk-grid uk-grid-small uk-margin-small-top" data-uk-grid-match="">
					<div class="uk-width-xsmall-1-1 uk-width-small-1-2 uk-width-medium-1-2 uk-width-large-1-2 uk-width-xlarge-1-2 uk-vertical-align">
						<div class="uk-claerfix uk-vertical-align-middle ">
							<span class="uk-margin-small-right">
								<i class="uk-icon-justify uk-icon-small uk-icon-clock-o"></i>
								<?php echo JHTML::_('date', $news->created, 'd F'); ?>
							</span>
						</div>
					</div>
					<div class="uk-width-xsmall-1-1 uk-width-small-1-2 uk-width-medium-1-2 uk-width-large-1-2 uk-width-xlarge-1-2 uk-vertical-align uk-text-right">
						<div class="uk-vertical-align-middle">
							<a class="uk-button" href="<?php echo $news->url; ?>">
								<?php echo JText::_('NERUDAS_READMORE'); ?>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>

		<hr class="uk-article-divider uk-width-1-1">
	</div>
	<?php endforeach;?>
</div>
<?php if (count($this->item->news) > 1): ?>
	<div class="uk-text-right">
		<a href="/news/company.html?filter=true&related=<?php echo $this->item->id; ?>" class="uk-text-mlarge uk-link-muted uk-text-uppercase">
			<?php echo JText::_('NERUDAS_ALL_COMPANY_NEWS'); ?> <i class="uk-icon-angle-double-right uk-icon-small"></i>
		</a>
	</div>
<?php endif;?>