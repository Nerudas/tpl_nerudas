<?php
/**
 * @package    Nerudas Template
 * @version    5.0.0
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2017 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;

$user      = Factory::getUser();
?>

<?php if ($user->guest): ?>
	<a data-uk-toggle="target: #login">
		<div class="nerudas-avatar-32 empty">
			<i data-uk-icon="icon: lock; ratio: 1"></i>
		</div>
	</a>
<?php else:
	jimport('joomla.filesystem.folder');
	$folder = 'images/users/' . $user->id;
	$files = JFolder::files($folder, 'avatar', false);
	if (empty($files[0]))
	{
		$folder = 'images/users/0';
		$files  = JFolder::files($folder, 'avatar', false);
	}
	$avatar = $folder . '/' . $files[0];
	?>
	<a>
		<div class="nerudas-avatar-32">
			<?php echo HTMLHelper::_('image', $avatar, $user->name,
				array('title' => $user->name, 'data-uk-cover' => ''), false); ?>
		</div>
		<i class="uk-margin-small-left" data-uk-icon="icon: chevron-down; ratio: 0.8"></i>
	</a>
	<div data-uk-dropdown="mode: click; pos: bottom-right">
		<ul class="uk-nav uk-dropdown-nav">
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