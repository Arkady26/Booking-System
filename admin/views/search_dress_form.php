<script language="javascript">
function chk1()
{
		if(document.getElementById('syear').value!=0 && document.getElementById('eyear').value!=0 && document.getElementById('smonth').value!=0 && document.getElementById('emonth').value!=0 && document.getElementById('syear').value!=0 && document.getElementById('sday').value!=0 && document.getElementById('eday').value!=0)
	{
		document.getElementById('syear').className='small-select val_req_combo';
		document.getElementById('eyear').className='small-select val_req_combo';
		document.getElementById('smonth').className='small-select val_req_combo';
		document.getElementById('emonth').className='small-select val_req_combo';
		document.getElementById('sday').className='small-select val_req_combo';
		document.getElementById('eday').className='small-select val_req_combo';
	
	}
}
function addOption(selectbox,text,value,selected)
{
	var optn = document.createElement("OPTION");
	optn.text = text;
	optn.value = value;
	optn.selected = selected;
	selectbox.options.add(optn);
}

function removeOption(listbox,i)
{
	listbox.remove(i);
}

function addOption_list(){	
//document.getElementById('SubCat').value='';
	for(i=document.frmshows.selstyle.options.length-1;i>=0;i--)	
	{
		var selstyle=document.frmshows.selstyle;
		if(document.frmshows.selstyle[i].selected)
		{
		addOption(document.frmshows.SubCat, document.frmshows.selstyle[i].text, document.frmshows.selstyle[i].value, document.frmshows.selstyle[i].selected);
		//removeOption(selstyle,i);
		}
	}
}


function removeAllOptions(selectbox)
{
	var i;
	for(i=selectbox.options.length-1;i>=0;i--)
	{
		//selectbox.options.remove(i);
//		addOption(document.frmshows.selstyle, document.frmshows.SubCat[i].text, document.frmshows.SubCat[i].value);
		selectbox.remove(i);
	}
}

function sel_shows()
{
	if(document.frmshows.cname.value!="")
	{
		document.frmshows.submit();
	}
	//alert(document.frmshows.cname.value);
}

</script>
<div class="content-box">
  <div class="content-box-header">
    <h3>Search</h3>
    </div>   
