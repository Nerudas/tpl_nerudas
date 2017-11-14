<?php
/**
 * @package    Nerudas Template
 * @version    4.9.1
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2017 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */
defined('_JEXEC') or die('Restricted access');
$app = JFactory::getApplication();

if ($app->isAdmin()) {
	return;
}
$doc = JFactory::getDocument();
$doc->addScriptDeclaration( "
	(function($){
		$(document).ready(function() {			
			$('.show-modal-portfolio').live('click', function() {
				if ($(this).attr('data-image')) {	
					$('#gallery-modal .set-image').attr('src', $(this).data('image'));
				}
				if ($(this).attr('data-title')) {
					$('#gallery-modal .set-image').attr('alt', $(this).data('title'));
					$('#gallery-modal .set-title').removeClass('uk-hidden');
					$('#gallery-modal .set-title h3').html($(this).data('title'));
				}
				if ($(this).attr('data-description')) {
					console.log($(this).data('description'));
					$('#gallery-modal .set-description').removeClass('uk-hidden');
					$('#gallery-modal .set-description').html($(this).data('description'));	
				}
				UIkit.modal('#gallery-modal').show();
				$('#gallery-modal').on({
					'hide.uk.modal': function () {
						$('#gallery-modal .set-image').removeAttr('src');
						$('#gallery-modal .set-image').removeAttr('alt');
						$('#gallery-modal .set-title').addClass('uk-hidden');
						$('#gallery-modal .set-title h3').html();
						$('#gallery-modal .set-description').addClass('uk-hidden');
						$('#gallery-modal .set-description').html();	
					}
				});

			});
		});
	})(jQuery);
" );
?>
<div id="sigProId<?php echo $gal_id; ?>"  class="gallery uk-grid uk-grid-small <?php echo $singleThumbClass.$extraWrapperClass; ?>" data-uk- data-uk-grid-match data-uk-grid-margin>
	<?php foreach($gallery as $count=>$photo): 
	?>
	<div class="item uk-width-xsmall-1-2 uk-width-small-1-3 uk-width-medium-1-4 uk-width-large-1-4 uk-width-xlarge-1-4">	
		<a 
			class="image uk-thumbnail uk-display-block uk-cover-background show-modal-portfolio" 
			data-image="<?php echo $photo->sourceImageFilePath; ?>" 
			data-title="<?php echo $photo->captionTitle; ?>" 
			<?php if ($photo->captionDescription !== PHP_EOL): ?>
				data-description="<?php echo $photo->captionDescription; ?>" 
			<?php endif; ?>
			title="<?php echo $photo->captionTitle; ?>" 
		>
			<img src="<?php echo $photo->thumbImageFilePath; ?>" alt="<?php echo $photo->captionTitle; ?>" class="uk-thumbnail" />
		</a>
	</div>
	<?php endforeach; ?>
</div>
<div id="gallery-modal" class="uk-modal">
	<div class="uk-modal-dialog uk-modal-dialog-large">
		<button type="button" class="uk-modal-close uk-close uk-icon-small"></button>
		<div class="uk-modal-header uk-hidden set-title">
			<h3></h3>
		</div>
		<div class="uk-text-center ">
			<img src="" alt="" class="set-image" />
		</div>
		<div class="uk-modal-footer uk-hidden set-description">

		</div>
	</div>
</div>
