<?php
/**
 * @package    Nerudas Template
 * @version    4.9.4
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2017 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;

?>
<ul class="uk-list">
	<?php foreach ($links as $link): ?>
		<li class="uk-link-muted uk-margin-small-bottom">
			<a href="<?php echo $link->href; ?>" class="<?php echo $link->class; ?>"
			   target="<?php echo $link->target; ?>">
				<?php echo Text::_($link->text); ?>
			</a>
		</li>
	<?php endforeach; ?>
</ul>
