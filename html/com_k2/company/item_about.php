<?php
/**
 * @package    Nerudas Template
 * @version    4.9.5
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2017 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;
?>

<div class="uk-panel uk-panel-box uk-padding-top uk-padding-bottom  uk-hidden">
	<h2 class="uk-text-large">
		<?php echo JText::_('NERUDAS_COMPANY_TEXT'); ?>
	</h2>
</div>
<hr class="uk-margin-remove uk-hidden">
<div class="uk-panel uk-panel-box">
	<?php echo $this->item->introtext; ?>
</div>
