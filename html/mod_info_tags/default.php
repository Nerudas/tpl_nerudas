<?php
/**
 * @package    Nerudas Template
 * @version    4.9.39
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;

?>
<?php if ($tags): ?>
	<div class="info-tags-module tags" data-uk-nav="">
		<?php foreach ($tags as $id => $item):
			$class = 'uk-tag item-' . $id;
			if ($item->active)
			{
				$class .= ' uk-tag-primary';
			}
			?>
			<a href="<?php echo $item->link; ?>" class="<?php echo $class; ?>"><?php echo $item->title; ?></a>
		<?php endforeach; ?>
	</div>
<?php endif; ?>
