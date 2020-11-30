<?php 
class user extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('global_model');	
	}
	function user()
	{
		$tablename='signup';
		$data['records'] =$this->global_model->get_record($tablename); 
		$this->load->view('systemuser', $data);
	}
	function securityinfo()
	{
		$this->load->view('securityinfo');
	}
	
	function userdetail($sort_by = 'username', $sort_order = 'asc', $offset = 0,$formrecord = 0)
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
		 	'username' => 'Username',
			'security_level' =>'Security Level'			
		);
		
		$this->load->model('user_model');	
		$results = $this->user_model->search($limit, $offset, $sort_by, $sort_order,$searchtext);
		$data['formrecord'] = $formrecord['data'];
		//$data['city'] = 
		$data['num_results'] = $results['num_rows'];
		
		// pagination
		$this->load->library('pagination');
		$config = array();
		$config['base_url'] = base_url() . "index.php/user/userdetail/$sort_by/$sort_order";
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
		$this->load->view('userdetailview', $data);

	}
	function addnew()
	{
		$this->load->view('systemuser.php');
	}
	function edit()
	{
		$tablename='signup';
		$value= $this->uri->segment(3);
		$id='uid';
		$data['formrecord'] = $this->global_model->edit_select($tablename,$id,$value);
		$this->load->view('systemuser',$data);
	}
	function adduser()
	{
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('uname', 'Name', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		
		if($this->form_validation->run() == FALSE)
		{
				$this->userdetail();
		}
		else
		{
			$tablename = 'signup';
			$value =  $this->input->post('uname');
			$criteria=" username='".$value ."'";
			$query = $this->global_model->checkunique($tablename,$criteria);

			
			if($query) // if the city already exists
			{
				$this->flash_message->warning('User already exists',TRUE);
				$this->userdetail();
			}
			else
			{
				if($this->input->post('sl') == '1')
				{
					$flag = 'a';
				}
				else
				{
					$flag = 'u';
				}
				$data = array(
					'username' => $this->input->post('uname'),
					'password' => md5($this->input->post('password')),
					'security_level' => $this->input->post('sl'),
					'flag'=>$flag
				);
				$this->global_model->add_record($tablename,$data);
				$this->flash_message->success('Record inserted successfully');
				redirect(base_url() . 'index.php/user/userdetail');
			}
		}
	}
 
	function delete()
	{
		$tablename='signup';
		$value= $this->uri->segment(3);
		$id='uid';
		$this->global_model->delete_row($tablename,$id,$value);
		$this->flash_message->success('Record deleted successfully');
		redirect(base_url() . 'index.php/user/userdetail');

	}

	function update()
	{
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('uname', 'Username', 'trim|required');
		if($this->form_validation->run() == FALSE)
		{
				$this->userdetail();
		}
		else
		{
			$tablename='signup';
			$value= $this->uri->segment(3);
			$id='uid';
			$value1 =  $this->input->post('uname');
			$criteria=" username='". $value1 ."' and ".$id." != ".$value."";
			$query = $this->global_model->checkunique($tablename,$criteria);
			
			
	
			if($query) // if the city already exists
			{
				$this->flash_message->warning('User already exists',TRUE);
				$this->userdetail();
			}
			else
			{	
				if($this->input->post('sl') == '1')
				{
					$flag = 'a';
				}
				else
				{
					$flag = 'u';
				}
				if($this->input->post('pwd')==$this->input->post('password'))
				{
					$data = array(
					'username' => $this->input->post('uname'),
					'password' => $this->input->post('password'),
					'security_level' => $this->input->post('sl'),
					'flag'=>$flag					
					);
				}
				else
				{
					$data = array(
					'username' => $this->input->post('uname'),
					'password' => md5($this->input->post('password')),
					'security_level' => $this->input->post('sl'),
					'flag'=>$flag				
					);
				}
				$this->global_model->update_record($tablename,$data,$id,$value);
				$this->flash_message->success('Updated Successfully');
				redirect(base_url() . 'index.php/user/userdetail');
			}
		}
	} 

}