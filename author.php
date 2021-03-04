<?php
/**
 * The template for displaying Author archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package mtminimag
 */

get_header();
?>
    <?php get_template_part('template-parts/breadcrumbs', 'section'); ?>
    
    <div class="row <?php echo (getOption('defaults', 'pagination_type') == 'load-more') ? 'mtminimag-posts' : ''; ?>">

		<?php if ( have_posts() ) : ?>

			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_type() );

			endwhile;

			mtminimag_pagination();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</div><!-- .row -->

	<?php if ( getOption('defaults', 'pagination_type') == 'load-more' ) : ?>
		<div class="w-100 text-center my-3">
			<button class="view-more-button btn btn-black"><?php esc_html_e('Load More', 'mtminimag'); ?></button>
		</div>
	<?php endif; ?>

<?php
get_footer();
