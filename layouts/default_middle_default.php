<?php
/**
 * @package    Nerudas Template
 * @version    4.9.4
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2017 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;
?>
<div class="uk-container uk-container-center">
	<div class="uk-grid uk-grid-small uk-margin-top uk-margin-bottom">
		<?php if ($this->countModules('top')): ?>
			<aside class="uk-width-1-1 uk-margin-bottom">
				<jdoc:include type="modules" name="top"/>
			</aside>
		<?php endif; ?>
		<aside class="tm-left uk-width-1-1 uk-width-small-1-1 uk-width-medium-1-1 uk-width-large-1-4 uk-width-xlarge-1-4 uk-visible-large">
			<jdoc:include type="modules" name="left"/>
		</aside>
		<main class="tm-senter uk-width-1-1 uk-width-small-1-1 uk-width-medium-1-1 uk-width-large-3-4 uk-width-xlarge-2-4">
			<?php if ($this->countModules('content-top')): ?>
				<aside class="uk-margin-bottom">
					<jdoc:include type="modules" name="content-top"/>
				</aside>
			<?php endif; ?>
			<div>
				<jdoc:include type="component"/>
			</div>
			<?php if ($this->countModules('content-bottom')): ?>
				<aside class="uk-margin-top">
					<jdoc:include type="modules" name="content-bottom"/>
				</aside>
			<?php endif; ?>
		</main>
		<aside class="tm-right uk-width-1-1 uk-width-small-1-1 uk-width-medium-1-1 uk-width-large-1-1 uk-width-xlarge-1-4">
			<jdoc:include type="modules" name="right"/>
		</aside>
		<?php if ($this->countModules('top')): ?>
			<aside class="uk-width-1-1 uk-margin-top">
				<jdoc:include type="modules" name="bottom"/>
			</aside>
		<?php endif; ?>
	</div>
</div>