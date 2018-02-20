<?php
/**
 * @package    Nerudas Template
 * @version    4.9.6
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;
?>

<div class="profile">
	<div class="bg">
		<div class="image" style="background-image:url('<?php echo $profile->avatar->medium; ?>');">
		</div>
		<div class="mask">
		</div>
	</div>
	<div class="user uk-clearfix uk-contrast">
		<div class="avatar uk-position-relative uk-display-inline-block uk-align-medium-left  uk-margin-bottom-remove">
			<a class="image uk-avatar-48 " style="background-image: url('<?php echo $profile->avatar->small; ?>');"
			   href="<?php echo $profile->link; ?>" target="_blank">
			</a>
			<?php if ($user->guest): ?>
				<i class="uk-position-bottom-right <?php echo $profile->state->icon; ?>"
				   title="<?php echo $profile->state->label; ?>" data-uk-tooltip></i>
			<?php else: ?>
				<a class="uk-position-bottom-right <?php echo $profile->state->icon; ?>"
				   title="<?php echo $profile->state->label; ?>" data-uk-tooltip
				   data-uk-toggle="{target:'#changeUserstate'}">
				</a>
			<?php endif; ?>
		</div>
		<div class="text uk-vertical-align">
			<div class="uk-vertical-align-middle">
				<div class="name">
					<a class="uk-link-muted" href="<?php echo $profile->link; ?>" target="_blank">
						<?php echo $profile->name; ?>
					</a>
				</div>
				<?php if ($profile->job): ?>
					<div class="job uk-text-uppercase-letter uk-text-small">
						<a class="" href="<?php echo $profile->job->link; ?>" target="_blank">
							<?php echo $profile->job->name; ?>
						</a>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
<?php
if ($user->guest)
{
	require JModuleHelper::getLayoutPath('mod_profile', 'default_login');
}
else
{
	require JModuleHelper::getLayoutPath('mod_profile', 'default_logout');
}
?>
