<?php
/**
 * @package    Nerudas Template
 * @version    4.9.16
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;

$template = $displayData;
?>
<div id="home">
	<div class="header uk-cover-background uk-flex uk-flex-middle uk-flex-center uk-hidden-small"
		 style="background-image: url('templates/nerudas/images/header.jpg')">
		<?php if ($template->countModules('home-filter')): ?>
			<div class="filter">
				<jdoc:include type="modules" name="home-filter" style="blank"/>
			</div>
		<?php endif; ?>
	</div>
	<div class="tm-middle uk-container uk-container-center uk-margin-top uk-margin-bottom">
		<div class="uk-grid" data-uk-grid-margin>
			<?php if ($template->countModules('home-left')): ?>
				<aside class="tm-sidebar uk-width-medium-1-1 uk-width-large-1-4">
					<div class="uk-grid" data-uk-grid-margin>
						<jdoc:include type="modules" name="home-left" style="sidebar_new"/>
					</div>
				</aside>
			<?php endif; ?>
			<main class="tm-center uk-width-large-1-2">
				<?php if ($template->countModules('home-center')): ?>
					<jdoc:include type="modules" name="home-center" style="home"/>
				<?php endif; ?>
			</main>
			<?php if ($template->countModules('home-right')): ?>
				<aside class="tm-sidebar uk-width-large-1-4">
					<div class="uk-grid" data-uk-grid-margin>
						<jdoc:include type="modules" name="home-right" style="sidebar_new"/>
					</div>
				</aside>
			<?php endif; ?>
		</div>
	</div>
</div>