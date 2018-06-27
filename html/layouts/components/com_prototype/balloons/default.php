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

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Date\Date;
use Joomla\Registry\Registry;
use Joomla\CMS\Router\Route;

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
		<?php if (!empty($item->get('images'))): ?>
			<?php foreach ($item->get('images') as $image): ?>
				<div class="uk-width-1-1 uk-margin-bottom">
					<?php echo HTMLHelper::image($image->src,
						$item->get('title', Text::_('JGLOBAL_TITLE')), array('class' => 'uk-width-1-1')); ?>
				</div>
			<?php endforeach; ?>
		<?php else: ?>
			<div>
				<?php echo HTMLHelper::image($image,
					$item->get('title', Text::_('JGLOBAL_TITLE')), array('class' => 'uk-width-1-1')); ?>
			</div>
		<?php endif; ?>
	</div>
	<div class="uk-width-medium-3-4">
		<div class="uk-margin-bottom uk-text-xlarge uk-margin-remove">
			<?php echo $item->get('title', Text::_('JGLOBAL_TITLE')); ?>
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
		<?php if (!empty($item->get('html'))): ?>
			<div>
				<?php echo $item->get('html'); ?>
			</div>
		<?php elseif (!empty($extra->get('why_you'))): ?>
			<div class="uk-text-medium">
				<?php echo nl2br($extra->get('why_you')); ?>
			</div>
		<?php elseif (!empty($extra->get('comment'))): ?>
			<div class="uk-text-medium">
				<?php echo nl2br($extra->get('comment')); ?>
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

