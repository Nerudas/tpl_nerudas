<?php
/**
 * @package    Nerudas Template
 * @version    4.9.25
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;
use Joomla\CMS\HTML\HTMLHelper;

?>
<h2>
	<a href="<?php echo $listLink; ?>" class="uk-link-muted">
		<?php echo $module->title; ?>
	</a>
	<a href="<?php echo $addLink; ?>"
	   class="uk-button uk-button uk-button-success">
		<?php echo Text::_('TPL_NERUDAS_ACTIONS_ADD'); ?>
	</a>
</h2>
<ul class="uk-list">
	<?php $i = 0;
	foreach ($items as $key => $item): ?>
		<li class="uk-margin-top uk-margin-bottom">
			<?php if ($i != 0): ?>
				<div class="uk-text-large uk-text-center">· · ·</div><?php endif; ?>
			<a href="<?php echo $item->link; ?>" class="">
				<div class="uk-link-muted uk-text-uppercase">
					<?php echo $item->name; ?>
					<?php if ($item->logo): ?>
							<img src="<?php echo $item->logo; ?>"
								 alt="<?php echo str_replace('"', '', $item->name); ?>"
								 style="height: 20px !important;"/>

					<?php endif; ?>
				</div>
				<div class="uk-text-muted">
					<?php echo HTMLHelper::_('string.truncate', (strip_tags($item->about)), 100); ?>
				</div>
			</a>
		</li>
		<?php $i++; endforeach; ?>
</ul>


