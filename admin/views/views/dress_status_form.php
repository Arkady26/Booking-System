<div class="content-box">
  <div class="content-box-header">
   <?php if($this->uri->segment(2)=='edit'){?>
   <h3>Edit Dress Status</h3>
   <? } else { ?>
   <h3>Add New Dress Status</h3>
   <? }?>
    </div>   
<div class="content-box-content">
<div class="tab-content">
 <?php 
 
 			if($this->uri->segment(2)=='edit')
			{
				$action = $this->config->base_url() . 'index.php/dress_status/update/' . $this->uri->segment(3); 
				$status = $formrecord[0]->status;			
			}
			else
   	    	{
		  	 	$action = $this->config->base_url() . 'index.php/dress_status/add_dress_status'; 
				$status = set_value('status');
	    	} 
	?>
     <div id="eee" class="flash_message message_error"  style="display:none;" ></div> 
   <?php echo validation_errors('<p class="error">');?>
	<form name="form" id="form" method="post" action="<?php echo $action; ?>" onsubmit="javascript:if(!cvalidate('form','eee')){return false};">

    		<fieldset id="personal">
                        <p>
                        <label>Dress Status:<span style="color:#C00">*</span></h4></label>      
                        <input type="text" id="status"  class="text-input small-input val_req" title="Status" name="status" value="<?php echo $status; ?>"/>
                        </p>                                       
                        
                      <p>                                 
                       <div>
                           <input type="submit" id="submit1" class="button" value="Submit" name="submit1"/>
                       </div>
                     </p>    
                       </fieldset>            
</form>
    
    </div>	
    </div>
</div>
