<?php

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Language\Text;

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

?>
<div class="tm-title uk-panel uk-panel-box uk-flex-middle uk-margin-bottom">
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
	<?php if (!empty($add)) : ?>
		<a href="<?php echo $add; ?>" class="add uk-icon-plus uk-button uk-text-success" data-uk-tooltip
		   title="<?php echo Text::_('TPL_NERUDAS_ACTIONS_ADD'); ?>"></a>
	<?php endif; ?>
	<?php if (!empty($add)) : ?>
		<a href="<?php echo $edit; ?>" class="add uk-icon-plus uk-button uk-text-success" data-uk-tooltip
		   title="<?php echo Text::_('TPL_NERUDAS_ACTIONS_EDIT'); ?>"></a>
	<?php endif; ?>
	<?php if (!empty($form)): ?>
		<div class="actions uk-button-group">
			<button class="cancel uk-icon-times uk-button uk-text-danger" data-uk-tooltip
					title="<?php echo Text::_('TPL_NERUDAS_ACTIONS_CANCEL'); ?>"
					onclick="Joomla.submitbutton('<?php echo $form; ?>.cancel');"></button>
			<button class="save uk-icon-check uk-button uk-text-success" data-uk-tooltip
					title="<?php echo Text::_('TPL_NERUDAS_ACTIONS_SAVE'); ?>"
					onclick="Joomla.submitbutton('<?php echo $form; ?>.save');"></button>
		</div>
	<?php endif; ?>
</div>

