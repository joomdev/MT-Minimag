<?php
//
// ─── STYLES FOR LIVE-PREVIEW ────────────────────────────────────────────────────
//

function mtminimag_customizer_css()
{
    ?>
        <style type="text/css">

            :root {
                --preloader-color: <?php echo getOption('colors', 'color_preloader'); ?>;
                --preloader-size: <?php echo getOption('defaults', 'preloader_size'); ?>px;
                --backtotop-size: <?php echo getOption('defaults', 'backtotop_size'); ?>px;

                --site-color: <?php echo getOption('colors', 'color_site'); ?>;
                --primary-color: <?php echo getOption('colors', 'color_primary'); ?>;
                --header-text-color: <?php echo getOption('colors', 'color_header_text'); ?>;
                --body-bg-color: <?php echo getOption('colors', 'color_background'); ?>;

                --body-bg-img: url(<?php echo esc_html(get_theme_mod('background_image', '')); ?>);
                --body-bg-size: <?php echo esc_html(get_theme_mod('background_size', '')); ?>;
                --body-bg-position: <?php echo esc_html(get_theme_mod('background_position', '')); ?>;
                --body-bg-repeat: <?php echo esc_html(get_theme_mod('background_repeat', '')); ?>;
                --body-bg-attachment: <?php echo esc_html(get_theme_mod('background_attachment', '')); ?>;

                --link-color: <?php echo getOption('colors', 'color_menu'); ?>;
                --link-hover-color: <?php echo getOption('colors', 'color_menu_hover'); ?>;
                --link-active-color: <?php echo getOption('colors', 'color_menu_active'); ?>;

                --drop-down-bg: <?php echo getOption('colors', 'color_dropdown_background'); ?>;

                --drop-down-link-color: <?php echo getOption('colors', 'color_dropdown_link'); ?>;

                --drop-down-active-link-color: <?php echo getOption('colors', 'color_dropdown_activelink'); ?>;
                --drop-down-hover-link-color: <?php echo getOption('colors', 'color_link_hover'); ?>;

                --sidebar-width: <?php echo getOption('defaults', 'sidebar_width'); ?>px;

                --copyright-hover: <?php echo getOption('colors', 'color_copyright_linkhover'); ?>;

                --footer-bg-color: <?php echo getOption('colors', 'color_footer_background'); ?>;

                --offcanvas-width: <?php echo getOption('defaults', 'offcanvas_width') ?>px;
                --offcanvas-text-color: <?php echo getOption('colors', 'color_offcanvas') ?>;
                --offcanvas-bg: <?php echo getOption('colors', 'color_offcanvas_bg') ?>;
            }            

            body.custom-background {
                background-color: var(--body-bg-color);
            }
            
            body {
                background-image: var(--body-bg-img);
                background-size: var(--body-bg-size);
                background-position: var(--body-bg-position);
                background-repeat: var(--body-bg-repeat);
                background-attachment: var(--body-bg-attachment);

                background-color: var(--body-bg-color);
                color: var(--site-color);

                font-family: <?php echo getOption('fonts', 'body_fontfamily'); ?>, <?php echo getOption('fonts', 'body_alt_fontfamily'); ?>;
                font-size: <?php echo getOption('fonts', 'body_fontsize'); ?><?php echo getOption('fonts', 'body_fontsize_unit'); ?>;
                text-transform: <?php echo getOption('fonts', 'body_texttransform'); ?>;
                letter-spacing: <?php echo getOption('fonts', 'body_letterspacing'); ?>px;
                font-weight: <?php echo getOption('fonts', 'body_fontweight'); ?>;
                line-height: <?php echo getOption('fonts', 'body_lineheight'); ?>px;
            }

            .big-container {
                background-color: <?php echo getOption('colors', 'color_boxed_background'); ?>;
            }

            /* Navigation */
            #primary-menu li a {
                color: var(--link-color);
            }

            #primary-menu li a:hover {
                color: var(--link-hover-color);
            }

            #primary-menu li.current-menu-item a {
                color: var(--link-active-color);
            }

            #primary-menu li.current-menu-item a,
            #primary-menu li.current_page_item a {
                color: var(--link-active-color);
            }

            /* Navigation Dropdown */
            ul#primary-menu ul.sub-menu li.menu-item {
                background-color: var(--drop-down-bg);
            }

            ul#primary-menu ul.sub-menu li.menu-item a {
                color: var(--drop-down-link-color);
            }

            ul#primary-menu ul.sub-menu li.menu-item.current-menu-item a {
                color: var(--drop-down-active-link-color);
            }

            ul#primary-menu ul.sub-menu li.menu-item a:hover {
                color: var(--drop-down-hover-link-color);
            }

            .mt-logo-text .brand-tagline {
                color: var(--header-text-color);
            }

            /* Copyright */
            .footer a {
                color: <?php echo getOption('colors', 'color_copyright_link'); ?>;
            }

            .footer a:hover {
                color: var(--copyright-hover);
            }

            .footer {
                background-color: <?php echo getOption('colors', 'color_copyright_bg'); ?>;
            }

            /* Typography */
            h1 {
                font-family: <?php echo getOption('fonts', 'h1_fontfamily'); ?>, <?php echo getOption('fonts', 'h1_alt_fontfamily'); ?>;
                font-size: <?php echo getOption('fonts', 'h1_fontsize'); ?><?php echo getOption('fonts', 'h1_fontsize_unit'); ?>;
                text-transform: <?php echo getOption('fonts', 'h1_texttransform'); ?>;
                letter-spacing: <?php echo getOption('fonts', 'h1_letterspacing'); ?>px;
                font-weight: <?php echo getOption('fonts', 'h1_fontweight'); ?>;
                line-height: <?php echo getOption('fonts', 'h1_lineheight'); ?>px;
            }
            
            h2 {
                font-family: <?php echo getOption('fonts', 'h2_fontfamily'); ?>, <?php echo getOption('fonts', 'h2_alt_fontfamily'); ?>;
                font-size: <?php echo getOption('fonts', 'h2_fontsize'); ?><?php echo getOption('fonts', 'h2_fontsize_unit'); ?>;
                text-transform: <?php echo getOption('fonts', 'h2_texttransform'); ?>;
                letter-spacing: <?php echo getOption('fonts', 'h2_letterspacing'); ?>px;
                font-weight: <?php echo getOption('fonts', 'h2_fontweight'); ?>;
                line-height: <?php echo getOption('fonts', 'h2_lineheight'); ?>px;
            }

            h3 {
                font-family: <?php echo getOption('fonts', 'h3_fontfamily'); ?>, <?php echo getOption('fonts', 'h3_alt_fontfamily'); ?>;
                font-size: <?php echo getOption('fonts', 'h3_fontsize'); ?><?php echo getOption('fonts', 'h3_fontsize_unit'); ?>;
                text-transform: <?php echo getOption('fonts', 'h3_texttransform'); ?>;
                letter-spacing: <?php echo getOption('fonts', 'h3_letterspacing'); ?>px;
                font-weight: <?php echo getOption('fonts', 'h3_fontweight'); ?>;
                line-height: <?php echo getOption('fonts', 'h3_lineheight'); ?>px;
            }

            h4 {
                font-family: <?php echo getOption('fonts', 'h4_fontfamily'); ?>, <?php echo getOption('fonts', 'h4_alt_fontfamily'); ?>;
                font-size: <?php echo getOption('fonts', 'h4_fontsize'); ?><?php echo getOption('fonts', 'h4_fontsize_unit'); ?>;
                text-transform: <?php echo getOption('fonts', 'h4_texttransform'); ?>;
                letter-spacing: <?php echo getOption('fonts', 'h4_letterspacing'); ?>px;
                font-weight: <?php echo getOption('fonts', 'h4_fontweight'); ?>;
                line-height: <?php echo getOption('fonts', 'h4_lineheight'); ?>px;
            }

            h5 {
                font-family: <?php echo getOption('fonts', 'h5_fontfamily'); ?>, <?php echo getOption('fonts', 'h5_alt_fontfamily'); ?>;
                font-size: <?php echo getOption('fonts', 'h5_fontsize'); ?><?php echo getOption('fonts', 'h5_fontsize_unit'); ?>;
                text-transform: <?php echo getOption('fonts', 'h5_texttransform'); ?>;
                letter-spacing: <?php echo getOption('fonts', 'h5_letterspacing'); ?>px;
                font-weight: <?php echo getOption('fonts', 'h5_fontweight'); ?>;
                line-height: <?php echo getOption('fonts', 'h5_lineheight'); ?>px;
            }

            h6 {
                font-family: <?php echo getOption('fonts', 'h6_fontfamily'); ?>, <?php echo getOption('fonts', 'h6_alt_fontfamily'); ?>;
                font-size: <?php echo getOption('fonts', 'h6_fontsize'); ?><?php echo getOption('fonts', 'h6_fontsize_unit'); ?>;
                text-transform: <?php echo getOption('fonts', 'h6_texttransform'); ?>;
                letter-spacing: <?php echo getOption('fonts', 'h6_letterspacing'); ?>px;
                font-weight: <?php echo getOption('fonts', 'h6_fontweight'); ?>;
                line-height: <?php echo getOption('fonts', 'h6_lineheight'); ?>px;
            }

            .mt-logo-text .brand-title {
                color: <?php echo getOption('colors', 'color_logo_text'); ?>;

                font-family: <?php echo getOption('fonts', 'logo_fontfamily'); ?>, <?php echo getOption('fonts', 'logo_alt_fontfamily'); ?>;
                font-size: <?php echo getOption('fonts', 'logo_fontsize'); ?><?php echo getOption('fonts', 'logo_fontsize_unit'); ?>;
                text-transform: <?php echo getOption('fonts', 'logo_texttransform'); ?>;
                letter-spacing: <?php echo getOption('fonts', 'logo_letterspacing'); ?>px;
                font-weight: <?php echo getOption('fonts', 'logo_fontweight'); ?>;
                line-height: <?php echo getOption('fonts', 'logo_lineheight'); ?>px;
            }

            /* Main menu */
            ul#primary-menu li.menu-item {
                font-family: <?php echo getOption('fonts', 'mainmenu_fontfamily'); ?>, <?php echo getOption('fonts', 'mainmenu_alt_fontfamily'); ?>;
                font-size: <?php echo getOption('fonts', 'mainmenu_fontsize'); ?><?php echo getOption('fonts', 'mainmenu_fontsize_unit'); ?>;
                text-transform: <?php echo getOption('fonts', 'mainmenu_texttransform'); ?>;
                letter-spacing: <?php echo getOption('fonts', 'mainmenu_letterspacing'); ?>px;
                font-weight: <?php echo getOption('fonts', 'mainmenu_fontweight'); ?>;
                line-height: <?php echo getOption('fonts', 'mainmenu_lineheight'); ?>px;
            }

            /* Sub Menu */
            ul#primary-menu ul.sub-menu li.menu-item {
                font-family: <?php echo getOption('fonts', 'dropdown_fontfamily'); ?>, <?php echo getOption('fonts', 'dropdown_alt_fontfamily'); ?>;
                font-size: <?php echo getOption('fonts', 'dropdown_fontsize'); ?><?php echo getOption('fonts', 'dropdown_fontsize_unit'); ?>;
                text-transform: <?php echo getOption('fonts', 'dropdown_texttransform'); ?>;
                letter-spacing: <?php echo getOption('fonts', 'dropdown_letterspacing'); ?>px;
                font-weight: <?php echo getOption('fonts', 'dropdown_fontweight'); ?>;
                line-height: <?php echo getOption('fonts', 'dropdown_lineheight'); ?>px;
            }

            /* Single Post title */
            .single-post-title {
                font-family: <?php echo getOption('fonts', 'posttitle_fontfamily'); ?>, <?php echo getOption('fonts', 'posttitle_alt_fontfamily'); ?>;
                font-size: <?php echo getOption('fonts', 'posttitle_fontsize'); ?><?php echo getOption('fonts', 'posttitle_fontsize_unit'); ?>;
                text-transform: <?php echo getOption('fonts', 'posttitle_texttransform'); ?>;
                letter-spacing: <?php echo getOption('fonts', 'posttitle_letterspacing'); ?>px;
                font-weight: <?php echo getOption('fonts', 'posttitle_fontweight'); ?>;
                line-height: <?php echo getOption('fonts', 'posttitle_lineheight'); ?>px;
            }

            /* Archive Post Title */
            .entry-title,
            .blog-item-title {
                font-family: <?php echo getOption('fonts', 'entrytitle_fontfamily'); ?>, <?php echo getOption('fonts', 'entrytitle_alt_fontfamily'); ?>;
                font-size: <?php echo getOption('fonts', 'entrytitle_fontsize'); ?><?php echo getOption('fonts', 'entrytitle_fontsize_unit'); ?>;
                text-transform: <?php echo getOption('fonts', 'entrytitle_texttransform'); ?>;
                letter-spacing: <?php echo getOption('fonts', 'entrytitle_letterspacing'); ?>px;
                font-weight: <?php echo getOption('fonts', 'entrytitle_fontweight'); ?>;
                line-height: <?php echo getOption('fonts', 'entrytitle_lineheight'); ?>px;
            }

            /* Meta Typography */
            .entry-meta li,
            .category-meta {
                font-family: <?php echo getOption('fonts', 'meta_fontfamily'); ?>, <?php echo getOption('fonts', 'meta_alt_fontfamily'); ?>;
                font-size: <?php echo getOption('fonts', 'meta_fontsize'); ?><?php echo getOption('fonts', 'meta_fontsize_unit'); ?>;
                text-transform: <?php echo getOption('fonts', 'meta_texttransform'); ?>;
                letter-spacing: <?php echo getOption('fonts', 'meta_letterspacing'); ?>px;
                font-weight: <?php echo getOption('fonts', 'meta_fontweight'); ?>;
                line-height: <?php echo getOption('fonts', 'meta_lineheight'); ?>px;
            }

            /* Widget Title */
            .widget-title {
                font-family: <?php echo getOption('fonts', 'widgettitle_fontfamily'); ?>, <?php echo getOption('fonts', 'widgettitle_alt_fontfamily'); ?>;
                font-size: <?php echo getOption('fonts', 'widgettitle_fontsize'); ?><?php echo getOption('fonts', 'widgettitle_fontsize_unit'); ?>;
                text-transform: <?php echo getOption('fonts', 'widgettitle_texttransform'); ?>;
                letter-spacing: <?php echo getOption('fonts', 'widgettitle_letterspacing'); ?>px;
                font-weight: <?php echo getOption('fonts', 'widgettitle_fontweight'); ?>;
                line-height: <?php echo getOption('fonts', 'widgettitle_lineheight'); ?>px;
            }

            .footer {
                color: <?php echo getOption('colors', 'color_copyright'); ?>;

                font-family: <?php echo getOption('fonts', 'copyright_fontfamily'); ?>, <?php echo getOption('fonts', 'copyright_alt_fontfamily'); ?>;
                font-size: <?php echo getOption('fonts', 'copyright_fontsize'); ?><?php echo getOption('fonts', 'copyright_fontsize_unit'); ?>;
                text-transform: <?php echo getOption('fonts', 'copyright_texttransform'); ?>;
                letter-spacing: <?php echo getOption('fonts', 'copyright_letterspacing'); ?>px;
                font-weight: <?php echo getOption('fonts', 'copyright_fontweight'); ?>;
                line-height: <?php echo getOption('fonts', 'copyright_lineheight'); ?>px;
            }

            /* Sidebar Width */
            @media (min-width: 992px) {
                body.has-sidebar .component-area-inner .sidebar {
                    max-width: var(--sidebar-width);
                }
            }

            /* Preloader Colors and Size */
            .sk-rotating-plane {
                width: var(--preloader-size);
	            height: var(--preloader-size);
                background-color: var(--preloader-color);
            }
            .sk-fading-circle {
                width: var(--preloader-size);
                height: var(--preloader-size);
            }
            .sk-fading-circle .sk-circle:before {
                background-color: var(--preloader-color);
            }
            .sk-folding-cube .sk-cube:before {
                background-color: var(--preloader-color);
            }
            .sk-folding-cube {
                width: var(--preloader-size);
                height: var(--preloader-size);
            }
            .sk-double-bounce .sk-child {
                background-color: var(--preloader-color);
            }
            .sk-double-bounce {
                width: var(--preloader-size);
                height: var(--preloader-size);
            }
            .sk-wave .sk-rect {
                background-color: var(--preloader-color);
            }
            .sk-wave {
                width: var(--preloader-size);
                height: var(--preloader-size);
            }
            .sk-wandering-cubes .sk-cube {
                background-color: var(--preloader-color);
                width: var(--preloader-size);
                height: var(--preloader-size);
            }
            .sk-spinner-pulse {
                background-color: var(--preloader-color);
                width: var(--preloader-size);
	            height: var(--preloader-size);
            }
            .sk-chasing-dots .sk-child {
                background-color: var(--preloader-color);
            }
            .sk-chasing-dots {
                width: var(--preloader-size);
                height: var(--preloader-size);
            }
            .sk-three-bounce .sk-child {
                background-color: var(--preloader-color);
                width: var(--preloader-size);
	            height: var(--preloader-size);
            }
            .sk-circle .sk-child:before {
                background-color: var(--preloader-color);
            }
            .sk-circle {
                width: var(--preloader-size);
                height: var(--preloader-size);
            }
            .sk-cube-grid .sk-cube {
                background-color: var(--preloader-color);
            }
            .sk-cube-grid {
                width: var(--preloader-size);
                height: var(--preloader-size);
            }
            .bouncing-loader>div {
                background: var(--preloader-color);
                width: var(--preloader-size);
	            height: var(--preloader-size);
            }
            .donut {
                border-left-color: var(--preloader-color);
                width: var(--preloader-size);
                height: var(--preloader-size);
            }
            
            /* Back to top */
            a#backtotop i {
                font-size: var(--backtotop-size);
                color: <?php echo getOption('colors', 'backtotop_color'); ?>;
                line-height: var(--backtotop-size);
            }
            a#backtotop {
                width: var(--backtotop-size);
                height: var(--backtotop-size);
                background: <?php echo getOption('colors', 'backtotop_bgcolor'); ?>;
                display: none;
            }

            .offcanvas-sidebar {
                width: var(--offcanvas-width);
                background-color: var(--offcanvas-bg);
            }
            .offcanvas-sidebar .topnav li a {
                color: var(--offcanvas-text-color);
            }

            .footer {
                background: var(--footer-bg-color);
            }            
        </style>
    <?php
}
add_action( 'wp_head', 'mtminimag_customizer_css');
