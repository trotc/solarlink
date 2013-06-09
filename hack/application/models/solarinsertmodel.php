<?php

class Solarinsertmodel extends CI_Model {

		function inspectentry($year,$month,$day,$entrynumber,$userid)
		{
			$this->db->where('year',$year);
			$this->db->where('month',$month);
			$this->db->where('day',$day);
			$this->db->where('user_id',$userid);
			$this->db->where('entry_number',$entrynumber);
			$query = $this->db->get('entries');	
			if($query->num_rows() > 0)
			{
				$data = '1';
				return $data;
			}
			else
			{
				return 'non';
			}
		}
		
		function converttoentrynumber($hour,$minute)
		{
			$entrynumber = $hour * 60;
			$entrynumber = $entrynumber + $minute;
			return $entrynumber;
		}

		function show()
		{
		
		}


		function showday()
		{
			return date("d");	
		}
		
		function showmonth()
		{
			return date("m");
		}
		
		function showyear()
		{
			return date("Y");
		}
		
		function showhour()
		{
			return date("H");
		}
		
		function showminute()
		{
			return date("i");
		}




		function insertdata($generated,$consumed,$userid)
		{
			
			$year = $this->showyear();
			$month = $this->showmonth();
			$day = $this->showday();
			$hour = $this->showhour();
			$minute = $this->showminute();
			$entrynumber = $this->converttoentrynumber($hour,$minute);
			
			
			
			//$already = $this->inspectentry('2013','6','6','15','1');
			$already = $this->inspectentry($year,$month,$day,$entrynumber,$userid);
			
			if($already == '1')
			{
				//dont insert
				//echo 'dont insert!';
			}
			else
			{
				//echo 'insert!';
				
				$this->db->set('energy_stored',$generated);
				$this->db->set('energy_used',$consumed);
				$this->db->set('entry_number',$entrynumber);
				$this->db->set('year',$year);
				$this->db->set('month',$month);
				$this->db->set('day',$day);
				$this->db->set('user_id',$userid);
				$this->db->insert('entries');
				
				
				//insert data
			}
			
			
			
			
			//get year
			//get month
			//get day
			//get current time
			//convert current time to entry number
			//check if entry number is already there
			//if not yet there then add + 1
		}





}


?>