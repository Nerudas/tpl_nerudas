<?php
/**
 * @package    Nerudas Template
 * @version    4.9.14
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */
$app                        = JFactory::getApplication();
$doc                        = JFactory::getDocument();
$this->pagination->selector = '#ads.itemlist .pagination > .uk-pagination';
$doc->addScriptDeclaration("jQuery(document).ready(function(){addPagination(jQuery('" . $this->pagination->selector . "'), '" . json_encode($this->pagination) . "');});jQuery(window).resize(function(){addPagination(jQuery('" . $this->pagination->selector . "'), '" . json_encode($this->pagination) . "');});");
?>
<div class="pagination">
	<?php echo $this->pagination->getPagesLinks(); ?>
</div>