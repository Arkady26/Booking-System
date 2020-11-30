<?php 
class dress_style extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('global_model');	
	}
	function dress_style()
	{
		$tablename='dress_style';
		$data['records'] =$this->global_model->get_record($tablename); 
		$this->load->view('dress_style', $data);
	}
	
	function dress_styledetail($sort_by = 'styleno', $sort_order = 'asc', $offset = 0,$formrecord = 0)
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
		 	'styleno' => 'Style No',
			'type' => 'Type',
			'description' => 'Description'
		);
		
		$this->load->model('dress_style_model');	
		$results = $this->dress_style_model->search($limit, $offset, $sort_by, $sort_order,$searchtext);
		$data['formrecord'] = $formrecord['data'];
		//$data['city'] = 
		$data['num_results'] = $results['num_rows'];
		
		// pagination
		$this->load->library('pagination');
		$config = array();
		$config['base_url'] = base_url() . "index.php/dress_style/dress_styledetail/$sort_by/$sort_order";
		$config['total_rows'] = $data['num_results'];
		$config['per_page'] = $limit;
		$config['uri_segment'] = 5;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		 $data['sort_by'] = $sort_by;
		$data['sort_order'] = $sort_order;

		 
		$tablename='dress_style';
		$data['records'] =$results['rows'];
		//echo print_r($data['records']);
		$this->load->view('dress_style_detail', $data);

	}
	function addnew()
	{
		$this->load->view('dress_style.php');
	}
	function edit()
	{
		$tablename='dress_style';
		$value= $this->uri->segment(3);
		$id='did';
		$data['formrecord'] = $this->global_model->edit_select($tablename,$id,$value);
		$this->load->view('dress_style',$data);
	}
	function add_dress_style()
	{
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('type', 'Dress Type', 'trim|required');
	
		if($this->form_validation->run() == FALSE)
		{
				$this->dress_styledetail();
		}
		else
		{
			$tablename = 'dress_style';
			$value =  $this->input->post('styleno');
			$criteria=" styleno='".$value ."' and type='".$this->input->post('type')."'";
			$query = $this->global_model->checkunique($tablename,$criteria);

			
			if($query) // if the city already exists
			{
				$this->flash_message->warning('Dress Style No already exists',TRUE);
				$this->dress_styledetail();
			}
			else
			{
				$data = array(
					'type' =>$this->input->post('type'),				
					'styleno' =>$this->input->post('styleno'),	
					'description' =>$this->input->post('description')						
					
				);
				$this->global_model->add_record($tablename,$data);
				$this->flash_message->success('Record inserted successfully');
				redirect(base_url() . 'index.php/dress_style/dress_styledetail');
			}
		}
	}
 
	function delete()
	{
		$tablename='dress_style';
		$value= $this->uri->segment(3);
		$id='did';
		$this->global_model->delete_row($tablename,$id,$value);
		$this->flash_message->success('Record deleted successfully');
		redirect(base_url() . 'index.php/dress_style/dress_styledetail');

	}

	function update()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('styleno', 'Dress Style', 'trim|required');
		
		if($this->form_validation->run() == FALSE)
		{
				$this->dress_styledetail();
		}
		else
		{
			$tablename='dress_style';
			$value= $this->uri->segment(3);
			$id='did';
			$id1='type';
			$value1 =  $this->input->post('styleno');
			$criteria=" styleno='". $value1 ."' and ".$id." != ".$value." and type!=".$this->input->post('type')."";			
			$query = $this->global_model->checkunique($tablename,$criteria,$value1);
	
			if($query) // if the city already exists
			{
				$this->flash_message->warning('Dress Style already exists',TRUE);
				$this->dress_styledetail();
			}
			else
			{			
				$data = array(
					'type' => $this->input->post('type'),				
					'styleno' => $this->input->post('styleno'),	
					'description' => $this->input->post('description')						
					
				);
				$this->global_model->update_record($tablename,$data,$id,$value);
				$this->flash_message->success('Updated Successfully');
				redirect(base_url() . 'index.php/dress_style/dress_styledetail');
			}			
			
		}
	} 

}