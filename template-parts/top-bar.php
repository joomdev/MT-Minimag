<section class="topbar big-container">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="main-menu">
                    <?php if ( has_nav_menu( 'top-menu' ) ) :
                        wp_nav_menu( array(
                            'theme_location' => 'top-menu',
                            'menu_id'        => 'top-menu',
                            'menu_class'     => 'menu',
                            'walker' => new Mighty_Walker_Nav_Menu()
                        ) );
                    endif; ?>
                </div>            
            </div>
            <div class="col-md-6">
                <?php get_template_part('template-parts/social', 'profiles'); ?>
            </div>
        </div>
    </div>
</section>