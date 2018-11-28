<?php
/**
 * @package    Prototype Component
 * @version    4.9.35
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;

extract($displayData);
?>
<script>
	(function ($) {
		$(document).ready(function () {
			setDesctHeight();

			$('[name="jform[payment]"]:radio').change(function () {
				seletctTarif();
			});
			$('[name="jform[payment]"]:radio').on('click', function () {
				seletctTarif();
			});
			$('[name="jform[payment]"]:radio').on('change', function () {
				seletctTarif();
			});
			$('body').on('change', '[name="jform[payment]"]:radio', function () {
				$('[name="jform[payment]"]:radio').change(function () {
					seletctTarif();
				});
			});
			seletctTarif();

			function seletctTarif() {
				var payment = $('[data-prototype-form="author"]').find('[data-author-phones="payment"]'),
					free = $('[data-prototype-form="author"]').find('[data-author-phones="free"]'),
					value = $('[name="jform[payment]"]:checked').val();

				$('[name="jform[payment]"]').closest('label').removeClass('active');

				$('[name="jform[payment]"]:checked').closest('label').addClass('active');
			}

			var maxHeight = 0;
			$('#<?php echo $id; ?>').find('.description').each(function (d, desc) {
				if ($(desc).innerHeight() > maxHeight) {
					maxHeight = $(desc).innerHeight();
				}

				console.log(maxHeight);
			});
			$('#<?php echo $id; ?>').find('.description').innerHeight(maxHeight);
		});




	})(jQuery);
</script>
<div id="<?php echo $id; ?>" class="uk-margin-bottom uk-margin-top">
	<div class="uk-h2 uk-margin-bottom uk-margin-top"><?php echo Text::_('COM_PROTOTYPE_ITEM_PAYMENT'); ?></div>
	<div class="uk-grid uk-grid-small" data-uk-grid-margin data-uk-grid-match="{target:'.uk-panel'}">
		<?php foreach ($options as $i => $option) : ?>
			<div class="uk-width-medium-1-3">
				<label for="<?php echo $id . '_' . $i; ?>"
					   class="uk-panel uk-panel-box uk-display-block uk-margin-small-bottom"
					   data-prototype-form-tariff>
					<div class="title tariff uk-h3 uk-flex uk-flex-wrap uk-flex-middle  uk-padding-left uk-padding-right">
						<input type="radio" id="<?php echo $id . '_' . $i; ?>" name="<?php echo $name; ?>"
							   class="uk-hidden"
							   value="<?php echo $option['value']; ?>" <?php echo $option['checked'] ? 'checked="checked"' : ''; ?>/>
						<strong class="uk-display-inline-block"><?php echo $option['title']; ?></strong>
					</div>
					<hr>
					<div class="description uk-hidden-small uk-text-muted uk-margin-top uk-margin-bottom uk-padding-left uk-padding-right">
						<?php echo nl2br($option['description']); ?>
					</div>
					<div class="short uk-hidden-medium uk-hidden-large uk-text-muted uk-margin-top uk-margin-bottom uk-padding-left uk-padding-right">
						<?php echo nl2br($option['short']); ?>
					</div>
					<div class="price uk-padding-left uk-padding-right">
						<strong><?php echo $option['price']; ?></strong>
					</div>

					<div class="uk-button uk-margin-top  uk-button-large uk-width-1-1">
						<?php echo Text::_('TPL_NERUDAS_ACTIONS_SELECT'); ?>
					</div>
				</label>
			</div>
		<?php endforeach; ?>
	</div>
</div>