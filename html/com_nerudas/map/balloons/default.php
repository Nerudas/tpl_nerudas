<?php
/**
 * @package     JoomlaZen Nerudas Template
 * @version     4.3
 * @author      JoomlaZen - www.joomlazen.com
 * @copyright   Copyright (c) 2016 - 2016 JoomlaZen. All rights reserved.
 * @license     GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */
defined('_JEXEC') or die('Restricted access');
$app = JFactory::getApplication();
?>
<script>
	(function($){
		function setRatioHeight() {
			$($('[data-ratio-height]')).each(function () {
				var data = $(this).data('ratio-height');
				var width = data[0];
				var height = data[1];
				$(this).height(Math.round(($(this).width()/width)*height));	

			});
		}
		$(document).ready(function() {
			setRatioHeight();	
		});
		$(window).resize(function () {
			setRatioHeight();
		});
	})(jQuery);
</script>
<div class="itemlist uk-margin-right">
	<?php foreach ($this->items as $item): 
		$item->author = NerudasProfilesHelper::getProfile($item->created_by);
		if (!isset($item->image)) {
			$item->image = '/templates/'.$app->getTemplate().'/images/noimages/'.$item->catid.'.jpg';
			if(isset($item->extra['ds_tech']->noimageS) || isset($item->extra['ds_nerud']->noimageS) || isset($item->extra['ds_prod']->noimageS) ||  isset($item->extra['ds_usl']->noimageS)) {
				$item->image = str_replace('.jpg', 's.jpg', $item->image);
			}
		}
	?>
	<div class="item">
		<div class="uk-grid uk-grid-small">
			<div class="uk-width-xsmall-1-1 uk-width-small-1-3 uk-width-medium-1-4 uk-width-large-1-5 uk-width-xlarge-1-6">
				<a class="image uk-thumbnail uk-display-block uk-cover-background"  href="<?php echo $item->link; ?>" style="background-image: url('<?php echo $item->image; ?>');" target="_blank" data-ratio-height="[4,3]">
				</a>
			</div>
			<div class="uk-width-xsmall-1-1 uk-width-small-2-3 uk-width-medium-3-4 uk-width-large-4-5 uk-width-xlarge-5-6">
				<div class="uk-clearfix">
					<a href="<?php echo $item->link; ?>" class="uk-text-mlarge " target="_blank">
						<?php echo $item->title; ?>
					</a>
					<span class="uk-float-right uk-text-muted">
						<?php echo JHTML::_('date', $item->publish_up, 'd F Y'); ?>
					</span>
				</div>
				<div class="category">
					<a href="<?php echo $item->category->link; ?>" class="uk-text-muted">
						<?php if ($item->region) :?>
						<?php echo $item->region->name; ?> /
						<?php endif; ?>
						<?php echo $item->category->name; ?>
					</a>
				</div>
				<div>
					<?php echo NerudasUtility::minimalizeText($item->introtext); ?>
				</div>
				<div class="uk-clearfix uk-margin-small-top">
					<div class="uk-float-left">
						<div class="author">
							<div class="avatar uk-float-left  uk-margin-small-right">
								<a class="uk-text-middle uk-avatar-48 <?php echo $item->author->status; ?>" href="<?php echo $item->author->link; ?>"  style="background-image: url('<?php echo $item->author->avatar->small; ?>');">
								</a>
							</div>
							<div class="desc uk-display-inline-block uk-vertical-align" style=" height:48px;">							
								<div class="uk-vertical-align-middle">
									<div class="name">
										<a href="<?php echo $item->author->link; ?>">
											<?php echo $item->author->name; ?>
										</a>
									</div>
									<?php if (isset($item->author->job) && !empty($item->author->job->name)):?>
									<div class="job">
										<a href="<?php echo $item->author->job->link; ?>" target="_blank" class="uk-link-muted">
											<?php echo $item->author->job->name; ?>
										</a>
									</div>
									<?php endif; ?>
								</div>
								
							</div>
						</div>
					</div>
					<div class="uk-float-right">
						<a href="<?php echo $item->link;?>" class="uk-button uk-button-success" target="_blank">
							<?php echo JText::_('NERUDAS_READMORE'); ?>
						</a>
					</div>
				</div>
			</div>
		</div>
		<hr class="uk-article-divider uk-width-1-1">
	</div>
	<?php endforeach; ?>
</div>
