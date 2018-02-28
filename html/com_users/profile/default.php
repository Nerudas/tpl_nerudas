<?php
/**
 * @package    Nerudas Template
 * @version    4.9.6
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Helper\ModuleHelper;
use Joomla\Registry\Registry;

if (Factory::getUser()->id != $this->data->id)
{
	Factory::getApplication()->redirect(Route::_('index.php?option=com_users&view=profile'));
}
JLoader::register('ProfilesHelperRoute', JPATH_SITE . '/components/com_profiles/helpers/route.php');
$profileLink = Route::_(ProfilesHelperRoute::getProfileRoute($this->data->id));
$editLink    = Route::_('index.php?option=com_users&task=profile.edit&user_id=' . $this->data->id);

$myBoardModule           = ModuleHelper::getModule('mod_board_latest', Text::_('MOD_BOARD_LATEST_ITEMS'));
$myBoardModule->position = '';
$myBoardModule->params   = new Registry($myBoardModule->params);
$myBoardModule->params->set('layout', 'nerudas:my');
$myBoardModule->params->set('style', 'blank');
$myBoardModule->params->set('onlymy', 1);
$myBoardModule->params->set('allregions', 1);
$myBoardModule->params = (string) $myBoardModule->params;
$myBoardModule->style  = 'blank';
$myBoardModule         = ModuleHelper::renderModule($myBoardModule);

?>
<div id="office" class="home">
	<div class="uk-grid" data-uk-grid-match="" data-uk-grid-margin="">
		<div class="uk-width-medium-3-4">
			<?php echo LayoutHelper::render('template.title'); ?>
		</div>
		<div class="uk-width-medium-1-4 uk-flex uk-flex-middle">
			<a href="<?php echo $profileLink; ?>"
			   class="uk-button uk-button-large uk-width-1-1 uk-margin-bottom">
				<?php echo Text::_('TPL_NERUDAS_OFFICE_SHOW_PROFILE'); ?></a>
		</div>
	</div>
	<div class="uk-grid" data-uk-grid-match="" data-uk-grid-margin="">
		<div class="uk-width-medium-2-3 uk-flex uk-flex-middle">
			<div class="profile uk-width-1-1">
				<div class="avatar">
					<a href="<?php echo $profileLink; ?>" class="image"
					   style="background-image: url('<?php echo $this->data->avatar; ?>')">
					</a>
				</div>
				<div class="content">
					<div class="uk-text-large">
						<a href="<?php echo $profileLink; ?>" class="uk-link-muted uk-display-block">
							<?php echo $this->data->name; ?></a>
					</div>
					<div class="uk-grid" data-uk-grid-match="" data-uk-grid-margin="">
						<div class="uk-width-1-2 uk-width-medium-3-4  uk-flex uk-flex-middle">
							<a href="" class="uk-button">
								<?php echo Text::_('TPL_NERUDAS_ACTIONS_EDIT'); ?>
							</a>
						</div>
						<div class="uk-width-1-2 uk-width-medium-1-4 uk-text-right uk-flex uk-flex-middle">
							<div class="uk-text-right uk-width-1-1 uk-text-nowrap">
								<span class="uk-badge uk-badge-white uk-margin-small-left">
									<i class="uk-icon-eye uk-margin-small-right"></i><?php echo $this->data->hits; ?>
								</span>
								<a href="<?php echo $profileLink; ?>#comments"
								   class="uk-badge uk-badge-white uk-margin-small-left">
									<i class="uk-icon-comment-o uk-margin-small-right"></i>0
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="uk-width-medium-1-3 uk-flex uk-flex-middle">
			<div class="company uk-width-1-1">
				<div class="uk-text-center">
					<a class="uk-button uk-button-large uk-button-success uk-margin-bottom uk-text-uppercase">
						<?php echo Text::_('TPL_NERUDAS_OFFICE_ADD_COMPANY'); ?></a>
				</div>
			</div>
		</div>
	</div>
	<div class="uk-grid" data-uk-grid-match="" data-uk-grid-margin="">
		<div class="uk-width-medium-1-2">
			<ul class="uk-tab-new uk-margin-bottom-remove" data-uk-switcher="{connect:'#itemsTabs', swiping: false}">
				<li><a href="#items-board"><?php echo Text::_('TPL_NERUDAS_OFFICE_MY_BOARD_ITEMS'); ?></a></li>
				<li><a href="#items-discussions"><?php echo Text::_('TPL_NERUDAS_OFFICE_MY_DISCUSSIONS'); ?></a></li>
			</ul>
			<ul id="itemsTabs" class="uk-switcher" data-uk-switcher-tabs="">
				<li data-tab="items-board" class="">
					<?php echo $myBoardModule; ?>
				</li>
				<li data-tab="items-discussions" class="uk-panel uk-panel-box">
					<div class="uk-text-muted uk-text-large uk-text-center">
						<?php echo Text::_('TPL_NERUDAS_IN_DEVELOPING'); ?>
					</div>
				</li>
			</ul>
		</div>
		<div class="uk-width-medium-1-2">
			<ul class="uk-tab-new uk-margin-bottom-remove" data-uk-switcher="{connect:'#commentsTabs', swiping: false}">
				<li><a href="#comments-me"><?php echo Text::_('TPL_NERUDAS_OFFICE_COMMENTS_ME'); ?></a></li>
				<li><a href="#comments-company"><?php echo Text::_('TPL_NERUDAS_OFFICE_COMMENTS_COMPANY'); ?></a></li>
				<li><a href="#comments-others"><?php echo Text::_('TPL_NERUDAS_OFFICE_COMMENTS_OTHERS'); ?></a></li>
			</ul>
			<ul id="commentsTabs" class="uk-switcher" data-uk-switcher-tabs="">
				<li data-tab="comments-me" class="uk-panel uk-panel-box">
					<div class="uk-text-muted uk-text-large uk-text-center">
						<?php echo Text::_('TPL_NERUDAS_IN_DEVELOPING'); ?>
					</div>
				</li>
				<li data-tab="comments-company" class="uk-panel uk-panel-box">
					<div class="uk-text-muted uk-text-large uk-text-center">
						<?php echo Text::_('TPL_NERUDAS_IN_DEVELOPING'); ?>
					</div>
				</li>
				<li data-tab="comments-others" class="uk-panel uk-panel-box">
					<div class="uk-text-muted uk-text-large uk-text-center">
						<?php echo Text::_('TPL_NERUDAS_IN_DEVELOPING'); ?>
					</div>
				</li>
			</ul>
		</div>
	</div>
</div>
