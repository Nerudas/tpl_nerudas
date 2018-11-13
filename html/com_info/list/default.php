<?php
/**
 * @package    Nerudas Template
 * @version    4.9.33
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Factory;
use Joomla\CMS\Layout\LayoutHelper;

HTMLHelper::_('jquery.framework');
HTMLHelper::_('formbehavior.chosen', 'select');

?>
<div id="info" class="itemlist">
	<?php echo LayoutHelper::render('template.title', array()); ?>

	<div class="uk-panel uk-panel-box uk-margin-bottom uk-panel-box-secondary">
		<form action="<?php echo htmlspecialchars(Factory::getURI()->toString()); ?>" method="get" name="adminForm"
			  class="uk-form filter">
			<div class="uk-form-row">
				<div class="uk-grid uk-grid-small" data-uk-margin>
					<div class="uk-width-small-1-2 uk-width-medium-2-5 uk-hidden-large">
						<?php
						$class = $this->filterForm->getFieldAttribute('tag', 'class', '', 'filter') . ' uk-width-1-1';
						$this->filterForm->setFieldAttribute('tag', 'class', $class, 'filter');
						echo $this->filterForm->getInput('tag', 'filter'); ?>
					</div>
					<div class="uk-width-small-1-2 uk-width-medium-3-5 uk-width-large-1-1 uk-flex uk-flex-space-between">
						<?php
						$class = $this->filterForm->getFieldAttribute('search', 'class', '', 'filter') . ' uk-width-1-1';
						$this->filterForm->setFieldAttribute('search', 'class', $class, 'filter');
						echo $this->filterForm->getInput('search', 'filter'); ?>
						<div class="uk-button-group left-input advanced-fiter">
							<a href="<?php echo $this->link; ?>"
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

	<?php if ($this->items) : ?>
		<div class="items">
			<?php
			$count = count($this->items);
			$half  = round($count / 2);
			$i     = 1;
			foreach ($this->items as $id => $item): ?>
				<?php if ($i == $half): ?>

				<?php endif; ?>
				<?php echo LayoutHelper::render($item->layout, $item); ?>
			<?php endforeach; ?>
		</div>
		<div>
			<?php echo $this->pagination->getPagesLinks(); ?>
		</div>
	<?php endif; ?>
</div>