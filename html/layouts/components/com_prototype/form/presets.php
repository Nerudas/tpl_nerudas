<?php
/**
 * @package    Prototype Component
 * @version    4.9.37
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;

extract($displayData);

if(empty($presets)) return;

HTMLHelper::_('jquery.framework');
HTMLHelper::_('script', 'media/com_prototype/js/form-presets.min.js', array('version' => 'auto'));

?>
<div class="uk-margin-large-bottom  uk-panel uk-panel-box " data-prototype-form="presets" style="display: none;">
	<div class="uk-grid" data-uk-grid-margin data-uk-grid-match>

		<?php foreach ($presets as $preset): ?>
			<div class="uk-text-center uk-width-xsmall-1-3 uk-width-small-1-4 uk-width-medium-1-5 uk-width-large-1-5 uk-width-xlarge-1-5">
				<a data-preset="<?php echo $preset['key']; ?>"
				   data-preset-title="<?php echo $preset['title']; ?>"
				   data-preset-price="<?php echo $preset['price']; ?>"
				   data-preset-price_title="<?php echo $preset['price_title']; ?>"
				   data-preset-delivery="<?php echo $preset['delivery']; ?>"
				   data-preset-delivery_title="<?php echo $preset['delivery_title']; ?>"
				   data-preset-object="<?php echo $preset['object']; ?>"
				   data-preset-object_title="<?php echo $preset['object_title']; ?>"
				   class="uk-display-block uk-link-muted">
					<div>
						<?php if (!empty($preset['icon']))
						{
							echo HTMLHelper::_('image', $preset['icon'], $preset['title'], array('title' => $preset['title']));
						}
						?>
						<div class="uk-text-small"><?php echo $preset['title']; ?></div>
					</div>

				</a>
			</div>
		<?php endforeach; ?>
	</div>
</div>