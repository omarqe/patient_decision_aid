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

session_start();

define( 'PDA_READY', true );
define( 'ABSPATH', dirname(__FILE__) );
define( 'INC'	 , '/includes' );

require_once( ABSPATH . INC . '/class-language.php' );
require_once( ABSPATH . INC . '/class-data.php' );
require_once( ABSPATH . INC . '/functions.php' );
require_once( ABSPATH . INC . '/pdflib/phpToPDF.php' );

/**
 * Create language object.
 * 
 * @since 	0.1
 **/
$GLOBALS['lang'] = new PDA_Language();

/**
 * Create data object.
 * 
 * @since 	0.2
 **/
$GLOBALS['data'] = new PDA_Data();

if ( doing_ajax() ){
	require_once( ABSPATH . '/process.php' );
	exit;
}