<?php
/**
 * @package    Nerudas Template
 * @version    4.9.6
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;

extract($displayData);

$link_target  = (!empty($author_link)) ? '' : ' target="_blank"';
$author       = NerudasProfilesHelper::getProfile($author_id);
$author->link = (!empty($author_link)) ? $author_link : $author->link;
?>
<div class="author uk-clearfix uk-width-1-1">
	<div class="avatar uk-position-relative uk-display-inline-block uk-align-left  uk-margin-bottom-remove">
		<a class="image uk-avatar-48 "
		   style="background-image: url('<?php echo $author->avatar->small; ?>');"
		   href="<?php echo $author->link; ?>"<?php echo $link_target; ?>>
		</a>
	</div>
	<div class="text uk-text-ellipsis">
		<div class="name">
			<a class="" href="<?php echo $author->link; ?>" <?php echo $link_target; ?>>
				<?php echo $author->name; ?>
			</a>
		</div>
		<?php if ($author->job): ?>
			<div class="job uk-text-uppercase-letter uk-text-small uk-text-ellipsis">
				<a class="uk-text-muted" href="<?php echo $author->job->link; ?>"
				   target="_blank">
					<?php echo $author->job->name; ?>
				</a>
			</div>
		<?php endif; ?>
	</div>
</div>
