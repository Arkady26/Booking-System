<?php $this->load->view('includes/header');
session_start();
if($this->session->userdata('security_level')!=3)
{
	redirect(base_url());
} 
?>  
<?php $this->load->view('user_form'); ?>
 <script type="text/javascript">
document.getElementById('user').className='current';
document.getElementById('systemuser').className='nav-top-item current';
</script>
<?php $this->load->view('includes/footer'); ?>

