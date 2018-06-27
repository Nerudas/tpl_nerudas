<?php
/**
 * @package    Nerudas Template
 * @version    4.9.17
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;

use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Factory;

extract($displayData);

Factory::getDocument()->addScriptDeclaration("(function ($) { $(document).ready(function () {
			var results = new RegExp('[\?&]post_id=([^&#]*)').exec(window.location.href);
			if (results != null && decodeURI(results[1]) != '0') {
				var selector = '#discussion-post-" . $topic_id . "_' + decodeURI(results[1]),
					top = $(selector).offset().top;
				$('html, body').animate({
					scrollTop: top
				}, 0);
			}
		});	})(jQuery);");
if (!empty($items))
{
	$i = 0;
	foreach ($items as $item)
	{
		if ($i > 0) echo '<hr>';
		echo LayoutHelper::render('components.com_discussions.posts.item', $item);
		$i++;
	}
	if (!empty($pagination->getPagesLinks()))
	{
		echo '<hr>';
		echo $pagination->getListFooter();
	}

}
?>
<?php if (!empty($addForm['form'])): ?>
	<?php if (!empty($items)) echo '<hr>'; ?>
	<div id="discussion-post-add-<?php echo $topic_id; ?>" class="form uk-anchor">
		<?php echo LayoutHelper::render('components.com_discussions.posts.form', $addForm); ?>
	</div>
<?php endif; ?>
