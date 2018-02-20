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
$app = JFactory::getApplication();
$doc = JFactory::getDocument();
?>
<h2 class="uk-hidden">
	<?php echo $doc->getTitle(); ?>
</h2>
<form method="get">
	<input type="hidden" name="aid" value="<?php echo $this->randomAnswerID; ?>">
	<div class="uk-grid uk-grid-small">
		<div class="uk-width-1-1 uk-width-small-2-3 uk-width-medium-1-3">
			<?php if (!empty($this->character->text)): ?>
				<div class="uk-text-mlarge">
					<?php echo $this->character->text; ?>
				</div>
			<?php endif; ?>
		</div>
		<div class="uk-width-1-1 uk-width-small-1-3 uk-width-medium-1-3 uk-text-center">
			<?php if (!empty($this->character->image)): ?>
				<div>
					<button class="uk-button uk-button-link" data-uk-tooltip title="<?php echo $doc->getTitle(); ?>">
						<img src="<?php echo $this->character->image; ?>" alt="<?php echo $doc->getTitle(); ?>"
							 class="uk-width-4-5">
					</button>
				</div>
			<?php endif; ?>
		</div>
		<div class="uk-width-1-1 uk-width-small-2-3 uk-width-medium-1-3 uk-position-relative">
			<div class="uk-position-midde">
				<div class="uk-text-xlarge">
					<?php echo $doc->getTitle(); ?>
				</div>
				<button class="uk-button uk-button-large uk-button-success">
					<?php echo JText::_('NERUDAS_EXCGEORGEBUTTON'); ?>
				</button>
			</div>
			<div class="uk-position-bottom">
				<div class="ya-share2 uk-text-right" data-services="vkontakte,facebook,odnoklassniki,twitter"
					 data-counter="" data-size="m">
				</div>
			</div>
		</div>
	</div>
</form>
