<?php
/**
 * @package    Nerudas Template
 * @version    4.9.14
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;
?>
<nav class="uk-navbar uk-navbar-attached">
	<div class="uk-container uk-container-center">
		<a class="uk-navbar-toggle uk-icon-small" href="#navigation" data-uk-offcanvas="{mode:'slide'}"></a>
		<a class="uk-navbar-brand" href="/">
			<img src="<?php echo $site->logo; ?>" alt="<?php echo $site->name; ?>"/>
		</a>
		<?php if ($this->countModules('header-center')): ?>
			<div class="uk-navbar-content uk-hidden-small">
				<jdoc:include type="modules" name="header-center"/>
			</div>
		<?php endif; ?>
		<?php if ($this->countModules('header-sidebar')): ?>
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