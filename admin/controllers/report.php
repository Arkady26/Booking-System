<?php ob_start();
session_start();
class report extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('global_model');	
		$this->load->model('report_model');	
	}
	function search($sort_by = 'id', $sort_order = 'asc', $offset = 0,$formrecord = 0)
	{	
		$limit =10;	
			
			$sdate=$this->input->post('syear')."-".$this->input->post('smonth')."-".$this->input->post('sday');
			$edate=$this->input->post('eyear')."-".$this->input->post('emonth')."-".$this->input->post('eday'); 
			
			$data = array(
				'cno' => $this->input->post('cno'),
				'ctelephone' => $this->input->post('ctelephone'),
				'sname'=> $this->input->post('sname'),							
				'type' => $this->input->post('type'),
				'style'=> $this->input->post('style'),
				'status'=> $this->input->post('status'),
				'sdate' => $sdate,
				'edate'=> $edate,
				'cno1' => $this->input->post('customerno')
			
			);			
			
		$results = $this->report_model->search($limit, $offset, $sort_by, $sort_order,$data);
		$data['num_results'] = $results['num_rows'];				
		$data['records'] =$results['rows'];
		//echo print_r($data);
		$this->load->view('report',$data);
		
	}
	function search_dress($sort_by = 'id', $sort_order = 'asc', $offset = 0,$formrecord = 0)
	{	
		$limit =10;	
		$sdate=$this->input->post('syear')."-".$this->input->post('smonth')."-".$this->input->post('sday');
		$edate=$this->input->post('eyear')."-".$this->input->post('emonth')."-".$this->input->post('eday'); 
		if($sdate == '--')
		{
			$sdate='';
			$edate='';
		}

		
		
		if($this->input->post('hid')=='1' && $sdate!='')
		{
			$sdate = date("Y-m-d",strtotime('-7 day' ,strtotime($sdate))) ;
			$edate = date("Y-m-d",strtotime(date("Y-m-d",strtotime($edate)) . " +7 day"));
		}
		
		$data = array(					
			'type' => $this->input->post('type'),
			'style'=> $this->input->post('SubCat'),				
			'sdate' => $sdate,
			'edate'=> $edate,
			'search'=>'searchtest'
		);			
		$results = $this->report_model->search_dress($limit, $offset, $sort_by, $sort_order,$data);
		$data['num_results'] = $results['num_rows'];		
		$data['records'] =$results['rows'];	
		$this->load->view('report_dress',$data);		
		
	}
}