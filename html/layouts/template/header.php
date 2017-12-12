<?php

defined('_JEXEC') or die;

$template = $displayData;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;

$siteName = Factory::getConfig()->get('sitename');

?>
<header class="tm-top">
	<nav class="uk-navbar uk-navbar-attached">
		<div class="uk-container uk-container-center">
			<a class="uk-navbar-toggle uk-icon-small" href="#navigation" data-uk-offcanvas="{mode:'slide'}"></a>
			<a class="uk-navbar-brand" href="/">
				<?php echo HTMLHelper::_('image', 'logo.png', $siteName, array('title' => $siteName), true); ?>
			</a>
			<?php if ($template->countModules('header-center')): ?>
				<div class="uk-navbar-content uk-hidden-small">
					<jdoc:include type="modules" name="header-center"/>
				</div>
			<?php endif; ?>
			<?php if ($template->countModules('header-sidebar')): ?>
				<div class="uk-navbar-flip">
					<ul class="uk-navbar-nav">
						<jdoc:include type="modules" name="header-sidebar"/>
					</ul>
				</div>
			<?php endif; ?>

		</div>
	</nav>
	<div id="navigation" class="uk-offcanvas">
		<div class="uk-offcanvas-bar">
			<jdoc:include type="modules" name="navigation"/>
		</div>
	</div>
</header>
