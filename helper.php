<?php
/**
 * @package    Nerudas Template
 * @version    4.9.27
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\Registry\Registry;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Helper\ModuleHelper;

class tplNerudasHelper
{
	/**
	 * Set tempalte head
	 *
	 * @param $params JObject $params Template params
	 *
	 * @since   4.9.1
	 */
	public function setHead($params)
	{
		$doc = Factory::getDocument();

		HTMLHelper::_('jquery.framework');

		// Template params
		$minified = ($params->get('minified', 1)) ? '.min' : '';

		// Add Fonts
		HTMLHelper::_('stylesheet', 'fonts' . $minified . '.css', array('version' => 'auto', 'relative' => true));

		// Add UIkit
		$this->addUIkit($minified);

		// Add jquery.cookie
		HTMLHelper::_('script', 'jquery.cookie' . $minified . '.js', array('version' => 'auto', 'relative' => true));

		// Add chosen.jquery
		$this->addChosen($minified);

		// Add Time ago
		HTMLHelper::_('script', 'jquery.timeago' . $minified . '.js', array('version' => 'auto', 'relative' => true));
		HTMLHelper::_('script', 'jquery.timeago.ru' . $minified . '.js', array('version' => 'auto', 'relative' => true));

		$this->unsetBootstrap();

		// Add Template
		$this->addTemplate($minified);

		// Set meta viewport
		$doc->setMetaData('viewport', 'width=device-width, initial-scale=1, minimum-scale=1');
	}

	/**
	 * Add Chosen to head
	 *
	 * @param string $minified .min minified
	 *
	 * @since   4.9.1
	 */
	protected function addChosen($minified)
	{
		HTMLHelper::_('script', 'chosen.jquery' . $minified . '.js', array('version' => 'auto', 'relative' => true));
		Factory::getDocument()->addScriptDeclaration("
		jQuery(document).ready(function() {
			jQuery('.uk-form select').chosen({
				placeholder_text_single: '" . JText::_('NERUDAS_CHOSEN_SINGLE') . "', 
				placeholder_text_multiple: '" . JText::_('NERUDAS_CHOSEN_MULTIPLE') . "', 
				single_backstroke_delete: false
			});
		});");
	}

	/**
	 * Add UIkit to head
	 *
	 * @param string $minified .min minified
	 *
	 * @since   4.9.1
	 */
	protected function addUIkit($minified)
	{
		HTMLHelper::_('stylesheet', 'uikit' . $minified . '.css', array('version' => 'auto', 'relative' => true));
		HTMLHelper::_('stylesheet', 'uikit/form-file' . $minified . '.css', array('version' => 'auto', 'relative' => true));
		HTMLHelper::_('stylesheet', 'uikit/form-password' . $minified . '.css', array('version' => 'auto', 'relative' => true));
		HTMLHelper::_('stylesheet', 'uikit/notify' . $minified . '.css', array('version' => 'auto', 'relative' => true));
		HTMLHelper::_('stylesheet', 'uikit/placeholder' . $minified . '.css', array('version' => 'auto', 'relative' => true));
		HTMLHelper::_('stylesheet', 'uikit/sticky' . $minified . '.css', array('version' => 'auto', 'relative' => true));
		HTMLHelper::_('stylesheet', 'uikit/tooltip' . $minified . '.css', array('version' => 'auto', 'relative' => true));
		HTMLHelper::_('stylesheet', 'uikit/progress' . $minified . '.css', array('version' => 'auto', 'relative' => true));
		HTMLHelper::_('stylesheet', 'uikit/slideshow' . $minified . '.css', array('version' => 'auto', 'relative' => true));
		HTMLHelper::_('stylesheet', 'uikit/slidenav' . $minified . '.css', array('version' => 'auto', 'relative' => true));

		HTMLHelper::_('script', 'uikit' . $minified . '.js', array('version' => 'auto', 'relative' => true));
		HTMLHelper::_('script', 'uikit/accordion' . $minified . '.js', array('version' => 'auto', 'relative' => true));
		HTMLHelper::_('script', 'uikit/form-password' . $minified . '.js', array('version' => 'auto', 'relative' => true));
		HTMLHelper::_('script', 'uikit/grid' . $minified . '.js', array('version' => 'auto', 'relative' => true));
		HTMLHelper::_('script', 'uikit/lightbox' . $minified . '.js', array('version' => 'auto', 'relative' => true));
		HTMLHelper::_('script', 'uikit/notify' . $minified . '.js', array('version' => 'auto', 'relative' => true));
		HTMLHelper::_('script', 'uikit/pagination' . $minified . '.js', array('version' => 'auto', 'relative' => true));
		HTMLHelper::_('script', 'uikit/sticky' . $minified . '.js', array('version' => 'auto', 'relative' => true));
		HTMLHelper::_('script', 'uikit/tooltip' . $minified . '.js', array('version' => 'auto', 'relative' => true));
		HTMLHelper::_('script', 'uikit/slideshow' . $minified . '.js', array('version' => 'auto', 'relative' => true));

	}

	/**
	 * Add tempalte to head
	 *
	 * @param string $minified .min minified
	 *
	 * @since   4.9.1
	 */
	protected function addTemplate($minified)
	{
		HTMLHelper::_('stylesheet', 'template' . $minified . '.css', array('version' => 'auto', 'relative' => true));
		HTMLHelper::_('script', 'template' . $minified . '.js', array('version' => 'auto', 'relative' => true));
	}

	/**
	 * Check if beta version of site
	 *
	 * @param $params JObject $params Template params
	 *
	 * @return boolean
	 *
	 * @since   4.9.1
	 */
	public function checkSiteVersion($params)
	{
		if (preg_match_all('/\/\/(.*)\.(.*)\.(.*)\//s', (JURI::base()), $domain) && $subDomain = $domain[1][0])
		{
			$doc = Factory::getDocument();
			if ($subDomain == 'alpha' || $subDomain == 'beta')
			{
				$doc->setMetaData('robots', 'noindex, nofollow');
				$doc->addHeadLink(str_replace($subDomain . '.', '', JUri::getInstance()->toString())
					, 'canonical');
				$doc->setTitle('[' . strtoupper($subDomain) . '] ' . $doc->getTitle());

				if ($subDomain == 'alpha') $params->set('minified', 0);

				return true;
			}
		}

		return false;
	}

	/**
	 * Unset joomla default bootstrap framework form head
	 *
	 * @since   4.9.1
	 */
	public function unsetBootstrap()
	{
		$doc     = Factory::getDocument();
		$head    = $doc->getHeadData();
		$scripts = $head['scripts'];
		// Uset bootstra
		unset($scripts['/media/jui/js/bootstrap.min.js']);
		unset($scripts['/media/jui/js/chosen.jquery.min.js']);
		$head['scripts'] = $scripts;
		$doc->setHeadData($head);
	}

	/**
	 * Get middle layout
	 *
	 * @param $template This template
	 *
	 * @return string layput name
	 *
	 * @since   4.9.3
	 */
	public function getMiddleLayot($template)
	{
		$app       = Factory::getApplication();
		$params    = $template->params;
		$component = $app->input->get('option');
		$view      = $app->input->get('view');

		// Columns
		$layout = '1column';
		if ($template->countModules('sidebar'))
		{
			$layout = '2columns';
		}

		// Maps layots
		$mapLayouts = array(
			'com_board'     => 'map',
			'com_prototype' => 'map',
		);

		foreach ($mapLayouts as $c => $v)
		{
			if ($component == $c && $view == $v)
			{
				$layout = 'map';
				break;
			}
		}

		// HomePage
		$menu = Factory::getApplication()->getMenu();
		if ($menu->getActive() === $menu->getDefault(Factory::getLanguage()->getTag()))
		{
			$layout = 'home';
		}

		return 'template.middle.' . $layout;
	}

	/**
	 * Check advansed filter activity
	 *
	 * @param JForm  $form   \Joomla\CMS\Form\Form
	 * @param array  $fields Fields names
	 * @param string $group  Fields group
	 *
	 * @return bool
	 *
	 * @since   4.9.3
	 */
	public static function checkAdvansedFilterActivity($form, $fields, $group = 'filter')
	{
		foreach ($fields as $field)
		{
			$value = $form->getValue($field, $group);
			if (!empty($value) && !is_array($value))
			{
				return true;
			}
			elseif (!empty($value))
			{
				foreach ($value as $key => $val)
				{
					if (!empty($val))
					{
						return true;
					}
				}
			}
		}

		return false;
	}

	/**
	 * Ge tMenuActiveItems
	 *
	 * @param int   $active_id menu items;
	 * @param       $path
	 * @param array $list      menu items;
	 *
	 * @return array
	 *
	 * @since   4.9.3
	 */
	public static function getMenuActiveItems($active_id, $path, $list)
	{
		// Change array keys
		$items = array();
		foreach ($list as $item)
		{
			$items[$item->id] = $item;
		}

		//get Actives
		$actives = array();
		foreach ($items as $id => $item)
		{
			$active = false;
			if ($item->id == $active_id || ($item->type === 'alias' && $item->params->get('aliasoptions') == $active_id))
			{
				$active = true;
			}
			if (in_array($item->id, $path))
			{
				$active = true;
			}
			elseif ($item->type === 'alias')
			{
				$aliasToId = $item->params->get('aliasoptions');

				if (count($path) > 0 && $aliasToId == $path[count($path) - 1])
				{
					$active = true;
				}
				elseif (in_array($aliasToId, $path))
				{
					$active = true;
				}
			}

			if ($active)
			{
				$actives[] = $item->id;
				$parent_id = $item->parent_id;
				while (isset($items[$parent_id]))
				{
					$actives[] = $parent_id;
					$parent_id = $items[$parent_id]->parent_id;
				}

				$actives = array_unique($actives);
			}
		}

		return $actives;
	}


	/**
	 * Get footer object
	 *
	 * @param $template Template data
	 *
	 * @return mixed object|bool
	 *
	 * @since   4.9.4
	 */

	public function getFooter($template)
	{
		$params = $template->params->get('footer', '');

		if ($template->countModules('footer-top') || $template->countModules('footer-bottom') && !empty($params))
		{
			$footer = new stdClass();
			$params = new Registry($params);

			// Top block
			$footer->top = false;
			if ($template->countModules('footer-top'))
			{
				$footer->top          = new stdClass();
				$footer->top->title   = ($params->get('top-showtitle', 0)
					&& !empty($params->get('top-title', ''))) ? Text::_($params->get('top-title')) : false;
				$footer->top->modules = '<jdoc:include type="modules" name="footer-top" style="footer"/>';
			}

			// Bottom  block
			$footer->bottom = false;
			if ($template->countModules('footer-bottom'))
			{
				$footer->bottom          = new stdClass();
				$footer->bottom->title   = ($params->get('bottom-showtitle', 0)
					&& !empty($params->get('bottom-title', ''))) ? Text::_($params->get('bottom-title')) : false;
				$footer->bottom->modules = '<jdoc:include type="modules" name="footer-bottom" style="footer"/>';
			}

			return $footer;
		}

		return false;
	}


	/**
	 * Get footer object
	 *
	 * @param $template Template data
	 *
	 * @return object
	 *
	 * @since   4.9.4
	 */

	public function getHeader($template)
	{
		$header = new stdClass();
		$params = $template->params->get('header', '');
		$params = new Registry($params);


		//Logo
		$header->logo = false;
		if ($params->get('logo-src', 0))
		{
			$header->logo         = new stdClass();
			$header->logo->src    = $params->get('logo-src', 'templates/nerudas/images/logo.svg');
			$header->logo->alt    = ($params->get('logo-alt', 0)) ? Text::_($params->get('logo-alt'))
				: Factory::getConfig()->get('sitename');
			$header->logo->type   = JFile::getExt($header->logo->src);
			$header->logo->height = $params->get('logo-height', 0);
			$header->logo->class  = $params->get('logo-class', '');

			// Attributes
			$attributes = '';
			if (!empty($header->logo->height))
			{
				$attributes = ' height="' . $header->logo->height . '"';
			}
			if (!empty($header->logo->class))
			{
				$attributes = ' class="' . $header->logo->class . '"';
			}

			// Element
			$header->logo->element = ($header->logo->type == 'svg') ? JFile::read($header->logo->src) :
				HTMLHelper::_('image', $header->logo->src, $header->logo->alt, array('title' => $header->logo->alt));

		}

		// Panel
		$header->panel = new stdClass();

		// Center
		$header->panel->center = false;
		$header->panel->mobile = false;
		if ($template->countModules('toppanel-center'))
		{
			$header->panel->center = '';
			$header->panel->mobile = '';
			foreach (ModuleHelper::getModules('toppanel-center') as $module)
			{
				$content = $module->content;

				$header->panel->center .= ModuleHelper::renderModule($module, array('style' => 'toppanel_center'));

				$module->content       = $content;
				$header->panel->mobile .= ModuleHelper::renderModule($module, array('style' => 'toppanel_mobile'));

			}
		}

		// Right
		$header->panel->right = ($template->countModules('toppanel-right')) ?
			'<jdoc:include type="modules" name="toppanel-right" style="toppanel_right"/>' : false;

		return $header;
	}
}