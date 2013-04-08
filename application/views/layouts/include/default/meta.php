<?php if (!isset($css)) {$css = array();}if (!isset($js)) {$js = array();}?>
<?php echo meta('description', 'CymbitCMS is a FREE hosted content management system that\'s actually easy to use, fast to setup and doesn\'t require programming skills.');?>
<?php echo meta('keywords', 'cms, content management system, hosted, web app, easy, free'); ?>
<?php echo link_tag('favicon.ico', 'shortcut icon', 'image/ico'); ?>
<title><?php echo $template['title']; ?> &raquo; CymbitCMS</title>
<?php echo meta('Content-type', 'text/html; charset=utf-8', 'equiv'); ?>
<meta name="HandheldFriendly" content="True">
<meta name="MobileOptimized" content="320">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<?php echo $template['metadata']; ?>
<?php switch ($assets){
    case 'app':
        ?>
        <!--// OPTIONAL & CONDITIONAL CSS FILES //-->   
	<!-- date picker css -->
	<link rel="stylesheet" href="css/app/datepicker.css?v=1">
	<!-- full calander css -->
	<link rel="stylesheet" href="css/app/fullcalendar.css?v=1">
	<!-- data tables extended CSS -->
	<link rel="stylesheet" href="css/app/TableTools.css?v=1">
	<!-- bootstrap wysimhtml5 editor -->
	<link rel="stylesheet" href="css/app/bootstrap-wysihtml5.css?v=1">
	<link rel="stylesheet" href="css/app/wysiwyg-color.css">
	<!-- custom/responsive growl messages -->
	<link rel="stylesheet" href="css/app/toastr.custom.css?v=1">
	<link rel="stylesheet" href="css/app/toastr-responsive.css?v=1">
	<link rel="stylesheet" href="css/app/jquery.jgrowl.css?v=1">
	
	<!-- // DO NOT REMOVE OR CHANGE ORDER OF THE FOLLOWING // -->
	<!-- bootstrap default css (DO NOT REMOVE) -->
	<link rel="stylesheet" href="css/app/bootstrap.min.css?v=1">
	<link rel="stylesheet" href="css/app/bootstrap-responsive.min.css?v=1">
	<!-- font awsome and custom icons -->
	<link rel="stylesheet" href="css/app/font-awesome.min.css?v=1">
	<link rel="stylesheet" href="css/app/cus-icons.css?v=1">
	<!-- jarvis widget css -->
	<link rel="stylesheet" href="css/app/jarvis-widgets.css?v=1">
	<!-- Data tables, normal tables and responsive tables css -->
	<link rel="stylesheet" href="css/app/DT_bootstrap.css?v=1">
	<link rel="stylesheet" href="css/app/responsive-tables.css?v=1">
	<!-- used where radio, select and form elements are used -->
	<link rel="stylesheet" href="css/app/uniform.default.css?v=1">
	<link rel="stylesheet" href="css/app/select2.css?v=1">
	<!-- main theme files -->
	<link rel="stylesheet" href="css/app/theme.css?v=1">
	<link rel="stylesheet" href="css/app/theme-responsive.css?v=1">
        
        <link rel="stylesheet" href="css/app/style.css?v=1">
	<!-- // THEME CSS changed by javascript: the CSS link below will override the rules above // -->
	<!-- For more information, please see the documentation for "THEMES" -->
    <link rel="stylesheet" id="switch-theme-js" href="css/app/themes/default.css?v=1">   
	
   	<!-- To switch to full width -->
    <link rel="stylesheet" id="switch-width" href="css/app/full-width.css?v=1">
    
	<!-- Webfonts -->
	<link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Lato:300,400,700' type='text/css'>
	
	<!-- All javascripts are located at the bottom except for HTML5 Shim -->
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
   		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
   		<script src="js/app/include/respond.min.js"></script>
   	<![endif]-->
	
	<!-- For Modern Browsers -->
	<link rel="shortcut icon" href="images/favicons/favicon.png">
	<!-- For everything else -->
	<link rel="shortcut icon" href="images/favicons/favicon.ico">
	<!-- For retina screens -->
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/favicons/apple-touch-icon-retina.png">
	<!-- For iPad 1-->
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/favicons/apple-touch-icon-ipad.png">
	<!-- For iPhone 3G, iPod Touch and Android -->
	<link rel="apple-touch-icon-precomposed" href="images/favicons/apple-touch-icon.png">
	
	<!-- iOS web-app metas -->
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<!-- Add your custom home screen title: -->
	<meta name="apple-mobile-web-app-title" content="Jarvis"> 

	<!-- Startup image for web apps -->
	<link rel="apple-touch-startup-image" href="images/app/splash/ipad-landscape.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape)">
	<link rel="apple-touch-startup-image" href="images/app/splash/ipad-portrait.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait)">
	<link rel="apple-touch-startup-image" href="images/app/splash/iphone.png" media="screen and (max-device-width: 320px)">
        <?php
        //include('assets_app.php');
        break;
    case 'sitebuilder':
        include('assets_sitebuilder.php');
        break;
    default:
        include('assets.php');
        break;
} ?>