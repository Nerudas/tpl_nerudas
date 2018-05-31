<?php
/**
 * @package    Nerudas Template
 * @version    4.9.13
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;
$app = JFactory::getApplication();
$doc = JFactory::getDocument();
$doc->addScriptDeclaration("
	function setRegion(id) {
		(function($){
			UIkit.modal('#regionSelect').hide();
			$.cookie('region', id, {expires: 365, path: '/' });
			 location.reload();
		})(jQuery);
	}
");
$level0 = ModRegionSelectHelper::getChildren($all['100'], $rows = $all);
?>
<div id="regionSelect" class="uk-modal">
	<div class="uk-modal-dialog uk-modal-dialog-large">
		<a class="uk-modal-close uk-close">
		</a>
		<div class="uk-h4 uk-modal-header">
			<?php echo JText::_('NERUDAS_REGION_SELECT_TITLE'); ?>
		</div>
		<div class="uk-modal-contnet-large">
			<div class="uk-grid uk-grid-small">
				<div class="uk-width-xsmall-1-1 uk-width-small-2-5 uk-width-medium-1-3 uk-width-large-1-4 uk-width-xlarge-1-4 uk-hidden-xsmall">
					<ul id="regionSelectFilter" class="uk-nav uk-nav-side" data-uk-tab="{connect:'#regionsTabs'}">
						<li>
							<a href="#" id="openRegionSelect">
								<?php echo JText::_('JALL'); ?>
							</a>
						</li>
						<?php foreach ($level0 as $group): ?>
							<li>
								<a href="">
									<?php echo $group->title; ?>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
				<div class="uk-width-xsmall-1-1 uk-width-small-3-5 uk-width-medium-2-3 uk-width-large-3-4 uk-width-xlarge-3-4">
					<div id="regionsTabs" class="uk-switcher">

						<div class="all" data-uk-grid>

							<?php foreach ($level0 as $group): ?>
								<div class="uk-width-1-1 uk-width-small-1-1 uk-width-medium-1-4 uk-width-large-1-3 uk-width-xlarge-1-3">
									<div class="uk-margin-right uk-margin-bottom uk-margin-left">
										<div class="uk-text-medium">
											<a class="uk-link-muted" data-set-region="<?php echo $group->id; ?>"
											   title="<?php echo JText::sprintf('NERUDAS_REGION_SELECT_CHANGE_TO', $group->title); ?>"
											   data-uk-tooltip>
												<strong><?php echo $group->title; ?></strong>
											</a>
										</div>
										<div class="uk-grid uk-grid-collapse uk-margin-small-top">

											<?php foreach (ModRegionSelectHelper::getChildren($all[$group->id], $rows = $all) as $region): ?>

												<div class="uk-width-1-2 uk-width-small-1-4 uk-width-medium-1-5">
													<a class="uk-display-block uk-margin-small-bottom uk-margin-small-right"
													   data-set-region="<?php echo $region->id; ?>"
													   title="<?php echo JText::sprintf('NERUDAS_REGION_SELECT_CHANGE_TO', $region->title); ?>"
													   data-uk-tooltip>
														<img src="/templates/nerudas/images/regions/<?php echo $region->id; ?>.png"
															 alt="<?php echo $region->title; ?>" class="uk-width-1-1">
													</a>
												</div>
											<?php endforeach; ?>

										</div>
									</div>
								</div>
							<?php endforeach; ?>
							<div class="uk-width-1-1 uk-width-small-1-1 uk-width-medium-1-4 uk-width-large-1-3 uk-width-xlarge-1-3">
								<div class="uk-margin-right uk-margin-bottom uk-margin-left">
									<div class="uk-text-medium">
										<a class="uk-link-muted" data-set-region="<?php echo $all['100']->id; ?>"
										   title="<?php echo JText::sprintf('NERUDAS_REGION_SELECT_CHANGE_TO', $all['100']->title); ?>"
										   data-uk-tooltip>
											<strong><?php echo $all['100']->title; ?></strong>
										</a>
									</div>
									<div class="uk-grid uk-grid-collapse uk-margin-small-top">

										<?php foreach (ModRegionSelectHelper::getChildren($all['100'], $rows = $all) as $region): ?>
											<div class="uk-width-1-2 uk-width-small-1-4 uk-width-medium-1-5">
												<a class="uk-display-block uk-margin-small-bottom uk-margin-small-right"
												   data-set-region="<?php echo $region->id; ?>"
												   title="<?php echo JText::sprintf('NERUDAS_REGION_SELECT_CHANGE_TO', $region->title); ?>"
												   data-uk-tooltip>
													<img src="/templates/nerudas/images/regions/<?php echo $region->id; ?>.png"
														 alt="<?php echo $region->title; ?>" class="uk-width-1-1">
												</a>
											</div>
										<?php endforeach; ?>
										<div class="uk-width-1-2 uk-width-small-1-4 uk-width-medium-1-5">
											<a class="uk-display-block uk-margin-small-bottom uk-margin-small-right"
											   data-set-region="<?php echo $all['100']->id; ?>"
											   title="<?php echo JText::sprintf('NERUDAS_REGION_SELECT_CHANGE_TO', $all['100']->title); ?>"
											   data-uk-tooltip>
												<img src="/templates/nerudas/images/regions/<?php echo $all['100']->id; ?>.png"
													 alt="<?php echo $all['100']->title; ?>" class="uk-width-1-1">
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php foreach ($level0 as $group): ?>
							<div class="group-<?php echo $group->id; ?>">
								<div class="uk-text-medium">
									<a class="uk-link-muted" data-set-region="<?php echo $group->id; ?>"
									   title="<?php echo JText::sprintf('NERUDAS_REGION_SELECT_CHANGE_TO', $group->title); ?>"
									   data-uk-tooltip>
										<strong><?php echo $group->title; ?></strong>
									</a>
								</div>
								<div class="uk-margin-top">
									<?php foreach (ModRegionSelectHelper::getChildren($all[$group->id], $rows = $all) as $region): ?>
										<div class="uk-clearfix">
											<a class="uk-display-inline-block uk-margin-bottom uk-margin-small-right"
											   data-set-region="<?php echo $region->id; ?>"
											   title="<?php echo JText::sprintf('NERUDAS_REGION_SELECT_CHANGE_TO', $region->title); ?>"
											   data-uk-tooltip>
												<img src="/templates/nerudas/images/regions/<?php echo $region->id; ?>.png"
													 alt="<?php echo $region->title; ?>"
													 class="uk-align-medium-left uk-margin-small-right uk-margin-bottom-remove">
												<span class="uk-text-middle uk-link-muted">
											<?php echo $region->title; ?>
										</span>
											</a>
										</div>
									<?php endforeach; ?>
								</div>
							</div>
						<?php endforeach; ?>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>