<?php
/**
 * @package    Nerudas Template
 * @version    4.9.19
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

use Joomla\CMS\Language\Text;
use Joomla\Registry\Registry;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\Utilities\ArrayHelper;

defined('_JEXEC') or die;

extract($displayData);

/**
 * Layout variables
 * -----------------
 * @var   Registry $item      Item data
 * @var   Registry $extra     Item extra data
 * @var   Registry $category  Category data
 * @var   Registry $placemark Placemark data
 * @var   Registry $map       Map data
 */

$images = ArrayHelper::fromObject($item->get('images'));

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

$as_copmany = ($item->get('author_company'));

$author         = new stdClass();
$author->online = $item->get('author_online');
$author->name   = (!$as_copmany) ? $item->get('author_name') : $item->get('author_job_name');
$author->link   = (!$as_copmany) ? $item->get('author_link') : $item->get('author_job_link');
$author->image  = (!$as_copmany) ? $item->get('author_avatar') : $item->get('author_job_logo');
if (!($author->image))
{
	$author->image = '/media/com_profiles/images/no-avatar.jpg';
}
$author->subname = '';
$author->sublink = (!$as_copmany) ? $item->get('author_job_link') : $item->get('author_link');
if (!$as_copmany)
{
	$author->subname = (!empty($item->get('author_job_name'))) ? $item->get('author_job_name')
		: '[' . Text::_('TPL_NERUDAS_NO_COMPANY') . ']';
}
else
{
	$author->subname = (!empty($item->get('author_position'))) ? $item->get('author_position')
		: $item->get('author_name');
}
$author->text = (!$as_copmany) ? $item->get('author_status') : $item->get('author_job_about');
$author->text = JHtmlString::truncate($author->text, 150, false, false);
?>
<div class="item nerud uk-panel uk-panel-box uk-margin-bottom">
	<div class="title uk-flex uk-flex-space-between">
		<div class="author uk-clearfix uk-width-1-1">
			<div class="avatar uk-position-relative uk-display-inline-block uk-align-left  uk-margin-bottom-remove">
				<a class="image uk-avatar-48<?php echo ($as_copmany) ? ' logo' : ''; ?>"
				   data-prototype-show="<?php echo $item->get('id'); ?>"
				   style="background-image: url('<?php echo $author->image; ?>');">
				</a>
				<?php if ($author->online): ?>
					<i class="uk-position-bottom-right uk-icon-profile-state-online"></i>
				<?php endif; ?>
			</div>
			<div class="text uk-text-ellipsis">
				<div class="name">
					<a data-prototype-show="<?php echo $item->get('id'); ?>">
						<?php echo $author->name; ?>
					</a>
				</div>
				<div class="job uk-text-uppercase-letter uk-text-small uk-text-ellipsis">
					<a class="uk-text-muted"
					   data-prototype-show="<?php echo $item->get('id'); ?>">
						<?php echo $author->name; ?>
					</a>
				</div>
			</div>
		</div>
		<div class="uk-text-right">
			<div class="uk-text-nowrap">
				<time class="timeago uk-text-muted uk-text-small uk-text-nowrap uk-margin-small-left"
					  data-uk-tooltip
					  datetime="<?php echo HTMLHelper::date($item->get('created'), 'c'); ?>"
					  title="<?php echo HTMLHelper::date($item->get('reated'), 'd.m.Y H:i'); ?>"></time>
			</div>
			<div class="uk-text-right uk-margin-small-bottom uk-text-nowrap">
				<a data-prototype-show="<?php echo $item->get('id'); ?>"
				   class="uk-badge uk-badge-white uk-margin-small-left">
					<i class="uk-icon-eye uk-margin-small-right"></i><?php echo $item->get('hits'); ?>
				</a>
				<?php if ($onModeration): ?>
					<span class="uk-badge uk-badge-danger uk-margin-small-left">
						<?php echo Text::_('TPL_NERUDAS_ONMODERATION'); ?>
					</span>
				<?php endif; ?>
			</div>
		</div>
	</div>

	<a class="uk-margin-small-top uk-grid uk-grid-small uk-link-muted"
	   data-prototype-show="<?php echo $item->get('id'); ?>">
		<div class="uk-width-small-3-4">
			<div class="uk-h4 uk-margin-small-bottom">
				<?php echo $item->get('title'); ?>
			</div>
			<div class="uk-text-small">
				<?php echo nl2br($extra->get('why_you')); ?>
			</div>
		</div>
		<div class="uk-width-small-1-4 uk-flex uk-flex-middle uk-flex-right">
			<div class="price uk-text-right">
				<?php if ($catFields->get('price_m3')): ?>
					<div>
						<span class="uk-text-medium uk-text-bold">
							<?php echo $extra->get('price_m3', '---'); ?>
						</span>
						<span class="uk-text-small uk-text-muted uk-text-uppercase">
							<?php echo Text::_('TPL_NERUDAS_PRICE_TYPE_RUB')
								. '/' . Text::_('TPL_NERUDAS_PRICE_TYPE_M3'); ?>
						</span>
					</div>
				<?php endif; ?>
				<?php if ($catFields->get('price_t')): ?>
					<div>
						<span class="uk-text-medium uk-text-bold">
							<?php echo $extra->get('price_t', '---'); ?>
						</span>
						<span class="uk-text-small uk-text-muted uk-text-uppercase">
							<?php echo Text::_('TPL_NERUDAS_PRICE_TYPE_RUB')
								. '/' . Text::_('TPL_NERUDAS_PRICE_TYPE_T'); ?>
						</span>
					</div>
				<?php endif; ?>
				<?php if ($catFields->get('price_o')): ?>
					<div>
						<span class="uk-text-medium uk-text-bold">
							<?php echo $extra->get('price_o', '---'); ?>
						</span>
						<span class="uk-text-small uk-text-muted uk-text-uppercase">
							<?php echo Text::_('TPL_NERUDAS_PRICE_TYPE_RUB')
								. '/' . Text::_('TPL_NERUDAS_PRICE_TYPE_O'); ?>
						</span>
					</div>
				<?php endif; ?>
				<?php if ($catFields->get('price_h')): ?>
					<div>
						<span class="uk-text-medium uk-text-bold">
							<?php echo $extra->get('price_h', '---'); ?>
						</span>
						<span class="uk-text-small uk-text-muted uk-text-uppercase">
							<?php echo Text::_('TPL_NERUDAS_PRICE_TYPE_RUB')
								. '/' . Text::_('TPL_NERUDAS_PRICE_TYPE_H'); ?>
						</span>
					</div>
				<?php endif; ?>
				<?php if ($catFields->get('price_s')): ?>
					<div>
						<span class="uk-text-medium uk-text-bold">
							<?php echo $extra->get('price_s', '---'); ?>
						</span>
						<span class="uk-text-small uk-text-muted uk-text-uppercase">
							<?php echo Text::_('TPL_NERUDAS_PRICE_TYPE_RUB')
								. '/' . Text::_('TPL_NERUDAS_PRICE_TYPE_S'); ?>
						</span>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</a>
	<div class="uk-margin-top uk-grid uk-grid-small">
		<div class="uk-width-small-2-3 uk-flex uk-flex-bottom">
			<?php if ($contacts->get('phones')) : ?>
				<?php foreach ($contacts->get('phones') as $phone): ?>
					<a class="uk-text-xlarge uk-display-block"
					   href="tel:<?php echo $phone->code . $phone->number; ?>">
						<?php $phone->display = (!empty($phone->display)) ?
							$phone->display : $phone->code . $phone->number;
						$regular              = "/(\\+\\d{1})(\\d{3})(\\d{3})(\\d{2})(\\d{2})/";
						$subst                = '$1($2)$3-$4-$5';
						echo preg_replace($regular, $subst, $phone->display); ?>
					</a>
					<?php break; endforeach; ?>
			<?php endif; ?>
		</div>
		<div class="uk-width-small-1-3 uk-flex uk-flex-right uk-flex-bottom">
			<?php
			echo HTMLHelper::image('regions/' . $item->get('region') . '.png', $item->get('region_name'),
				array('title' => $item->get('region_name'), 'data-uk-tooltip' => ''), true); ?>
			<?php if ($map): ?>
				<a data-uk-tooltip title="<?php echo Text::_('TPL_NERUDAS_ON_MAP'); ?>"
				   href="<?php echo $map->get('link'); ?>">
					<?php echo HTMLHelper::image('icons/map_30.png', Text::_('TPL_NERUDAS_ON_MAP'), '', true); ?>
				</a>
			<?php endif; ?>
		</div>
	</div>
	<?php if (!empty($images)) : ?>
		<div class="uk-margin-top">
			<div class="uk-grid uk-grid-small image">
				<?php
				$count = count($images);
				foreach ($images as $image): ?>
					<div class="uk-container-center<?php echo ' uk-width-small-1-' . $count; ?>">
						<a class="uk-position-relative uk-display-block"
						   data-prototype-show="<?php echo $item->get('id'); ?>">
							<span class="image uk-thumbnail uk-display-block uk-cover-background"
								  style="background-image: url('<?php echo $image['src']; ?>')"
								  data-ratio-height="[166,125]"></span>
						</a>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	<?php endif; ?>
	<?php if (!empty($item->get('tags')->itemTags)): ?>
		<div class="uk-margin-small-top tags">
			<?php foreach ($item->get('tags')->itemTags as $tag): ?>
				<span class="uk-tag"><?php echo $tag->title; ?></span>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>
</div>
