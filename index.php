<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package mtminimag
 */

get_header();
?>
	<div class="row <?php echo (getOption('defaults', 'pagination_type') == 'load-more') ? 'mtminimag-posts' : ''; ?>">
		<?php
			if ( have_posts() ) :

				if ( is_home() && ! is_front_page() ) :
					?>
					<header itemtype="https://schema.org/WPHeader" itemscope="itemscope">
						<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
					</header>
					<?php
				endif;

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

				// Pagination for posts
				mtminimag_pagination();
			else :
				get_template_part( 'template-parts/content', 'none' );
			endif;
		?>

	</div><!-- .row -->
		
	<?php if ( getOption('defaults', 'pagination_type') == 'load-more' ) : ?>
		<div class="w-100 text-center my-3">
			<button class="view-more-button btn btn-black">Load More</button>
		</div>
	<?php endif; ?>
			
<?php
get_footer();
