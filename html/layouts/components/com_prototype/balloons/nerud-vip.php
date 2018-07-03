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

$catFields = new Registry($category->get('fields'));
?>
	<div class="uk-flex uk-flex-space-between uk-flex-wrap uk-flex-top">
		<div>
			<div class="uk-text-xlarge uk-margin-remove">
				<?php echo $item->get('title', Text::_('JGLOBAL_TITLE')); ?>
			</div>
			<div class="uk-text-small uk-text-muted uk-margin-bottom">
				<?php if ($category->get('parent_id') > 1): ?>
					<span><?php echo $category->get('parent_title'); ?></span>
					<span> / </span>
				<?php endif; ?>
				<span><?php echo $category->get('title'); ?></span>
			</div>
			<div class="uk-text-muted uk-flex uk-flex-wrap uk-flex-middle uk-margin-bottom">
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
		<div class="prices uk-margin-small-bottom uk-flex-right">
			<?php if ($catFields->get('price_o')): ?>
				<div class="uk-text-large uk-text-bold uk-margin-small-bottom">
					<?php echo $extra->get('price_o', '..') . ' ' .
						Text::_('TPL_NERUDAS_PRICE_TYPE_RUB')
						. '/' . Text::_('TPL_NERUDAS_PRICE_TYPE_O'); ?>
				</div>
			<?php else: ?>
				<div class="uk-text-large uk-text-bold uk-margin-small-bottom">
					<?php echo $extra->get('price_m3', '..') . ' ' .
						Text::_('TPL_NERUDAS_PRICE_TYPE_RUB')
						. '/' . Text::_('TPL_NERUDAS_PRICE_TYPE_M3'); ?>
				</div>

				<div class="uk-text-large uk-text-bold uk-margin-small-bottom">
					<?php echo $extra->get('price_t', '..') . ' ' .
						Text::_('TPL_NERUDAS_PRICE_TYPE_RUB')
						. '/' . Text::_('TPL_NERUDAS_PRICE_TYPE_T'); ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
<?php if (!empty($item->get('html'))): ?>
	<div>
		<?php echo $item->get('html'); ?>
	</div>
<?php elseif (!empty($extra->get('why_you'))): ?>
	<div class="uk-text-medium">
		<?php echo nl2br($extra->get('why_you')); ?>
	</div>
<?php endif; ?>

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