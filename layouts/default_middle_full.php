<?php
/**
 * @package    Nerudas Template
 * @version    4.9.8
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
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
		<main class="tm-senter uk-width-1-1">
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
	</div>
</div>