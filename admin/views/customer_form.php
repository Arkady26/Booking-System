<div class="content-box">
  <div class="content-box-header">
 <?php  if($this->uri->segment(2)=='edit'){ ?>
 <h3>Edit Customer</h3>
 <? } else { ?>
 <h3>Add New Customer</h3>
 <? }?>
    </div>   
<div class="content-box-content">
<div class="tab-content">
 <?php 
 
 			if($this->uri->segment(2)=='edit')
			{
				$action = $this->config->base_url() . 'index.php/customer/update/' . $this->uri->segment(3); 
				$cno = $formrecord[0]->cno;
				$cname = $formrecord[0]->cname;
				$tno = $formrecord[0]->ctelephone;
				$pname = $formrecord[0]->cpname;
				$ptno = $formrecord[0]->cptelephone;
				$wdate = $formrecord[0]->cweddingdate;
				 if($wdate!='0000-00-00')
				 {
					 $wy=date('Y',strtotime($wdate));	
					 $wm=date('m',strtotime($wdate));
					 $wd=date('d',strtotime($wdate));	
				 }
			}
			else
   	    	{
		  	 	//echo "nkjkj".$wdate;
				$action = $this->config->base_url() . 'index.php/customer/add_customer'; 
				$cno = set_value('cno');
				$cname = set_value('cname');
				$tno = set_value('ctelephone');
				$pname =set_value('cpname');
				$ptno = set_value('cptelephone');
				$wdate =set_value('cweddingdate');	
				 if($wdate!='0000-00-00')
				 {
					$wy=date('Y',strtotime($wdate));	
					$wm=date('m',strtotime($wdate));
					$wd=date('d',strtotime($wdate));	
				 }
				 if($wdate=='')
				 {
					$wdate = date('Y-m-d');
					 $wy=date('Y',strtotime($wdate));	
					 $wm=date('m',strtotime($wdate));
					 $wd=date('d',strtotime($wdate));	
				 }
	    	} 
	?>
     <div id="eee" class="flash_message message_error"  style="display:none;" ></div> 
   <?php echo validation_errors('<p class="error">');?>
	<form name="form" id="form" method="post" action="<?php echo $action; ?>" onsubmit="javascript:if(!cvalidate('form','eee')){return false};">

    		<fieldset id="personal">
                        <div class="align-left" style="width:300px;">
                        <p>
                        <label>Customer No:<span style="color:#C00">*</span></h4></label>      
                        <input type="text" id="cno" maxlength="10"  class="text-input val_r_len_10" title="Customer No" name="cno" value="<?php echo $cno; ?>"/>Max(10)
                        </p>
                        <p>
                        <label>Name:<span style="color:#C00">*</span></h4></label>      
                        <input type="text" id="cname"  class="text-input val_req" title="Customer Name" name="cname" value="<?php echo $cname; ?>"/>
                        </p>
                        </div>
                        <div class="align-left">  
                        <p>
                        <label>Partner Name:</h4></label>      
                        <input type="text" id="pname"  class="text-input" title="Partner Name" name="pname" value="<?php echo $pname; ?>"/>
                        </p>  
                         <p>
                        <label>Partner Telephone No:</h4></label>      
                        <input type="text" id="ptno"  class="text-input" title="Partner Telephone No" name="ptno" value="<?php echo $ptno; ?>"/>
                        </p>   
                        </div>
                        <div class="clear"></div>
                          <p>
                        <label>Telephone No:</h4></label>      
                        <input type="text" id="tno"  class="text-input" title="Telephone No" name="tno" value="<?php echo $tno; ?>"/>
                        </p>  
                         <p>
                        <label>Wedding Date: </label> 
                        
                         <select class="small-select" name="day" id="day">
                        <option value="0">--Day--</option>
                         <?php $d=1;	
						 while($d<=31){
							 if($d<10) {$d='0'.$d;}
						?>
                         <option value="<?php echo $d;?>" <?php if($wd==$d){echo "selected=selected";}?>><?php echo $d?></option>
                         <?php $d++; }?>
                         </select>   
                           
                           
                          <select class="small-select"  name="month" id="month">
                         <option value="0">--Month--</option>
                         <?php $m=1;	
						 while($m<=12){
							 if($m<10) {$m='0'.$m;}
						?>
                         <option value="<?php echo $m;?>" <?php if($wm==$m){echo "selected=selected";}?>><?php echo  date('F', mktime(0,0,0,$m));?></option>
                         <?php $m++; }?>
                         </select>     
                         
                        <select class="small-select" name="year" id="year">
                         <option value="0">--Year--</option>
                         <?php $y= date('Y');	
						 $y1= date('Y')+4;					
						 while($y<=$y1){?>
                         <option value="<?php echo $y;?>" <?php if($wy==$y){echo "selected=selected";}?>><?php echo $y;?></option>
                         <?php $y++; }?>
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
