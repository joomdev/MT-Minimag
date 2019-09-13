<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package mtminimag
 */
?>
			</div><!-- main-content -->
			
			<!-- Sidebar-right -->
			<?php
				/* Right Sidebar */
				// Metabox Sidebar Status (Gutenberg)
				$metabox_sidebar_status = get_post_meta(get_the_ID(), 'mtminimag-sidebar-status', true) ? get_post_meta(get_the_ID(), 'mtminimag-sidebar-status', true) : "default";

				// Post Level
				if(is_single()) :
					if ( $metabox_sidebar_status == "default" ) {
						if ( getOption('defaults', 'singlepost_sidebar') == 'default' ) {
							if ( getOption('defaults', 'default_sidebar') == 'right' ) {
								get_template_part( 'template-parts/sidebar/sidebar', 'right' );
							}
						} elseif ( getOption('defaults', 'singlepost_sidebar') == 'right') {
							get_template_part( 'template-parts/sidebar/sidebar', 'right' );
						}
					}
					elseif ( $metabox_sidebar_status == "right" ) {
						get_template_part( 'template-parts/sidebar/sidebar', 'right' );
					}
				endif;
				
				// Page Level
				if(is_page()) :
					if( $metabox_sidebar_status == "default" ) {
						if ( getOption('defaults', 'singlepage_sidebar') == 'default' ) {
							if ( getOption('defaults', 'default_sidebar') == 'right' ) {
								get_template_part( 'template-parts/sidebar/sidebar', 'right' );
							}
						} elseif ( getOption('defaults', 'singlepage_sidebar') == 'right') {
							get_template_part( 'template-parts/sidebar/sidebar', 'right' );
						}
					}
					elseif( $metabox_sidebar_status == "right" ) {
						get_template_part( 'template-parts/sidebar/sidebar', 'right' );
					}
				endif;

				// Homepage level
				if( is_home() ) :
					if ( getOption('defaults', 'archive_sidebar') == 'default' ) {
						if ( getOption('defaults', 'default_sidebar') == 'right' ) {
							get_template_part( 'template-parts/sidebar/sidebar', 'right' );
						}
					} elseif ( getOption('defaults', 'archive_sidebar') == 'right') {
						get_template_part( 'template-parts/sidebar/sidebar', 'right' );
					}

				endif;

				// Homepage Widget Position (Bottom)
				if ( is_home() && is_active_sidebar('home_widget_bottom') ) :
				?>
					<div class="home-bottom-widget-area col-12">
						<?php dynamic_sidebar('home_widget_bottom'); ?>
					</div>
				<?php
				endif;
			?>
        
		</div><!-- component-area-inner -->
      </div> <!-- container -->
  </section> <!-- component-area -->
</div> <!-- big-container -->
	
<!-- Footer -->
<div class="footer py-3 py-md-5">
	<div class="container">
		<div class="d-flex align-items-center justify-content-between">
			<div class="copyright">
				<?php mtminimag_footer_info(); ?>
			</div>
		
			<?php get_template_part( 'template-parts/social', 'profiles' ); ?>			
		</div>
	</div>
</div>

<?php if ( getOption('defaults', 'show_search') ) : ?>
	<!-- Header Search Modal -->
	<div id="search-content" class="search-content <?php echo ( getOption('defaults', 'show_search_mobile') ? '' : 'd-none d-sm-block' ); ?>">
		<button type="button" class="close">&Cross;</button>
		<form role="search" method="get" class="header-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
			<input name="s" type="search" placeholder="Type here..." class="search-field" id="search">
		</form>
	</div>
<?php endif; ?>

<?php 
	// Offcanvas
	if ( getOption('defaults', 'enable_offcanvas') ) : 
		get_template_part('template-parts/offcanvas', 'section');
	endif;
?>

<?php wp_footer(); ?>

<?php if ( getOption('defaults', 'space_before_body') ) : ?>
    <div class="space-before-body-code">
        <?php echo wp_kses_post(getOption('defaults', 'space_before_body')); ?>
    </div>
<?php endif; ?>

</body>

<?php
    if ( getOption('defaults', 'tracking_code') ) :
        echo wp_kses_post(getOption('defaults', 'tracking_code')); 
    endif;
?>

</html>
