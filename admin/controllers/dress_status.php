<?php 
class dress_status extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('global_model');	
		$this->load->model('dress_status_model');	
	}
	function dress_status()
	{
		$tablename='dress_status';
		$data['records'] =$this->global_model->get_record($tablename); 
		$this->load->view('dress_status', $data);
	}
	
	function dress_statusdetail($sort_by = 'status', $sort_order = 'asc', $offset = 0,$formrecord = 0)
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
		 	'status' => 'Dress Status',
		);		
		$results = $this->dress_status_model->search($limit, $offset, $sort_by, $sort_order,$searchtext);
		$data['formrecord'] = $formrecord['data'];
		//$data['city'] = 
		$data['num_results'] = $results['num_rows'];
		
		// pagination
		$this->load->library('pagination');
		$config = array();
		$config['base_url'] = base_url() . "index.php/dress_status/dress_statusdetail/$sort_by/$sort_order";
		$config['total_rows'] = $data['num_results'];
		$config['per_page'] = $limit;
		$config['uri_segment'] = 5;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		 $data['sort_by'] = $sort_by;
		$data['sort_order'] = $sort_order;

		 
		$tablename='dress_status';
		$data['records'] =$results['rows'];
		//echo print_r($data['records']);
		$this->load->view('dress_status_detail', $data);

	}
	function addnew()
	{
		$this->load->view('dress_status.php');
	}
	function edit()
	{
		$tablename='dress_status';
		$value= $this->uri->segment(3);
		$id='did';
		$data['formrecord'] = $this->global_model->edit_select($tablename,$id,$value);
		$this->load->view('dress_status',$data);
	}
	function add_dress_status()
	{
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('status', 'Dress Status', 'trim|required');
	
		if($this->form_validation->run() == FALSE)
		{
				$this->dress_statusdetail();
		}
		else
		{
			$tablename = 'dress_status';
			$value =  $this->input->post('status');
			$criteria=" status='".$value ."'";
			$query = $this->global_model->checkunique($tablename,$criteria);

			
			if($query) // if the city already exists
			{
				$this->flash_message->warning('Dress Status already exists',TRUE);
				$this->dress_statusdetail();
			}
			else
			{
				$data = array(
					'status' => $this->input->post('status'),				
					
				);
				$this->global_model->add_record($tablename,$data);
				$this->flash_message->success('Record inserted successfully');
				redirect(base_url() . 'index.php/dress_status/dress_statusdetail');
			}
		}
	}
 
	function delete()
	{
		$tablename='dress_status';
		$value= $this->uri->segment(3);
		$id='did';
		$this->global_model->delete_row($tablename,$id,$value);
		$this->flash_message->success('Record deleted successfully');
		redirect(base_url() . 'index.php/dress_status/dress_statusdetail');

	}

	function update()
	{
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('status', 'Dress Status', 'trim|required');
		if($this->form_validation->run() == FALSE)
		{
				$this->userdetail();
		}
		else
		{
			$tablename='dress_status';
			$value= $this->uri->segment(3);
			$id='did';
			$value1 =  $this->input->post('status');
			$criteria=" status='". $value1 ."' and ".$id." != ".$value."";
			$query = $this->global_model->checkunique($tablename,$criteria);
	
			if($query) // if the city already exists
			{
				$this->flash_message->warning('Dress Status already exists',TRUE);
				$this->dress_statusdetail();
			}
			else
			{			
				$data = array(
					'status' => $this->input->post('status'),
				);
				$this->global_model->update_record($tablename,$data,$id,$value);
				$this->flash_message->success('Updated Successfully');
				redirect(base_url() . 'index.php/dress_status/dress_statusdetail');
			}
		}
	} 
	function setdefault()
	{
		$results = $this->dress_status_model->setdefaultstatus($this->uri->segment('3'));
		$this->dress_statusdetail();
	}
}