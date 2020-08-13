<?php if (!defined('SITE')) exit('No direct script access allowed');

/**
* Responsive v0.2
* JP Kelly
*
* Bsaed on Djuve
*
* Exhibition format
* 
* @Djuve version 0.2 - thumbs below image, prev/next arrows
* @author Kjetil Djuve (http://www.kjetildjuve.com/)
* @based on/mix of: Vaska's Iwakami/Backgrounded/Deux Column Exhibition formats (http://indexhibit.org/)
*/


// defaults from the general libary - be sure these are installed
$exhibit['dyn_css'] = dynamicCSS();
$exhibit['dyn_js'] = dynamicJS();
$exhibit['exhibit'] = createExhibit();

global $thmnum;


function createExhibit()
{
	$OBJ =& get_instance();
	global $rs;
	global $total;
	
	$pages = $OBJ->db->fetchArray("SELECT * 
		FROM ".PX."media, ".PX."objects_prefs 
		WHERE media_ref_id = '$rs[id]' 
		AND obj_ref_type = 'exhibit' 
		AND obj_ref_type = media_obj_type 
		ORDER BY media_order ASC, media_id ASC");

		
	

	
	
	$i = 1; $a = ''; $b = '';
	
if ($pages) {
	$total = count($pages);
	
	// people will probably want to customize this up
	foreach ($pages as $go)
	{
	    $title 		= ($go['media_title'] == '') ? '' : $go['media_title'];
	    $titlealt 	= ($go['media_title'] == '') ? '' : $go['media_title'] . '&nbsp;';
		
	    $caption 	= ($go['media_caption'] == '') ? '&nbsp;' : ' - ' . $go['media_caption'];
		$captionalt = ($go['media_caption'] == '') ? '&nbsp;' : $go['media_caption'];
		
		$png		= ($go['media_mime'] == 'png') ? " class='png'" : '';
		
		$a .= "\n<a href='#' style='background: transparent;' onclick=\"show_image($i);return false;\"><img src='" . BASEURL . GIMGS . "/sys-$go[media_file]' alt='$captionalt' title='$titlealt' id='img$i'$png /></a>\n";

		$x = getimagesize(DIRNAME . GIMGS . '/' . $go['media_file']);
		
		$off = ($i == 1) ? "style='display: block;'" :  "style='display: none;'";
		
		$next = ($i == $total) ? 1 : $i+1;
		$prev = ($i == 1) ? $total : $i-1;
	
		$b .= "\n<div id='p$i' class='pic' $off>";
		$b .= "	<a href='#' onclick='show_image($next); return false;'><img src='" . BASEURL . GIMGS . "/$go[media_file]' width='" . $x[0] . "' height='" . $x[1] . "' class='img-bot' alt='image'/></a><p><a href='#' onclick='show_image($prev); return false;'>&nbsp;&lt;&nbsp;</a> <span id='num$i'>$i/$total</span> <a href='#' onclick='show_image($next); return false;'>&nbsp;&gt;&nbsp;</a></p><p><em>{$title}</em>{$caption}</p></div>\n";
		
		$i++;
	}
}
	
	
	// content area
		$s .= "<div class='row'>\n";
	

	// Container for text column
	
		if (!$pages) {
		$s .= "<div id='idxz_text' class='eight columns'>\n";
		$s .= $rs['content'];
		$s .= "</div>\n";
		} else {
		$s .= "<div id='idxz_text' class='four columns'>\n";
		$s .= $rs['content'];
		$s .= "</div>\n";
	
	// container for image column
		$s .= "<div id='image_area' class='eight columns'>\n";
	
		// thumbs
		$s .= "<div id='thumb-container'>\n";
		$s .= "<div id='d-thumbs'>\n";
		$s .= $a;
		$s .= "</div>\n";	
		$s .= "</div>\n\n";
	
	
	
		// image + navigation and caption
		$s .= "<div id='img-container'>\n";
		$s .= "<div id='d-image'>\n";
		$s .= $b;
		$s .= "</div>\n";
		$s .= "</div>\n";
	
		$s .= "</div>\n";
		}
	
		$s .= "</div>\n";
	
	
	

	return $s;
}

function dynamicJS()
{	
	$thmnum = 20;
	
	return "function show_image(id)
	{
		var thmnum = $thmnum;
		for (thm=0;thm<=thmnum;thm++)
		{
			$('#img' + thm).css({ border: '1px solid #fff'});
		};
		$('.pic').hide();
		$('#p' + id).fadeIn();
		$('#num').html(id);
		$('#img' + id).css({ border: '1px solid #777'});
		return false;
	}";
}


function dynamicCSS()
{
	return "#d-thumbs { }
	#d-thumbs img { padding: 2px; border: 1px solid #fff; height: 75px; width: 75px; }
	#d-image { }
	#d-image img { border: none; cursor: pointer; }";
}

?>