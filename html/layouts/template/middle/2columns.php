<?php
/**
 * @package    Nerudas Template
 * @version    5.0.0
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2017 Nerudas. All rights reserved.
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
		<?php if ($template->countModules('right')): ?>
			<aside class="tm-sidebar uk-width-medium-1-1 uk-width-large-1-3 ">
				<jdoc:include type="modules" name="right" style="sidebar"/>
			</aside>
		<?php endif; ?>
	</div>
</div>