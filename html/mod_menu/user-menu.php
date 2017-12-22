<?php

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;


$user = Factory::getUser();

///
//NerudasProfilesHelper::getProfile($this->item-

//echo '<pre>', print_r('aaa', true), '</pre>';
//<div class="uk-avatar-30"  style="background-image: url('/templates/nerudas/images/noimages/10.jpg');">
//
//	</div>
?>


<?php if ($user->guest): ?>
	<a href="#login" data-uk-modal="{center:true}">
		<div class="uk-avatar-30 uk-flex uk-flex-middle uk-flex-center">
			<i class="uk-icon-sign-in uk-icon-small"></i>
		</div>
	</a>
<?php else:
	$profile = NerudasProfilesHelper::getProfile($user->id); ?>
	<a>
		<div class="uk-avatar-30" style="background-image: url('<?php echo $profile->avatar->small; ?>');">
		</div>
	</a>
	<div class="uk-dropdown uk-dropdown-navbar">
		<ul class="uk-nav uk-nav-navbar new">
			<?php
			foreach ($list as $i => &$item)
			{
				if ($item->level == 1 && $item->type !== 'separator')
				{
					echo '<li>';
					echo '<a href="' . htmlspecialchars($item->flink) . '">' . $item->title . '</a>';
					echo '</li>';
				}
				elseif ($item->level == 1 && $item->type == 'separator')
				{
					echo '<li class="uk-nav-divider"></li>';
				}
			}
			?>
		</ul>
	</div>

<?php endif; ?>
