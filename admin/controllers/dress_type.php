<?php 
class dress_type extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('global_model');	
	}
	function dress_type()
	{
		$tablename='signup';
		$data['records'] =$this->global_model->get_record($tablename); 
		$this->load->view('systemuser', $data);
	}
	
	function dress_typedetail($sort_by = 'type', $sort_order = 'asc', $offset = 0,$formrecord = 0)
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
		 	'type' => 'Dress Type',
		);
		
		$this->load->model('dress_type_model');	
		$results = $this->dress_type_model->search($limit, $offset, $sort_by, $sort_order,$searchtext);
		$data['formrecord'] = $formrecord['data'];
		//$data['city'] = 
		$data['num_results'] = $results['num_rows'];
		
		// pagination
		$this->load->library('pagination');
		$config = array();
		$config['base_url'] = base_url() . "index.php/dress_type/dress_typedetail/$sort_by/$sort_order";
		$config['total_rows'] = $data['num_results'];
		$config['per_page'] = $limit;
		$config['uri_segment'] = 5;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		 $data['sort_by'] = $sort_by;
		$data['sort_order'] = $sort_order;

		 
		$tablename='signup';
		$data['records'] =$results['rows'];
		//echo print_r($data['records']);
		$this->load->view('dress_type_detail', $data);

	}
	function addnew()
	{
		$this->load->view('dress_type.php');
	}
	function edit()
	{
		$tablename='dress_type';
		$value= $this->uri->segment(3);
		$id='did';
		$data['formrecord'] = $this->global_model->edit_select($tablename,$id,$value);
		$this->load->view('dress_type',$data);
	}
	function add_dress_type()
	{
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('type', 'Dress Type', 'trim|required');
	
		if($this->form_validation->run() == FALSE)
		{
				$this->dress_typedetail();
		}
		else
		{
			$tablename = 'dress_type';
			$value =  $this->input->post('type');
			$criteria=" type='".$value ."'";
			$query = $this->global_model->checkunique($tablename,$criteria);

			
			if($query) // if the city already exists
			{
				$this->flash_message->warning('Dress Type already exists',TRUE);
				$this->dress_typedetail();
			}
			else
			{
				$data = array(
					'type' => $this->input->post('type'),				
					
				);
				$this->global_model->add_record($tablename,$data);
				$this->flash_message->success('Record inserted successfully');
				redirect(base_url() . 'index.php/dress_type/dress_typedetail');
			}
		}
	}
 
	function delete()
	{
		$tablename='dress_type';
		$value= $this->uri->segment(3);
		$id='did';		
		$this->global_model->delete_row($tablename,$id,$value);
		$this->flash_message->success('Record deleted successfully');
		redirect(base_url() . 'index.php/dress_type/dress_typedetail');

	}

	function update()
	{
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('type', 'Dress Type', 'trim|required');
		if($this->form_validation->run() == FALSE)
		{
				$this->dress_typedetail();
		}
		else
		{
			$tablename='dress_type';
			$value= $this->uri->segment(3);
			$id='did';
			$value1 =  $this->input->post('type');
			$criteria=" type='". $value1 ."' and ".$id." != ".$value."";
			$query = $this->global_model->checkunique($tablename,$criteria);
	
			if($query) // if the city already exists
			{
				$this->flash_message->warning('Dress Type already exists',TRUE);
				$this->dress_typedetail();
			}
			else
			{			
				$data = array(
					'type' => $this->input->post('type'),
				);
				$this->global_model->update_record($tablename,$data,$id,$value);
				$this->flash_message->success('Updated Successfully');
				redirect(base_url() . 'index.php/dress_type/dress_typedetail');
			}
		}
	} 

}