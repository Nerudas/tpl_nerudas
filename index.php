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

use Joomla\CMS\Factory;
use Joomla\CMS\Layout\LayoutHelper;

// Connect template helper
require_once __DIR__ . '/helper.php';
$this->helper = new tplNerudasHelper;

// Check site version
$this->helper->checkSiteVersion($this->params);

// Set Head
$this->helper->setHead($this->params);

/* General 
========================================================================== */
$app    = Factory::getApplication();
$doc    = Factory::getDocument();
$config = Factory::getConfig();

if ($_SERVER['REQUEST_URI'] == '/index.php?option=com_k2&view=itemlist')
{
	JError::raiseError(404);
}

$oldComponents     = array('com_k2', 'com_nerudas');
if (!in_array($app->input->get('option', ''), $oldComponents)):

	// Get Header
	$this->header = $this->helper->getHeader($this);

	// Get middle Layout
	$this->middleLayout = $this->helper->getMiddleLayot($this);

	// Get Footer
	$this->footer = $this->helper->getFooter($this);

	$this->map = ($this->middleLayout == 'template.middle.map');

	?>
	<html prefix="og: http://ogp.me/ns#" xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>"
		  lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>"
		  class="new <?php echo ($this->map) ? 'map' : ''; ?>">
	<head>
		<jdoc:include type="head"/>
	</head>
	<body>
	<jdoc:include type="message"/>
	<?php echo LayoutHelper::render('template.header', $this); ?>
	<?php echo LayoutHelper::render($this->middleLayout, $this); ?>
	<?php if (!$this->map): ?>
		<?php echo LayoutHelper::render('template.footer', $this); ?>
	<?php endif; ?>
	<jdoc:include type="modules" name="modal"/>
	<jdoc:include type="modules" name="scripts"/>
	</body>
	</html>

<?php else:
	/* Site Settings
	========================================================================== */
	$site = new stdClass();
	$site->name    = $config->get('sitename');
	$site->logo    = '/templates/' . $this->template . '/images/logo.png';
	$site->loading = '/templates/' . $this->template . '/images/loading.gif';
	$site->version = 'default';
	$site->layout  = 'default';
	if (JUri::base() == JUri::current() || $app->input->get('Itemid') == 1874)
	{
		$site->layout = 'home';
	}
	if ($app->input->get('view') == 'map' && $app->input->get('option') == 'com_nerudas')
	{
		$site->layout = 'map';
	}
	unset($doc->_styleSheets['/media/k2/assets/css/k2.css?v=2.7.1']);
	?>

	<!DOCTYPE html>
	<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>"
		  lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
	<head>
		<jdoc:include type="head"/>
		<jdoc:include type="modules" name="head"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	</head>

	<body class="uk-position-relative uk-height-1-1 layout-<?php echo $site->layout; ?>"
		  onbeforeunload="jQuery('#pageLoading').show()">
	<jdoc:include type="modules" name="analytics"/>
	<jdoc:include type="message"/>
	<?php require_once JPATH_THEMES . '/' . $this->template . '/layouts/' . $site->version . '.php'; ?>
	<div id="pageLoading" class="uk-vertical-align uk-text-center">
		<img src="<?php echo $site->loading; ?>" class="uk-vertical-align-middle"
			 alt="<?php echo JText::_('NERUDAS_LOADING_DATA'); ?>"/>
	</div>
	<jdoc:include type="modules" name="scripts"/>
	</body>
	</html>
<?php endif; ?>