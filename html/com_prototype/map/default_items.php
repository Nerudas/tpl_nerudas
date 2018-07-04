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

use Joomla\CMS\Language\Text;
use Joomla\CMS\Factory;
use Joomla\Registry\Registry;

?>
<?php if ($this->items): ?>
	<?php foreach ($this->items as $item):
		$text = '';
		if (!empty($item->extra->get('why_you')))
		{
			$text = $item->extra->get('why_you');
		}
		if (!empty($item->extra->get('comment')))
		{
			$text = $item->extra->get('comment');
		}
		$text = JHtmlString::truncate($text, 50, false, false);

		$catFields = new Registry($item->category->get('fields'));

		$price_type = false;
		if ($catFields->get('price_m3') && $catFields->get('price_t'))
		{
			$price_type = $this->extra_filter->get('price_m3t', 'm3');
		}
		if ($catFields->get('price_h') && $catFields->get('price_s'))
		{
			$price_type = $this->extra_filter->get('price_hs', 'h');
		}
		if ($catFields->get('price_o'))
		{
			$price_type = 'o';
		}

		$onModeration = (!$item->state || ($item->publish_down !== '0000-00-00 00:00:00' && $item->publish_down < Factory::getDate()->toSql()));
		?>
		<div class="item" data-show="false" data-prototype-item="<?php echo $item->id; ?>">
			<a class="uk-link-muted uk-display-block  uk-padding"
			   data-prototype-show="<?php echo $item->id; ?>">
				<div class="title uk-grid uk-grid-small">
					<div class="uk-width-medium-<?php echo ($price_type) ? '3-5' : '1-1'; ?>">
						<div class=" uk-text-medium">
							<?php echo $item->title; ?>
						</div>
						<div class="uk-text-small uk-text-muted">
							<?php if ($item->category->get('parent_level') > 1): ?>
								<span><?php echo $item->category->get('parent_title'); ?> </span>
							<?php endif; ?>
							<span><?php echo $item->category->get('title'); ?></span>
						</div>
					</div>
					<?php if ($price_type): ?>
						<div class="uk-width-medium-2-5 uk-text-right">
							<div class="price uk-margin-small-top">
								<div>
									<span class="uk-text-bold">
										<?php echo $item->extra->get('price_' . $price_type, '---'); ?>
									</span>
									<span class="uk-text-mini uk-text-muted uk-text-uppercase">
										<?php echo Text::_('TPL_NERUDAS_PRICE_TYPE_RUB')
											. '/' . Text::_('TPL_NERUDAS_PRICE_TYPE_' . $price_type); ?>
									</span>
								</div>
							</div>
						</div>
					<?php endif; ?>
				</div>

				<div class="text uk-text-small uk-margin-small-top">
					<?php echo $text; ?>
				</div>
				<?php if ($onModeration) : ?>
					<div class="uk-margin-small-top">
						<span class="uk-badge uk-badge-danger">
							<?php echo Text::_('TPL_NERUDAS_ONMODERATION'); ?>
						</span>
					</div>
				<?php endif; ?>
			</a>
		</div>
	<?php endforeach; ?>
<?php endif; ?>
<script>
	jQuery('time.timeago').timeago();
</script>