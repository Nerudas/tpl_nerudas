<?php
/**
 * @package    Nerudas Template
 * @version    4.9.7
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;

use Joomla\CMS\Layout\LayoutHelper;

?>
<div id="pages">
	<?php echo LayoutHelper::render('template.title', array()); ?>
	<?php if (!empty($this->item->content)): ?>
		<div>
			<?php echo $this->item->content; ?>
		</div>
	<?php endif; ?>
</div>

