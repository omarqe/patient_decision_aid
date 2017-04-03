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

/**
 * Get current language.
 * 
 * @see 	PDA_Language::get_current_lang()
 * @return 	string
 * @since 	0.1
 **/
function get_current_lang(){
	global $lang;
	return $lang->get_current_lang();
}

/**
 * Initialise language context.
 * 
 * @see 	PDA_Language::init_locale()
 * @return 	boolean
 * @since 	0.1
 **/
function init_locale(){
	global $lang;
	return $lang->init_locale(func_get_args());
}

/**
 * Get the translation.
 * 
 * @see 	PDA_Language::loc()
 * @return 	string
 * @since 	0.1
 **/
function loc( $key, $default = 'undefined' ){
	global $lang;
	return $lang->loc( $key, $default, array_slice(func_get_args(), 2) );
}

class PDA_Language {
	/**
	 * Available languages. The language codes are referred to the standard ISO 639-1 abbreviations.
	 * 
	 * @var 	array
	 * @access 	private
	 * @since 	0.1
	 **/
	private $langs = array(
		"en" => "en-GB.ini",	// English (British)
		"ms" => "ms.ini",		// Malay
		"zh" => "zh.ini",		// Chinese
		"bn" => "bn.ini",		// Bangladesh
		"ta" => "ta.ini"	// Tamil
	);

	/**
	 * Default language.
	 * 
	 * @var 	string
	 * @access 	protected
	 * @since 	0.1
	 **/
	protected $lang = "en";

	/**
	 * Default language files path.
	 * 
	 * @var 	string
	 * @access 	protected
	 * @since 	0.1
	 **/
	protected $lang_path = "";

	/**
	 * The language data.
	 * 
	 * @var 	array
	 * @access 	public
	 * @since 	0.1
	 **/
	public $language = array();

	/**
	 * The language data in a specific context.
	 * 
	 * @var 	array
	 * @access 	public
	 * @since 	0.1
	 **/
	public $language_context = array();

	/**
	 * Constructor function.
	 * 
	 * 
	 * 
	 **/
	public function __construct( $lang = 'en' ){
		$abspath = defined('ABSPATH') ? ABSPATH : dirname(dirname(__FILE__));

		if ( !array_key_exists($lang, $this->langs) || empty($lang) )
			$lang = "en";

		$lang 	= $this->lang = strtolower($lang);
		$file 	= parse_arg( $lang, $this->langs );
		$path 	= $this->lang_path = $abspath . '/lang';

		$language_file = $path . '/' . $file;
		if ( !file_exists($language_file) )
			die( "Language file (<code>$file</code>) is not exists in <code>$path</code>." );

		$decoded = NULL;
		if ( strtolower(get_file_extension($language_file)) == 'json' ){
			$get 	 = file_get_contents( $language_file );
			$decoded = json_decode( $get, true );
		} else {
			$decoded = parse_ini_file( $language_file, true );
			$decoded = array_change_key_case_recursive( $decoded, CASE_LOWER );
		}

		// File cannot be parsed due to format or syntax error in it.
		if ( $decoded === NULL || empty($decoded) )
			die( "Language file (<code>$file</code>) cannot be parsed. Please check the syntax." );

		$this->language = $decoded;
	}

	/**
	 * Get the parsed language data.
	 * 
	 * @return 	array
	 * @since 	0.1
	 **/
	protected function get_parsed_lang(){
		return $this->language;
	}

	/**
	 * Get the current language.
	 * 
	 * @return 	string
	 * @since 	0.1
	 **/
	public function get_current_lang(){
		return $this->lang;
	}

	/**
	 * Initialise language context.
	 * 
	 * @return 	boolean
	 * @since 	0.1
	 **/
	public function init_locale(){
		$lang_data  = $this->get_parsed_lang();
		$contexts	= parse_arg( 'context', $lang_data );
		$context 	= func_get_args();

		if ( empty($context) )
			die( "Please provide some context." );
		elseif ( !is_array($contexts) || empty($contexts) )
			die( "Context is not an array." );

		if ( isset($context[0]) && is_array($context[0]) )
			$context = $context[0];

		$new_language_contexts = array();
		foreach ( $context as $context_key ){
			if ( !array_key_exists($context_key, $contexts) )
				die( "The context is not found." );

			$new_language_contexts += parse_arg( $context_key, $contexts );
		}

		$this->language_context = $new_language_contexts;
		return true;
	}

	/**
	 * Get translation by the given key.
	 * 
	 * @param 	string 	$key 		The key. We'll check for the translation in the specific context first (if set). If
	 * 								the translation is not in the context, check the general context.
	 * @param 	string 	$default 	Optional. Fallback when we fail to find the translation within the language pack.
	 * @return 	string
	 * @since 	0.1
	 **/
	public function loc( $key, $default = 'undefined' ){
		$language 	= $this->language;
		$context 	= $this->language_context;

		$args = array_slice( func_get_args(), 2 );
		if ( isset($args[0]) && is_array($args[0]) )
			$args = $args[0];

		if ( empty($default) )
			$default = "undefined";

		// Found the translation in a specific context.
		if ( !empty($context) && array_key_exists($key, $context) ){
			$words = parse_arg( $key, $context );

			if ( !empty($args) )
				$words = vsprintf( $words, $args );

			return empty($words) ? $default : $words;
		}
		
		// Key cannot be 'context'.
		if ( $key == 'context' )
			return $default;

		$words = parse_arg( $key, $language );

		if ( !empty($args) )
			$words = vsprintf( $words, $args );

		return empty($words) ? $default : $words;
	}
}