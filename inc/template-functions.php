<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package mtminimag
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function mtminimag_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
    }

	return $classes;
}
add_filter( 'body_class', 'mtminimag_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function mtminimag_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'mtminimag_pingback_header' );

/**
 * Return author role
 */
function get_user_role($id) {
    $user = new WP_User($id);

    return array_shift($user->roles);
}

/**
 * Calculates read time of an article
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function calculateReadTime($string)
{
    $speed = 170;
    $word = str_word_count(strip_tags($string));
    $m = floor($word / $speed);
    $s = floor($word % $speed / ($speed / 60));

    if ($m < 1) {
        $m = 1;
    } else if ($s > 30) {
        $m = $m;
    } else {
        $m++;
    }

    return $m;
}

/**
 * Related posts by Categories
 */ 
function related_posts_by_categories()
{
    $post_id = get_the_ID();
    $categories_ids = array();
    $categories = get_the_category($post_id);

    if (!empty($categories) && is_wp_error($categories)) :
        foreach ($categories as $category) :
            array_push($categories_ids, $category->term_id);
        endforeach;
    endif;

    $current_post_type = get_post_type($post_id);
    $query_args = array(
        'category__in'   => $categories_ids,
        'post_type'      => $current_post_type,
        'post_not_in'    => array($post_id),
        'posts_per_page'  => esc_html(getOption('defaults', 'related_post_count')),
        'ignore_sticky_posts' => 1,
    );

    $related_posts_categories = new WP_Query($query_args);
    ?>

    <div class="row related-posts-section">
    <?php
        if ($related_posts_categories->have_posts()) :
            while ($related_posts_categories->have_posts()) : 
                $related_posts_categories->the_post(); ?>
                <article itemtype="https://schema.org/CreativeWork" itemscope="itemscope" class="col-12 col-md-4">
                    <div class="blog-item scale rotate">
                        <div class="item-img">
                            <a href="<?php the_permalink() ?>">
                                <?php the_post_thumbnail('medium', array('class' => 'w-100 img-fluid ease-5')); ?>
                            </a>
                        </div>
                        <div class="m-2 text-center">
                            <h5>
                                <a href="<?php the_permalink() ?>">
                                    <?php the_title() ?>
                                </a>
                            </h5>
                        </div>
                    </div>
                </article>
        <?php
            endwhile;
            // Restore original Post Data
            wp_reset_postdata();
        endif;
        ?>
    </div>

<?php
}

/**
 * Related posts by Tags
 */ 
function related_posts_by_tags()
{
    $post_id = get_the_ID();
    $tags = wp_get_post_tags($post_id);
    
    if ($tags) {

        $tag_ids = array();
        foreach ($tags as $individual_tag) {
            $tag_ids[] = $individual_tag->term_id;
        }

        $args = array(
            'tag_in' => $tag_ids,
            'post_not_in' => array($post->ID),
            'posts_per_page' => esc_html(getOption('defaults', 'related_post_count')), // Number of related posts that will be shown.
            'ignore_sticky_posts' => 1
        );
        
        $related_posts_tags = new wp_query($args);
    ?>
        <div class="row related-posts-section">
        <?php
            if ($related_posts_tags->have_posts()) :
                while ($related_posts_tags->have_posts()) : 
                    $related_posts_tags->the_post(); ?>
                    <article itemtype="https://schema.org/CreativeWork" itemscope="itemscope" class="col-12 col-md-4">
                        <div class="blog-item scale rotate">
                            <div class="item-img">
                                <a href="<?php the_permalink() ?>">
                                    <?php the_post_thumbnail('medium', array('class' => 'w-100 img-fluid ease-5')); ?>
                                </a>
                            </div>
                            <div class="blog-item-content text-center">
                                <h5 class="blog-item-title">
                                    <a href="<?php the_permalink() ?>">
                                        <?php the_title() ?>
                                    </a>
                                </h5>
                            </div>
                        </div>
                    </article>
            <?php
                endwhile;
                // Restore original Post Data
                wp_reset_postdata();
            endif;
            ?>
        </div>

    <?php
    }
}

/**
 * Pagination
 */
if ( getOption('defaults', 'pagination_type') == 'prev-next' ) {
    if( ! function_exists( 'my_post_queries' ) ) :
        function my_post_queries( $query ) {
            // do not alter the query on wp-admin pages and only alter it if it's the main query
            if (!is_admin() && $query->is_main_query()){
                // alter the query for the home and category pages
                if( is_home() ){
                    $query->set('posts_per_page', 7);
                }

                if( is_category() ){
                    $query->set('posts_per_page', 7);
                }
            }
        }
        add_action( 'pre_get_posts', 'my_post_queries' );
    endif;
}

/**
 * Return specific post views count
 */
function getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 View";
    }
    return $count.' Views';
}
function setPostViews($postID) {
    if ( !is_admin_bar_showing() && !is_customize_preview() ) {
        $count_key = 'post_views_count';
        $count = get_post_meta($postID, $count_key, true);
        if ( $count=='' ) {
            $count = 0;
            delete_post_meta($postID, $count_key);
            add_post_meta($postID, $count_key, '0');
        } else {
            $count++;
            update_post_meta($postID, $count_key, $count);
        }
    }
}


