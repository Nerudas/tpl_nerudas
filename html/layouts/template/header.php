<?php
/**
 * @package    Nerudas Template
 * @version    4.9.24
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;

$template = $displayData;
$header   = $template->header;
$panel    = $header->panel;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;

///echo '<pre>', print_r($header, true), '</pre>';
?>
<header class="tm-top new">
	<nav class="tm-toppanel" data-uk-sticky="">
		<div class="uk-container uk-container-center uk-height-1-1">
			<div class="uk-grid uk-grid-large uk-height-1-1" data-uk-grid-match>
				<div class="left uk-width-1-2 uk-width-large-1-5 uk-flex uk-flex-middle uk-flex-left">
					<div>
						<a class="menu uk-margin-small-right uk-icon-navicon uk-icon-small" href="#navigation"
						   data-uk-offcanvas="{mode:'slide'}">
						</a>
						<?php if ($header->logo): ?>
							<a class="logo" href="<?php echo \Joomla\CMS\Uri\Uri::root(); ?>">
								<?php echo $header->logo->element; ?>
							</a>
						<?php endif; ?>
					</div>
				</div>
				<div class="center uk-width-large-3-5 uk-flex uk-flex-top uk-flex-center uk-visible-large">
					<?php if ($panel->center): ?>
						<ul class="modules">
							<?php echo $panel->center; ?>
						</ul>
					<?php endif; ?>
				</div>
				<div class="right uk-width-1-2 uk-width-large-1-5 uk-flex uk-flex-middle uk-flex-right">
					<?php if ($panel->right): ?>
						<ul class="modules">
							<?php echo $panel->right; ?>
						</ul>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</nav>
	<?php if ($panel->mobile && !$template->map): ?>
		<nav class="tm-toppanel-mobile uk-container uk-container-center uk-margin-top uk-hidden-large">
			<div class="modules uk-accordion uk-grid uk-grid uk-grid-width-medium-1-2 uk-panel uk-panel-box"
				 data-uk-grid-match
				 data-uk-grid-margin>
				<?php echo $panel->mobile ?>
			</div>
		</nav>
	<?php endif; ?>
</header>

<nav id="navigation" class="uk-offcanvas">
	<div class="uk-offcanvas-bar">
		<jdoc:include type="modules" name="navigation"/>
	</div>
</nav>
