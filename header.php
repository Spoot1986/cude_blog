<?php
/*
 * The header for theme
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link href="https://fonts.googleapis.com/css?family=Russo+One" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<?php wp_head(); ?>
</head>
<body <?php body_class();?>>
	<header>
		<div class="header_wrapper_fix">
			<div class="header_logo">
				<?php if(has_header_image()){ ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img class="site-logo" src="<?php echo get_header_image(); ?>" alt="<?php echo get_bloginfo('title'); ?>"></a>
				<?php } else { ?>
					<p class="site-title"><a href="<?php echo get_home_url();?>"><?php echo cude_blog_get_blog_name()?></a></p>
					<p class="site-description"><?php echo get_bloginfo('description');?></p>
				<?php } ?>	
			</div>
			<div class="header_search">
				<?php get_search_form();?>
				<i class="menu-toggle fa fa-bars"></i>
				<div id="sidr">
					<?php wp_nav_menu( array( 'theme_location' => 'menu-1', 'menu_id' => 'primary-menu_mobile') ); ?>
				</div>
			</div>
		</div>	
		<div class="header_wrapper">
			<div class="header-image-bg"></div>
			<?php $bg_image = cude_blog_get_bg_img(); ?>
			<div class="header-image" style="background-image: url(<?php echo $bg_image;?>)">
				<div class="header-image-title">
					<?php cude_blog_get_title(); ?>
				</div>
			</div>		
		</div>
		<div class="header_menu">
			<ul class="navigation">
			<?php
				wp_nav_menu( array(
					'container'       => 'ul',
					'items_wrap'    => '%3$s',
					'theme_location' => 'menu-1',
					'menu_id'        => '',
					'menu_class'	=> 'navigation',	
				) );
			?>
			</ul>
		</div>
	</header>

	<div class="site-content">