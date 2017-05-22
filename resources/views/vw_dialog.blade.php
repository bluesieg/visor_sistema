<!DOCTYPE html>
<html lang="en-us">
	<head>
		<meta charset="utf-8">
		<!--<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">-->

		<title> SmartAdmin </title>
		<meta name="description" content="">
		<meta name="author" content="">
			
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

		<!-- Basic Styles -->
		<link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" media="screen" href="css/font-awesome.min.css">

		<!-- SmartAdmin Styles : Caution! DO NOT change the order -->
		<link rel="stylesheet" type="text/css" media="screen" href="css/smartadmin-production-plugins.min.css">
		<link rel="stylesheet" type="text/css" media="screen" href="css/smartadmin-production.min.css">
		<link rel="stylesheet" type="text/css" media="screen" href="css/smartadmin-skins.min.css">

		<!-- SmartAdmin RTL Support -->
		<link rel="stylesheet" type="text/css" media="screen" href="css/smartadmin-rtl.min.css"> 

		<!-- We recommend you use "your_style.css" to override SmartAdmin
		     specific styles this will also ensure you retrain your customization with each SmartAdmin update.
		<link rel="stylesheet" type="text/css" media="screen" href="css/your_style.css"> -->

		<!-- Demo purpose only: goes with demo.js, you can delete this css when designing your own WebApp -->
		<link rel="stylesheet" type="text/css" media="screen" href="css/demo.min.css">

		<!-- FAVICONS -->
		<link rel="shortcut icon" href="img/favicon/favicon.ico" type="image/x-icon">
		<link rel="icon" href="img/favicon/favicon.ico" type="image/x-icon">

		<!-- GOOGLE FONT -->
		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">

		<!-- Specifying a Webpage Icon for Web Clip 
			 Ref: https://developer.apple.com/library/ios/documentation/AppleApplications/Reference/SafariWebContent/ConfiguringWebApplications/ConfiguringWebApplications.html -->
		<link rel="apple-touch-icon" href="img/splash/sptouch-icon-iphone.png">
		<link rel="apple-touch-icon" sizes="76x76" href="img/splash/touch-icon-ipad.png">
		<link rel="apple-touch-icon" sizes="120x120" href="img/splash/touch-icon-iphone-retina.png">
		<link rel="apple-touch-icon" sizes="152x152" href="img/splash/touch-icon-ipad-retina.png">
		
		<!-- iOS web-app metas : hides Safari UI Components and Changes Status Bar Appearance -->
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		
		<!-- Startup image for web apps -->
		<link rel="apple-touch-startup-image" href="img/splash/ipad-landscape.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape)">
		<link rel="apple-touch-startup-image" href="img/splash/ipad-portrait.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait)">
		<link rel="apple-touch-startup-image" href="img/splash/iphone.png" media="screen and (max-device-width: 320px)">

	</head>
	
	<!--

	TABLE OF CONTENTS.
	
	Use search to find needed section.
	
	===================================================================
	
	|  01. #CSS Links                |  all CSS links and file paths  |
	|  02. #FAVICONS                 |  Favicon links and file paths  |
	|  03. #GOOGLE FONT              |  Google font link              |
	|  04. #APP SCREEN / ICONS       |  app icons, screen backdrops   |
	|  05. #BODY                     |  body tag                      |
	|  06. #HEADER                   |  header tag                    |
	|  07. #PROJECTS                 |  project lists                 |
	|  08. #TOGGLE LAYOUT BUTTONS    |  layout buttons and actions    |
	|  09. #MOBILE                   |  mobile view dropdown          |
	|  10. #SEARCH                   |  search field                  |
	|  11. #NAVIGATION               |  left panel & navigation       |
	|  12. #RIGHT PANEL              |  right panel userlist          |
	|  13. #MAIN PANEL               |  main panel                    |
	|  14. #MAIN CONTENT             |  content holder                |
	|  15. #PAGE FOOTER              |  page footer                   |
	|  16. #SHORTCUT AREA            |  dropdown shortcuts area       |
	|  17. #PLUGINS                  |  all scripts and plugins       |
	
	===================================================================
	
	-->
	
	<!-- #BODY -->
	<!-- Possible Classes

		* 'smart-style-{SKIN#}'
		* 'smart-rtl'         - Switch theme mode to RTL
		* 'menu-on-top'       - Switch to top navigation (no DOM change required)
		* 'no-menu'			  - Hides the menu completely
		* 'hidden-menu'       - Hides the main menu but still accessable by hovering over left edge
		* 'fixed-header'      - Fixes the header
		* 'fixed-navigation'  - Fixes the main menu
		* 'fixed-ribbon'      - Fixes breadcrumb
		* 'fixed-page-footer' - Fixes footer
		* 'container'         - boxed layout mode (non-responsive: will not work with fixed-navigation & fixed-ribbon)
	-->
	<body class="">


		<!-- Left panel : Navigation area -->
		<!-- Note: This width of the aside area can be adjusted through LESS variables -->
		<!-- END NAVIGATION -->

		<!-- MAIN PANEL -->
		<div id="main" role="main">

	

			<!-- MAIN CONTENT -->
			<div id="content">

