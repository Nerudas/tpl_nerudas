<?php
/**
 * @package    Nerudas Template
 * @version    4.9.3
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2017 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;
?>

<li class="region">
	<a href="#regionSelect" data-uk-modal="" data-uk-tooltip="pos:'bottom-right', cls:'big'"
	   title="<?php echo JText::sprintf('NERUDAS_REGION_CURRENT', $region->name) ?>">
		<img src="<?php echo $region->image; ?>" alt="<?php echo $region->name; ?>"/>
	</a>
</li>
