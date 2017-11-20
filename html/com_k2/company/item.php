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
$app     = JFactory::getApplication();
$doc     = JFactory::getDocument();
$modules = $doc->loadRenderer('modules');
if (empty($this->item->image))
{
	$this->item->image = '/templates/' . $app->getTemplate() . '/images/noimages/' . $this->item->catid . '.jpg';
}
$this->item->mintext = JHTML::_('string.truncate', (strip_tags($this->item->introtext)), 150);
$this->author        = NerudasProfilesHelper::getProfile($this->item->created_by);
$this->user          = false;
if (!JFactory::getUser()->guest)
{
	$this->user = NerudasProfilesHelper::getProfile(JFactory::getUser()->id);
}
if (isset($this->item->editLink))
{
	$this->item->editLink = '/forms/company?cid=' . $this->item->id;
}
if ($this->item->extra_fields)
{
	$this->item->extra  = NerudasK2Helper::getItemExtra($this->item->extra_fields);
	$this->item->phones = NerudasK2Helper::getPhones($this->item->extra);
}
?>
<script>
	(function ($) {
		$(document).ready(function () {
			var navigation = $('#company-navigation');
			if (window.location.hash) {
				var hash = window.location.hash.substring(1);
				if (hash) {
					$(navigation.selector + ' .' + hash).addClass('uk-active');
				}
			}
			else {
				$(navigation.selector + ' .contacts').addClass('uk-active');
				window.location.hash = 'contacts';
			}
			$('#comments .uk-pagination a').each(function () {
				if ($(this).attr('href')) {
					$(this).attr('href', $(this).attr('href') + '#comments');
				}
				;
			});
			$(navigation.selector + ' a').on('click', function () {
				var hash = $(this).parent().data('hash');
				if (hash) {
					window.location.hash = hash;
				}
			});
		});
		var map;
		<?php if (!empty($this->item->latitude) && !empty($this->item->longitude)) :
		$this->item->map = new stdClass();
		$this->item->map->latitude = $this->item->latitude;
		$this->item->map->longitude = $this->item->longitude;
		$this->item->map->zoom = $this->item->region->zoom;
		$this->item->map->mark = 'templates/nerudas/images/map/' . $this->item->catid . '.png';
		$this->item->map->markSize = getimagesize($this->item->map->mark);
		$this->item->map->markOffset = json_encode(array(-1 * round($this->item->map->markSize[0] / 2), -1 * round($this->item->map->markSize[1])));
		$this->item->map->mark = JURI::root() . 'templates/nerudas/images/map/' . $this->item->catid . '.png';
		$this->item->map->markSize = json_encode(array($this->item->map->markSize[0], $this->item->map->markSize[1]));
		?>
		function modalMap() {
			var map = new ymaps.Map('map', {
				center: [<?php echo $this->item->map->latitude . ',' . $this->item->map->longitude;?>],
				zoom:  <?php echo $this->item->map->zoom; ?>,
				controls: ['zoomControl'],
			});
			map.geoObjects.add(new ymaps.Placemark([<?php echo $this->item->map->latitude . ',' . $this->item->map->longitude;?>], {}, {
				iconLayout: 'default#image',
				iconImageHref: '<?php echo $this->item->map->mark; ?>',
				iconImageSize: <?php echo $this->item->map->markSize; ?>,
				iconImageOffset: <?php echo $this->item->map->markOffset; ?>,
				preset: 'default#image'
			}))
		}

		ymaps.ready(modalMap);
		<?php endif;  ?>
	})(jQuery);
</script>

<div id="company" class="item">
	<div class="uk-panel uk-panel-box uk-margin-bottom uk-padding">
		<div class="uk-grid">
			<div class="uk-width-1-1 uk-width-small-1-1 uk-width-medium-1-4">
				<span class="image uk-thumbnail uk-display-block uk-cover-background" data-ratio-height="[166,125]"
					  style="background-image: url('<?php echo $this->item->image; ?>')">
				</span>
			</div>
			<div class="uk-width-1-1 uk-width-small-1-1 uk-width-medium-3-4">
				<div class="uk-clearfix">
					<h1 class="uk-text-large uk-display-inline-block">
						<?php echo $this->item->title; ?>
					</h1>
					<?php if (isset($this->item->editLink)): ?>
						<div class="uk-float-right uk-margin-left uk-position-relative"
							 data-uk-dropdown="{mode:'click'}">
							<a class="uk-icon-ellipsis-h uk-icon-small uk-icon-hover  uk-text-muted">
							</a>
							<div class="uk-dropdown">
								<ul class="uk-nav uk-nav-dropdown">
									<li>
										<a href="<?php echo $this->item->editLink; ?>">
											<i class="uk-icon-pencil uk-margin-small-right"></i>
											<?php echo JText::_('NERUDAS_EDIT'); ?>
										</a>
									</li>
								</ul>
							</div>
						</div>
					<?php endif; ?>
				</div>
				<dl class="uk-description-list-horizontal">
					<dt class="uk-text-w600 uk-margin-small-bottom">
						<?php echo JText::_('NERUDAS_ADD_DATE_F'); ?>
					</dt>
					<dd class="uk-text-muted uk-margin-small-bottom">
						<?php echo JHTML::_('date', $this->item->publish_up, 'd F Y' . ' ' . JText::_('NERUDAS_IN') . ' H:i'); ?>
					</dd>
					<?php if (isset($this->item->extraFields->inn) && !empty($this->item->extraFields->inn->value)): ?>
						<dt class="uk-text-w600 uk-margin-small-bottom">
							<?php echo $this->item->extraFields->inn->name; ?>
						</dt>
						<dd class="uk-text-muted uk-margin-small-bottom">
							<?php echo $this->item->extraFields->inn->value; ?>
						</dd>
					<?php endif; ?>
					<?php if (isset($this->item->extraFields->director) && !empty($this->item->extraFields->director->value)): ?>
						<dt class="uk-text-w600 uk-margin-small-bottom">
							<?php echo $this->item->extraFields->director->name; ?>
						</dt>
						<dd class="uk-text-muted uk-margin-small-bottom">
							<?php echo $this->item->extraFields->director->value; ?>
						</dd>
					<?php endif; ?>
					<?php if (isset($this->item->extraFields->company_scope) && !empty($this->item->extraFields->company_scope->value)): ?>
						<dt class="uk-text-w600 uk-margin-small-bottom">
							<?php echo $this->item->extraFields->company_scope->name; ?>
						</dt>
						<dd class="uk-text-muted uk-margin-small-bottom">
							<?php echo $this->item->extraFields->company_scope->value; ?>
						</dd>
					<?php endif; ?>
				</dl>
			</div>
		</div>
	</div>
	<div class="uk-margin-top">

		<?php echo $this->loadTemplate('navigation'); ?>


		<div id="company-tabs" class="uk-switcher">
			<div class="contacs">
				<?php echo $this->loadTemplate('contacts'); ?>
			</div>
			<?php if ($this->item->introtext): ?>
				<div class="about">
					<?php echo $this->loadTemplate('about'); ?>
				</div>
			<?php endif; ?>
			<div class="staff">
				<?php echo $this->loadTemplate('staff'); ?>
			</div>
			<div class="comments">
				<?php echo $this->loadTemplate('reviews'); ?>
			</div>
			<? /*
				<div class="news">
					<?php  echo $this->loadTemplate('news'); ?>
				</div>
				*/ ?>
		</div>

	</div>
</div>
