<?php
//
// ─── CUSTOMIZER CONTROLS ────────────────────────────────────────────────────────
//
function mtminimag_customize_register($wp_customize)
{
    // Google Web Fonts
    $googleFonts = getGoogleFonts();

    // Defaults
    $defaults = mt_get_defaults();
    $defaultColors = mt_get_color_defaults();
    $defaultFonts = mt_get_default_fonts();

    //
    // ─── CHECKING FOR CUSTOM SECTION AND CONTROLS STATUS ────────────────────────────
    //
    if ( method_exists( $wp_customize, 'register_section_type' ) ) {
        $wp_customize->register_section_type( 'Horizontal_Separator' );
    }

    $altFontFamily = array(
        "Arial" => "Arial",
        "Arial Black" => "Arial Black",
        "Bookman Old Style" => "Bookman Old Style",
        "Comic Sans MS" => "Comic Sans MS",
        "Courier" => "Courier",
        "Garamond" => "Garamond",
        "Georgia" => "Georgia",
        "Impact" => "Impact",
        "Lucida Console" => "Lucida Console",
        "Lucida Sans Unicode" => "Lucida Sans Unicode",
        "MS Sans Serif" => "MS Sans Serif",
        "MS Serif" => "MS Serif",
        "Palatino Linotype" => "Palatino Linotype",
        "Tahoma" => "Tahoma",
        "Times New Roman" => "Times New Roman",
        "Trebuchet MS" => "Trebuchet MS",
        "Verdana" => "Verdana"
    );

    // Removing WordPress Default Color Section
    $wp_customize->remove_section('colors');

    $wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

    //
    // ─── SEPARATOR FOR MIGHTYTHEMES OPTIONS ─────────────────────────────────────────
    //
    $wp_customize->add_section(
        new Horizontal_Separator( $wp_customize, 'Horizontal_Separator-MT_options',
            array(
                'pro_text' => __( 'MT Minimag Options', 'mtminimag' ),
                'type' => 'horizontal-separator',
                'priority' => 120,
            )
        )
    );

    // Enable/Disable Title and tagline fron site identity
    $wp_customize->add_setting('site_identity_status', array (
        'default' => $defaults['site_identity_status'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_checkbox'
    ));
    $wp_customize->add_control(
        'site_identity_status',
        array (
            'label' => __('Display Site Title and Tagline', 'mtminimag'),
            'section' => 'title_tagline',
            'type' => 'checkbox',
        )
    );

    //
    // ─── BASIC SETTINGS ─────────────────────────────────────────────────────────────
    //
    $wp_customize->add_panel('basic_settings', array (
        'title' => __( 'Basic Settings', 'mtminimag' ),
    ));
    
    //──── Preloader ───────────────────────────────────────────────────────────────────
    $wp_customize->add_section('preloader', array (
        'title' => __('Preloader', 'mtminimag'),
        'description' => '',
        'panel' => 'basic_settings',
    ));
    
    // Enable Preloader
	$wp_customize->add_setting( 'preloader_status', array(
        'default' => $defaults['preloader_status'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_checkbox'
    ));
    $wp_customize->add_control(
        new MightyThemes_Toggle_Switch_Custom_control(
        $wp_customize,
        'preloader_status',
        array(
            'label' => __( 'Enable Preloader', 'mtminimag' ),
            'section' => 'preloader'
        )
    ));

    // Types of preloader
    $wp_customize->add_setting( 'preloader_type', array(
        'default' => $defaults['preloader_type'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'mtminimag_sanitize_select'
    ));

    $wp_customize->add_control(
        new MightyThemes_Preloaders_Custom_Control(
        $wp_customize,
        'preloader_type',
        array(
            'label' => __( 'Choose Preloader', 'mtminimag' ),
            'section' => 'preloader',
            'choices' => array(
                'rotating-plane' => array(
                    'code' => '<div class="sk-rotating-plane"></div>',                
                ),
                'fading-circle' => array(
                    'code' => '<div class="sk-fading-circle">
                        <div class="sk-circle1 sk-circle"></div>
                        <div class="sk-circle2 sk-circle"></div>
                        <div class="sk-circle3 sk-circle"></div>
                        <div class="sk-circle4 sk-circle"></div>
                        <div class="sk-circle5 sk-circle"></div>
                        <div class="sk-circle6 sk-circle"></div>
                        <div class="sk-circle7 sk-circle"></div>
                        <div class="sk-circle8 sk-circle"></div>
                        <div class="sk-circle9 sk-circle"></div>
                        <div class="sk-circle10 sk-circle"></div>
                        <div class="sk-circle11 sk-circle"></div>
                        <div class="sk-circle12 sk-circle"></div>
                    </div>',
                    
                ),

                'folding-cube' => array(
                    'code' => '<div class="sk-folding-cube">
                        <div class="sk-cube1 sk-cube"></div>
                        <div class="sk-cube2 sk-cube"></div>
                        <div class="sk-cube4 sk-cube"></div>
                        <div class="sk-cube3 sk-cube"></div>
                    </div>',
                    
                ),
                'double-bounce' => array(
                    'code' => '<div class="sk-double-bounce">
                        <div class="sk-child sk-double-bounce1"></div>
                        <div class="sk-child sk-double-bounce2"></div>
                    </div>',
                    
                ),
                'wave' => array(
                    'code' => '<div class="sk-wave">
                        <div class="sk-rect sk-rect1"></div>
                        <div class="sk-rect sk-rect2"></div>
                        <div class="sk-rect sk-rect3"></div>
                        <div class="sk-rect sk-rect4"></div>
                        <div class="sk-rect sk-rect5"></div>
                    </div>',
                    
                ),
                'wandering-cubes' => array(
                    'code' => '<div class="sk-wandering-cubes">
                        <div class="sk-cube sk-cube1"></div>
                        <div class="sk-cube sk-cube2"></div>
                    </div>',
                    
                ),
                'pulse' => array(
                    'code' => '<div class="sk-spinner sk-spinner-pulse"></div>',
                    
                ),
                'chasing-dots' => array(
                    'code' => '<div class="sk-chasing-dots">
                        <div class="sk-child sk-dot1"></div>
                        <div class="sk-child sk-dot2"></div>
                    </div>',
                    
                ),
                'circle' => array(
                    'code' => '<div class="sk-circle">
                        <div class="sk-circle1 sk-child"></div>
                        <div class="sk-circle2 sk-child"></div>
                        <div class="sk-circle3 sk-child"></div>
                        <div class="sk-circle4 sk-child"></div>
                        <div class="sk-circle5 sk-child"></div>
                        <div class="sk-circle6 sk-child"></div>
                        <div class="sk-circle7 sk-child"></div>
                        <div class="sk-circle8 sk-child"></div>
                        <div class="sk-circle9 sk-child"></div>
                        <div class="sk-circle10 sk-child"></div>
                        <div class="sk-circle11 sk-child"></div>
                        <div class="sk-circle12 sk-child"></div>
                    </div>',
                    
                ),
                'cube-grid' => array(
                    'code' => '<div class="sk-cube-grid">
                        <div class="sk-cube sk-cube1"></div>
                        <div class="sk-cube sk-cube2"></div>
                        <div class="sk-cube sk-cube3"></div>
                        <div class="sk-cube sk-cube4"></div>
                        <div class="sk-cube sk-cube5"></div>
                        <div class="sk-cube sk-cube6"></div>
                        <div class="sk-cube sk-cube7"></div>
                        <div class="sk-cube sk-cube8"></div>
                        <div class="sk-cube sk-cube9"></div>
                    </div>',
                    
                ),
                'donut' => array(
                    'code' => '<div class="donut"></div>',
                    
                ),
                'bouncing-loader' => array(
                    'code' => '<div class="bouncing-loader">
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>',                    
                ),
                'three-bounce' => array(
                    'code' => '<div class="sk-three-bounce">
                        <div class="sk-child sk-bounce1"></div>
                        <div class="sk-child sk-bounce2"></div>
                        <div class="sk-child sk-bounce3"></div>
                    </div>',                    
                ),
                
            )
        )
    ));
    
    // Preloader Color
    $wp_customize->add_setting('color_preloader', array (
        'default' => $defaultColors['color_preloader'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
        $wp_customize,
        'color_preloader',
        array(
            'label'      => __( 'Preloader Color', 'mtminimag' ),
            'section'    => 'preloader',
        ) )
    );
    // Preloader size
    $wp_customize->add_setting( 'preloader_size', array(
        'default' => $defaults['preloader_size'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'mtminimag_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'preloader_size',
        array(
            'label' => __( 'Preloader Size', 'mtminimag' ),
            'section' => 'preloader',
            'input_attrs' => array(
                'min' => 1,
                'max' => 500,
                'step' => 1,
                'default' => $defaults['preloader_size'],
            ),
        )
    ));
    //──── Back to top ───────────────────────────────────────────────────────────────────────
    $wp_customize->add_section('backtotop', array (
        'title' => __('Back To Top', 'mtminimag'),
        'description' => '',
        'panel' => 'basic_settings',
    ));
    // Back to top (Enable/Disable)    
    $wp_customize->add_setting( 'backtotop_status', array(
        'default' => $defaults['backtotop_status'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_checkbox'
    ));
    $wp_customize->add_control(
        new MightyThemes_Toggle_Switch_Custom_control(
        $wp_customize,
        'backtotop_status',
        array(
            'label' => __( 'Enable Back To Top', 'mtminimag' ),
            'section' => 'backtotop'
        )
    ));

    // Icons for Back to top
    $wp_customize->add_setting('backtotop_icon', array (
        'default' => $defaults['backtotop_icon'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_select'
    ));
    $wp_customize->add_control( 'backtotop_icon', array(
        'label' => __('Choose Icon for button', 'mtminimag'),
        'section' => 'backtotop',
        'type' => 'select',
        'choices' => array(
            'fas fa-long-arrow-alt-up' => "Alternate Long Arrow Up",
            'fas fa-arrow-up' => 'Arrow Up',
            'fas fa-arrow-circle-up' => 'Arrow Cicle Up',
            'fas fa-arrow-alt-circle-up' => 'Alternate Arrow Circle Up',
            'fas fa-angle-double-up' => 'Angle Double Up',
            'fas fa-sort-up' => 'Sort Up (Ascending)',
            'fas fa-level-up-alt' => 'Level Up Alternate',
            'fas fa-chevron-up' => 'Chevron Up',
            'fas fa-chevron-circle-up' => 'Chevron Circle Up',
            'fas fa-hand-point-up' => 'Hand Pointing Up (Solid)',
            'far fa-hand-point-up' => 'Hand Pointing Up (Regular)',
            'fas fa-caret-square-up' => 'Caret Square Up (Solid)',
            'far fa-caret-square-up' => 'Caret Square Up (Regular)',
        ),
    ));
    // Back to top font size
    $wp_customize->add_setting( 'backtotop_size', array(
        'default' => $defaults['backtotop_size'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'mtminimag_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'backtotop_size',
        array(
            'label' => __( 'Back To Top Size', 'mtminimag' ),
            'section' => 'backtotop',
            'input_attrs' => array(
                'min' => 1,
                'max' => 200 ,
                'step' => 1,
                'default' => $defaults['backtotop_size'],
            ),
        )
    ));
    // Back to top font color
    $wp_customize->add_setting('backtotop_color', array (
        'default' => $defaultColors['backtotop_color'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
        $wp_customize,
        'backtotop_color',
        array(
            'label' => __( 'Back To Top Color', 'mtminimag' ),
            'section' => 'backtotop',
        ) )
    );
    // Back to top Background color
    $wp_customize->add_setting('backtotop_bgcolor', array (
        'default' => $defaultColors['backtotop_bgcolor'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
        $wp_customize,
        'backtotop_bgcolor',
        array(
            'label' => __( 'Back To Top Background Color', 'mtminimag' ),
            'section' => 'backtotop',
        ) )
    );
    // Back to top shape
    $wp_customize->add_setting('backtotop_shape', array (
        'default' => $defaults['backtotop_shape'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_select'
    ));

    $wp_customize->add_control('backtotop_shape', array (
        'label' => __('Shape', 'mtminimag'),
        'description' => __('Shape of Back To Top', 'mtminimag'),
        'type' => 'select',
        'section' => 'backtotop',
        'choices' => array(
            'square' => 'Square',
            'rounded' => 'Rounded',
            'circle' => 'Circle',
        ),
    ));
    // Enable Back to top on mobile
    $wp_customize->add_setting( 'backtotop_mobile', array(
        'default' => $defaults['backtotop_mobile'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'mtminimag_sanitize_checkbox'
    ));
    $wp_customize->add_control(
        new MightyThemes_Toggle_Switch_Custom_control(
        $wp_customize,
        'backtotop_mobile',
        array(
            'label' => __( 'Hide on Mobile', 'mtminimag' ),
            'description' => __('Show/Hide the button on mobile view.', 'mtminimag'),
            'section' => 'backtotop'
        )
    ));

    //──── Slider ───────────────────────────────────────────────────────────────────────
    $wp_customize->add_section('slider', array (
        'title' => __('Slider', 'mtminimag'),
        'description' => '',
        'panel' => 'basic_settings',
    ));
    // Back to top (Enable/Disable)    
    $wp_customize->add_setting( 'enable_slider', array(
        'default' => $defaults['enable_slider'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_checkbox'
    ));
    $wp_customize->add_control(
        new MightyThemes_Toggle_Switch_Custom_control(
        $wp_customize,
        'enable_slider',
        array(
            'label' => __( 'Enable Slider', 'mtminimag' ),
            'section' => 'slider'
        )
    ));

    $wp_customize->add_setting('category_type', array (
        'transport' => 'refresh',
        'default' => $defaults['category_type'],
        'sanitize_callback' => 'custom_sanitize_category',
    ));
    $wp_customize->add_control( 'category_type', array (
        'label' => __('Select Category', 'mtminimag'),
        'section' => 'slider',
        'type' => 'select',
        'choices' => getCategories(),
    ));

    $wp_customize->add_setting( 'no_of_posts', array(
        'default' => $defaults['no_of_posts'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_number'
    ));
    
    $wp_customize->add_control( 'no_of_posts', array(
        'label' => __('Number of Posts', 'mtminimag'),
        'section' => 'slider',
        'type' => 'number',
        'input_attrs' => array(
            'min' => 1,
            'max' => 1000,
            'step' => 1,
        ),
    ));

    $wp_customize->add_setting('sort_posts', array (
        'transport' => 'refresh',
        'default' => $defaults['sort_posts'],
        'sanitize_callback' => 'mtminimag_sanitize_select',
    ));
    $wp_customize->add_control( 'sort_posts', array (
        'label' => __('Sort Posts By', 'mtminimag'),
        'section' => 'slider',
        'type' => 'select',
        'choices' => array(
            'latest' => 'Latest Posts',
            'popular' => 'Popular Posts',
        ),
    ));

    //──── Offcanvas ───────────────────────────────────────────────────────────────────────
    $wp_customize->add_section('offcanvas_menu', array (
        'title' => __('Offcanvas Menu', 'mtminimag'),
        'description' => '',
        'panel' => 'basic_settings',
    ));
    // Offcanvas (Enable/Disable)    
    $wp_customize->add_setting( 'enable_offcanvas', array(
        'default' => $defaults['enable_offcanvas'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_checkbox'
    ));
    $wp_customize->add_control(
        new MightyThemes_Toggle_Switch_Custom_control(
        $wp_customize,
        'enable_offcanvas',
        array(
            'label' => __( 'Enable Offcanvas', 'mtminimag' ),
            'section' => 'offcanvas_menu'
        )
    ));

    $wp_customize->add_setting( 'offcanvas_width', array(
        'default' => $defaults['offcanvas_width'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'mtminimag_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'offcanvas_width',
        array(
            'label' => __( 'Offcanvas Width', 'mtminimag' ),
            'section' => 'offcanvas_menu',
            'input_attrs' => array(
                'min' => 1,
                'max' => 500,
                'step' => 1,
                'default' => $defaults['offcanvas_width'],
            ),
        )
    ));

    $wp_customize->add_setting('color_offcanvas', array (
        'default' => $defaultColors['color_offcanvas'],
        'transport'   => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
        $wp_customize,
        'color_offcanvas',
        array(
            'label'      => __( 'Offcanvas Color', 'mtminimag' ),
            'section'    => 'offcanvas_menu',
        ) )
    );

    $wp_customize->add_setting('color_offcanvas_bg', array (
        'default' => $defaultColors['color_offcanvas_bg'],
        'transport'   => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
        $wp_customize,
        'color_offcanvas_bg',
        array(
            'label'      => __( 'Offcanvas Background Color', 'mtminimag' ),
            'section'    => 'offcanvas_menu',
        ) )
    );    

    //
    // ─── COLORS MANAGEMENT ──────────────────────────────────────────────────────────
    //
    $wp_customize->add_panel('colors_mgt', array (
        'title' => __( 'Colors Management', 'mtminimag'),
    ));

    $wp_customize->add_section('main_colors', array (
        'title' => __('Colors', 'mtminimag'),
        'panel' => 'colors_mgt',
    ));
    // Color controls
    $wp_customize->add_setting('color_primary', array (
        'default' => $defaultColors['color_primary'],
        'transport'   => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
        $wp_customize,
        'color_primary',
        array(
            'label'      => __( 'Primary Color', 'mtminimag' ),
            'section'    => 'main_colors',
        ) )
    );

    $wp_customize->add_setting('color_site', array (
        'default' => $defaultColors['color_site'],
        'transport'   => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
        $wp_customize,
        'color_site',
        array(
            'label'      => __( 'Site Color', 'mtminimag' ),
            'section'    => 'main_colors',
        ) )
    );

    $wp_customize->add_setting('color_anchor', array (
        'default' => $defaultColors['color_anchor'],
        'transport'   => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
        $wp_customize,
        'color_anchor',
        array(
            'label'      => __( 'Link Color', 'mtminimag' ),
            'section'    => 'main_colors',
        ) )
    );

    // Logo Color
    $wp_customize->add_section('logo_colors', array (
        'title' => __('Logo Color', 'mtminimag'),
        'panel' => 'colors_mgt',
    ));
    $wp_customize->add_setting('color_logo_text', array (
        'default' => $defaultColors['color_logo_text'],
        'transport'   => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
        $wp_customize,
        'color_logo_text',
        array(
            'label'      => __( 'Logo Text Color', 'mtminimag' ),
            'section'    => 'logo_colors',
        ) )
    );

    // Header Colors
    $wp_customize->add_section('header_colors', array (
        'title' => __('Header Color', 'mtminimag'),
        'panel' => 'colors_mgt',
    ));
    $wp_customize->add_setting('color_header_text', array (
        'default' => $defaultColors['color_header_text'],
        'transport'   => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
        $wp_customize,
        'color_header_text',
        array(
            'label'      => __( 'Header Text Color', 'mtminimag' ),
            'section'    => 'header_colors',
        ) )
    );

    // Background Color
    $wp_customize->add_section('background_colors', array (
        'title' => __('Background Color', 'mtminimag'),
        'panel' => 'colors_mgt',
    ));
    $wp_customize->add_setting('color_background', array (
        'default' => $defaultColors['color_background'],
        'transport'   => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
        $wp_customize,
        'color_background',
        array(
            'label'      => __( 'Background Color', 'mtminimag' ),
            'section'    => 'background_colors',
        ) )
    );

    $wp_customize->add_setting('color_boxed_background', array (
        'default' => $defaultColors['color_boxed_background'],
        'transport'   => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
        $wp_customize,
        'color_boxed_background',
        array(
            'label'      => __( 'Boxed Background Color', 'mtminimag' ),
            'section'    => 'background_colors',
        ) )
    );

    // Menu Colors
    $wp_customize->add_section('menu_colors', array (
        'title' => __('Menu Color', 'mtminimag'),
        'panel' => 'colors_mgt',
    ));
    $wp_customize->add_setting('color_menu', array (
        'default' => $defaultColors['color_menu'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
        $wp_customize,
        'color_menu',
        array(
            'label'      => __( 'Menu Color', 'mtminimag' ),
            'section'    => 'menu_colors',
        ) )
    );
    $wp_customize->add_setting('color_menu_hover', array (
        'default' => $defaultColors['color_menu_hover'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
        $wp_customize,
        'color_menu_hover',
        array(
            'label'      => __( 'Menu Hover Color', 'mtminimag' ),
            'section'    => 'menu_colors',
        ) )
    );
    $wp_customize->add_setting('color_menu_active', array (
        'default' => $defaultColors['color_menu_active'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
        $wp_customize,
        'color_menu_active',
        array(
            'label'      => __( 'Menu Active Color', 'mtminimag' ),
            'section'    => 'menu_colors',
        ) )
    );

    // Dropdown Colors
    $wp_customize->add_setting('color_dropdown_background', array (
        'default' => $defaultColors['color_dropdown_background'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
        $wp_customize,
        'color_dropdown_background',
        array(
            'label'      => __( 'Dropdown Background Color', 'mtminimag' ),
            'section'    => 'menu_colors',
        ) )
    );
    $wp_customize->add_setting('color_dropdown_link', array (
        'default' => $defaultColors['color_dropdown_link'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
        $wp_customize,
        'color_dropdown_link',
        array(
            'label'      => __( 'Dropdown Link Color', 'mtminimag' ),
            'section'    => 'menu_colors',
        ) )
    );
    $wp_customize->add_setting('color_dropdown_activelink', array (
        'default' => $defaultColors['color_dropdown_activelink'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
        $wp_customize,
        'color_dropdown_activelink',
        array(
            'label'      => __( 'Dropdown Active Link Color', 'mtminimag' ),
            'section'    => 'menu_colors',
        ) )
    );
    $wp_customize->add_setting('color_link_hover', array (
        'default' => $defaultColors['color_link_hover'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
        $wp_customize,
        'color_link_hover',
        array(
            'label'      => __( 'Dropdown Hover Link Color', 'mtminimag' ),
            'section'    => 'menu_colors',
        ) )
    );

    // Copyright's Colors
    $wp_customize->add_section('copyright_colors', array (
        'title' => __('Copyright Color', 'mtminimag'),
        'panel' => 'colors_mgt',
    ));
    $wp_customize->add_setting('color_copyright', array (
        'default' => $defaultColors['color_copyright'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
        $wp_customize,
        'color_copyright',
        array(
            'label'      => __( 'Copyright Color', 'mtminimag' ),
            'section'    => 'copyright_colors',
        ) )
    );
    
    $wp_customize->add_setting('color_copyright_link', array (
        'default' => $defaultColors['color_copyright_link'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
        $wp_customize,
        'color_copyright_link',
        array(
            'label'      => __( 'Copyright Link Color', 'mtminimag' ),
            'section'    => 'copyright_colors',
        ) )
    );
    // Link hover
    $wp_customize->add_setting('color_copyright_linkhover', array (
        'default' => $defaultColors['color_copyright_linkhover'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
        $wp_customize,
        'color_copyright_linkhover',
        array(
            'label'      => __( 'Copyright Link Hover Color', 'mtminimag' ),
            'section'    => 'copyright_colors',
        ) )
    );
    // Copyright BG color
    $wp_customize->add_setting('color_copyright_bg', array (
        'default' => $defaultColors['color_copyright_bg'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
        $wp_customize,
        'color_copyright_bg',
        array(
            'label'      => __( 'Copyright Background Color', 'mtminimag' ),
            'section'    => 'copyright_colors',
        ) )
    );

    //
    // ─── TYPOGRAPHY MANAGEMENT ──────────────────────────────────────────────────────
    //
    $wp_customize->add_panel('typography_mgt', array (
        'title' => __( 'Typography Management', 'mtminimag' ),
    ));

    // Body Typography Management
    $wp_customize->add_section('body_typography', array (
        'title' => __('Body', 'mtminimag'),
        'description' => 'Manage fonts for your website\'s Body',
        'panel' => 'typography_mgt',
    ));

    $wp_customize->add_setting('body_fontfamily', array (
        'transport' => 'refresh',
        'default' => $defaultFonts['body_fontfamily'],
        'sanitize_callback' => 'custom_sanitize_fonts',
    ));
    $wp_customize->add_control( 'body_fontfamily', array (
        'label' => __('Font Family', 'mtminimag'),
        'section' => 'body_typography',
        'type' => 'select',
        'choices' => $googleFonts,
    ));

    $wp_customize->add_setting( 'body_fontsize', array(
        'default' => $defaultFonts['body_fontsize'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'body_fontsize',
        array(
            'label' => __( 'Font Size', 'mtminimag' ),
            'section' => 'body_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $defaultFonts['body_fontsize'],
            ),
        )
    ));

    $wp_customize->add_setting('body_fontsize_unit', array (
        'default' => $defaultFonts['body_fontsize_unit'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_select'
    ));
    $wp_customize->add_control( 'body_fontsize_unit', array(
        'section' => 'body_typography',
        'type' => 'radio',
        'choices' => array(
            'px' => 'px',
            'em' => 'em',
        ),
    ));

    $wp_customize->add_setting('body_texttransform', array (
        'default' => $defaultFonts['body_texttransform'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_select'
    ));
    $wp_customize->add_control( 'body_texttransform', array (
        'label' => __('Text Transform', 'mtminimag'),
        'section' => 'body_typography',
        'type' => 'select',
        'choices' => array (
            'none' => 'None',
            'uppercase' => 'UPPERCASE',
            'lowercase' => 'lowercase',
            'capitalize' => 'Capitalize'
        ),
    ));

    $wp_customize->add_setting('body_alt_fontfamily', array (
        'transport' => 'refresh',
        'default' => $defaultFonts['body_alt_fontfamily'],
        'sanitize_callback' => 'mtminimag_sanitize_select',
    ));
    $wp_customize->add_control( 'body_alt_fontfamily', array (
        'label' => __('Alt Font Family', 'mtminimag'),
        'section' => 'body_typography',
        'type' => 'select',
        'choices' => $altFontFamily,
    ));

    $wp_customize->add_setting( 'body_letterspacing', array(
        'default' => $defaultFonts['body_letterspacing'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'body_letterspacing',
        array(
            'label' => __( 'Letter Spacing (px)', 'mtminimag' ),
            'section' => 'body_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $defaultFonts['body_letterspacing'],
            ),
        )
    ));

    $wp_customize->add_setting('body_fontweight', array (
        'default' => $defaultFonts['body_fontweight'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_select'
    ));
    $wp_customize->add_control( 'body_fontweight', array (
        'label' => __('Font Weight', 'mtminimag'),
        'section' => 'body_typography',
        'type' => 'select',
        'choices' => array (
            'normal' => 'normal',
            '100' => '100',
            '200' => '200',
            '300' => '300',
            '400' => '400',
            '500' => '500',
            '600' => '600',
            '700' => '700',
            '800' => '800',
            '900' => '900',
        ),
    ));

    $wp_customize->add_setting( 'body_lineheight', array(
        'default' => $defaultFonts['body_lineheight'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'body_lineheight',
        array(
            'label' => __( 'Line Height (px)', 'mtminimag' ),
            'section' => 'body_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $defaultFonts['body_lineheight'],
            ),
        )
    ));

    //
    // ──────────────────────────────────────────────────────────────────────────── I ──────────
    //   :::::: H E A D I N G   T Y P O G R A P H Y : :  :   :    :     :        :          :
    // ──────────────────────────────────────────────────────────────────────────────────────
    //

    $wp_customize->add_section('heading_typography', array (
        'title' => __('Headings', 'mtminimag'),
        'description' => 'Manage typography for H1 - h6',
        'panel' => 'typography_mgt',
    ));

    // Separator for H1 headings
    $wp_customize->add_setting( 'h1_separator', array(
        'default' => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_separator'
    ));
    $wp_customize->add_control(
        new MightyThemes_Separator_Custom_Control( 
        $wp_customize, 
        'h1_separator',
        array(
            'label' => __( 'Heading 1', 'mtminimag' ),
            'section' => 'heading_typography',
        )
    ));
    /* Heading 1 */
    $wp_customize->add_setting('h1_fontfamily', array (
        'transport' => 'refresh',
        'default' => $defaultFonts['h1_fontfamily'],
        'sanitize_callback' => 'custom_sanitize_fonts',
    ));
    $wp_customize->add_control( 'h1_fontfamily', array (
        'label' => __('Font Family', 'mtminimag'),
        'section' => 'heading_typography',
        'type' => 'select',
        'choices' => $googleFonts,
    ));

    $wp_customize->add_setting( 'h1_fontsize', array(
        'default' => $defaultFonts['h1_fontsize'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'h1_fontsize',
        array(
            'label' => __( 'Font Size', 'mtminimag' ),
            'section' => 'heading_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => 40,
            ),
        )
    ));

    $wp_customize->add_setting('h1_fontsize_unit', array (
        'default' => $defaultFonts['h1_fontsize_unit'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_select'
    ));
    $wp_customize->add_control( 'h1_fontsize_unit', array (
        'section' => 'heading_typography',
        'type' => 'radio',
        'choices' => array(
            'px' => 'px',
            'em' => 'em',
        ),
    ));

    $wp_customize->add_setting('h1_texttransform', array (
        'default' => $defaultFonts['h1_texttransform'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_select'
    ));
    $wp_customize->add_control( 'h1_texttransform', array (
        'label' => __('Text Transform', 'mtminimag'),
        'section' => 'heading_typography',
        'type' => 'select',
        'choices' => array (
            'none' => 'None',
            'uppercase' => 'UPPERCASE',
            'lowercase' => 'lowercase',
            'capitalize' => 'Capitalize'
        ),
    ));

    $wp_customize->add_setting('h1_alt_fontfamily', array (
        'default' => $defaultFonts['h1_alt_fontfamily'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_select'
    ));
    $wp_customize->add_control( 'h1_alt_fontfamily', array (
        'label' => __('Alt Font Family', 'mtminimag'),
        'section' => 'heading_typography',
        'type' => 'select',
        'choices' => $altFontFamily,
    ));

    $wp_customize->add_setting( 'h1_letterspacing', array(
        'default' => $defaultFonts['h1_letterspacing'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'h1_letterspacing',
        array(
            'label' => __( 'Letter Spacing (px)', 'mtminimag' ),
            'section' => 'heading_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $defaultFonts['h1_letterspacing'],
            ),
        )
    ));

    $wp_customize->add_setting('h1_fontweight', array (
        'default' => $defaultFonts['h1_fontweight'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_select'
    ));
    $wp_customize->add_control( 'h1_fontweight', array (
        'label' => __('Font Weight', 'mtminimag'),
        'section' => 'heading_typography',
        'type' => 'select',
        'choices' => array (
            'normal' => 'normal',
            '100' => '100',
            '200' => '200',
            '300' => '300',
            '400' => '400',
            '500' => '500',
            '600' => '600',
            '700' => '700',
            '800' => '800',
            '900' => '900',
        ),
    ));

    $wp_customize->add_setting( 'h1_lineheight', array(
        'default' => $defaultFonts['h1_lineheight'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'h1_lineheight',
        array(
            'label' => __( 'Line Height (px)', 'mtminimag' ),
            'section' => 'heading_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $defaultFonts['h1_lineheight'],
            ),
        )
    ));

    // Separator for H2 headings
    $wp_customize->add_setting( 'h2_separator', array(
        'default' => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_separator'
    ));
    $wp_customize->add_control(
        new MightyThemes_Separator_Custom_Control( 
        $wp_customize, 
        'h2_separator',
        array(
            'label' => __( 'Heading 2', 'mtminimag' ),
            'section' => 'heading_typography',
        )
    ));
    /* Heading 2 */
    $wp_customize->add_setting('h2_fontfamily', array (
        'transport' => 'refresh',
        'default' => $defaultFonts['h2_fontfamily'],
        'sanitize_callback' => 'custom_sanitize_fonts',
    ));
    $wp_customize->add_control( 'h2_fontfamily', array (
        'label' => __('Font Family', 'mtminimag'),
        'section' => 'heading_typography',
        'type' => 'select',
        'choices' => $googleFonts,
    ));

    $wp_customize->add_setting( 'h2_fontsize', array(
        'default' => $defaultFonts['h2_fontsize'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'h2_fontsize',
        array(
            'label' => __( 'Font Size', 'mtminimag' ),
            'section' => 'heading_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $defaultFonts['h2_fontsize'],
            ),
        )
    ));

    $wp_customize->add_setting('h2_fontsize_unit', array (
        'default' => $defaultFonts['h2_fontsize_unit'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_select'
    ));
    $wp_customize->add_control( 'h2_fontsize_unit', array (
        'section' => 'heading_typography',
        'type' => 'radio',
        'choices' => array(
            'px' => 'px',
            'em' => 'em',
        ),
    ));

    $wp_customize->add_setting('h2_texttransform', array (
        'default' => $defaultFonts['h2_texttransform'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_select'
    ));
    $wp_customize->add_control( 'h2_texttransform', array (
        'label' => __('Text Transform', 'mtminimag'),
        'section' => 'heading_typography',
        'type' => 'select',
        'choices' => array (
            'none' => 'None',
            'uppercase' => 'UPPERCASE',
            'lowercase' => 'lowercase',
            'capitalize' => 'Capitalize'
        ),
    ));

    $wp_customize->add_setting('h2_alt_fontfamily', array (
        'default' => $defaultFonts['h2_alt_fontfamily'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_select'
    ));
    $wp_customize->add_control( 'h2_alt_fontfamily', array (
        'label' => __('Alt Font Family', 'mtminimag'),
        'section' => 'heading_typography',
        'type' => 'select',
        'choices' => $altFontFamily,
    ));

    $wp_customize->add_setting( 'h2_letterspacing', array(
        'default' => $defaultFonts['h2_letterspacing'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'h2_letterspacing',
        array(
            'label' => __( 'Letter Spacing (px)', 'mtminimag' ),
            'section' => 'heading_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $defaultFonts['h2_letterspacing'],
            ),
        )
    ));

    $wp_customize->add_setting('h2_fontweight', array (
        'default' => $defaultFonts['h2_fontweight'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_select'
    ));
    $wp_customize->add_control( 'h2_fontweight', array (
        'label' => __('Font Weight', 'mtminimag'),
        'section' => 'heading_typography',
        'type' => 'select',
        'choices' => array (
            'normal' => 'normal',
            '100' => '100',
            '200' => '200',
            '300' => '300',
            '400' => '400',
            '500' => '500',
            '600' => '600',
            '700' => '700',
            '800' => '800',
            '900' => '900',
        ),
    ));

    $wp_customize->add_setting( 'h2_lineheight', array(
        'default' => $defaultFonts['h2_lineheight'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'h2_lineheight',
        array(
            'label' => __( 'Line Height (px)', 'mtminimag' ),
            'section' => 'heading_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $defaultFonts['h2_lineheight'],
            ),
        )
    ));

    // Separator for H3 headings
    $wp_customize->add_setting( 'h3_separator', array(
        'default' => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_separator'
    ));
    $wp_customize->add_control(
        new MightyThemes_Separator_Custom_Control( 
        $wp_customize, 
        'h3_separator',
        array(
            'label' => __( 'Heading 3', 'mtminimag' ),
            'section' => 'heading_typography',
        )
    ));
    /* Heading 3 */
    $wp_customize->add_setting('h3_fontfamily', array (
        'transport' => 'refresh',
        'default' => $defaultFonts['h3_fontfamily'],
        'sanitize_callback' => 'custom_sanitize_fonts',
    ));
    $wp_customize->add_control( 'h3_fontfamily', array (
        'label' => __('Font Family', 'mtminimag'),
        'section' => 'heading_typography',
        'type' => 'select',
        'choices' => $googleFonts,
    ));

    $wp_customize->add_setting( 'h3_fontsize', array(
        'default' => $defaultFonts['h3_fontsize'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'h3_fontsize',
        array(
            'label' => __( 'Font Size', 'mtminimag' ),
            'section' => 'heading_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $defaultFonts['h3_fontsize'],
            ),
        )
    ));

    $wp_customize->add_setting('h3_fontsize_unit', array (
        'default' => $defaultFonts['h3_fontsize_unit'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_select'
    ));
    $wp_customize->add_control( 'h3_fontsize_unit', array (
        'section' => 'heading_typography',
        'type' => 'radio',
        'choices' => array(
            'px' => 'px',
            'em' => 'em',
        ),
    ));

    $wp_customize->add_setting('h3_texttransform', array (
        'default' => $defaultFonts['h3_texttransform'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_select'
    ));
    $wp_customize->add_control( 'h3_texttransform', array (
        'label' => __('Text Transform', 'mtminimag'),
        'section' => 'heading_typography',
        'type' => 'select',
        'choices' => array (
            'none' => 'None',
            'uppercase' => 'UPPERCASE',
            'lowercase' => 'lowercase',
            'capitalize' => 'Capitalize'
        ),
    ));

    $wp_customize->add_setting('h3_alt_fontfamily', array (
        'default' => $defaultFonts['h3_alt_fontfamily'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_select'
    ));
    $wp_customize->add_control( 'h3_alt_fontfamily', array (
        'label' => __('Alt Font Family', 'mtminimag'),
        'section' => 'heading_typography',
        'type' => 'select',
        'choices' => $altFontFamily,
    ));

    $wp_customize->add_setting( 'h3_letterspacing', array(
        'default' => $defaultFonts['h3_letterspacing'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'h3_letterspacing',
        array(
            'label' => __( 'Letter Spacing (px)', 'mtminimag' ),
            'section' => 'heading_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $defaultFonts['h3_letterspacing'],
            ),
        )
    ));

    $wp_customize->add_setting('h3_fontweight', array (
        'default' => $defaultFonts['h3_fontweight'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_select'
    ));
    $wp_customize->add_control( 'h3_fontweight', array (
        'label' => __('Font Weight', 'mtminimag'),
        'section' => 'heading_typography',
        'type' => 'select',
        'choices' => array (
            'normal' => 'normal',
            '100' => '100',
            '200' => '200',
            '300' => '300',
            '400' => '400',
            '500' => '500',
            '600' => '600',
            '700' => '700',
            '800' => '800',
            '900' => '900',
        ),
    ));

    $wp_customize->add_setting( 'h3_lineheight', array(
        'default' => $defaultFonts['h3_lineheight'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'h3_lineheight',
        array(
            'label' => __( 'Line Height (px)', 'mtminimag' ),
            'section' => 'heading_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $defaultFonts['h3_lineheight'],
            ),
        )
    ));

    // Separator for H4 headings
    $wp_customize->add_setting( 'h4_separator', array(
        'default' => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_separator'
    ));
    $wp_customize->add_control(
        new MightyThemes_Separator_Custom_Control( 
        $wp_customize, 
        'h4_separator',
        array(
            'label' => __( 'Heading 4', 'mtminimag' ),
            'section' => 'heading_typography',
        )
    ));
    /* Heading 4 */
    $wp_customize->add_setting('h4_fontfamily', array (
        'transport' => 'refresh',
        'default' => $defaultFonts['h4_fontfamily'],
        'sanitize_callback' => 'custom_sanitize_fonts',
    ));
    $wp_customize->add_control( 'h4_fontfamily', array (
        'label' => __('Font Family', 'mtminimag'),
        'section' => 'heading_typography',
        'type' => 'select',
        'choices' => $googleFonts,
    ));

    $wp_customize->add_setting( 'h4_fontsize', array(
        'default' => $defaultFonts['h4_fontsize'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'h4_fontsize',
        array(
            'label' => __( 'Font Size', 'mtminimag' ),
            'section' => 'heading_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $defaultFonts['h4_fontsize'],
            ),
        )
    ));

    $wp_customize->add_setting('h4_fontsize_unit', array (
        'default' => $defaultFonts['h4_fontsize_unit'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_select'
    ));
    $wp_customize->add_control( 'h4_fontsize_unit', array (
        'section' => 'heading_typography',
        'type' => 'radio',
        'choices' => array(
            'px' => 'px',
            'em' => 'em',
        ),
    ));

    $wp_customize->add_setting('h4_texttransform', array (
        'default' => $defaultFonts['h4_texttransform'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_select'
    ));
    $wp_customize->add_control( 'h4_texttransform', array (
        'label' => __('Text Transform', 'mtminimag'),
        'section' => 'heading_typography',
        'type' => 'select',
        'choices' => array (
            'none' => 'None',
            'uppercase' => 'UPPERCASE',
            'lowercase' => 'lowercase',
            'capitalize' => 'Capitalize'
        ),
    ));

    $wp_customize->add_setting('h4_alt_fontfamily', array (
        'default' => $defaultFonts['h4_alt_fontfamily'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_select'
    ));
    $wp_customize->add_control( 'h4_alt_fontfamily', array (
        'label' => __('Alt Font Family', 'mtminimag'),
        'section' => 'heading_typography',
        'type' => 'select',
        'choices' => $altFontFamily,
    ));

    $wp_customize->add_setting( 'h4_letterspacing', array(
        'default' => $defaultFonts['h4_letterspacing'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'h4_letterspacing',
        array(
            'label' => __( 'Letter Spacing (px)', 'mtminimag' ),
            'section' => 'heading_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $defaultFonts['h4_letterspacing'],
            ),
        )
    ));

    $wp_customize->add_setting('h4_fontweight', array (
        'default' => $defaultFonts['h4_fontweight'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_select'
    ));
    $wp_customize->add_control( 'h4_fontweight', array (
        'label' => __('Font Weight', 'mtminimag'),
        'section' => 'heading_typography',
        'type' => 'select',
        'choices' => array (
            'normal' => 'normal',
            '100' => '100',
            '200' => '200',
            '300' => '300',
            '400' => '400',
            '500' => '500',
            '600' => '600',
            '700' => '700',
            '800' => '800',
            '900' => '900',
        ),
    ));

    $wp_customize->add_setting( 'h4_lineheight', array(
        'default' => $defaultFonts['h4_lineheight'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'h4_lineheight',
        array(
            'label' => __( 'Line Height (px)', 'mtminimag' ),
            'section' => 'heading_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $defaultFonts['h4_lineheight'],
            ),
        )
    ));

    // Separator for H5 headings
    $wp_customize->add_setting( 'h5_separator', array(
        'default' => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_separator'
    ));
    $wp_customize->add_control(
        new MightyThemes_Separator_Custom_Control( 
        $wp_customize, 
        'h5_separator',
        array(
            'label' => __( 'Heading 5', 'mtminimag' ),
            'section' => 'heading_typography',
        )
    ));
    /* Heading 4 */
    $wp_customize->add_setting('h5_fontfamily', array (
        'transport' => 'refresh',
        'default' => $defaultFonts['h5_fontfamily'],
        'sanitize_callback' => 'custom_sanitize_fonts',
    ));
    $wp_customize->add_control( 'h5_fontfamily', array (
        'label' => __('Font Family', 'mtminimag'),
        'section' => 'heading_typography',
        'type' => 'select',
        'choices' => $googleFonts,
    ));

    $wp_customize->add_setting( 'h5_fontsize', array(
        'default' => $defaultFonts['h5_fontsize'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'h5_fontsize',
        array(
            'label' => __( 'Font Size', 'mtminimag' ),
            'section' => 'heading_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $defaultFonts['h5_fontsize'],
            ),
        )
    ));

    $wp_customize->add_setting('h5_fontsize_unit', array (
        'default' => $defaultFonts['h5_fontsize_unit'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_select'
    ));
    $wp_customize->add_control( 'h5_fontsize_unit', array (
        'section' => 'heading_typography',
        'type' => 'radio',
        'choices' => array(
            'px' => 'px',
            'em' => 'em',
        ),
    ));

    $wp_customize->add_setting('h5_texttransform', array (
        'default' => $defaultFonts['h5_texttransform'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_select'
    ));
    $wp_customize->add_control( 'h5_texttransform', array (
        'label' => __('Text Transform', 'mtminimag'),
        'section' => 'heading_typography',
        'type' => 'select',
        'choices' => array (
            'none' => 'None',
            'uppercase' => 'UPPERCASE',
            'lowercase' => 'lowercase',
            'capitalize' => 'Capitalize'
        ),
    ));

    $wp_customize->add_setting('h5_alt_fontfamily', array (
        'default' => $defaultFonts['h5_alt_fontfamily'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_select'
    ));
    $wp_customize->add_control( 'h5_alt_fontfamily', array (
        'label' => __('Alt Font Family', 'mtminimag'),
        'section' => 'heading_typography',
        'type' => 'select',
        'choices' => $altFontFamily,
    ));

    $wp_customize->add_setting( 'h5_letterspacing', array(
        'default' => $defaultFonts['h5_letterspacing'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'h5_letterspacing',
        array(
            'label' => __( 'Letter Spacing (px)', 'mtminimag' ),
            'section' => 'heading_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $defaultFonts['h5_letterspacing'],
            ),
        )
    ));

    $wp_customize->add_setting('h5_fontweight', array (
        'default' => $defaultFonts['h5_fontweight'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_select'
    ));
    $wp_customize->add_control( 'h5_fontweight', array (
        'label' => __('Font Weight', 'mtminimag'),
        'section' => 'heading_typography',
        'type' => 'select',
        'choices' => array (
            'normal' => 'normal',
            '100' => '100',
            '200' => '200',
            '300' => '300',
            '400' => '400',
            '500' => '500',
            '600' => '600',
            '700' => '700',
            '800' => '800',
            '900' => '900',
        ),
    ));

    $wp_customize->add_setting( 'h5_lineheight', array(
        'default' => $defaultFonts['h5_lineheight'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'h5_lineheight',
        array(
            'label' => __( 'Line Height (px)', 'mtminimag' ),
            'section' => 'heading_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $defaultFonts['h5_lineheight'],
            ),
        )
    ));

    // Separator for H6 headings
    $wp_customize->add_setting( 'h6_separator', array(
        'default' => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_separator'
    ));
    $wp_customize->add_control(
        new MightyThemes_Separator_Custom_Control( 
        $wp_customize, 
        'h6_separator',
        array(
            'label' => __( 'Heading 6', 'mtminimag' ),
            'section' => 'heading_typography',
        )
    ));
    /* Heading 4 */
    $wp_customize->add_setting('h6_fontfamily', array (
        'transport' => 'refresh',
        'default' => $defaultFonts['h6_fontfamily'],
        'sanitize_callback' => 'custom_sanitize_fonts',
    ));
    $wp_customize->add_control( 'h6_fontfamily', array (
        'label' => __('Font Family', 'mtminimag'),
        'section' => 'heading_typography',
        'type' => 'select',
        'choices' => $googleFonts,
    ));

    $wp_customize->add_setting( 'h6_fontsize', array(
        'default' => $defaultFonts['h6_fontsize'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'h6_fontsize',
        array(
            'label' => __( 'Font Size', 'mtminimag' ),
            'section' => 'heading_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $defaultFonts['h6_fontsize'],
            ),
        )
    ));

    $wp_customize->add_setting('h6_fontsize_unit', array (
        'default' => $defaultFonts['h6_fontsize_unit'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_select'
    ));
    $wp_customize->add_control( 'h6_fontsize_unit', array (
        'section' => 'heading_typography',
        'type' => 'radio',
        'choices' => array(
            'px' => 'px',
            'em' => 'em',
        ),
    ));

    $wp_customize->add_setting('h6_texttransform', array (
        'default' => $defaultFonts['h6_texttransform'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_select'
    ));
    $wp_customize->add_control( 'h6_texttransform', array (
        'label' => __('Text Transform', 'mtminimag'),
        'section' => 'heading_typography',
        'type' => 'select',
        'choices' => array (
            'none' => 'None',
            'uppercase' => 'UPPERCASE',
            'lowercase' => 'lowercase',
            'capitalize' => 'Capitalize'
        ),
    ));

    $wp_customize->add_setting('h6_alt_fontfamily', array (
        'default' => $defaultFonts['h6_alt_fontfamily'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_select'
    ));
    $wp_customize->add_control( 'h6_alt_fontfamily', array (
        'label' => __('Alt Font Family', 'mtminimag'),
        'section' => 'heading_typography',
        'type' => 'select',
        'choices' => $altFontFamily,
    ));

    $wp_customize->add_setting( 'h6_letterspacing', array(
        'default' => $defaultFonts['h6_letterspacing'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'h6_letterspacing',
        array(
            'label' => __( 'Letter Spacing (px)', 'mtminimag' ),
            'section' => 'heading_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $defaultFonts['h6_letterspacing'],
            ),
        )
    ));

    $wp_customize->add_setting('h6_fontweight', array (
        'default' => $defaultFonts['h6_fontweight'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_select'
    ));
    $wp_customize->add_control( 'h6_fontweight', array (
        'label' => __('Font Weight', 'mtminimag'),
        'section' => 'heading_typography',
        'type' => 'select',
        'choices' => array (
            'normal' => 'normal',
            '100' => '100',
            '200' => '200',
            '300' => '300',
            '400' => '400',
            '500' => '500',
            '600' => '600',
            '700' => '700',
            '800' => '800',
            '900' => '900',
        ),
    ));

    $wp_customize->add_setting( 'h6_lineheight', array(
        'default' => $defaultFonts['h6_lineheight'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize,
        'h6_lineheight',
        array(
            'label' => __( 'Line Height (px)', 'mtminimag' ),
            'section' => 'heading_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $defaultFonts['h6_lineheight'],
            ),
        )
    ));



    // Logo Typography Management
    $wp_customize->add_section('logo_typography', array (
        'title' => __('Logo', 'mtminimag'),
        'description' => 'Typography Management for your website\'s Logo',
        'panel' => 'typography_mgt',
    ));

    $wp_customize->add_setting('logo_fontfamily', array (
        'transport' => 'refresh',
        'default' => $defaultFonts['logo_fontfamily'],
        'sanitize_callback' => 'custom_sanitize_fonts',
    ));
    $wp_customize->add_control( 'logo_fontfamily', array (
        'label' => __('Font Family', 'mtminimag'),
        'section' => 'logo_typography',
        'type' => 'select',
        'choices' => $googleFonts,
    ));

    $wp_customize->add_setting( 'logo_fontsize', array(
        'default' => $defaultFonts['logo_fontsize'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'logo_fontsize',
        array(
            'label' => __( 'Logo Fontsize', 'mtminimag' ),
            'section' => 'logo_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $defaultFonts['logo_fontsize'],
            ),
        )
    ));

    $wp_customize->add_setting('logo_fontsize_unit', array (
        'default' => $defaultFonts['logo_fontsize_unit'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_select'
    ));
    $wp_customize->add_control( 'logo_fontsize_unit', array (
        'section' => 'logo_typography',
        'type' => 'radio',
        'choices' => array(
            'px' => 'px',
            'em' => 'em',
        ),
    ));

    $wp_customize->add_setting('logo_texttransform', array (
        'default' => $defaultFonts['logo_texttransform'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_select'
    ));
    $wp_customize->add_control( 'logo_texttransform', array (
        'label' => __('Text Transform', 'mtminimag'),
        'section' => 'logo_typography',
        'type' => 'select',
        'choices' => array (
            'none' => 'None',
            'uppercase' => 'UPPERCASE',
            'lowercase' => 'lowercase',
            'capitalize' => 'Capitalize'
        ),
    ));

    $wp_customize->add_setting('logo_alt_fontfamily', array (
        'default' => $defaultFonts['logo_alt_fontfamily'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_select'
    ));
    $wp_customize->add_control( 'logo_alt_fontfamily', array (
        'label' => __('Alt Font Family', 'mtminimag'),
        'section' => 'logo_typography',
        'type' => 'select',
        'choices' => $altFontFamily,
    ));

    $wp_customize->add_setting( 'logo_letterspacing', array(
        'default' => $defaultFonts['logo_letterspacing'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'logo_letterspacing',
        array(
            'label' => __( 'Letter Spacing (px)', 'mtminimag' ),
            'section' => 'logo_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $defaultFonts['logo_letterspacing'],
            ),
        )
    ));

    $wp_customize->add_setting('logo_fontweight', array (
        'default' => $defaultFonts['logo_fontweight'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_select'
    ));
    $wp_customize->add_control( 'logo_fontweight', array (
        'label' => __('Font Weight', 'mtminimag'),
        'section' => 'logo_typography',
        'type' => 'select',
        'choices' => array (
            'normal' => 'normal',
            '100' => '100',
            '200' => '200',
            '300' => '300',
            '400' => '400',
            '500' => '500',
            '600' => '600',
            '700' => '700',
            '800' => '800',
            '900' => '900',
        ),
    ));

    $wp_customize->add_setting( 'logo_lineheight', array(
        'default' => $defaultFonts['logo_lineheight'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'logo_lineheight',
        array(
            'label' => __( 'Line Height (px)', 'mtminimag' ),
            'section' => 'logo_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $defaultFonts['logo_lineheight'],
            ),
        )
    ));

    // Main Menu Typography Management
    $wp_customize->add_section('mainmenu_typography', array (
        'title' => __('Main Menu', 'mtminimag'),
        'description' => 'Manage fonts for your website\'s Main Menu',
        'panel' => 'typography_mgt',
    ));

    $wp_customize->add_setting('mainmenu_fontfamily', array (
        'transport' => 'refresh',
        'default' => $defaultFonts['mainmenu_fontfamily'],
        'sanitize_callback' => 'custom_sanitize_fonts',
    ));
    $wp_customize->add_control( 'mainmenu_fontfamily', array (
        'label' => __('Font Family', 'mtminimag'),
        'section' => 'mainmenu_typography',
        'type' => 'select',
        'choices' => $googleFonts,
    ));

    $wp_customize->add_setting( 'mainmenu_fontsize', array(
        'default' => $defaultFonts['mainmenu_fontsize'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'mainmenu_fontsize',
        array(
            'label' => __( 'Font Size', 'mtminimag' ),
            'section' => 'mainmenu_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $defaultFonts['mainmenu_fontsize'],
            ),
        )
    ));

    $wp_customize->add_setting('mainmenu_fontsize_unit', array (
        'default' => $defaultFonts['mainmenu_fontsize_unit'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_select'
    ));
    $wp_customize->add_control( 'mainmenu_fontsize_unit', array(
        'section' => 'mainmenu_typography',
        'type' => 'radio',
        'choices' => array(
            'px' => 'px',
            'em' => 'em',
        ),
    ));

    $wp_customize->add_setting('mainmenu_texttransform', array (
        'default' => $defaultFonts['mainmenu_texttransform'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_select'
    ));
    $wp_customize->add_control( 'mainmenu_texttransform', array (
        'label' => __('Text Transform', 'mtminimag'),
        'section' => 'mainmenu_typography',
        'type' => 'select',
        'choices' => array (
            'none' => 'None',
            'uppercase' => 'UPPERCASE',
            'lowercase' => 'lowercase',
            'capitalize' => 'Capitalize'
        ),
    ));

    $wp_customize->add_setting('mainmenu_alt_fontfamily', array (
        'default' => $defaultFonts['mainmenu_alt_fontfamily'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_select'
    ));
    $wp_customize->add_control( 'mainmenu_alt_fontfamily', array (
        'label' => __('Alt Font Family', 'mtminimag'),
        'section' => 'mainmenu_typography',
        'type' => 'select',
        'choices' => $altFontFamily,
    ));

    $wp_customize->add_setting( 'mainmenu_letterspacing', array(
        'default' => $defaultFonts['mainmenu_letterspacing'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'mainmenu_letterspacing',
        array(
            'label' => __( 'Letter Spacing (px)', 'mtminimag' ),
            'section' => 'mainmenu_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $defaultFonts['mainmenu_letterspacing'],
            ),
        )
    ));

    $wp_customize->add_setting('mainmenu_fontweight', array (
        'default' => $defaultFonts['mainmenu_fontweight'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_select'
    ));
    $wp_customize->add_control( 'mainmenu_fontweight', array (
        'label' => __('Font Weight', 'mtminimag'),
        'section' => 'mainmenu_typography',
        'type' => 'select',
        'choices' => array (
            'normal' => 'normal',
            '100' => '100',
            '200' => '200',
            '300' => '300',
            '400' => '400',
            '500' => '500',
            '600' => '600',
            '700' => '700',
            '800' => '800',
            '900' => '900',
        ),
    ));

    $wp_customize->add_setting( 'mainmenu_lineheight', array(
        'default' => $defaultFonts['mainmenu_lineheight'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'mainmenu_lineheight',
        array(
            'label' => __( 'Line Height (px)', 'mtminimag' ),
            'section' => 'mainmenu_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $defaultFonts['mainmenu_lineheight'],
            ),
        )
    ));

    // Dropdown Menu Typography Management
    $wp_customize->add_section('dropdown_typography', array (
        'title' => __('Dropdown Menu', 'mtminimag'),
        'description' => 'Manage fonts for your website\'s Dropdown Menus',
        'panel' => 'typography_mgt',
    ));
    $wp_customize->add_setting('dropdown_fontfamily', array (
        'default' => $defaultFonts['dropdown_fontfamily'],
        'transport' => 'refresh',
        'sanitize_callback' => 'custom_sanitize_fonts',
    ));
    $wp_customize->add_control( 'dropdown_fontfamily', array (
        'label' => __('Font Family', 'mtminimag'),
        'section' => 'dropdown_typography',
        'type' => 'select',
        'choices' => $googleFonts,
    ));

    $wp_customize->add_setting( 'dropdown_fontsize', array(
        'default' => $defaultFonts['dropdown_fontsize'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'dropdown_fontsize',
        array(
            'label' => __( 'Font Size', 'mtminimag' ),
            'section' => 'dropdown_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $defaultFonts['dropdown_fontsize'],
            ),
        )
    ));

    $wp_customize->add_setting('dropdown_fontsize_unit', array (
        'default' => $defaultFonts['dropdown_fontsize_unit'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_select'
    ));
    $wp_customize->add_control( 'dropdown_fontsize_unit', array(
        'section' => 'dropdown_typography',
        'type' => 'radio',
        'choices' => array(
            'px' => 'px',
            'em' => 'em',
        ),
    ));

    $wp_customize->add_setting('dropdown_texttransform', array (
        'default' => $defaultFonts['dropdown_texttransform'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_select'
    ));
    $wp_customize->add_control( 'dropdown_texttransform', array (
        'label' => __('Text Transform', 'mtminimag'),
        'section' => 'dropdown_typography',
        'type' => 'select',
        'choices' => array (
            'none' => 'None',
            'uppercase' => 'UPPERCASE',
            'lowercase' => 'lowercase',
            'capitalize' => 'Capitalize'
        ),
    ));

    $wp_customize->add_setting('dropdown_alt_fontfamily', array (
        'default' => $defaultFonts['dropdown_alt_fontfamily'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_select'
    ));
    $wp_customize->add_control( 'dropdown_alt_fontfamily', array (
        'label' => __('Alt Font Family', 'mtminimag'),
        'section' => 'dropdown_typography',
        'type' => 'select',
        'choices' => $altFontFamily,
    ));

    $wp_customize->add_setting( 'dropdown_letterspacing', array(
        'default' => $defaultFonts['dropdown_letterspacing'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'dropdown_letterspacing',
        array(
            'label' => __( 'Letter Spacing (px)', 'mtminimag' ),
            'section' => 'dropdown_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $defaultFonts['dropdown_letterspacing'],
            ),
        )
    ));

    $wp_customize->add_setting('dropdown_fontweight', array (
        'default' => $defaultFonts['dropdown_fontweight'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_select'
    ));
    $wp_customize->add_control( 'dropdown_fontweight', array (
        'label' => __('Font Weight', 'mtminimag'),
        'section' => 'dropdown_typography',
        'type' => 'select',
        'choices' => array (
            'normal' => 'Normal',
            '100' => '100',
            '200' => '200',
            '300' => '300',
            '400' => '400',
            '500' => '500',
            '600' => '600',
            '700' => '700',
            '800' => '800',
            '900' => '900',
        ),
    ));

    $wp_customize->add_setting( 'dropdown_lineheight', array(
        'default' => $defaultFonts['dropdown_lineheight'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'dropdown_lineheight',
        array(
            'label' => __( 'Line Height (px)', 'mtminimag' ),
            'section' => 'dropdown_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $defaultFonts['dropdown_lineheight'],
            ),
        )
    ));

    // Entry Title Typography Management
    $wp_customize->add_section('entrytitle_typography', array (
        'title' => __('Entry Title', 'mtminimag'),
        'description' => '',
        'panel' => 'typography_mgt',
    ));
    $wp_customize->add_setting('entrytitle_fontfamily', array (
        'transport' => 'refresh',
        'default' => $defaultFonts['entrytitle_fontfamily'],
        'sanitize_callback' => 'custom_sanitize_fonts',
    ));
    $wp_customize->add_control( 'entrytitle_fontfamily', array (
        'label' => __('Font Family', 'mtminimag'),
        'section' => 'entrytitle_typography',
        'type' => 'select',
        'choices' => $googleFonts
    ));

    $wp_customize->add_setting( 'entrytitle_fontsize', array(
        'default' => $defaultFonts['entrytitle_fontsize'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'entrytitle_fontsize',
        array(
            'label' => __( 'Font Size', 'mtminimag' ),
            'section' => 'entrytitle_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $defaultFonts['entrytitle_fontsize'],
            ),
        )
    ));

    $wp_customize->add_setting('entrytitle_fontsize_unit', array (
        'default' => $defaultFonts['entrytitle_fontsize_unit'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_select'
    ));
    $wp_customize->add_control( 'entrytitle_fontsize_unit', array(
        'section' => 'entrytitle_typography',
        'type' => 'radio',
        'choices' => array(
            'px' => 'px',
            'em' => 'em',
        ),
    ));

    $wp_customize->add_setting('entrytitle_texttransform', array (
        'default' => $defaultFonts['entrytitle_texttransform'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_select'
    ));
    $wp_customize->add_control( 'entrytitle_texttransform', array (
        'label' => __('Text Transform', 'mtminimag'),
        'section' => 'entrytitle_typography',
        'type' => 'select',
        'choices' => array (
            'none' => 'None',
            'uppercase' => 'UPPERCASE',
            'lowercase' => 'lowercase',
            'capitalize' => 'Capitalize'
        ),
    ));

    $wp_customize->add_setting('entrytitle_alt_fontfamily', array (
        'default' => $defaultFonts['entrytitle_alt_fontfamily'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_select'
    ));
    $wp_customize->add_control( 'entrytitle_alt_fontfamily', array (
        'label' => __('Alt Font Family', 'mtminimag'),
        'section' => 'entrytitle_typography',
        'type' => 'select',
        'choices' => $altFontFamily,
    ));

    $wp_customize->add_setting( 'entrytitle_letterspacing', array(
        'default' => $defaultFonts['entrytitle_letterspacing'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'entrytitle_letterspacing',
        array(
            'label' => __( 'Letter Spacing (px)', 'mtminimag' ),
            'section' => 'entrytitle_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $defaultFonts['entrytitle_letterspacing'],
            ),
        )
    ));

    $wp_customize->add_setting('entrytitle_fontweight', array (
        'default' => $defaultFonts['entrytitle_fontweight'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_select'
    ));
    $wp_customize->add_control( 'entrytitle_fontweight', array (
        'label' => __('Font Weight', 'mtminimag'),
        'section' => 'entrytitle_typography',
        'type' => 'select',
        'choices' => array (
            'normal' => 'Normal',
            '100' => '100',
            '200' => '200',
            '300' => '300',
            '400' => '400',
            '500' => '500',
            '600' => '600',
            '700' => '700',
            '800' => '800',
            '900' => '900',
        ),
    ));

    $wp_customize->add_setting( 'entrytitle_lineheight', array(
        'default' => $defaultFonts['entrytitle_lineheight'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'entrytitle_lineheight',
        array(
            'label' => __( 'Line Height (px)', 'mtminimag' ),
            'section' => 'entrytitle_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $defaultFonts['entrytitle_lineheight'],
            ),
        )
    ));

    // Single Post Title Typography Management
    $wp_customize->add_section('posttitle_typography', array (
        'title' => __('Single Post Title', 'mtminimag'),
        'description' => '',
        'panel' => 'typography_mgt',
    ));
    $wp_customize->add_setting('posttitle_fontfamily', array (
        'transport' => 'refresh',
        'default' => $defaultFonts['posttitle_fontfamily'],
        'sanitize_callback' => 'custom_sanitize_fonts',
    ));
    $wp_customize->add_control( 'posttitle_fontfamily', array (
        'label' => __('Font Family', 'mtminimag'),
        'section' => 'posttitle_typography',
        'type' => 'select',
        'choices' => $googleFonts
    ));

    $wp_customize->add_setting( 'posttitle_fontsize', array(
        'default' => $defaultFonts['posttitle_fontsize'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'posttitle_fontsize',
        array(
            'label' => __( 'Font Size', 'mtminimag' ),
            'section' => 'posttitle_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $defaultFonts['posttitle_fontsize'],
            ),
        )
    ));

    $wp_customize->add_setting('posttitle_fontsize_unit', array (
        'default' => $defaultFonts['posttitle_fontsize_unit'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_select'
    ));
    $wp_customize->add_control( 'posttitle_fontsize_unit', array(
        'section' => 'posttitle_typography',
        'type' => 'radio',
        'choices' => array(
            'px' => 'px',
            'em' => 'em',
        ),
    ));

    $wp_customize->add_setting('posttitle_texttransform', array (
        'default' => $defaultFonts['posttitle_texttransform'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_select'
    ));
    $wp_customize->add_control( 'posttitle_texttransform', array (
        'label' => __('Text Transform', 'mtminimag'),
        'section' => 'posttitle_typography',
        'type' => 'select',
        'choices' => array (
            'none' => 'None',
            'uppercase' => 'UPPERCASE',
            'lowercase' => 'lowercase',
            'capitalize' => 'Capitalize'
        ),
    ));

    $wp_customize->add_setting('posttitle_alt_fontfamily', array (
        'default' => $defaultFonts['posttitle_alt_fontfamily'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_select'
    ));
    $wp_customize->add_control( 'posttitle_alt_fontfamily', array (
        'label' => __('Alt Font Family', 'mtminimag'),
        'section' => 'posttitle_typography',
        'type' => 'select',
        'choices' => $altFontFamily,
    ));

    $wp_customize->add_setting( 'posttitle_letterspacing', array(
        'default' => $defaultFonts['posttitle_letterspacing'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'posttitle_letterspacing',
        array(
            'label' => __( 'Letter Spacing (px)', 'mtminimag' ),
            'section' => 'posttitle_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $defaultFonts['posttitle_letterspacing'],
            ),
        )
    ));

    $wp_customize->add_setting('posttitle_fontweight', array (
        'default' => $defaultFonts['posttitle_fontweight'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_select'
    ));
    $wp_customize->add_control( 'posttitle_fontweight', array (
        'label' => __('Font Weight', 'mtminimag'),
        'section' => 'posttitle_typography',
        'type' => 'select',
        'choices' => array (
            'Normal' => 'Normal',
            '100' => '100',
            '200' => '200',
            '300' => '300',
            '400' => '400',
            '500' => '500',
            '600' => '600',
            '700' => '700',
            '800' => '800',
            '900' => '900',
        ),
    ));

    $wp_customize->add_setting( 'posttitle_lineheight', array(
        'default' => $defaultFonts['posttitle_lineheight'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'posttitle_lineheight',
        array(
            'label' => __( 'Line Height (px)', 'mtminimag' ),
            'section' => 'posttitle_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $defaultFonts['posttitle_lineheight'],
            ),
        )
    ));

    // Meta Typography Management
    $wp_customize->add_section('meta_typography', array (
        'title' => __('Meta', 'mtminimag'),
        'description' => '',
        'panel' => 'typography_mgt',
    ));
    $wp_customize->add_setting('meta_fontfamily', array (
        'transport' => 'refresh',
        'default' => $defaultFonts['meta_fontfamily'],
        'sanitize_callback' => 'custom_sanitize_fonts',
    ));
    $wp_customize->add_control( 'meta_fontfamily', array (
        'label' => __('Font Family', 'mtminimag'),
        'section' => 'meta_typography',
        'type' => 'select',
        'choices' => $googleFonts
    ));

    $wp_customize->add_setting( 'meta_fontsize', array(
        'default' => $defaultFonts['meta_fontsize'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'meta_fontsize',
        array(
            'label' => __( 'Font Size', 'mtminimag' ),
            'section' => 'meta_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $defaultFonts['meta_fontsize'],
            ),
        )
    ));

    $wp_customize->add_setting('meta_fontsize_unit', array (
        'default' => $defaultFonts['meta_fontsize_unit'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_select'
    ));
    $wp_customize->add_control( 'meta_fontsize_unit', array(
        'section' => 'meta_typography',
        'type' => 'radio',
        'choices' => array(
            'px' => 'px',
            'em' => 'em',
        ),
    ));

    $wp_customize->add_setting('meta_texttransform', array (
        'default' => $defaultFonts['meta_texttransform'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_select'
    ));
    $wp_customize->add_control( 'meta_texttransform', array (
        'label' => __('Text Transform', 'mtminimag'),
        'section' => 'meta_typography',
        'type' => 'select',
        'choices' => array (
            'none' => 'None',
            'uppercase' => 'UPPERCASE',
            'lowercase' => 'lowercase',
            'capitalize' => 'Capitalize'
        ),
    ));

    $wp_customize->add_setting('meta_alt_fontfamily', array (
        'default' => $defaultFonts['meta_alt_fontfamily'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_select'
    ));
    $wp_customize->add_control( 'meta_alt_fontfamily', array (
        'label' => __('Alt Font Family', 'mtminimag'),
        'section' => 'meta_typography',
        'type' => 'select',
        'choices' => $altFontFamily,
    ));

    $wp_customize->add_setting( 'meta_letterspacing', array(
        'default' => $defaultFonts['meta_letterspacing'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'meta_letterspacing',
        array(
            'label' => __( 'Letter Spacing (px)', 'mtminimag' ),
            'section' => 'meta_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $defaultFonts['meta_letterspacing'],
            ),
        )
    ));

    $wp_customize->add_setting('meta_fontweight', array (
        'default' => $defaultFonts['meta_fontweight'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_select'
    ));
    $wp_customize->add_control( 'meta_fontweight', array (
        'label' => __('Font Weight', 'mtminimag'),
        'section' => 'meta_typography',
        'type' => 'select',
        'choices' => array (
            'normal' => 'normal',
            '100' => '100',
            '200' => '200',
            '300' => '300',
            '400' => '400',
            '500' => '500',
            '600' => '600',
            '700' => '700',
            '800' => '800',
            '900' => '900',
        ),
    ));

    $wp_customize->add_setting( 'meta_lineheight', array(
        'default' => $defaultFonts['meta_lineheight'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'meta_lineheight',
        array(
            'label' => __( 'Line Height (px)', 'mtminimag' ),
            'section' => 'meta_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $defaultFonts['meta_lineheight'],
            ),
        )
    ));

    // Widget Title Typography Management
    $wp_customize->add_section('widgettitle_typography', array (
        'title' => __('Widget Title', 'mtminimag'),
        'description' => '',
        'panel' => 'typography_mgt',
    ));
    $wp_customize->add_setting('widgettitle_fontfamily', array (
        'transport' => 'refresh',
        'default' => $defaultFonts['widgettitle_fontfamily'],
        'sanitize_callback' => 'custom_sanitize_fonts',
    ));
    $wp_customize->add_control( 'widgettitle_fontfamily', array (
        'label' => __('Font Family', 'mtminimag'),
        'section' => 'widgettitle_typography',
        'type' => 'select',
        'choices' => $googleFonts
    ));

    $wp_customize->add_setting( 'widgettitle_fontsize', array(
        'default' => $defaultFonts['widgettitle_fontsize'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'widgettitle_fontsize',
        array(
            'label' => __( 'Font Size', 'mtminimag' ),
            'section' => 'widgettitle_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $defaultFonts['widgettitle_fontsize'],
            ),
        )
    ));

    $wp_customize->add_setting('widgettitle_fontsize_unit', array (
        'default' => $defaultFonts['widgettitle_fontsize_unit'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_select'
    ));
    $wp_customize->add_control( 'widgettitle_fontsize_unit', array(
        'section' => 'widgettitle_typography',
        'type' => 'radio',
        'choices' => array(
            'px' => 'px',
            'em' => 'em',
        ),
    ));

    $wp_customize->add_setting('widgettitle_texttransform', array (
        'default' => $defaultFonts['widgettitle_texttransform'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_select'
    ));
    $wp_customize->add_control( 'widgettitle_texttransform', array (
        'label' => __('Text Transform', 'mtminimag'),
        'section' => 'widgettitle_typography',
        'type' => 'select',
        'choices' => array (
            'none' => 'None',
            'uppercase' => 'UPPERCASE',
            'lowercase' => 'lowercase',
            'capitalize' => 'Capitalize'
        ),
    ));

    $wp_customize->add_setting('widgettitle_alt_fontfamily', array (
        'default' => $defaultFonts['widgettitle_alt_fontfamily'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_select'
    ));
    $wp_customize->add_control( 'widgettitle_alt_fontfamily', array (
        'label' => __('Alt Font Family', 'mtminimag'),
        'section' => 'widgettitle_typography',
        'type' => 'select',
        'choices' => $altFontFamily,
    ));

    $wp_customize->add_setting( 'widgettitle_letterspacing', array(
        'default' => $defaultFonts['widgettitle_letterspacing'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'widgettitle_letterspacing',
        array(
            'label' => __( 'Letter Spacing (px)', 'mtminimag' ),
            'section' => 'widgettitle_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $defaultFonts['widgettitle_letterspacing'],
            ),
        )
    ));

    $wp_customize->add_setting('widgettitle_fontweight', array (
        'default' => $defaultFonts['widgettitle_fontweight'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_select'
    ));
    $wp_customize->add_control( 'widgettitle_fontweight', array (
        'label' => __('Font Weight', 'mtminimag'),
        'section' => 'widgettitle_typography',
        'type' => 'select',
        'choices' => array (
            'normal' => 'normal',
            '100' => '100',
            '200' => '200',
            '300' => '300',
            '400' => '400',
            '500' => '500',
            '600' => '600',
            '700' => '700',
            '800' => '800',
            '900' => '900',
        ),
    ));

    $wp_customize->add_setting( 'widgettitle_lineheight', array(
        'default' => $defaultFonts['widgettitle_lineheight'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'widgettitle_lineheight',
        array(
            'label' => __( 'Line Height (px)', 'mtminimag' ),
            'section' => 'widgettitle_typography',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => $defaultFonts['widgettitle_lineheight'],
            ),
        )
    ));

    //
    // ─── LAYOUT MANAGEMENT ──────────────────────────────────────────────────────────
    //
    $wp_customize->add_panel('layout_mgt', array(
        'title' => __( 'Layout Management', 'mtminimag' ),
    ));

    // Sidebar Position
    $wp_customize->add_section('sidebar_position', array (
        'title' => __('Sidebar Position', 'mtminimag'),
        'description' => 'Manage Sidebar Position for your site.',
        'panel' => 'layout_mgt',
    ));
    // Homepage Sidebar
    $wp_customize->add_setting('default_sidebar', array (
        'default' => $defaults['default_sidebar'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_select'
    ));
    $wp_customize->add_control( 'default_sidebar', array (
        'label' => __('Default Sidebar Position', 'mtminimag'),
        'section' => 'sidebar_position',
        'type' => 'select',
        'choices' => array (
            'right' => 'Right Sidebar',
            'left' => 'Left Sidebar',
            'none' => 'No Sidebar',
        ),
    ));

    // Single post sidebar
    $wp_customize->add_setting('singlepost_sidebar', array (
        'default' => $defaults['singlepost_sidebar'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_select'
    ));
    $wp_customize->add_control( 'singlepost_sidebar', array (
        'label' => __('Single Post Sidebar', 'mtminimag'),
        'section' => 'sidebar_position',
        'type' => 'select',
        'choices' => array (
            'right' => 'Right Sidebar',
            'left' => 'Left Sidebar',
            'default' => $defaults['singlepost_sidebar'],
        ),
    ));

    // Single page sidebar
    $wp_customize->add_setting('singlepage_sidebar', array (
        'default' => $defaults['singlepage_sidebar'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_select'
    ));
    $wp_customize->add_control( 'singlepage_sidebar', array (
        'label' => __('Single Page Sidebar', 'mtminimag'),
        'section' => 'sidebar_position',
        'type' => 'select',
        'choices' => array (
            'right' => 'Right Sidebar',
            'left' => 'Left Sidebar',
            'default' => $defaults['singlepage_sidebar'],
        ),
    ));

    // Archive sidebar
    $wp_customize->add_setting('archive_sidebar', array (
        'default' => $defaults['archive_sidebar'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_select'
    ));
    $wp_customize->add_control( 'archive_sidebar', array (
        'label' => __('Archive Sidebar', 'mtminimag'),
        'section' => 'sidebar_position',
        'type' => 'select',
        'choices' => array (
            'right' => 'Right Sidebar',
            'left' => 'Left Sidebar',
            'default' => $defaults['archive_sidebar'],
        ),
    ));

    // Sidebar Width
    $wp_customize->add_setting( 'sidebar_width', array(
        'default' => $defaults['sidebar_width'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'sidebar_width',
        array(
            'label' => __( 'Sidebar Width', 'mtminimag' ),
            'section' => 'sidebar_position',
            'input_attrs' => array(
                'min' => 200,
                'max' => 400,
                'step' => 1,
                'default' => $defaults['sidebar_width'],
            ),
        )
    ));

    //
    // ─── HEADER MANAGEMENT ──────────────────────────────────────────────────────────
    //
    $wp_customize->add_panel('header_mgt', array(
        'title' => __( 'Header Management', 'mtminimag' ),
    ));

    // Header Style
    $wp_customize->add_section('header_style', array (
        'title' => __('Header Style', 'mtminimag'),
        'description' => 'Manage Header Styles for your site.',
        'panel' => 'header_mgt',
    ));

    $wp_customize->add_setting( 'header_style',
        array(
            'default' => $defaults['header_style'],
            'transport' => 'refresh',
            'sanitize_callback' => 'mtminimag_sanitize_select'
        )
    );
    $wp_customize->add_control(
        new MightyThemes_Image_Radio_Button_Custom_Control(
        $wp_customize,
        'header_style',
        array(
            'label' => __( 'Choose Header Style', 'mtminimag' ),
            'section' => 'header_style',
            'choices' => array(
                'stacked' => array(
                    'image' => trailingslashit( get_template_directory_uri() ) . 'inc/assets/images/controls/stacked.svg',
                    'name' => __( 'Stacked', 'mtminimag' )
                ),
                'horizontal' => array(
                    'image' => trailingslashit( get_template_directory_uri() ) . 'inc/assets/images/controls/horizontal.svg',
                    'name' => __( 'Horizontal', 'mtminimag' )
                ),
            )
        )
    ));


    // Header Tagline
    $wp_customize->add_setting('header_tagline', array (
        'default' => $defaults['header_tagline'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_checkbox'
    ));
    $wp_customize->add_control( 'enable_header_tagline', array(
        'label' => __('Enable Tagline', 'mtminimag'),
        'section' => 'header_style',
        'type' => 'checkbox',
    ));

    // Enable/Disable sticky header
    $wp_customize->add_setting( 'enable_sticky_header', array(
        'default' => $defaults['enable_sticky_header'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_checkbox'
    ));
    $wp_customize->add_control(
        new MightyThemes_Toggle_Switch_Custom_control(
        $wp_customize,
        'enable_sticky_header',
        array(
            'label' => __( 'Enable Sticky Header', 'mtminimag' ),
            'section' => 'header_style'
        )
    ));

    // Enable/Disable search in header
    $wp_customize->add_setting( 'show_search', array(
        'default' => $defaults['show_search'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_checkbox'
    ));
    $wp_customize->add_control(
        new MightyThemes_Toggle_Switch_Custom_control(
        $wp_customize,
        'show_search',
        array(
            'label' => __( 'Enable Search', 'mtminimag' ),
            'section' => 'header_style'
        )
    ));
    // Enable/Disable search in mobile view
    $wp_customize->add_setting( 'show_search_mobile', array(
        'default' => $defaults['show_search_mobile'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_checkbox'
    ));
    $wp_customize->add_control(
        new MightyThemes_Toggle_Switch_Custom_control(
        $wp_customize,
        'show_search_mobile',
        array(
            'label' => __( 'Enable Search on Mobile', 'mtminimag' ),
            'section' => 'header_style'
        )
    ));
    // Enable/Disable Topbar
    $wp_customize->add_setting( 'show_topbar', array(
        'default' => $defaults['show_topbar'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_checkbox'
    ));
    $wp_customize->add_control(
        new MightyThemes_Toggle_Switch_Custom_control(
        $wp_customize,
        'show_topbar',
        array(
            'label' => __( 'Show Topbar', 'mtminimag' ),
            'section' => 'header_style'
        )
    ));
    //
    // ─── AD MANAGEMENT ──────────────────────────────────────────────────────────────
    //
    $wp_customize->add_panel('ad_mgt', array(
        'title' => __( 'Ad Management', 'mtminimag' ),
    ));

    // Enable/Disable Adverts
    $wp_customize->add_section('ad_appearance', array (
        'title' => __('Appearance', 'mtminimag'),
        'description' => 'Enable/Disable Ads on your site.',
        'panel' => 'ad_mgt',
    ));
    
    $wp_customize->add_setting( 'ads_posts', array(
        'default' => $defaults['ads_posts'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_checkbox'
    ));
    $wp_customize->add_control(
        new MightyThemes_Toggle_Switch_Custom_control(
        $wp_customize,
        'ads_posts',
        array(
            'label' => __( 'Posts', 'mtminimag' ),
            'section' => 'ad_appearance'
        )
    ));

    $wp_customize->add_setting( 'ads_pages', array(
        'default' => $defaults['ads_pages'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_checkbox'
    ));
    $wp_customize->add_control(
        new MightyThemes_Toggle_Switch_Custom_control(
        $wp_customize,
        'ads_pages',
        array(
            'label' => __( 'Pages', 'mtminimag' ),
            'section' => 'ad_appearance'
        )
    ));

    // Adverts on position
    $wp_customize->add_section('adverts_position', array (
        'title' => __('Assign Position', 'mtminimag'),
        'description' => 'Code for showing ad in the specified position.',
        'panel' => 'ad_mgt',
    ));
    // Adverts on Beginning of Post/Page
    $wp_customize->add_setting('ad_code_post_begin', array (
        'default' => $defaults['ad_code_post_begin'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_textarea'
    ));
    $wp_customize->add_control( 'ad_code_post_begin', array(
        'label' => __('Code of advert at the Beginning of Post/Page.', 'mtminimag'),
        'section' => 'adverts_position',
        'type' => 'textarea',
    ));
    // Adverts on Middle of Post/Page
    $wp_customize->add_setting('ad_code_post_middle', array (
        'default' => $defaults['ad_code_post_middle'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_textarea'
    ));
    $wp_customize->add_control( 'ad_code_post_middle', array(
        'label' => __('Code of advert at the Middle of Post/Page.', 'mtminimag'),
        'section' => 'adverts_position',
        'type' => 'textarea',
    ));
    // Adverts on End of Post/Page
    $wp_customize->add_setting('ad_code_post_end', array (
        'default' => $defaults['ad_code_post_end'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_textarea'
    ));
    $wp_customize->add_control( 'ad_code_post_end', array(
        'label' => __('Code of advert at the End of Post/Page.', 'mtminimag'),
        'section' => 'adverts_position',
        'type' => 'textarea',
    ));
    // Adverts on Right before the last paragraph
    $wp_customize->add_setting('ad_before_last_paragraph', array (
        'default' => $defaults['ad_before_last_paragraph'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_textarea'
    ));
    $wp_customize->add_control( 'ad_before_last_paragraph', array(
        'label' => __('Code of advert before the last paragraph.', 'mtminimag'),
        'section' => 'adverts_position',
        'type' => 'textarea',
    ));
    // Adverts on [number] paragraph
    $wp_customize->add_setting('paragraph_number', array (
        'default' => $defaults['paragraph_number'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_number'
    ));
    $wp_customize->add_control( 'paragraph_number', array(
        'label' => __('Paragraph Number', 'mtminimag'),
        'section' => 'adverts_position',
        'type' => 'number',
        'input_attrs' => array(
            'min' => 1,
            'max' => 200,
            'step' => 1,
        ),
    ));

    $wp_customize->add_setting('ad_after_numbered_paragraph', array (
        'default' => $defaults['ad_after_numbered_paragraph'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_textarea'
    ));
    $wp_customize->add_control( 'ad_after_numbered_paragraph', array(
        'label' => __('Code of advert after the [number] paragraph.', 'mtminimag'),
        'section' => 'adverts_position',
        'type' => 'textarea',
    ));

    //
    // ─── MISCELLANEOUS ──────────────────────────────────────────────────────────────
    //
    $wp_customize->add_panel('misc', array(
        'title' => __( 'Miscellaneous', 'mtminimag' ),
    ));

    /* Pagination */
    $wp_customize->add_section('pagination', array (
        'title' => __('Pagination', 'mtminimag'),
        'panel' => 'misc',
    ));
    $wp_customize->add_setting('pagination_type', array (
        'default' => $defaults['pagination_type'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_select'
    ));
    $wp_customize->add_control( 'pagination_type', array(
        'label' => __('Pagination Type', 'mtminimag'),
        'section' => 'pagination',
        'description' => 'Enable Pagination type',
        'type' => 'select',
        'choices' => array(
            'prev-next' => 'Prev/Next',
            'load-more' => 'Load More',
            'numbered' => 'Numbered'
        )
    ));

    /* Single Post */
    $wp_customize->add_section('single_post', array (
        'title' => __('Single Post', 'mtminimag'),
        'panel' => 'misc',
    ));
    
    // Post-meta options
    $wp_customize->add_setting( 'show_author', array(
        'default' => $defaults['show_author'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_checkbox'
    ));
    $wp_customize->add_control(
        new MightyThemes_Toggle_Switch_Custom_control(
        $wp_customize,
        'show_author',
        array(
            'label' => __( 'Show Author', 'mtminimag' ),
            'section' => 'single_post'
        )
    ));

    $wp_customize->add_setting( 'show_readtime', array(
        'default' => $defaults['show_readtime'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_checkbox'
    ));
    $wp_customize->add_control(
        new MightyThemes_Toggle_Switch_Custom_control(
        $wp_customize,
        'show_readtime',
        array(
            'label' => __( 'Show Estimated Read Time', 'mtminimag' ),
            'section' => 'single_post'
        )
    ));

    $wp_customize->add_setting( 'show_date', array(
        'default' => $defaults['show_date'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_checkbox'
    ));
    $wp_customize->add_control(
        new MightyThemes_Toggle_Switch_Custom_control(
        $wp_customize,
        'show_date',
        array(
            'label' => __( 'Show Date', 'mtminimag' ),
            'section' => 'single_post'
        )
    ));

    $wp_customize->add_setting( 'show_category', array(
        'default' => $defaults['show_category'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_checkbox'
    ));
    $wp_customize->add_control(
        new MightyThemes_Toggle_Switch_Custom_control(
        $wp_customize,
        'show_category',
        array(
            'label' => __( 'Show Categories', 'mtminimag' ),
            'section' => 'single_post'
        )
    ));

    // Enable/Disable Social Share Icon
    $wp_customize->add_setting( 'social_share_enable', array(
        'default' => $defaults['social_share_enable'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_checkbox'
    ));
    $wp_customize->add_control(
        new MightyThemes_Toggle_Switch_Custom_control(
        $wp_customize,
        'social_share_enable',
        array(
            'label' => __( 'Enable Social Share Buttons', 'mtminimag' ),
            'section' => 'single_post'
        )
    ));

    // Enable/Disable Post Views
    $wp_customize->add_setting( 'show_post_views', array(
        'default' => $defaults['show_post_views'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_checkbox'
    ));
    $wp_customize->add_control(
        new MightyThemes_Toggle_Switch_Custom_control(
        $wp_customize,
        'show_post_views',
        array(
            'label' => __( 'Show Post Views', 'mtminimag' ),
            'section' => 'single_post'
        )
    ));

    $wp_customize->add_setting( 'show_comment_counts', array(
        'default' => $defaults['show_comment_counts'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_checkbox'
    ));
    $wp_customize->add_control(
        new MightyThemes_Toggle_Switch_Custom_control(
        $wp_customize,
        'show_comment_counts',
        array(
            'label' => __( 'Show Comment Count', 'mtminimag' ),
            'section' => 'single_post'
        )
    ));

    $wp_customize->add_setting( 'show_tags', array(
        'default' => $defaults['show_tags'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_checkbox'
    ));
    $wp_customize->add_control(
        new MightyThemes_Toggle_Switch_Custom_control(
        $wp_customize,
        'show_tags',
        array(
            'label' => __( 'Show Tags', 'mtminimag' ),
            'section' => 'single_post'
        )
    ));

    $wp_customize->add_setting( 'show_authorinfobox', array(
        'default' => $defaults['show_authorinfobox'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_checkbox'
    ));
    $wp_customize->add_control(
        new MightyThemes_Toggle_Switch_Custom_control(
        $wp_customize,
        'show_authorinfobox',
        array(
            'label' => __( 'Enable Author Info Box', 'mtminimag' ),
            'section' => 'single_post'
        )
    ));

    // Enable/Disable Related Posts
    $wp_customize->add_setting( 'related_post_enable', array(
        'default' => $defaults['related_post_enable'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_checkbox'
    ));
    $wp_customize->add_control(
        new MightyThemes_Toggle_Switch_Custom_control(
        $wp_customize,
        'related_post_enable',
        array(
            'label' => __( 'Enable Related Posts', 'mtminimag' ),
            'section' => 'single_post'
        )
    ));
    // Related posts by control
    $wp_customize->add_setting('related_post_by', array (
        'default' => 'related_post_by',
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_select'
    ));
    $wp_customize->add_control( 'related_post_by', array(
        'label' => __('Related Posts By', 'mtminimag'),
        'section' => 'single_post',
        'type' => 'select',
        'choices' => array(
            'categories' => 'Categories',
            'tags' => 'Tags',
        )
    ));
    // Related posts count control
    $wp_customize->add_setting('related_post_count', array (
        'default' => $defaults['related_post_count'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_number'
    ));
    $wp_customize->add_control( 'related_post_count', array(
        'label' => __('Related Posts Count', 'mtminimag'),
        'section' => 'single_post',
        'type' => 'number',
    ));

    /* Archive */
    $wp_customize->add_section('archive', array (
        'title' => __('Archive', 'mtminimag'),
        'description' => '',
        'panel' => 'misc',
    ));

    $wp_customize->add_setting( 'estimated_read_time_archive', array(
        'default' => $defaults['estimated_read_time_archive'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_checkbox'
    ));
    $wp_customize->add_control(
        new MightyThemes_Toggle_Switch_Custom_control(
        $wp_customize,
        'estimated_read_time_archive',
        array(
            'label' => __( 'Show Read Time', 'mtminimag' ),
            'section' => 'archive'
        )
    ));

    $wp_customize->add_setting( 'show_author_archive', array(
        'default' => $defaults['show_author_archive'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_checkbox'
    ));
    $wp_customize->add_control(
        new MightyThemes_Toggle_Switch_Custom_control(
        $wp_customize,
        'show_author_archive',
        array(
            'label' => __( 'Show Author', 'mtminimag' ),
            'section' => 'archive'
        )
    ));

    $wp_customize->add_setting( 'show_category_archive', array(
        'default' => $defaults['show_category_archive'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_checkbox'
    ));
    $wp_customize->add_control(
        new MightyThemes_Toggle_Switch_Custom_control(
        $wp_customize,
        'show_category_archive',
        array(
            'label' => __( 'Show Categories', 'mtminimag' ),
            'section' => 'archive'
        )
    ));

    $wp_customize->add_setting( 'show_date_archive', array(
        'default' => $defaults['show_date_archive'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_checkbox'
    ));
    $wp_customize->add_control(
        new MightyThemes_Toggle_Switch_Custom_control(
        $wp_customize,
        'show_date_archive',
        array(
            'label' => __( 'Show Date', 'mtminimag' ),
            'section' => 'archive'
        )
    ));

    $wp_customize->add_setting( 'show_excerpt', array(
        'default' => $defaults['show_excerpt'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_checkbox'
    ));
    $wp_customize->add_control(
        new MightyThemes_Toggle_Switch_Custom_control(
        $wp_customize,
        'show_excerpt',
        array(
            'label' => __( 'Show Excerpt', 'mtminimag' ),
            'section' => 'archive'
        )
    ));
    
    // Excerpt length (when enabled)
    $wp_customize->add_setting( 'excerpt_length', array(
        'default' => $defaults['excerpt_length'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_number'
    ));
    $wp_customize->add_control(
        new MightyThemes_Slider_Custom_Control( 
        $wp_customize, 
        'excerpt_length',
        array(
            'label' => __( 'Excerpt Length', 'mtminimag' ),
            'section' => 'archive',
            'input_attrs' => array(
                'min' => 1,
                'max' => 1000,
                'step' => 1,
                'default' => $defaults['excerpt_length'],
            ),
        )
    ));

    // Enable Read more
    $wp_customize->add_setting( 'enable_read_more', array(
        'default' => $defaults['enable_read_more'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_checkbox'
    ));
    $wp_customize->add_control(
        new MightyThemes_Toggle_Switch_Custom_control(
        $wp_customize,
        'enable_read_more',
        array(
            'label' => __( 'Enable Read More', 'mtminimag' ),
            'section' => 'archive'
        )
    ));

    // Read more text
    $wp_customize->add_setting('read_more_text', array (
        'default' => $defaults['read_more_text'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control( 'read_more_text', array(
        'label' => __('Read More Text', 'mtminimag'),
        'section' => 'archive',
        'type' => 'text',
    ));
    
    /* 404 Error Page */
    $wp_customize->add_section('404_error_page', array (
        'title' => __('404 Error Page', 'mtminimag'),
        'description' => '',
        'panel' => 'misc',
    ));

    $wp_customize->add_setting('404_page_content', array (
        'default' => $defaults['404_page_content'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'mtminimag_sanitize_textarea'
    ));
    $wp_customize->add_control( '404_page_content', array(
        'label' => __('404 Page Content', 'mtminimag'),
        'section' => '404_error_page',
        'type' => 'textarea',
    ));

    $wp_customize->add_setting('calltoaction', array (
        'default' => $defaults['calltoaction'],
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control( 'calltoaction', array(
        'label' => __('Call To Action', 'mtminimag'),
        'section' => '404_error_page',
        'type' => 'text'
    ));

    //
    // ─── SOCIAL PROFILES ────────────────────────────────────────────────────────────
    //

    // Social Profiles Section
    $wp_customize->add_section( 'social_profiles', array(
        'title' => __('Social Profiles', 'mtminimag'),
        'description' => '',
    ));

    // Social Profiles Controls
    $wp_customize->add_setting('facebook', array (
        'default' => $defaults['facebook'],
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control( 'facebook', array(
        'label' => __('Facebook', 'mtminimag'),
        'section' => 'social_profiles',
        'type' => 'text'
    ));
    $wp_customize->add_setting('twitter', array (
        'default' => $defaults['twitter'],
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control( 'twitter', array(
        'label' => __('Twitter', 'mtminimag'),
        'section' => 'social_profiles',
        'type' => 'text'
    ));
    $wp_customize->add_setting('instagram', array (
        'default' => $defaults['instagram'],
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control( 'instagram', array(
        'label' => __('Instagram', 'mtminimag'),
        'section' => 'social_profiles',
        'type' => 'text'
    ));
    $wp_customize->add_setting('youtube', array (
        'default' => $defaults['youtube'],
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control( 'youtube', array(
        'label' => __('YouTube', 'mtminimag'),
        'section' => 'social_profiles',
        'type' => 'text'
    ));
    $wp_customize->add_setting('linkedin', array (
        'default' => $defaults['linkedin'],
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control( 'linkedin', array(
        'label' => __('LinkedIn', 'mtminimag'),
        'section' => 'social_profiles',
        'type' => 'text'
    ));
    $wp_customize->add_setting('spotify', array (
        'default' => $defaults['spotify'],
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control( 'spotify', array(
        'label' => __('Spotify', 'mtminimag'),
        'section' => 'social_profiles',
        'type' => 'text'
    ));
    $wp_customize->add_setting('messenger', array (
        'default' => $defaults['messenger'],
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control( 'messenger', array(
        'label' => __('Messenger', 'mtminimag'),
        'section' => 'social_profiles',
        'type' => 'text'
    ));
    $wp_customize->add_setting('github', array (
        'default' => $defaults['github'],
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control( 'github', array(
        'label' => __('GitHub', 'mtminimag'),
        'section' => 'social_profiles',
        'type' => 'text'
    ));
    $wp_customize->add_setting('whatsapp', array (
        'default' => $defaults['whatsapp'],
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control( 'whatsapp', array(
        'label' => __('WhatsApp', 'mtminimag'),
        'section' => 'social_profiles',
        'type' => 'text'
    ));
    $wp_customize->add_setting('telegram', array (
        'default' => $defaults['telegram'],
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control( 'telegram', array(
        'label' => __('Telegram', 'mtminimag'),
        'section' => 'social_profiles',
        'type' => 'text'
    ));

    //
    // ─── CUSTOM CODE ────────────────────────────────────────────────────────────
    //
    // Custom Code Section
    $wp_customize->add_section( 'custom_code', array(
        'title' => __('Custom Code', 'mtminimag'),
        'description' => '',
    ));

    // Custom Code Controls
    $wp_customize->add_setting('tracking_code', array (
        'default' => $defaults['tracking_code'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_textarea'
    ));
    $wp_customize->add_control( 'tracking_code', array(
        'label' => __('Tracking Code', 'mtminimag'),
        'section' => 'custom_code',
        'type' => 'textarea',
    ));

    $wp_customize->add_setting('space_before_head', array (
        'default' => $defaults['space_before_head'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_textarea'
    ));
    $wp_customize->add_control( 'space_before_head', array(
        'label' => __('Space Before </head>', 'mtminimag'),
        'section' => 'custom_code',
        'type' => 'textarea',
    ));

    $wp_customize->add_setting('space_before_body', array (
        'default' => $defaults['space_before_body'],
        'transport' => 'refresh',
        'sanitize_callback' => 'mtminimag_sanitize_textarea'
    ));
    $wp_customize->add_control( 'space_before_body', array(
        'label' => __('Space Before </body>', 'mtminimag'),
        'section' => 'custom_code',
        'type' => 'textarea',
    ));
}
add_action('customize_register', 'mtminimag_customize_register');

//
// ─── LIVE PREVIEW WITH INSTANTNEOUS CHANGES ─────────────────────────────────────
//
function mtminimag_preview_customizer() {
	wp_enqueue_script('mtminimag_preview_customizer', get_template_directory_uri() . '/inc/customizer/js/customizer.js', array( 'jquery','customize-preview' ), '', true	);
}
add_action( 'customize_preview_init', 'mtminimag_preview_customizer' );

//
// ─── CONTROLS MANIPULATION ON CONDITIONS ────────────────────────────────────────
//
function mtminimag_panels_js() {
	wp_enqueue_script( 'mtminimag-customize-controls', get_theme_file_uri( '/inc/customizer/js/customize-controls.js' ), array(), '20181231', true );
}
add_action( 'customize_controls_enqueue_scripts', 'mtminimag_panels_js' );

//
// ─── FONT FAMILY OF ELEMENTS ────────────────────────────────────────────────────
//
function add_font_styles()
{
    $fontsRequested = array(
        getOption( 'fonts', 'body_fontfamily'),
        getOption( 'fonts', 'h1_fontfamily' ),
        getOption( 'fonts', 'h2_fontfamily' ),
        getOption( 'fonts', 'h3_fontfamily' ),
        getOption( 'fonts', 'h4_fontfamily' ),
        getOption( 'fonts', 'h5_fontfamily' ),
        getOption( 'fonts', 'h6_fontfamily' ),
        getOption( 'fonts', 'logo_fontfamily' ),
        getOption( 'fonts', 'mainmenu_fontfamily' ),
        getOption( 'fonts', 'dropdown_fontfamily' ),
        getOption( 'fonts', 'entrytitle_fontfamily' ),
        getOption( 'fonts', 'posttitle_fontfamily' ),
        getOption( 'fonts', 'meta_fontfamily' ),
        getOption( 'fonts', 'widgettitle_fontfamily' ),
    );

    $fonts = implode("|", array_filter( array_unique( $fontsRequested)));
    
    wp_enqueue_style( 'mtminimag-fonts', '//fonts.googleapis.com/css?family=' . $fonts .'&display=swap' );
}
add_action('wp_enqueue_scripts', 'add_font_styles');