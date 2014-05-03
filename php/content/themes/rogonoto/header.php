<!DOCTYPE html>
<!--[if IE 7]><html class="ie7 no-js"  <?php language_attributes(); ?><![endif]-->
<!--[if lte IE 8]><html class="ie8 no-js"  <?php language_attributes(); ?><![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html class="not-ie no-js" <?php language_attributes(); ?>>  <!--<![endif]-->
<head>
<meta charset="utf-8">
<title> <?php if ( is_home() ) { ?><?php bloginfo('name'); ?> - <?php bloginfo('description'); } else{ ?><?php  wp_title(''); ?> - <?php bloginfo('name'); } ?></title>
<link href="<?php bloginfo('stylesheet_url'); ?>" rel="stylesheet" type="text/css" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link rel="Shortcut Icon" href="<?php $ico = of_get_option('favicon'); ?><?php echo $ico; ?>" type="image/x-icon" />
<?php $fbappid = of_get_option('fbappid'); if(($fbappid == '')) { ?>
<?php } else { ?>
<meta property='fb:app_id' content='<?php echo of_get_option('fbappid'); ?>' />
<?php } ?>
<?php wp_head(); ?>
	<style type="text/css">
	<?php 
	$ctheme = of_get_option('ctheme');
	$font = of_get_option('font');
	$ltheme = of_get_option('ltheme');
    echo '#sidebarkiri h3.title, #sidebar h3.title { background:url(wp-content/themes/rogonoto/img/alert-overlay.png)repeat-x;background-color:'.$ctheme.'}';
    echo '#footer, #mainmenu {background-color:'.$ctheme.'}';
    echo 'a:link, a:visited, a:hover, a:focus, h1.stitle { color:'.$ltheme.'}';
    echo'#footer .copyright,#footer .copyright a{color:'.$font.'}';
	?>
	
	</style>
</head>
<body>
<div id="wrap">
<header id="header">
<div class="row">
<section id="header-left">
<?php if( of_get_option('logo_uploader') ){ ?><a href="<?php echo home_url() ; ?>" title="<?php bloginfo('name'); ?>">
<img src="<?php echo of_get_option('logo_uploader'); ?>" alt="<?php bloginfo('name'); ?>" width="300" height="90"></a>
<?php } else { ?>
<div class="logo"><a href="<?php echo home_url() ; ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a></div>
<div class="desc"><?php bloginfo('description'); ?></div>
<?php } ?>
</section>
<section id="header-right">
</section>
</div></header>
<nav id="mainmenu">
<div class="row">
	<?php wp_nav_menu( array( 'theme_location' => 'main-menu 1', 'menu_class' => 'menu' , 'fallback_cb' => '' ) ); ?>
</div>
</nav>
<div class="row">
<nav id="mainmenukecil">

	<?php wp_nav_menu( array( 'theme_location' => 'main-menu 2', 'menu_class' => 'mainmenukecil' , 'fallback_cb' => '' ) ); ?>
</nav></div>
<div class="clearfix"></div>
<div class="row">