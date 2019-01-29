<?php
/**
 * @package    Nerudas Template
 * @version    4.9.42
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\LayoutHelper;

$app = Factory::getApplication();

LayoutHelper::render('components.com_prototype.list.head');
?>
<div id="prototype" class="itemlist">
	<?php
	$layouts  = array('list' => $this->listLink, 'map' => $this->mapLink, 'active' => 'list');
	$subitems = array();
	if (!empty($this->children))
	{
		foreach ($this->children as $child)
		{
			$object       = new stdClass();
			$object->name = $child->title;
			$object->link = $child->listLink;
			$subitems[]   = $object;
		}
	}
	echo LayoutHelper::render('template.title', array(
		'add'      => $this->addLink,
		'layouts'  => $layouts,
		'subitems' => $subitems,)); ?>
	<div class="uk-panel uk-panel-box uk-margin-bottom uk-panel-box-secondary">
		<form action="<?php echo htmlspecialchars(Factory::getURI()->toString()); ?>" method="get" name="adminForm"
			  class="uk-form filter">
			<div>
				<div class="uk-flex uk-flex-wrap uk-flex-middle">
					<div class="uk-margin-right uk-flex uk-width-1-1">
						<?php
						$class = $this->filterForm->getFieldAttribute('search', 'class', '', 'filter') . ' uk-width-1-1';
						$this->filterForm->setFieldAttribute('search', 'class', $class, 'filter');
						$this->filterForm->setFieldAttribute('search', 'id', 'filter_search_desktop');
						echo $this->filterForm->getInput('search', 'filter'); ?>
						<div class="uk-button-group left-input">
							<a href="<?php echo $this->listLink; ?>"
							   class="uk-button uk-text-danger uk-icon-times">
							</a>
							<button type="submit" class="uk-button uk-text-primary uk-icon-search"
									title="<?php echo Text::_('JSEARCH_FILTER_SUBMIT'); ?>" data-uk-tooltip>
							</button>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
	<a href="<?php echo $this->mapLink; ?>"
	   class="uk-display-block uk-panel uk-panel-box uk-padding-remove uk-position-relative"
	   title="<?php echo Text::_('TPL_NERUDAS_ON_MAP'); ?>"
	   data-uk-tooltip>
		<?php
		$map_header = ($this->category->map_header) ? $this->category->map_header : 'templates/nerudas/images/prototype-map.png';
		echo HTMLHelper::image($map_header, Text::_('TPL_NERUDAS_ON_MAP'), array('class' => 'uk-width-1-1')); ?>
		<div class="uk-position-cover" style="background: rgba(0,0,0,0.1)">
		</div>
		<div class="uk-position-cover uk-flex uk-flex-middle uk-flex-center uk-position-z-index">
			<div class="uk-button uk-button-white uk-button-large uk-text-uppercase">
				<?php if ($this->category->parent_level > 1): ?>
					<span><?php echo $this->category->parent_title; ?> </span>
				<?php endif; ?>
				<span><?php echo $this->category->title; ?> </span>
				<?php echo Text::_('TPL_NERUDAS_ON_MAP'); ?>
			</div>
		</div>
	</a>
	<?php if ($this->items) : ?>
		<div class="items uk-panel uk-panel-box uk-margin-large-bottom">
			<?php
			$count = count($this->items);
			$i     = 0;
			foreach ($this->items as $id => $item):?>
				<?php echo $item->render->listItem; ?>
				<?php
				$i++;
				if ($i != $count): ?>
					<hr class="uk-hidden-small">
					<hr class="uk-hidden-medium uk-hidden-large uk-margin-large-top uk-margin-large-bottom">
				<?php endif; ?>
			<?php endforeach; ?>
		</div>
		<div>
			<?php echo $this->pagination->getPagesLinks(); ?>
		</div>
		<?php echo LayoutHelper::render('components.com_prototype.list.balloon'); ?>
		<?php echo LayoutHelper::render('components.com_prototype.list.author'); ?>
	<?php endif; ?>
</div>



