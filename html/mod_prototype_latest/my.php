<?php
/**
 * @package    Nerudas Template
 * @version    4.9.18
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
	<div class="add uk-margin-bottom uk-text-right">
		<a href="<?php echo $addLink; ?>" class="uk-button uk-button uk-button-success">
			<?php echo Text::_('TPL_NERUDAS_ACTIONS_ADD'); ?>
		</a>
	</div>
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
								<div>
									<?php if ($item->category->get('parent_id') > 1): ?>
										<span><?php echo $item->category->get('parent_title'); ?></span>
										<span> / </span>
									<?php endif; ?>
									<span><?php echo $item->category->get('title'); ?></span>
								</div>
								<div class="uk-text-muted uk-flex uk-flex-wrap uk-flex-middle uk-margin-small-top">
									<div>
										<?php echo Text::_('TPL_NERUDAS_DATE_INFO_EDIT'); ?>:
										<?php echo HTMLHelper::date($item->created, 'd M Y'); ?>
									</div>
									<div class="uk-margin-small-left uk-margin-small-right">|</div>
									<div>
										<i class="uk-icon-eye uk-margin-small-right"></i><?php echo $item->hits; ?>
									</div>
								</div>
								<div class="uk-margin-small-top">
									<a href="<?php echo $item->editLink; ?>"
									   class="uk-button uk-button-small uk-button-white">
										<i class="uk-icon-pencil uk-margin-small-right"></i>
										<?php echo Text::_('TPL_NERUDAS_ACTIONS_EDIT'); ?>
									</a>
								</div>
							</div>
							<div class="uk-width-medium-1-4 uk-flex uk-flex-right uk-flex-middle">
								<div>
									<?php if ($item->publish_down !== '0000-00-00 00:00:00'): ?>
										<div class="uk-margin-bottom uk-text-center">
											<div class="uk-text-small uk-text-muted">
												<?php echo Text::_('TPL_NERUDAS_OFFICE_MY_PROTOTYPE_DATE_PUBLISH_DOWN'); ?>
											</div>
											<div class="">
												<?php echo HTMLHelper::date($item->publish_down, 'd.m.Y'); ?>
											</div>
										</div>
									<?php endif; ?>

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
				</div>
			<?php endforeach; ?>
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
