<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package mtminimag
 */

?>

 <article itemtype="https://schema.org/CreativeWork" itemscope="itemscope" id="post-<?php the_ID(); ?>" <?php post_class('col-12 col-md-6 entry-blog'); ?>>
	<div class="blog-item scale rotate">
		<?php if ( has_post_thumbnail() ) : ?>
		<div class="item-img">
			<?php mtminimag_post_thumbnail(); ?>
		</div>
		<?php endif; ?>
		<div class="blog-item-content text-center">
			<ul class="entry-meta meta-color-dark horizontal-view mb-0">
				<?php if( getOption('defaults', 'show_category_archive') ) : ?>
					<li><i class="fas fa-tag"></i><?php the_category( ' ' ); ?></li>
				<?php endif; ?>

				<?php if( getOption('defaults', 'estimated_read_time_archive') ) : ?>
				<li>
					<i class="far fa-clock"></i>
					<?php echo calculateReadTime(get_post_field( 'post_content', $post->ID )); ?>
					<?php echo calculateReadTime(get_post_field( 'post_content', $post->ID )) == 1 ? ' min' : ' mins'?> read
				</li>
				<?php endif; ?>

				<?php if ( 'post' === get_post_type() ) : ?>
					<?php if ( getOption('defaults', 'show_date_archive') ) : ?>
						<li><i class="fas fa-calendar-alt"></i><?php mtminimag_posted_on(); ?></li>
					<?php endif; ?>

					<?php if ( getOption('defaults', 'show_author_archive') ) : ?>
						<li itemtype="https://schema.org/Person" itemscope="itemscope" itemprop="author"><i class="fas fa-user"></i><?php mtminimag_posted_by(); ?></li>
					<?php endif; ?>
				<?php endif; ?>
			</ul>
			
			<?php
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			?>

			<?php if ( getOption('defaults', 'show_excerpt') ) : ?>
				<?php the_excerpt(); ?>
			<?php endif; ?>
			
			<?php if ( getOption('defaults', 'enable_read_more')) : ?>
				<a href="<?php echo esc_url( get_permalink() ) ?>" class="btn btn-link read-more-btn">
					<?php echo getOption('defaults', 'read_more_text'); ?>
					<i class="fas fa-arrow-right"></i>
				</a>
			<?php endif; ?>
		</div>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
