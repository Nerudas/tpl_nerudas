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
?>
<div class="sitenews">
	<div class="uk-text-uppercase uk-text-deviver uk-text-center uk-margin-bottom uk-hidden">
		<a class="uk-text-light" href="<?php echo $params->get('title-link'); ?>">
			<?php echo $params->get('title-text'); ?>
		</a>
	</div>

	<div class="itemlist">
		<?php foreach ($items as $key => $item):
			$item->mintext = NerudasUtility::minimalizeText($item->introtext);
			?>
			<div class="item uk-margin-bottom">
				<div class="title uk-text-mlarge uk-amrgin-samll-bottom">
					<a class="uk-link-muted " href="<?php echo $item->url; ?>">
						<?php echo $item->title; ?>
					</a>
				</div>
				<div class="image uk-text-center">
					<a class="uk-link-muted" href="<?php echo $item->url; ?>">
						<img src="<?php echo $item->image; ?>" alt="<?php echo $item->title; ?>" class="uk-width-1-2"/>
					</a>
				</div>
			</div>

			<?
			/*
						<pre>
				 <? print_r($item); ?>
				</pre>
			<div class="item uk-margin-bottom uk-container-center uk-width-xsmall-1-1 uk-width-small-9-10 uk-width-medium-7-10 uk-width-large-7-10 uk-width-xlarge-1-1">
				<div class="uk-grid uk-grid-small">
					<div class="uk-width-xsmall-1-4 uk-width-small-1-5 uk-width-medium-1-10 uk-width-large-1-10 uk-width-xlarge-1-6">
						<a class="uk-text-muted" href="<?php echo $item->link; ?>">
							<?php echo JHTML::_('date', $item->publish_up, 'd.m'); ?>
						</a>
					</div>
					<div class="uk-width-xsmall-3-4 uk-width-small-4-5 uk-width-medium-9-10 uk-width-large-9-10 uk-width-xlarge-5-6">
						<a class="uk-display-block text uk-link-muted" href="<?php echo $item->url; ?>">
							<span>
								<?php echo $item->mintext;?>
							</span>
						</a>
					</div>
				</div>
			</div>
			*/
			?>
		<?php endforeach; ?>
	</div>
</div>