if ( ! function_exists( 'mtminimag_pagination' ) ) :
    /**
     * Display navigation to next/previous set of posts when applicable.
     */
    function mtminimag_pagination() {
        if ( getOption('defaults', 'pagination_type') == 'numbered' || getOption('defaults', 'pagination_type') == 'load-more') {
            ?>
            <nav itemtype="https://schema.org/SiteNavigationElement" itemscope="itemscope" class="w-100 justify-content-center pagination my-3">
            <?php
                the_posts_pagination( array(
                    'mid_size'  => 1,
                    'prev_text' => '< ' . esc_html__( 'Previous', 'mtminimag' ),
                    'next_text' => esc_html__( 'Next', 'mtminimag' ).' >',
                ) );
            ?>
            </nav>
        <?php wp_reset_postdata();
        }
        elseif( getOption('defaults', 'pagination_type') == 'prev-next' ) {
            if ( have_posts() ) { ?>
                <div class="col-12">
                    <div class="d-flex justify-content-between mt-3 pagination-next-prev">
                        <?php
                            previous_posts_link("< Previous");
                            next_posts_link("Next >");
                        ?>
                    </div>
                </div>
    <?php
            }
        }
    }
endif;

// Google Web Fonts
function getJSONData($name)
{
    $fontsJSON = wp_remote_get(get_template_directory_uri() . '/inc/customizer/json/webfonts.json');
    $response = wp_remote_retrieve_body( $fontsJSON );
    
    return json_decode($response, true);
}

function getGoogleFonts()
{
    $fonts = getJSONData('webfonts');
    foreach ($fonts['items'] as $font) {
        $googleFonts["$font[family]"] = $font['family'];
    }

    return $googleFonts;
}

// Returns All Categories
function getCategories() {
    $categories["all"] = 'All';

    foreach(get_categories() as $keys => $category) {
        $categories["$category->slug"] = $category->name. " (" . $category->count . ")";
    }

    return $categories;
}

/**
 * Comments Template
 */
function mtminimag_comment($comment, $args, $depth) {
    if ( 'div' === $args['style'] ) {
        $tag       = 'div';
        $add_below = 'comment';
    } else {
        $tag       = 'li';
        $add_below = 'div-comment';
    }?>
    <<?php echo $tag; ?> <?php comment_class( empty( $args['has_children'] ) ? 'is-thread' : 'parent' ); ?> id="comment-<?php comment_ID() ?>"><?php 
    if ( 'div' != $args['style'] ) { ?>
        <div id="div-comment-<?php comment_ID() ?>" class="user-comment"><?php
    } ?>
			<div class="author-box">
				<div class="mt-author-bio-img">
					<div class="mt-img-border">
						<?php
							echo get_avatar( $comment );
							get_comment_author_link();
						?>
					</div>
				</div>
			</div>
			
			<?php
				if ( $comment->comment_approved == '0' ) { ?>
					<em class="comment-awaiting-moderation">
						<?php esc_html_e( 'Your comment is awaiting moderation.', 'mtminimag' ); ?>
					</em>
					<br/>
			<?php 
				}
			?>

			<div class="comment-body">
				<div class="meta-data">
					<span class="comment-author"><?php echo get_comment_author_link(); ?></span>
					<span class="comment-date">
						<?php
							printf( 
								__('%1$s at %2$s', 'mtminimag'), 
								get_comment_date(),  
								get_comment_time() 
							);
						?>
					</span>
                    <?php 
                        comment_reply_link(
                            array_merge( $args, 
                                array( 
                                    'add_below' => $add_below, 
                                    'depth'     => $depth, 
                                    'max_depth' => $args['max_depth'],
                                    'class' => 'text-secondary'
                                ) 
                            ) 
                        );
                    ?>
					
					<?php edit_comment_link( __( '(Edit)', 'mtminimag' ), '  | ', '' ); ?>
				</div>
				<div class="comment-content">
					<?php comment_text(); ?>
				</div>
			</div>
			
	<?php
    if ( 'div' != $args['style'] ) : ?>
        </div><?php 
    endif;
}

/**
 * Custom Fields for User Profile
 */
add_action( 'show_user_profile', 'custom_fields_user_profile' );
add_action( 'edit_user_profile', 'custom_fields_user_profile' );

