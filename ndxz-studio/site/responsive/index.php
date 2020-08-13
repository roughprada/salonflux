<!doctype html>

<html xmlns='http://www.w3.org/1999/xhtml' xml:lang='en' lang='en'>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
<!-- Set the viewport width to device width for mobile -->
<meta name="viewport" content="width=device-width" />

<title><%title%> : <%obj_name%></title>

<plug:front_lib_css />
<plug:front_dyn_css />
<link rel='stylesheet' href='<%baseurl%><%basename%>/site/<%obj_theme%>/stylesheets/app.css' type='text/css' />
<link rel='stylesheet' href='<%baseurl%><%basename%>/site/<%obj_theme%>/stylesheets/foundation.css' type='text/css' />



<link rel='stylesheet' href='<%baseurl%><%basename%>/site/<%obj_theme%>/style.css' type='text/css' />
<!--[if lte IE 6]>
	<link rel='stylesheet' href='<%baseurl%><%basename%>/site/<%obj_theme%>/ie.css' type='text/css' />
<![endif]-->

<!--[if lt IE 9]>
	<link rel='stylesheet' href='<%baseurl%><%basename%>/site/<%obj_theme%>/stylesheets/ie.css' type='text/css' />
<![endif]-->


<!-- IE Fix for HTML5 Tags -->
<!--[if lt IE 9]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<script type='text/javascript' src='<%baseurl%><%basename%>/site/<%obj_theme%>/javascripts/app.js'></script>
<script type='text/javascript' src='<%baseurl%><%basename%>/site/<%obj_theme%>/javascripts/foundation.js'></script>
<script type='text/javascript' src='<%baseurl%><%basename%>/site/<%obj_theme%>/javascripts/jquery.min.js'></script>

<!--<script type='text/javascript' src='<%baseurl%><%basename%>/site/js/jquery.js'></script>-->
<script type='text/javascript' src='<%baseurl%><%basename%>/site/js/cookie.js'></script>

<plug:front_lib_js />
<script type='text/javascript'>
path = '<%baseurl%>/files/gimgs/';

$(document).ready(function()
{
	setTimeout('move_up()', 1);
});
</script>
<plug:front_dyn_js />
<plug:backgrounder color='<%color%>', img='<%bgimg%>', tile='<%tiling%>' />
</head>

<body class='section-<%section_id%>'>
	
<div class='container'>
	<div class='row'>
	
		<div id='menu' class='three columns'>
			<div class='idxz_container'>
				<div class= 'logo'>
				<p><a href="http://www.salonflux.com/"><img src="http://www.salonflux.com/ndxz-studio/site/theme_01/images/salonflux_weblogo.jpg" border="0"></a></p>
				</div>
				<div class="top-section">
					<%obj_itop%>
				</div>
				<div class="hide-on-phones">
					<plug:front_index />
				</div>

				<!-- you must provide a link to Indexhibit on your site someplace - thank you -->
				<ul class="built hide-on-phones">
					<li>Built with <a href='http://www.indexhibit.org/'>Indexhibit</a></li>
				</ul>

				<ul class="bottom-section hide-on-phones">
					<%obj_ibot%>
				</ul>
			</div>	
		</div>

		<div id='content' class='nine columns'>
			<div class='idxz_container'>

				<!-- text and image -->
				<plug:front_exhibit />
				
				<!-- end text and image -->
		
			</div>
		</div>

<!-- 		<div class="show-on-phones">
			<div class="mobile_buttons"><plug:front_index /></div>
			<p>Built with <a href='http://www.indexhibit.org/'>Indexhibit</a></p>
			<%obj_ibot%>
		</div> -->

	</div>
</div>


</body>
</html>