<?php
/**
 * @package    Nerudas Template
 * @version    4.9.29
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;

use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\HTML\HTMLHelper;

?>
<div id="prototype" class="form uk-margin-large-bottom">
	<?php echo LayoutHelper::render('template.title', array('cancel' => $this->category->cancelLink)); ?>
	<div class="itemlist uk-panel uk-panel-box uk-margin-bottom">
		<div class="item uk-margin-large-bottom">
			<div class="uk-grid" data-uk-grid-margin data-uk-grid-match>
				<?php foreach ($this->children as $child): ?>
					<div class="uk-text-center uk-width-xsmall-1-3 uk-width-small-1-4 uk-width-medium-1-5 uk-width-large-1-5 uk-width-xlarge-1-5">
						<a href="<?php echo $child->formLink; ?>" class="uk-display-block uk-link-muted">
							<div>

								<?php if (!empty($child->icon))
								{
									echo HTMLHelper::_('image', $child->icon, $child->title, array('title' => $child->title));
								}
								?>
								<div class="uk-text-small"><?php echo $child->title; ?></div>
							</div>
						</a>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</div>