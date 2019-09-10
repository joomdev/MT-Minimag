<?php
    $sliderCategory = getOption('defaults', 'category_type');
    $noOfPosts = getOption('defaults', 'no_of_posts');

    $slidesArgs = array(
        'posts_per_page' => $noOfPosts,
        'post_status' => 'publish',
    );
    
    // Sort by category
    if ($sliderCategory !== 'all') {
        $slidesArgs['category_name'] = $sliderCategory;
    }

    // Sort by Latest/Popular
    if (getOption('defaults', 'sort_posts') == 'popular' ) {
        $slidesArgs['meta_key'] = 'post_views_count';
        $slidesArgs['orderby'] = 'meta_value_num';
        $slidesArgs['order'] = 'DESC';
    }

    $query = new WP_Query( $slidesArgs );

    if ( $query->have_posts() ) :
?>
<article itemtype="https://schema.org/CreativeWork" itemscope="itemscope" class="slider-sec">
    <div class="">
        <div id="carousel" class="carousel slide partial-slides" data-ride="carousel">
            <div class="carousel-inner">
                <?php 
                while ( $query->have_posts() ) :
                    $query->the_post();
                    if ( ( function_exists( 'has_post_thumbnail' ) ) && ( has_post_thumbnail() ) ) :
                ?>
                <div class="slides carousel-item" data-interval="10000">
                    <div class="slider-item">
                        <div class="slider-image">
                            <a href="<?php the_permalink() ?>">
                                <?php the_post_thumbnail('large', array('class' => 'd-block w-100')); ?>
                            </a>
                        </div>
                        <div class="carousel-content col-10 col-md-8 mx-auto text-center">
                            <ul class="entry-meta meta-color-dark horizontal-view mb-0">
                                <li><i class="fas fa-tag"></i><?php the_category( ' ' ); ?></li>
                                <li><i class="fas fa-calendar-alt"></i><?php mtminimag_posted_on(); ?></li>
                                <li itemtype="https://schema.org/Person" itemscope="itemscope" itemprop="author"><i class="fas fa-user"></i><a href="#" class="font-weight-500 ml-1"><?php mtminimag_posted_by(); ?></a>
                                </li>
                                <li><i class="far fa-clock"></i>
                                    <?php echo calculateReadTime(get_post_field( 'post_content', $post->ID )); ?>
                                    <?php echo calculateReadTime(get_post_field( 'post_content', $post->ID )) == 1 ? ' min' : ' mins'?> read
                                </li>
                            </ul>
                            <?php
                                the_title( '<h3 class="carousel-content-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
                            ?>
                        </div>
                    </div>
                </div>
                <?php
                    endif; 
                endwhile;
                // Restore original Post Data
                wp_reset_postdata();
                ?>
            </div>
            <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
                <span class="carousel-prev-icon"><i class="fas fa-chevron-left"></i></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
                <span class="carousel-next-icon"><i class="fas fa-chevron-right"></i></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</article>

<?php
endif;
?>