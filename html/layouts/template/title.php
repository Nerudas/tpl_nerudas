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

use Joomla\CMS\Factory;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Language\Text;

$displayData = (empty($displayData)) ? array() : $displayData;
extract($displayData);


/**
 * Layout variables
 * -----------------
 * @var  string $add  Add Link
 * @var  string $edit Edit link
 * @var  string $form Form actions controler name
 */

$app     = Factory::getApplication();
$pathway = $app->getPathway();
$items   = $pathway->getPathWay();
$menu    = $app->getMenu();

$home       = new stdClass();
$home->name = Text::_('TPL_NERUDAS_HOME');
$home->link = '/';
array_unshift($items, $home);

$count = count($items);
$i     = 1;

$revers  = array_reverse($items);
$current = $revers[0];
unset($revers[0]);

$margin = (!isset($margin)) ? true : $margin;

?>
<div class="tm-title uk-panel uk-panel-box uk-flex-middle<?php echo ($margin) ? ' uk-margin-bottom' : ''; ?>">
	<div>
		<ul class="uk-breadcrumb uk-margin-remove uk-hidden-small">
			<?php foreach ($items as $item): ?>
				<?php if ($i !== $count) : ?>
					<li class="item">
						<a href="<?php echo Route::_($item->link); ?>">
							<?php echo $item->name; ?>
						</a>
					</li>
				<?php else: ?>
					<li class="item">
						<h1>
							<?php echo $item->name; ?>
						</h1>
					</li>
				<?php endif; ?>
				<?php $i++; ?>
			<?php endforeach; ?>
		</ul>
		<div class="uk-hidden-medium uk-hidden-large" data-uk-dropdown="{mode:'click'}">
			<a class="uk-h1 uk-flex uk-flex-middle uk-link-muted">
				<span><?php echo $current->name; ?></span>
				<i class="uk-icon-caret-down uk-margin-small-left"></i>
			</a>
			<div class="uk-dropdown">
				<ul class="uk-nav uk-nav-dropdown">
					<?php foreach ($revers as $item): ?>
						<li class="item">
							<a href="<?php echo Route::_($item->link); ?>">
								<?php echo $item->name; ?>
							</a>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
		<?php if (!empty($subitems)): ?>
			<ul class="uk-breadcrumb subitems uk-margin-remove">
				<?php foreach ($subitems as $subitem): ?>
					<li class="item uk-margin-small-top">
						<a href="<?php echo Route::_($subitem->link); ?>">
							<?php echo $subitem->name; ?>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>
	</div>

	<div class="actions uk-button-group">
		<?php if (!empty($layouts)) : ?>
			<div class="uk-margin-right uk-margin-left uk-hidden">
				<?php if (!empty($layouts['list'])) : ?>
					<a href="<?php echo $layouts['list']; ?>"
					   class="list uk-icon-list-ul uk-button
				   <?php echo (!empty($layouts['active']) && $layouts['active'] == 'list') ? ' uk-active' : ''; ?>"
					   data-uk-tooltip title="<?php echo Text::_('TPL_NERUDAS_ON_LIST'); ?>"></a>
				<?php endif; ?>
				<?php if (!empty($layouts['map'])) : ?>
					<a href="<?php echo $layouts['map']; ?>"
					   class="map uk-icon-map-marker uk-button
				   <?php echo (!empty($layouts['active']) && $layouts['active'] == 'map') ? ' uk-active' : ''; ?>"
					   data-uk-tooltip title="<?php echo Text::_('TPL_NERUDAS_ON_MAP'); ?>"></a>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<?php if (!empty($add)) :
			$addText = (!empty($addText)) ? $addText : 'TPL_NERUDAS_ACTIONS_ADD';
			?>
			<a href="<?php echo $add; ?>" class="add uk-button uk-button-success" data-uk-tooltip
			   title="<?php echo Text::_($addText); ?>">
				<?php echo Text::_($addText); ?>
			</a>
		<?php endif; ?>
		<?php if (!empty($edit)) : ?>
			<a href="<?php echo $edit; ?>" class="edit uk-icon-pencil uk-button uk-text-success" data-uk-tooltip
			   title="<?php echo Text::_('TPL_NERUDAS_ACTIONS_EDIT'); ?>"></a>
		<?php endif; ?>
		<?php if (!empty($settings)) : ?>
			<a href="<?php echo $settings; ?>" class="edit uk-icon-cog uk-button" data-uk-tooltip
			   title="<?php echo Text::_('TPL_NERUDAS_SETTINGS'); ?>"></a>
		<?php endif; ?>
		<?php if (!empty($cancel)): ?>
			<a href="<?php echo $cancel; ?>" class="cancel uk-icon-times uk-button uk-text-danger" data-uk-tooltip
			   title="<?php echo Text::_('TPL_NERUDAS_ACTIONS_CANCEL'); ?>"></a>
		<?php endif; ?>
		<?php if (!empty($form)): ?>
			<?php if (empty($cancelLink)): ?>
				<button class="cancel uk-icon-times uk-button uk-text-danger" data-uk-tooltip
						title="<?php echo Text::_('TPL_NERUDAS_ACTIONS_CANCEL'); ?>"
						onclick="Joomla.submitbutton('<?php echo $form; ?>.cancel');"></button>
			<?php else: ?>
				<a class="cancel uk-icon-times uk-button uk-text-danger" data-uk-tooltip
				   title="<?php echo Text::_('TPL_NERUDAS_ACTIONS_CANCEL'); ?>"
				   href="<?php echo $cancelLink; ?>"></a>
			<?php endif; ?>
			<button class="save uk-icon-check uk-button uk-text-success" data-uk-tooltip
					title="<?php echo Text::_('TPL_NERUDAS_ACTIONS_SAVE'); ?>"
					onclick="Joomla.submitbutton('<?php echo $form; ?>.save');"></button>
		<?php endif; ?>
	</div>
</div>

