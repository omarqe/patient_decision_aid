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
 * @subpackage	PDA Language Parser
 **/

class PDA_Language {
	/**
	 * Available languages. The language codes are referred to the standard ISO 639-1 abbreviations.
	 * 
	 * @var 	array
	 * @access 	private
	 * @since 	0.1
	 **/
	private $langs = array(
		"en" => "en-GB.json",	// English (British)
		"ms" => "ms.json",		// Malay
		"zh" => "zh.json",		// Chinese
		"bn" => "bn.json",		// Bangladesh
		// "ta" => "ta.json"	// Tamil
	);

	/**
	 * Default language.
	 * 
	 * @var 	string
	 * @access 	protected
	 * @since 	0.1
	 **/
	protected $default = "en";

	/**
	 * Default language files path.
	 * 
	 * @var 	string
	 * @access 	protected
	 * @since 	0.1
	 **/
	protected $lang_path = "";

	/**
	 * 
	 * 
	 * 
	 * 
	 **/
	public function __construct( $lang ){
		$abspath = defined('ABSPATH') ? ABSPATH : dirname(dirname(__FILE__));

		$this->lang_path = $abspath . '/lang';
	}
}