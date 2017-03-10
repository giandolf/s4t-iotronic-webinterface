<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Last extends CI_Controller {

	public $IP_PORT = 'localhost:8888/v1';
	public $CKAN_URL = 'smartme-data.unime.it';

	public function index()
	{

		$this -> load -> library('curl');
		$data['page_title'] = 'UniME';

		$this -> load -> view('templates/header');
		$this -> load -> view('last', $data);
		$this -> load -> view('templates/footer');
	}



						// MAP MANAGEMENT
	// ################################################################################################

	// TO VE DONE !!!

	// ################################################################################################

		
}
?>

