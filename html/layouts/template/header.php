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

use Joomla\CMS\Uri\Uri;

$header = $displayData;

?>
<header class="tm-top uk-card-default uk-box-shadow-small" data-uk-sticky="">
	<div class="uk-container uk-height-1-1">
		<div class="uk-grid-large uk-grid-match uk-height-1-1" data-uk-grid="">
			<div class="uk-width-1-5@m uk-flex uk-flex-middle uk-flex-left@m">
				<div>
					<a class="menu uk-margin-small-right" data-uk-icon="icon: menu; ratio: 1.5" href="#navigation">
					</a>
					<a class="logo" href="<?php echo Uri::root(); ?>">
						<?php echo $header->logo->element; ?>
					</a>
				</div>
			</div>
			<div class="uk-width-expand@m uk-flex uk-flex-middle uk-flex-center@m">
				middle
			</div>
			<div class="uk-width-1-5@m uk-flex uk-flex-middle uk-flex-right@m">
				right
			</div>
		</div>
	</div>
</header>

