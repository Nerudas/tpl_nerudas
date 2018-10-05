<?php
/**
 * @package    Nerudas Template
 * @version    4.9.28
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

$image = ($placemark->get('image', false)) ? $placemark->get('image') : 'templates/nerudas/images/placemarks/ramka.png';

$publish_down = $item->get('publish_down', '0000-00-00 00:00:00');
if ($publish_down == '0000-00-00 00:00:00')
{
	$publish_down = false;
}
if ($publish_down)
{
	$publish_down = Factory::getDate($publish_down)->toSql();
}

$onModeration = (!$item->get('state', 0) || ($publish_down && $publish_down < Factory::getDate()->toSql()));
?>
<style>
	[data-prototype-placemark].ramka {
		display: block;
		position: relative;
		width: 120px;
		height: 68px;
		margin-top: -68px;
		margin-left: -60px;
		color: inherit
	}

	[data-prototype-placemark].ramka .inner {
		position: absolute;
		bottom: 0;
	}

	[data-prototype-placemark].ramka .title {
		position: relative;
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

	[data-prototype-placemark].ramka .title::after {
		position: absolute;
		right: 0;
		bottom: 0;
		content: '';
		width: 10px;
		height: 20px;
		background: rgba(255, 255, 255, 0.7);
	}

	[data-prototype-placemark].ramka .image {
		width: 120px;
		text-align: center;
		z-index: 2;
	}

	[data-prototype-placemark].ramka img {
		max-width: 48px;
		max-height: 48px;
	}

	[data-prototype-placemark].ramka[data-viewed="true"] {
		color: inherit;
		width: 90px;
		height: 60px;
		margin-top: -60px;
		margin-left: -45px;
		opacity: .75;
		filter: brightness(.9)
	}

	[data-prototype-placemark].ramka[data-viewed="true"] .title {
		width: 90px;
		height: 15px;
		font-size: 11px;
	}

	[data-prototype-placemark].ramka[data-viewed="true"] .title::after {
		content: '';
		width: 7px;
		height: 15px;
	}

	[data-prototype-placemark].ramka[data-viewed="true"] .image {
		bottom: 15px;
		width: 90px;
	}

	[data-prototype-placemark].ramka[data-viewed="true"] img {
		max-width: 36px;
		max-height: 36px;
	}

	[data-prototype-placemark].ramka.onModeration .title {
		background-color: #da314b;
		color: #fff;
	}

</style>
<div data-prototype-placemark="<?php echo $item->get('id', 'x'); ?>"
	 data-placemark-coordinates="[[[-60, -68],[60, -68],[60, 0],[60, 0],[0, 0],[-60, -10],[-60, -10]]]"
	 data-placemark-coordinates-viewed="[[[-45, -60],[45, -60],[45, 0],[45, 0],[0, 0],[-45, -10],[-45, -10]]]"
	 class="placemark ramka<?php echo ($onModeration) ? ' onModeration' : ''; ?>" data-viewed="false">
	<div class="inner">
		<div class="title"><?php echo $item->get('title', Text::_('JGLOBAL_TITLE')); ?></div>
		<div class="image">
			<?php echo HTMLHelper::image($image, $item->get('title', Text::_('JGLOBAL_TITLE'))); ?>
		</div>
	</div>
</div>