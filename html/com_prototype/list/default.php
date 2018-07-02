<?php
/**
 * @package    Nerudas Template
 * @version    4.9.18
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Factory;

$app = Factory::getApplication();
$doc = Factory::getDocument();


HTMLHelper::_('jquery.framework');
HTMLHelper::_('formbehavior.chosen', 'select');
HTMLHelper::_('script', 'media/com_prototype/js/list.min.js', array('version' => 'auto'));

$doc->addScriptDeclaration(
	"function showPrototypeListBalloon() {UIkit.modal('[data-prototype-balloon]', {center: true}).show();}");

if (!empty($app->input->get('item_id')))
{
	$doc->addScriptDeclaration('	jQuery(document).ready(function () {
		jQuery(\'[data-prototype-show="' . $app->input->get('item_id') . '"]\').trigger(\'click\');
	});');
}
?>


<div id="prototype" class="itemlist">
	<?php
	$layouts  = array('list' => $this->listLink, 'map' => $this->mapLink, 'active' => 'list');
	$subitems = array();
	if (!empty($this->children))
	{
		foreach ($this->children as $child)
		{
			$object       = new stdClass();
			$object->name = $child->title;
			$object->link = $child->listLink;
			$subitems[]   = $object;
		}
	}
	echo LayoutHelper::render('template.title', array(
		'add'      => $this->addLink,
		'layouts'  => $layouts,
		'subitems' => $subitems,)); ?>
	<div class="uk-panel uk-panel-box uk-margin-bottom uk-panel-box-secondary">
		<form action="<?php echo htmlspecialchars(Factory::getURI()->toString()); ?>" method="get" name="adminForm"
			  class="uk-form filter">
			<div>
				<div class="uk-flex uk-flex-wrap uk-flex-middle">
					<div class="uk-margin-right uk-flex uk-width-1-1">
						<?php
						$class = $this->filterForm->getFieldAttribute('search', 'class', '', 'filter') . ' uk-width-1-1';
						$this->filterForm->setFieldAttribute('search', 'class', $class, 'filter');
						$this->filterForm->setFieldAttribute('search', 'id', 'filter_search_desktop');
						echo $this->filterForm->getInput('search', 'filter'); ?>
						<div class="uk-button-group left-input">
							<button type="submit" class="uk-button uk-text-primary uk-icon-search uk-hidden-small"
									title="<?php echo Text::_('JSEARCH_FILTER_SUBMIT'); ?>" data-uk-tooltip>
							</button>
						</div>
					</div>
				</div>
				<div class="uk-form-row">
					<?php if (!Factory::getUser()->guest):
						$onlymy = $this->filterForm->getField('onlymy', 'filter');
						$this->filterForm->setFieldAttribute('onlymy', 'onchange', 'this.form.submit()', 'filter');
						?>

						<label for="<?php echo $onlymy->id; ?>" class="uk-flex-inline uk-flex-middle uk-margin-top">
							<?php echo $this->filterForm->getInput('onlymy', 'filter'); ?>
							<span class="uk-margin-small-left">
								<?php echo Text::_('COM_PROTOTYPE_ONLYMY_ITEMS'); ?>
							</span>
						</label>

					<?php endif; ?>
				</div>
			</div>
		</form>
	</div>

	<?php if ($this->items) : ?>
		<div class="items">
			<?php foreach ($this->items as $id => $item)
			{
				echo $item->listitem;
			};
			?>
		</div>
		<div>
			<?php echo $this->pagination->getPagesLinks(); ?>
		</div>
	<?php endif; ?>
	<div data-prototype-balloon class="uk-modal">
		<div class="uk-modal-dialog uk-modal-dialog-large">
			<button class="uk-modal-close uk-close" type="button"></button>
			<div class="uk-alert uk-alert-danger" data-prototype-balloon-error>
				<?php echo Text::_('JGLOBAL_NO_MATCHING_RESULTS'); ?>
			</div>
			<div data-prototype-balloon-loading>
				<i class="uk-icon-spinner uk-icon-spin uk-margin-small-right"></i>
				<?php echo JText::_('TPL_NERUDAS_LOADING'); ?>
			</div>
			<div data-prototype-balloon-content class="uk-overflow-container">
			</div>
		</div>
	</div>
</div>



