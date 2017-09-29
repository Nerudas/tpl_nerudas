<?php
/**
 * @package    Nerudas Template
 * @version    5.0.0
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2017 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;

use Joomla\CMS\Layout\LayoutHelper;

// Connect template heper
require_once __DIR__ . '/helper.php';
$this->helper = new tplNerudasHelper;

// Check site version
$this->helper->checkSiteVersion($this->params);

// Set Head
$this->helper->setHead($this->params);

// Prepate header
$this->header = $this->helper->prepareHeader($this->params);
?>
<!DOCTYPE html>
<html prefix="og: http://ogp.me/ns#" xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>"
	  lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<jdoc:include type="head"/>
</head>
<body>
<jdoc:include type="message"/>
<?php echo LayoutHelper::render('template.header', $this->header); ?>
<jdoc:include type="component"/>
<?php echo LayoutHelper::render('template.footer'); ?>
<jdoc:include type="modules" name="scripts"/>
</body>
</html>

