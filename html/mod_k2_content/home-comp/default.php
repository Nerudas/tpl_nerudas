<?php
/**
 * @package    Nerudas Template
 * @version    4.9.5
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2017 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;

$app = JFactory::getApplication();
$doc = JFactory::getDocument();
?>

<?php echo $params->get('itemPreText') ?>
<ul class="uk-list">
	<?php foreach ($items as $key => $item): ?>
		<li class="uk-margin-top uk-margin-bottom">
			<?php if ($key !== 0): ?>
				<div class="uk-text-large uk-text-center">· · ·</div><?php endif; ?>
			<a href="<?php echo $item->link; ?>" class="">
				<div class="uk-link-muted uk-text-uppercase">
					<?php echo $item->title; ?>
					<?php if (!empty($item->image)): ?>
						<img src="<?php echo $item->image; ?>"
							 alt="<?php echo str_replace('"', '', $item->title); ?>"
							 style="height: 20px !important;"/>

					<?php endif; ?>
				</div>
				<div class="uk-text-muted">
					<?php echo JHTML::_('string.truncate', (strip_tags($item->introtext)), 100); ?>
				</div>
			</a>
		</li>
	<?php endforeach; ?>
</ul>



