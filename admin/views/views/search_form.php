<script type="text/javascript">
function chk(frm)
{
	if(document.getElementById('syear').value!=0 || document.getElementById('eyear').value!=0 || document.getElementById('smonth').value!=0 || document.getElementById('emonth').value!=0 || document.getElementById('syear').value!=0 || document.getElementById('sday').value!=0 || document.getElementById('eday').value!=0)
	{
		if(document.getElementById('syear').value==0 || document.getElementById('eyear').value==0 || document.getElementById('smonth').value==0 || document.getElementById('emonth').value==0 || document.getElementById('syear').value==0 || document.getElementById('sday').value==0 || document.getElementById('eday').value==0)
		{
			document.getElementById('eee').style.display='block';
			document.getElementById('eee').innerHTML='Please Enter Proper Date !';
			scroll(0,0);
			return false;
		}	
		else
		{
			return true;
		}
		return false;
	}
	return true;
}
</script>
<div class="content-box">
  <div class="content-box-header">
    <h3>Search</h3>
    </div>   
<div class="content-box-content">
<div class="tab-content">
 <?php 	
		if(isset($_POST['search']))
		{		
			$sdate=$this->input->post('syear')."-".$this->input->post('smonth')."-".$this->input->post('sday');
			$edate=$this->input->post('eyear')."-".$this->input->post('emonth')."-".$this->input->post('eday'); 
			if(strtotime($sdate) > strtotime($edate))
			{
				$this->flash_message->error('Please Enter End Date after Start Date !');
				redirect(base_url() . 'index.php/report/search/');	
			}	
			$style =$this->input->post('style');		
			$cno=$this->input->post('cno');		
			$ctelephone=$this->input->post('ctelephone');		
			$status =$this->input->post('status');
			$type = $this->input->post('type');
			
			
			 if($sdate!='0-0-0')
				 {
					 $sy=date('Y',strtotime($sdate));	
					 $sm=date('m',strtotime($sdate));
					 $sd=date('d',strtotime($sdate));	
				 }
				  if($edate!='0-0-0')
				 {
					 $ey=date('Y',strtotime($edate));	
					 $em=date('m',strtotime($edate));
					 $ed=date('d',strtotime($edate));	
				 }
			}
		
	?>
     <div id="eee" class="flash_message message_error"  style="display:none;" ></div> 
   <?php echo validation_errors('<p class="error">');?>
	<form name="form" id="form" method="post" action="<?php echo base_url() . 'index.php/report/search/';?>" onsubmit="javascript:if(!cvalidate('form','eee')){return false} else {if(!chk(this)) return false};">

    		<fieldset id="personal">
            		<div class="align-left" style="width:300px">
            			<p>
                         <?php $qc="select * from customer order by cid";
						$rsc=mysql_query($qc);			
						?>
                        <label>Customer:</label>      
                        <select id="cno" size="8" class="text-input" title="Customer No" name="cno" >
                        <option value="0">--Select Cusomer--</option>
                        <?php while($rowc=mysql_fetch_array($rsc)){?>    
                        <option value="<?php echo $rowc['cno'];?>" <?php if($cno==$rowc['cno']){echo "selected=selected";}?>><?php echo $rowc['cno']." - [ ".$rowc['cname']." ]";?></option>
                       <?php }?>
                       </select>
                        </p>  
             
                        <p>
                        <?php $q="select * from dress_type order by did";
						$rs=mysql_query($q);			
						?>
                        <label>Dress Type:</label>      
                        <select id="type" class="text-input" title="Dress Type" name="type">
                        <option value="0">--Select Dress Type--</option>
                        <?php while($row=mysql_fetch_array($rs)){?>    
                        <option value="<?php echo $row['did'];?>" <?php if($type==$row['did']){echo "selected=selected";}?>><?php echo $row['type'];?></option>
                      <?php }?>
                      </select>
                        </p>
                        
                        <p> 
                        <label>Dress Style:</label>  
                          
                        <select id="style" size="8" class="text-input" title="Dress Style" name="style">
                        <option value="0">--Select Dress Style--</option> 
                      </select>
                        </p>
                    </div>
                    <div class="align-left">  
                    <p>
                        <label>Customer No:</h4></label>      
                        <input type="text" id="customerno" class="text-input" title="Customer Phone No:" name="customerno" value="<?php echo $customerno;?>"/>
                        </p>  
                    <p>
                        <label>Customer Phone No:</h4></label>      
                        <input type="text" id="ctelephone" class="text-input" title="Customer Phone No:" name="ctelephone" value="<?php echo $ctelephone;?>"/>
                        </p>
                        <p>
                          <?php $q="select * from dress_status order by did";
						$rs=mysql_query($q);			
						?>
                        <label>Dress Status:</label>      
                        
                   	    <select id="status" class="text-input" title="Dress Status" name="status">
                         <option value="0">--Select Dress Status--</option>
                        <?php while($row=mysql_fetch_array($rs)){?>    
                        <option value="<?php echo $row['did'];?>" <?php if($status==$row['did']){echo "selected=selected";}?>><?php echo $row['status'];?></option>
                      <?php }?>
                      </select>
                        </p>
                        
                      	<p>
                        <label>Booking Start Date:</label>  
                         <select class="small-select" name="sday" id="sday" title="Day">
                            <option value="0">--Day--</option>
                             <?php $d=1;	
                             while($d<=31){
                                 if($d<10) {$d='0'.$d;}
                            ?>
                             <option  value="<?php echo $d;?>" <?php if($sd==$d){echo "selected=selected";}?>><?php echo $d?></option>
                             <?php $d++; }?>
                        </select> 
                        <select class="small-select"  name="smonth" id="smonth" title="Month">
                             <option value="0">--Month--</option>
                             <?php $m=1;	
                             while($m<=12){
                                 if($m<10) {$m='0'.$m;}
                            ?>
                             <option value="<?php echo $m;?>" <?php if($sm==$m){echo "selected=selected";}?>><?php echo date('F', mktime(0,0,0,$m));?></option>
                        	 <?php $m++; }?>
                         </select>    
                                               
                      <select class="small-select"  name="syear" id="syear" title="Year">     
                  		 <option value="0">--Year--</option>
                         <?php $y= date('Y');	
						 $y1= date('Y')+4;					
						 while($y<=$y1){?>
                         <option  value="<?php echo $y;?>" <?php if($sy==$y){echo "selected=selected";}?>><?php echo $y;?></option>
                         <?php $y++; }?>
                        </select>            
                    </p>
                        
                        <p>
                        <label>Booking End Date:</label>
                         <select class="small-select" name="eday" id="eday" title="Day">
                            <option value="0">--Day--</option>
                             <?php $d=1;	
                             while($d<=31){
                                 if($d<10) {$d='0'.$d;}
                            ?>
                             <option  value="<?php echo $d;?>" <?php if($ed==$d){echo "selected=selected";}?>><?php echo $d?></option>
                             <?php $d++; }?>
                         </select>  
                          <select class="small-select" name="emonth" id="emonth"  title="Month">
                             <option value="0">--Month--</option>
                             <?php $m=1;	
                             while($m<=12){
                                 if($m<10) {$m='0'.$m;}
                            ?>
                             <option  value="<?php echo $m;?>" <?php if($em==$m){echo "selected=selected";}?>><?php echo date('F', mktime(0,0,0,$m));?></option>
                             <?php $m++; }?>
                         </select>  
                         <select class="small-select" name="eyear" id="eyear"  title="Year">        
                             <option value="0">--Year--</option>
                             <?php $y= date('Y');	
                             $y1= date('Y')+4;					
                             while($y<=$y1){?>
                             <option value="<?php echo $y;?>" <?php if($ey==$y){echo "selected=selected";}?>><?php echo $y;?></option>
                             <?php $y++; }?>
                         </select> 
                        </p>      
                    </div>
                    <div class="clear"></div>    
                      <p>             
               			<input type="submit" id="search" class="button" value="Search" name="search"/>
                     </p>    
                       </fieldset>           
    	
 </form>   

