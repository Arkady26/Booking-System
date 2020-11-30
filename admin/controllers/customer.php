<?php 
class customer extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('global_model');	
		$this->load->model('customer_model');
	}
	function customer()
	{
		$tablename='customer';
		$data['records'] =$this->global_model->get_record($tablename); 
		$this->load->view('customer', $data);
	}
	
	function customerdetail($sort_by = 'cname', $sort_order = 'asc', $offset = 0,$formrecord = 0)
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
			'cno' => 'Customer No',
		 	'cname' => 'Customer Name',
			'ctelephone' => 'Customer Telephone',
			'pname' => 'Partner Name',
			'cptelephone' => 'Partner Telephone',
			'cweddingdate' => 'Wedding Date',
		);			
		$results = $this->customer_model->search($limit, $offset, $sort_by, $sort_order,$searchtext);
		$data['formrecord'] = $formrecord['data'];
		//$data['city'] = 
		$data['num_results'] = $results['num_rows'];
		
		// pagination
		$this->load->library('pagination');
		$config = array();
		$config['base_url'] = base_url() . "index.php/customer/customerdetail/$sort_by/$sort_order";
		$config['total_rows'] = $data['num_results'];
		$config['per_page'] = $limit;
		$config['uri_segment'] = 5;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		 $data['sort_by'] = $sort_by;
		$data['sort_order'] = $sort_order;

		 
		$tablename='customer';
		$data['records'] =$results['rows'];
		//echo print_r($data['records']);
		$this->load->view('customer_detail', $data);

	}
	function addnew()
	{
		$this->load->view('customer.php');
	}
	function edit()
	{
		$tablename='customer';
		$value= $this->uri->segment(3);
		$id='cid';
		$data['formrecord'] = $this->global_model->edit_select($tablename,$id,$value);
		$this->load->view('customer',$data);
	}
	function add_customer()
	{
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('cno', 'Customer No', 'trim|required');
		//$this->form_validation->set_rules('cno', 'Customer No', 'trim|required|max_length[10]');
	
		if($this->form_validation->run() == FALSE)
		{
				$this->customer();
		}
		else
		{
			$tablename = 'customer';
			$value =  $this->input->post('cno');
			$criteria=" cno='".$value ."'";
			$query = $this->global_model->checkunique($tablename,$criteria);

			
			if($query) // if the city already exists
			{
				$this->flash_message->warning('Customer No already exists',TRUE);
				$this->customerdetail();
			}
			else
			{
				$wdate=$this->input->post('year')."-".$this->input->post('month')."-".$this->input->post('day');
				$data = array(
					'cno' => $this->input->post('cno'),	
					'cname' => $this->input->post('cname'),	
					'cpname' => $this->input->post('pname'),	
					'ctelephone' => $this->input->post('tno'),	
					'cptelephone' => $this->input->post('ptno'),	
					'cweddingdate' => $wdate,				
					
				);
				$this->global_model->add_record($tablename,$data);
				$this->flash_message->success('Record inserted successfully');
				redirect(base_url() . 'index.php/customer/customerdetail');
			}
		}
	}
 
	function delete()
	{
		$tablename='customer';
		$value= $this->uri->segment(3);
		$cno= $this->uri->segment(4);
		$this->customer_model->delete_row($tablename,$value,$cno);
		$this->flash_message->success('Record deleted successfully');
		redirect(base_url() . 'index.php/customer/customerdetail');
	}

	function update()
	{
		$this->load->library('form_validation');
		
		//$this->form_validation->set_rules('cno', 'Customer No', 'trim|required|max_length[10]');
		$this->form_validation->set_rules('cno', 'Customer No', 'trim|required');
		if($this->form_validation->run() == FALSE)
		{
				$this->customer();
		}
		else
		{
			$tablename='customer';
			$value= $this->uri->segment(3);
			$id='cid';
			$value1 =  $this->input->post('cno');
			$criteria=" cno='". $value1 ."' and ".$id." != ".$value."";
			$query = $this->global_model->checkunique($tablename,$criteria);
	
			if($query) // if the city already exists
			{
				$this->flash_message->warning('Customer No already exists',TRUE);
				$this->dress_typedetail();
			}
			else
			{			
				$wdate=$this->input->post('year')."-".$this->input->post('month')."-".$this->input->post('day');
				$data = array(
					'cno' => $this->input->post('cno'),	
					'cname' => $this->input->post('cname'),	
					'cpname' => $this->input->post('pname'),	
					'ctelephone' => $this->input->post('tno'),	
					'cptelephone' => $this->input->post('ptno'),	
					'cweddingdate' => $wdate,				
					
				);
				$this->global_model->update_record($tablename,$data,$id,$value);
				$this->flash_message->success('Updated Successfully');
				redirect(base_url() . 'index.php/customer/customerdetail');
			}
		}
	} 

}