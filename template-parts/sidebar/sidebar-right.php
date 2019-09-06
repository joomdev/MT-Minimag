<?php
/**
 * MT Minimag functions and definitions
 *
 * @link https://mightythemes.com
 *
 * @package mtminimag
 * @since 1.0.0
 */
if ( ! is_active_sidebar( 'sidebar-right' ) ) {
	return;
}
?>

<aside itemtype="https://schema.org/WPSideBar" itemscope="itemscope" class="col-12 sidebar">
	<?php dynamic_sidebar( 'sidebar-right' ); ?>
</aside>