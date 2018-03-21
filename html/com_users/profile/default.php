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

$this->data->contacts = new Registry($this->data->contacts);

$this->data->avatar = (!empty($this->data->avatar))? $this->data->avatar : 'media/com_profiles/images/no-avatar.jpg'
?>
<div id="office" class="home">
	<div class="uk-grid" data-uk-grid-match="" data-uk-grid-margin="">
		<div class="uk-width-medium-3-4">
			<?php echo LayoutHelper::render('template.title', array('settings' => $editLink)); ?>
		</div>
		<div class="uk-width-medium-1-4 uk-flex uk-flex-middle">
			<a   class="uk-button uk-button-large  uk-width-1-1 uk-margin-bottom">
			0 <i class="uk-icon-rub"></i></a>
		</div>
	</div>
	<div class="uk-margin-bottom">

		<div class="profile uk-width-1-1">
			<div class="avatar">
				<a href="<?php echo $profileLink; ?>" class="image"
				   style="background-image: url('<?php echo $this->data->avatar; ?>')">
				</a>
			</div>
			<div class="content">
				<div class="uk-flex uk-flex-wrap uk-flex-space-between uk-margin-bottom">
					<a href="<?php echo $profileLink; ?>" class="uk-link-muted uk-text-large">
						<?php echo $this->data->name; ?></a>
					<a href="<?php echo $profileLink; ?>" class="uk-button uk-button-primary">
						<?php echo Text::_('TPL_NERUDAS_OFFICE_SHOW_PROFILE'); ?>
					</a>
				</div>
				<div class="uk-flex">
					<blockquote>
						<?php echo $this->data->status; ?>
					</blockquote>
					<a href="<?php echo $editLink; ?>"
					   class="uk-icon-pencil uk-margin-small-left uk-link-muted"></a>
				</div>
			</div>
		</div>

	</div>
	<div class="uk-grid" data-uk-grid-match="" data-uk-grid-margin="">
		<div class="uk-width-medium-1-2">
			<ul class="uk-tab-new uk-margin-bottom-remove" data-uk-switcher="{connect:'#leftTabs', swiping: false}">
				<li><a href="#profile"><?php echo Text::_('TPL_NERUDAS_OFFICE_MY_PROFILE'); ?></a></li>
				<li><a href="#board"><?php echo Text::_('TPL_NERUDAS_OFFICE_MY_BOARD_ITEMS'); ?></a></li>
			</ul>
			<ul id="leftTabs" class="uk-switcher" data-uk-switcher-tabs="">
				<li data-tab="profile" class="uk-panel uk-panel-box">
					<dl class="uk-description-list-horizontal">
						<?php if ($this->data->contacts->get('phones', false)) : ?>
							<dt><?php echo Text::_('JGLOBAL_FIELD_PHONES_LABEL'); ?></dt>
							<dd class="uk-margin-bottom">
								<?php foreach ($this->data->contacts->get('phones') as $phone): ?>
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
							</dd>
						<?php endif; ?>
						<?php if (!empty($this->data->contacts->get('email', ''))) : ?>
							<dt><?php echo Text::_('JGLOBAL_EMAIL'); ?></dt>
							<dd class="uk-margin-bottom">
								<a class="uk-margin-small-bottom"
								   href="mailto:<?php echo $this->data->contacts->get('email'); ?>">
									<?php echo $this->data->contacts->get('email'); ?>
								</a>
							</dd>
						<?php endif; ?>
						<?php if (!empty($this->data->contacts->get('site', ''))) : ?>
							<dt><?php echo Text::_('COM_PROFILES_PROFILE_SITE'); ?></dt>
							<dd class="uk-margin-bottom">
								<a class="uk-margin-small-bottom"
								   href="<?php echo $this->data->contacts->get('site'); ?>"
								   target="_blank">
									<?php echo trim(str_replace(array('http://', 'https://'), '', $this->data->contacts->get('site')), '/'); ?>
								</a>
							</dd>
						<?php endif; ?>
						<?php if (!empty($this->data->contacts->get('vk', ''))) : ?>
							<dt><?php echo Text::_('JGLOBAL_FIELD_SOCIAL_LABEL_VK'); ?></dt>
							<dd class="uk-margin-bottom">
								<a class="uk-margin-small-bottom"
								   href="https://vk.com/<?php echo $this->data->contacts->get('vk'); ?>"
								   target="_blank">
									vk.com/<?php echo $this->data->contacts->get('vk'); ?>
								</a>
							</dd>
						<?php endif; ?>
						<?php if (!empty($this->data->contacts->get('facebook', ''))) : ?>
							<dt><?php echo Text::_('JGLOBAL_FIELD_SOCIAL_LABEL_FB'); ?></dt>
							<dd class="uk-margin-bottom">
								<a class="uk-margin-small-bottom"
								   href="https://facebook.com/<?php echo $this->data->contacts->get('facebook'); ?>"
								   target="_blank">
									facebook.com/<?php echo $this->data->contacts->get('facebook'); ?>
								</a>
							</dd>
						<?php endif; ?>
						<?php if (!empty($this->data->contacts->get('instagram', ''))) : ?>
							<dt><?php echo Text::_('JGLOBAL_FIELD_SOCIAL_LABEL_INST'); ?></dt>
							<dd class="uk-margin-bottom">
								<a class="uk-margin-small-bottom"
								   href="https://instagram.com/<?php echo $this->data->contacts->get('instagram'); ?>"
								   target="_blank">
									instagram.com/<?php echo $this->data->contacts->get('instagram'); ?>
								</a>
							</dd>
						<?php endif; ?>
					</dl>
					<div class="uk-margin-bottom">

						<a href="<?php echo $editLink; ?>" class="uk-button uk-button-success">
							<?php echo Text::_('TPL_NERUDAS_OFFICE_MY_PROFILE_EDIT'); ?>
						</a>
						<a href="<?php echo $editLink; ?>" class="uk-button uk-button-danger">
							<?php echo Text::_('COM_PROFILES_PROFILE_CHANGE_PASSWORD'); ?>
						</a>
					</div>
				</li>
				<li data-tab="board" class="">
					<?php echo $myBoardModule; ?>
				</li>
			</ul>
		</div>
		<div class="uk-width-medium-1-2">
			<ul class="uk-tab-new uk-margin-bottom-remove" data-uk-switcher="{connect:'#rightTabs', swiping: false}">
				<li><a href="#comments-me"><?php echo Text::_('TPL_NERUDAS_OFFICE_COMMENTS_ME'); ?></a></li>
				<li><a href="#my-discussions"><?php echo Text::_('TPL_NERUDAS_OFFICE_MY_DISCUSSIONS'); ?></a></li>
			</ul>
			<ul id="rightTabs" class="uk-switcher" data-uk-switcher-tabs="">
				<li data-tab="comments-me" class="uk-panel uk-panel-box">
					<div class="uk-text-muted uk-text-large uk-text-center">
						<?php echo Text::_('TPL_NERUDAS_IN_DEVELOPING'); ?>
					</div>
				</li>
				<li data-tab="items-discussions" class="uk-panel uk-panel-box">
					<div class="uk-text-muted uk-text-large uk-text-center">
						<?php echo Text::_('TPL_NERUDAS_IN_DEVELOPING'); ?>
					</div>
				</li>
			</ul>
		</div>
	</div>
</div>