function custom_fields_user_profile( $user ) { ?>
    <h3><?php _e("Social Handles", 'mtminimag'); ?></h3>

    <table class="form-table">
        <tr>
            <th><label for="facebook"><?php _e('Facebook', 'mtminimag'); ?></label></th>
            <td>
                <input type="text" name="facebook" id="facebook"
                    value="<?php echo esc_attr( get_the_author_meta( 'facebook', $user->ID ) ); ?>"
                    class="regular-text" /><br />
                <span class="description"><?php _e('Your facebook profile.', 'mtminimag'); ?></span>
            </td>
        </tr>
        <tr>
            <th><label for="twitter"><?php _e('Twitter', 'mtminimag'); ?></label></th>
            <td>
                <input type="text" name="twitter" id="twitter"
                    value="<?php echo esc_attr( get_the_author_meta( 'twitter', $user->ID ) ); ?>"
                    class="regular-text" /><br />
                <span class="description"><?php _e('Your twitter profile.', 'mtminimag'); ?></span>
            </td>
        </tr>
        <tr>
            <th><label for="instagram"><?php _e('Instagram', 'mtminimag'); ?></label></th>
            <td>
                <input type="text" name="instagram" id="instagram"
                    value="<?php echo esc_attr( get_the_author_meta( 'instagram', $user->ID ) ); ?>"
                    class="regular-text" /><br />
                <span class="description"><?php _e('Your instagram profile.', 'mtminimag'); ?></span>
            </td>
        </tr>
        <tr>
            <th><label for="linkedin"><?php _e('LinkedIn', 'mtminimag'); ?></label></th>
            <td>
                <input type="text" name="linkedin" id="linkedin"
                    value="<?php echo esc_attr( get_the_author_meta( 'linkedin', $user->ID ) ); ?>"
                    class="regular-text" /><br />
                <span class="description"><?php _e('Your linkedin profile.', 'mtminimag'); ?></span>
            </td>
        </tr>
        <tr>
            <th><label for="youtube"><?php _e('YouTube', 'mtminimag'); ?></label></th>
            <td>
                <input type="text" name="youtube" id="youtube"
                    value="<?php echo esc_attr( get_the_author_meta( 'youtube', $user->ID ) ); ?>"
                    class="regular-text" /><br />
                <span class="description"><?php _e('Your youtube profile.', 'mtminimag'); ?></span>
            </td>
        </tr>
    </table>
<?php }

/**
 * Saving custom fields values to Database
 */
add_action( 'personal_options_update', 'save_user_profile_fields' );
add_action( 'edit_user_profile_update', 'save_user_profile_fields' );

function save_user_profile_fields( $user_id ) {
    if ( !current_user_can( 'edit_user', $user_id ) ) { 
        return false; 
    }
    update_user_meta( $user_id, 'facebook', $_POST['facebook'] );
    update_user_meta( $user_id, 'twitter', $_POST['twitter'] );
    update_user_meta( $user_id, 'instagram', $_POST['instagram'] );
    update_user_meta( $user_id, 'linkedin', $_POST['linkedin'] );
    update_user_meta( $user_id, 'youtube', $_POST['youtube'] );
}

function get_breadcrumb()
{
    echo '<li itemscope itemtype="http://schema.org/BreadcrumbList" class="breadcrumb-item"><a href="' . home_url() . '" rel="nofollow">Home</a></li>';
    if( is_author() ) {
        echo "&nbsp;&nbsp;/&nbsp;&nbsp;";
        the_author(' &bull; ');
    }
    if (is_category() || is_single()) {
        echo "&nbsp;&nbsp;/&nbsp;&nbsp;";
        the_category(' &bull; ');
        if (is_single()) {
            echo " &nbsp;&nbsp;/&nbsp;&nbsp; ";
            the_title();
        }
    } elseif (is_page()) {
        echo "&nbsp;&nbsp;/&nbsp;&nbsp;";
        echo the_title();
    } elseif (is_search()) {
        echo "&nbsp;&nbsp;/&nbsp;&nbsp;Search Results for... ";
        echo '"<em>';
        echo the_search_query();
        echo '</em>"';
    }
}

/**
 * Add the copyright to the footer
 */
if ( ! function_exists( 'mtminimag_footer_info' ) ) {
	
	function mtminimag_footer_info() {
		$copyright = sprintf( '<span class="copyright">&copy; %1$s %2$s</span> &bull; %4$s <a href="%3$s" itemprop="url">%5$s</a>',
			date( 'Y' ),
			get_bloginfo( 'name' ),
			esc_url( 'https://mightythemes.com/themes/' ),
			_x( 'Powered by', 'MT Minimag', 'minimag' ),
			__( 'MT Minimag', 'minimag' )
        );
        
        echo $copyright; // WPCS: XSS ok.
	}
}

//
// ─── CUSTOM CONTROL AND SECTIONS ─────────────────────────────────────────────
//
require get_template_directory() . '/inc/customizer/custom/separator.php';