<!-- row -->
<div class="row">

	<div class="col-sm-6 col-md-6 col-lg-6">

		<div class="well well-sm well-light">
			<h3>Dialogue</h3>
			<a href="#" id="dialog_link" class="btn btn-info"> Open Dialog </a>
			&nbsp;
			<a href="#" id="modal_link" class="btn bg-color-purple txt-color-white"> Open Modal Dialog </a>
		</div>


	</div>

</div>

<!-- end row -->

<!-- ui-dialog -->
<div id="dialog_simple" title="Dialog Simple Title">
	<p>
		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
	</p>
</div>

<div id="dialog-message" title="Dialog Simple Title">
	<p>
		This is the default dialog which is useful for displaying information. The dialog window can be moved, resized and closed with the 'x' icon.
	</p>

	<div class="hr hr-12 hr-double"></div>

	
		Currently using
		<b>36% of your storage space</b>
		<div class="progress progress-striped active no-margin">
			<div class="progress-bar progress-primary" role="progressbar" style="width: 36%"></div>
		</div>
	
</div><!-- #dialog-message -->

			</div>
			<!-- END MAIN CONTENT -->

		</div>
		<!-- END MAIN PANEL -->


		<!-- SHORTCUT AREA : With large tiles (activated via clicking user name tag)
	

		<!--================================================== -->

		<!-- PACE LOADER - turn this on if you want ajax loading to show (caution: uses lots of memory on iDevices)-->
		<script data-pace-options='{ "restartOnRequestAfter": true }' src="js/plugin/pace/pace.min.js"></script>

		<!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<script>
			if (!window.jQuery) {
				document.write('<script src="js/libs/jquery-2.1.1.min.js"><\/script>');
			}
		</script>

		<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
		<script>
			if (!window.jQuery.ui) {
				document.write('<script src="js/libs/jquery-ui-1.10.3.min.js"><\/script>');
			}
		</script>
                
                  <script src="{{ asset('js/app.config.seed.js') }}"></script>
    
    <script src="{{ asset('js/bootstrap/bootstrap.min.js') }}"></script>
    
    <script src="{{ asset('js/app.seed.js') }}"></script>   
    
    

		<!-- IMPORTANT: APP CONFIG -->
