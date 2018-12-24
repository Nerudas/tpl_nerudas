<?php
/**
 * @package    Nerudas Template
 * @version    4.9.38
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;

?>
<div data-prototype-list-balloon class="uk-modal">
	<div class="uk-modal-dialog uk-modal-dialog-large">
		<button class="uk-modal-close uk-close" type="button"></button>
		<div class="uk-alert uk-alert-danger" data-prototype-list-balloon-error>
			<?php echo Text::_('JGLOBAL_NO_MATCHING_RESULTS'); ?>
		</div>
		<div data-prototype-list-balloon-loading>
			<i class="uk-icon-spinner uk-icon-spin uk-margin-small-right"></i>
			<?php echo Text::_('TPL_NERUDAS_LOADING'); ?>
		</div>
		<div data-prototype-list-balloon-content class="uk-overflow-container">
		</div>
	</div>
</div>
