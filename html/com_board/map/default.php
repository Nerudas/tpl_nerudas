<?php
/**
 * @package    Nerudas Template
 * @version    4.9.10
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

HTMLHelper::_('formbehavior.chosen', 'select');
HTMLHelper::_('script', '//api-maps.yandex.ru/2.1/?lang=ru-RU', array('version' => 'auto', 'relative' => true));
HTMLHelper::_('script', 'media/com_board/js/map.min.js', array('version' => 'auto'));

$filters = array_keys($this->filterForm->getGroup('filter'));
?>
<div id="board" class="map">
	<div class="map-block">
		<div class="uk-hidden-medium uk-hidden-large">
			<div class="uk-button-group uk-width-1-1">
				<a class="uk-button uk-width-1-3 uk-button-white"
				   data-uk-toggle="{target:'[data-board-filter]', cls:'uk-hidden-small'}">
					<?php echo Text::_('TPL_NERUDAS_FILTER'); ?>
				</a>
				<a class="uk-button uk-width-1-3 uk-button-white" href="<?php echo $this->listLink; ?>">
					<?php echo Text::_('TPL_NERUDAS_ON_LIST'); ?>
				</a>
				<a class="uk-button uk-width-1-3 uk-button-white" href="<?php echo $this->addLink; ?>">
					<?php echo Text::_('TPL_NERUDAS_ACTIONS_ADD'); ?>
				</a>
			</div>
		</div>
		<div class="uk-hidden-small">
			<?php $layouts = array('list' => $this->listLink, 'map' => $this->mapLink, 'active' => 'map');
			echo LayoutHelper::render('template.title', array('add' => $this->addLink, 'layouts' => $layouts, 'margin' => false)); ?>
		</div>
		<div id="map" data-board-map>
			<form action="<?php echo htmlspecialchars(Factory::getURI()->toString()); ?>" method="get" name="adminForm"
				  class="uk-form primary-fiter uk-hidden-small filter uk-panel-box uk-panel-box-secondary"
				  data-board-filter>
				<div class="uk-text-right uk-hidden-medium uk-hidden-large">
					<a title="<?php echo Text::_('JLIB_HTML_BEHAVIOR_CLOSE'); ?>"
					   class="uk-icon-close uk-icon-small"
					   data-uk-toggle="{target:'[data-board-filter]', cls:'uk-hidden-small'}">
					</a>
				</div>
				<div>
					<div class="uk-form-row uk-flex uk-flex-wrap uk-flex-middle">
						<div class="uk-margin-right uk-margin-bottom">
							<?php echo Factory::getDocument()->loadRenderer('modules')->render('mapmenu', array('style' => 'blank')); ?>
						</div>
						<div class="uk-margin-right uk-margin-bottom">
							<?php
							$class = $this->filterForm->getFieldAttribute('category', 'class', '', 'filter') . ' uk-width-1-1';
							$this->filterForm->setFieldAttribute('category', 'class', $class, 'filter');
							echo $this->filterForm->getInput('category', 'filter'); ?>
						</div>
						<div class="uk-margin-right uk-flex uk-margin-bottom">
							<?php
							$class = $this->filterForm->getFieldAttribute('search', 'class', '', 'filter') . ' uk-width-1-1';
							$this->filterForm->setFieldAttribute('search', 'class', $class, 'filter');
							echo $this->filterForm->getInput('search', 'filter'); ?>
							<div class="uk-button-group left-input advanced-fiter
							<?php echo ($showAdvansedFiler) ? 'uk-hidden' : ''; ?>">
								<a href="<?php echo $this->link; ?>"
								   class="uk-button uk-text-danger uk-icon-times uk-hidden-small">
								</a>
								<button type="submit" class="uk-button uk-text-primary uk-icon-search uk-hidden-small"
										title="<?php echo Text::_('JSEARCH_FILTER_SUBMIT'); ?>" data-uk-tooltip>
								</button>
								<button type="submit"
										class="uk-button uk-text-primary uk-icon-search uk-hidden-medium uk-hidden-large"
										data-uk-toggle="{target:'[data-board-filter]', cls:'uk-hidden-small'}"
										title="<?php echo Text::_('JSEARCH_FILTER_SUBMIT'); ?>" data-uk-tooltip>
								</button>
							</div>
						</div>
						<div class="uk-margin-bottom">
							<a data-uk-toggle="{target:'.advanced-fiter'}" data-uk-tooltip=""
							   class="uk-icon-cog uk-icon-small  uk-hidden-small"
							   title="<?php echo Text::_('TPL_NERUDAS_ADVANCED_FITER'); ?>">
							</a>
							<a data-uk-toggle="{target:'.advanced-fiter'}" data-uk-tooltip=""
							   class="uk-hidden-medium uk-hidden-large"
							   title="<?php echo Text::_('TPL_NERUDAS_ADVANCED_FITER'); ?>">
								<?php echo Text::_('TPL_NERUDAS_ADVANCED_FITER'); ?>
							</a>
						</div>
					</div>
				</div>
				<div class="uk-margin-top advanced-fiter uk-hidden">
					<div class="uk-form-row">
						<?php echo $this->filterForm->getInput('price', 'filter'); ?>
					</div>
					<div class="">
						<div class="uk-grid uk-grid-small" data-uk-margin>
							<div class="uk-width-medium-1-3">
								<?php echo $this->filterForm->renderField('payment_method', 'filter'); ?>
							</div>
							<div class="uk-width-medium-1-3">
								<?php echo $this->filterForm->renderField('prepayment', 'filter'); ?>
							</div>
							<div class="uk-width-medium-1-3">
								<?php echo $this->filterForm->renderField('for_when', 'filter'); ?>
							</div>
						</div>
					</div>
					<div class="uk-form-row">
						<div class="uk-flex uk-flex-wrap uk-flex-space-between uk-flex-middle">
							<div class="">
								<?php if (!Factory::getUser()->guest):
									$onlymy = $this->filterForm->getField('onlymy', 'filter');
									?>
									<div class="uk-flex-inline uk-flex-middle uk-margin-top">
										<label for="<?php echo $onlymy->id; ?>">
											<?php echo $this->filterForm->getInput('onlymy', 'filter'); ?>
											<?php echo Text::_('COM_BOARD_ONLYMY_ITEMS'); ?>
										</label>
									</div>
								<?php endif; ?>
							</div>
							<div class="uk-flex-inline uk-margin-top submits">
								<div class="uk-button-group">
									<a href="<?php echo $this->link; ?>" class="uk-button uk-button-danger">
										<?php echo Text::_('JCLEAR'); ?>
									</a>
									<button type="submit" class="uk-button uk-button-primary uk-hidden-small">
										<?php echo Text::_('JSEARCH_FILTER_SUBMIT'); ?>
									</button>
									<button type="submit"
											class="uk-button uk-button-primary uk-hidden-medium uk-hidden-large"
											data-uk-toggle="{target:'[data-board-filter]', cls:'uk-hidden-small'}">
										<?php echo Text::_('JSEARCH_FILTER_SUBMIT'); ?>
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
			<div class="zoom" data-afterInit="show">
				<a data-board-map-zoom="plus"
				   class="uk-flex uk-flex-middle uk-flex-center uk-icon-small uk-icon-plus uk-text-success"></a>
				<span data-board-map-zoom="current"
					  class="uk-flex uk-flex-middle uk-flex-center uk-hidden-small"></span>
				<a data-board-map-zoom="minus"
				   class="uk-flex uk-flex-middle uk-flex-center uk-icon-small uk-icon-minus uk-text-danger"></a>
			</div>
			<div class="geo" data-afterInit="show">
				<a class="uk-button uk-icon-location-arrow" data-board-map-geo></a>
			</div>
		</div>
	</div>
	<div data-board-itemlist="container" class="uk-panel uk-panel-box uk-padding-remove">
		<div class="uk-hidden-medium  uk-hidden-large uk-text-right">
			<a data-board-itemlist="close" title="<?php echo Text::_('JLIB_HTML_BEHAVIOR_CLOSE'); ?>"
			   class="uk-icon-close uk-icon-small">

			</a>
		</div>
		<div data-board-itemlist="back" class="uk-margin-top">
			<a class="uk-button uk-width-1-1">
				<i class="uk-icon-chevron-left"></i> <?php echo Text::_('JPREV'); ?>
			</a>
		</div>
		<div data-board-itemlist="items"></div>
		<div data-board-itemlist="back" class="uk-margin-top uk-margin-large-bottom">
			<a class="uk-button uk-width-1-1">
				<i class="uk-icon-chevron-left"></i> <?php echo Text::_('JPREV'); ?>
			</a>
		</div>
		<div class="uk-margin-large-bottom"></div>
	</div>
</div>

