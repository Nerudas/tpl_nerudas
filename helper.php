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

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;

class tplNerudasHelper
{
	/**
	 * Set tempalte head
	 *
	 * @param $params JObject $params Template params
	 *
	 * @since   1.0.0
	 */
	public function setHead($params)
	{
		$doc = Factory::getDocument();

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

		// Add icheck
		HTMLHelper::_('script', 'icheck' . $minified . '.js', array('version' => 'auto', 'relative' => true));

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
	 * @since   1.0.0
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
	 * @since   1.0.0
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

		HTMLHelper::_('script', 'uikit' . $minified . '.js', array('version' => 'auto', 'relative' => true));
		HTMLHelper::_('script', 'uikit/accordion' . $minified . '.js', array('version' => 'auto', 'relative' => true));
		HTMLHelper::_('script', 'uikit/form-password' . $minified . '.js', array('version' => 'auto', 'relative' => true));
		HTMLHelper::_('script', 'uikit/grid' . $minified . '.js', array('version' => 'auto', 'relative' => true));
		HTMLHelper::_('script', 'uikit/lightbox' . $minified . '.js', array('version' => 'auto', 'relative' => true));
		HTMLHelper::_('script', 'uikit/notify' . $minified . '.js', array('version' => 'auto', 'relative' => true));
		HTMLHelper::_('script', 'uikit/pagination' . $minified . '.js', array('version' => 'auto', 'relative' => true));
		HTMLHelper::_('script', 'uikit/sticky' . $minified . '.js', array('version' => 'auto', 'relative' => true));
		HTMLHelper::_('script', 'uikit/tooltip' . $minified . '.js', array('version' => 'auto', 'relative' => true));


	}

	/**
	 * Add tempalte to head
	 *
	 * @param string $minified .min minified
	 *
	 * @since   1.0.0
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
	 * @since   1.0.0
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
	 * @since   1.0.0
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

}