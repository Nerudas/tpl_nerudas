<?php

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Language\Text;

$addLink = $displayData;
$app     = Factory::getApplication();
$pathway = $app->getPathway();
$items   = $pathway->getPathWay();
$menu    = $app->getMenu();
$default = $menu->getDefault();

$home       = new stdClass();
$home->name = $default->title;
$home->link = $default->link;
array_unshift($items, $home);

$count = count($items);
$i     = 1;
?>
<div class="tm-title uk-panel uk-panel-box uk-flex-middle">
	<ul class="uk-breadcrumb uk-margin-remove">
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
	<?php if (!empty($addLink)) : ?>
		<a href="<?php echo $addLink; ?>" class="add uk-button uk-button-success">
			<?php echo Text::_('TPL_NERUDAS_ACTIONS_ADD'); ?>
		</a>
	<?php endif; ?>
</div>

