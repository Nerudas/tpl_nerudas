<?php
/**
 * @package    Nerudas Template
 * @version    4.9.35
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;
use Joomla\CMS\HTML\HTMLHelper;

extract($displayData);

HTMLHelper::_('jquery.framework');
HTMLHelper::_('script', 'media/com_companies/js/form-employees.min.js', array('version' => 'auto'));
?>
<div id="<?php echo $id; ?>" data-input-employees="<?php echo $id; ?>">
	<div class="uk-grid uk-grid-small" data-uk-grid-margin data-uk-grid-match>
		<?php foreach ($employees as $employee): ?>
			<div class="uk-width-medium-1-2">
				<div class="item uk-panel uk-panel-box uk-height-1-1 <?php echo ($employee->confirm == 'user') ? 'wait-user' : ''; ?>"
					 data-user="<?php echo $employee->id; ?>">
					<div class="inner uk-flex uk-flex-middle">
						<div class="avatar">
							<a href="<?php echo $employee->link; ?>" target="_blank" class="image"
							   style="background-image: url('<?php echo $employee->avatar; ?>')"></a>
						</div>
						<div class="content uk-width-1-1">
							<div class="name">
								<a href="<?php echo $employee->link; ?>" target="_blank" class="uk-link-muted">
									<?php echo $employee->name; ?>
								</a>
							</div>
							<div class="position">
								<input type="text" id="<?php echo $id; ?>_<?php echo $employee->id; ?>_position"
									   name="<?php echo $name; ?>[<?php echo $employee->id; ?>][position]"
									   value="<?php echo $employee->position; ?>"
									   placeholder="<?php echo Text::_('COM_COMPANIES_EMPLOYEES_POSITION'); ?>"
									   class="uk-width-1-1" <?php echo ($employee->confirm !== 'confirm') ? ' readonly' : ''; ?>>
							</div>
							<div class="as_company uk-hidden">
								<label for="<?php echo $id; ?>_<?php echo $employee->id; ?>_as_company"
									   class="checkbox">
									<input type="checkbox"
										   value="1"<?php echo ($employee->as_company) ? ' checked ' : ' '; ?>
										   id="<?php echo $id; ?>_<?php echo $employee->id; ?>_as_company"
										   name="<?php echo $name; ?>[<?php echo $employee->id; ?>][as_company]"
										<?php echo ($employee->confirm !== 'confirm') ? ' disabled="disabled" ' : ''; ?>>
									<?php echo Text::_('COM_COMPANIES_EMPLOYEES_AS_COMPANY'); ?>
								</label>
							</div>
						</div>
						<div class="actions uk-position-top-right">
							<a class="delete uk-button uk-button-mini uk-button-danger uk-icon-remove"
							   title="<?php echo Text::sprintf('COM_COMPANIES_EMPLOYEES_DELETE_LABEL', $employee->name); ?>">
							</a>
							<?php if ($employee->confirm == 'company'): ?>
								<a class="confirm uk-button uk-button-mini uk-button-success">
									<?php echo Text::_('COM_COMPANIES_EMPLOYEES_CONFIRM_SUBMIT'); ?>
								</a>
							<?php endif; ?>
						</div>
					</div>
					<?php if ($employee->confirm !== 'confirm'): ?>
						<div class="confirm">
							<?php if ($employee->confirm == 'user'): ?>
								<div class="uk-text-warning uk-text-small">
									<?php echo Text::_('COM_COMPANIES_EMPLOYEES_CONFIRM_NEED_USER'); ?>
								</div>
							<?php elseif ($employee->confirm == 'company'): ?>
								<div class="uk-text-warning uk-text-small">
									<?php echo Text::_('COM_COMPANIES_EMPLOYEES_CONFIRM_NEED_COMPANY'); ?>
								</div>
							<?php elseif ($employee->confirm == 'error'): ?>
								<div class="uk-text-danger uk-text-small">
									<?php echo Text::_('COM_PROFILES_PROFILE_JOBS_CONFIRM_ERROR'); ?>
								</div>
							<?php endif; ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</div>