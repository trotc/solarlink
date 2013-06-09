<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Solarview extends CI_Controller {

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
		
		
		//echo 'hello!';
		
		
		$this->load->model('solarviewmodel');
		
		$userid = '1';
			
			
			
			
			$data['date'] = $this->solarviewmodel->getlatestentry($userid);
			
			
			$year = $data['date'][0]->year;
			$month = $data['date'][1]->month;
			$day = $data['date'][2]->day;
			$userid = $data['date'][3]->user_id;
			
		
		
		
			
			//print_r($data['date']);
			
			
			$reurl = '/year/'.$year.'/month/'.$month.'/day/'.$day.'/userid/'.$userid;
			
			redirect('solarview/dailyview'.$reurl);
			

		
		
		
		
			
		
		}
		
		
		
		
		

	
	
	public function dailyview()
	{
		
		$this->load->model('solarviewmodel');
		//$data['records'] = $this->solarviewmodel->dailyview('1','2013','4','15');
		
		
		
		$wattshow = $this->solarviewmodel->wattsaved('1');
		
		
		$energystored = $wattshow[0]->energy_stored;
		
		$data['energytotal'] = $energystored / 60;
		
		
		//print_r($wattshow);
		
		
		$viewchatsort = $this->input->post('viewchartsort');
		$yearinput = $this->input->post('yearinput');
		$monthinput = $this->input->post('monthinput');
		$dayinput = $this->input->post('dayinput');
		
		
		 $url = $this->uri->uri_to_assoc(3);
		
		
		
		if(!empty($url))
		{
			if(!empty($url['userid']))
			{
			$userid = $url['userid'];
			}
			$year = $url['year'];
			$month = $url['month'];
			$day = $url['day'];
			
			
			$data['yearchosen'] = $year;
			$data['monthchosen'] = $month;
			$data['daychosen'] = $day;
			
		}
		elseif(empty($url))
		{
			if(empty($viewchatsort))
			{
			//$this->session->set_userdata('userid',$userid);
			
		
			$userid = '1';
			
			$data['date'] = $this->solarviewmodel->getlatestentry($userid);
			
			
			$year = $data['date'][0]->year;
			$month = $data['date'][1]->month;
			$day = $data['date'][2]->day;
			$userid = $data['date'][3]->user_id;
			
			//$this->session->set_userdata('userid',$userid);
			
			
			//print_r($data['date']);
			
			
			$reurl = '/year/'.$year.'/month/'.$month.'/day/'.$day.'/userid/'.$userid;
			
			redirect('solarview/dailyview'.$reurl);
			}

		}
		
		
		
			
		if(!empty($viewchatsort))
		{
			if(!empty($yearinput))
			{
				$typeview ='yearlyview';
				
				if(!empty($monthinput))
				{
				$typeview = 'monthlyview';
				
				
					if(!empty($dayinput))
					{
						$typeview = 'dailyview';
					}
				}
				else
				{
				$typeview = 'yearlyview';
				}	
			}
			
			
			
			$userid = '1';
			
			
			$reurl = base_url();
			$reurl .= 'index.php/solarview/';
			$reurl .= $typeview.'/year/'.$yearinput.'/';
			$reurl .= 'month/'.$monthinput.'/';
			$reurl .= 'day/'.$dayinput.'/';
			$reurl .= 'userid/'.$userid;
			redirect($reurl);
			//echo $reurl;
		}
		
		
		
		
		
		
		$data['records'] = $this->solarviewmodel->dailyviewnew2($userid,$year,$month,$day);
		
		
		$data['dropyears'] = $this->solarviewmodel->showdropyears($userid);
		$data['dropmonths'] = $this->solarviewmodel->showdropmonths($userid);
		$data['dropdays'] = $this->solarviewmodel->showdropdays($userid);
		/*
		$data['dropmonths'] = ;
		$data['dropdays'] = ;
		*/
		
		//print_r($data['dropyears']);
		
		//print_r($data['dropmonths']);
		
		
		
		$this->load->view('navbar');
		$this->load->view('css/graphlayout');

		
		
		//print_r($data['records']);
		
		
		/*
		foreach($data['records'] as $row)
		{
			echo $row->entry_number;
			echo ' - ';
			echo $row->energy_stored;
			echo ' - ';
			//echo $row->energy_used;
			echo '<br />';
		}
		*/
		
		
		
		
		
		$this->load->view('dailyview',$data);
		
		//print_r($data['records']);
		
		
		/*
		foreach($data['records'] as $row)
		{
			echo $row->entry_number;
			echo ' - ';
			echo $row->energy_stored;
			echo ' - ';
			echo $row->energy_used;
			echo '<br />';
		}
		*/
		
		
		
		
		//print_r($result);
		
	}
	
	public function monthlyview()
	{
		$this->load->model('solarviewmodel');
		
		
		
			$wattshow = $this->solarviewmodel->wattsaved('1');
		
		
		$energystored = $wattshow[0]->energy_stored;
		
		$data['energytotal'] = $energystored / 60;
		
		
		
		
		$viewchatsort = $this->input->post('viewchartsort');
		$yearinput = $this->input->post('yearinput');
		$monthinput = $this->input->post('monthinput');
		$dayinput = $this->input->post('dayinput');
		
		
			
		 $url = $this->uri->uri_to_assoc(3);
		
		
		$userid = '1';
		
		if(!empty($url))
		{
			
			//$userid = $url['userid'];
			$year = $url['year'];
			$month = $url['month'];
			$day = $url['day'];
			
			
			$data['yearchosen'] = $year;
			$data['monthchosen'] = $month;
			$data['daychosen'] = $day;
			
		}
		
		
		
			
		if(!empty($viewchatsort))
		{
			if(!empty($yearinput))
			{
				$typeview ='yearlyview';
				
				if(!empty($monthinput))
				{
				$typeview = 'monthlyview';
				
				
					if(!empty($dayinput))
					{
						$typeview = 'dailyview';
					}
				}
				else
				{
				$typeview = 'yearlyview';
				}	
			}
			
			
			
			
			
			
			$reurl = base_url();
			$reurl .= 'index.php/solarview/';
			$reurl .= $typeview.'/year/'.$yearinput.'/';
			$reurl .= 'month/'.$monthinput.'/';
			$reurl .= 'day/'.$dayinput.'/';
			$reurl .= 'userid/'.$userid;
			redirect($reurl);
			//echo $reurl;
		}

		

		
		//$data['user_id'] = $userid;
		
		$userid = '1';
		$data['user_id'] = $userid;
		
		$data['dropyears'] = $this->solarviewmodel->showdropyears($data['user_id']);
		$data['dropmonths'] = $this->solarviewmodel->showdropmonths($data['user_id']);
		$data['dropdays'] = $this->solarviewmodel->showdropdays($data['user_id']);
		
		
		
		$data['user_id'] = '1';
		
		/*
		$data['year'] = '2013';
		$data['month'] = '04';
		*/
		
		
		$data['records'] = $this->solarviewmodel->monthlyview($year,$month,$data['user_id']);
		
		
		$data['month'] = $month;
		$data['days']= date('t', mktime(0, 0, 0, $month, 1, $year)); 
		
		
		//print_r($data['days']);
		
		$this->load->view('navbar');
		
		$this->load->view('css/graphlayout');
		
		$this->load->view('monthlyview',$data);
		
		/*		
		foreach($data['records'] as $row)
		{
			echo $row->energy_used;
			echo ' - ';
			echo $row->energy_stored;
			echo ' - ';
			echo $row->day;
			echo '<br />';
		}
		*/
		
	
		
			
	}
	
	public function yearlyview()
	{
		$this->load->model('solarviewmodel');
		
		
		
		$viewchatsort = $this->input->post('viewchartsort');
		$yearinput = $this->input->post('yearinput');
		$monthinput = $this->input->post('monthinput');
		$dayinput = $this->input->post('dayinput');
		
		
		
		
			$wattshow = $this->solarviewmodel->wattsaved('1');
		
		
		$energystored = $wattshow[0]->energy_stored;
		
		$data['energytotal'] = $energystored / 60;
		
		
		
		
		
		//$userid = $this->session->userdata('userid');
			
		 $url = $this->uri->uri_to_assoc(3);
		
		if(!empty($url))
		{
			
			$userid = $url['userid'];
			$year = $url['year'];
			$month = $url['month'];
			$day = $url['day'];
			
			
			$data['yearchosen'] = $year;
			$data['monthchosen'] = $month;
			$data['daychosen'] = $day;
			
		}
		
		
		
			
		if(!empty($viewchatsort))
		{
			if(!empty($yearinput))
			{
				$typeview ='yearlyview';
				
				if(!empty($monthinput))
				{
				$typeview = 'monthlyview';
				
				
					if(!empty($dayinput))
					{
						$typeview = 'dailyview';
					}
				}
				else
				{
				$typeview = 'yearlyview';
				}	
			}
			
			
			
			
			
			
			$reurl = base_url();
			$reurl .= 'index.php/solarview/';
			$reurl .= $typeview.'/year/'.$yearinput.'/';
			$reurl .= 'month/'.$monthinput.'/';
			$reurl .= 'day/'.$dayinput.'/';
			$reurl .= 'userid/'.$userid;
			redirect($reurl);
			//echo $reurl;
		}

		

		
		$data['user_id'] = $userid;
		$data['dropyears'] = $this->solarviewmodel->showdropyears($data['user_id']);
		$data['dropmonths'] = $this->solarviewmodel->showdropmonths($data['user_id']);
		$data['dropdays'] = $this->solarviewmodel->showdropdays($data['user_id']);
		
		
		
		$url = $this->uri->uri_to_assoc(3);
		
		if(!empty($url))
		{
			//$data['user_id'] = $url['userid'];
			$data['year'] = $url['year'];
			//$data['month'] = $url['month'];
			
		}
		
		
		
	
		
		$data['records'] = $this->solarviewmodel->yearlyview($data['user_id'],$data['year']);
		
		
		
		/*
		foreach($data['records'] as $row2)
		{
			echo $row2->energy_used;
			echo ' - ';
			echo $row2->energy_stored;
			echo ' - ';
			echo $row2->month;
			echo '<br />';
		}
		*/
		
		
		$this->load->view('navbar');
		$this->load->view('css/graphlayout');
		$this->load->view('yearlyview',$data);
		
	}
	
	
	public function datesort()
	{
		$yearsort = $this->input->post('yearview');
		$monthsort = $this->input->post('monthview');
		$daysort = $this->input->post('dayview');
		
		
		
		
		
		
	}
	
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */