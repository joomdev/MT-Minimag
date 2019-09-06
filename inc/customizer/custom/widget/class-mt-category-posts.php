<?php
/**
 * Posts by category Custom Widget For MT-Minimag
 */

// Creating Widgets
function mtminimag_load_category_widget() {
    register_widget( 'mtminimag_category_widget' );
}
add_action( 'widgets_init', 'mtminimag_load_category_widget' );

// Popular Posts by Comments

function mtminmag_category_posts($instance) {

	$chosenCategory = $instance['category'];
	$number = ( ! empty( $instance['totalPosts'] ) ) ? absint( $instance['totalPosts'] ) : 3;
	if ( ! $number ) {
		$number = 3;
	}

	$showDate = isset( $instance['showDate'] ) ? $instance['showDate'] : true;
	$showAuthor = isset( $instance['showAuthor'] ) ? $instance['showAuthor'] : true;
	$showCategory = isset( $instance['showCategory'] ) ? $instance['showCategory'] : true;
	$showReadTime = isset( $instance['showReadTime'] ) ? $instance['showReadTime'] : true;

    $categoryArgs = array(
        'posts_per_page' => $number,
        'post_status' => 'publish',
    );
    
    // Sort by category
    if ($chosenCategory !== 'all') {
        $categoryArgs['category_name'] = $chosenCategory;
    }

	$query = new WP_Query( $categoryArgs );
	?>

	<div class="mt-popular-post-list">
	<?php
	while( $query->have_posts() ) :
		$query->the_post();
	?>
		<article itemtype="https://schema.org/CreativeWork" itemscope="itemscope" class="mtminimag-popular-widget">
			<div class="blog-item scale rotate">				
				<div class="item-img">
					<a href="<?php the_permalink() ?>">
						<?php the_post_thumbnail('full', array('class' => 'img-fluid ease-5 ppw-img')); ?>
					</a>
				</div>				
				<div class="blog-item-content text-center">
					<ul class="entry-meta">
						<?php if ( $showCategory ) : ?>
							<li><i class="fas fa-tag"></i><?php the_category( ',' ); ?></li>
						<?php endif; ?>
						
						<?php if ( $showDate ) : ?>
							<li><i class="fas fa-calendar-alt"></i><?php the_time( 'M j, y' ); ?></li>
						<?php endif; ?>

						<?php if ( $showAuthor ) : ?>
							<li><i class="fas fa-user"></i><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>" itemtype="https://schema.org/Person" itemscope="itemscope" itemprop="author"><?php the_author(); ?></a></li>
						<?php endif; ?>
						<?php if ( $showReadTime ) : ?>
						<li>
							<i class="far fa-clock"></i>
							<?php echo calculateReadTime(get_post_field( 'post_content', $post->ID )); ?>
							<?php echo calculateReadTime(get_post_field( 'post_content', $post->ID )) == 1 ? ' min' : ' mins'?> read
						</li>
						<?php endif; ?>
					</ul>
					<h2 class="blog-item-title">
						<a href="<?php the_permalink() ?>">
							<?php the_title() ?>
						</a>
					</h2>
				</div>
			</div>
		</article>
	<?php
	endwhile;
	?>
	</div>
	<?php
	wp_reset_postdata();
}

// Creating the widget
class mtminimag_category_widget extends WP_Widget {
	
	function __construct() {
		parent::__construct(
		
		// Base ID of your widget
		'mtminimag_category_widget',
		
		// Widget name will appear in UI
		__('Category Posts (MT-Minimag)', 'mtminimag'),
		
		// Widget description
		array( 'description' => __( 'Category posts widget by MightyThemes', 'mtminimag' ), )
		);
	}
 
