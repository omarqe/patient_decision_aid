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

class PDA_Data {
	// function: save_data()
	// function: get_data()
	// function: get_step()
	// function: generate_file()

	/**
	 * 
	 * 
	 * 
	 * 
	 * 
	 **/
	protected $session_id = '';

	/**
	 * 
	 * 
	 * @access 	protected
	 * @var 	string
	 * @since 	0.2
	 **/
	protected $data_file = '';

	/**
	 * 
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
		$session_id = session_id();

		if ( empty($session_id) )
			die( "Session ID is not generated." );

		$path = ABSPATH . '/data';
		$file = sprintf( '%1$s/%2$s.json', $path, $session_id );

		$this->data_file = $file;
		if ( !file_exists($file) )
			$this->generate_file();

		$data = file_get_contents( $file );
		$data = json_decode( $data, true );

		if ( empty($data) || is_null($data) || !is_array($data) )
			die( "We can't read your session data. Please restart the browser." );

		// Set data instance
		$this->data = $data;
	}

	/**
	 * 
	 * 
	 * 
	 * 
	 * 
	 * 
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

<<<<<<< HEAD
		$data_json = json_encode( $data, JSON_PRETTY_PRINT );
=======
		$data_json = json_encode( $data );
>>>>>>> master

		if ( !file_put_contents($this->data_file , $data_json) )
			die( "Data file is not generated." );
	}

	/**
	 * 
	 * 
	 * 
	 * 
	 * 
	 **/
	public function save_data( $data ){
		$data = $this->data;
	}

	public function get_data(){

	}

	public function get_step(){

	}
}