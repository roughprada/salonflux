<?php if (!defined('SITE')) exit('No direct script access allowed');

/**
* Djuve
*
* Exhibition format
* 
* @version 0.1 (experimental copy&paste)
* @author Kjetil Djuve (http://www.kjetildjuve.com/)
* @based on/mix of: Vaska's Iwakami/Backgrounded/Deux Column Exhibition formats (http://indexhibit.org/)
*/


// defaults from the general libary - be sure these are installed
$exhibit['dyn_css'] = dynamicCSS();
$exhibit['dyn_js'] = dynamicJS();
$exhibit['exhibit'] = createExhibit();

function dynamicJS()
{
	return "function show_image(id)
	{
		$('.pic').hide();
		$('#p' + id).fadeIn();
		return false;
	}";
}

function createExhibit()
{
	$OBJ =& get_instance();
	global $rs;
	
	$pages = $OBJ->db->fetchArray("SELECT * 
		FROM ".PX."media, ".PX."objects_prefs 
		WHERE media_ref_id = '$rs[id]' 
		AND obj_ref_type = 'exhibit' 
		AND obj_ref_type = media_obj_type 
		ORDER BY media_order ASC, media_id ASC");

		
	// content text
	$s = $rs['content'];

	if (!$pages) return $s;
	
	$i = 1; $a = ''; $b = '';
	
	$total = count($pages);
	
	// people will probably want to customize this up
	foreach ($pages as $go)
	{
	    $title 		= ($go['media_title'] == '') ? '' : $go['media_title'] . '&nbsp;';
	    $caption 	= ($go['media_caption'] == '') ? '&nbsp;' : $go['media_caption'];
		
		$png		= ($go['media_mime'] == 'png') ? " class='png'" : '';
		
		$a .= "\n<a href='#' onclick=\"show_image($i);return false;\"><img src='" . BASEURL . GIMGS . "/sys-$go[media_file]' alt='$caption' title='$title' id='img$i'$png /></a>\n";

		$x = getimagesize(DIRNAME . GIMGS . '/' . $go['media_file']);
		
		$off = ($i == 1) ? "style='display: block;'" :  "style='display: none;'";
		
		$next = ($i == $total) ? 1 : $i+1; 
		
		$b .= "\n<div id='p$i' class='pic' $off><a href='#' onclick=\"show_image($next); return false;\"><img src='" . BASEURL . GIMGS . "/$go[media_file]' width='" . $x[0] . "' height='" . $x[1] . "' class='img-bot' /></a><p><em>{$title}</em><br />{$caption}</p></div>\n";
		
		$i++;
	}
	
	// thumbs
	$s .= "<div id='img-container'>\n";
	$s .= "<div id='d-thumbs'>\n";
	$s .= $a;
	$s .= "</div>\n";
	
	// image
	$s .= "<div id='d-image'>\n";
	$s .= $b;
	$s .= "</div>\n";
	$s .= "</div>\n\n";
				
	return $s;
}


function dynamicCSS()
{
	return "#d-thumbs { }
	#d-thumbs img { padding-bottom: 5px; border: none; height: 40px; width: 40px; }
	#d-image { }
	#d-image img { border: none; }";
}


?>
