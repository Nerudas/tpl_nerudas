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
$app = JFactory::getApplication();
if ($app->input->get->get('k2categories'))
{
	$app->redirect($url = JURI::current(), $moved = true);
}
$doc = JFactory::getDocument();
$doc->addScriptDeclaration("
	(function($){
		$(document).ready(function() {
			$('html').css('overflow-y','hidden');
			setHeight();
			setPosition();
		});
		$(window).resize(function () {
			setHeight();
			setPosition();
		});
		function setHeight() {
			var mapHeight = $(window).height() - $('#map').offset().top;	
			$('#map').height(mapHeight);
			$('#map-sidebar').height(mapHeight);
			$('#map .position.middle').css('max-height', mapHeight - 60);
		}
		function setPosition() {
			// Center
			$('#map .position.center').each(function(index) {
				var map = $('#map').width() / 2;
				var block = $(this).width() / 2
				$(this).css('right', map - block);
			});
			// Middle
			$('#map .position.middle').each(function(index) {
				var map = $('#map').height() / 2;
				var block = $(this).height() / 2
				$(this).css('top', map - block);
			});
		}
	})(jQuery);
");
$modules = $doc->loadRenderer('modules');
echo $this->loadTemplate('script')
?>

<div class="uk-topfix">
</div>
<?php if (isset($this->get('params')->form)): ?>
	<?php echo $this->loadTemplate('form'); ?>
<?php endif; ?>

<div class="uk-clearfix">
	<div id="map-sidebar" class="uk-panel uk-panel-box">
		<div class="wrapper">
			<?php if (!empty($modules->render('map-sidebar'))): ?>
				<?php echo $modules->render('map-sidebar', array('style' => 'blank')); ?>
			<?php endif; ?>
		</div>
	</div>
	<div id="map" class="full">
		<div class="position top left">
			<?php if (!empty($modules->render('map-top-left'))): ?>
				<?php echo $modules->render('map-top-left', array('style' => 'blank')); ?>
			<?php endif; ?>
			<a href="#filter" class="uk-button uk-button-large uk-hidden-large" data-uk-offcanvas>
				<?php echo JText::_('NERUDAS_FILTER'); ?>
			</a>
		</div>
		<div class="position top center">
			<?php if (!empty($modules->render('map-top-center'))): ?>
				<?php echo $modules->render('map-top-center', array('style' => 'blank')); ?>
			<?php endif; ?>
		</div>
		<div class="position top right">
			<?php if (!empty($modules->render('map-top-right'))): ?>
				<?php echo $modules->render('map-top-right', array('style' => 'blank')); ?>
			<?php endif; ?>
			<?php if (isset($this->get('params')->form)): ?>
				<a id="addMarkShow" class="uk-button uk-button-large uk-button-success  " href="#1">
					<?php echo JText::_('NERUDAS_ADD_MAP'); ?>
				</a>
			<?php elseif (JFactory::getUser()->guest):
				// Return url
				$uri = (string) JUri::getInstance() . '#showaddform';
				$return = urlencode(base64_encode($uri));
				$href = '/index.php?option=com_users&view=login&return=' . $return . '&tmpl=component';
				?>
				<a class="uk-button uk-button-large uk-button-success  " href="<?php echo $href; ?>">
					<?php echo JText::_('NERUDAS_ADD_MAP'); ?>
				</a>
			<?php endif; ?>
		</div>
		<div class="position middle left">
			<?php if (!empty($modules->render('map-middle-left'))): ?>
				<?php echo $modules->render('map-middle-left', array('style' => 'blank')); ?>
			<?php endif; ?>
		</div>
		<div class="position middle center">
			<div id="loading" class="uk-loading">
				<i class="uk-icon-spinner uk-icon-spin uk-margin-small-right"></i>
				<?php echo JText::_('NERUDAS_LOADING_DATA'); ?>
			</div>
			<?php if (!empty($modules->render('map-middle-center'))): ?>
				<?php echo $modules->render('map-middle-center', array('style' => 'blank')); ?>
			<?php endif; ?>
		</div>
		<div class="position middle right">
			<div id="zoom" class="uk-hidden-small">
				<div class="uk-text-center">
					<a class="plus uk-button uk-button-success">
						<i class="uk-icon-plus"></i>
					</a>
				</div>
				<div class="uk-text-center uk-margin-small-top uk-margin-small-bottom">
					<span class="count uk-button uk-width-1-1">
						0
					</span>
				</div>
				<div class="uk-text-center">
					<a class="minus uk-button uk-button-danger">
						<i class="uk-icon-minus"></i>
					</a>
				</div>
			</div>
			<?php if (!empty($modules->render('map-middle-right'))): ?>
				<?php echo $modules->render('map-middle-right', array('style' => 'blank')); ?>
			<?php endif; ?>
		</div>
		<div class="position bottom left">
			<?php if (!empty($modules->render('map-bottom-left'))): ?>
				<?php echo $modules->render('map-bottom-left', array('style' => 'blank')); ?>
			<?php endif; ?>
		</div>
		<div class="position bottom center">
			<?php if (!empty($modules->render('map-bottom-center'))): ?>
				<?php echo $modules->render('map-bottom-center', array('style' => 'blank')); ?>
			<?php endif; ?>
		</div>
		<div class="position bottom right">
			<a id="geo" class="uk-button uk-button-large">
				<i class="uk-icon-location-arrow"></i>
			</a>
			<?php if (!empty($modules->render('map-bottom-right'))): ?>
				<?php echo $modules->render('map-bottom-right', array('style' => 'blank')); ?>
			<?php endif; ?>
		</div>
	</div>
</div>
<div id="baloon" class="uk-modal">
	<div class="uk-modal-dialog uk-modal-dialog-large">
		<button class="uk-modal-close uk-close" type="button"></button>
		<h4 class="uk-modal-header">
			<?php echo JText::_('NERUDAS_MAP_OBJECTS_LIST'); ?>
		</h4>
		<div class="loading">
			<i class="uk-icon-spinner uk-icon-spin uk-margin-small-right"></i>
			<?php echo JText::_('NERUDAS_LOADING_DATA'); ?>
		</div>
		<div class="list uk-overflow-container">
		</div>
	</div>
</div>