	// Creating widget front-end
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );

		// before and after widget arguments
		echo $args['before_widget'];
		if ( ! empty( $title ) )
		echo $args['before_title'] . $title . $args['after_title'];

		// This is where you run the code and display the output		
		mtminmag_category_posts( $instance );
		echo $args['after_widget'];
	}

	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title']     = sanitize_text_field( $new_instance['title'] );
		$instance['category'] = sanitize_text_field( $new_instance['category'] );
		$instance['totalPosts'] = isset( $new_instance['totalPosts'] ) ? (int) $new_instance['totalPosts'] : 3;
		$instance['showCategory'] = isset( $new_instance['showCategory'] ) ? (bool) $new_instance['showCategory'] : false;
		$instance['showDate'] = isset( $new_instance['showDate'] ) ? (bool) $new_instance['showDate'] : false;
		$instance['showAuthor'] = isset( $new_instance['showAuthor'] ) ? (bool) $new_instance['showAuthor'] : false;
		$instance['showReadTime'] = isset( $new_instance['showReadTime'] ) ? (bool) $new_instance['showReadTime'] : false;
		
		return $instance;
	}
         
	// Widget Backend
	public function form( $instance ) {
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$category = isset( $instance['category'] ) ? esc_attr( $instance['category'] ) : 'all';
		$totalPosts    = isset( $instance['totalPosts'] ) ? absint( $instance['totalPosts'] ) : 3;
		$showCategory = isset( $instance['showCategory'] ) ? (bool) $instance['showCategory'] : true;
		$showDate = isset( $instance['showDate'] ) ? (bool) $instance['showDate'] : true;
		$showAuthor = isset( $instance['showAuthor'] ) ? (bool) $instance['showAuthor'] : true;
		$showReadTime = isset( $instance['showReadTime'] ) ? (bool) $instance['showReadTime'] : true;
		?>
			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'mtminimag' ); ?></label> 
				<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />

				<label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php esc_html_e( 'Category:', 'mtminimag' ); ?></label>
				<select class="widefat" name="<?php echo $this->get_field_name( 'category' ); ?>" id="<?php echo $this->get_field_id( 'category' ); ?>" value="<?php echo $category; ?>">
					<?php foreach( getCategories() as $key => $value ) : ?>
						<option value="<?php echo $key; ?>">
							<?php echo $value; ?>
						</option>
					<?php endforeach; ?>
				</select>

				<label for="<?php echo $this->get_field_id( 'totalPosts' ); ?>"><?php esc_html_e( 'Number of Posts:', 'mtminimag' ); ?></label> 
				<input class="widefat" id="<?php echo $this->get_field_id( 'totalPosts' ); ?>" name="<?php echo $this->get_field_name( 'totalPosts' ); ?>" type="number" min="1" step="1" value="<?php echo $totalPosts; ?>" />

				<hr>
				<p>Customization Options: </p>
				<input class="checkbox" type="checkbox" <?php checked( $showCategory ); ?> id="<?php echo $this->get_field_id( 'showCategory' ); ?>" name="<?php echo $this->get_field_name( 'showCategory' ); ?>" /> 
				<label for="<?php echo $this->get_field_id( 'showCategory' ); ?>">Show Category</label>
				
				<br><br>

				<input class="checkbox" type="checkbox" <?php checked( $showDate ); ?> id="<?php echo $this->get_field_id( 'showDate' ); ?>" name="<?php echo $this->get_field_name( 'showDate' ); ?>" /> 
				<label for="<?php echo $this->get_field_id( 'showDate' ); ?>">Show Date</label>
				
				<br><br>

				<input class="checkbox" type="checkbox" <?php checked( $showAuthor ); ?> id="<?php echo $this->get_field_id( 'showAuthor' ); ?>" name="<?php echo $this->get_field_name( 'showAuthor' ); ?>" /> 
				<label for="<?php echo $this->get_field_id( 'showAuthor' ); ?>">Show Author</label>

				<br><br>

				<input class="checkbox" type="checkbox" <?php checked( $showReadTime ); ?> id="<?php echo $this->get_field_id( 'showReadTime' ); ?>" name="<?php echo $this->get_field_name( 'showReadTime' ); ?>" /> 
				<label for="<?php echo $this->get_field_id( 'showReadTime' ); ?>">Show Read Time</label>
			</p>			
		<?php
	}
} // Class mtminimag_category_widget ends here