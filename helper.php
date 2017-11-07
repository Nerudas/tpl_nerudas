<?php
/**
 * @package    Nerudas Template
 * @version    5.0.0
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2017 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;

use Joomla\Registry\Registry;
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
		$minified = ($params->get('minified', 0)) ? '.min' : '';

		// Add Fonts
		HTMLHelper::_('stylesheet', 'fonts' . $minified . '.css', array('version' => 'auto', 'relative' => true));
		
		// Add jQuery
		$this->addjQuery($minified);

		// Add UIkit
		$this->addUIkit($minified);

		// Add Template
		$this->addTemplate($minified);

		// Set meta viewport
		$doc->setMetaData('viewport', 'width=device-width, initial-scale=1, minimum-scale=1');
	}

	/**
	 * Add jQuery to head
	 *
	 * @param string $minified .min minified
	 *
	 * @since   1.0.0
	 */
	protected function addjQuery($minified)
	{
		HTMLHelper::_('jquery.framework');
		$doc  = Factory::getDocument();
		$head = $doc->getHeadData();

		// Prepare params
		$scripts = $head['scripts'];
		$params  = $scripts['/media/jui/js/jquery.min.js'];
		$path    = '/templates/' . Factory::getApplication()->getTemplate() . '/js/jquery' . $minified . '.js';

		// Uset joomla jquery
		unset(
			$scripts['/media/jui/js/jquery.min.js'],
			$scripts['/media/jui/js/jquery-noconflict.js'],
			$scripts['/media/jui/js/jquery-migrate.min.js']
		);

		$head ['scripts'] = array($path => $params) + $scripts;

		$doc->setHeadData($head);
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
		HTMLHelper::_('script', 'uikit' . $minified . '.js', array('version' => 'auto', 'relative' => true));
		HTMLHelper::_('script', 'uikit-icons' . $minified . '.js', array('version' => 'auto', 'relative' => true));
		HTMLHelper::_('script', 'uikit-fa-icons' . $minified . '.js', array('version' => 'auto', 'relative' => true));
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
		HTMLHelper::_('script', 'template-icons' . $minified . '.js', array('version' => 'auto', 'relative' => true));
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
			if ($subDomain == 'alpha' || $subDomain == 'beta')
			{
				$doc = Factory::getDocument();
				$doc->setMetaData('robots', 'noindex, nofollow');
				$doc->addHeadLink(str_replace($subDomain . '.', '', JUri::getInstance()->toString())
					, 'canonical');
				$doc->setTitle('[' . strtoupper($subDomain) . '] ' . $doc->getTitle());

				$params->set('minified', 0);

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

		$head['scripts'] = $scripts;
		$doc->setHeadData($head);
	}

	/**
	 * Check if beta version of site
	 *
	 * @param $params JObject $params Template params
	 *
	 * @return stdClass header data
	 *
	 * @since   1.0.0
	 */
	public function prepareHeader($params)
	{

		$logo = $params->get('logo', '');
		if ($logo)
		{
			$logo = new Registry($logo);

		}

		$header       = new stdClass();
		$header->logo = false;
		if ($logo)
		{
			$header->logo         = new stdClass();
			$header->logo->src    = $logo->get('src', 'templates/nerudas/images/logo.svg');
			$header->logo->alt    = $logo->get('alt', Factory::getConfig()->get('sitename'));
			$header->logo->type   = JFile::getExt($header->logo->src);
			$header->logo->height = $logo->get('height', 0);
			$header->logo->class  = $logo->get('class', '');

			// Attributes
			$header->logo->attributes = '';
			if (!empty($header->logo->height))
			{
				$header->logo->attributes = ' height="' . $header->logo->height . '"';
			}
			if (!empty($header->logo->class))
			{
				$header->logo->attributes = ' class="' . $header->logo->class . '"';
			}
			if ($header->logo->type == 'svg')
			{
				$header->logo->attributes .= ' data-uk-svg';
			}

			// Element
			$header->logo->element = '<img src="/' . $header->logo->src . '" alt="' . $header->logo->alt . '"' . $header->logo->attributes . '>';
			if ($header->logo->type == 'svg')
			{
				$header->logo->element = JFile::read($header->logo->src);
			}

		}

		return $header;
	}
}