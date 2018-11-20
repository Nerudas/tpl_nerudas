<?php
/**
 * @package    Nerudas Template
 * @version    4.9.34
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;

HTMLHelper::_('jquery.framework');
HTMLHelper::_('formbehavior.chosen', 'select');
HTMLHelper::_('script', 'media/com_prototype/js/shortcodes.min.js', array('version' => 'auto'));

$doc = Factory::getDocument();
$doc->addScriptDeclaration("function showPrototypeShortcodesBalloon() {UIkit.modal('[data-prototype-shortcodes-balloon]', {center: true}).show();}");
$doc->addScriptDeclaration("function showPrototypeShortcodesAuthor() {UIkit.modal('[data-prototype-shortcodes-author]', {center: true}).show();}");