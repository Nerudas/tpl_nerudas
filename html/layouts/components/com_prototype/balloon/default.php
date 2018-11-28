<?php
/**
 * @package    Nerudas Template
 * @version    4.9.35
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\HTML\HTMLHelper;

extract($displayData);

/**
 * Layout variables
 * -----------------
 * @var Joomla\Registry\Registry $item     Item data
 * @var Joomla\Registry\Registry $author   Author data
 * @var Joomla\Registry\Registry $category category data
 * @var Joomla\Registry\Registry $preset   preset data
 */

?>
<div class="prototype baloon">
	<div class="uk-grid uk-margin-top-remove" data-uk-grid-margin data-uk-grid-match>
		<div class="uk-width-medium-1-3">
			<div>
				<div class="uk-slidenav-position uk-slidenav-imagenavs uk-position-relative uk-balloon-slideshow"
					 data-uk-slideshow="{autoplay:true, autoplayInterval: 3000}">
					<ul class="uk-slideshow">
						<?php foreach ($item->get('images', array()) as $image): ?>
							<li>
								<div class="image uk-display-block uk-cover-background"
									 style="background-image: url('/<?php echo $image->src; ?>');">
								</div>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>
			<div class="uk-text-muted uk-flex uk-flex-wrap uk-flex-middle uk-margin-small-top uk-flex-space-between">
				<div>
					<?php echo Text::_('TPL_NERUDAS_DATE_INFO_EDIT'); ?>:
					<?php echo HTMLHelper::date($item->get('created'), 'd.m.Y'); ?>
				</div>
				<div class="">|</div>
				<div>
					<i class="uk-icon-eye uk-margin-small-right"></i><?php echo $item->get('hits'); ?>
				</div>
			</div>
		</div>
		<div class="uk-width-medium-2-3">
			<div class="content">
				<div class="uk-grid" data-uk-grid-margin data-uk-grid-match>
					<div class="uk-width-medium-3-5">
						<div class="title">
							<div class="uk-text-xlarge uk-margin-remove">
								<?php echo $item->get('title', Text::_('JGLOBAL_TITLE')); ?>
							</div>
						</div>
						<?php if (!empty($item->get('price'))): ?>
							<div class="price uk-margin-bottom ">
								<span class="uk-text-large uk-text-bold">
									<?php echo $item->get('price'); ?>
								</span>
								<span class="uk-text-muted uk-text-uppercase uk-text-small">
									<span>₽</span>
									<?php if (!empty($preset->get('price'))) : ?>
										<span> / </span>
										<?php echo $preset->get('price')->title; ?>
									<?php endif; ?>
								</span>
							</div>
						<?php endif; ?>
						<div class="uk-text-muted uk-text-lowercase">
							<?php if ($category->get('parent_level') > 1): ?>
								<span><?php echo $category->get('parent_title'); ?> </span>
							<?php endif; ?>
							<span><?php echo $category->get('title'); ?></span>
						</div>
						<?php if (!empty($item->get('text'))): ?>
							<div>
								<?php echo $item->get('text'); ?>
							</div>
						<?php endif; ?>
						<?php if (!empty($item->get('external_link'))): ?>
							<div>
								<a href="<?php echo $item->get('external_link'); ?>">
									<?php echo Text::_('TPL_NERUDAS_READMORE'); ?>...
								</a>
							</div>
						<?php endif; ?>
					</div>
					<div class="uk-width-medium-2-5">
						<div class="author uk-clearfix uk-width-1-1">
							<div class="avatar uk-position-relative uk-display-inline-block uk-align-left  uk-margin-bottom-remove">
								<a class="image uk-avatar-48 <?php echo ($author->get('type') == 'legal') ? 'logo' : ''; ?>"
								   href="<?php echo $author->get('link'); ?>"
								   style="background-image: url('/<?php echo $author->get('avatar'); ?>');">
								</a>
								<?php if ($author->get('online')): ?>
									<i class="uk-position-bottom-right uk-icon-profile-state-online"></i>
								<?php endif; ?>
							</div>
							<div class="sub uk-text-ellipsis">
								<div class="name">
									<a href="<?php echo $author->get('link'); ?>">
										<?php echo $author->get('name'); ?>
									</a>
								</div>
								<div class="job uk-text-uppercase-letter uk-text-small uk-text-muted uk-text-ellipsis">
									<?php echo $author->get('signature'); ?>
								</div>
							</div>
						</div>
						<div class="uk-text-small uk-text-muted">
							<?php echo $author->get('status'); ?>
						</div>
						<?php if ($author->get('contacts', false)) : ?>
							<div class="uk-margin-small-top">
								<?php if (!empty($author->get('contacts')->phones)) : ?>
									<div class="uk-margin-bottom">
										<?php foreach ($author->get('contacts')->phones as $phone): ?>
											<div class="uk-margin-small-bottom uk-display-block">
												<a class="uk-text-xlarge "
												   href="tel:<?php echo $phone->code . $phone->number; ?>">
													<?php $phone->display = (!empty($phone->display)) ?
														$phone->display : $phone->code . $phone->number;

													$regular = "/(\\+\\d{1})(\\d{3})(\\d{3})(\\d{2})(\\d{2})/";
													$subst   = '$1($2)$3-$4-$5';
													echo preg_replace($regular, $subst, $phone->display); ?>
												</a>
											</div>
										<?php endforeach; ?>
									</div>
								<?php endif; ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php if ($item->get('editLink')): ?>
		<div class="uk-text-right uk-margin-top">
			<?php
			$user = Factory::getUser();
			if ($item->get('editLink') && $user->authorise('core.manage', 'com_prototype') && $user->authorise('core.admin')): ?>
				<a href="/administrator/index.php?option=com_prototype&task=item.edit&id=<?php echo $item->get('id'); ?>"
				   target="_blank" class="uk-margin-right">
					#<?php echo $item->get('id'); ?>
				</a>
			<?php endif; ?>
			<?php if ($item->get('editLink')): ?>
				<a href="<?php echo $item->get('editLink'); ?>" class="uk-badge uk-badge-success">
					<?php echo Text::_('TPL_NERUDAS_ACTIONS_EDIT'); ?>
				</a>
			<?php endif; ?>
		</div>
	<?php endif; ?>
</div>
