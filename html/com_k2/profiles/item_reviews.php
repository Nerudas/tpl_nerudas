<?php
/**
 * @package     JoomlaZen Nerudas Template
 * @version     4.3
 * @author      JoomlaZen - www.joomlazen.com
 * @copyright   Copyright (c) 2016 - 2016 JoomlaZen. All rights reserved.
 * @license     GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */
defined('_JEXEC') or die('Restricted access');
?>
<div class="uk-panel uk-panel-box uk-padding-top uk-padding-bottom uk-hidden">
	<h2 class="uk-text-large">
		<?php echo JText::_('NERUDAS_REVIEWS'); ?>
	</h2>
</div>
<hr class="uk-margin-remove uk-hidden">
<div class="uk-panel uk-panel-box">
	<?php echo $this->loadTemplate('comments'); ?>
</div>