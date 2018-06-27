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

use Joomla\Registry\Registry;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Factory;
use Joomla\CMS\Date\Date;

extract($displayData);

/**
 * Layout variables
 * -----------------
 * @var   Registry $item         Item data
 * @var   Registry $extra        Item extra data
 * @var   Registry $category     Category data
 * @var   Registry $extra_filter Extra Filter data
 * @var   Registry $placemark    Placemark data
 */

$image = ($placemark->get('image', false)) ? $placemark->get('image') : 'templates/nerudas/images/placemarks/nerud.png';

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
$catFields    = new Registry($category->get('fields'));
?>
<style>
	[data-prototype-placemark].nerud {
		display: block;
		position: relative;
		width: 120px;
		height: 60px;
		margin-top: -60px;
		margin-left: -60px;
		color: inherit
	}

	[data-prototype-placemark].nerud .title {
		position: absolute;
		bottom: 0;
		left: 0;
		width: 120px;
		height: 20px;
		padding: 1px 5px 3px;
		line-height: 1;
		font-size: 15px;
		text-align: center;
		background: #fff;
		border: 1px solid #dcdcdc;
		white-space: nowrap;
		overflow: hidden;
		box-sizing: border-box;
		z-index: 1;
	}

	[data-prototype-placemark].nerud .title::after {
		position: absolute;
		right: 0;
		bottom: 0;
		content: '';
		width: 10px;
		height: 20px;
		background: rgba(255, 255, 255, 0.7);
	}

	[data-prototype-placemark].nerud img {
		position: absolute;
		bottom: 20px;
		left: 0;
		max-width: 65px;
		max-height: 40px;
		z-index: 2;
	}

	[data-prototype-placemark].nerud .price {
		position: absolute;
		top: 0;
		right: 0;
		width: 63px;
		height: 40px;
		padding: 0 5px;
		text-overflow: ellipsis;
		background: #fff;
		border: 1px solid #dcdcdc;
		border-bottom: none;
		white-space: nowrap;
		overflow: hidden;
		box-sizing: border-box;
		z-index: 1;
		vertical-align: bottom;
		text-align: right;
		line-height: 1;
	}

	[data-prototype-placemark].nerud .price .type {
		font-size: 12px;
	}

	[data-prototype-placemark].nerud .price .number {
		font-size: 20px;
		font-weight: bold;
		text-align: left;
	}

	[data-prototype-placemark].nerud[data-viewed="true"] {
		color: inherit;
		width: 90px;
		height: 45px;
		margin-top: -45px;
		margin-left: -45px;
		opacity: .75;
		filter: brightness(.9)
	}

	[data-prototype-placemark].nerud[data-viewed="true"] .title {
		width: 90px;
		height: 15px;
		font-size: 11px;
	}

	[data-prototype-placemark].nerud[data-viewed="true"] .title::after {
		content: '';
		width: 7px;
		height: 15px;
	}

	[data-prototype-placemark].nerud[data-viewed="true"] img {
		bottom: 15px;
		max-width: 49px;
		max-height: 30px;
	}

	[data-prototype-placemark].nerud[data-viewed="true"] .price {
		width: 51px;
		height: 30px;
		padding: 0 3px;
	}

	[data-prototype-placemark].nerud[data-viewed="true"] .price .type {
		font-size: 9px;
	}

	[data-prototype-placemark].nerud[data-viewed="true"] .price .number {
		font-size: 15px;
	}

	[data-prototype-placemark].nerud.onModeration .price {
		background-color: #da314b;
		color: #fff;
	}

</style>
<div data-prototype-placemark="<?php echo $item->get('id', 'x'); ?>"
	 data-placemark-coordinates="[[[-60, -60],[60, -60],[60, 0],[60, 0],[0, 0],[-60, -10],[-60, -10]]]"
	 class="placemark nerud<?php echo ($onModeration) ? ' onModeration' : ''; ?>" data-viewed="false">
	<div class="price">
		<?php $price_type = ($catFields->get('price_o')) ? 'o' : $extra_filter->get('price_m3t', 'm3'); ?>
		<div class="type"><?php echo Text::_('TPL_NERUDAS_PRICE_TYPE_' . $price_type); ?></div>
		<div class="number">
			<?php echo $extra->get('price_' . $price_type, '---'); ?>
		</div>
	</div>
	<?php echo HTMLHelper::image($image, $item->get('title', Text::_('JGLOBAL_TITLE'))); ?>
	<div class="title"><?php echo $item->get('title', Text::_('JGLOBAL_TITLE')); ?></div>
</div>