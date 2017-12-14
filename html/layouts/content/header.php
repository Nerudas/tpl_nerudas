<?php

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Language\Text;

extract($displayData);


/**
 * Layout variables
 * -----------------
 * @var   string $add Add Link
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
		<a href="<?php echo $add; ?>" class="add uk-button uk-button-success">
			<?php echo Text::_('TPL_NERUDAS_ACTIONS_ADD'); ?>
		</a>
	<?php endif; ?>
</div>

