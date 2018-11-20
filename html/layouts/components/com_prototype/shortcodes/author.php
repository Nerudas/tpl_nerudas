<?php
/**
 * @package    Nerudas Template
 * @version    4.9.34
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;

?>
<div data-prototype-shortcodes-author class="uk-modal">
	<div class="uk-modal-dialog">
		<button class="uk-modal-close uk-close" type="button"></button>
		<div class="uk-alert uk-alert-danger" data-prototype-shortcodes-author-error>
			<?php echo Text::_('JGLOBAL_NO_MATCHING_RESULTS'); ?>
		</div>
		<div data-prototype-shortcodes-author-loading>
			<i class="uk-icon-spinner uk-icon-spin uk-margin-small-right"></i>
			<?php echo Text::_('TPL_NERUDAS_LOADING'); ?>
		</div>
		<div data-prototype-shortcodes-author-content class="uk-overflow-container">
		</div>
	</div>
</div>
