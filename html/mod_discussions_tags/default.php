<?php
/**
 * @package    Nerudas Template
 * @version    4.9.40
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;

?>
<?php if ($tags): ?>
	<ul class="discussions-tags-module uk-nav uk-nav-side uk-nav-parent-icon new" data-uk-nav="">
		<?php foreach ($tags as $id => $item):
			$class = 'item-' . $id;
			if ($item->active)
			{
				$class .= ' uk-active';
			}
			?>
			<li class="<?php echo $class; ?>">
				<a href="<?php echo $item->link; ?>"><?php echo $item->title; ?></a>
			</li>
		<?php endforeach; ?>
	</ul>
<?php endif; ?>
