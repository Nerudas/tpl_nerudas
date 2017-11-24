<?php
/**
 * @package    Nerudas Template
 * @version    4.9.1
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2017 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;
$app = JFactory::getApplication();
$doc = JFactory::getDocument();
$doc->addScriptDeclaration("
	(function($){
		$(document).ready(function() {			
			setHeight4x3($('.itemlist .item .image'));		
		});
		$(window).resize(function () {		
			setHeight4x3($('.itemlist .item .image'));
		});
	})(jQuery);
");
$modules     = $doc->loadRenderer('modules');
$this->items = array();
if (isset($this->leading) && count($this->leading))
{
	$this->items = array_merge($this->items, $this->leading);
}
if (isset($this->primary) && count($this->primary))
{
	$this->items = array_merge($this->items, $this->primary);
}
if (isset($this->secondary) && count($this->secondary))
{
	$this->items = array_merge($this->items, $this->secondary);
}
if (isset($this->links) && count($this->links))
{
	$this->items = array_merge($this->items, $this->links);
}
if (count($this->items) == 0 && !empty($app->input->get('start')))
{
	$app->redirect(preg_replace('/&?start=[^&]*/', '', JFactory::getURI()));
}
?>

<div id="news-company" class="itemlist"
	 data-uk-scrollspy="{cls:'uk-animation-fade uk-invisible', target:' .item', delay:150}">
	<div class="mobile-actions uk-hidden-large uk-margin-bottom">
		<div class="uk-grid" data-uk-grid-match>
			<div class="uk-vertical-align uk-text-center uk-width-xsmall-1-5 uk-width-small-1-10 uk-width-medium-1-10 uk-width-large-1-1 uk-width-xlarge-1-1">
				<div class="uk-vertical-align-middle uk-width-1-1">
					<a href="#rubricsMobile" class="uk-icon-sliders uk-icon-large uk-link-muted" data-uk-offcanvas
					   title="<?php echo JText::_('NERUDAS_FILTER'); ?>"></a>
				</div>
			</div>
			<div id="appendAddButton"
				 class="uk-text-right uk-width-xsmall-4-5 uk-width-small-9-10 uk-width-medium-9-10 uk-width-large-1-1 uk-width-xlarge-1-1">
			</div>
		</div>
	</div>
	<?php if (count($this->items) > 0): ?>
		<?php foreach ($this->items as $key => $item): ?>
			<?php
			$this->item = $item;
			echo $this->loadTemplate('item');
			?>
		<?php endforeach; ?>
		<?php if ($this->pagination->getPagesLinks() && $this->params->get('catPagination')): ?>
			<?php echo $this->pagination->getPagesLinks(); ?>
			<div class="uk-text-center">
				<?php echo $this->pagination->getPagesCounter(); ?>
			</div>
		<?php endif; ?>
	<?php else: ?>
		<div class="uk-text-muted uk-text-mlarge">
			<?php echo JText::_('NERUDAS_SEARCH_NO_RESULT'); ?>
		</div>
	<?php endif; ?>
</div>
