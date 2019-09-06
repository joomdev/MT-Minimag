<?php

/**
 * Function to sanitize fonts
 */
function custom_sanitize_fonts($input)
{
    $valid = getGoogleFonts();
    
    if (array_key_exists($input, $valid)) {
        return $input;
    } else {
        return '';
    }
}

/**
 * Function to sanitize categories
 */
function custom_sanitize_category($input)
{
    $valid = getCategories();
    
    if (array_key_exists($input, $valid)) {
        return $input;
    } else {
        return '';
    }
}

/**
 * Function to sanitize number
 */
if ( ! function_exists( 'mtminimag_sanitize_number' ) ) :
	function mtminimag_sanitize_number ( $mtminimag_input, $mtminimag_setting ) {
		$mtminimag_sanitize_text = sanitize_text_field( $mtminimag_input );

		// If the input is an number, return it; otherwise, return the default
		return ( is_numeric( $mtminimag_sanitize_text ) ? $mtminimag_sanitize_text : $mtminimag_setting->default );
	}
endif;

/**
 * Sanitizing the checkbox
 */
if ( !function_exists('mtminimag_sanitize_checkbox') ) :
	function mtminimag_sanitize_checkbox( $checked ) {
		// Boolean check.
		return ( ( isset( $checked ) && true == $checked ) ? true : false );
	}
endif;

/**
 * Sanitizing the page/post
 */
if ( !function_exists('mtminimag_sanitize_page') ) :
	function mtminimag_sanitize_page( $input ) {
		// Ensure $input is an absolute integer.
		$page_id = absint( $input );
		// If $page_id is an ID of a published page, return it; otherwise, return false
		return ( 'publish' == get_post_status( $page_id ) ? $page_id : false );
	}
endif;

/**
 * Sanitizing the select/radio callback example
 */
if ( !function_exists('mtminimag_sanitize_select') ) :
	function mtminimag_sanitize_select( $input, $setting ) {

		$input = sanitize_text_field( $input );

		return $input;
	}
endif;

/**
 * Allowed HTML
 */
if ( !function_exists('mtminimag_sanitize_allowed_html') ) :
	function mtminimag_sanitize_allowed_html ( $input ) {
		$allowed_html = wp_kses_allowed_html();
		$output = wp_kses( $input, $allowed_html );
		return $output;
	}
endif;

/**
 * Textarea sanitization
 */
if ( !function_exists('mtminimag_sanitize_textarea') ) :
	function mtminimag_sanitize_textarea( $input ) {
		if ( current_user_can( 'unfiltered_html' ) ) {
			$output = $input;
		} else {
			$output = mtminimag_sanitize_allowed_html( $input );
		}
		return $output;
	}
endif;

/**
 * Separator Sanitization
 */
if ( !function_exists('mtminimag_sanitize_separator') ) :
	function mtminimag_sanitize_separator() {
		return true;
	}
endif;