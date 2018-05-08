<?php
/**
 * @package    Nerudas Template
 * @version    4.9.9
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;
?>
<div class="item herak uk-margin-bottom uk-text-center">
	<a class="uk-overlay uk-overlay-hover uk-display-inline-block uk-width-medium-1-2"
	   href="<?php echo $this->item->link; ?>">
		<div class="uk-text-center">
			<img src="<?php echo $this->item->image; ?>" alt="<?php echo str_replace('"', '', $this->item->title); ?>"
				 class="uk-width-1-1"/>
		</div>
		<div class="uk-overlay-panel uk-overlay-panel-small uk-overlay-background ">
			<div class="title">
				<?php echo $this->item->extra['city']->value; ?>
			</div>
			<div class="uk-text-small text">
				<?php echo $this->item->mintext; ?>
			</div>
		</div>
	</a>
</div> 