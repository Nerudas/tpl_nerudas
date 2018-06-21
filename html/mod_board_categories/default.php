<?php
/**
 * @package    Nerudas Template
 * @version    4.9.15
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;


?>
<?php if ($categories): ?>
	<ul class="board-categories-module uk-nav uk-nav-side uk-nav-parent-icon new" data-uk-nav="">
		<?php foreach ($root as $id => $item):
			$parent = (!empty($children[$id]));
			$class = 'item-' . $id;
			if ($item->active)
			{
				$class .= ' uk-active';
			}
			if ($parent)
			{
				$class .= '  uk-parent';
				if ($item->activeParent)
				{
					$class .= ' uk-active uk-active-parent';
				}
			}
			?>
			<li class="<?php echo $class; ?>">
				<a href="<?php echo $item->link; ?>"><?php echo $item->title; ?></a>
				<?php if ($parent) : ?>
					<ul class="submenu uk-nav-sub level-<?php echo($item->level + 1); ?> ">
						<?php foreach ($children[$id] as $child): ?>
							<li class="item-<?php echo $child->id; ?><?php echo ($child->active) ? ' uk-active' : ''; ?>">
								<a href="<?php echo $child->link; ?>"><?php echo $child->title; ?></a>
							</li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
			</li>
		<?php endforeach; ?>
		<?php if ($all): ?>
			<li><a href="<?php echo $allLink; ?>"><?php echo $all; ?></a></li>
		<?php endif; ?>
	</ul>
<?php endif; ?>

