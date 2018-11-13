<?php
/**
 * @package    Nerudas Template
 * @version    4.9.33
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Uri\Uri;

$user = Factory::getUser();
?>

<?php if ($user->guest): ?>
	<a href="#mdoalLogin" data-uk-modal="{center:true}">
		<div class="uk-avatar-30 uk-flex uk-flex-middle uk-flex-center">
			<i class="uk-icon-sign-in uk-icon-small"></i>
		</div>
	</a>
<?php else:
	jimport('joomla.filesystem.folder');
	$folder = 'images/profiles/' . $user->id;
	$files  = JFolder::files(JPATH_ROOT . '/' . $folder, 'avatar', false);
	$avatar = (!empty($files[0])) ? $folder . '/' . $files[0] : 'media/com_profiles/images/no-avatar.jpg';
	$avatar = Uri::root(true) . '/' . $avatar;
	?>
	<a>
		<div class="uk-avatar-30" style="background-image: url('<?php echo $avatar; ?>');">
		</div>
		<i class="uk-icon-caret-down uk-margin-small-left"></i>
	</a>
	<div class="uk-dropdown uk-dropdown-navbar">
		<ul class="uk-nav uk-nav-navbar new">
			<?php
			foreach ($list as $i => &$item)
			{
				if ($item->type !== 'separator')
				{
					echo '<li>';
					echo '<a href="' . htmlspecialchars($item->flink) . '">' . $item->title . '</a>';
					echo '</li>';
				}
				else
				{
					echo '<li class="uk-nav-divider"></li>';
				}
			}
			?>
		</ul>
	</div>
<?php endif; ?>
