<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package mtminimag
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>

    <?php echo getOption('defaults', 'space_before_head') ?>
</head>

<?php
	// Metabox Sidebar Status (Gutenberg)
	$metabox_sidebar_status = get_post_meta(get_the_ID(), 'mtminimag-sidebar-status', true) ? get_post_meta(get_the_ID(), 'mtminimag-sidebar-status', true) : "default";

	// Post Level
	if(is_single()) :
		// Sidebar Left
		if ( $metabox_sidebar_status == "default" ) {
			if ( getOption('defaults', 'singlepost_sidebar') == 'default' ) {
				if ( getOption('defaults', 'default_sidebar') == 'left' ) {
				?> 
					<body itemtype="https://schema.org/Blog" itemscope="itemscope" <?php body_class('has-sidebar'); ?> >
				<?php
				}
			} elseif ( getOption('defaults', 'singlepost_sidebar') == 'left') {
			?> 
				<body itemtype="https://schema.org/Blog" itemscope="itemscope" <?php body_class('has-sidebar'); ?> >
			<?php
			}
		}
		elseif ( $metabox_sidebar_status == "left" ) {
		?> 
			<body itemtype="https://schema.org/Blog" itemscope="itemscope" <?php body_class('has-sidebar'); ?> >
		<?php
		}

		// Sidebar Right
		if ( $metabox_sidebar_status == "default" ) {
			if ( getOption('defaults', 'singlepost_sidebar') == 'default' ) {
				if ( getOption('defaults', 'default_sidebar') == 'right' ) {
				?> 
						<body itemtype="https://schema.org/Blog" itemscope="itemscope" <?php body_class('has-sidebar'); ?> >
				<?php
				}
			} elseif ( getOption('defaults', 'singlepost_sidebar') == 'right') {
			?> 
					<body itemtype="https://schema.org/Blog" itemscope="itemscope" <?php body_class('has-sidebar'); ?> >
			<?php
			}
		}
		elseif ( $metabox_sidebar_status == "right" ) {
		?> 
				<body itemtype="https://schema.org/Blog" itemscope="itemscope" <?php body_class('has-sidebar'); ?> >
		<?php
		}

		// No Sidebar Enabled
		if ( getOption('defaults', 'default_sidebar') == 'none' ) {
			if ( getOption('defaults', 'singlepost_sidebar') == 'default' ) {
				?>
					<body itemtype="https://schema.org/Blog" itemscope="itemscope" <?php body_class(); ?> >
				<?php
			}
		}
	endif;
	
	// Page Level
	if(is_page()) :
		// Sidebar Left
		if( $metabox_sidebar_status == "default" ) {
			if ( getOption('defaults', 'singlepage_sidebar') == 'default' ) {
				if ( getOption('defaults', 'default_sidebar') == 'left' ) {
				?> 
					<body itemtype="https://schema.org/Blog" itemscope="itemscope" <?php body_class('has-sidebar'); ?> >
				<?php
				}
			} elseif ( getOption('defaults', 'singlepage_sidebar') == 'left') {
			?> 
				<body itemtype="https://schema.org/Blog" itemscope="itemscope" <?php body_class('has-sidebar'); ?> >
			<?php
			}
		}
		elseif( $metabox_sidebar_status == "left" ) {
		?> 
			<body itemtype="https://schema.org/Blog" itemscope="itemscope" <?php body_class('has-sidebar'); ?> >
		<?php
		}

		// Sidebar Right
		if( $metabox_sidebar_status == "default" ) {
			if ( getOption('defaults', 'singlepage_sidebar') == 'default' ) {
				if ( getOption('defaults', 'default_sidebar') == 'right' ) {
					?> 
						<body itemtype="https://schema.org/Blog" itemscope="itemscope" <?php body_class('has-sidebar'); ?> >
					<?php
				}
			} elseif ( getOption('defaults', 'singlepage_sidebar') == 'right') {
				?> 
					<body itemtype="https://schema.org/Blog" itemscope="itemscope" <?php body_class('has-sidebar'); ?> >
				<?php
			}
		}
		elseif( $metabox_sidebar_status == "right" ) {
			?> 
				<body itemtype="https://schema.org/Blog" itemscope="itemscope" <?php body_class('has-sidebar'); ?> >
			<?php
		}

		// No Sidebar Enabled
		if ( getOption('defaults', 'default_sidebar') == 'none' ) {
			if ( getOption('defaults', 'singlepage_sidebar') == 'default' ) {
				?>
					<body itemtype="https://schema.org/Blog" itemscope="itemscope" <?php body_class(); ?> >
				<?php
			}
		}
	endif;

	if( is_home() ) :
		// Sidebar Left
		if ( getOption('defaults', 'archive_sidebar') == 'default' ) {
			if ( getOption('defaults', 'default_sidebar') == 'left' ) {
			?> 
				<body itemtype="https://schema.org/Blog" itemscope="itemscope" <?php body_class('has-sidebar'); ?> >
			<?php
			}
		} elseif ( getOption('defaults', 'archive_sidebar') == 'left') {
		?> 
			<body itemtype="https://schema.org/Blog" itemscope="itemscope" <?php body_class('has-sidebar'); ?> >
		<?php
		}

		// Sidebar Right
		if ( getOption('defaults', 'archive_sidebar') == 'default' ) {
			if ( getOption('defaults', 'default_sidebar') == 'right' ) {
			?> 
				<body itemtype="https://schema.org/Blog" itemscope="itemscope" <?php body_class('has-sidebar'); ?> >
			<?php
			}
		} elseif ( getOption('defaults', 'archive_sidebar') == 'right') {
		?>
			<body itemtype="https://schema.org/Blog" itemscope="itemscope" <?php body_class('has-sidebar'); ?> >
		<?php
		}
		
		// No Sidebar Enabled
		if ( getOption('defaults', 'default_sidebar') == 'none' ) {
			if ( getOption('defaults', 'archive_sidebar') == 'default' ) {
				?>
					<body itemtype="https://schema.org/Blog" itemscope="itemscope" <?php body_class(); ?> >
				<?php
			}
		}
	endif;
