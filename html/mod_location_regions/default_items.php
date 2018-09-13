<?php
/**
 * @package    Nerudas Template
 * @version    4.9.26
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;

$children = array();

foreach ($items as $item)
{
	if (!isset($children[$item->parent_id]))
	{
		$children[$item->parent_id] = array();

	}
	if ($item->default)
	{
		$default = $item;
	}
	$children[$item->parent_id][$item->id] = $item;
}
$others = $children[$default->id] + $children[-1];
?>
<div class="uk-grid">
	<?php foreach ($children[$default->id] as $parent) : ?>
		<div class="uk-width-medium-1-4 uk-margin-bottom">
			<div class="uk-text-medium">
				<a data-location-set-region="<?php echo $parent->id; ?>" class="uk-link-muted">
					<strong><?php echo $parent->name; ?></strong>
				</a>
			</div>
			<div class="uk-grid uk-grid-small uk-margin-small-top" data-uk-grid-margin>
				<?php foreach ($children[$parent->id] as $region) : ?>
					<div class="uk-width-medium-1-4">
						<a data-location-set-region="<?php echo $region->id; ?>"
						   class="uk-link-muted uk-display-block uk-text-center">
							<img src="<?php echo $region->icon; ?>" alt="<?php echo $region->name; ?>">
						</a>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	<?php endforeach; ?>
	<div class="uk-width-medium-1-4 uk-margin-bottom">
		<div class="uk-text-medium">
			<a data-location-set-region="<?php echo $default->id; ?>" class="uk-link-muted">
				<strong><?php echo $default->name; ?></strong>
			</a>
		</div>
		<div class="uk-grid uk-grid-small uk-margin-small-top" data-uk-grid-margin>
			<?php foreach ($others as $region) : ?>
				<div class="uk-width-medium-1-4">
					<a data-location-set-region="<?php echo $region->id; ?>"
					   class="uk-link-muted uk-display-block uk-text-center">
						<img src="<?php echo $region->icon; ?>" alt="<?php echo $region->name; ?>">
					</a>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>


