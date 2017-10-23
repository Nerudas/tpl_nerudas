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


$header = $displayData;

?>
<header class="tm-top">
	<div class="tm-toppanel uk-card-default uk-box-shadow-small" data-uk-sticky="">
		<div class="uk-container uk-height-1-1">
			<div class="uk-grid-large uk-grid-match uk-height-1-1" data-uk-grid="">
				<div class="left uk-width-1-5@m uk-flex uk-flex-middle uk-flex-left@m">
					<div>
						<a class="menu uk-margin-small-right" data-uk-icon="icon: menu; ratio: 1.5" href="#navigation">
						</a>
						<a class="logo" href="<?php echo \Joomla\CMS\Uri\Uri::root(); ?>">
							<?php echo $header->logo->element; ?>
						</a>
					</div>
				</div>
				<div class="center uk-width-expand@m uk-flex uk-flex-top uk-flex-center@m">
					<ul>
						<jdoc:include type="modules" name="toppanel-center" style="toppanel_center"/>
					</ul>
				</div>
				<div class="right uk-width-1-5@m uk-flex uk-flex-middle uk-flex-right@m">
					<jdoc:include type="modules" name="toppanel-right" style="toppanel_right"/>
				</div>
			</div>
		</div>
	</div>
</header>

