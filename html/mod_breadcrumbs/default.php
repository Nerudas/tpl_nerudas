<?php
/**
 * @package    Nerudas Template
 * @version    4.9.38
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;
// uk-panel uk-panel-box
?>
<div class="uk-text-small uk-panel-box uk-margin-remove">
	<ul class="uk-breadcrumb uk-margin-remove">
		<?php foreach ($list as $li): ?>
			<li class="item">
				<a href="<?php echo $li->link; ?>">
					<?php echo $li->name; ?>

				</a>
			</li>
		<?php endforeach; ?>
	</ul>
</div>

