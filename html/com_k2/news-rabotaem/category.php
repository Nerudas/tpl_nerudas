<?php
/**
 * @package    Nerudas Template
 * @version    4.9.3
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2017 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;
$app = JFactory::getApplication();
$doc = JFactory::getDocument();

$modules = $doc->loadRenderer('modules');
//$this->addLink = '/forms/ads?catid='.$this->category->id;
$user          = JFactory::getUser();
$permissions   = NerudasProfilesHelper::getPermissions($user);
$this->items   = array();
$this->addLink = '/forms/news-rabotaem?catid=' . $this->category->id;
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
	$app->redirect(str_replace('start=' . $app->input->get('start'), '', JFactory::getURI()));
}
if (count($this->items) == 0)
{
	$app->enqueueMessage(JText::_('NERUDAS_SEARCH_NO_RESULT'), 'error');
}
?>
<div id="news" class="category">
	<div id="k2cat-<?php echo $this->category->id; ?>" class="item category uk-panel uk-panel-box uk-margin-bottom">
		<h1 class="uk-flex uk-flex-middle uk-margin-remove">
			<span class="title">
				<?php echo $this->category->name; ?>
			</span>
			<?php if ($permissions->moderator): ?>
				<a href="<?php echo $this->addLink; ?>" class="uk-button uk-button-success uk-margin-left">
					<?php echo JText::_('NERUDAS_ADD'); ?>
				</a>
			<?php endif; ?>
			<a href="mailto:glavred@nerudas.ru" class="uk-button uk-button-success uk-margin-left">
				<?php echo JText::_('NERUDAS_ADD_GUEST_NEWS'); ?>
			</a>

		</h1>
		<div class="uk-actions-fixed uk-text-small uk-clearfix" data-uk-sticky>
			<a href="#filter" class="uk-button" data-uk-offcanvas="{mode:'slide'}" data-uk-tooltip
			   title="<?php echo JText::_('NERUDAS_FILTER'); ?>">
				<i class="uk-icon-sliders"></i>
			</a>
			<a href="#" class="uk-button" data-uk-smooth-scroll data-uk-tooltip
			   title="<?php echo JText::_('NERUDAS_TO_TOP'); ?>">
				<i class="uk-icon-arrow-up"></i>
			</a>
			<?php if ($permissions->moderator): ?>
				<a href="<?php echo $this->addLink; ?>" class="uk-button uk-button-success" data-uk-tooltip
				   title="<?php echo JText::_('NERUDAS_ADD'); ?>">
					<i class="uk-icon-plus"></i>
				</a>
			<?php endif; ?>
			<a href="mailto:glavred@nerudas.ru" class="uk-button uk-button-success" data-uk-tooltip
			   title="<?php echo JText::_('NERUDAS_ADD_GUEST_NEWS'); ?>">
				<i class="uk-icon-plus"></i>
			</a>
		</div>
	</div>

	<?php if (count($this->items) > 0)
	{

		foreach ($this->items as $key => $this->item)
		{
			if ($key == 2 && empty($app->input->get('start', 0)))
			{
				echo $modules->render('news-center', array('style' => 'blank'));
			}
			echo $this->loadTemplate('item');
		}

		if ($this->params->get('catPagination') && $this->pagination->getPagesLinks())
		{
			echo $this->loadTemplate('pagination');
		}
		echo $this->loadTemplate('map_modal');
	} ?>
</div>