<!--                
		<script src="{{ asset('js/app.config.js')}}"></script>

		 JS TOUCH : include this plugin for mobile drag / drop touch events
		<script src="{{ asset('js/plugin/jquery-touch/jquery.ui.touch-punch.min.js')}}"></script> 

		 BOOTSTRAP JS 
		<script src="{{ asset('js/bootstrap/bootstrap.min.js')}}"></script>

		 CUSTOM NOTIFICATION 
		<script src="{{ asset('js/notification/SmartNotification.min.js')}}"></script>

		 JARVIS WIDGETS 
		<script src="{{ asset('js/smartwidgets/jarvis.widget.min.js')}}"></script>

		 EASY PIE CHARTS 
		<script src="{{ asset('js/plugin/easy-pie-chart/jquery.easy-pie-chart.min.js')}}"></script>

		 SPARKLINES 
		<script src="{{ asset('js/plugin/sparkline/jquery.sparkline.min.js')}}"></script>

		 JQUERY VALIDATE 
		<script src="{{ asset('js/plugin/jquery-validate/jquery.validate.min.js')}}"></script>

		 JQUERY MASKED INPUT 
		<script src="{{ asset('js/plugin/masked-input/jquery.maskedinput.min.js')}}"></script>

		 JQUERY SELECT2 INPUT 
		<script src="{{ asset('js/plugin/select2/select2.min.js')}}"></script>

		 JQUERY UI + Bootstrap Slider 
		<script src="{{ asset('js/plugin/bootstrap-slider/bootstrap-slider.min.js')}}"></script>

		 browser msie issue fix 
		<script src="{{ asset('js/plugin/msie-fix/jquery.mb.browser.min.js')}}"></script>

		 FastClick: For mobile devices 
		<script src="{{ asset('js/plugin/fastclick/fastclick.min.js')}}"></script>

		[if IE 8]>

		<h1>Your browser is out of date, please update your browser by going to www.microsoft.com/download</h1>

		<![endif]

		 Demo purpose only 
		<script src="{{ asset('js/demo.min.js')}}"></script>

		 MAIN APP JS FILE 
		<script src="{{ asset('js/app.min.js')}}"></script>

		 ENHANCEMENT PLUGINS : NOT A REQUIREMENT 
		 Voice command : plugin 
		<script src="{{ asset('js/speech/voicecommand.min.js')}}"></script>

		 SmartChat UI : plugin 
		<script src="{{ asset('js/smart-chat-ui/smart.chat.ui.min.js')}}"></script>
		<script src="{{ asset('js/smart-chat-ui/smart.chat.manager.min.js')}}"></script>-->

		<!-- PAGE RELATED PLUGIN(S) 
		<script src="..."></script>-->

		

		<script type="text/javascript">
		
		// DO NOT REMOVE : GLOBAL FUNCTIONS!
		
		$(document).ready(function() {
			
		
			/*
			 * CONVERT DIALOG TITLE TO HTML
			 * REF: http://stackoverflow.com/questions/14488774/using-html-in-a-dialogs-title-in-jquery-ui-1-10
			 */
			$.widget("ui.dialog", $.extend({}, $.ui.dialog.prototype, {
				_title : function(title) {
					if (!this.options.title) {
						title.html("&#160;");
					} else {
						title.html(this.options.title);
					}
				}
			}));
		
		
			/*
			* DIALOG SIMPLE
			*/
		
			// Dialog click
			$('#dialog_link').click(function() {
				$('#dialog_simple').dialog('open');
				return false;
		
			});
		
			$('#dialog_simple').dialog({
				autoOpen : false,
				width : 600,
				resizable : false,
				modal : true,
				title : "<div class='widget-header'><h4><i class='fa fa-warning'></i> Empty the recycle bin?</h4></div>",
				buttons : [{
					html : "<i class='fa fa-trash-o'></i>&nbsp; Delete all items",
					"class" : "btn btn-danger",
					click : function() {
						$(this).dialog("close");
					}
				}, {
					html : "<i class='fa fa-times'></i>&nbsp; Cancel",
					"class" : "btn btn-default",
					click : function() {
						$(this).dialog("close");
					}
				}]
			});
		
			/*
			* DIALOG HEADER ICON
			*/
		
			// Modal Link
			$('#modal_link').click(function() {
				$('#dialog-message').dialog('open');
				return false;
			});
		
			$("#dialog-message").dialog({
				autoOpen : false,
				modal : true,
				title : "<div class='widget-header'><h4><i class='icon-ok'></i> jQuery UI Dialog</h4></div>",
				buttons : [{
					html : "Cancel",
					"class" : "btn btn-default",
					click : function() {
						$(this).dialog("close");
					}
				}, {
					html : "<i class='fa fa-check'></i>&nbsp; OK",
					"class" : "btn btn-primary",
					click : function() {
						$(this).dialog("close");
					}
				}]
		
			});			

		})

		</script>

		<!-- Your GOOGLE ANALYTICS CODE Below -->
		<script type="text/javascript">
			var _gaq = _gaq || [];
				_gaq.push(['_setAccount', 'UA-XXXXXXXX-X']);
				_gaq.push(['_trackPageview']);
			
			(function() {
				var ga = document.createElement('script');
				ga.type = 'text/javascript';
				ga.async = true;
				ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
				var s = document.getElementsByTagName('script')[0];
				s.parentNode.insertBefore(ga, s);
			})();

		</script>

	</body>

</html>