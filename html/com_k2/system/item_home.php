<?php
/**
 * @package    Nerudas Template
 * @version    4.9.1
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2017 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;
$app     = JFactory::getApplication();
$doc     = JFactory::getDocument();
$modules = $doc->loadRenderer('modules');
?>
	<div>
		<?php echo $this->item->fulltext; ?>
	</div>

<?php echo $this->loadTemplate('map_modal'); ?>