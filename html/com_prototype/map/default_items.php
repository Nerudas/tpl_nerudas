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
		$catFields = new Registry($item->category->get('fields')); ?>
		<div class="item" data-show="false" data-prototype-item="<?php echo $item->id; ?>">
			<a class="uk-link-muted uk-display-block  uk-padding"
			   data-prototype-show="<?php echo $item->id; ?>">
				<div class="uk-text-medium">
					<?php echo $item->title; ?>
				</div>
				<?php if (!$item->state || ($item->publish_down !== '0000-00-00 00:00:00' &&
						$item->publish_down < Factory::getDate()->toSql())): ?>
					<div>
						<span class="uk-badge uk-badge-danger">
							<?php echo Text::_('TPL_NERUDAS_ONMODERATION'); ?>
						</span>
					</div>
				<?php endif; ?>
				<div class="uk-text-small uk-margin-small-bottom">
					<?php if ($item->category->get('parent_id') > 1): ?>
						<span><?php echo $item->category->get('parent_title'); ?></span>
						<span> / </span>
					<?php endif; ?>
					<span><?php echo $item->category->get('title'); ?></span>
				</div>
				<?php if ($catFields->get('price_m3') && $catFields->get('price_t')): ?>
					<?php if ($this->extra_filter->get('price_m3t')):
						$price_type = $this->extra_filter->get('price_m3t');
						?>
						<div class="uk-text-bold">
							<?php echo $item->extra->get('price_' . $price_type, '---') . ' ' . Text::_('JGLOBAL_FIELD_PRICE_CURRENCY_RUB'); ?>
						</div>
					<?php else: ?>
						<div class="uk-text-bold">
							<span class="uk-margin-small-right">
								<?php echo $item->extra->get('price_m3', '..') . ' ' .
									Text::_('TPL_NERUDAS_PRICE_TYPE_RUB')
									. '/' . Text::_('TPL_NERUDAS_PRICE_TYPE_M3'); ?>
							</span>
							<span class="uk-margin-small-right">
								<?php echo $item->extra->get('price_t', '..') . ' ' .
									Text::_('TPL_NERUDAS_PRICE_TYPE_RUB')
									. '/' . Text::_('TPL_NERUDAS_PRICE_TYPE_T'); ?>
							</span>
						</div>
					<?php endif; ?>
				<?php endif; ?>
				<?php if (!empty($item->extra->get('price_o'))): ?>
					<div class="uk-text-bold">
						<?php echo $item->extra->get('price_o') . ' ' . Text::_('JGLOBAL_FIELD_PRICE_CURRENCY_RUB'); ?>
					</div>
				<?php endif; ?>
				<?php if ($catFields->get('price_h') && $catFields->get('price_s')): ?>
					<?php if ($this->extra_filter->get('price_hs')):
						$price_type = $this->extra_filter->get('price_hs');
						?>
						<div class="uk-text-bold">
							<?php echo $item->extra->get('price_' . $price_type, '---') . ' ' . Text::_('JGLOBAL_FIELD_PRICE_CURRENCY_RUB'); ?>
						</div>
					<?php else: ?>
						<div class="uk-text-bold">
							<span class="uk-margin-small-right">
								<?php echo $item->extra->get('price_h', '..') . ' ' .
									Text::_('TPL_NERUDAS_PRICE_TYPE_RUB')
									. '/' . Text::_('TPL_NERUDAS_PRICE_TYPE_H'); ?>
							</span>
							<span class="uk-margin-small-right">
								<?php echo $item->extra->get('price_s', '..') . ' ' .
									Text::_('TPL_NERUDAS_PRICE_TYPE_RUB')
									. '/' . Text::_('TPL_NERUDAS_PRICE_TYPE_S'); ?>
							</span>
						</div>
					<?php endif; ?>
				<?php endif; ?>
				<?php if (!empty($item->extra->get('why_you'))): ?>
					<div class="uk-text-muted uk-text-small">
						<?php echo JHtmlString::truncate($item->extra->get('why_you'), 50, false, false); ?>
					</div>
				<?php endif; ?>
				<?php if (!empty($item->extra->get('comment'))): ?>
					<div class="uk-text-muted uk-text-small">
						<?php echo JHtmlString::truncate($item->extra->get('comment'), 50, false, false); ?>
					</div>
				<?php endif; ?>
			</a>
		</div>
	<?php endforeach; ?>
<?php endif; ?>
<script>
	jQuery('time.timeago').timeago();
</script>