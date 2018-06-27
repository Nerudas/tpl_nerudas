<?php
/**
 * @package    techas Template
 * @version    4.9.17
 * @author     techas  - techas.ru
 * @copyright  Copyright (c) 2013 - 2018 techas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://techas.ru
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

$image = ($placemark->get('image', false)) ? $placemark->get('image') : 'templates/techas/images/placemarks/tech.png';

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
	[data-prototype-placemark].tech {
		display: block;
		position: relative;
		width: 130px;
		height: 60px;
		margin-top: -60px;
		margin-left: -60px;
		color: inherit
	}

	[data-prototype-placemark].tech .title {
		position: absolute;
		bottom: 0;
		left: 0;
		width: 130px;
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

	[data-prototype-placemark].tech .title::after {
		position: absolute;
		right: 0;
		bottom: 0;
		content: '';
		width: 10px;
		height: 20px;
		background: rgba(255, 255, 255, 0.7);
	}

	[data-prototype-placemark].tech img {
		position: absolute;
		bottom: 20px;
		left: 0;
		max-width: 65px;
		max-height: 40px;
		z-index: 2;
	}

	[data-prototype-placemark].tech .price {
		position: absolute;
		top: 0;
		right: 0;
		width: 73px;
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

	[data-prototype-placemark].tech .price .type {
		font-size: 12px;
	}

	[data-prototype-placemark].tech .price .number {
		font-size: 20px;
		font-weight: bold;
		text-align: left;
	}

	[data-prototype-placemark].tech[data-viewed="true"] {
		color: inherit;
		width: 98px;
		height: 45px;
		margin-top: -45px;
		margin-left: -45px;
		opacity: .75;
		filter: brightness(.9)
	}

	[data-prototype-placemark].tech[data-viewed="true"] .title {
		width: 98px;
		height: 15px;
		font-size: 11px;
	}

	[data-prototype-placemark].tech[data-viewed="true"] .title::after {
		content: '';
		width: 7px;
		height: 15px;
	}

	[data-prototype-placemark].tech[data-viewed="true"] img {
		bottom: 15px;
		max-width: 49px;
		max-height: 30px;
	}

	[data-prototype-placemark].tech[data-viewed="true"] .price {
		width: 55px;
		height: 30px;
		padding: 0 3px;
	}

	[data-prototype-placemark].tech[data-viewed="true"] .price .type {
		font-size: 9px;
	}

	[data-prototype-placemark].tech[data-viewed="true"] .price .number {
		font-size: 15px;
	}

	[data-prototype-placemark].tech.onModeration .price {
		background-color: #da314b;
		color: #fff;
	}

</style>
<div data-prototype-placemark="<?php echo $item->get('id', 'x'); ?>"
	 data-placemark-coordinates="[[[-65, -65],[65, -65],[65, 0],[65, 0],[0, 0],[-65, -10],[-65, -10]]]"
	 class="placemark tech<?php echo ($onModeration) ? ' onModeration' : ''; ?>" data-viewed="false">
	<div class="price">
		<?php $price_type = $extra_filter->get('price_hs', 'h'); ?>
		<div class="type"><?php echo Text::_('TPL_NERUDAS_PRICE_TYPE_' . $price_type); ?></div>
		<div class="number">
			<?php echo $extra->get('price_' . $price_type, '---'); ?>
		</div>
	</div>
	<?php echo HTMLHelper::image($image, $item->get('title', Text::_('JGLOBAL_TITLE'))); ?>
	<div class="title"><?php echo $item->get('title', Text::_('JGLOBAL_TITLE')); ?></div>
</div>