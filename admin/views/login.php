<?php $this->load->view('includes/header1'); ?>

<style type="text/css">
#login-top{
	font:bold 20px Verdana, Geneva, sans-serif;	
}
</style>
<div id="login-wrapper" class="png_bg">
			<div id="login-top">
			
				<!-- Logo (221px width) -->
           Cocoon Bridal Database System Version 2.00

			</div> <!-- End #logn-top -->            
			<div id="login-content">
				<div id="eee" style="display:none;" class="flash_message message_success" ></div> 
                  <?php echo $this->flash_message->show_all(); 
                 $action =  base_url().'index.php/admin/validate_credentials' ;?> 			
				<form action="<?php echo $action ;?>" name="form" id="form" method="post" onsubmit="javascript:if(!cvalidate('form','eee')){return false};">
					
					<p>
						<label>Username</label>
						 <input type="text" id="username" title="User Name" name="username"  value=""  class="text-input val_req" />
					</p>
					<div class="clear"></div>
					<p>
						<label>Password</label>
						<input  type="password" id="password" title="Password" name="password" value="" class="text-input val_req" />	
					</p>
					<div class="clear"></div>
					 <p>
        			  <input type="submit" id="submit1" class="button" value="Login" name="submit1" />

        			 </p>
					
				</form>
                <div class="clear"></div>
                <!--<div class="notification information png_bg" style="margin-top:10px;">
						<div>
							<?php// echo anchor(base_url() . "index.php/admin/forgetpassword", 'forget password ?'); ?>
						</div>
				</div>-->
			</div> <!-- End #login-content -->
			
		</div> <!-- End #login-wrapper -->
		
<?php $this->load->view('includes/footer'); ?>