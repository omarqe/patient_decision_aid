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
			
		$worry_answers = $worry_data = array();
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

			$worry_data[] = $worry;
		}

		if ( !save_data(array("worries" => $worry_data)) )
			send_response( "Sorry, but we can't save your data at the moment. Please try again.", "red" );

		send_response( "", "", true, compact('worry_answers') );
		exit;

	case "begin":
		$nickname = ucwords( parse_arg('nickname', $_POST) );
		$shake = 'input[name=nickname]';

		if ( empty($nickname) )
			send_response( "Uh-oh, sorry but may we know your name before proceed?", "red", false, compact('shake') );

		$nick_split = explode(' ', $nickname);
		if ( count($nick_split) > 1 ){
			$nickname = parse_arg( 0, $nickname );
			if ( strlen($nickname) > 15 )
				$nickname = substr( $nickname, 0, 15 );
		}

		if ( ! save_data(compact('nickname')) )
			send_response( sprintf("We are sorry %s, but there's an error while processing your request. Please refresh and try again.", $nickname), "red", false );

		send_response( "", "", true );
		exit;

	case "choose_stage":
		$stage = parse_arg( 'stage', $_GET );
		if ( !is_numeric($stage) )
			send_response( "Sorry, we cannot proceed since we can't verify your cancer stage.", "red", false );
		elseif ( $stage <= 0 || $stage >= 3 )
			send_response( "Sorry, this PDA is only available to patients with cancer stage 1 and 2.", "red", false );

		if ( !save_data(array('cancer_stage' => (int)$stage)) )
			send_response( "Sorry, but we can't save your data right now.", "red", false );

		send_response( "", "", true );
		exit;

	case "concern":
		$inputarr = ['surgery_prefer_pos', 'surgery_prefer_neg', 'concerns', 'extras'];
		$required = array(
			'support_option1',
			'support_option2',
			'support_option3',
			'support_option4',
			'support_option5',
			'ready_for_decision',
			'ready_for_treatment'
		);


		$postdata = parse_args( array_merge($inputarr, $required), $_POST );
		$empties = array();
		foreach ( $postdata as $key => $value ){
			if ( in_array($key, $required) && empty($value) && !in_array($key, $empties) )
				$empties[] = $key;
		}

		if ( !empty($empties) )
			send_response( u("required_inputs_empty"), "red", false, compact('empties') );

		// Support options
		$support_options = array();
		foreach ( ['support_option1', 'support_option2', 'support_option3', 'support_option4', 'support_option5'] as $support_key ){
			$support_val = strtolower($postdata[$support_key]);
			$support_options[$support_key] = ($support_val === 'yes');
		}

		// Build the data structure
		$structure = array(
			"prefers" => array(
				"surgery" => $postdata['surgery_prefer_pos'],
				"no_surgery" => $postdata['surgery_prefer_neg']
			),
			"concern" => $postdata['concerns'],
			"support" => $support_options,
			"ready" => $postdata['ready_for_decision'],
			"preferred_treatment" => $postdata['ready_for_treatment']
		);

		//send_response(print_p($structure,true), 'green');

		if ( !save_data(array('knowing_important' => $structure)) )
			send_response( "Sorry, but we can't save your data right now.", "red", false );

		send_response("", "", true);
		exit;

		//pdf try

		require('fpdf.php');

		$str_data = file_get_contents("sample.json");
		$data = json_decode($str_data,true);

		ob_end_clean();
		ob_start();
		$pdf = new FPDF();
		$pdf->AddPage();
		$pdf->SetFont('Arial','B',16);
		$pdf->Cell(40,10,$data["nickname"]);
		$pdf->Cell(50,10,$data["cancer_stage"]);
		$pdf->Output('D','filename.pdf');
		ob_end_flush();

		//end of pdf try
	// Process failed..
	default:
		send_response( u("ajax_error"), "red" );
}