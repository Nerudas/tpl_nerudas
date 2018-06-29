<?php
/**
 * @package    Nerudas Template
 * @version    4.9.18
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;
$app = JFactory::getApplication();
?>
<script>
	(function ($) {
		function setRatioHeight() {
			$($('[data-ratio-height]')).each(function () {
				var data = $(this).data('ratio-height');
				var width = data[0];
				var height = data[1];
				$(this).height(Math.round(($(this).width() / width) * height));

			});
		}

		$(document).ready(function () {
			setRatioHeight();
		});
		$(window).resize(function () {
			setRatioHeight();
		});
	})(jQuery);
</script>
<div class="itemlist uk-margin-right">
	<?php
	foreach ($this->items as $item):
		if (!isset($item->image))
		{
			$item->image = '/templates/' . $app->getTemplate() . '/images/noimages/' . $item->catid . '.jpg';
			if (isset($item->extra['ds_tech']->noimageS) || isset($item->extra['ds_nerud']->noimageS) || isset($item->extra['ds_prod']->noimageS) || isset($item->extra['ds_usl']->noimageS))
			{
				$item->image = str_replace('.jpg', 's.jpg', $item->image);
			}
		}
		?>
		<div class="item uk-margin-large-bottom">
			<div class="uk-grid uk-grid-small">
				<div class="uk-width-xsmall-1-1 uk-width-small-1-3 uk-width-medium-1-4">
					<a class="image uk-thumbnail uk-display-block uk-cover-background" href="<?php echo $item->link; ?>"
					   style="background-image: url('<?php echo $item->image; ?>');" target="_blank"
					   data-ratio-height="[4,3]">
					</a>
				</div>
				<div class="uk-width-xsmall-1-1 uk-width-small-2-3 uk-width-medium-3-4">
					<div class="uk-clearfix uk-margin-bottom">
						<a href="<?php echo $item->link; ?>" class="uk-text-xlarge " target="_blank">
							<?php echo $item->title; ?>
						</a>
					</div>
					<div class="uk-text-medium">
						<?php echo $item->introtext ?>
					</div>
				</div>
			</div>
		</div>
	<?php endforeach; ?>
</div>
