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
use Joomla\CMS\Factory;
use Joomla\Registry\Registry;

$app = Factory::getApplication();
$doc = Factory::getDocument();


HTMLHelper::_('jquery.framework');
HTMLHelper::_('script', 'media/com_prototype/js/list.min.js', array('version' => 'auto'));

$doc->addScriptDeclaration(
	"function showPrototypeListBalloon() {UIkit.modal('[data-prototype-balloon]', {center: true}).show();}");


$doc->addScriptOptions('prototypeList', array('catid' => $params->get('category', 1)));
?>


<div class="prototype-lastes-module default-list">
	<?php if ($items) : ?>
		<div class="items uk-margin-bottom ">
			<?php foreach ($items as $id => $item):
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
		<div class="more uk-text-center">
			<a href="<?php echo $listLink; ?>"
			   class="uk-button uk-button-large uk-width-1-1 uk-text-center">
				<?php echo Text::_('TPL_NERUDAS_SHOWMORE'); ?>
			</a>
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
