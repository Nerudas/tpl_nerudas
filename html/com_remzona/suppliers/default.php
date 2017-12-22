<?php
/**
 * @package    Remzona Component
 * @version    1.0.0
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2017 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Factory;
use Joomla\CMS\Layout\LayoutHelper;

HTMLHelper::_('formbehavior.chosen', '.multipleTags', null, array('placeholder_text_multiple' => Text::_('JOPTION_SELECT_TAG')));
HTMLHelper::_('formbehavior.chosen', 'select');

$user = Factory::getUser();
?>

<div id="remzona" class="suppliers itemlist">
	<?php echo LayoutHelper::render('template.title', array('add' => $this->addLink)); ?>

	<div class="uk-panel uk-panel-box uk-margin-bottom uk-panel-box-secondary">
		<form action="<?php echo htmlspecialchars(Factory::getURI()->toString()); ?>" method="get" name="adminForm"
			  class="uk-form">
			<div class="uk-grid uk-grid-small" data-uk-margin>
				<div class="uk-width-small-1-2">
					<?php
					$class = $this->filterForm->getFieldAttribute('brand', 'class', '', 'filter') . ' uk-width-1-1';
					$this->filterForm->setFieldAttribute('brand', 'class', $class, 'filter');
					echo $this->filterForm->getInput('brand', 'filter'); ?>
				</div>
				<div class="uk-width-small-1-2">
					<?php
					$class = $this->filterForm->getFieldAttribute('tags', 'class', '', 'filter') . ' uk-width-1-1';
					$this->filterForm->setFieldAttribute('tags', 'class', $class, 'filter');
					echo $this->filterForm->getInput('tags', 'filter'); ?>
				</div>
			</div>
			<div class="uk-flex uk-flex-wrap uk-flex-space-between uk-flex-middle">
				<div class="">
					<div class="uk-flex-inline uk-margin-right uk-margin-top">
						<?php echo $this->filterForm->getInput('region', 'filter'); ?>
					</div>
					<?php if (!$user->guest):
						$showmy = $this->filterForm->getField('showmy', 'filter');
						?>
						<div class="uk-flex-inline uk-flex-middle uk-margin-top">
							<label for="<?php echo $showmy->id; ?>">
								<?php echo $this->filterForm->getInput('showmy', 'filter'); ?>
								<?php echo Text::_($showmy->label); ?>
							</label>
						</div>
					<?php endif; ?>
				</div>
				<div class="uk-flex-inline">
					<button type="submit" class="uk-button uk-button-primary uk-margin-top">
						<?php echo Text::_('JSEARCH_FILTER_SUBMIT'); ?>
					</button>
				</div>
			</div>
		</form>
	</div>
	<?php if ($this->items) : ?>
		<div class="items">
			<?php foreach ($this->items as $id => $item): ?>
				<div class="uk-panel uk-panel-box uk-margin-bottom">
					<div class="uk-grid uk-grid-small uk-margin-small-bottom">
						<div class="uk-width-small-3-4">
							<h2 class="uk-h3 uk-margin-remove uk-display-inline-block">
								<?php echo $item->title; ?>
							</h2>
							<?php if (!$item->published): ?>
								<sup class="uk-badge uk-badge-warning uk-margin-small-left">
									<?php echo Text::_('TPL_NERUDAS_ONMODERATION'); ?>
								</sup>
							<?php endif; ?>
							<?php if ($item->publish_down !== '0000-00-00 00:00:00' &&
								$item->publish_down < Factory::getDate()->toSql()): ?>
								<sup class="uk-badge uk-badge-danger uk-margin-small-left">
									<?php echo Text::_('TPL_NERUDAS_PUBLISH_TIMEOUT'); ?>
								</sup>
							<?php endif; ?>
						</div>
						<div class="uk-width-small-1-4 uk-text-right">
							<time class="timeago uk-text-muted uk-text-small" data-uk-tooltip
								  datetime="<?php echo HTMLHelper::date($item->created, 'c'); ?>"
								  title="<?php echo HTMLHelper::date($item->created, 'd.m.Y H:i'); ?>"></time>
							<?php if ($item->editLink) : ?>
								<a class="edit uk-icon-pencil uk-button uk-text-success uk-margin-small-left"
								   data-uk-tooltip title="<?php echo Text::_('TPL_NERUDAS_ACTIONS_EDIT'); ?>"
								   href="<?php echo $item->editLink; ?>"></a>
							<?php endif; ?>
						</div>
					</div>
					<div class="uk-grid uk-grid-small uk-margin-top-remove" data-uk-grid-margin>
						<div class="uk-width-medium-3-4">
							<div class="tags uk-margin-small-bottom">
								<?php if ($item->tags): ?>
									<?php foreach ($item->tags as $tag): ?>
										<span class="uk-tag">
											<?php echo $tag->title; ?>
										</span>
									<?php endforeach; ?>
								<?php endif; ?>
							</div>
							<div class="uk-text-small uk-margin-bottom uk-text-muted">
								<?php echo $item->about; ?>
							</div>
							<div class="contacts">
								<div class="uk-flex uk-flex-wrap uk-flex-middle">
									<?php if ($item->contacts->get('phones', false)) : ?>
										<?php foreach ($item->contacts->get('phones') as $phone): ?>
											<a class="uk-button uk-button-small uk-margin-small-right uk-margin-small-bottom"
											   href="tel:<?php echo $phone->code . $phone->number; ?>">
												<i class="uk-icon-phone uk-margin-small-right"></i>
												<?php $phone->display = (!empty($phone->display)) ?
													$phone->display : $phone->code . $phone->number;
												echo $phone->display; ?>
											</a>
										<?php endforeach; ?>
									<?php endif; ?>
								</div>
								<div class="uk-flex uk-flex-wrap uk-flex-middle">
									<?php if (!empty($item->contacts->get('email', ''))) : ?>
										<a class="uk-button uk-button-small uk-margin-small-right uk-margin-small-bottom"
										   href="mailto:<?php echo $item->contacts->get('email'); ?>">
											<i class="uk-icon-envelope-o uk-margin-small-right"></i>
											<?php echo $item->contacts->get('email'); ?>
										</a>
									<?php endif; ?>
									<?php if (!empty($item->contacts->get('site', ''))) : ?>
										<a class="uk-button uk-button-small uk-margin-small-right uk-margin-small-bottom"
										   href="<?php echo $item->contacts->get('site'); ?>">
											<i class="uk-icon-globe uk-margin-small-right"></i>
											<?php echo trim(str_replace(array('http://', 'https://'), '', $item->contacts->get('site')), '/'); ?>
										</a>
									<?php endif; ?>
								</div>
								<div class="uk-flex uk-flex-wrap uk-flex-middle">
									<?php if (!empty($item->contacts->get('vk', ''))) : ?>
										<a class="uk-icon-vk uk-button uk-button-small uk-margin-small-right uk-margin-small-bottom"
										   href="https://vk.com/<?php echo $item->contacts->get('vk'); ?>"
										   target="_blank">
										</a>
									<?php endif; ?>
									<?php if (!empty($item->contacts->get('facebook', ''))) : ?>
										<a class="uk-icon-facebook uk-button uk-button-small uk-margin-small-right uk-margin-small-bottom"
										   href="https://facebook.com/<?php echo $item->contacts->get('facebook'); ?>"
										   target="_blank">
										</a>
									<?php endif; ?>
									<?php if (!empty($item->contacts->get('instagram', ''))) : ?>
										<a class="uk-icon-instagram uk-button uk-button-small uk-margin-small-right uk-margin-small-bottom"
										   href="https://instagram.com/<?php echo $item->contacts->get('instagram'); ?>"
										   target="_blank">
										</a>
									<?php endif; ?>
								</div>
							</div>
						</div>
						<div class="uk-width-medium-1-4">
							<div class="uk-grid uk-grid-small">
								<?php if ($item->brands): ?>
									<?php foreach ($item->brands as $brand): ?>
										<div class="uk-width-1-3 uk-flex uk-flex-middle" data-uk-grid-margin>
											<?php echo HTMLHelper::_('image', $brand->logo, $brand->title,
												array('title' => $brand->title), false); ?>
										</div>
									<?php endforeach; ?>
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
</div>
