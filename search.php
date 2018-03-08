<?php
/*
 * The template for displaying search results pages
 */

get_header(); ?>

	<div class="primary">
		<?php
		if ( have_posts() ) : ?>

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'search' );

			endwhile;

			//pagination		
			$args = array(
				'show_all'     => false,
				'end_size'     => 1,
				'mid_size'     => 1,
				'prev_next'    => true,
				'prev_text'    => '<i class="fa fa-angle-left" aria-hidden="true"></i>',
				'next_text'    => '<i class="fa fa-angle-right" aria-hidden="true"></i>',
				'add_args'     => false,
				'add_fragment' => '',
				'screen_reader_text' => __('Posts navigation','cude-blog'),
			);

			if(function_exists('the_posts_pagination')){
				the_posts_pagination($args);
			} else {
				wp_link_pages($args);
			}

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
