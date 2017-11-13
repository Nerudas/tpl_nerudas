<?php
/**
 * @package     JoomlaZen Nerudas Template
 * @version     4.3
 * @author      JoomlaZen - www.joomlazen.com
 * @copyright   Copyright (c) 2016 - 2016 JoomlaZen. All rights reserved.
 * @license     GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */
defined('_JEXEC') or die('Restricted access');
// uk-panel uk-panel-box
?>
<div class="uk-text-small uk-panel-box uk-margin-remove">
	<ul class="uk-breadcrumb uk-margin-remove">
		<?php foreach ($list as $li): ?>
			<li class="item">
				<a href="<?php echo $li->link;?>">
					<?php echo $li->name;?>

				</a>			
			</li>
		<?php endforeach; ?>
	</ul>
</div>

