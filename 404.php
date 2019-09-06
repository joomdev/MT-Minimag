<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package mtminimag
 */

get_header();
?>

<section class="main-content">
	<div class="container">
		<div class="row">
			<div class="col-12 col-md-8 mx-auto d-flex align-items-center justify-content-center flex-wrap flex-column text-center page-content-404">
				<div class="page-content-404-title mb-3 404-content"><?php echo wp_kses_post(getOption('defaults', '404_page_content')); ?></div>
				<a href="#" class="btn btn-black 404-cta"><?php echo wp_kses_post(getOption('defaults', 'calltoaction')); ?></a>
			</div>
		</div>
	</div>
</section>

<?php
get_footer();
