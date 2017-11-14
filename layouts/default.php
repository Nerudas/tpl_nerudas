<?php
/**
 * @package    Nerudas Template
 * @version    4.9.1
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2017 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */
defined('_JEXEC') or die('Restricted access');
?>
<header class="tm-top" data-uk-sticky>
	<?php require_once JPATH_THEMES.'/'.$this->template.'/layouts/'.$site->version.'_header.php';?>
</header>
<section class="tm-middle">
	<?php require_once JPATH_THEMES.'/'.$this->template.'/layouts/'.$site->version.'_middle_'.$site->layout.'.php';?>
</section>
<footer class="tm-footer">
	<?php require_once JPATH_THEMES.'/'.$this->template.'/layouts/'.$site->version.'_footer.php';?>
</footer>