<?
/**
 * @package    Nerudas Template
 * @version    4.9.30
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;

$item = $displayData;

?>

<a href="<?php echo $item->link; ?>" class="uk-panel uk-display-block uk-panel-box uk-panel-box-secondary">
	<div class="uk-grid uk-grid-small uk-link-muted" data-uk-grid-match
		 data-uk-grid-margin>
		<div class="uk-width-medium-1-3 uk-border">
			<?php if ($item->introimage): ?>
				<img src="<?php echo $item->introimage; ?>" alt="<?php echo $item->title; ?>">
			<?php endif; ?>
		</div>
		<div class="uk-width-medium-2-3">
			<div class="text uk-margin-small-bottom uk-text-muted"><?php echo $item->introtext; ?></div>
			<div class="uk-text-right uk-margin-small-top">
				<span class="uk-button"><?php echo Text::_('TPL_NERUDAS_READMORE'); ?></span>
			</div>
		</div>
	</div>
</a>
