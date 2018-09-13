<?
/**
 * @package    Nerudas Template
 * @version    4.9.26
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

	<div class="title">
		<?php echo $item->name; ?>
		<?php if ($item->logo): ?>
			<img src="<?php echo $item->logo; ?>"
				 alt="<?php echo str_replace('"', '', $item->name); ?>"
				 style="height: 20px !important;"/>
		<?php endif; ?>
	</div>

	<div class="text uk-margin-small-bottom uk-text-muted">
		<?php echo JHtmlString::truncate($item->about, 250, false, false); ?>
	</div>
	<div class="uk-text-right uk-margin-small-top">
		<span class="uk-button"><?php echo Text::_('TPL_NERUDAS_READMORE'); ?></span>
	</div>
</a>
