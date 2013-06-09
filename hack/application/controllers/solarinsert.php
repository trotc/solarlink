<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Solarinsert extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		date_default_timezone_set('Asia/Manila');
		echo 'this is solar insert';
		//$this->load->view('welcome_message');
	}
	


	public function insert()
	{
	
	
	
		date_default_timezone_set('Asia/Manila');
	
		$this->load->model('solarinsertmodel');
		

		
		$url = $this->uri->uri_to_assoc(3);
		
		
		if(!empty($url))
		{
		$generated = $url['gen'];
		$consumed = $url['con'];
		$userid = $url['userid'];
		}
		
		
		$this->solarinsertmodel->insertdata($generated,$consumed,$userid);
		
		
	}

}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */