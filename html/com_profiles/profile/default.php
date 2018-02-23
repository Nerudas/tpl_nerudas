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

use Joomla\CMS\Language\Text;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Factory;
use Joomla\CMS\Helper\ModuleHelper;
use Joomla\Registry\Registry;

HTMLHelper::_('jquery.framework');

HTMLHelper::_('script', '//api-maps.yandex.ru/2.1/?lang=ru-RU', array('version' => 'auto', 'relative' => true));

$boardModule           = ModuleHelper::getModule('mod_board_latest', Text::_('MOD_BOARD_LATEST_ITEMS'));
$boardModule->position = '';
$boardModule->params   = new Registry($boardModule->params);
$boardModule->params->set('layout', 'nerudas:profile');
$boardModule->params->set('style', 'blank');
$boardModule->params->set('author_id', $this->item->id);
$boardModule->params->set('allregions', 1);
$boardModule->params = (string) $boardModule->params;
$boardModule->style  = 'blank';
$boardModule         = ModuleHelper::renderModule($boardModule);


?>
<div id="profiles" class="item">
	<?php echo LayoutHelper::render('template.title', array('edit' => $this->editLink)); ?>
	<?php if (!empty($this->item->status)): ?>
		<div class="uk-panel-box uk-panel uk-padding-remove uk-margin-bottom">
			<blockquote>
				<div class="uk-padding">
					<?php echo $this->item->status; ?>
				</div>
			</blockquote>
		</div>
	<?php endif; ?>
	<div class="header uk-margin-bottom">
		<div class="bg uk-display-block uk-cover-background"
			 style="background-image: url('<?php echo $this->item->header; ?>');"></div>
		<div class="info">
			<div class="avatar">
				<div class="image uk-display-block uk-cover-background"
					 style="background-image: url('<?php echo $this->item->avatar; ?>');">
				</div>
			</div>
			<div class="uk-width-1-1">
				<div class="content uk-grid uk-grid-small">
					<div class="author  uk-width-1-2 uk-width-medium-3-4">
						<div class="uk-text-large">
							<?php echo $this->item->name; ?>
						</div>
						<div class="job">

						</div>
					</div>
					<div class="uk-width-1-2 uk-width-medium-1-4 uk-text-right">
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
								<i class="uk-icon-comment-o uk-margin-small-right"></i>0
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<ul class="uk-tab-new uk-margin-bottom-remove" data-uk-switcher="{connect:'#profilesTabs', swiping: false}">
		<?php if ($this->item->contacts) : ?>
			<li><a href="#contacts"><?php echo Text::_('COM_PROFILES_PROFILE_CONTACTS'); ?></a></li>
		<?php endif; ?>
		<?php if (!empty($this->item->about)) : ?>
			<li><a href="#about"><?php echo Text::_('COM_PROFILES_PROFILE_ABOUT'); ?></a></li>
		<?php endif; ?>
		<li><a href="#board"><?php echo Text::_('MOD_BOARD_LATEST_ITEMS'); ?></a></li>
		<li><a href="#map"><?php echo Text::_('TPL_NERUDAS_ON_MAP'); ?></a></li>
		<li><a href="#comments"><?php echo Text::_('TPL_NERUDAS_COMMENTS'); ?></a></li>
	</ul>

	<ul id="profilesTabs" class="uk-switcher" data-uk-switcher-tabs="">
		<?php if ($this->item->contacts) : ?>
			<li data-tab="contacts" class="uk-panel uk-panel-box">
				<dl class="uk-description-list-horizontal">
					<?php if ($this->item->contacts->get('phones', false)) : ?>
						<dt><?php echo Text::_('JGLOBAL_FIELD_PHONES_LABEL'); ?></dt>
						<dd class="uk-margin-bottom">
							<?php foreach ($this->item->contacts->get('phones') as $phone): ?>
								<a class="uk-text-xlarge uk-display-block uk-margin-small-bottom"
								   href="tel:<?php echo $phone->code . $phone->number; ?>">
									<?php $phone->display = (!empty($phone->display)) ?
										$phone->display : $phone->code . $phone->number;

									$regular = "/(\\+\\d{1})(\\d{3})(\\d{3})(\\d{2})(\\d{2})/";
									$subst   = '$1($2)$3-$4-$5';
									echo preg_replace($regular, $subst, $phone->display); ?>
								</a>

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
						<dt><?php echo Text::_('COM_PROFILES_PROFILE_SITE'); ?></dt>
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
		<?php if (!empty($this->item->about)) : ?>
			<li data-tab="about" class="uk-panel uk-panel-box">
				<div>
					<?php echo $this->item->about; ?>
				</div>
			</li>
		<?php endif; ?>
		<li data-tab="board" class="uk-panel uk-panel-box">
			<div>
				<?php echo $boardModule; ?>
			</div>
		</li>
		<li data-tab="map" id="mapTab" class="uk-panel uk-panel-box uk-padding-remove">
		</li>
		<li data-tab="comments" class="uk-panel uk-panel-box">
		</li>
	</ul>
</div>
