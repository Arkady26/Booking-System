<div class="content-box">
  <div class="content-box-header">
   <?php if($this->uri->segment(2)=='edit'){?>
   <h3>Edit Dress Type</h3>
   <? }else {?>
   <h3>Add New Dress Type</h3>
   <? }?>
    </div>   
<div class="content-box-content">
<div class="tab-content">
 <?php 
 
 			if($this->uri->segment(2)=='edit')
			{
				$action = $this->config->base_url() . 'index.php/dress_type/update/' . $this->uri->segment(3); 
				$type = $formrecord[0]->type;			
			}
			else
   	    	{
		  	 	$action = $this->config->base_url() . 'index.php/dress_type/add_dress_type'; 
				$type = set_value('type');
	    	} 
	?>
     <div id="eee" class="flash_message message_error"  style="display:none;" ></div> 
   <?php echo validation_errors('<p class="error">');?>
	<form name="form" id="form" method="post" action="<?php echo $action; ?>" onsubmit="javascript:if(!cvalidate('form','eee')){return false};">

    		<fieldset id="personal">
                        <p>
                        <label>Dress Type:<span style="color:#C00">*</span></h4></label>      
                      <input type="text" id="type"  class="text-input small-input val_req" title="Type" name="type" value="<?php echo $type; ?>"/>
                        </p>                                       
                        
                      <p>                                  
                      <input type="submit" id="submit1" class="button" value="Submit" name="submit1"/>
                     </p>    
                </fieldset>            
</form>
    
    </div>	
    </div>
</div>
