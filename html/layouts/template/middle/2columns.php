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
<div class="tm-middle uk-container uk-margin-top uk-margin-bottom" data-uk-height-viewport="expand: true">>
	<div class="uk-grid-match" data-uk-grid>
		<?php if ($template->countModules('left')): ?>
			<aside class="tm-left tm-sidebar uk-width-1-5@m uk-visible@m">
				<jdoc:include type="modules" name="left" style="sidebar_left"/>
			</aside>
		<?php endif; ?>
		<main class="tm-center uk-width-4-5@m">
			<jdoc:include type="component"/>
		</main>
		<?php if ($template->countModules('right')): ?>
			<aside class="tm-right tm-sidebar uk-width-1-5@m uk-visible@m">
				<jdoc:include type="modules" name="right" style="sidebar_right"/>
			</aside>
		<?php endif; ?>
	</div>
</div>