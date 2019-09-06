<div class="offcanvas-sidebar">
    <div class="offcanvas-sidebar-inner">
        <div class="offcanvas-sidebar-inner-top">
            <div class="logo-area text-center mt-5">
                <?php if ( has_custom_logo() ) : ?>
                <a class="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <?php the_custom_logo(); ?>
                </a>
                <?php endif; ?>
                <div class="mt-logo-text list-inline">
                    <?php if (get_theme_mod('site_identity_status', true)) { ?>
                    <a itemscope="itemscope" itemtype="https://schema.org/Organization" class="brand-title"
                        href="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <?php echo esc_html(bloginfo('title')); ?>
                    </a>

                    <?php if (get_bloginfo('description')) { ?>
                    <div class="brand-tagline"><?php echo esc_html(get_bloginfo( 'description' )); ?></div>
                    <?php } } ?>
                </div>
            </div>
        </div>
        <?php if ( has_nav_menu( 'offcanvas-menu' ) ) : ?>
        <div class="offcanvas-sidebar-inner-mid">
            <!-- Top Nav -->
            <?php
                wp_nav_menu( array(
                    'theme_location' => 'offcanvas-menu',
                    'menu_id'        => 'offcanvas-menu',
                    'menu_class'     => 'nav topnav d-block text-center',
                ) );
            ?>
        </div>
        <?php endif; ?>

        <?php // Wigets for offcanvas
            if ( is_active_sidebar('offcanvas_widget') ) : dynamic_sidebar('offcanvas_widget'); endif;
        ?>

        <div class="offcanvas-sidebar-inner-bot">
            <!-- Social Icons -->
            <?php get_template_part('template-parts/social', 'profiles'); ?>
        </div>
    </div>

</div>