<div class="content-box">
  <div class="content-box-header">
   <?php if($this->uri->segment(2)=='edit'){ ?>
   <h3>Edit New User</h3>
   <? } else { ?>
   <h3>Add New User</h3>
   <? }?>
    </div>   
<div class="content-box-content">
<div class="tab-content">
 <?php 
 
 			if($this->uri->segment(2)=='edit')
			{
				$action = $this->config->base_url() . 'index.php/user/update/' . $this->uri->segment(3); 
				$uname = $formrecord[0]->username;
				$password = $formrecord[0]->password;
				$sl = $formrecord[0]->security_level;
			}
			else
   	    	{
		  	 	$action = $this->config->base_url() . 'index.php/user/adduser'; 
				$uname = set_value('uname');
				$password=set_value('password');
				$sl=set_value('sl');
	    	} 
	?>
     <div id="eee" class="flash_message message_error"  style="display:none;" ></div> 
   <?php echo validation_errors('<p class="error">');?>
	<form name="form" id="form" method="post" action="<?php echo $action; ?>" onsubmit="javascript:if(!cvalidate('form','eee')){return false};">

    		<fieldset id="personal">
                        <p>
                        <label>Name:<span style="color:#C00">*</span></h4></label>      
                        <input type="text" id="uname"  class="text-input small-input val_req" title="Username" name="uname" value="<?php echo $uname; ?>"/>
                        <input name="pwd" id="pwd" type="hidden" value="<?php echo $password; ?>"/>
                        </p>
                         <p>
                        <label>Password:<span style="color:#C00">*</span></h4></label>      
                        <input type="password" id="password" class="text-input small-input val_req" title="Password" name="password" value="<?php echo $password; ?>"/>
                        </p> 
                         <p>
                        <label>Security Level:<span style="color:#C00">*</span></h4></label> 
                         <select title="User Level" name="sl" id="sl"  class="text-input small-input val_req_combo">  
                              <option value="0">--Select Security Level--</option>                
                         	 <option value="1" <?php if($sl==1){echo "selected=selected";}?> >Security Level 1</option>
                            <option value="2" <?php if($sl==2){echo "selected=selected";}?>>Security Level 2</option>				
                            <option value="3" <?php if($sl==3){echo "selected=selected";}?>>Security Level 3</option>                                               
                        </select>     
                       
                        </p>                     
                        
                      <p>             
                         <input type="submit" id="submit1" class="button" value="Submit" name="submit1"/>
                     </p>    
                       </fieldset>            
</form>
    
    </div>	
    </div>
</div>
