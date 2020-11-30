<?php error_reporting(E_ALL ^ (E_NOTICE | E_WARNING)); ?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('global_model');	
		//$this->load->model('deal_model');		
		$this->load->model('membership_model');		
		$this->load->library('email');
		$this->load->library('session');
		$this->load->library('form_validation');
	}
	public function index()
	{ 
		 
		if("admin" == $this->uri->segment(1))
		$this->load->model('membership_model');
			$q=$this->membership_model->isadmin(); 
			if($q)
			{
				if(!($this->session->userdata('is_logged_in')))
				{
					redirect(base_url(). "index.php/admin/login");
				}
				else
				{
					//$data['records']=$this->deal_model->dailydashboard();
					//$data['record']=$this->deal_model->totalcount();
					
					$this->load->view('index',$data);
				}
			}
			else
			{
				$this->load->view('signup_form');
			}
	}
	public function home()
	{
		redirect(base_url(). "index.php/admin/index");
		//$this->load->view('index',$data);	
	}
	function login()
	{	
		if(!($this->session->userdata('is_logged_in')))
		{
			$this->load->view('login');	
		}
		else
		{
			redirect(base_url());
		}
		
	}
	function logout() 
	{
	$this -> session -> sess_destroy();
	redirect(base_url(). "index.php");
	}
	function validate_credentials()
	{
		$this->form_validation->set_rules('username', 'Username', 'required');	
		$this->form_validation->set_rules('password', 'Password', 'required');		
		if($this->form_validation->run() == FALSE)
		{
			$this->flash_message->success('Incorrect Username or Password !','TRUE');
			$this->load->view('login');	
		}
		else
		{
			$data = $this->membership_model->validate($this->input->post('username'),$this->input->post('password'));
		}
		if($data!='') // if the user's credentials validated...
		{
			foreach ($data as $row)
			 {
				 $security_level=$row->security_level;
				 $uid=$row->id;				 
			 }
			$data = array(
				'username' => $this->input->post('username'),
				'id' => $uid,
				'nexturl' => '',
				'security_level' => $security_level,
				'is_logged_in'=> TRUE
				
			);
			session_start();
		    $this->session->set_userdata($data);
			$nexturl= $_SESSION['nexturl'];
			if($nexturl!='')
			{
				redirect(base_url().$nexturl);
			}
			else
			{
				redirect(base_url());
			}		
		}
		else // incorrect username or password
		{
			$this->flash_message->success('Incorrect Username or Password!','TRUE');
			$this->load->view('login');
		}
	}
	
	function forgetpassword()
	{
		$this->load->view('forgetpassword');	
	}
	function validate_email()
	{
		if($this->input->post('email')=="" && $this->input->post('username')=="" )
		{
			$this->form_validation->set_rules('username', 'User Name', 'required');
			$this->form_validation->set_rules('email', 'Email Address', 'required|valid_email');
		}
		if($this->input->post('email')=="")
		{
			$id="username";
			$value=$this->input->post('username');
			$this->form_validation->set_rules('username', 'User Name', 'required');
			$fleg=true;
		}
		if($this->input->post('username')=="")
		{
			$id="email";
			$value=$this->input->post('email');
			$this->form_validation->set_rules('email', 'Email Address', 'required|valid_email');
		}
		if($this->form_validation->run() == FALSE)
		{
			$this->flash_message->success('Incorrect Username or Email Address!!!!!!!!','TRUE');
			$this->load->view('forgetpassword');
		}
		else
		{
			$a=$this->membership_model->validateinput($id,$value);
		}
		if($a)
		{
				$this->email->from('demotesting92@gmail.com', 'Cocoon Bridal');
				if($fleg)
				{
					
					$emailaddress=$this->membership_model->getemailarrdess($value);
					$this->email->to($emailaddress);
				}
				else
				{
					$this->email->to($value);
				}
				$this->email->subject('Forget Password');
				$key=md5($value);
				$d='<a href="'. base_url().'index.php/admin/forgetchangepassword/'.$key.'/'.$id.'">click hear to change your password</a>';
				echo $d;
				$this->email->message($d);
				$f=$this->email->send();
				/*if($f)
				 {
					$this->flash_message->success('Email Send Successful','TRUE');
					$this->load->view('emailsendsuccessful');
				 }
				 else
				 {
					$this->flash_message->success('Email Not Send','TRUE');
					$this->load->view('emailnotsend');
				 }*/
		}
		else
		{
					$this->flash_message->success('Incorrect Username or Email Address!!!!!!!!','TRUE');
					$this->load->view('forgetpassword');
		}
		
	}
	function forgetchangepassword()
	{
		$this->load->view('forgetchangepassword');
	}
	function updatepassword()
	{
		$sendusername=$this->uri->segment(3);
		$flag=$this->uri->segment(4);
		if($flag == "username")
		{
			$this->form_validation->set_rules('username', 'Username', 'required');
			$correntname =	md5($this->input->post('username'));
			$username = $this->input->post('username');	
		}
		if($flag == "email")
		{
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			$correntname =	md5($this->input->post('email'));
			$username = $this->input->post('email');	
		}
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[4]|max_length[32]');
		$this->form_validation->set_rules('confirmpassword','Password Confirmation','required|matches[password]');
		
		if($this->form_validation->run() == FALSE)
		{
			$this->flash_message->success('Incorrect Username Or Incorrect Email !!!!!!!!','TRUE');
			$this->load->view('forgetchangepassword');
		}
		else
		{	
			
			if($sendusername == $correntname )
			{
				$data = array(
				'password' => md5($this->input->post('password'))
				);
				$this->membership_model->update_password($flag,$username,$data);
				$this->flash_message->success('Password Change successfully');
				$this->load->view('forgetchangepassword_successful');
			}
			else
			{
				$this->flash_message->success('Incorrect Username Or Incorrect Email !!!!!!!!','TRUE');
				$this->load->view('forgetchangepassword');
			}
		}
	}
	function create_member()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('fname', 'Name', 'trim|required');
		$this->form_validation->set_rules('lname', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|matches[confirmpassword]');
		$this->form_validation->set_rules('confirmpassword', 'Password Confirmation', 'trim|required');
		
		if($this->form_validation->run() == FALSE)
		{
			$this->load->view('signup_form');
		}
		else
		{			
		    $tablename = 'signup';
			$data= array(
			'username ' =>$this->input->post('email'),
			'fname' => $this->input->post('fname'),
			'lname' => $this->input->post('lname'),
			'password' => md5($this->input->post('password')),
			'email' => $this->input->post('email'),
			'security_level' => '1',
			'flag' => 'a'
			);	
			
			$id = $this->global_model->add_record($tablename,$data);
						
			$data1 = array(
				'username' => $this->input->post('email'),
				'id' => $id,
				'nexturl' => '',
				'security_level' => '1',
				'is_logged_in'=> TRUE				
			);
			session_start();
		    $this->session->set_userdata($data1);
			$nexturl= $_SESSION['nexturl'];
			if($nexturl!='')
			{
				redirect(base_url().$nexturl);
			}
			else
			{
				redirect(base_url());
			}
		}
	}
	function signup()
	{
		$this->load->view('signup_form');
		
	}

}