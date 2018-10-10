<?
/**
 * @package    Nerudas Template
 * @version    4.9.29
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;

$item = $displayData;

$text = (!empty($item->status)) ? $item->status :
	JHtmlString::truncate($item->about, 250, false, false);

?>

<a href="<?php echo $item->link; ?>" class="uk-panel uk-display-block uk-panel-box uk-panel-box-secondary">
	<div class="text uk-margin-small-bottom uk-text-muted">
		<?php echo $text; ?>
	</div>
	<div class="uk-text-right uk-margin-small-top">
		<span class="uk-button"><?php echo Text::_('TPL_NERUDAS_READMORE'); ?></span>
	</div>
</a>
