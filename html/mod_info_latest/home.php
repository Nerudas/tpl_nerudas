<?php
/**
 * @package    Nerudas Template
 * @version    4.9.38
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;

use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Language\Text;

?>
<div class="info-lastes-module uk-margin-large-bottom">
	<?php if ($module->showtitle): ?>
		<div class="title uk-margin-bottom uk-flex uk-flex-middle uk-flex-wrap">
			<h2 class="uk-margin-bottom-remove uk-margin-right">
				<a class="uk-text-muted" href="<?php echo $listLink; ?>"><?php echo $module->title; ?></a>
			</h2>
		</div>
	<?php endif; ?>

	<?php if (!empty($items)) : ?>
		<div class="items">
			<?php foreach ($items as $item)
			{
				echo LayoutHelper::render($item->layout, $item);
			}
			?>
			<div class="more uk-text-center">
				<a href="<?php echo $listLink; ?>"
				   class="uk-button uk-button-large uk-width-1-1 uk-text-center uk-panel-box">
					<?php echo Text::_('TPL_NERUDAS_SHOWMORE'); ?>
				</a>
			</div>
		</div>
	<?php endif; ?>
</div>
