<?
/**
 * @package    Nerudas Template
 * @version    4.9.17
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;

$item  = $displayData;
$title = $item->get('title', $item->get('item_title'));
$image = $item->get('image', false);
$link  = $item->get('link');

?>

<div class="item related uk-width-medium-1-3">
	<a href="<?php echo $link; ?>" class="uk-link-muted">
		<?php if ($image): ?>
			<img src="<?php echo $image; ?>" alt="<?php echo $title; ?>" class="uk-margin-small-bottom">
		<?php endif; ?>
		<div class="uk-h4 title">
			<?php echo $title; ?>
		</div>
	</a>
</div>