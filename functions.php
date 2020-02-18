<?php
/**
 * MT Minimag functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package mtminimag
 */

if ( ! function_exists( 'mtminimag_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function mtminimag_setup() {

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary-menu' => esc_html__( 'Primary Menu', 'mtminimag' ),
			'top-menu' => esc_html__( 'Top Menu', 'mtminimag' ),
			'offcanvas-menu' => esc_html__( 'Offcanvas Menu', 'mtminimag' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'mtminimag_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 120,
			'width'       => 90,
			'flex-width'  => true,
			'flex-height'  => false,
		));

		// This theme styles the visual editor with editor-style.css to match the theme style.
		add_editor_style();
	}
endif;
add_action( 'after_setup_theme', 'mtminimag_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function mtminimag_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'mtminimag_content_width', 640 );
}
add_action( 'after_setup_theme', 'mtminimag_content_width', 0 );

/**
 * Filter the except length to 20 words.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function wpdocs_custom_excerpt_length( $length ) {
	return getOption('defaults', 'excerpt_length');
}
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function mtminimag_widgets_init() {
    // Widgets for right sidebar
    register_sidebar( array(
		'name'          => __( 'Sidebar Right', 'mtminimag' ),
		'id'            => 'sidebar-right',
		'description'   => __( 'Add widgets here to appear in right sidebar.', 'mtminimag' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="section-heading"><h2 class="widget-title">',
		'after_title'   => '</h2></div>',
	) );
    
    // Widgets for left sidebar
    register_sidebar( array(
		'name'          => __( 'Sidebar Left', 'mtminimag' ),
		'id'            => 'sidebar-left',
		'description'   => __( 'Add widgets here to appear in left sidebar.', 'mtminimag' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="section-heading"><h2 class="widget-title">',
		'after_title'   => '</h2></div>',
	) );

	// Widget for homepage (Top)
	register_sidebar( array(
		'name'          => 'Homepage Widgets (Top)',
		'id'            => 'home_widget_top',
		'description'   => __( 'Add widgets here to appear in Homepage (Top).', 'mtminimag' ),
		'before_widget' => '<div class="feature-posts"><div id="%1$s" class="widget homepage_widget_top %2$s">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	// Widget for homepage (Bottom)
	register_sidebar( array(
		'name'          => 'Homepage Widgets (Bottom)',
		'id'            => 'home_widget_bottom',
		'description'   => __( 'Add widgets here to appear in Homepage (Bottom).', 'mtminimag' ),
		'before_widget' => '<div class="feature-posts"><div id="%1$s" class="widget homepage_widget_bottom %2$s">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	// Widget for offcanvas
	register_sidebar( array(
		'name'          => 'Offcanvas Widgets',
		'id'            => 'offcanvas_widget',
		'description'   => __( 'Add widgets here to appear in HomePage.', 'mtminimag' ),
		'before_widget' => '<div id="%1$s" class="%2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'mtminimag_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function mtminimag_scripts() {
	// Styles
	wp_enqueue_style( 'mtminimag-bootstrap', '//stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' );
	wp_enqueue_style( 'mtminimag-fontawesome', '//use.fontawesome.com/releases/v5.8.1/css/all.css' );
	wp_enqueue_style( 'mtminimag-style', get_stylesheet_uri() );

	// Scripts
	wp_enqueue_script('mtminimag-bootstrap', '//stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js', array('jquery'));
	wp_enqueue_script('mtminimag-popper', '//cdnjs.cloudflare.com/ajax/libs/popper.js/1.15.0/umd/popper.min.js', array('jquery'));
	wp_enqueue_script('mtminimag-main', get_template_directory_uri() . '/js/main.js', array('jquery'));
	
	if ( getOption('defaults', 'pagination_type') == 'load-more' ) :
		wp_enqueue_script( 'infinitescroll', get_template_directory_uri() . '/js/infinite-scroll.min.js', array(), '20151215', true );
	endif;

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'mtminimag_scripts' );

/**
 * Fix skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @link https://git.io/vWdr2
 */
function mtminimag_skip_link_focus_fix() {
	// The following is minified via `terser --compress --mangle -- js/skip-link-focus-fix.js`.
	?>
	<script>
	/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
	</script>
	<?php
}
add_action( 'wp_print_footer_scripts', 'mtminimag_skip_link_focus_fix' );

/**
 * Famous Posts Custom Widget For MT-Minimag
 */
require get_template_directory() . '/inc/customizer/custom/widget/class-mt-popular-posts.php';

/**
 * Category Posts Custom Widget For MT-Minimag
 */
require get_template_directory() . '/inc/customizer/custom/widget/class-mt-category-posts.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Theme Customizer Defaults
 */
require get_template_directory() . '/inc/defaults.php';
$defaults = mt_get_defaults();
$defaultColors = mt_get_color_defaults();
$defaultFonts = mt_get_default_fonts();

/**
 * MightyThemes Custom Controls
 */
require get_template_directory() . '/inc/customizer/custom/controls/custom-controls.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';
	
/**
 * Functions to sanitize customizer controls
 */
require get_template_directory() . '/inc/sanitize-functions.php';

/**
 * Advertisement Manager
 */
require get_template_directory() . '/inc/customizer/ad-manager.php';

/**
 * Customizer Menu Options
 */
require get_template_directory() . '/inc/customizer/controls.php';

/**
 * Styles for Live Preview
 */
require get_template_directory() . '/inc/customizer/live-preview-css.php';

/*
 * Admin Level Scripts
 */
if ( is_admin() ) {
    //
    // ─── CUSTOM METABOXES FOR POST LEVEL EDITOR ─────────────────────────────────────
    //
    require get_template_directory() . '/inc/guten/custom-meta-boxes.php';
}

/**
 * Core Update Features
 */
require get_template_directory() . '/inc/mt-core/mt-checker.php';
$mtupdater = Puc_v4_Factory::buildUpdateChecker(
	'https://github.com/mightythemes/mt-minimag/', // repo
	__FILE__, // path
	'mtminimag', // slug
	1 // check period
);

$mtupdater->setBranch('master');