<?php
/**
 * @package    Nerudas Template
 * @version    4.9.8
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;
$text = $this->item->fulltext;
// {hits}
$text = str_replace('{hits}', $this->item->hits, $text);
// {commentsCount}
$text = str_replace('{commentsCount}', $this->item->numOfComments, $text);
// {comments}
$text = str_replace('{comments}', $this->loadTemplate('comments'), $text);
// {link}
$text = str_replace('{link}', $this->item->link, $text);
// {date}
$text = str_replace('{date}', JHTML::_('date', $this->item->publish_up, 'd F'), $text);
if (isset($this->item->editLink))
{
	$this->item->editLink = '/forms/articles?cid=' . $this->item->id;
}
?>
<div class="uk-position-relative">

	<?php if (isset($this->item->editLink)): ?>
		<a href="<?php echo $this->item->editLink; ?>" class="uk-position-top-right uk-position-z-index">
			<i class="uk-icon-pencil uk-margin-small-right"></i>
			<?php echo JText::_('NERUDAS_EDIT'); ?>
		</a>
	<?php endif; ?>
	<?php echo $text; ?>
</div>