<?php ob_start();
class dress_booking extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('global_model');	
		$this->load->model('dress_booking_model');	
	}
	function dress_booking()
	{
		$tablename='dress_booking';
		$data['records'] =$this->global_model->get_record($tablename); 
		$this->load->view('dress_booking', $data);
	}	
	function dress_booking_detail($sort_by = 'id', $sort_order = 'asc', $offset = 0,$formrecord = 0)
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
			'id' => 'Order No',		
			'customer_no' => 'Customer No',
			'cname' => 'Customer Name',
		 	'staff_name' => 'Staff Name',				
		);
		
		$this->load->model('dress_booking_model');	
		$results = $this->dress_booking_model->search($limit, $offset, $sort_by, $sort_order,$searchtext);
		$data['formrecord'] = $formrecord['data'];
		//$data['city'] = 
		$data['num_results'] = $results['num_rows'];
		
		// pagination
		$this->load->library('pagination');
		$config = array();
		$config['base_url'] = base_url() . "index.php/dress_booking/dress_booking_detail/$sort_by/$sort_order";
		$config['total_rows'] = $data['num_results'];
		$config['per_page'] = $limit;
		$config['uri_segment'] = 5;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		$data['sort_by'] = $sort_by;
		$data['sort_order'] = $sort_order;
		 
		$tablename='dress_booking';
		$data['records'] =$results['rows'];
		//echo print_r($data['records']);
		$this->load->view('dress_booking_detail', $data);
	}
	function addnew()
	{
		$this->load->view('dress_booking.php');
	}
	function editview()
	{
		session_start();
		unset($_SESSION['BAG_EDIT']);
		//unset($_SESSION['DRESS_EDIT']);
		
			$tablename='dress_booking';
			$tablename1='dress_booking_detail';
			$value= $this->uri->segment(3);
			$id='id';
			$id1='dbid';
			$data['formrecord'] = $this->global_model->edit_select($tablename,$id,$value);
			$data['formrecord1'] = $this->global_model->edit_select($tablename1,$id1,$value);
			foreach($data['formrecord'] as $row):
				$cno=$row->customer_no ;
				$sname=$row->staff_name;
				$remarks=$row->remarks;
				$cname=$row->cname;
			endforeach;
			foreach($data['formrecord1'] as $row):
				$data1 = array(	
							'dbid' => $row->id,		
							'cno' => $cno,	
							'sname' => $sname,	
							'remarks' => $remarks
							);				
				$_SESSION['DRESS_EDIT'][] =  $data1;	
				$r="7dayrule";
					$data = array(	
								'id' => $row->id,	
								'cno' => $cno,	
								'sname' => $sname,	
								'remarks' => $remarks,	
								'cname' => $cname,	
								'dbid' => $row->dbid,							
								'type' => $row->type,
								'style'=> $row->style,
								'status'=> $row->status,
								'sdate' => $row->sdate,
								'edate'=> $row->edate,
								'rule' => $row->$r,
								'rule' => 0,
								'bdate'=> $row->datebefore,
								'adate' => $row->dateafter,
								'BAG'=>'true'
							);
						//session_start();
						$_SESSION['BAG_EDIT'][] =  $data;	
						$this->session->set_userdata($data);
			
				 endforeach;
				 redirect(base_url() . 'index.php/dress_booking/edit/'.$value);
				// $this->load->view('dress_booking',$data);	
	}
	function onlyview()
	{
		session_start();
		unset($_SESSION['BAG_EDIT']);
		//unset($_SESSION['DRESS_EDIT']);
		
			$tablename='dress_booking';
			$tablename1='dress_booking_detail';
			$value= $this->uri->segment(3);
			$id='id';
			$id1='dbid';
			$data['formrecord'] = $this->global_model->edit_select($tablename,$id,$value);
			$data['formrecord1'] = $this->global_model->edit_select($tablename1,$id1,$value);
			foreach($data['formrecord'] as $row):
				$cno=$row->customer_no ;
				$sname=$row->staff_name;
				$remarks=$row->remarks;
				$cname=$row->cname;
			endforeach;
			foreach($data['formrecord1'] as $row):
				$data1 = array(	
							'dbid' => $row->id,		
							'cno' => $cno,	
							'sname' => $sname,	
							'remarks' => $remarks
							);				
				$_SESSION['DRESS_EDIT'][] =  $data1;	
				$r="7dayrule";
					$data = array(	
								'id' => $row->id,	
								'cno' => $cno,	
								'sname' => $sname,	
								'remarks' => $remarks,	
								'cname' => $cname,	
								'dbid' => $row->dbid,							
								'type' => $row->type,
								'style'=> $row->style,
								'status'=> $row->status,
								'sdate' => $row->sdate,
								'edate'=> $row->edate,
								'rule' => $row->$r,
								'rule' => 0,
								'bdate'=> $row->datebefore,
								'adate' => $row->dateafter,
								'BAG'=>'true'
							);
						//session_start();
						$_SESSION['BAG_EDIT'][] =  $data;	
						$this->session->set_userdata($data);
			
				 endforeach;
				 redirect(base_url() . 'index.php/dress_booking/view/'.$value);
				// $this->load->view('dress_booking',$data);
	}
	function view()
	{
		session_start();
		//unset($_SESSION['BAG']);
		//unset($_SESSION['BAG_EDIT']);	
		$tablename='dress_booking';
		$tablename1='dress_booking_detail';
		$value= $this->uri->segment(3);
		$id='id';
		$id1='dbid';
		$data['formrecord'] = $this->global_model->edit_select($tablename,$id,$value);
		$data['formrecord1'] = $this->global_model->edit_select($tablename1,$id1,$value);
		
		$this->load->view('dress_booking',$data);
	}
	function edit()
	{
		session_start();
		//unset($_SESSION['BAG']);
		//unset($_SESSION['BAG_EDIT']);	
		$tablename='dress_booking';
		$tablename1='dress_booking_detail';
		$value= $this->uri->segment(3);
		$id='id';
		$id1='dbid';
		$data['formrecord'] = $this->global_model->edit_select($tablename,$id,$value);
		$data['formrecord1'] = $this->global_model->edit_select($tablename1,$id1,$value);
		
		$this->load->view('dress_booking',$data);
	}
	function add_dress_booking()
	{
		$this->load->library('form_validation');		
		session_start();
		$tablename = 'dress_booking';	
		$tablename1 = 'dress_booking_detail';
		$ins='0';
		foreach ($_SESSION['BAG'] as $itemno => $item) 
		{ 
			if($_SESSION['BAG'][$itemno]!="")
			{ 
				if($itemno=='0')
				{
					$cno=$item['cno'];
					$data = array(
					'customer_no' => $item['cno'],	
					'staff_name' => $item['sname'],	
					'remarks' => $item['remarks']				
					);
					$ins=$this->global_model->add_record($tablename,$data);
					//$ins=$this->db->insert_id();
				}
					$data1= array(
					'dbid' => $ins,	
					'sdate' => $item['sdate'],	
					'edate' => $item['edate'],	
					'datebefore' => $item['bdate'],	
					'dateafter' => $item['adate'],
					'style' => $item['style'],	
					'type' => $item['type'],
					'status' => $item['status'],
					'7dayrule' => $item['rule']	
					);
				$this->global_model->add_record($tablename1,$data1);	
			}
		}
			//echo print_r($data1);	
			unset($_SESSION['BAG']);
			$this->flash_message->success('Record inserted successfully');			
			redirect(base_url() . 'index.php/dress_booking/dress_booking_detail');	
	}
	
	function add_bag()
	{
		$this->load->library('form_validation');
		
			echo print_r($_POST);
			/*
			if($this->input->post('cno')=="0" || $this->input->post('cno')=="")
			{
				$this->flash_message->error('Please select customer no');
				redirect(base_url() . 'index.php/dress_booking/addnew');	
			}
		
		
			$sdate=$this->input->post('syear')."-".$this->input->post('smonth')."-".$this->input->post('sday');
			$edate=$this->input->post('eyear')."-".$this->input->post('emonth')."-".$this->input->post('eday');
			
			if($this->input->post('rule')=='')
			{
				$rule=0;
				$bdate=$sdate;
				$adate=$edate;
			}
			else
			{
				$rule=1;
				$bdate=$this->input->post('syear')."-".$this->input->post('smonth')."-".($this->input->post('sday')-7);
				$adate=$this->input->post('eyear')."-".$this->input->post('emonth')."-".($this->input->post('eday')+7);
			}
			$data = array(
				'cno' => $this->input->post('cno'),
				'sname'=> $this->input->post('sname'),
				'remarks' => $this->input->post('remarks'),				
				'type' => $this->input->post('type'),
				'style'=> $this->input->post('style'),
				'status'=> $this->input->post('status'),
				'sdate' => $sdate,
				'edate'=> $edate,
				'rule' => $rule,
				'bdate'=> $bdate,
				'adate' => $adate,
				'BAG'=>'true'
			);	
			session_start();
			$_SESSION['BAG'][] =  $data;	
			$this->session->set_userdata($data);
	
		$this->flash_message->success('Record inserted successfully');
		//$this->addnew();
		redirect(base_url() . 'index.php/dress_booking/addnew');		
		
		*/	
	}
 	function delete_bag()
	{
		session_start();		
	//	$id=$_REQUEST['id'];
		$ino=$_REQUEST['ino'];
		if($ino!='')
		{
			if($_REQUEST['edit']=='true')
			{
				//$this->global_model->delete_row('dress_booking_detail','dbid',$id);
				$did=$_REQUEST['did'];
				unset($_SESSION['BAG_EDIT'][$ino]);
				redirect(base_url() . 'index.php/dress_booking/edit/'.$did);
			}
			else
			{		unset($_SESSION['BAG'][$ino]);
					redirect(base_url() . 'index.php/dress_booking/addnew');
			}
		}
	}
	function delete()
	{
		$tablename='dress_booking';
		$tablename1='dress_booking_detail';
		$value= $this->uri->segment(3);
		$id='id';
		$this->global_model->delete_row($tablename,$id,$value);
		$this->global_model->delete_row($tablename1,'dbid',$value);
		$this->flash_message->success('Record deleted successfully');
		redirect(base_url() . 'index.php/dress_booking/dress_booking_detail');
	}

	function update()
	{
		session_start();
		$tablename = 'dress_booking';	
		$tablename1 = 'dress_booking_detail';
		$value= $this->uri->segment(3);
		$ins='0';
		$id='id';
		$this->global_model->delete_row($tablename1,'dbid',$value);
		foreach ($_SESSION['BAG'] as $itemno => $item) 
		{ 
			if($_SESSION['BAG'][$itemno]!="")
			{ 
				if($itemno=='0')
				{
					$cno=$item['cno'];
					$data = array(
					'customer_no' => $this->input->post('cno'),	
					'staff_name' =>$this->input->post('sname'),	
					'remarks' => $this->input->post('remarks')				
					);
					
					$this->global_model->update_record($tablename,$data,$id,$value);					
				}
					$data1= array(
					'dbid' => $value,	
					'sdate' => $item['sdate'],	
					'edate' => $item['edate'],	
					'datebefore' => $item['bdate'],	
					'dateafter' => $item['adate'],
					'style' => $item['style'],	
					'type' => $item['type'],
					'status' => $item['status'],
					'7dayrule' => $item['rule']	
					);
					$this->global_model->add_record($tablename1,$data1);
			}
		}				
			unset($_SESSION['BAG']);			
	
				$this->flash_message->success('Updated Successfully');
				redirect(base_url() . 'index.php/dress_booking/dress_booking_detail');	 
	}
		function get_style($type = NULL){
		header('Content-Type: application/x-json; charset=utf-8');	
		echo (json_encode($this->dress_booking_model->get_style($type)));
		}
}