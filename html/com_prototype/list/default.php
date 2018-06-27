<?php
/**
 * @package    Nerudas Template
 * @version    4.9.17
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
use Joomla\Registry\Registry;

$app = Factory::getApplication();
$doc = Factory::getDocument();


HTMLHelper::_('jquery.framework');
HTMLHelper::_('formbehavior.chosen', 'select');
HTMLHelper::_('script', 'media/com_prototype/js/list.min.js', array('version' => 'auto'));

$doc->addScriptDeclaration(
	"function showPrototypeListBalloon() {UIkit.modal('[data-prototype-balloon]', {center: true}).show();}");

if (!empty($app->input->get('item_id')))
{
	$doc->addScriptDeclaration('	jQuery(document).ready(function () {
		jQuery(\'[data-prototype-show="' . $app->input->get('item_id') . '"]\').trigger(\'click\');
	});');
}
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
							<button type="submit" class="uk-button uk-text-primary uk-icon-search uk-hidden-small"
									title="<?php echo Text::_('JSEARCH_FILTER_SUBMIT'); ?>" data-uk-tooltip>
							</button>
						</div>
					</div>
				</div>
				<div class="uk-form-row">
					<?php if (!Factory::getUser()->guest):
						$onlymy = $this->filterForm->getField('onlymy', 'filter');
						$this->filterForm->setFieldAttribute('onlymy', 'onchange', 'this.form.submit()', 'filter');
						?>

						<label for="<?php echo $onlymy->id; ?>" class="uk-flex-inline uk-flex-middle uk-margin-top">
							<?php echo $this->filterForm->getInput('onlymy', 'filter'); ?>
							<span class="uk-margin-small-left">
								<?php echo Text::_('COM_PROTOTYPE_ONLYMY_ITEMS'); ?>
							</span>
						</label>

					<?php endif; ?>
				</div>
			</div>
		</form>
	</div>

	<?php if ($this->items) : ?>
		<div class="items uk-panel uk-panel-box uk-margin-bottom uk-padding-remove">
			<?php foreach ($this->items as $id => $item):
				$onModeration = (!$item->state || ($item->publish_down !== '0000-00-00 00:00:00' &&
						$item->publish_down < Factory::getDate()->toSql()));
				$item->image = ($item->image) ? $item->image : 'templates/nerudas/images/noimage.jpg';
				$catFelds = new Registry($item->category->get('fields'));
				?>
				<div class="item" data-show="false" data-prototype-item="<?php echo $item->id; ?>">
					<div class="uk-padding">
						<div class="uk-grid uk-grid-small" data-uk-grid-margin data-uk-grid-match>
							<div class="uk-width-medium-3-4">
								<h2 class="uk-h3 uk-margin-small-bottom">
									<a class="uk-link-muted uk-display-block"
									   data-prototype-show="<?php echo $item->id; ?>">
										<?php echo $item->title; ?>
										<?php if ($onModeration): ?>
											<span class="uk-badge uk-badge-danger">
											<?php echo Text::_('TPL_NERUDAS_ONMODERATION'); ?></span>
										<?php endif; ?>
									</a>
								</h2>
								<a class="uk-flex uk-flex-wrap uk-link-muted uk-margin-small-bottom uk-width-1-1"
								   data-prototype-show="<?php echo $item->id; ?>">
									<?php if ($catFelds->get('price_m3')): ?>
										<div class="uk-margin-right">
											<span class="uk-text-medium uk-text-bold">
												<?php echo $item->extra->get('price_m3', '...'); ?>
											</span>
											<span class="uk-text-muted">
												<?php echo Text::_('JGLOBAL_FIELD_PRICE_CURRENCY_RUB')
													. '/' . Text::_('TPL_NERUDAS_PRICE_TYPE_M3'); ?>
											</span>
										</div>
									<?php endif; ?>
									<?php if ($catFelds->get('price_t')): ?>
										<div class="uk-margin-right">
											<span class="uk-text-medium uk-text-bold">
												<?php echo $item->extra->get('price_t', '...'); ?>
											</span>
											<span class="uk-text-muted">
												<?php echo Text::_('JGLOBAL_FIELD_PRICE_CURRENCY_RUB')
													. '/' . Text::_('TPL_NERUDAS_PRICE_TYPE_T'); ?>
											</span>
										</div>
									<?php endif; ?>

									<?php if ($catFelds->get('price_o')): ?>
										<div class="uk-margin-right">
											<span class="uk-text-medium uk-text-bold">
												<?php echo $item->extra->get('price_o', '...'); ?>
											</span>
											<span class="uk-text-muted">
												<?php echo Text::_('JGLOBAL_FIELD_PRICE_CURRENCY_RUB')
													. '/' . Text::_('TPL_NERUDAS_PRICE_TYPE_O'); ?>
											</span>
										</div>
									<?php endif; ?>

									<?php if ($catFelds->get('price_h')): ?>
										<div class="uk-margin-right">
											<span class="uk-text-medium uk-text-bold">
												<?php echo $item->extra->get('price_h', '...'); ?>
											</span>
											<span class="uk-text-muted">
												<?php echo Text::_('JGLOBAL_FIELD_PRICE_CURRENCY_RUB')
													. '/' . Text::_('TPL_NERUDAS_PRICE_TYPE_H'); ?>
											</span>
										</div>
									<?php endif; ?>

									<?php if ($catFelds->get('price_s')): ?>
										<div class="uk-margin-right">
											<span class="uk-text-medium uk-text-bold">
												<?php echo $item->extra->get('price_s', '...'); ?>
											</span>
											<span class="uk-text-muted">
												<?php echo Text::_('JGLOBAL_FIELD_PRICE_CURRENCY_RUB')
													. '/' . Text::_('TPL_NERUDAS_PRICE_TYPE_S'); ?>
											</span>
										</div>
									<?php endif; ?>

								</a>
								<a class="uk-display-block uk-text-muted uk-text-small"
								   data-prototype-show="<?php echo $item->id; ?>">
									<?php if (!empty($item->extra->get('why_you'))): ?>
										<div>
											<?php echo JHtmlString::truncate($item->extra->get('why_you'), 75, false, false); ?>
										</div>
									<?php endif; ?>
									<?php if (!empty($item->extra->get('comment'))): ?>
										<div>
											<?php echo JHtmlString::truncate($item->extra->get('comment'), 75, false, false); ?>
										</div>
									<?php endif; ?>
								</a>
								<div class="icons uk-margin-small-top">
									<a data-prototype-show="<?php echo $item->id; ?>">
										<?php
										$item->region = ($item->region == '*') ? 100 : $item->region;
										echo HTMLHelper::image('regions/' . $item->region . '.png', $item->region_name,
											array('title' => $item->region_name, 'data-uk-tooltip' => ''), true); ?>
									</a>
									<?php if ($item->map): ?>
										<a href="<?php echo $item->map->get('link'); ?>"
										   data-uk-tooltip title="<?php echo Text::_('TPL_NERUDAS_ON_MAP'); ?>">
											<?php echo HTMLHelper::image('icons/map_30.png', Text::_('TPL_NERUDAS_ON_MAP'),
												'', true); ?>
										</a>
									<?php endif; ?>
								</div>
							</div>
							<div class="uk-hidden-small uk-width-medium-1-4 uk-flex uk-flex-right uk-flex-middle">
								<?php if ($item->map): ?>
									<div class="">
										<a class="uk-flex uk-flex-right uk-link-muted"
										   href="<?php echo $item->map->get('link'); ?>">
											<?php echo $item->placemark->options['customLayout']; ?>
										</a>
									</div>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
		<div>
			<?php echo $this->pagination->getPagesLinks(); ?>
		</div>
	<?php endif; ?>
	<div data-prototype-balloon class="uk-modal">
		<div class="uk-modal-dialog uk-modal-dialog-large">
			<button class="uk-modal-close uk-close" type="button"></button>
			<div class="uk-alert uk-alert-danger" data-prototype-balloon-error>
				<?php echo Text::_('JGLOBAL_NO_MATCHING_RESULTS'); ?>
			</div>
			<div data-prototype-balloon-loading>
				<i class="uk-icon-spinner uk-icon-spin uk-margin-small-right"></i>
				<?php echo JText::_('TPL_NERUDAS_LOADING'); ?>
			</div>
			<div data-prototype-balloon-content class="uk-overflow-container">
			</div>
		</div>
	</div>
</div>



