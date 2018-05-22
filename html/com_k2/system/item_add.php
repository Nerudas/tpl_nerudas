<?php
/**
 * @package    Nerudas Template
 * @version    4.9.10
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;
$app     = JFactory::getApplication();
$doc     = JFactory::getDocument();
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