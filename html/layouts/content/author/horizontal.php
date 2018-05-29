<?php
/**
 * @package    Nerudas Template
 * @version    4.9.12
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;

$item = $displayData;
?>
<div class="author uk-clearfix uk-width-1-1">
	<div class="avatar uk-position-relative uk-display-inline-block uk-align-left  uk-margin-bottom-remove">
		<a class="image uk-avatar-48"
		   style="background-image: url('<?php echo $item->author_avatar; ?>');"
		   href="<?php echo $item->author_link; ?>">
		</a>
		<?php if ($item->author_online): ?>
			<i class="uk-position-bottom-right uk-icon-profile-state-online"></i>
		<?php endif; ?>
	</div>
	<div class="text uk-text-ellipsis">
		<div class="name">
			<a href="<?php echo $item->author_link; ?>">
				<?php echo $item->author_name; ?>
			</a>
		</div>
		<?php if ($item->author_job): ?>
			<div class="job uk-text-uppercase-letter uk-text-small uk-text-ellipsis">
				<a class="uk-text-muted" href="<?php echo $item->author_job_link; ?>"
				   target="_blank">
					<?php echo $item->author_job_name; ?>
				</a>
			</div>
		<?php endif; ?>
	</div>
</div>
