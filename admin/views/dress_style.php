<?php $this->load->view('includes/header'); 
session_start();
if($this->session->userdata('security_level')!=3)
{
	redirect(base_url());
}
?>  
<?php $this->load->view('dress_style_form'); ?>
 <script type="text/javascript">
document.getElementById('dstyle').className='current';
document.getElementById('dress').className='nav-top-item current';
</script>
<?php $this->load->view('includes/footer'); ?>

