<?php $this->load->view('includes/header'); ?>
<div class="content-box"><!-- Start Content Box -->
        
        <div class="content-box-header">
            
            <h3>Security Information</h3>         
              <div class="clear"></div>
         </div> 
<div class="content-box-content">
<div class="tab-content"> 
<br />
 <h4>Security Level 1 : It contain all Rights. (Admin)</h4><br />
 <h4>Security Level 2 : It contain Rights to access Customer, Walk-In customer, Dress Booking and Reports. (User)</h4>
</div>
</div>
</div>
 <script type="text/javascript">
document.getElementById('securityinfo').className='current';
document.getElementById('systemuser').className='nav-top-item current';
</script>
<?php $this->load->view('includes/footer'); ?>
