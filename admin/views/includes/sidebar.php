<?php $this->config->load('path'); 
/*$query = $this->global_model->checkunique($tablename,$criteria);	
	if($query) // if the city already exists
	{
		$this->flash_message->warning('User already exists',TRUE);
		$this->userdetail();
	}
	else
	{	
	}
*/?>

<div id="sidebar"><div id="sidebar-wrapper"> <!-- Sidebar with logo and menu -->
			
				<h1 id="sidebar-title"><a href="#">Cocoon Bridal</a></h1>
		  
			<!-- Logo (221px wide) -->
		<h2 style="text-align:center; margin-top:20px; color:#59FB31">Cocoon Bridal</h2>
		  
			<!-- Sidebar Profile links -->
			<div id="profile-links">
				Hello, <a href="#" title="Edit your profile"><?php echo $this->session->userdata('username');?></a>
				<br />
                 <?php 
					if(!($this->session->userdata('is_logged_in')))
					{
						redirect(base_url(). "index.php");
					}
					else
					{ ?>
				<a href="<?php echo $this->config->item('ADMIN_BASE_URL');?>" title="View the Site">View the Site</a> | <a href="<?php echo base_url(); ?>index.php/admin/logout" title="Sign Out">Sign Out</a>
                	<?php
						}
						?>
			</div>     
			
			<ul id="main-nav">  <!-- Accordion Menu -->
			<?php	if($this->session->userdata('security_level')==3)
					{?>		
                <li> 
					<a href="#" class="nav-top-item" id="systemuser"> <!-- Add the class "current" to current menu item -->
					System User
					</a>
					<ul>
						<li><a id="user" href="<?php echo base_url(); ?>index.php/user/userdetail">User</a></li>
                       <?php /*?><li><a id="securityinfo" href="<?php echo base_url(); ?>index.php/user/securityinfo">Security Info</a></li><?php */?>						
					</ul>
				</li>
			<?php }?>
            <?php	if($this->session->userdata('security_level')==3 || $this->session->userdata('security_level')==2 || $this->session->userdata('security_level')==1)
					{?>		
				<li>
					<a href="#" class="nav-top-item" id="wcustomer">
						Walk-In Customer</a>
					<ul>
					 <li><a id="addwcustomer" href="<?php echo base_url(); ?>index.php/walkincustomer/walkincustomer_detail">Walk-In Customer</a></li>
				  </ul>
			  </li>
				
				<li>
					<a href="#" class="nav-top-item" id="customer">
						Customer</a>
					<ul>
						<li><a id="addcustomer" href="<?php echo base_url(); ?>index.php/customer/customerdetail">Customer</a></li>
						<li></li>
						<li></li>
					</ul>
				</li>
                <? } ?>
			<?php	if($this->session->userdata('security_level')==3)
					{?>					
					
				<li>
					<a href="#" class="nav-top-item" id="dress">
						Dress </a>
					<ul>
						<li><a id="dtype" href="<?php echo base_url(); ?>index.php/dress_type/dress_typedetail">Dress Type</a></li>
						<li><a id="dstyle" href="<?php echo base_url(); ?>index.php/dress_style/dress_styledetail">Dress Style</a></li>
						<li><a id="dstatus" href="<?php echo base_url(); ?>index.php/dress_status/dress_statusdetail">Dress Status</a></li>
						<li></li>
						<li></li>
					</ul>
				</li>
			<?php }?>	
            <?php	if($this->session->userdata('security_level')==3 || $this->session->userdata('security_level')==2)
					{?>		
				<li> <a href="#" class="nav-top-item" id="dressbooking"> Dress Booking</a>
				  <ul>
				    <li><a id="dbooking" href="<?php echo base_url(); ?>index.php/dress_booking/dress_booking_detail">Dress Booking</a></li>
						<li></li>
				  </ul>
				</li>  
                <?php }?>    
				 <li> <a href="#" class="nav-top-item" id="report">Reports</a>
				  <ul>
				    <li><a id="r1" href="<?php echo base_url(); ?>index.php/report/search">Search</a></li>
                    <li><a id="r2" href="<?php echo base_url(); ?>index.php/report/search_dress">Dress Search</a></li>					
				  </ul>
				</li>      
				
			</ul> <!-- End #main-nav -->		

			
		</div></div>