<?php
/**
 * @package    Nerudas Template
 * @version    4.9.15
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
?>

<div class="item uk-margin-large-bottom">
	<div class="uk-grid uk-grid-small">
		<div class="uk-width-xsmall-1-1 uk-width-small-1-3 uk-width-medium-1-4">
			<?php echo HTMLHelper::image($image,
				$item->get('title', Text::_('JGLOBAL_TITLE')), array('class' => 'uk-width-1-1')); ?>
		</div>
		<div class="uk-width-xsmall-1-1 uk-width-small-2-3 uk-width-medium-3-4">
			<div class="uk-margin-bottom uk-text-xlarge">
				<?php echo $item->get('title', Text::_('JGLOBAL_TITLE')); ?>
				<?php if ($onModeration): ?>
					<span class="uk-badge uk-badge-danger">
						<?php echo Text::_('TPL_NERUDAS_ONMODERATION'); ?>
					</span>
				<?php endif; ?>
			</div>
			<?php if (!empty($extra->get('price_m3'))): ?>
				<div class="uk-text-bold uk-text-medium">
					<?php echo Text::_('COM_PROTOTYPE_ITEM_EXTRA_PRICE_M3'). ' ' .$extra->get('price_m3') . ' ' .
						Text::_('JGLOBAL_FIELD_PRICE_CURRENCY_RUB'); ?>
				</div>
			<?php endif; ?>
			<?php if (!empty($extra->get('price_t'))): ?>
				<div class="uk-text-bold uk-text-medium">
					<?php echo Text::_('COM_PROTOTYPE_ITEM_EXTRA_PRICE_T'). ' ' .$extra->get('price_t') . ' ' .
						Text::_('JGLOBAL_FIELD_PRICE_CURRENCY_RUB'); ?>
				</div>
			<?php endif; ?>
			<?php if (!empty($extra->get('why_you'))): ?>
				<div class="">
					<?php echo $extra->get('why_you'); ?>
				</div>
			<?php endif; ?>
			<?php if (!empty($extra->get('comment'))): ?>
				<div class="">
					<?php echo $extra->get('comment'); ?>
				</div>
			<?php endif; ?>
			<div>
				<span class="uk-badge uk-badge-white uk-margin-small-left">
					<i class="uk-icon-eye uk-margin-small-right"></i><?php echo $item->get('hits'); ?>
				</span>
			</div>
			<?php if ($item->get('editLink')): ?>
				<a href="<?php echo $item->get('editLink'); ?>"><?php echo Text::_('TPL_NERUDAS_ACTIONS_EDIT'); ?></a>
			<?php endif; ?>
			<?php
			if (!$item->get('author_company'))
			{
				$authorData                  = new stdClass();
				$authorData->author_link     = $item->get('author_link');
				$authorData->author_name     = $item->get('author_name');
				$authorData->author_avatar   = $item->get('author_avatar');
				$authorData->author_online   = $item->get('author_online');
				$authorData->author_job      = $item->get('author_job');
				$authorData->author_job_link = $item->get('author_job_link');
				$authorData->author_job_name = $item->get('author_job_name');
				echo LayoutHelper::render('content.author.horizontal', $authorData);
			}
			else
			{
				echo '<div><a href="' . $item->get('author_job_link') . '">' .
					$item->get('author_job_name') . '</a></div>';
			} ?>
		</div>
	</div>
</div>