?>

<?php
	/**
	 * Allow developers to inject code
	 *
	 * @link https://make.wordpress.org/core/2019/04/24/miscellaneous-developer-updates-in-5-2/
	 */
	if ( function_exists( 'wp_body_open' ) ) {
		wp_body_open();
	} else {
		do_action( 'wp_body_open' );
	}
?>

<a class="skip-link screen-reader-text" href="#content">
<?php _e( 'Skip to content', 'mtminimag' ); ?></a>


<?php
// Preloader
if ( getOption('defaults', 'preloader_status') ) :
    get_template_part('template-parts/preloader');
endif;
?>

<?php if ( getOption('defaults', 'backtotop_status') ) { ?>
	<!-- Back To Top -->
	<a id="backtotop" class="<?php echo (getOption('defaults', 'backtotop_shape')); ?><?php echo getOption('defaults', 'backtotop_mobile') ? ' d-none d-sm-block' : ''; ?>" href="javascript:void(0)" >
        <i class="<?php echo esc_html(getOption('defaults', 'backtotop_icon')); ?>"></i>
    </a>
<?php } ?>

<?php
	// TopBar
	if ( getOption('defaults', 'show_topbar') ) :
		get_template_part('template-parts/top', 'bar');
	endif;
?>

<!-- Header -->

<div class="big-container">
<section id="content" class="component-area">
	<?php
		// Header Options			
		switch( getOption('defaults', 'header_style') ):
			case 'horizontal':
				get_template_part( 'template-parts/headers/header', 'horizontal');
			break;
			case 'stacked':
				get_template_part( 'template-parts/headers/header', 'stacked');
			break;
		endswitch;
	?>
	<?php
		// Slider
		if( is_home() && getOption('defaults', 'enable_slider') && (getOption('defaults', 'no_of_posts') > 0) ) :
			get_template_part('template-parts/slider', 'section');
		endif;
	?>
	
		<div class="container">
			<div class="row component-area-inner">

				<?php
					// Homepage Widget Position (Top)
					if ( is_home() && is_active_sidebar('home_widget_top') ) :
				?>
					<div class="home-top-widget-area col-12">
						<?php dynamic_sidebar('home_widget_top'); ?>
					</div>
				<?php
					endif;
				?>
				<!-- Sidebar -->
				<?php
					/* Left Sidebar */
					// Metabox Sidebar Status (Gutenberg)
					$metabox_sidebar_status = get_post_meta(get_the_ID(), 'mtminimag-sidebar-status', true) ? get_post_meta(get_the_ID(), 'mtminimag-sidebar-status', true) : "default";
					
					// Post Level
					if(is_single()) :
						if ( $metabox_sidebar_status == "default" ) {
							if ( getOption('defaults', 'singlepost_sidebar') == 'default' ) {
								if ( getOption('defaults', 'default_sidebar') == 'left' ) {
									get_template_part( 'template-parts/sidebar/sidebar', 'left' );
								}
							} elseif ( getOption('defaults', 'singlepost_sidebar') == 'left') {
								get_template_part( 'template-parts/sidebar/sidebar', 'left' );
							}
						}
						elseif ( $metabox_sidebar_status == "left" ) {
							get_template_part( 'template-parts/sidebar/sidebar', 'left' );
						}
					endif;
					
					// Page Level
					if(is_page()) :
						if( $metabox_sidebar_status == "default" ) {
							if ( getOption('defaults', 'singlepage_sidebar') == 'default' ) {
								if ( getOption('defaults', 'default_sidebar') == 'left' ) {
									get_template_part( 'template-parts/sidebar/sidebar', 'left' );
								}
							} elseif ( getOption('defaults', 'singlepage_sidebar') == 'left') {
								get_template_part( 'template-parts/sidebar/sidebar', 'left' );
							}
						}
						elseif( $metabox_sidebar_status == "left" ) {
							get_template_part( 'template-parts/sidebar/sidebar', 'left' );
						}
					endif;

					// Homepage level
					if( is_home() ) :
						if ( getOption('defaults', 'archive_sidebar') == 'default' ) {
							if ( getOption('defaults', 'default_sidebar') == 'left' ) {
								get_template_part( 'template-parts/sidebar/sidebar', 'left' );
							}
						} elseif ( getOption('defaults', 'archive_sidebar') == 'left') {
							get_template_part( 'template-parts/sidebar/sidebar', 'left' );
						}
					endif;
				?>
				<div class="col main-content">
