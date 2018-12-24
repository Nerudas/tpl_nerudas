<?php
/**
 * @package    Nerudas Template
 * @version    4.9.39
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;

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
<div class="prototype author">
	<?php if ($author->get('contacts', false)) : ?>
		<?php if (!empty($author->get('contacts')->phones)) : ?>
			<?php foreach ($author->get('contacts')->phones as $phone): ?>
				<a class="uk-text-center uk-display-block uk-margin-bottom"
				   href="tel:<?php echo $phone->code . $phone->number; ?>">
					<?php $phone->display = (!empty($phone->display)) ?
						$phone->display : $phone->code . $phone->number;

					$regular = "/(\\+\\d{1})(\\d{3})(\\d{3})(\\d{2})(\\d{2})/";
					$subst   = '$1($2)$3-$4-$5';
					$display = preg_replace($regular, $subst, $phone->display); ?>
					<span class="uk-h1 uk-hidden-small">
						<?php echo $display;?>
					</span>
					<span class="uk-h2 uk-hidden-medium uk-hidden-large">
						<?php echo $display;?>
					</span>
				</a>
			<?php endforeach; ?>
		<?php endif; ?>

	<?php endif; ?>
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
</div>
