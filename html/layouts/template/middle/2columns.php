<?php
/**
 * @package    Nerudas Template
 * @version    4.9.6
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;

$template = $displayData;

?>
<div class="tm-middle uk-container uk-container-center uk-margin-top uk-margin-bottom">
	<div class="uk-grid">
		<main class="tm-center uk-width-medium-1-1 uk-width-large-2-3">
			<jdoc:include type="component"/>
		</main>
		<?php if ($template->countModules('sidebar')): ?>
			<aside class="tm-sidebar uk-width-medium-1-1 uk-width-large-1-3">
				<div class="uk-grid" data-uk-grid-match data-uk-grid-margin>
					<jdoc:include type="modules" name="sidebar" style="sidebar_new"/>
				</div>
			</aside>
		<?php endif; ?>
	</div>
</div>