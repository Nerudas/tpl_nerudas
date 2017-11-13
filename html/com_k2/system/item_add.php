<?php 
/**
 * @package     JoomlaZen Nerudas Template
 * @version     4.3
 * @author      JoomlaZen - www.joomlazen.com
 * @copyright   Copyright (c) 2016 - 2016 JoomlaZen. All rights reserved.
 * @license     GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */
defined('_JEXEC') or die('Restricted access');
$app = JFactory::getApplication();
$doc = JFactory::getDocument();
$modules = $doc->loadRenderer('modules');
?>
<div class="item category uk-panel uk-panel-box uk-margin-bottom">
	<h1 class="uk-margin-bottom"><?php echo $this->item->title; ?></h1>
	<div class="uk-clearfix">
	</div>
<?php if (!empty($modules->render('add-1'))): ?>
<?php echo $modules->render('add-1', array('style' => 'blank')); ?>
<?php endif; ?>
</div>