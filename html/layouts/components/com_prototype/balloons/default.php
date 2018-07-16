<?php
/**
 * @package    Nerudas Template
 * @version    4.9.23
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
use Joomla\CMS\Router\Route;
use Joomla\Utilities\ArrayHelper;

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
<div class="uk-grid" data-uk-grid-margin data-uk-grid-match>
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
	</div>
	<div class="uk-width-medium-7-10">
		<div class="title">
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
		<?php if (!empty($item->get('html'))): ?>
			<div>
				<?php echo $item->get('html'); ?>
			</div>
		<?php elseif (!empty($extra->get('comment'))): ?>
			<div class="uk-text-medium">
				<?php echo nl2br($extra->get('comment')); ?>
			</div>
		<?php endif; ?>

		<div class="info uk-text-muted uk-flex uk-flex-wrap uk-flex-middle uk-margin-top">
			<div>
				<?php echo Text::_('TPL_NERUDAS_DATE_INFO_EDIT'); ?>:
				<?php echo HTMLHelper::date($item->get('created'), 'd M Y'); ?>
			</div>
			<div class="uk-margin-small-left uk-margin-small-right">|</div>
			<div>
				<i class="uk-icon-eye uk-margin-small-right"></i><?php echo $item->get('hits'); ?>
			</div>
			<?php if (!empty($extra->get('discussion_link'))): ?>
				<div class="uk-margin-small-left uk-margin-small-right">|</div>
				<div>
					<a href="<?php echo Route::_($extra->get('discussion_link')); ?>"
					   class="uk-button uk-button-primary uk-button-small">
						<i class="uk-icon-comment-o uk-margin-small-right"></i>
						<?php echo Text::_('TPL_NERUDAS_ACTIONS_DISCUSS'); ?>
					</a>
				</div>
			<?php endif; ?>
		</div>
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

