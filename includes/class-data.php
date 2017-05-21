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
 * @subpackage	PDA Data Saver
 **/


/**
 * Save user's data into a file.
 * 
 * @return 	boolean
 * @since 	0.2
 **/
function save_data( $the_data ){
	global $data;
	return $data->save_data( $the_data );
}

/**
 * Switch language.
 * 
 * @return 	boolean
 * @since 	0.2
 **/
function switch_lang( $language ){
	global $data;
	return $data->switch_lang( $language );
}

/**
 * Get the patient's data.
 * 
 * @return 	boolean|array
 * @since 	0.2
 **/
function get_data(){
	global $data;
	return $data->get_data();
}

class PDA_Data {
	// function: save_data()
	// function: get_data()
	// function: get_step()
	// function: generate_file()

	/**
	 * The patient's session ID.
	 * 
	 * @access 	protected
	 * @var 	string
	 * @since 	0.2
	 **/
	protected $session_id = '';

	/**
	 * The data file path.
	 * 
	 * @access 	protected
	 * @var 	string
	 * @since 	0.2
	 **/
	protected $data_file = '';

	/**
	 * The data in the file.
	 * 
	 * @access 	protected
	 * @var 	array
	 * @since 	0.2
	 **/
	protected $data = array();

	/**
	 * Constructor function. Retrieve and verify the session ID, if session is not started, die. Get the file and read
	 * the data inside it, if the file is not exists, generate a new one.
	 * 
	 * @since 	0.2
	 **/
	public function __construct(){
		$session_id = $this->session_id = session_id();
		if ( empty($session_id) )
			die( "Session ID is not generated." );

		$path = ABSPATH . '/data';
		$file = sprintf( '%1$s/%2$s.json', $path, $session_id );

		$this->data_file = $file;
		if ( !file_exists($file) )
			$this->generate_file();

		$data = file_get_contents( $file );
		$data = json_decode( $data, true );

		// If the data is null, we consider whether to generate a new data or throw an error instead.
		if ( empty($data) || is_null($data) || !is_array($data) ){
			if ( file_exists($file) ){
				unlink( $file );
				$this->generate_file();
			} else {
				die( "We can't read your session data. Please restart the browser." );
			}
		}

		// Set the data instance
		$this->data = $data;
	}

	/**
	 * Generate the data file using the default values.
	 * 
	 * @since 	0.2
	 **/
	protected function generate_file(){
		$data = array(
			"language" 		=> "en",
			"nickname" 		=> null,
			"cancer_stage" 	=> null,
			"worries" 		=> [],
			"knowing_important" => array(
				"prefers" 	=> [],
				"concern" 	=> [],
				"support" 	=> [],
				"ready"		=> null,
				"preferred_treatment" => null,
				"extras" => null
			)
		);

		$data_json = json_encode( $data, JSON_PRETTY_PRINT );
		if ( !file_put_contents($this->data_file , $data_json) )
			die( "Data file is not generated." );
	}

	/**
	 * Switch the patient's language.
	 * 
	 * @param 	string 		$language 	The language code.
	 * @return 	boolean
	 * @since 	0.2
	 **/
	public function switch_lang( $language = 'en' ){
		$language = strtolower( $language );
		if ( strlen($language) > 2 || empty($language) || !in_array($language, get_available_langs()) )
			return false;

		return $this->save_data( compact('language') );
	}

	/**
	 * Save data into the patient's data file. Check the sample data in the data folder for the keys. 
	 * 
	 * @param 	array 		$data 	The data to save.
	 * @return 	boolean
	 * @since 	0.2
	 **/
	public function save_data( $data ){
		$data_from_file = $this->data;
		if ( empty($data_from_file) || !is_array($data) || empty($data) || !file_exists($this->data_file) )
			return false;

		// Capitalise nickname
		if ( isset($data['nickname']) )
			$data['nickname'] = ucwords( $data['nickname'] );

		$merged = array_merge( $data_from_file, $data );
		$data_json = json_encode( $merged, JSON_PRETTY_PRINT );
		if ( !file_put_contents($this->data_file, $data_json) )
			return false;

		return true;
	}

	/**
	 * Get the patient's data.
	 * 
	 * @return 	boolean|array 	Return false when the data is empty or parse error.
	 * @since 	0.2
	 **/
	public function get_data(){
		$data = $this->data;
		if ( empty($data) )
			return false;

		if ( is_string($data) )
			$data = json_decode( $data, true );
		if ( is_null($data) || !$data )
			return false;

		return $data;
	}
}