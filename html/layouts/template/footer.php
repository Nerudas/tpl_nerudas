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

use Joomla\CMS\Language\Text;

$template = $displayData;

$footer = $template->footer;

?>
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
					<div class="modules uk-grid uk-grid uk-grid-width-medium-1-5" data-uk-grid-match
						 data-uk-grid-margin>
						<?php echo $footer->bottom->modules; ?>
					</div>
				</div>
			</div>
		<?php endif; ?>
	</footer>
<?php endif; ?>

<?php /*if ($template->countModules('footer-top') || $template->countModules('footer-bottom')): ?>
	<footer class="tm-footer">
		<?php if ($template->countModules('footer-top')): ?>
			<div class="block top">
				<div class="uk-container uk-container-center">
					<?php if ($template->params->get('footer-top-showheader')
						&& !empty($template->params->get('footer-top-header'))): ?>
						<div class="header">
							<?php echo Text::_($template->params->get('footer-top-header')); ?>
						</div>
					<?php endif; ?>
					<div class="modules uk-grid uk-grid uk-grid-width-medium-1-5" data-uk-grid-match
						 data-uk-grid-margin>
						<jdoc:include type="modules" name="footer-top" style="footer"/>
					</div>
				</div>
			</div>
		<?php endif; ?>

		<?php if ($template->countModules('footer-bottom')): ?>
			<div class="block bottom uk-text-contrast">
				<div class="uk-container uk-container-center">
					<?php if ($template->params->get('footer-bottom-showheader')
						&& !empty($template->params->get('footer-bottom-header'))): ?>
						<div class="header">
							<?php echo Text::_($template->params->get('footer-bottom-header')); ?>
						</div>
					<?php endif; ?>
					<div class="modules uk-grid uk-grid uk-grid-width-medium-1-4" data-uk-grid-match
						 data-uk-grid-margin>
						<jdoc:include type="modules" name="footer-bottom" style="footer"/>
					</div>
				</div>
			</div>
		<?php endif; ?>
	</footer>
<?php endif; */ ?>

