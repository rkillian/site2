<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html <?php language_attributes('xhtml'); ?> xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">
	<meta http-equiv="content-type" content="<?php bloginfo('html_type')?>;charset=<?php bloginfo('charset'); ?>"/>
	
	<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'buttercream' ), max( $paged, $page ) );

	?></title>
	
	<meta name="language" content="<?php bloginfo('language')?>"/>
	<meta name="robots" content="<?php if(!is_404()){echo "index,follow";}else{echo "noindex,follow";}?>"/>
	<link rel="profile" href="http://microformats.org/profile/hcard"/>
	
	<link rel="stylesheet" href="<?php echo get_stylesheet_uri() ?>" type="text/css" media="screen"/>
	<link rel="icon" type="image/x-icon" href="<?php echo get_stylesheet_directory_uri() ?>/img/favicon.ico"/>

<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri() ?>/js/mootools.js"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri() ?>/js/script.js"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri() ?>/js/mootools-more.js"></script>
<?php wp_head()?>
</head>
<body <?php body_class()?>>

<div id="pagewidth" >


<div id="header">
<h1><a href="<?php echo site_url()?>" title="<?php bloginfo('name')?>"><?php bloginfo('name')?></a></h1>
<h2><?php bloginfo('description')?></h2>
</div>

<div id="wrapper" class="clearfix">