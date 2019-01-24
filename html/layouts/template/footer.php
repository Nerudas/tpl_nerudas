<?php
/**
 * @package    Nerudas Template
 * @version    4.9.40
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;

$template = $displayData;

$footer = $template->footer;

?>
<div id="backToTop">
	<a href="#" class="uk-button uk-icon-angle-up uk-icon-small"></a>
</div>
<?php if ($footer) : ?>
	<footer class="tm-footer">
		<?php if ($footer->top): ?>
			<div class="block top">
				<div class="uk-container uk-container-center">
					<?php if ($footer->top->title): ?>
						<div class="block-title">
							<?php echo $footer->top->title; ?>
						</div>
					<?php endif; ?>
					<div class="modules uk-grid uk-grid uk-grid-width-medium-1-5" data-uk-grid-match
						 data-uk-grid-margin>
						<?php echo $footer->top->modules; ?>
					</div>
				</div>
			</div>
		<?php endif; ?>

		<?php if ($footer->bottom): ?>
			<div class="block bottom uk-text-contrast">
				<div class="uk-container uk-container-center">
					<?php if ($footer->bottom->title): ?>
						<div class="block-title">
							<?php echo $footer->bottom->title; ?>
						</div>
					<?php endif; ?>
					<div class="modules uk-grid uk-grid uk-grid-width-medium-1-4" data-uk-grid-match
						 data-uk-grid-margin>
						<?php echo $footer->bottom->modules; ?>
					</div>
				</div>
			</div>
		<?php endif; ?>
	</footer>
<?php endif; ?>

