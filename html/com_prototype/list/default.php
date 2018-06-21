<?php
/**
 * @package    Nerudas Template
 * @version    4.9.15
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Factory;


HTMLHelper::_('jquery.framework');
HTMLHelper::_('formbehavior.chosen', 'select');
HTMLHelper::_('script', '//api-maps.yandex.ru/2.1/?lang=ru-RU', array('version' => 'auto', 'relative' => true));

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
				<div class="uk-form-row uk-flex uk-flex-wrap uk-flex-middle">
					<div class="uk-margin-right uk-flex">
						<?php
						$class = $this->filterForm->getFieldAttribute('search', 'class', '', 'filter') . ' uk-width-1-1';
						$this->filterForm->setFieldAttribute('search', 'class', $class, 'filter');
						$this->filterForm->setFieldAttribute('search', 'id', 'filter_search_desktop');
						echo $this->filterForm->getInput('search', 'filter'); ?>
						<div class="uk-button-group left-input">
							<button type="submit" class="uk-button uk-text-primary uk-icon-search uk-hidden-small"
									title="<?php echo Text::_('JSEARCH_FILTER_SUBMIT'); ?>" data-uk-tooltip>
							</button>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>

	<?php if ($this->items) : ?>
		<div class="items">
			<?php foreach ($this->items as $id => $item): ?>


				<?php echo '<pre>', print_r($item, true), '</pre>'; ?>

			<?php endforeach; ?>
		</div>
		<div>
			<?php echo $this->pagination->getPagesLinks(); ?>
		</div>
	<?php endif; ?>
</div>



