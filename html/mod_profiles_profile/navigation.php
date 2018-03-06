<?php
/**
 * @package    Nerudas Template
 * @version    4.9.6
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;

$link = ($profile->get('guest')) ? 'href="#mdoalLogin" data-uk-modal="{center:true}"' :
	'href="' . Route::_('index.php?option=com_users&view=profile') . '"';
?>
<div>
	<a <?php echo $link; ?> class="profile uk-flex-middle uk-flex uk-link-muted">
		<div class="avatar uk-cover-background"
			 style="background-image: url('<?php echo $profile->get('avatar'); ?>');">
		</div>
		<div class="info">
			<div class="">
				<?php echo $profile->get('name'); ?>
			</div>
			<div class="job uk-text-small">
				Nerudas
			</div>
		</div>
	</a>
</div>
<?php if ($profile->get('guest')): ?>
	<ul class="uk-nav uk-nav-offcanvas">
		<li>
			<a href="#mdoalLogin" class="login" data-uk-modal="{center:true}">
				<i class="uk-icon-sign-in uk-icon-small uk-margin-right"></i>
				<?php echo Text::_('COM_PROFILES_LOGIN'); ?>
			</a>
		</li>
	</ul>
<?php endif; ?>
