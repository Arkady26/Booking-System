<div class="content-box">
  <div class="content-box-header">
  <?php if($this->uri->segment(2)=='edit'){?>
  <h3>Edit Dress Style</h3>
  <? }else { ?>
    <h3>Add New Dress Style</h3>
    <? }?>
    </div>   
<div class="content-box-content">
<div class="tab-content">
 <?php 
 
 			if($this->uri->segment(2)=='edit')
			{
				$action = $this->config->base_url() . 'index.php/dress_style/update/' . $this->uri->segment(3); 
				$type = $formrecord[0]->type;	
				$sno = $formrecord[0]->styleno;
				$des = $formrecord[0]->description;		
			}
			else
   	    	{
		  	 	$action = $this->config->base_url() . 'index.php/dress_style/add_dress_style'; 
				$type = set_value('type');
				$sno = set_value('sno');
				$type = set_value('description');
	    	} 
	?>
     <div id="eee" class="flash_message message_error"  style="display:none;" ></div> 
   <?php echo validation_errors('<p class="error">');?>
	<form name="form" id="form" method="post" action="<?php echo $action; ?>" onsubmit="javascript:if(!cvalidate('form','eee')){return false};">
		<?php $q="select * from dress_type order by did";
		$rs=mysql_query($q);			
		?>
    		<fieldset id="personal">
                        <p>
                        <label>Dress Type:<span style="color:#C00">*</span></h4></label>  
                        <select id="type" class="text-input small-input val_req_combo" title="Dress Type" name="type">
                        <option value="0">--Please Select Type--</option>
                        <?php while($row=mysql_fetch_array($rs)){?>    
                        <option value="<?php echo $row['did'];?>" 
						<?php if($type==$row['did']){echo "selected=selected";}?>><?php echo $row['type'];?></option>
                      <?php }?>
                      </select>
                        </p>  
                        <p>
                        <label>Style No:<span style="color:#C00">*</span></h4></label>      
                        <input type="text" id="styleno"  class="text-input small-input val_req" title="Style No" name="styleno" value="<?php echo $sno; ?>"/>
                        </p>                                      
                        <p>
                        <label>Style Description:</h4></label>  
                           	<textarea name="description" id="description" cols="3" rows="5" class="text-input small-input" title="Description"><?php echo $des; ?></textarea>	 
                        
                        </p> 
                      <p>             
                       <input type="submit" id="submit1" class="button" value="Submit" name="submit1"/>
                     </p>    
                       </fieldset>            
</form>
    
    </div>	
    </div>
</div>