<div class="content-box-content">
<div class="tab-content">
 <?php 
 session_start();	
		if(isset($_POST['search']))
		{	
			$sdate=$this->input->post('syear')."-".$this->input->post('smonth')."-".$this->input->post('sday');
			$edate=$this->input->post('eyear')."-".$this->input->post('emonth')."-".$this->input->post('eday');
			$style =$this->input->post('SubCat');
			$type =$this->input->post('type');
			
			if($this->input->post('type')==0)
			{ 
				$this->flash_message->error('Please Select Dress Type !');
				redirect(base_url() . 'index.php/report/search_dress/');	
			}						
			else if(strtotime($sdate) > strtotime($edate))
			{ 
				$this->flash_message->error('Please Enter End Date after Start Date !');
				redirect(base_url() . 'index.php/report/search_dress/');	
			}	
					
												
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
			
		else if(isset($_POST['searchtest']))
			{	
				
				$sdate=$this->input->post('syear')."-".$this->input->post('smonth')."-".$this->input->post('sday');
				$edate=$this->input->post('eyear')."-".$this->input->post('emonth')."-".$this->input->post('eday');
				
				$style =$this->input->post('SubCat');
				 $type =$this->input->post('type');
				
				if($this->input->post('type')==0)
				{ 
					$this->flash_message->error('Please Select Dress Type !');
					redirect(base_url() . 'index.php/report/search_dress/');	
				}						
				else if(strtotime($sdate) > strtotime($edate))
				{ 
					$this->flash_message->error('Please Enter End Date after Start Date !');
					redirect(base_url() . 'index.php/report/search_dress/');	
				}				
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
		else 
		{
			
				$sdate = date('Y-m-d');
				$sy=date('Y',strtotime($sdate));	
				$sm=date('m',strtotime($sdate));
			    $sd=date('d',strtotime($sdate));
				
				$edate =date("Y-m-d",strtotime('+1 year' ,strtotime($sdate))) ;
				$ey=date('Y',strtotime($edate));	
				$em=date('m',strtotime($edate));
			    $ed=date('d',strtotime($edate));
			
		}
				
	
	?>
     <div id="eee" class="flash_message message_error"  style="display:none;" ></div> 
   <?php echo validation_errors('<p class="error">');?>
	<form name="frmshows" id="frmshows" method="post" action="<?php echo base_url() . 'index.php/report/search_dress/';?>" onsubmit="javascript:if(!cvalidate('form','eee')){return false};">

    		<fieldset id="personal">            			
             
                        <p>
                        <?php $q="select * from dress_type order by type";
						$rs=mysql_query($q);			
						?>
                        <label>Dress Type:</label>      
                        <select id="type" class="text-input" title="Dress Type" name="type" onfocus="removeAllOptions(SubCat);" onchange="if(this.options[this.selectedIndex].onclick && document.all) {this.options[this.selectedIndex].onclick();}else{this.options[this.selectedIndex].onclick();}">
                        <option  value="0">--Select Dress Type--</option>
                        <?php while($row=mysql_fetch_array($rs)){?>    
                        <option  value="<?php echo $row['did'];?>" <?php if($type==$row['did']){echo "selected=selected";}?>><?php echo $row['type'];?></option>
                      <?php }?>
                      </select>
                        </p>
                        
                        
                          <?php /*?><?php 
						  if($type!='0')
						  {
							  $q="select * from dress_style where type='".$type."' order by did";
						  }
						  else
						  {
						 	 $q="select * from dress_style order by did";
						  }
						$rs=mysql_query($q);
									
						?><?php */?>
                        <label>Dress Style:</label>
                        <div style="width:300px;" id="dressstyle">
                        <strong>Hold</strong> the Ctrl key for multiple selections<br />
                        <table>
                        <tr>
                        <td> 
          				<select name="selstyle" multiple="multiple" size="7" id="selstyle" style="width:200px">
                            <option value="0">--Select Dress Style--</option>   
                        <?php /*?><?php while($row=mysql_fetch_array($rs)){?>    
                        <option value="<?php echo $row['did'];?>" <?php if($style==$row['did']){echo "selected=selected";}?>><?php echo $row['styleno'];?></option>
                      <?php }?><?php */?>
                          </select>   
                        </td>
                        <td style="float:left;">  
                          <input onClick="addOption_list()" ;="" value="Add &gt;&gt;" type="button"> <br /><br />
							<input onClick="removeAllOptions(SubCat)" ;="" value="Remove All" type="button">
						</td>
                        <td>
                           <?php // echo sizeof($style); 						
						    if(sizeof($style)>0){ ?>
                           
                           <select name="SubCat[]" id="SubCat"  multiple="multiple"  size="7" style="width:200px"> 
                                                    <option value="0">--Selected Dress Style--</option> 
                                                                           
                        <?php foreach ($style as $row){
							$q1="select * from dress_style where did='".$row['did']."' order by did";
						$rs1=mysql_query($q1);
						$row1=mysql_fetch_array($rs1)?>    
                        <option value="<?php echo $row1['did'];?>"><?php echo $row1['styleno'];?></option>
                      <?php }?>
                          </select> 
                           
                           <?php }else{?>
                           <select name="SubCat[]" id="SubCat"  multiple="multiple"  size="7" style="width:200px"> 
                                                    <option value="0">--Selected Dress Style--</option>                        
                        <?php while($row=mysql_fetch_array($rs)){?>    
                        <option value="<?php echo $row['did'];?>" <?php if($style==$row['did']){echo "selected=selected";}?>><?php echo $row['styleno'];?></option>
                      <?php }?>
                          </select> 
                          <?php }?>                       
                      </td>
                      </tr>
                      </table>
                        </div>
                     
                     <div class="align-left" style="width:350px">   
                      <p>
                        <label>Booking Start Date:</label> 
                         <select class="small-select" name="sday" id="sday" title="Day">
                            <option value="0">--Day--</option>
                             <?php $d=1;	
                             while($d<=31){
                                 if($d<10) {$d='0'.$d;}
                            ?>
                             <option onclick="chk1();" value="<?php echo $d;?>" <?php if($sd==$d){echo "selected=selected";}?>><?php echo $d?></option>
                             <?php $d++; }?>
                        </select>  
                               
                        <select class="small-select"  name="smonth" id="smonth" title="Month">
                             <option value="0">--Month--</option>
                             <?php $m=1;	
                             while($m<=12){
                                 if($m<10) {$m='0'.$m;}
                            ?>
                             <option onclick="chk1();" value="<?php echo $m;?>" <?php if($sm==$m){echo "selected=selected";}?>><?php echo date('F', mktime(0,0,0,$m));?></option>
                             <?php $m++; }?>
                         </select>   
                                            
                      	<select class="small-select" name="syear" id="syear" title="Year">     
                            <option value="0">--Year--</option>
							 <?php $y= date('Y');	
                             $y1= date('Y')+4;					
                             while($y<=$y1){?>
                             <option onclick="chk1();" value="<?php echo $y;?>" <?php if($sy==$y){echo "selected=selected";}?>><?php echo $y;?></option>
                             <?php $y++; }?>
                         </select>
                                 
                    </p>
                     </div>
                     <div class="align-left">   
                      <p>
                        <label>Booking End Date:</label>  
                        <select class="small-select" name="eday" id="eday" title="Day">
                            <option value="0">--Day--</option>
                             <?php $d=1;	
                             while($d<=31){
                                 if($d<10) {$d='0'.$d;}
                            ?>
                             <option onclick="chk1();" value="<?php echo $d;?>" <?php if($ed==$d){echo "selected=selected";}?>><?php echo $d?></option>
                             <?php $d++; }?>
                         </select>
                         
                          <select class="small-select"  name="emonth" id="emonth"  title="Month">
                             <option value="0">--Month--</option>
                             <?php $m=1;	
                             while($m<=12){
                                 if($m<10) {$m='0'.$m;}
                            ?>
                             <option onclick="chk1();" value="<?php echo $m;?>" <?php if($em==$m){echo "selected=selected";}?>><?php echo date('F', mktime(0,0,0,$m));?></option>
                             <?php $m++; }?>
                         </select>          
                         
                         <select class="small-select"  name="eyear" id="eyear"  title="Year">        
                             <option value="0">--Year--</option>
                             <?php $y= date('Y');	
                             $y1= date('Y')+4;					
                             while($y<=$y1){?>
                             <option onclick="chk1();" value="<?php echo $y;?>" <?php if($ey==$y){echo "selected=selected";}?>><?php echo $y;?></option>
                             <?php $y++; }?>
                         </select>
                         <input type="hidden" id="hid" name="hid" />

                        </p>      
                     </div>
                     <div class="clear"></div>   
                      <p>             
               			<input type="submit" id="search" class="button" onclick="document.getElementById('hid').value='0'" value="Check Bookings" name="search"/>
                     </p> 
                     <p>             
                     <input type="submit" id="searchtest" class="button" onclick="document.getElementById('hid').value='1'" value="Check Availability" name="searchtest"/>
                     </p>      
                       </fieldset>           
    	
 </form>   

</div>
<!--  ---------------------------------------Search result-------------------------------------------- -->
<?php if(isset($_POST['searchtest']) && sizeof($records)>0)
	{?>  
     <h3 align="center" style="color:#FF0000;">The following conflicts are found :</h3> 
<div class="content-box" id="ctb"> 
<?php }else{?>
<div class="content-box" id="ctb"> 
<?php }?>       
   <div class="content-box-header">
    <h3>Search Result</h3>
    </div>
<?php 
/*foreach($search as $ss):
	echo $search=$ss->search;
endforeach;
if(sizeof($search)>0)
{
}*/?>
<div class="content-box-content">
<div class="tab-content"> 
<?php //echo sizeof($data['records']);
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
	   if(isset($_POST['searchtest']))
	   {
		   	echo '<h5 style="color:#009900";>No Conflicts found for the Records !</h5>';
	   }
	   else
	   {  
	   	echo "<h5>No Result Found !</h5>";
	   }
   }?>             
            </div>
            </div>
   </div>
  
   <!--  ---------------------------------------Bag Detail End-------------------------------------------- -->