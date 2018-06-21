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

use Joomla\CMS\Language\Text;

?>

<?php if ($this->items): ?>
	<?php foreach ($this->items as $item): ?>
		<div class="item" data-show="false" data-prototype-item="<?php echo $item->id; ?>">
			<a class="uk-link-muted uk-display-block  uk-padding"
			   data-prototype-show="<?php echo $item->id; ?>">
				<div class="uk-text-medium"><?php echo $item->title; ?></div>
				<?php if (!empty($item->extra->get('price'))): ?>
					<div class="uk-text-bold">
						<?php echo $item->extra->get('price'). ' '. Text::_('JGLOBAL_FIELD_PRICE_CURRENCY_RUB'); ?>
					</div>
				<?php endif; ?>
				<?php if (!empty($item->extra->get('why_you'))): ?>
					<div class="uk-text-muted uk-text-small">
						<?php echo JHtmlString::truncate($item->extra->get('why_you'), 50, false, false); ?>
					</div>
				<?php endif; ?>
			</a>
		</div>
	<?php endforeach; ?>
<?php endif; ?>
<script>
	jQuery('time.timeago').timeago();
</script>


