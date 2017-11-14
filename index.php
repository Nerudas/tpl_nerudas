<?php
/**
 * @package    Nerudas Template
 * @version    4.9.1
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2017 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;
/* General 
========================================================================== */
$app    = JFactory::getApplication();
$doc    = JFactory::getDocument();
$config = JFactory::getConfig();
if ($_SERVER['REQUEST_URI'] == '/index.php?option=com_k2&view=itemlist')
{
	JError::raiseError(404);
}
/* Site Settings 
========================================================================== */
$site          = new stdClass();
$site->name    = $config->get('sitename');
$site->logo    = '/templates/' . $this->template . '/images/logo.png';
$site->loading = '/templates/' . $this->template . '/images/loading.gif';
$site->version = 'default';
$site->layout  = 'default';
if (JUri::base() == JUri::current() || $app->input->get('Itemid') == 1874)
{
	$site->layout = 'home';
}
$full = array(662, 663, 1075);
if ($app->input->get('view') == 'item' && $app->input->get('Itemid') == 662)
{
	//$site->layout = 'full';
}
if ($app->input->get('view') == 'item' && $app->input->get('Itemid') == 663)
{
	//$site->layout = 'full';
}
if ($app->input->get('view') == 'item' && in_array(1622, $app->getMenu()->getActive()->tree))
{
	//$site->layout = 'full';
}
if ($app->input->get('view') == 'item' && in_array(1628, $app->getMenu()->getActive()->tree))
{
	//$site->layout = 'full';
}
if ($app->input->get('view') == 'map' && $app->input->get('option') == 'com_nerudas')
{
	$site->layout = 'map';
}

/* Uikit
========================================================================== */
$uikit                  = new stdClass();
$uikit->cdn             = 'https://cdnjs.cloudflare.com/ajax/libs/uikit/';
$uikit->version         = '2.27.2';
$uikit->theme           = '.almost-flat';
$uikit->compression     = '.min';
$uikit->compression     = '';
$uikit->components      = new stdClass();
$uikit->components->css = array('form-file', 'form-password', 'placeholder', 'sticky', 'tooltip', 'notify', 'form-file', 'accordion');
$uikit->components->js  = array('form-password', 'lightbox', 'sticky', 'tooltip', 'notify', 'pagination', 'accordion', 'grid');

/* Template 
========================================================================== */
$template      = new stdClass();
$template->css = array('uikit', 'template');
$template->js  = array('template', 'regions');


/* StyleSheets
========================================================================== */
// Fonts
$this->addStyleSheet('https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i&amp;subset=cyrillic,cyrillic-ext');
$this->addStyleSheet('/templates/' . $this->template . '/css/fonts.css');
// UIkit
$this->addStyleSheet($uikit->cdn . $uikit->version . '/css/uikit' . $uikit->theme . $uikit->compression . '.css');
foreach ($uikit->components->css as $css)
{
	$this->addStyleSheet($uikit->cdn . $uikit->version . '/css/components/' . $css . $uikit->theme . $uikit->compression . '.css');
}
// Template 
foreach ($template->css as $css)
{
	$this->addStyleSheet('/templates/' . $this->template . '/css/' . $css . '.css');
}
// Uset
unset($doc->_styleSheets['/media/k2/assets/css/k2.css?v=2.7.1']);

/* JavaScripts
========================================================================== */
// Uikit
$this->addScript($uikit->cdn . $uikit->version . '/js/uikit' . $uikit->compression . '.js');
foreach ($uikit->components->js as $js)
{
	$this->addScript($uikit->cdn . $uikit->version . '/js/components/' . $js . $uikit->compression . '.js');
}
// Cookie
$this->addScript('https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js');
// Chosen
$this->addScript('https://cdnjs.cloudflare.com/ajax/libs/chosen/1.6.2/chosen.jquery.min.js');
$this->addScriptDeclaration("jQuery(document).ready(function() {jQuery('.uk-form select').chosen({placeholder_text_single: '" . JText::_('NERUDAS_CHOSEN_SINGLE') . "', placeholder_text_multiple: '" . JText::_('NERUDAS_CHOSEN_MULTIPLE') . "', single_backstroke_delete: false});});");
// icheck
$this->addScript('https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/icheck.min.js');
$this->addScriptDeclaration("jQuery(document).ready(function(){jQuery(jQuery('.uk-form input[type=radio]')).each(function(x) {if (jQuery(this).parents('[data-uk-button-radio]').length < 1) {iCheckInitialize(jQuery(this));}});iCheckInitialize(jQuery('.uk-form input[type=checkbox]'));function iCheckInitialize(elem) {elem.iCheck({radioClass: 'iradio', checkboxClass: 'icheckbox'});}});");
// Template
foreach ($template->js as $js)
{
	$this->addScript('/templates/' . $this->template . '/scripts/' . $js . '.js');
}

/* Load Layout
========================================================================== */
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
