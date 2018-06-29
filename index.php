<?php
/**
 * @package    Nerudas Template
 * @version    4.9.18
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

// Get Header
$this->header = $this->helper->getHeader($this);

// Get middle Layout
$this->middleLayout = $this->helper->getMiddleLayot($this);

// Get Footer
$this->footer = $this->helper->getFooter($this);

$this->map = ($this->middleLayout == 'template.middle.map');

$htmlClass = ($this->map) ? ' class="map"' : '';
?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>"<?php echo $htmlClass; ?>>
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