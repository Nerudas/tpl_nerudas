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

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Date\Date;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\Registry\Registry;

extract($displayData);

/**
 * Layout variables
 * -----------------
 * @var   Registry $item      Item data
 * @var   Registry $extra     Item extra data
 * @var   Registry $category  Category data
 * @var   Registry $placemark Placemark data
 */


$image = ($item->get('image', false)) ? $item->get('image') : 'templates/nerudas/images/noimage.jpg';

$publish_down = $item->get('publish_down', '0000-00-00 00:00:00');
if ($publish_down == '0000-00-00 00:00:00')
{
	$publish_down = false;
}
if ($publish_down)
{
	$publish_down = new Date($publish_down);
	$publish_down->toSql();
}

$onModeration = (!$item->get('state', 0) || ($publish_down && $publish_down < Factory::getDate()->toSql()));


$contacts = ($item->get('author_company')) ? new Registry($item->get('author_job_contacts')) :
	new Registry($item->get('author_contacts'));

?>
<div class="uk-grid uk-margin-top-remove" data-uk-grid-margin data-uk-grid-match>
	<div class="uk-width-medium-1-4">
		<div>
			<?php echo HTMLHelper::image($image,
				$item->get('title', Text::_('JGLOBAL_TITLE')), array('class' => 'uk-width-1-1')); ?>
		</div>
	</div>
	<div class="uk-width-medium-2-4">
		<div class="uk-text-xlarge uk-margin-remove">
			<?php echo $item->get('title', Text::_('JGLOBAL_TITLE')); ?>
		</div>
		<div class="uk-text-small uk-margin-bottom">
			<?php if ($category->get('parent_id') > 1): ?>
				<span><?php echo $category->get('parent_title'); ?></span>
				<span> / </span>
			<?php endif; ?>
			<span><?php echo $category->get('title'); ?></span>
		</div>
		<div class="prices uk-margin-small-bottom">
			<div class="uk-text-large uk-text-bold uk-margin-small-bottom">
				<?php echo $extra->get('price_h', '---') . ' ' .
					Text::_('TPL_NERUDAS_PRICE_TYPE_RUB')
					. '/' . Text::_('TPL_NERUDAS_PRICE_TYPE_H'); ?>
			</div>
			<div class="uk-text-large uk-text-bold uk-margin-small-bottom">
				<?php echo $extra->get('price_s', '---') . ' ' .
					Text::_('TPL_NERUDAS_PRICE_TYPE_RUB')
					. '/' . Text::_('TPL_NERUDAS_PRICE_TYPE_S'); ?>
			</div>
		</div>

		<?php if (!empty($extra->get('why_you'))): ?>
			<div class="uk-text-medium">
				<?php echo nl2br($extra->get('why_you')); ?>
			</div>
		<?php endif; ?>

		<div class="uk-text-muted uk-flex uk-flex-wrap uk-flex-middle uk-margin-small-top">
			<div>
				<?php echo Text::_('TPL_NERUDAS_DATE_INFO_EDIT'); ?>:
				<?php echo HTMLHelper::date($item->get('created'), 'd M Y'); ?>
			</div>
			<div class="uk-margin-small-left uk-margin-small-right">|</div>
			<div>
				<i class="uk-icon-eye uk-margin-small-right"></i><?php echo $item->get('hits'); ?>
			</div>
		</div>
	</div>
	<div class="uk-width-medium-1-4">
		<?php
		if (!$item->get('author_company')):
			$authorData                  = new stdClass();
			$authorData->author_link     = $item->get('author_link');
			$authorData->author_name     = $item->get('author_name');
			$authorData->author_avatar   = $item->get('author_avatar');
			$authorData->author_online   = $item->get('author_online');
			$authorData->author_job      = $item->get('author_job');
			$authorData->author_job_link = $item->get('author_job_link');
			$authorData->author_job_name = $item->get('author_job_name');
			echo LayoutHelper::render('content.author.horizontal', $authorData);
			?>
		<?php else: ?>
			<div>
				<a class="uk-link-muted uk-text-uppercase" href="<?php echo $item->get('author_job_link'); ?>">
					<?php echo $item->get('author_job_name'); ?>
					<?php if ($item->get('author_job_logo')): ?>
						<div>
							<img src="<?php echo $item->get('author_job_logo'); ?>"
								 alt="<?php echo str_replace('"', '', $item->get('author_job_name')); ?>"
								 style="height: 20px !important;"/>
						</div>
					<?php endif; ?>
				</a>
				<div class="uk-text-muted uk-margin-small-top uk-text-small">
					<?php echo HTMLHelper::_('string.truncate', (strip_tags($item->get('author_job_about'))), 100); ?>
				</div>
			</div>
		<?php endif ?>
		<?php if ($contacts) : ?>
			<div>
				<?php if ($contacts->get('phones', false)) : ?>
					<div class="uk-margin-bottom">
						<?php foreach ($contacts->get('phones') as $phone): ?>
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

<?php if ($item->get('editLink') || $onModeration): ?>
	<div class="uk-text-right">
		<?php if ($onModeration): ?>
			<span class="uk-badge uk-badge-danger uk-margin-small-right">
				<?php echo Text::_('TPL_NERUDAS_ONMODERATION'); ?>
			</span>
		<?php endif; ?>
		<?php if ($item->get('editLink')): ?>
			<a href="<?php echo $item->get('editLink'); ?>" class="uk-badge uk-badge-success">
				<?php echo Text::_('TPL_NERUDAS_ACTIONS_EDIT'); ?>
			</a>
		<?php endif; ?>
	</div>
<?php endif; ?>

