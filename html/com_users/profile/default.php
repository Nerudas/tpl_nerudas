<?php
/**
 * @package    Nerudas Template
 * @version    4.9.20
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
use Joomla\CMS\HTML\HTMLHelper;

if (Factory::getUser()->id != $this->data->id)
{
	Factory::getApplication()->redirect(Route::_('index.php?option=com_users&view=profile'));
}

HTMLHelper::_('jquery.framework');

JLoader::register('ProfilesHelperRoute', JPATH_SITE . '/components/com_profiles/helpers/route.php');
$profileLink = Route::_(ProfilesHelperRoute::getProfileRoute($this->data->id));
$editLink    = Route::_('index.php?option=com_users&task=profile.edit&user_id=' . $this->data->id);

JLoader::register('CompaniesHelperRoute', JPATH_SITE . '/components/com_companies/helpers/route.php');
$companyAddLink = Route::_(CompaniesHelperRoute::getFormRoute());

// Board Module
$myBoardModule            = new stdClass();
$myBoardModule->id        = 0;
$myBoardModule->title     = Text::_('TPL_NERUDAS_OFFICE_MY_BOARD');
$myBoardModule->module    = 'mod_board_latest';
$myBoardModule->position  = '';
$myBoardModule->content   = '';
$myBoardModule->showtitle = 0;
$myBoardModule->control   = '';
$myBoardModule->params    = new Registry();
$myBoardModule->params->set('layout', 'nerudas:my');
$myBoardModule->params->set('style', 'blank');
$myBoardModule->params->set('onlymy', 1);
$myBoardModule->params->set('allregions', 1);
$myBoardModule->params = (string) $myBoardModule->params;
$myBoardModule->style  = 'blank';
$myBoardModule         = ModuleHelper::renderModule($myBoardModule);

// Topics Module
$myTopicsModule            = new stdClass();
$myTopicsModule->id        = 0;
$myTopicsModule->title     = Text::_('TPL_NERUDAS_OFFICE_MY_DISCUSSIONS');
$myTopicsModule->module    = 'mod_discussions_latest_topics';
$myTopicsModule->position  = '';
$myTopicsModule->content   = '';
$myTopicsModule->showtitle = 0;
$myTopicsModule->control   = '';
$myTopicsModule->params    = new Registry();
$myTopicsModule->params->set('layout', 'nerudas:my');
$myTopicsModule->params->set('style', 'blank');
$myTopicsModule->params->set('onlymy', 1);
$myTopicsModule->params = (string) $myTopicsModule->params;
$myTopicsModule->style  = 'blank';
$myTopicsModule         = ModuleHelper::renderModule($myTopicsModule);

// Prototype module
$myPrototypeModule            = new stdClass();
$myPrototypeModule->id        = 0;
$myPrototypeModule->title     = Text::_('TPL_NERUDAS_OFFICE_MY_PROTOTYPE');
$myPrototypeModule->module    = 'mod_prototype_latest';
$myPrototypeModule->position  = '';
$myPrototypeModule->content   = '';
$myPrototypeModule->showtitle = 0;
$myPrototypeModule->control   = '';
$myPrototypeModule->params    = new Registry();
$myPrototypeModule->params->set('layout', 'nerudas:my');
$myPrototypeModule->params->set('style', 'blank');
$myPrototypeModule->params->set('onlymy', 1);
$myPrototypeModule->params->set('limit', 0);
$myPrototypeModule->params->set('allregions', 1);
$myPrototypeModule->params = (string) $myPrototypeModule->params;
$myPrototypeModule         = ModuleHelper::renderModule($myPrototypeModule);

$this->data->contacts = new Registry($this->data->contacts);

$this->data->avatar = (!empty($this->data->avatar)) ? $this->data->avatar : 'media/com_profiles/images/no-avatar.jpg'
?>
<div id="office" class="home">
	<div class="uk-grid" data-uk-grid-match="" data-uk-grid-margin="">
		<div class="uk-width-medium-3-4">
			<?php echo LayoutHelper::render('template.title', array('settings' => $editLink)); ?>
		</div>
		<div class="uk-width-medium-1-4 uk-flex uk-flex-middle">
			<a class="uk-button uk-button-large  uk-width-1-1 uk-margin-bottom">
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
				<li><a href="#company"><?php echo (empty($this->data->jobs)) ?
							Text::_('TPL_NERUDAS_NO_COMPANY') :
							Text::_('TPL_NERUDAS_OFFICE_MY_COMPANY'); ?></a></li>
				<li><a href="#board"><?php echo Text::_('TPL_NERUDAS_OFFICE_MY_BOARD'); ?></a></li>
				<li><a href="#discussion"><?php echo Text::_('TPL_NERUDAS_OFFICE_MY_DISCUSSIONS'); ?></a></li>
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
				<li data-tab="company" class="uk-panel uk-panel-box">
					<?php if (empty($this->data->jobs)): ?>
						<div class="uk-margin-bottom uk-text-right">
							<a href="<?php echo $companyAddLink; ?>" class="uk-button uk-button uk-button-success">
								<?php echo Text::_('TPL_NERUDAS_ACTIONS_ADD'); ?>
							</a>
						</div>
					<?php else: ?>
						<div id="profileJobs" data-input-jobs="profileJobs" class="jobs">
							<?php foreach ($this->data->jobs as $company):
								$seeLink = Route::_(CompaniesHelperRoute::getCompanyRoute($company->id));
								$editLink = ($company->confirm != 'confirm') ? false
									: Route::_(CompaniesHelperRoute::getFormRoute($company->id));
								$deleteLink = Route::_(CompaniesHelperRoute::getEmployeesDeleteRoute($company->id, $this->data->id));
								$confirmLink = Route::_(CompaniesHelperRoute::getEmployeesConfirmRoute($company->id, $this->data->id));
								?>

								<div class="item uk-margin-large-bottom" data->
									<div class="uk-h3 uk-margin-small-bottom">
										<a class="uk-display-block uk-link-muted" href="<?php echo $seeLink; ?>">
											<?php echo $company->name; ?>
											<?php if ($company->logo): ?>
												<img class="logo" src="<?php echo $company->logo; ?>"
													 alt="<?php echo $company->name; ?>">
											<?php endif; ?>
										</a>
									</div>
									<div class="position">
										<?php if (!empty($company->position)): ?>
											<i>(<?php echo $company->position; ?>)</i>
										<?php endif; ?>
									</div>
									<?php if ($company->confirm !== 'confirm'): ?>
										<div class="confirm uk-margin-top">
											<?php if ($company->confirm == 'user'): ?>
												<div class="uk-text-warning uk-text-small">
													<?php echo Text::_('COM_PROFILES_PROFILE_JOBS_CONFIRM_NEED_USER'); ?>
												</div>
											<?php elseif ($company->confirm == 'company'): ?>
												<div class="uk-text-warning uk-text-small">
													<?php echo Text::_('COM_PROFILES_PROFILE_JOBS_CONFIRM_NEED_COMPANY'); ?>
												</div>
											<?php elseif ($company->confirm == 'error'): ?>
												<div class="uk-text-danger uk-text-small">
													<?php echo Text::_('COM_COMPANIES_ERROR_EMPLOYEES_KEY'); ?>
												</div>
											<?php endif; ?>
										</div>
									<?php endif; ?>
									<div class="actions uk-margin-top">
										<a href="<?php echo $deleteLink; ?>"
										   class="delete uk-button uk-button-small uk-button-danger"
										   title="<?php echo Text::sprintf('COM_PROFILES_PROFILE_JOBS_DELETE_LABEL', $company->name); ?>">
											<?php echo Text::_('TPL_NERUDAS_OFFICE_MY_COMPANY_DELETE'); ?>
										</a>
										<?php if ($company->confirm == 'user'): ?>
											<a href="<?php echo $confirmLink; ?>"
											   class="confirm uk-button uk-button-small uk-button-success">
												<?php echo Text::_('COM_PROFILES_PROFILE_JOBS_CONFIRM_SUBMIT'); ?>
											</a>
										<?php endif; ?>
										<?php if ($company->confirm == 'confirm'): ?>
											<a href="<?php echo $editLink; ?>"
											   class="uk-button uk-button-small  uk-button-primary">
												<?php echo Text::_('TPL_NERUDAS_ACTIONS_EDIT'); ?>
											</a>
										<?php endif; ?>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>
				</li>
				<li data-tab="board" class="">
					<?php echo $myBoardModule; ?>
				</li>
				<li data-tab="discussions" class="">
					<?php echo $myTopicsModule; ?>
				</li>
			</ul>
		</div>
		<div class="uk-width-medium-1-2">
			<ul class="uk-tab-new uk-margin-bottom-remove" data-uk-switcher="{connect:'#rightTabs', swiping: false}">
				<li>
					<a href="#prototyp"><?php echo Text::_('TPL_NERUDAS_OFFICE_MY_PROTOTYPE'); ?></a>
				</li>
			</ul>
			<ul id="rightTabs" class="uk-switcher" data-uk-switcher-tabs="">
				<li data-tab="prototype" class="uk-panel uk-panel-box uk-padding-remove">
					<?php echo $myPrototypeModule; ?>
				</li>
			</ul>
		</div>
	</div>
</div>
