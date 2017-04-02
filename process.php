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
 * @subpackage	PDA Form Processor
 **/

header( 'Content-type: application/json' );

if ( !defined('PDA_READY') || defined('PDA_READY') && !PDA_READY ) // No direct access
	exit;

init_locale( 'ajax' );

$action = parse_arg( 'action', $_REQUEST );
switch( $action ){
	case "worries":
		init_locale( 'ajax', 'worries' );

		$worries = parse_arg( 'worries', $_POST );
		if ( empty($worries) || !is_array($worries) )
			send_response( u('select_worry'), "red" );
			
		$worry_answers = array();
		foreach ( $worries as $i => $worry_n ){
			$worry = "enquiry{$worry_n}";
			if ( u($worry) == "undefined" )
				continue;

			$worry_answers[] = array(
				"worry" => u($worry),
				"lumpectomy" => u("{$worry}_lumpectomy"),
				"mastectomy" => u("{$worry}_mastectomy"),
				"alternative" => u("{$worry}_alternative"),
				"none" => u("{$worry}_no_treatment")
			);
		}

		send_response( "", "", true, compact('worry_answers') );
		exit;

	case "begin":
		$nickname = parse_arg( 'nickname', $_POST );
		$shake = 'input[name=nickname]';

		if ( empty($nickname) )
			send_response( u('nickname_pls'), 'yellow', false, compact('shake') );

		$nick_split = explode(' ', $nickname);
		if ( count($nick_split) > 1 ){
			$nickname = parse_arg( 0, $nickname );

			if ( strlen($nickname) > 15 )
				$nickname = substr( $nickname, 0, 15 );
		}

		send_response( "", "", true, compact('shake') );
		exit;

	// Process failed..
	default:
		send_response( u("ajax_error"), "red" );
}