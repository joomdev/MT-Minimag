<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package mtminimag
 */

get_header();

// URL for social sharing
$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$socialLink = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$blogTitle = get_the_title();
$twitterUrl = $blogTitle." ".$socialLink;
$encodedTitle = rawurlencode($blogTitle);
$encodedUrl = rawurlencode($socialLink);

?>
<?php
	while ( have_posts() ) :
		the_post();
	?>

<?php wp_link_pages(); ?>

<div class="row">
	<article id="post-<?php echo esc_attr( get_the_ID() ); ?>" class="col-12 mt-single-post-wrap">
		<?php if ( has_post_thumbnail() ) : ?>
		<div class="w-100 item-img">
			<?php if ( function_exists( 'add_theme_support' ) ) the_post_thumbnail('post-thumbnail', ['class' => 'w-100 img-fluid']); ?>
		</div>
		<?php endif; ?>
		<div class="detail-view-2 col-md-10 mx-auto">
			<div class="detail-view-2-inner">
				<!-- Blog Item -->
				<div class="blog-item">
					<div class="blog-item-content text-center border-bottom">
						<ul class="entry-meta meta-color-dark horizontal-view">

							<?php if( getOption('defaults', 'show_category') ) : ?>
								<li><i class="fas fa-tag"></i><?php the_category( ' ' ); ?></li>
							<?php endif; ?>

							<?php if ( getOption('defaults', 'show_date') ) : ?>
							<li><i class="fas fa-calendar-alt"></i>
							<?php
								$u_time = get_the_time('U');
								$u_modified_time = get_the_modified_time('U');
								if ($u_modified_time >= $u_time + 86400) {
							?>
								<span itemprop="dateModified" class="list-post-date m-1">Updated on <?php the_modified_time('F jS, Y'); ?></span>
							<?php
								} else {
							?>
								<span itemprop="dateModified" class="list-post-date m-1">Updated on <?php echo get_the_time('F jS, Y'); ?></span>
							<?php
								}
							endif; ?>

							<?php if ( getOption('defaults', 'show_author') ) : ?>
								<li>
									<i class="fas fa-user"></i>
									<a itemtype="https://schema.org/Person" itemscope="itemscope" itemprop="author" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>">
										<b><?php the_author(); ?></b>
									</a>
								</li>
							<?php endif; ?>

							<?php if( getOption('defaults', 'show_readtime') ) : ?>
								<li>
									<i class="far fa-clock"></i>
									<?php echo calculateReadTime(get_post_field( 'post_content', $post->ID )); ?>
									<?php echo calculateReadTime(get_post_field( 'post_content', $post->ID )) == 1 ? ' minute' : ' minutes'?>
									read.
								</li>
							<?php endif; ?>

						</ul>
						
						<?php the_title( '<h1 class="single-post-title">', '</h1>' ); ?>

						<!-- Social Share -->
						<?php if ( getOption('defaults', 'social_share_enable') ) : ?>
							<ul class="justify-content-center social-share horizontal-view mb-0">
								<li>
									<a target="_blank" class="facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $socialLink; ?>"><i class="fab fa-facebook-f mr-1"></i><span>SHARE</span></a>
								</li>
								<li>
									<a target="_blank" class="twitter" href="https://twitter.com/intent/tweet?text=<?php echo $twitterUrl; ?>"><i class="fab fa-twitter mr-1"></i><span>SHARE</span></a </li> <li>
									<a target="_blank" class="reddit" href="http://www.reddit.com/submit?url=<?php echo $socialLink; ?>"><i class="fab fa-reddit mr-1"></i><span>SHARE</span></a>
								</li>
								<li>
									<a target="_blank" class="pinterest" href="<?php echo "http://pinterest.com/pin/create/button/?url=$encodedUrl&description=$encodedTitle" ?>"><i class="fab fa-pinterest mr-1"></i><span>PIN IT</span></a>
								</li>
							</ul>
						<?php endif; ?>
						
						<?php if ( getOption('defaults', 'show_comment_counts') || getOption('defaults', 'show_post_views') ) : ?>
						<ul class="response-area justify-content-center horizontal-view mb-0">
							<?php if ( getOption('defaults', 'show_comment_counts') ) : ?>
								<li>
									<a class="nav-link" href="#"><i class="far fa-comment mr-1"></i><span><?php echo (wp_count_comments($post->ID)->approved) ? wp_count_comments($post->ID)->approved : 0; ?> </span></a>
								</li>
							<?php endif; ?>
							<?php if ( getOption('defaults', 'show_post_views') ) : ?>
								<li>
									<a href="#" class="nav-link"><i class="far fa-eye mr-1"></i><span>
									<?php setPostViews(get_the_ID()); echo getPostViews(get_the_ID()); ?>
									</span></a>
								</li>
							<?php endif; ?>
						</ul>
						<?php endif; ?>
					</div>
				</div>

				<div class="blog-detail">
					<?php the_content(); ?>
				</div>

				<?php if ( getOption('defaults', 'show_tags') ) : ?>
				<div class="blog-tag">
					<ul class="blog-tag-item horizontal-view">
						<li><i class="fas fa-bookmark mr-1"></i></li>
						<?php the_tags('',',&nbsp; ',''); ?>
					</ul>
				</div>
				<?php endif; ?>

				<nav itemtype="https://schema.org/SiteNavigationElement" itemscope="itemscope" class="post-navigation mt-sept d-md-flex justify-content-md-between text-center m-2">
					<?php
						$prev_post = get_adjacent_post(false, '', true);
						if ( !empty($prev_post->post_title) ) :
						?>
						<div class="post-previous text-md-left">
							<?php
								$prev_post = get_adjacent_post(false, '', true);
								echo "<a href=" . get_permalink($prev_post->ID) . ">
								<span><i class='fa fa-angle-left'></i> Previous Post</span>";
								if(!empty($prev_post)) {
								echo '<h6>' . $prev_post->post_title . '</h6></a>'; }
							?>
						</div>
					<?php
						endif;

					$next_post = get_adjacent_post(false, '', false);
					if ( !empty($next_post) ) :
					?>
					<div class="post-next text-md-right">
						<?php
							echo "<a href=" . get_permalink($next_post->ID) . ">
							<span>Next Post <i class='fa fa-angle-right'></i></span>";
							if(!empty($next_post)) {
							echo '<h6>' . $next_post->post_title . '</h6></a>'; }
						?>
					</div>
					<?php endif; ?>
				</nav>

				<!-- Author Box -->
				<?php if ( getOption('defaults', 'show_authorinfobox') ) : ?>
					<div class="blog-author">
						<div class="media">
							<?php echo get_avatar(get_the_author_meta('id'), '150', '', 'author', array('class' => 'author-img')); ?>
							<div class="media-body">
								<h5 class="blog-item-title">
									<a
										href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>">
										<?php the_author(); ?>
									</a>
								</h5>
								<div class="blog-item-subtitle">
									<?php $aid = get_the_author_meta('ID'); echo ucfirst(get_user_role($aid)); ?>
								</div>
								<p><?php echo esc_html(get_the_author_meta('description')) ?></p>
								<ul class="social-icon horizontal-view">
									<?php if ( get_the_author_meta( 'facebook' ) ) : ?>
										<li>
											<a href="<?php the_author_meta( 'facebook' ); ?>" target="_blank">
												<i class="fab fa-facebook-f" aria-hidden="true"></i>
											</a>
										</li>
									<?php endif; ?>

									<?php if ( get_the_author_meta( 'twitter' ) ) : ?>
										<li>
											<a href="<?php the_author_meta( 'twitter' ); ?>" target="_blank">
												<i class="fab fa-twitter" aria-hidden="true"></i>
											</a>
										</li>
									<?php endif; ?>

									<?php if ( get_the_author_meta( 'instagram' ) ) : ?>
										<li>
											<a href="<?php the_author_meta( 'instagram' ); ?>" target="_blank">
												<i class="fab fa-instagram" aria-hidden="true"></i>
											</a>
										</li>
									<?php endif; ?>

									<?php if ( get_the_author_meta( 'linkedin' ) ) : ?>
										<li>
											<a href="<?php the_author_meta( 'linkedin' ); ?>" target="_blank">
												<i class="fab fa-linkedin" aria-hidden="true"></i>
											</a>
										</li>
									<?php endif; ?>

									<?php if ( get_the_author_meta( 'youtube' ) ) : ?>
										<li>
											<a href="<?php the_author_meta( 'youtube' ); ?>" target="_blank">
												<i class="fab fa-youtube" aria-hidden="true"></i>
											</a>
										</li>
									<?php endif; ?>

									<?php if ( get_the_author_meta( 'url' ) ) : ?>
										<li>
											<a href="<?php the_author_meta( 'url' ); ?>" target="_blank">
												<i class="fas fa-link" aria-hidden="true"></i>
											</a>
										</li>
									<?php endif; ?>
								</ul>
							</div>
						</div>
					</div>
				<?php endif; 
				
				// Related Posts
				if( getOption('defaults', 'related_post_enable') ) {
					switch( getOption('defaults', 'related_post_by') ) :
						case 'categories' : related_posts_by_categories();
						break;
						case 'tags' : related_posts_by_tags();
						break;
					endswitch;
				} ?>
				
				<!-- Comments -->
				<?php
                    // Comment Form
                    // If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				?>
			</div>
		</div>
	</article>
</div>

<?php
endwhile; // End of the loop.

get_footer();