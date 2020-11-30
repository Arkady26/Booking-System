<?php 
ob_start();
session_start();
class walkincustomer extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('global_model');	
		$this->load->model('walkincustomer_model');	
	}
	function walkincustomer()
	{
		$tablename='signup';
		$data['records'] =$this->global_model->get_record($tablename); 
		$this->load->view('walkincustomer', $data);
	}
	
	function walkincustomer_detail($sort_by = 'wname', $sort_order = 'asc', $offset = 0,$formrecord = 0)
	{
		if(isset($_GET['find']))
		{
			$searchtext=$_GET['find'];
		}
		else
		{
			$searchtext="";
		}
		$limit = 10;
		$data['fields'] = array(
			'staffname'=>'Staff',
		 	'wname' => 'Name',
			'wtelephone' => 'Telephone',
			'cpname' => 'Partner',
			'cptelephone' => 'Telephone',
			'weddingdate' => 'Wedding Date',			
			'wdate' => 'Walk-In Date',
		);
		
		$this->load->model('walkincustomer_model');	
		$results = $this->walkincustomer_model->search($limit, $offset, $sort_by, $sort_order,$searchtext);
		$data['formrecord'] = $formrecord['data'];
		//$data['city'] = 
		$data['num_results'] = $results['num_rows'];
		
		// pagination
		$this->load->library('pagination');
		$config = array();
		$config['base_url'] = base_url() . "index.php/walkincustomer/walkincustomer_detail/$sort_by/$sort_order";
		$config['total_rows'] = $data['num_results'];
		$config['per_page'] = $limit;
		$config['uri_segment'] = 5;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		 $data['sort_by'] = $sort_by;
		$data['sort_order'] = $sort_order;

		 
		$tablename='walkincustomer';
		$data['records'] =$results['rows'];
		//echo print_r($data['records']);
		$this->load->view('walkincustomerdetailview', $data);

	}
	function addnew()
	{
		$this->load->view('walkincustomer.php');
	}
	function onlyview()
	{	//session_start();
		unset($_SESSION['BAG_EDIT']);
		unset($_SESSION['WCUSTOMER_EDIT']);
		
			$tablename='walkincustomer';
			$tablename1='walkincustomer_detail';
			$value= $this->uri->segment(3);
			$id='wcid';
			$id1='wcid';
			$data['formrecord'] = $this->global_model->edit_select($tablename,$id,$value);
			$data['formrecord1'] = $this->global_model->edit_select($tablename1,$id1,$value);
			
			foreach($data['formrecord'] as $row):
				$wname=$row->wname;
				$wtelephone=$row->wtelephone;
				$wdate=$row->wdate;
				$wremarks=$row->wremarks;
				$staffname =$row->staffname;
				$weddingdate =$row->weddingdate;
			 endforeach;
			foreach($data['formrecord1'] as $row):
				$data1 = array(	
							'wcid' => $row->wcid,		
							'wtelephone' => $wtelephone,
							'staffname' => $staffname,	
							'wname' => $wname,
							'weddingdate' => $weddingdate,
							'wremarks' => $wremarks,
							'wdate' => $wdate								
							);				
				$_SESSION['WCUSTOMER_EDIT'][] =  $data1;	
			
					$data = array(	
								'id' => $row->id,	
								'wtelephone' => $wtelephone,	
								'wname' => $wname,	
								'staffname' => $staffname,	
								'wremarks' =>$wremarks,
								'wdate' => $wdate,	
								'weddingdate' => $weddingdate,
								'wtype' => $row->wdtype,
								'wstyle'=> $row->wdstyle,								
								'BAG'=>'true'
							);	
				
						//session_start();
						$_SESSION['BAG_EDIT'][] =  $data;	
						$this->session->set_userdata($data);
			
				 endforeach;
				 redirect(base_url() . 'index.php/walkincustomer/view/'.$value);
				// $this->load->view('dress_booking',$data);	
	}
	function view()
	{
		//session_start();
		//unset($_SESSION['BAG']);
		//unset($_SESSION['BAG_EDIT']);	
		$tablename='walkincustomer';
		$tablename1='walkincustomer_detail';
		$value= $this->uri->segment(3);
		$id='wcid';
		$id1='wcid';
		$data['formrecord'] = $this->global_model->edit_select($tablename,$id,$value);
		$data['formrecord1'] = $this->global_model->edit_select($tablename1,$id1,$value);
		
		$this->load->view('walkincustomer',$data);
	}
	function editview()
	{
		//ob_start();	
		//session_start();
		unset($_SESSION['BAG_EDIT']);
		unset($_SESSION['WCUSTOMER_EDIT']);
		
			$tablename='walkincustomer';
			$tablename1='walkincustomer_detail';
			$value= $this->uri->segment(3);
			$id='wcid';
			$id1='wcid';
			$data['formrecord'] = $this->global_model->edit_select($tablename,$id,$value);
			$data['formrecord1'] = $this->global_model->edit_select($tablename1,$id1,$value);
			
			foreach($data['formrecord'] as $row):
				$wname=$row->wname;
				$wtelephone=$row->wtelephone;
				$wdate=$row->wdate;
				$wremarks=$row->wremarks;
				$staffname =$row->staffname;
				$weddingdate =$row->weddingdate;
			 endforeach;
			foreach($data['formrecord1'] as $row):
				$data1 = array(	
							'wcid' => $row->wcid,		
							'wtelephone' => $wtelephone,
							'staffname' => $staffname,	
							'wname' => $wname,
							'weddingdate' => $weddingdate,
							'wremarks' => $wremarks,
							'wdate' => $wdate								
							);				
				$_SESSION['WCUSTOMER_EDIT'][] =  $data1;	
			
					$data = array(	
								'id' => $row->id,	
								'wtelephone' => $wtelephone,	
								'wname' => $wname,	
								'staffname' => $staffname,	
								'wremarks' =>$wremarks,
								'wdate' => $wdate,	
								'weddingdate' => $weddingdate,
								'wtype' => $row->wdtype,
								'wstyle'=> $row->wdstyle,								
								'BAG'=>'true'
							);	
				
						//session_start();
						$_SESSION['BAG_EDIT'][] =  $data;	
						$this->session->set_userdata($data);
			
				 endforeach;
				 redirect(base_url() . 'index.php/walkincustomer/edit/'.$value);
				// $this->load->view('dress_booking',$data);	

	}
	function edit()
	{
		//session_start();
		//unset($_SESSION['BAG']);
		//unset($_SESSION['BAG_EDIT']);	
		$tablename='walkincustomer';
		$tablename1='walkincustomer_detail';
		$value= $this->uri->segment(3);
		$id='wcid';
		$id1='wcid';
		$data['formrecord'] = $this->global_model->edit_select($tablename,$id,$value);
		$data['formrecord1'] = $this->global_model->edit_select($tablename1,$id1,$value);
		
		$this->load->view('walkincustomer',$data);
	}
	function add_dress_booking()
	{
		$this->load->library('form_validation');		
		//session_start();
		$tablename = 'walkincustomer';	
		$tablename1 = 'walkincustomer_detail';
		$ins='0';
		foreach ($_SESSION['BAG'] as $itemno => $item) 
		{ 
			if($_SESSION['BAG'][$itemno]!="")
			{ 
				if($itemno=='0')
				{
					$data = array(
					'wname' => $item['wname'],	
					'wtelephone' => $item['wtelephone'],	
					'wdate' => $item['wdate'],	
					'wremarks' => $item['wremarks'],
					'staffname'=> $item['staffname'],
					'weddingdate' => $item['weddingdate']	
					);
					$ins=$this->global_model->add_record($tablename,$data);
					//$ins=$this->db->insert_id();
				}
					$data1= array(
					'wcid' => $ins,	
					'wtype' => $item['wtype'],	
					'wstyle' => $item['wstyle']					
					);
				$this->global_model->add_record($tablename1,$data1);	
			}
		}
			//echo print_r($data1);	
			unset($_SESSION['BAG']);
			$this->flash_message->success('Record inserted successfully');			
			redirect(base_url() . 'index.php/walkincustomer/walkincustomer_detail');
	
	}
	
	function add_bag()
	{
		$this->load->library('form_validation');
		
			$wdate=$this->input->post('year')."-".$this->input->post('month')."-".$this->input->post('day');		
			$weddingdate=$this->input->post('year1')."-".$this->input->post('month1')."-".$this->input->post('day1');
				$data = array(
				'wname' => $this->input->post('wname'),	
				'staffname' => $this->session->userdata('username'),			
				'wtelephone' => $this->input->post('tno'),	
				'wremarks' => $this->input->post('wremarks'),			
				'wtype' => $this->input->post('type'),
				'wstyle'=> $this->input->post('style'),
				'wdate' => $wdate,
				'weddingdate' => $weddingdate,
				'BAG'=>'true'
			);	
			//session_start();
			$_SESSION['BAG'][] =  $data;	
			$this->session->set_userdata($data);
	
		$this->flash_message->success('Record inserted successfully');
		redirect(base_url() . 'index.php/walkincustomer/addnew');
			
	}
 	function delete_bag()
	{
		//session_start();
		 $ino=$_REQUEST['ino'];
		if($ino!='')
		{
			if($_REQUEST['edit']=='true')
			{
				$did=$_REQUEST['did'];	
				unset($_SESSION['BAG_EDIT'][$ino]);
				redirect(base_url() . 'index.php/walkincustomer/edit/'.$did);
			}
			else
			{		unset($_SESSION['BAG'][$ino]);
					redirect(base_url() . 'index.php/walkincustomer/addnew');
			}
		}
	}
	function delete()
	{
		$tablename='walkincustomer';
		$tablename1='walkincustomer_detail';
		$value= $this->uri->segment(3);
		$id='wcid';
		$this->global_model->delete_row($tablename,$id,$value);
		$this->global_model->delete_row($tablename1,'wcid',$value);
		$this->flash_message->success('Record deleted successfully');
		redirect(base_url() . 'index.php/walkincustomer/walkincustomer_detail');
	}
	
	function get_style($type = NULL){
		header('Content-Type: application/x-json; charset=utf-8');	
		echo (json_encode($this->walkincustomer_model->get_style($type)));
		}

}
