<?php

// checkbox sanitization function
function muzeum_sanitize_checkbox( $checked ) {
	// Boolean check.
	return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

// select sanitization function
function muzeum_sanitize_select( $input, $setting ) {
	// Ensure input is a slug.
	$input = sanitize_key( $input );
	// Get list of choices from the control associated with the setting.
	$choices = $setting->manager->get_control( $setting->id )->choices;
	// If the input is a valid key, return it; otherwise, return the default.
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}
