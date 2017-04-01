<?php
/**
 * Patient Decision Aid (PDA) for Breast Cancer.
 * 
 * This work is originally coded by @omarqe and the team members. Please keep this copyright
 * notice for legal use. Some of the codes are derived from @omarqe's previous project, Payster.
 * 
 * @author 		Omar Mokhtar Al-Asad (@omarqe)
 * @link 		http://www.payster.me
 * @package		PDA
 **/

/**
 * Check whether variables declared in array.
 * 
 * @param 	array 	$keys 		The items in the globals array
 * @param 	array 	$array 		The globals
 * @param 	mixed 	$default 	The default value if the items are not in the 
 * 								globals.
 * @since 	0.0.1
 **/
function _elms( $keys, $array, $default = '' ){
	$return = array();
	foreach ( (array)$keys as $key )
		$return[$key] = array_key_exists($key, (array)$array) ? $array[$key] : $default;

	return $return;
}

/**
 * Alias of _elms()
 * 
 * @uses 	_elms()
 * @return 	array
 * @since 	0.1.36
 **/
function parse_args( $array_default, $array, $default = NULL ){
	return _elms( $array_default, $array, $default );
}

/**
 * Get the array_values() of parse_args() to be used when we're using list()
 * 
 * @param 	array|string 	$keys 	The keys, must be in order.
 * @param 	array 			$array 	The array.
 * @return 	array
 * @since 	0.1.36
 **/
function get_list( $keys, $array ){
	return array_values( parse_args((array)$keys, $array) );
}

/**
 * Checks whether a variable exists in an array but instead of returning the whole,
 * this function returns the value of the variable.
 * 
 * @param 	string 	$key 		The variable key.
 * @param 	array 	$array 		The array.
 * @param 	mixed 	$default 	The default value if not exists.
 * 
 * @return 	mixed
 * @since 	0.1.36
 **/
function parse_arg( $key, $array, $default = '' ){
	$args = parse_args( $key, (array)$array, $default );
	return $args[$key];
}

/**
 * Prints codes in HTML a <pre> block.
 * 
 * @param 	mixed 	$input 		The thing to print.
 * @param 	bool 	$return		Set to true to return the output instead of echoing it.
 * @return 	string
 * @since 	0.1.38
 **/
function print_p( $input, $return = false ){
	if ( '' === $input ) return '';

	$input = sprintf( '<pre>%s</pre>', print_r($input, true) );
	if ( $return )
		return $input;

	echo $input;
}

/**
 * Returns a string with translation. Note that HTML is not available through this.
 * 
 * @param 	string 	$key 		Translation key.
 * @param 	string 	$default 	Default fallback if the translation is unavailable.
 * 
 * @return 	string
 * @since 	0.1
 **/
function u( $key, $default = '' ){
	$args 	= array_slice(func_get_args(), 2);
	$string = loc($key, $default);

	if ( !empty($args) )
		$string = vsprintf( $string, $args );

	return htmlentities( $string );
}

/**
 * Prints a string with translation. Note that HTML is not available through this.
 * 
 * @param 	string 	$key 		Translation key.
 * @param 	string 	$default 	Default fallback if the translation is unavailable.
 * 
 * @return 	string
 * @since 	0.1
 **/
function o( $key, $default = '' ){
	$args 	= array_slice(func_get_args(), 2);
	$string = loc($key, $default);

	if ( !empty($args) )
		$string = vsprintf( $string, $args );

	echo htmlentities( $string );
}

function __( $string ){
	$args = func_get_args();
	$args = array_slice($args, 1);

	if ( empty($args) )
		return $string;

	if ( isset($args[0]) && is_array($args[0]) )
		return vsprintf($string, $args[0]);
	else
		return vsprintf($string, $args);
}

/**
 * Prints an escaped string
 * 
 * @param 	string 	$string 	The text to be printed.
 * @since 	0.0.1
 **/
function _e( $string ){
	$args = func_get_args();
	$args = array_slice($args, 1);

	if ( empty($args) ){
		echo $string;
		return;
	}

	echo __( $string, $args );
}

function __esc( $string ){
	$args = array_slice(func_get_args(), 1);

	$str = $string;
	if ( isset($args[0]) && $args[0] != false )
		$str = vsprintf($string, $args);

	return html_entity_decode($str);
}

function _esc( $string ){
	$args = array_slice(func_get_args(), 2);
	_e( htmlentities($string), $args );
}

function __e( $string ){
	$args = array_slice(func_get_args(), 1);

	if ( isset($args[0]) && $args[0] != false )
		$str = sprintf($string, $args);
	else
		$str = $string;

	if ( !$decode )
		echo $str;
	else
		echo html_entity_decode($str);
}

/**
 * Determine whether the page is requested via AJAX.
 * 
 * @return 	bool
 * @since 	0.1.21
 **/
function is_ajax_request(){
	return isset($_SERVER['HTTP_X_REQUESTED_WITH'])
		&& strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
}

/**
 * Alias of is_ajax_request().
 * 
 * @uses 	is_ajax_request()
 * @since 	0.1.30
 **/
function doing_ajax(){
	return is_ajax_request();
}