<?php
/**
 * @package    Nerudas Template
 * @version    4.9.2
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2017 Nerudas. All rights reserved.
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
			<?php if (!empty($this->answer->text)): ?>
				<div class="uk-text-mlarge">
					<?php echo $this->answer->text; ?>
				</div>
			<?php endif; ?>
		</div>
		<div class="uk-width-1-1 uk-width-small-1-3 uk-width-medium-1-3 uk-text-center">
			<?php if (!empty($this->answer->video)): ?>
				<div>

					<video class="" controls="controls" preload="meta" poster="<?php echo $this->answer->image; ?>"
						   autoplay src="<?php echo $this->answer->video; ?>" style="height:50vh;">
						Your browser does not support the video element.
					</video>
					<br/>
					<button class="uk-button uk-button-large uk-button-success uk-width-4-6 uk-display-inlineblock uk-margin-top">
						<?php echo JText::_('NERUDAS_EXCGEORGEBUTTON'); ?>
					</button>
				</div>
			<?php elseif (!empty($this->answer->image)): ?>
				<div>
					<button class="uk-button uk-button-link" data-uk-tooltip title="<?php echo $doc->getTitle(); ?>">
						<img src="<?php echo $this->answer->image; ?>" alt="<?php echo $this->answer->title; ?>"
							 class="uk-width-4-5">
					</button>
					<?php /*controls  */
					if (!empty($this->answer->audio)): ?>
						<div>
							<audio autoplay class="uk-width-1-1">
								<source src="<?php echo $this->answer->audio; ?>">
								Your browser does not support the audio element.
							</audio>
						</div>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		</div>
		<div class="uk-width-1-1 uk-width-small-2-3 uk-width-medium-1-3 uk-position-relative">
			<div class="uk-position-midde">
				<div class="uk-text-xlarge">
					<?php echo $app->getMenu()->getActive()->params->get('page_title'); ?>
				</div>
			</div>
			<div class="uk-position-bottom">
				<div class="ya-share2 uk-text-right" data-services="vkontakte,facebook,odnoklassniki,twitter"
					 data-counter="" data-size="m">
				</div>
			</div>
		</div>
	</div>
</form>
