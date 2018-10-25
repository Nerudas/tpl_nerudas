<?php
/**
 * @package    Nerudas Template
 * @version    4.9.30
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;

use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Helper\ModuleHelper;
use Joomla\Registry\Registry;

// Prototype module
$prototypeModule            = new stdClass();
$prototypeModule->id        = 0;
$prototypeModule->title     = Text::_('TPL_NERUDAS_COMPANY_PROTOTYPE');
$prototypeModule->module    = 'mod_prototype_latest';
$prototypeModule->position  = '';
$prototypeModule->content   = '';
$prototypeModule->showtitle = 0;
$prototypeModule->control   = '';
$prototypeModule->params    = new Registry();
$prototypeModule->params->set('layout', 'nerudas:company');
$prototypeModule->params->set('style', 'blank');
$prototypeModule->params->set('company_id', $this->item->id);
$prototypeModule->params->set('allregions', 1);
$prototypeModule->params = (string) $prototypeModule->params;
$prototypeModule         = ModuleHelper::renderModule($prototypeModule);
?>
<div id="companies" class="item">
	<?php echo LayoutHelper::render('template.title', array('edit' => $this->editLink)); ?>
	<div class="header uk-margin-bottom">
		<div class="bg uk-cover-background uk-flex uk-flex-middle uk-flex-center"
			 style="background-image: url('<?php echo $this->item->header; ?>');">
			<?php if (!empty($this->item->logo)): ?>
				<img class="logo" src="<?php echo $this->item->logo; ?>"
					 alt="<?php echo $this->item->name; ?>">
			<?php endif; ?>
		</div>
		<div class="info uk-flex uk-flex-middle uk-padding-small">
			<div class="content uk-grid uk-grid-small uk-width-1-1" data-uk-grid-match>
				<div class="uk-width-1-2 uk-width-medium-3-4 uk-text-large uk-text-uppercase-letter uk-flex uk-flex-middle">
					<div class="uk-padding-left"><?php echo $this->item->name; ?></div>
				</div>
				<div class="uk-width-1-2 uk-width-medium-1-4 uk-flex uk-flex-middle uk-flex-right">
					<div class="uk-width-1-1 uk-text-right">
						<div class="uk-text-nowrap">
							<time class="timeago uk-text-muted uk-text-small uk-text-nowrap uk-margin-small-left"
								  data-uk-tooltip
								  datetime="<?php echo HTMLHelper::date($this->item->created, 'c'); ?>"
								  title="<?php echo HTMLHelper::date($this->item->created, 'd.m.Y H:i'); ?>"></time>
						</div>
						<div class="uk-text-right uk-margin-small-bottom uk-text-nowrap">
							<span class="uk-badge uk-badge-white uk-margin-small-left">
								<i class="uk-icon-eye uk-margin-small-right"></i><?php echo $this->item->hits; ?>
							</span>
							<a href="<?php echo $this->item->link; ?>#comments"
							   class="uk-badge uk-badge-white uk-margin-small-left">
								<i class="uk-icon-comment-o uk-margin-small-right"></i>
								<?php echo ($this->comments && $this->comments->total) ? $this->comments->total : 0; ?>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<ul class="uk-tab-new uk-margin-bottom-remove" data-uk-switcher="{connect:'#companyTabs', swiping: false}"
		data-save-tabs="companyTabs">
		<li><a href="#about"><?php echo Text::_('COM_COMPANIES_COMPANY_ABOUT'); ?></a></li>
		<?php if ($this->item->contacts) : ?>
			<li><a href="#contacts"><?php echo Text::_('COM_COMPANIES_COMPANY_CONTACTS'); ?></a></li>
		<?php endif; ?>
		<?php if ($this->item->requisites) : ?>
			<li><a href="#requisites"><?php echo Text::_('COM_COMPANIES_COMPANY_REQUISITES'); ?></a></li>
		<?php endif; ?>
		<?php if ($this->item->portfolio) : ?>
			<li><a href="#portfolio"><?php echo Text::_('COM_COMPANIES_COMPANY_PORTFOLIO'); ?></a></li>
		<?php endif; ?>
		<li><a href="#prototype"><?php echo Text::_('TPL_NERUDAS_COMPANY_PROTOTYPE'); ?></a></li>
		<?php if (!empty($this->employees)) : ?>
			<li><a href="#employees"><?php echo Text::_('COM_COMPANIES_EMPLOYEES'); ?></a></li>
		<?php endif; ?>
		<li><a href="#comments"><?php echo Text::_('TPL_NERUDAS_REVIEWS'); ?></a></li>
	</ul>

	<ul id="companyTabs" class="uk-switcher" data-uk-switcher-tabs="">
		<li data-tab="about" class="uk-panel uk-panel-box">
			<div>
				<div>
					<?php echo $this->item->about; ?>
				</div>
				<?php if (!empty($this->item->tags->itemTags)): ?>
					<hr>
					<div class="uk-margin-small-top tags">
						<?php if ($this->item->tags): ?>
							<?php foreach ($this->item->tags->itemTags as $tag): ?>
								<span class="uk-tag"><?php echo $tag->title; ?></span>
							<?php endforeach; ?>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</div>
		</li>
		<?php if ($this->item->contacts) : ?>
			<li data-tab="contacts" class="uk-panel uk-panel-box">
				<div class="uk-text-right">
					<span class="uk-badge uk-badge-white uk-margin-small-left">
						<?php echo $this->item->region_name; ?>
					</span>
				</div>
				<dl class="uk-description-list-horizontal">
					<?php if ($this->item->contacts->get('phones', false)) : ?>
						<dt><?php echo Text::_('JGLOBAL_FIELD_PHONES_LABEL'); ?></dt>
						<dd class="uk-margin-bottom">
							<?php foreach ($this->item->contacts->get('phones') as $phone): ?>
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
					<?php if (!empty($this->item->contacts->get('email', ''))) : ?>
						<dt><?php echo Text::_('JGLOBAL_EMAIL'); ?></dt>
						<dd class="uk-margin-bottom">
							<a class="uk-margin-small-bottom"
							   href="mailto:<?php echo $this->item->contacts->get('email'); ?>">
								<?php echo $this->item->contacts->get('email'); ?>
							</a>
						</dd>
					<?php endif; ?>
					<?php if (!empty($this->item->contacts->get('site', ''))) : ?>
						<dt><?php echo Text::_('COM_COMPANIES_COMPANY_SITE'); ?></dt>
						<dd class="uk-margin-bottom">
							<a class="uk-margin-small-bottom" href="<?php echo $this->item->contacts->get('site'); ?>"
							   target="_blank">
								<?php echo trim(str_replace(array('http://', 'https://'), '', $this->item->contacts->get('site')), '/'); ?>
							</a>
						</dd>
					<?php endif; ?>
					<?php if (!empty($this->item->contacts->get('vk', ''))) : ?>
						<dt><?php echo Text::_('JGLOBAL_FIELD_SOCIAL_LABEL_VK'); ?></dt>
						<dd class="uk-margin-bottom">
							<a class="uk-margin-small-bottom"
							   href="https://vk.com/<?php echo $this->item->contacts->get('vk'); ?>"
							   target="_blank">
								vk.com/<?php echo $this->item->contacts->get('vk'); ?>
							</a>
						</dd>
					<?php endif; ?>
					<?php if (!empty($this->item->contacts->get('facebook', ''))) : ?>
						<dt><?php echo Text::_('JGLOBAL_FIELD_SOCIAL_LABEL_FB'); ?></dt>
						<dd class="uk-margin-bottom">
							<a class="uk-margin-small-bottom"
							   href="https://facebook.com/<?php echo $this->item->contacts->get('facebook'); ?>"
							   target="_blank">
								facebook.com/<?php echo $this->item->contacts->get('facebook'); ?>
							</a>
						</dd>
					<?php endif; ?>
					<?php if (!empty($this->item->contacts->get('instagram', ''))) : ?>
						<dt><?php echo Text::_('JGLOBAL_FIELD_SOCIAL_LABEL_INST'); ?></dt>
						<dd class="uk-margin-bottom">
							<a class="uk-margin-small-bottom"
							   href="https://instagram.com/<?php echo $this->item->contacts->get('instagram'); ?>"
							   target="_blank">
								instagram.com/<?php echo $this->item->contacts->get('instagram'); ?>
							</a>
						</dd>
					<?php endif; ?>
				</dl>
			</li>
		<?php endif; ?>
		<?php if ($this->item->requisites) : ?>
			<li data-tab="requisites" class="uk-panel uk-panel-box">
				<dl class="uk-description-list-horizontal">
					<?php if (!empty($this->item->requisites->get('legal_address', ''))) : ?>
						<dt><?php echo Text::_('COM_COMPANIES_COMPANY_REQUISITES_LEGAL_ADDRESS'); ?></dt>
						<dd class="uk-margin-bottom">
							<?php echo $this->item->requisites->get('legal_address'); ?>
						</dd>
					<?php endif; ?>
					<?php if (!empty($this->item->requisites->get('actual_address', ''))) : ?>
						<dt><?php echo Text::_('COM_COMPANIES_COMPANY_REQUISITES_ACTUAL_ADDRESS'); ?></dt>
						<dd class="uk-margin-bottom">
							<?php echo $this->item->requisites->get('actual_address'); ?>
						</dd>
					<?php endif; ?>
					<?php if (!empty($this->item->requisites->get('inn', ''))) : ?>
						<dt><?php echo Text::_('COM_COMPANIES_COMPANY_REQUISITES_INN'); ?></dt>
						<dd class="uk-margin-bottom">
							<?php echo $this->item->requisites->get('inn'); ?>
						</dd>
					<?php endif; ?>
					<?php if (!empty($this->item->requisites->get('kpp', ''))) : ?>
						<dt><?php echo Text::_('COM_COMPANIES_COMPANY_REQUISITES_KPP'); ?></dt>
						<dd class="uk-margin-bottom">
							<?php echo $this->item->requisites->get('kpp'); ?>
						</dd>
					<?php endif; ?>
					<?php if (!empty($this->item->requisites->get('ogrn', ''))) : ?>
						<dt><?php echo Text::_('COM_COMPANIES_COMPANY_REQUISITES_OGRN'); ?></dt>
						<dd class="uk-margin-bottom">
							<?php echo $this->item->requisites->get('ogrn'); ?>
						</dd>
					<?php endif; ?>
					<?php if (!empty($this->item->requisites->get('checking_account', ''))) : ?>
						<dt><?php echo Text::_('COM_COMPANIES_COMPANY_REQUISITES_OGRN'); ?></dt>
						<dd class="uk-margin-bottom">
							<?php echo $this->item->requisites->get('ogrn'); ?>
						</dd>
					<?php endif; ?>
					<?php if (!empty($this->item->requisites->get('bik', ''))) : ?>
						<dt><?php echo Text::_('COM_COMPANIES_COMPANY_REQUISITES_BIK'); ?></dt>
						<dd class="uk-margin-bottom">
							<?php echo $this->item->requisites->get('bik'); ?>
						</dd>
					<?php endif; ?>
					<?php if (!empty($this->item->requisites->get('bank', ''))) : ?>
						<dt><?php echo Text::_('COM_COMPANIES_COMPANY_REQUISITES_BANK'); ?></dt>
						<dd class="uk-margin-bottom">
							<?php echo $this->item->requisites->get('bank'); ?>
						</dd>
					<?php endif; ?>
					<?php if (!empty($this->item->requisites->get('correspondent_account', ''))) : ?>
						<dt><?php echo Text::_('COM_COMPANIES_COMPANY_REQUISITES_CORRESPONDENT_ACCOUNT'); ?></dt>
						<dd class="uk-margin-bottom">
							<?php echo $this->item->requisites->get('correspondent_account'); ?>
						</dd>
					<?php endif; ?>
				</dl>
			</li>
		<?php endif; ?>
		<?php if ($this->item->portfolio) : ?>
			<li data-tab="portfolio" class="uk-panel uk-panel-box">
				<div class="portfolio uk-grid uk-grid-small image" data-uk-grid-match data-uk-grid-margin>
					<?php $count = count($this->item->portfolio);
					foreach ($this->item->portfolio as $image): ?>
						<div class="uk-width-small-1-<?php echo ($count > 1) ? 3 : 1; ?> uk-flex uk-flex-center uk-flex-top">
							<a class="uk-position-relative uk-display-inline-block" href="/<?php echo $image->src; ?>"
							   data-uk-lightbox="{group:'company_<?php echo $this->item->id; ?>'}"
							   title="<?php echo $image->text; ?>">
								<?php echo HTMLHelper::image($image->src, '', 'class="uk-thumbnail"'); ?>
								<div class="uk-text-center uk-text-muted uk-margin-small-top uk-margin-small-bottom">
									<?php echo $image->text; ?>
								</div>
							</a>
						</div>
					<?php endforeach; ?>
				</div>
			</li>

		<?php endif; ?>
		<li data-tab="prototype" class="uk-panel uk-panel-box">
			<div>
				<?php echo $prototypeModule; ?>
			</div>
		</li>
		<?php if (!empty($this->employees)) : ?>
			<li data-tab="employees" class="uk-panel uk-panel-box">
				<div class="employees">
					<?php foreach ($this->employees as $employee): ?>
						<div class="item uk-clearfix uk-width-1-1 uk-margin-bottom">
							<div class="avatar uk-position-relative uk-display-inline-block uk-align-left  uk-margin-bottom-remove">
								<a class="image uk-avatar-48 "
								   style="background-image:url(<?php echo $employee->avatar; ?>)"
								   href="<?php echo $employee->link; ?>">
								</a>
							</div>
							<div class="text uk-text-ellipsis">
								<div class="name">
									<a class="uk-link-muted"
									   href="<?php echo $employee->link; ?>"><?php echo $employee->name; ?></a>
								</div>
								<?php if (!empty($employee->position)): ?>
									<div class="position uk-text-small uk-text-ellipsis">
										<i>(<?php echo $employee->position; ?>)</i>
									</div>
								<?php endif; ?>
							</div>
						</div>
					<?php endforeach; ?>
				</div>

			</li>
		<?php endif; ?>
		<li data-tab="comments" class="uk-panel uk-panel-box">
			<?php echo $this->comments->render; ?>
		</li>
	</ul>
</div>