</div>
<!--  ---------------------------------------Search result-------------------------------------------- -->

<div class="content-box">        
   <div class="content-box-header">
    <h3>Search Result</h3>
    </div>
<div class="content-box-content">
<div class="tab-content"> 
<?php  
if(sizeof($records)>0)
{
?>
<table width="100%">
 <thead> 
           <tr>			 
                <th>Customer No</th>
                <th>Staff name</th>
                <th>Remarks</th>
                <th>Type</th>
                <th>Style</th>
                <th>Status</th>
                <th>Start Date</th>
                <th>End Date</th> 
	      </tr>
</thead>
  <tfoot>
        <tr>
        <td colspan="3">
        <?php if (strlen($pagination)): ?>
	<div class="pagination">
		<?php echo $pagination; ?>
	</div>
	<?php endif; ?>
        </td>
        </tr>
  </tfoot>
   <tbody>
    <?php foreach($records as $item):?>  
		<?php $q1="select * from dress_type where did='".$item->type."'";
        $rs1=mysql_query($q1);	
        $r1=mysql_fetch_array($rs1);
        $q2="select * from dress_style where did='".$item->style."'";
        $rs2=mysql_query($q2);	
        $r2=mysql_fetch_array($rs2);	
        $q3="select * from dress_status where did='".$item->status."'";
        $rs3=mysql_query($q3);	
        $r3=mysql_fetch_array($rs3);				
        ?>      
            
            <tr>
                <td><?php echo $item->customer_no ; ?></td>
                <td><?php echo $item->staff_name ; ?></td>
                <td><?php echo $item->remarks; ?></td>
                <td><?php echo $r1['type']; ?></td>
                <td><?php echo $r2['styleno']; ?></td>
                <td><?php echo $r3['status']; ?></td>
                <td><?php echo date('d F Y',strtotime($item->datebefore)); ?></td>
                <td><?php echo date('d F Y',strtotime($item->dateafter)); ?></td>              
             </tr>   
        <?php endforeach;?>            
        </tbody>       
	
           </table> 
        <?php }
   else
   {
	   echo "<h5>No Result Found !</h5>";
   }?>             
            </div>
            </div>
   </div>
  
   <!--  ---------------------------------------Bag Detail End-------------------------------------------- -->