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
?>
<header class="tm-top" data-uk-sticky>
	<?php require_once JPATH_THEMES . '/' . $this->template . '/layouts/' . $site->version . '_header.php'; ?>
</header>
<section class="tm-middle">
	<?php require_once JPATH_THEMES . '/' . $this->template . '/layouts/' . $site->version . '_middle_' . $site->layout . '.php'; ?>
</section>
<?php
// Get Footer
use Joomla\CMS\Layout\LayoutHelper;

if ($site->layout !== 'map')
{
	$this->footer = $this->helper->getFooter($this);
	echo LayoutHelper::render('template.footer', $this);
}
?>

