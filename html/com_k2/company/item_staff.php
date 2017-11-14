<?php
/**
 * @package    Nerudas Template
 * @version    4.9.1
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2017 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */
defined('_JEXEC') or die('Restricted access');
$app                             = JFactory::getApplication();
$doc                             = JFactory::getDocument();
$this->item->staff               = new stdClass();
$this->item->staff->get          = 'child';
$this->item->staff->parent       = new stdClass();
$this->item->staff->parent->id   = $this->item->id;
$this->item->staff->child        = new stdClass();
$this->item->staff->child->catid = 10;
$this->item->staff               = NerudasK2Helper::getRelatedItems($this->item->staff);
foreach ($this->item->staff as $key => $row)
{
	$this->item->staff[$key] = NerudasProfilesHelper::getProfile($row->created_by);
}
?>
<div class="uk-panel uk-panel-box uk-padding-top uk-padding-bottom uk-hidden">
	<h2 class="uk-text-large">
		<?php echo JText::_('NERUDAS_STAFF'); ?>
	</h2>
</div>
<hr class="uk-margin-remove uk-hidden">
<div class="uk-panel uk-panel-box">
	<ul class="uk-list uk-list-space">
		<?php foreach ($this->item->staff as $person): ?>
			<li class="person">
				<div class="author uk-clearfix uk-width-1-1">
					<div class="avatar uk-position-relative uk-display-inline-block uk-align-medium-left  uk-margin-bottom-remove">
						<a class="uk-text-middle uk-avatar-60 <?php echo $person->status; ?>"
						   href="<?php echo $person->link; ?>"
						   style="background-image: url('<?php echo $person->avatar->small; ?>')">
						</a>
					</div>
					<div class="text uk-text-ellipsis">
						<div class="name uk-text-ellipsis ">
							<a class="uk-link-muted" href="<?php echo $person->link; ?>" target="_blank">
								<?php echo $person->name; ?>
							</a>
						</div>
						<?php if ($person->job->post): ?>
							<div class="post uk-text-muted">
								<?php echo $person->job->post; ?>
							</div>
						<?php endif; ?>

					</div>
				</div>
			</li>
		<?php endforeach; ?>
	</ul>
</div>