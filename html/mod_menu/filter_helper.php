<?php
/**
 * @package     Nerudas Template
 * @version     5.0
 * @author      Nerudas - nerudas.ru
 * @copyright   Copyright (c) 2013 - 2017 Nerudas. All rights reserved.
 * @license     GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */
class modMenuFilterHelper {
	public static function getCurrentItem($active = '', $array) {
		$result = false;
		foreach ($array as $i => $item) {
			if (($item->id == $active->id) || ($item->type == 'alias' && $item->params->get('aliasoptions') == $active->id)) {
				$result = $item;
				break;
			}
		}
		return $result;
	}
	public static function getItems($current, $array) {
		$result = array();
		foreach ($array as $i => $item) {
			$item->childs = false;
			if ($item->id == $current->id) {
				$item->childs = self::getChildsItems($item, $array);
				if (count($item->childs) == 0) {
					$item->childs = false;
				}
			}
			if(in_array($item->id, $current->tree)) {
				$result[$item->id] = $item;
			}
		}
		return $result;
	}
	public static function getChildsItems($parent, $array) {
		$result = array();
		foreach ($array as $i => $item) {
			if ($item->parent_id == $parent->id) {
				$result[$item->id] = $item;
			}
		}
		return $result;
	}
	public static function getList($active, $default, $array, $path) {
		$result = array();
		foreach ($array as $key => $item) {
			$item->liClass = 'item-'.$item->id.' level-'.$item->level;
			$item->liData = '';
			if ($item->id == $default->id) {
				$item->liClass .= ' default';
			}
			if (($item->id == $active->id) || ($item->type == 'alias' && $item->params->get('aliasoptions') == $active->id)) {
				$item->liClass .= ' current';
			}
			if (in_array($item->id, $path))	{
				$item->liClass .= ' uk-active-parent';
			}
			elseif ($item->type == 'alias')	{
				if (count($path) > 0 && $item->params->get('aliasoptions') == $path[count($path) - 1]) {
					$item->liClass .= ' uk-active';
				}
				elseif (in_array($item->params->get('aliasoptions'), $path)) {
					$item->liClass .= ' uk-active-parent';
				}
			}
			if ($item->type == 'separator')	{
				$item->liClass .= ' uk-nav-divider';			
			}
			if ($item->type == 'heading') {
				$item->liClass .= ' uk-nav-header';			
			}
			if ($item->parent && $item->level == 1) {
				$item->liClass .= ' uk-parent';

			}
			if ($item->type == 'component') {
				$item->flink = htmlspecialchars($item->flink, ENT_COMPAT, 'UTF-8');
			}
			else {
				$item->flink = htmlspecialchars($item->flink);
			}
			// Icons
			$item->icon = '';
			$item->icon_regexp = '/uk-icon-([^"\'!\s]+)/';
			if ($item->anchor_css) {
				$item->icon_css = array();
				preg_match_all($item->icon_regexp, $item->anchor_css, $item->icon_css);		
				if ($item->icon_css[0] > 0) {
					$item->anchor_css = preg_replace($item->icon_regexp, '', $item->anchor_css);
					$item->icon_css = $item->icon_css[0];
					$item->icon_css = implode(' ', $item->icon_css);
					$item->icon_css = str_replace('uk-icon-margin','uk-margin', $item->icon_css);
					$item->icon = '<i class="'.$item->icon_css.'"></i>';
				}
			}
			$item->title = $item->icon.$item->title;
			$item->flink = JFilterOutput::ampReplace($item->flink);
			$result[$item->id] = $item;
		}
		return $result;
	}
	public static function getListHTML ($items) {
		$result = '';
		foreach ($items as $key => $item) {
			$result .= '<li class="'. $item->liClass.'"'.$item->liData.'>';
			switch ($item->type) :
			case 'separator':
			break;
			case 'heading':
				$result .= $item->title;
			break;
			default:
				$result .= self::getURLItem($item);
				break;
			endswitch;
			if ($item->childs) {
				$result .='<ul class="uk-nav-sub">';
				 foreach ($item->childs as $i => $item) {
					 $result .='<li class="'. $item->liClass.'"'.$item->liData.'>';
					 switch ($item->type) :
						case 'separator':
						break;
						case 'heading':
							$result .=$item->title;
						break;
						default:
							$result .= self::getURLItem($item);
						break;
					endswitch;
					$result .= '</li>';
				 }
				$result .= '</ul>';
			}
			$result .= '</li>';
		}
		return $result;
	}
	public static function getURLItem ($item) {
		$attributes = array();
		if ($item->anchor_title) {
			$attributes['title'] = $item->anchor_title;
		}
		if ($item->anchor_css) {
			$attributes['class'] = $item->anchor_css;
		}
		if ($item->anchor_rel) {
			$attributes['rel'] = $item->anchor_rel;
		}
		if ($item->browserNav == 1) {
			$attributes['target'] = '_blank';
		}
		elseif ($item->browserNav == 2) {
			$options = 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes';
			$attributes['onclick'] = "window.open(this.href, 'targetWindow', '" . $options . "'); return false;";
		}
		return JHtml::_('link',$item->flink, $item->title, $attributes);
	}
}