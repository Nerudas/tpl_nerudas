<?php
/**
 * @package    Nerudas Template
 * @version    4.9.3
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2017 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;
$app                 = JFactory::getApplication();
$doc                 = JFactory::getDocument();
$modules             = $doc->loadRenderer('modules');
$this->item->mintext = NerudasUtility::minimalizeText($this->item->introtext);
if ($this->item->extra_fields)
{
	$this->item->extra  = NerudasK2Helper::getItemExtra($this->item->extra_fields);
	$this->item->phones = NerudasK2Helper::getPhones($this->item->extra);
}
if (!$this->item->image)
{
	$this->item->image = '/templates/' . $app->getTemplate() . '/images/noimages/' . $this->item->catid . '.jpg';
}
if (isset($this->item->editLink))
{
	$this->item->editLink = '/forms/profiles.html?cid=' . $this->item->id;
}
$this->author = NerudasProfilesHelper::getProfile($this->item->created_by);
$this->user   = false;
if (!JFactory::getUser()->guest)
{
	$this->user = NerudasProfilesHelper::getProfile(JFactory::getUser()->id);
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
				$('#myStatusForm').submit(function (event) {
					var text = $('#myStatusForm-text').val();
					$('#page-loading').fadeIn();
					$.ajax({
						type: 'POST',
						dataType: 'json',
						url: '<?php JURI::root();?>index.php?option=com_nerudas&format=json&task=profiles.setMyStatus',
						data: {
							data: text,
						},
						beforeSend: function (index) {
						},
						success: function (index) {
							$('#myStatus .status .text').html(index.data);
							console.log(index.data);
						},
						error: function (index) {
							console.log('error');
							console.log(index.data);
						},
						complete: function (index) {
							$('#myStatusForm').addClass('uk-hidden');
							$('#page-loading').fadeOut();
						}
					});
					return false;
				});
			});

		})(jQuery);


	</script>

	<div id="profiles" class="item">
		<div class="uk-panel uk-panel-box uk-margin-bottom uk-padding">
			<div class="uk-grid">
				<div class="uk-width-1-1 uk-width-small-1-1 uk-width-medium-1-4">
					<img src="<?php echo $this->item->image; ?>" alt="<?php echo $this->item->title; ?>">
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
										<li>
											<a href="/forms/site">
												<i class="uk-icon-lock uk-margin-small-right"></i>
												<?php echo JText::_('NERUDAS_CHANGE_PASSWORD'); ?>
											</a>
										</li>
									</ul>
								</div>
							</div>
						<?php endif; ?>
					</div>
					<div id="myStatus" class="uk-position-relative">
						<div class="status">
						<span class="text uk-margin-small-right uk-text-slarge">
						<?php if ($this->author->myStatus)
						{
							echo '«' . $this->author->myStatus->text . '»';
						} ?>
						</span>
							<?php if ($this->author->me): ?>
								<a class="change uk-text-muted" data-uk-toggle="{target:'#myStatusForm'}">
									<?php echo JText::_('NERUDAS_CHANGE_STATUS'); ?>
								</a>
							<?php endif; ?>
						</div>
						<?php if ($this->author->me): ?>
							<form id="myStatusForm" class="uk-form uk-panel uk-panel-box uk-position-top uk-hidden">
								<div class="uk-margin-small-bottom">
									<input id="myStatusForm-text" type="text" name="text"
										   class="uk-width-1-1" <?php if ($this->author->myStatus)
									{
										echo 'value="' . $this->author->myStatus->text . '"';
									} ?> />
								</div>
								<div class="uk-text-right">
									<button type="submit" class="uk-button uk-button-success">
										<?php echo JText::_('NERUDAS_SAVE'); ?>
									</button>
								</div>
							</form>
						<?php endif; ?>
					</div>
					<dl class="uk-description-list-horizontal">
						<dt class="uk-text-w600 uk-margin-small-bottom">
							<?php echo JText::_('NERUDAS_JOB'); ?>
						</dt>
						<dd class="uk-text-muted uk-margin-small-bottom">
							<?php if ($this->author->job): ?>
								<a class="uk-text-muted" href="<?php echo $this->author->job->link; ?>" target="_blank">
									<?php echo $this->author->job->name; ?>
									<?php if (!empty($this->item->extra['job_post']->value)): ?>
										<span class="uk-text-muted">, <?php echo $this->item->extra['job_post']->value; ?></span>
									<?php endif; ?>
								</a>
							<?php else: ?>
								<a class="uk-text-danger" href="<?php echo $this->author->editlink; ?>" target="_blank">
									<?php echo JText::_('NERUDAS_PROFILES_NO_JOB'); ?>
								</a>
							<?php endif; ?>
						</dd>
					</dl>
				</div>
			</div>
		</div>
		<?php if ($this->author->me): ?>
			<div class="uk-crearfix uk-margin-bottom">
				<a class="uk-button uk-button-success uk-margin-right" href="/ads/add">
					<?php echo JText::_('NERUDAS_ADD_ADS'); ?>
				</a>
				<a class="uk-button uk-button-success" href="/map.html#showaddform">
					<?php echo JText::_('NERUDAS_ADD_MAP'); ?>
				</a>
			</div>
		<?php endif; ?>
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
				<div class="comments">
					<?php echo $this->loadTemplate('reviews'); ?>
				</div>
				<div class="ads">
					<?php echo $this->loadTemplate('ads'); ?>
				</div>
			</div>
		</div>

	</div>
<?php echo $this->loadTemplate('map_modal'); ?>