<?php

class Solarviewmodel extends CI_Model {


		function getlatestentry($userid)
	{
		$this->db->order_by('entry_id','desc');
		$this->db->where('user_id',$userid);
		$this->db->limit(1);
		
		$query = $this->db->get('entries');
		
		if($query->num_rows () > 0)
		{
			
			foreach($query->result() as $row)
			{
				$data[]->year = $row->year;
				$data[]->month = $row->month;
				$data[]->day = $row->day;
				$data[]->user_id = $row->user_id;
			}
			return $data;	
		}
		
		
		
	}




		function dailyviewnew2($userid,$year,$month,$day)
	{
		for($i=0;$i<1440;$i++)
		{
			$this->db->where('entry_number',$i);
			$this->db->where('year',$year);
			$this->db->where('month',$month);
			$this->db->where('day',$day);
			$this->db->where('user_id',$userid);
			$query = $this->db->get('entries');
			
			
			if($query->num_rows() > 0)
			{
				foreach($query->result() as $row)
				{
				//$data[] = $row;		
				$data[$i]->entry_number = $row->entry_number;
				$data[$i]->energy_stored = $row->energy_stored;
				$data[$i]->energy_used = $row->energy_used;
				}
			}
			else
			{
				$data[$i]->entry_number = $i;
				$data[$i]->energy_stored = '';
				$data[$i]->energy_used = '';
			}
		}
		
			//second part
			$day = $year.'-'.$month.'-'.$day;
			$convertday = strtotime($day);
			
			$nextyear = date('Y', strtotime(' +1 day',$convertday));
			$nextmonth = date('m', strtotime(' +1 day',$convertday));
			$nextday = date('d', strtotime(' +1 day',$convertday));
				
			$this->db->where('year',$nextyear);
			$this->db->where('month',$nextmonth);
			$this->db->where('day',$nextday);
			$this->db->where('user_id',$userid);
			$this->db->where('entry_number','0');
			$query = $this->db->get('entries');		
			
			if($query->num_rows() > 0)
			{
				foreach($query->result() as $row)
				{
				
					$data['1440']->entry_number = '1440';
					$data['1440']->energy_stored = $row->energy_stored;
					$data['1440']->energy_used = $row->energy_used;
					
				}
			}
			else
			{
					$data['1440']->entry_number = '1440';
					$data['1440']->energy_stored = 0;
					$data['1440']->energy_used = 0;
			}
		return $data;
	}


		function showrecords()
		{
			$query = $this->db->get('entries');
			if($query->num_rows() > 0)
			{
				foreach($query->result() as $row)
				{
					$data[] = $row;
				}
				//print_r($query->result());
			return $data;
			}
		}
		
		
		function dailyview($year,$month,$day,$userid)
		{
			$this->db->where('user_id',$userid);
			$this->db->where('year',$year);
			$this->db->where('month',$month);
			$this->db->where('day',$day);
			$query = $this->db->get('entries');
			if($query->num_rows() > 0)
			{
				foreach($query->result() as $row)
				{
					$data[] = $row;
				}
				//print_r($query->result());
			return $data;
			}
		}
		
		function monthlyview($year,$month,$userid)
		{
		
		//get all available days of month
		
		
		$days= date('t', mktime(0, 0, 0, $month, 1, $year)); 
		
		
		for($i=1;$i<$days;$i++)
		{
				$this->db->select_sum('energy_stored');
				$this->db->select_sum('energy_used');
				$this->db->where('year',$year);
				$this->db->where('month',$month);
				$this->db->where('day',$i);
				
				$query2 = $this->db->get('entries');
				
				if($query2->num_rows() > 0)
				{
				$query2res = $query2->result();
				
				foreach($query2->result() as $row2)
				{
						$data[$i]->energy_stored = $row2->energy_stored;
						//echo ' - ';
						$data[$i]->energy_used = $row2->energy_used;
						//echo ' - ';
						$data[$i]->day = $i;
						//print_r($query2res);
						//echo '<hr />';
				}	
				}
				else
				{
						$data[$i]->energy_stored = '0';
						//echo ' - ';
						$data[$i]->energy_used = '0';
						//echo ' - ';
						$data[$i]->day = $i;
				}	
			//$i++;
		}
			return $data;

	}
	
	function yearlyview($userid,$year)
	{
		
		//get all available days of month
		
		
		for($i=1;$i<=12;$i++)
		{
						
				$this->db->select_sum('energy_stored');
				$this->db->select_sum('energy_used');
				$this->db->where('year',$year);
				$this->db->where('month',$i);
				//$this->db->where('day',$day);
				
				$query2 = $this->db->get('entries');
				
				if($query2->num_rows() > 0)
				{
				
				foreach($query2->result() as $row2)
				{
						$data[$i]->energy_stored = $row2->energy_stored;
						//echo ' - ';
						$data[$i]->energy_used = $row2->energy_used;
						//echo ' - ';
						$data[$i]->month = $i;
						//print_r($query2res);
						//echo '<hr />';
				}	
				}
				else
				{
					$data[$i]->energy_stored = '0';
						//echo ' - ';
					$data[$i]->energy_used = '0';
						//echo ' - ';
					$data[$i]->month = $i;
				}	
			//$i++;
		}
			return $data;
	}
		
	function showdropyears($userid)
	{
		$this->db->select('year');
		$this->db->distinct();
		$this->db->order_by('year','desc');
		$query = $this->db->get('entries');
		
		
		if($query->num_rows() > 0)
		{
			foreach($query->result() as $row)
			{
				$data[] = $row->year;
			}
			return $data;
		}
		
		
	}
	
	function showdropmonths($userid)
	{
		$data[0] = 'Month';
		for($i=1;$i<=12;$i++)
		{
			$monthName = date("M", mktime(0, 0, 0, $i, 10));
			$data[$i] = $monthName;
		}
		return $data;	
	}
	
	function showdropdays($userid)
	{
		$data[0] = 'Day';
		/*
		for($i=1;$i<=12;$i++)
		{
			$monthName = date("M", mktime(0, 0, 0, $i, 10));
			$data[$i] = $monthName;
		}
		*/
		
		for($i=1;$i<=31;$i++)
		{
			$data[$i] = $i;
		}
		return $data;	
	}
	
	




}


?>