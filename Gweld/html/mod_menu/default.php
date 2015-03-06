<?php
/**
 * @version		$Id: default.php 20196 2011-01-09 02:40:25Z ian $
 * @package		Joomla.Site
 * @subpackage	mod_menu
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;

// Note. It is important to remove spaces between elements.

//Submenu Feature

$showAllChildren 	= $params->get('showAllChildren', 0);
$positionSlideName	= 'phocaTopMenu';
//$positionSlideId	= 'position-1';

$slide = false;
/*
if (isset($attribs['style']) && $attribs['style'] == $positionSlideName) {
//if (isset($attribs['name']) && $attribs['name'] == $positionSlideId) {
	$slide = true;
}*/

	$tag = '';
	if(isset($attribs['style']) && $attribs['style'] == $positionSlideName) {
		$tag = '';
		echo '<ul class="menu'.$class_sfx.' nav navbar-nav"';
		//echo '<ul class="nav navbar-nav"';
	} else {
		echo '<ul class="menu'.$class_sfx.'"';
		//echo '<ul class=""';
	}
	
	if ($params->get('tag_id')!=NULL) {
		$tag = $params->get('tag_id').'';
	}
	if ($tag != '') {
		echo ' id="'.$tag.'"';
	}
echo '>';

	
foreach ($list as $i => &$item) :
	
	
	// PHOCAEDIT
	$class = '';
	if ($positionSlideName == 'phocaTopMenu') {
		$level = 0;
		if ($item->level > 0) {
			$level = $item->level - 1;
		}
		
		$class .= 'level'.$level.' ';
		
		if ($level == 0) {
			$class .= 'dropdown ';
		}
		
		// Submenu
		if ($level == 1) {
			//$class .= 'ptm-float ';
		}
		
	}
	// END PHOCAEDIT
	
	if ($item->id == $active_id) {
		$class .= 'current ';
	}

	if (in_array($item->id, $path)) {
		$class .= 'active ';
	}

	if ($item->deeper) {
		$class .= 'parent ';
	}

	if (!empty($class)) {
		$class = ' class="'.trim($class) .'"';
	}
	echo '<li id="item-'.$item->id.'"'.$class. ' >';
	
	
	// Render the menu item.
	switch ($item->type) :
		case 'separator':
		case 'url':
		case 'component':
			require JModuleHelper::getLayoutPath('mod_menu', 'default_'.$item->type);
			break;

		default:
			require JModuleHelper::getLayoutPath('mod_menu', 'default_url');
			break;
	endswitch;

	// The next item is deeper.
	if ($item->deeper) {
	
		//PHOCAEDIT
		$classUl = $styleUl = '';
		if ($positionSlideName == 'phocaTopMenu') {
			$classUl .= 'level'.$item->level.' ';

			if ($item->level == 1) {
				$classUl  .= 'dropdown-menu ';
				
				//HARDCODED CSS SUBMENU WIDTHS 
				switch ($item->id) {
					case 10:
						$classUl  .= ' ';
						$classUl  .= ' ';
					break;
					case 11:
					case 12:
						$classUl  .= ' ';
						$classUl  .= ' ';
					break;
					default:
						$classUl  .= ' ';
					break;
				}
			
				//$classUl  .= 'unstyled ';
			}
			if ($item->level > 0) {
				$classUl  .= 'child ';
			}
			if (!empty($classUl)) {
				$classUl = ' class="'.trim($classUl).'"';
			}
		}
		// END PHOCAEDIT
		echo '<ul '.$classUl. ' >';
	}
	// The next item is shallower.
	else if ($item->shallower) {
		echo '</li>';
		echo str_repeat('</ul></li>', $item->level_diff);
	}
	// The next item is on the same level.
	else {
		echo '</li>';
	}
endforeach;
?>
</ul>