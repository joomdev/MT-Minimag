<header itemtype="https://schema.org/WPHeader" itemscope="itemscope">
    <div class="header-stacked">
        <div class="stacked-border">
            <div class="header">
                <div class="container">
                    <div class="header-inner">
                        <div class="header-action-items">
                        <?php if ( getOption('defaults', 'enable_offcanvas') ) : ?>
                            <!-- Offcanvas Menu -->
                            <div class="offcanvas-icon d-none d-lg-inline-flex">
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>     
                        <?php endif; ?>
                        <!-- Mobile Menu Button -->
                        <div class="nav-toggler mobile-menu d-block d-lg-none">
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        </div>
                        <div class="logo-area">
                            <a class="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                                <?php the_custom_logo(); ?>
                            </a>
                            <?php if (get_theme_mod('site_identity_status', true)) { ?>
                            <div class="mt-logo-text list-inline">
                                <a itemscope="itemscope" itemtype="https://schema.org/Organization" class="brand-title" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                                    <?php echo esc_html(bloginfo('title')); ?>
                                </a>

                                <?php if (get_bloginfo('description')) { ?>
                                    <div class="brand-tagline"><?php echo esc_html(get_bloginfo( 'description' )); ?></div>
                                <?php } ?>
                            </div>
                            <?php } ?>
                        </div>
                        <?php if ( get_theme_mod('show_search', true) ) : ?>
                            <div class="header-action-items <?php echo ( get_theme_mod('show_search_mobile', true) ? '' : 'd-none d-sm-block' ); ?>">
                                <div class="header-search">
                                    <i class="fas fa-search"></i>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sticky Placeholder -->
        <div id="sticky-placeholder" style="height: 0;"></div>
        <!-- Header Menu -->
        <?php if ( has_nav_menu( 'primary-menu' ) ) : ?>
        <div class="header-menu <?php echo ( getOption('defaults', 'enable_sticky_header') == true ) ? 'enable-sticky-header' : '' ; ?>">
            <div class="big-container">
                <div class="main-menu navigation">
                    <div class="container">
                    <?php
                        wp_nav_menu( array(
                            'theme_location' => 'primary-menu',
                            'menu_id'        => 'primary-menu',
                            'menu_class'     => 'menu',
                            'walker' => new Mighty_Walker_Nav_Menu()
                        ) );
                    ?>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</header>