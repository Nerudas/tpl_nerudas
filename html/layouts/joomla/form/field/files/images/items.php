<?php
/**
 * @package    Nerudas Template
 * @version    4.9.33
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;

use Joomla\CMS\Uri\Uri;

jimport('joomla.filesystem.file');

$images = $displayData;
$root   = '/' . trim(Uri::root(true));
?>
<ul class="uk-position-relative">
	<?php foreach ($images as $image): ?>
		<li class="item<?php echo ($image->text !== false) ? ' with-text' : '' ?>"
			data-key="<?php echo $image->file; ?>">
			<div class="wrapper">
				<a href="<?php echo $root . $image->src; ?>" target="_blank" class="icon">
					<img src="<?php echo $root . $image->src; ?>">
				</a>
				<div class="text">
					<?php if ($image->text === false) : ?>
						<div class="uk-h4 uk-margin-small-bottom">
							<?php echo JFile::getName($image->src); ?>
						</div>
					<?php endif; ?>
					<div><code><?php echo $image->src; ?></code></div>
					<?php if ($image->text !== false) : ?>
						<div class="description">
							<textarea class="uk-width-1-1" rows="3" name="<?php echo $image->filed_name; ?>[text]"
							><?php echo $image->text; ?></textarea>
						</div>
					<?php endif; ?>
				</div>
			</div>

			<div class="actions">
				<a class="remove uk-text-danger uk-icon-remove" data-file="<?php echo $image->src; ?>"></a>
				<a class="move uk-text-primary uk-icon-arrows"></a>
			</div>
			<input type="hidden" name="<?php echo $image->filed_name; ?>[ordering]"
				   value="<?php echo $image->ordering; ?>">
		</li>
	<?php endforeach; ?>
</ul>