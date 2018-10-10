<?php
/**
 * @package    Nerudas Template
 * @version    4.9.29
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\Registry\Registry;
use Joomla\Utilities\ArrayHelper;
use Joomla\CMS\Uri\Uri;

extract($displayData);

/**
 * Layout variables
 * -----------------
 * @var   Registry $item      Item data
 * @var   Registry $extra     Item extra data
 * @var   Registry $category  Category data
 * @var   Registry $placemark Placemark data
 */

$images = ArrayHelper::fromObject($item->get('images'));
if (empty($images))
{
	$images['image_1'] = array('src' => 'templates/nerudas/images/noimage.jpg');
}

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
	$author->image = 'media/com_profiles/images/no-avatar.jpg';
}
$author->image   = trim(Uri::root(true), '/') . '/' . $author->image;
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
<div class="prototype baloon-tovar uk-grid uk-margin-top-remove" data-uk-grid-margin data-uk-grid-match>
	<div class="uk-width-medium-3-10">
		<div>
			<div class="uk-slidenav-position uk-slidenav-imagenavs uk-position-relative uk-balloon-slideshow"
				 data-uk-slideshow="{autoplay:true, autoplayInterval: 3000}">
				<ul class="uk-slideshow">
					<?php foreach ($images as $image): ?>
						<li>
							<div class="image uk-display-block uk-cover-background"
								 style="background-image: url('/<?php echo $image['src']; ?>');">
							</div>
						</li>
					<?php endforeach; ?>
				</ul>
				<a href="" class="uk-slidenav uk-slidenav-previous" data-uk-slideshow-item="previous"></a>
				<a href="" class="uk-slidenav uk-slidenav-next" data-uk-slideshow-item="next"></a>
				<div class="uk-position-bottom-right uk-position-z-index navigation">
					<ul class=" uk-grid uk-grid-collapse">
						<?php $i = 0;
						foreach ($images as $image): ?>
							<li data-uk-slideshow-item="<?php echo $i; ?>">
								<a href="">
									<div class="image uk-display-block uk-cover-background"
										 style="background-image: url('/<?php echo $image['src']; ?>');"></div>
								</a>
							</li>
							<?php $i++; ?>
						<?php endforeach; ?>
					</ul>
				</div>
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
	<div class="uk-width-medium-4-10">
		<div class="uk-grid uk-grid-small" data-uk-grid-margin data-uk-grid-match>
			<div class="title uk-width-medium-1-2">
				<div class="uk-text-xlarge uk-margin-remove">
					<?php echo $item->get('title', Text::_('JGLOBAL_TITLE')); ?>
				</div>
				<div class="uk-margin-bottom uk-text-muted uk-text-lowercase">
					<?php if ($category->get('parent_level') > 1): ?>
						<span><?php echo $category->get('parent_title'); ?> </span>
					<?php endif; ?>
					<span><?php echo $category->get('title'); ?></span>
				</div>
			</div>
			<div class="price uk-width-medium-1-2 uk-text-right">
				<?php if ($catFields->get('price_m3')): ?>
					<div>
						<span class="uk-text-large uk-text-bold">
							<?php echo $extra->get('price_m3', '---'); ?>
						</span>
						<span class="uk-text-muted uk-text-uppercase">
							<?php echo Text::_('TPL_NERUDAS_PRICE_TYPE_RUB')
								. '/' . Text::_('TPL_NERUDAS_PRICE_TYPE_M3'); ?>
						</span>
					</div>
				<?php endif; ?>
				<?php if ($catFields->get('price_t')): ?>
					<div>
						<span class="uk-text-large uk-text-bold">
							<?php echo $extra->get('price_t', '---'); ?>
						</span>
						<span class="uk-text-muted uk-text-uppercase">
							<?php echo Text::_('TPL_NERUDAS_PRICE_TYPE_RUB')
								. '/' . Text::_('TPL_NERUDAS_PRICE_TYPE_T'); ?>
						</span>
					</div>
				<?php endif; ?>
				<?php if ($catFields->get('price_h')): ?>
					<div>
						<span class="uk-text-large uk-text-bold">
							<?php echo $extra->get('price_h', '---'); ?>
						</span>
						<span class="uk-text-muted uk-text-uppercase">
							<?php echo Text::_('TPL_NERUDAS_PRICE_TYPE_RUB')
								. '/' . Text::_('TPL_NERUDAS_PRICE_TYPE_H'); ?>
						</span>
					</div>
				<?php endif; ?>
				<?php if ($catFields->get('price_s')): ?>
					<div>
						<span class="uk-text-large uk-text-bold">
							<?php echo $extra->get('price_s', '---'); ?>
						</span>
						<span class="uk-text-muted uk-text-uppercase">
							<?php echo Text::_('TPL_NERUDAS_PRICE_TYPE_RUB')
								. '/' . Text::_('TPL_NERUDAS_PRICE_TYPE_S'); ?>
						</span>
					</div>
				<?php endif; ?>
				<?php if ($catFields->get('price_o')): ?>
					<div>
						<span class="uk-text-large uk-text-bold">
							<?php echo $extra->get('price_o', '---'); ?>
						</span>
						<span class="uk-text-muted uk-text-uppercase">
							<?php echo Text::_('TPL_NERUDAS_PRICE_TYPE_RUB')
								. '/' . Text::_('TPL_NERUDAS_PRICE_TYPE_O'); ?>
						</span>
					</div>
				<?php endif; ?>
			</div>
		</div>
		<?php if (!empty($extra->get('why_you'))): ?>
			<div>
				<?php echo nl2br($extra->get('why_you')); ?>
			</div>
		<?php endif; ?>
	</div>
	<div class="uk-width-medium-3-10">
		<div class="author uk-clearfix uk-width-1-1">
			<div class="avatar uk-position-relative uk-display-inline-block uk-align-left  uk-margin-bottom-remove">
				<a class="image uk-avatar-48<?php echo ($as_copmany) ? ' logo' : ''; ?>"
				   href="<?php echo $author->link; ?>"
				   style="background-image: url('<?php echo $author->image; ?>');">
				</a>
				<?php if ($author->online): ?>
					<i class="uk-position-bottom-right uk-icon-profile-state-online"></i>
				<?php endif; ?>
			</div>
			<div class="sub uk-text-ellipsis">
				<div class="name">
					<a href="<?php echo $author->link; ?>">
						<?php echo $author->name; ?>
					</a>
				</div>
				<div class="job uk-text-uppercase-letter uk-text-small uk-text-ellipsis">
					<a class="uk-text-muted" href="<?php echo $author->sublink; ?>">
						<?php echo $author->subname; ?>
					</a>
				</div>
			</div>
		</div>
		<div class="uk-text-small uk-text-muted">
			<?php echo $author->text; ?>
		</div>
		<?php if ($contacts) : ?>
			<div class="uk-margin-small-top">
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
	<div class="uk-text-right uk-margin-top">
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

