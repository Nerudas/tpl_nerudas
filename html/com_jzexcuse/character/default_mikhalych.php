<?php
/**
 * @package    Nerudas Template
 * @version    4.9.5
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2017 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;
$app          = JFactory::getApplication();
$doc          = JFactory::getDocument();
$title        = $doc->getTitle();
$answerButton = JText::sprintf('COM_JZEXCUSE_CHARACTER_ASK', $this->character->name);
if ($this->character->id == 1)
{
	$title        = $this->character->name . ': ';
	$answerButton = JText::_('NERUDAS_ASKMORE');
	if (!$this->answer)
	{
		$answerButton = $doc->getTitle();
	}

}
if ($this->character->id == 2)
{
	$title        = $this->character->name . ': ';
	$answerButton = JText::_('NERUDAS_EXCGEORGEMORE');
	if (!$this->answer)
	{
		$answerButton = $doc->getTitle();
	}

}
?>
<div class="uk-grid">
	<div class="uk-width-1-2 uk-width-medium-1-3">
		<?php if (!$this->answer): ?>
			<?php if (!empty($this->character->image)): ?>
				<div>
					<img src="<?php echo $this->character->image; ?>" alt="<?php echo $this->character->name; ?>"
						 class="uk-width-1-1">
				</div>
			<?php endif; ?>
		<?php else: ?>
			<?php if (!empty($this->answer->image)): ?>
				<div>
					<img src="<?php echo $this->answer->image; ?>" alt="<?php echo $this->answer->title; ?>">
				</div>
			<?php endif; ?>
			<?php if (!empty($this->answer->audio)): ?>
				<div>
					<audio controls autoplay class="uk-width-1-1">
						<source src="<?php echo $this->answer->audio; ?>">
						Your browser does not support the audio element.
					</audio>
				</div>
			<?php endif; ?>
		<?php endif; ?>
	</div>
	<div class="uk-width-1-2 uk-width-medium-2-3">
		<h2 class="uk-margin-small-bottom">
			<?php echo $title ?>
		</h2>
		<?php if (!$this->answer): ?>
			<?php if (!empty($this->character->text)): ?>
				<div class="uk-text-mlarge">
					<?php echo $this->character->text; ?>
				</div>
			<?php endif; ?>
		<?php else: ?>
			<?php if (!empty($this->answer->text)): ?>
				<div class="uk-grid uk-grid-small">
					<div class="uk-widht-1-10">
						<i class="uk-icon-quote-left uk-icon-large uk-align-left"></i>
					</div>
					<div class="uk-widht-9-10 uk-text-large">
						<?php echo $this->answer->text; ?>
					</div>
				</div>
			<?php endif; ?>
		<?php endif; ?>
		<form method="get" class="uk-crearfix uk-margin-top">
			<input type="hidden" name="aid" value="<?php echo $this->randomAnswerID; ?>">
			<div class="ya-share2 uk-float-left" data-services="vkontakte,facebook,odnoklassniki,twitter"
				 data-counter="" data-size="m">
			</div>
			<button class="uk-button uk-button-success uk-float-right">
				<?php echo $answerButton; ?>
			</button>
		</form>
	</div>
</div>
