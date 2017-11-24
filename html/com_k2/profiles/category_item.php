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
if ($this->item->extra_fields)
{
	$this->item->extra  = NerudasK2Helper::getItemExtra($this->item->extra_fields);
	$this->item->phones = NerudasK2Helper::getPhones($this->item->extra);
}
K2HelperUtilities::setDefaultImage($this->item, 'itemlist', $this->params);
if (empty($this->item->image))
{
	$this->item->image = '/templates/' . $app->getTemplate() . '/images/noimages/' . $this->item->catid . '.jpg';
}
$this->author        = NerudasProfilesHelper::getProfile($this->item->created_by);
$this->item->mintext = NerudasUtility::minimalizeText($this->item->introtext);
?>

<div id="k2item-<?php echo $this->item->id; ?>" class="item uk-margin-bottom">
	<div class="uk-panel uk-panel-box">
		<div class="contnent uk-toggle uk-margin-small-top">
			<div class="uk-grid" data-uk-grid-math>
				<div class="uk-width-medium-3-12">
					<div class="avatar uk-position-relative uk-display-block uk-height-1-1 uk-width-10-10 uk-container-center uk-text-center">
						<a class="image uk-avatar-full uk-width-9-10" data-ratio-height="[1,1]"
						   style="background-image: url('<?php echo $this->item->image; ?>');"
						   href="<<?php echo $this->item->title; ?>" target="_blank">
						</a>

					</div>
				</div>
				<div class="uk-width-medium-8-12">
					<div class="uk-position-relative uk-height-1-1">
						<h2 class="uk-margin-top-remove uk-text-ellipsis uk-text-large ">
							<a href="<?php echo $this->item->link; ?>" class="uk-link-muted uk-text-ellipsis "
							   title="<?php echo $this->item->mintext; ?>"
							   data-uk-tooltip="pos:'bottom-left', cls:'big'">
								<?php echo $this->item->title; ?>
							</a>
						</h2>
						<?php if (!empty($this->author->job->name)): ?>
							<div class="job uk-text-uppercase-letter uk-text-small">
								<a class="uk-text-muted" href="<<?php echo $this->author->job->link; ?>>"
								   target="_blank">
									<?php echo $this->author->job->name; ?>
								</a><br/>
								<?php if (!empty($this->item->extra['job_post']->value)): ?>
									<i class="uk-text-lowercase">(<?php echo $this->item->extra['job_post']->value; ?>
										)</i>
								<?php endif; ?>
							</div>
						<?php endif; ?>

						<?php if ($this->author->myStatus && !empty($this->author->myStatus->text)): ?>
							<blockquote class="uk-text-primary uk-text-medium">
								<?php echo $this->author->myStatus->text; ?>
							</blockquote>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>