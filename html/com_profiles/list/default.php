<?php
/**
 * @package    Nerudas Template
 * @version    4.9.6
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

require_once JPATH_THEMES . '/nerudas/helper.php';
$showAdvansedFiler = tplNerudasHelper::checkAdvansedFilterActivity($this->filterForm,
	array('tags', 'regions'));

HTMLHelper::_('jquery.framework');
HTMLHelper::_('formbehavior.chosen', 'select');

?>
<div id="profiles" class="itemlist">
	<?php echo LayoutHelper::render('template.title', array()); ?>
	<div class="uk-panel uk-panel-box uk-margin-bottom uk-panel-box-secondary">
		<form action="<?php echo htmlspecialchars(Factory::getURI()->toString()); ?>" method="get" name="adminForm"
			  class="uk-form filter">
			<div class="uk-form-row">
				<div class="uk-flex uk-flex-space-between">
					<?php
					$class = $this->filterForm->getFieldAttribute('search', 'class', '', 'filter') . ' uk-width-1-1';
					$this->filterForm->setFieldAttribute('search', 'class', $class, 'filter');
					echo $this->filterForm->getInput('search', 'filter'); ?>
					<div class="uk-button-group left-input advanced-fiter
							<?php echo ($showAdvansedFiler) ? 'uk-hidden' : ''; ?>">
						<a href="<?php echo $this->link; ?>"
						   class="uk-button uk-text-danger uk-icon-times">
						</a>
						<button type="submit" class="uk-button uk-text-primary uk-icon-search"
								title="<?php echo Text::_('JSEARCH_FILTER_SUBMIT'); ?>" data-uk-tooltip>
						</button>
					</div>
				</div>

			</div>
			<div class="uk-form-row advanced-fiter uk-text-right <?php echo ($showAdvansedFiler) ? 'uk-hidden' : ''; ?>">
				<a data-uk-toggle="{target:'.advanced-fiter'}">
					<?php echo Text::_('TPL_NERUDAS_ADVANCED_FITER'); ?>
				</a>
			</div>
			<div class="uk-form-row advanced-fiter <?php echo (!$showAdvansedFiler) ? ' uk-hidden' : ''; ?>">
				<?php echo $this->filterForm->getInput('tags', 'filter'); ?>
			</div>
			<div class="uk-form-row advanced-fiter <?php echo (!$showAdvansedFiler) ? ' uk-hidden' : ''; ?>">
				<div class="uk-flex uk-flex-wrap uk-flex-space-between uk-flex-middle">
					<div class="">
						<div class="uk-flex-inline uk-margin-right uk-margin-top">
							<?php $region = $this->filterForm->getField('region', 'filter'); ?>
							<label for="<?php echo $region->id; ?>">
								<?php echo $this->filterForm->getInput('region', 'filter'); ?>
							</label>
						</div>
					</div>
					<div class="uk-flex-inline uk-margin-top">
						<div class="uk-button-group">
							<a href="<?php echo $this->link; ?>" class="uk-button uk-button-danger">
								<?php echo Text::_('JCLEAR'); ?>
							</a>
							<button type="submit" class="uk-button uk-button-primary">
								<?php echo Text::_('JSEARCH_FILTER_SUBMIT'); ?>
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
			<div class="item uk-margin-large-bottom ">
				<div class="avatar <?php echo ($item->online) ? ' online' : '' ?>">
					<a href="<?php echo $item->link; ?>" class="image"
					   style="background-image: url('<?php echo $item->avatar; ?>')">
					</a>
				</div>
				<div class="content">
					<h2 class="uk-text-large">
						<a href="<?php echo $item->link; ?>" class="uk-link-muted uk-display-block">
							<?php echo $item->name; ?></a>
					</h2>
					<blockquote>
						<?php echo $item->status; ?>
					</blockquote>
				</div>
			</div>
		<?php endforeach; ?>
		<div>
			<?php echo $this->pagination->getPagesLinks(); ?>
		</div>
		<?php endif; ?>
	</div>
</div>
