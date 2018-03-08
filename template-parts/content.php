<?php
/**
 * Template part for displaying posts
 */
?>

<?php if(is_single()){ ?>

	<article id="post-<?php the_ID(); ?>" class="post">
		<div class="entry-content">
			<?php the_content();?>
		</div>
		<?php echo cude_blog_get_entry_meta();?>
	</article>

<?php } else { ?>

	<article id="post-<?php the_ID(); ?>" class="posts <?php post_class(); ?>">
		<figure class="entry-thumbnail">
			<a href="<?php echo get_the_permalink()?>">
				<?php
					if(has_post_thumbnail()) {
						$id_img = get_post_thumbnail_id(get_the_ID());
						$post_image = wp_get_attachment_image_src($id_img, 'full');
						?><img src="<?php echo $post_image[0]; ?>" class="post_img" alt="<?php echo get_the_title(); ?>"><?php
					} else {
						?><img src="<?php echo get_template_directory_uri(); ?>/img/loading.png" class="post_img" alt="<?php echo get_the_title(); ?>"><?php
					} 
				?>
			</a>
		</figure>	
		<header class="entry-header">
			<h2 class="entry-title"><a href="<?php echo get_the_permalink()?>"><?php echo get_the_title()?></a></h2>
			<?php echo cude_blog_get_entry_meta();?>		
		</header>
		<div class="entry-summary">
		<?php
			if(has_excerpt()) echo get_the_excerpt();
			else echo wp_trim_words(get_the_content(), 30, ' ...' );	
		?>
		</div>
	</article>

<?php } ?>