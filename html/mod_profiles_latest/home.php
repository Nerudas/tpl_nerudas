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

use Joomla\CMS\Language\Text;

?>
<h2>
	<a href="<?php echo $listLink; ?>" class="uk-link-muted">
		<?php echo $module->title; ?>
	</a>
</h2>
<ul class="uk-list">
	<?php $i = 0;
	foreach ($items as $item): ?>
		<li class="uk-margin-top uk-margin-bottom">
			<?php if ($i != 0): ?>
				<div class="uk-text-large uk-text-center uk-margin-bottom">· · ·</div><?php endif; ?>
			<div class="item uk-clearfix uk-width-1-1">
				<div class="avatar uk-position-relative uk-display-inline-block uk-align-left  uk-margin-bottom-remove">
					<a class="image uk-avatar-48"
					   style="background-image: url('<?php echo $item->avatar; ?>');"
					   href="<?php echo $item->link; ?>">
					</a>
					<?php if ($item->online): ?>
						<i class="uk-position-bottom-right uk-icon-profile-state-online"></i>
					<?php endif; ?>
				</div>
				<div class="text uk-text-ellipsis">
					<div class="name  uk-text-ellipsis">
						<a class="uk-link-muted" href="<?php echo $item->link; ?>">
							<?php echo $item->name; ?>
						</a>
					</div>
					<?php if ($item->job): ?>
						<div class="job uk-text-uppercase-letter uk-text-small uk-text-ellipsis">
							<a class="uk-text-muted" href="<?php echo $item->job_link; ?>"
							   target="_blank">
								<?php echo $item->job_name; ?>
							</a>
						</div>
					<?php else: ?>
						<div class="uk-text-small uk-text-muted">
							[<?php echo Text::_('TPL_NERUDAS_NO_COMPANY'); ?>]
						</div>
					<?php endif; ?>
				</div>
			</div>
		</li>
		<?php $i++;
	endforeach; ?>
</ul>