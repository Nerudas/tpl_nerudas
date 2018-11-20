<?php
/**
 * @package    Nerudas Template
 * @version    4.9.34
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\LayoutHelper;

LayoutHelper::render('components.com_prototype.list.head');

?>

<div class="prototype-lastes-module home">
	<div class="title uk-margin-bottom uk-flex uk-flex-middle uk-flex-wrap">
		<h2 class="uk-margin-bottom-remove uk-margin-right">
			<a class="uk-text-muted" href="<?php echo $listLink; ?>"><?php echo $module->title; ?></a>
		</h2>
		<a href="<?php echo $addLink; ?>" class="uk-button uk-button uk-button-success">
			<?php echo Text::_('TPL_NERUDAS_ACTIONS_ADD'); ?>
		</a>
	</div>
	<?php if ($items) : ?>
		<div class="uk-panel uk-panel-box uk-margin-large-bottom">
			<div class="items">
				<?php
				$count = count($items);
				$i     = 0;
				foreach ($items as $id => $item):?>
					<?php echo $item->render->listItem; ?>
					<?php
					$i++;
					if ($i != $count): ?>
						<hr class="uk-hidden-small">
						<hr class="uk-hidden-medium uk-hidden-large uk-margin-large-top uk-margin-large-bottom">
					<?php endif; ?>
				<?php endforeach; ?>
			</div>
			<hr class="uk-hidden-small">
			<hr class="uk-hidden-medium uk-hidden-large uk-margin-large-top uk-margin-large-bottom">
			<div class="more uk-text-center">
				<a href="<?php echo $listLink; ?>"
				   class="uk-button uk-button-large uk-width-1-1 uk-text-center">
					<?php echo Text::_('TPL_NERUDAS_SHOWMORE'); ?>
				</a>
			</div>
		</div>

		<?php echo LayoutHelper::render('components.com_prototype.list.balloon'); ?>
		<?php echo LayoutHelper::render('components.com_prototype.list.author'); ?>
	<?php endif; ?>
</div>