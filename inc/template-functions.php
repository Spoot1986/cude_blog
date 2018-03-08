<?php
/*
 * Functions which enhance the theme by hooking into WordPress
 */

//get title 
function cude_blog_get_title() {
	if(is_home()) echo'<h1>'.get_theme_mod('blog_title').'</h1>';
	if(is_page() || is_single()) echo'<h1>'.get_the_title().'</h1>';
	if(is_archive()) echo'<h1>'.get_the_archive_title().'</h1>';
	if(is_search()) echo '<h1>'.__( 'Search Results for: ', 'cude-blog' ).get_search_query().'</h1>';
	if(is_404()) echo '<h1>'.__( 'Page not found ', 'cude-blog' ).'</h1>';
}

//get bg img
function cude_blog_get_bg_img() {
	$bg_image = '';

	$blog_img_dpp = get_theme_mod('blog_img_dpp');

	if(is_page() || is_single()){

		if($blog_img_dpp == '1'){
			$bg_image = get_theme_mod('blog_img');
		} else {
			$id_img = get_post_thumbnail_id(get_the_ID());
			$image = wp_get_attachment_image_src($id_img, 'full');
			$bg_image = $image[0];
			if(empty($bg_image)) $bg_image = get_theme_mod('blog_img');
		}	
	}
	
	if(is_archive() || is_home() || is_search() || is_404()){
		$bg_image = get_theme_mod('blog_img');
	}

	return $bg_image;
}

//get entry meta
function cude_blog_get_entry_meta() { 
	$blog_tax = get_theme_mod('blog_tax');
	$blog_date = get_theme_mod('blog_date');

	if($blog_date != '1' || $blog_tax != '1') echo '<div class="entry-meta">';

	if($blog_date != '1'){
		$archive_year  = get_the_time('Y');
		$archive_month = get_the_time('m');
		$archive_day   = get_the_time('d');

		echo '<span class="posted-on">';
		echo '<a href="'.get_day_link( $archive_year, $archive_month, $archive_day).'" rel="bookmark"> ';
		the_time(get_option( 'date_format'));
		echo '</a></span>';	
	}

	if($blog_tax != '1'){
		echo '<span class="cd_cat">';
		the_category(' ');
		echo '</span>';

		echo '<span class="tags">';
		the_tags('', ' ','');
		echo '</span>';
	}

	if($blog_date != '1' || $blog_tax != '1') echo '</div>';
}

//get blog name
function cude_blog_get_blog_name(){
	$get_name = get_bloginfo('name');
	$name_array = explode(' ', $get_name);

	$n=0;
	$blog_name = '';
	for ($i=0; $i < count($name_array) ; $i++) { 
		$n++;
		if($n==2){
			$blog_name .= ' <span>'.$name_array[$i].'</span> ';
			$n=0;
		} else {
			$blog_name .= $name_array[$i];
		}
	}

	return $blog_name;
}

//pagination
function cude_blog_pagination_template($template, $class){
	return '<div class="pagination">%3$s</div>';
}
add_filter('navigation_markup_template', 'cude_blog_pagination_template', 10, 2);

//search form
function cude_blog_get_search_form( $form ) {
	
	$form = '
	<form action="'.get_home_url().'" method="get" class="cb_search">
	  <input type="search" name="s" placeholder="" class="input" />
	  <input type="submit" name="" value="" class="submit" />
	</form>
	';
	return $form;
}

add_filter( 'get_search_form', 'cude_blog_get_search_form' );

//comment fields
function cude_blog_comment_form_fields( $fields ){
	$new_fields = array();
	$order = array('author','email','comment');
	foreach( $order as $key ){
		$new_fields[ $key ] = $fields[ $key ];
		unset( $fields[ $key ] );
	}
	return $new_fields;
}
add_filter('comment_form_fields', 'cude_blog_comment_form_fields');

//exclude pages from search result 
function cude_blog_exclude_pages($query){
    if($query->is_search){
        $query->set('post_type', 'post');
    }
    return $query;
}
add_filter('pre_get_posts','cude_blog_exclude_pages');
?>