<?php
/**
 * @package    Nerudas Template
 * @version    4.9.36
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;

use Joomla\CMS\Layout\LayoutHelper;

?>
<div id="pages" class="item">
	<?php echo LayoutHelper::render('template.title'); ?>
	<div class="wrapper uk-position-relative">
		<?php if ($this->item->header): ?>
			<div class="item-header" style="background-image: url('<?php echo $this->item->header; ?>')"></div>
		<?php endif; ?>
		<div class="item-content uk-panel uk-panel-box">
			<?php echo $this->item->content; ?>
		</div>
	</div>
</div>