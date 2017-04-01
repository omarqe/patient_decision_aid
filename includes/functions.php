<?php
/**
 * Patient Decision Aid (PDA) for Breast Cancer.
 * 
 * This work is originally coded by @omarqe and the team members. Please keep this copyright
 * notice for legal use.
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