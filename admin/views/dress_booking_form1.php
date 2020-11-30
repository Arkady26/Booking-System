<script type="text/javascript">
	
	function fun()
	{
		document.getElementById('ecno').value=document.getElementById('cno').value;
		document.getElementById('esname').value=document.getElementById('sname').value;
		document.getElementById('eremarks').value=document.getElementById('remarks').value;
	}
	
	function funval()
    {
    	
		if(document.getElementById('style').value=='0')
		{
			document.getElementById('eee').style.display='block';
			document.getElementById('eee').innerHTML='Please Select Dress Style';
			scroll(0,0);
			return false;
		}
		return true;
	}
	
	function setday()
	{
		document.getElementById('eday').value = document.getElementById('sday').value;
		return true;
	}
	
	function setmonth()
	{
		document.getElementById('emonth').value = document.getElementById('smonth').value;
		return true;
	}
	
	function setyear()
	{
		document.getElementById('eyear').value = document.getElementById('syear').value;
		return true;
	}
</script>
<div class="content-box">

	<div class="content-box-header">
	   <?php $q="select did from dress_status where setdefault=1";
			$rs=mysql_query($q);
			$row=mysql_fetch_array($rs);
			$status = $row['did'];?>
	  <?php if($this->uri->segment(2)=='edit'){?>
	  <h3>Edit Dress Booking</h3>
	  <? } elseif($this->uri->segment(2)=='view') { ?>
	  <h3>Dress Booking View</h3>
	  <? } else {?>
	   <h3>Add Dress Booking</h3>
	  <? } ?>
	</div>   
<div class="content-box-content">
<div class="tab-content">
 <?php 
 	  if(isset($_POST['save']))
		{		
			if($this->uri->segment(2)=='edit' || $this->uri->segment(2)=='view')
			{	
					session_start();
					$tablename = 'dress_booking';	
					$tablename1 = 'dress_booking_detail';
					$value= $this->uri->segment(3);
					$ins='0';
					$id='id';
					$this->global_model->delete_row($tablename1,'dbid',$value);
					
					$data = array(
								'customer_no' => $this->input->post('ecno'),	
								'staff_name' =>$this->input->post('esname'),	
								'remarks' => $this->input->post('eremarks')									
								);								
					$this->global_model->update_record($tablename,$data,$id,$value);
					
					
					foreach ($_SESSION['BAG_EDIT'] as $itemno => $item) 
					{ 
								
						if($_SESSION['BAG_EDIT'][$itemno]!="")
						{ 
							$data1= array(
								'dbid' => $value,	
								'sdate' => $item['sdate'],	
								'edate' => $item['edate'],	 
								'datebefore' => $item['sdate'],	
								'dateafter' => $item['edate'],
								'style' => $item['style'],	
								'type' => $item['type'],
								'status' => $item['status'],
								'7dayrule' => $item['rule']	
								);
								$this->global_model->add_record($tablename1,$data1);
						}
				} 
				unset($_SESSION['BAG_EDIT']);	 
				$this->flash_message->success('Updated Successfully');
				redirect(base_url() . 'index.php/dress_booking/dress_booking_detail');			
			}
			else
			{
				session_start();
				$tablename = 'dress_booking';	
				$tablename1 = 'dress_booking_detail';
				$ins='0';
				foreach ($_SESSION['BAG'] as $itemno => $item) 
				{ 
					if($_SESSION['BAG'][$itemno]!="")
					{ 
						if($itemno=='0')
						{
							$cno=$item['cno'];
							$data = array(
							'customer_no' => $item['cno'],	
							'staff_name' => $item['sname'],	
							'remarks' => $item['remarks']				
							);
							$ins=$this->global_model->add_record($tablename,$data); 
						}
							$data1= array(
							'dbid' => $ins,	
							'sdate' => $item['sdate'],	
							'edate' => $item['edate'],	 
							'datebefore' => $item['sdate'],	
							'dateafter' => $item['edate'],
							'style' => $item['style'],	
							'type' => $item['type'],
							'status' => $item['status'],
							'7dayrule' => $item['rule']	
							);
							$this->global_model->add_record($tablename1,$data1);	
						}
					}
				} 
				unset($_SESSION['BAG']);
				$this->flash_message->success('Record inserted successfully');			
				redirect(base_url() . 'index.php/dress_booking/dress_booking_detail');
				
		}
		else if(isset($_POST['submit1']))
		{
			
			if($this->input->post('cno')=="0" || $this->input->post('cno')=="")
					{
						$this->flash_message->error('Please select customer no');
						redirect(base_url() . 'index.php/dress_booking/addnew');	
					}
					
			
				
			unset($_SESSION['BAG_DATA']);
			unset($_SESSION['DRESS_DETAIL']);
			
			 $sdate=$this->input->post('syear')."-".$this->input->post('smonth')."-".$this->input->post('sday');
			 $edate=$this->input->post('eyear')."-".$this->input->post('emonth')."-".$this->input->post('eday'); 
			
			if(strtotime($sdate) > strtotime($edate))
			{ 
				$this->flash_message->error('Please Enter End Date after Start Date !');
				if($this->uri->segment(2) == 'addnew')
				{
					redirect(base_url() . 'index.php/dress_booking/addnew/');	
				}
				else
				{
					redirect(base_url() . 'index.php/dress_booking/edit/'.$this->uri->segment(3));	
				}
			}
			if($this->input->post('rule')=='')
			{
				$rule=0;
				$bdate=$sdate;
				$adate=$edate;
			}
			else
			{
				$rule=1;		
				$bdate = date("Y-m-d",strtotime('-7 day' ,strtotime($sdate))) ;
				$adate = date("Y-m-d",strtotime(date("Y-m-d",strtotime($edate)) . " +7 day"));				
			} 
			session_start();
			$data = array(
				'cno' => $this->input->post('cno'),
				'sname'=> $this->input->post('sname'),
				'remarks' => $this->input->post('remarks')
				);
			$_SESSION['BAG_DATA'][] =  $data;	
			$data = array(
				'cno' => $this->input->post('cno'),
				'sname'=> $this->input->post('sname'),
				'remarks' => $this->input->post('remarks'),				
				'type' => $this->input->post('type'),
				'style'=> $this->input->post('style'),
				'status'=> $this->input->post('status'),
				'sdate' => $sdate,
				'edate'=> $edate,
				'rule' => $rule,
				'bdate'=> $bdate,
				'adate' => $adate,
				'BAG'=>'true'
			);  
			$this->session->set_userdata($data);
			if($this->uri->segment(2)=='edit' || $this->uri->segment(2)=='view')
			{	
				
				$this->load->model('global_model');
				$tablename = 'dress_booking_detail';			
				$criteria=" type='".$this->input->post('type')."' and dbid!='".$this->uri->segment(3)."' and style='".$this->input->post('style')."' and ((datebefore between '".$bdate."' and '".$adate."') or (dateafter between '".$bdate."' and '".$adate."') or ('".$bdate."' between datebefore and dateafter) or ('".$adate."' between datebefore and dateafter))";
				$query = $this->global_model->checkunique1($tablename,$criteria);
			
				if($query) // if the city already exists
				{
					$data2 = array(
						'cno' => $this->input->post('cno'),
						'sname'=> $this->input->post('sname'),
						'remarks' => $this->input->post('remarks'),				
						'type' => $this->input->post('type'),
						'style'=> $this->input->post('style'),
						'status'=> $this->input->post('status'),
						'sdate' => $sdate,
						'edate'=> $edate,
						'rule' => $rule,
						'bdate'=> $bdate,
						'adate' => $adate,
						'DRESS_DETAIL'=>'true'
					);							
					$_SESSION['DRESS_DETAIL'][] =  $data2;	
					if($this->input->post('rule')=='')
					{
					$this->flash_message->warning('Date Conflict Error');				
					}
					else
					{
					$this->flash_message->warning('7-Day Rule Conflict Error');					
					}
					redirect(base_url() . 'index.php/dress_booking/edit/'.$this->uri->segment(3));					
				}
				else
				{
					
					$_SESSION['BAG_EDIT'][] =  $data;
					$this->flash_message->success('Dress Added to Bag Succesfully');
					redirect(base_url() . 'index.php/dress_booking/edit/'.$this->uri->segment(3));	
				}				
										
			}
			else
			{
				$this->load->model('global_model');
				$tablename = 'dress_booking_detail';			
				$criteria=" type='".$this->input->post('type')."' and style='".$this->input->post('style')."' and ((datebefore between '".$bdate."' and '".$adate."') or (dateafter between '".$bdate."' and '".$adate."') or ('".$bdate."' between datebefore and dateafter) or ('".$adate."' between datebefore and dateafter))";
				$query = $this->global_model->checkunique1($tablename,$criteria);
			
				if($query) 	//if the city already exists
				{
					$data2 = array(
						'cno' => $this->input->post('cno'),
						'sname'=> $this->input->post('sname'),
						'remarks' => $this->input->post('remarks'),				
						'type' => $this->input->post('type'),
						'style'=> $this->input->post('style'),
						'status'=> $this->input->post('status'),
						'sdate' => $sdate,
						'edate'=> $edate,
						'rule' => $rule,
						'bdate'=> $bdate,
						'adate' => $adate,
						'DRESS_DETAIL'=>'true'
					);							
					$_SESSION['DRESS_DETAIL'][] =  $data2;	
					if($this->input->post('rule')=='')
					{
					$this->flash_message->warning('Date Conflict Error');				
					}
					else
					{
					$this->flash_message->warning('7-Day Rule Conflict Error');					
					}			
					redirect(base_url() . 'index.php/dress_booking/addnew');					
				}
				else
				{
					$_SESSION['BAG'][] =  $data;
					$this->flash_message->success('Dress Added to Bag Succesfully');
					redirect(base_url() . 'index.php/dress_booking/addnew');
				}
			}
		
		
	
		}
		
		//end
				
		if($this->uri->segment(2)=='edit' || $this->uri->segment(2)=='view')
		{ 
			if($_SESSION['DRESS_DETAIL']!='')
			{	
				$style =$_SESSION['DRESS_DETAIL'][0]['style'];		
				$rule =$_SESSION['DRESS_DETAIL'][0]['rule'];		
				$status = $_SESSION['DRESS_DETAIL'][0]['status'];
				$type = $_SESSION['DRESS_DETAIL'][0]['type'];
				$sdate = $_SESSION['DRESS_DETAIL']['0']['sdate'];
				$edate = $_SESSION['DRESS_DETAIL']['0']['edate'];
			}
			 if($sdate!='')
			 {
				 $sy=date('Y',strtotime($sdate));	
				 $sm=date('m',strtotime($sdate));
				 $sd=date('d',strtotime($sdate));	
			 }
			  if($edate!='')
			 {
				 $ey=date('Y',strtotime($edate));	
				 $em=date('m',strtotime($edate));
				 $ed=date('d',strtotime($edate));	
			 }
			if($_SESSION['BAG_DATA']!='')
			{	
				$cno =$_SESSION['BAG_DATA'][0]['cno'];			
				$sname = $_SESSION['BAG_DATA'][0]['sname'];
				$remarks = $_SESSION['BAG_DATA'][0]['remarks']; 
			}
			else
			{
				$cno = $formrecord[0]->customer_no ;
				$sname = $formrecord[0]->staff_name;
				$remarks = $formrecord[0]->remarks;
				$cname = $formrecord[0]->cname;	
			}
	
		}
		else
		{
	
			if($_SESSION['DRESS_DETAIL']!='')
			{	
				$style =$_SESSION['DRESS_DETAIL'][0]['style'];	
				$rule =$_SESSION['DRESS_DETAIL'][0]['rule'];		
				$status = $_SESSION['DRESS_DETAIL'][0]['status'];
				$type = $_SESSION['DRESS_DETAIL'][0]['type'];
				$sdate = $_SESSION['DRESS_DETAIL']['0']['sdate'];
				$edate = $_SESSION['DRESS_DETAIL']['0']['edate'];
			}
			
			   if($sdate!='')
			 {
				 $sy=date('Y',strtotime($sdate));	
				 $sm=date('m',strtotime($sdate));
				 $sd=date('d',strtotime($sdate));	
			 }
			  if($edate!='')
			 {
				 $ey=date('Y',strtotime($edate));	
				 $em=date('m',strtotime($edate));
				 $ed=date('d',strtotime($edate));	
			 }
			if($_SESSION['BAG_DATA']!='')
			{	
				$cno =$_SESSION['BAG_DATA'][0]['cno'];			
				$sname = $_SESSION['BAG_DATA'][0]['sname'];
				$remarks = $_SESSION['BAG_DATA'][0]['remarks']; 
			}
			else
			{
				$cno = set_value('cno');
				$sname = set_value('sname');
				$remarks = set_value('remarks');
				$cname =set_value('cpname');	
			}			
		}
		 if($sdate=='')
		 {
			$sdate = date('Y-m-d');
			 $sy=date('Y',strtotime($sdate));	
			 $sm=date('m',strtotime($sdate));
			 $sd=date('d',strtotime($sdate));	
		 }
		  if($edate=='')
		 {
			$edate = date('Y-m-d');
			 $ey=date('Y',strtotime($edate));	
			 $em=date('m',strtotime($edate));
			 $ed=date('d',strtotime($edate));	
		 } 		

	?>
     <div id="eee" class="flash_message message_error"  style="display:none;" ></div> 
   <?php echo validation_errors('<p class="error">');?>
	<form name="form" id="form" method="post" action="" onsubmit="javascript:if(!cvalidate('form','eee')){return false} else {if(!funval()) return false};">

    		<fieldset id="personal">
            <div class="align-left" style="width:300px;">
            			 <p>
                        <?php $qc="select * from customer order by cno";
						$rsc=mysql_query($qc);			
						?>
                        <label>Customer:<span style="color:#C00">*</span></label>    
                        <?php if($this->uri->segment(2)=='view') {?>
                        <?php while($rowc=mysql_fetch_array($rsc)){
						 if($cno==$rowc['cno']){?>  
                        <label><?php echo $rowc['cno']." - [ ".$rowc['cname']." ]"; ?></label>
                        <?php }}}else{?>
                        <select id="cno" size="8" class="text-input val_req_combo" title="Customer No" name="cno"> 
                        <option value="0">--Selected Customer No--</option>                        
                        <?php while($rowc=mysql_fetch_array($rsc)){?>    
                        <option value="<?php echo $rowc['cno'];?>" <?php if($cno==$rowc['cno']){echo "selected=selected";}?>><?php echo $rowc['cno']." - [ ".$rowc['cname']." ]";?></option>
                      <?php }?>
                       </select> 
                          <? }?>
                        </p>
              </div>
              <div class="align-left">            
                        <p>
                        <?php if($this->uri->segment(2)== "view"){?>
                         <label>Staff Name:<span style="color:#C00">*</span></h4><input type="hidden" id="sname" name="sname" value="<?php echo $this->session->userdata('username'); ?>"/></label>
                        <label><?php if($sname==''){echo $this->session->userdata('username'); }else{echo $sname;} ?></label> 
                        
                      <?php }else  if($this->session->userdata('security_level')!=3)
						{?>
                        <label>Staff Name:<span style="color:#C00">*</span></h4><input type="hidden" id="sname" name="sname" value="<?php echo $this->session->userdata('username'); ?>"/></label>      
                       <label><?php if($sname==''){echo $this->session->userdata('username'); }else{echo $sname;} ?></label> 
                       <?php }else{?>
                        <label>Staff Name:<span style="color:#C00">*</span></h4></label>
                        <input type="text" id="sname"  class="text-input val_req" name="sname" value="<?php if($sname==''){echo $this->session->userdata('username'); }else{echo $sname;} ?>"/>
                       <?php }?> 
                        </p>  
                          <p>
                        <label>Remarks:</h4></label>  
                        <?php if($this->uri->segment(2)=='view') {?>
                        <label><?php echo $remarks; ?></label>
                        <?php }else{?>
                        <textarea name="remarks" cols="5" rows="2" id="remarks" class="text-input" title="Remarks"><?php echo $remarks; ?></textarea>
                        <? }?>
                        </p>
                        </div>
                        <div class="clear"></div> 
                        
                        <?php if($this->uri->segment(2) != 'view'){?>                         
                 <div class="content-box">
                  <div class="content-box-header">
                    <h3>Dress Detail1</h3>
                    </div>
                    <div class="content-box-content">
                    <div>
                    <div class="align-left" style="width:250px;">    
                        <p>
                        <?php $q="select * from dress_type order by type";
						$rs=mysql_query($q); ?>
                        <label>Dress Type:<span style="color:#C00">*</span></label> 
                             
                        <select id="type" class="text-input val_req_combo" title="Dress Type" name="type" onchange="if(this.options[this.selectedIndex].onclick && document.all) {this.options[this.selectedIndex].onclick();}else{this.options[this.selectedIndex].onclick();}">
                        <option onclick="document.getElementById('style111').style.display='block';" value="0">--Select Dress Type--</option>
                        <?php while($row=mysql_fetch_array($rs)){?>    
                        <option onclick="document.getElementById('style111').style.display='block';" value="<?php echo $row['did'];?>" <?php if($type==$row['did']){echo "selected=selected";}?>><?php echo $row['type'];?></option>
                      <?php }?>
                      </select>
                        </p>
                        
                   
                        <label>Dress Style:<span style="color:#C00">*</span></label>
                        <select id="style" size="7" class="text-input val_req_combo" title="Dress Style" name="style">
                        <option value="0" selected="selected">--Select Dress Style--</option>   
                        
                      </select>
                        </p>
                        </div>
                        <div class="align-left"> 
                         <p>
                          <?php $q="select * from dress_status order by did";
						$rs=mysql_query($q);			
						?>
                        <label>Dress Status:<span style="color:#C00">*</span></label>      
                        
                   	    <select id="type" class="text-input val_req_combo" title="Dress Status" name="status">
                         <option value="0">--Select Dress Status--</option>
                        <?php while($row=mysql_fetch_array($rs)){?>
                        <option value="<?php echo $row['did'];?>" <?php if($status==$row['did']){echo "selected=selected";}?>><?php echo $row['status'];?></option>
                      <?php }?>
                      </select>
                        </p>
                        
                      <p>
                        <label>Start Date:<span style="color:#C00">*</span></label>
                          <select name="sday" id="sday" class="small-select val_req_combo" title="Day" onchange="return setday();">
                        <option value="0">--Day--</option>
                         <?php $d=1;	
						 while($d<=31){
							 if($d<10) {$d='0'.$d;}
							 
						?>
                         <option value="<?php echo $d;?>" <?php if($sd==$d){echo "selected=selected";}?>><?php echo $d?></option>
                         <?php $d++; }?>
                        </select>
                        
                          <select name="smonth" id="smonth" class="small-select val_req_combo" title="Month" onchange="return setmonth();">
                         <option value="0">--Month--</option>
                         <?php $m=1;	
						 while($m<=12){
							 if($m<10) {$m='0'.$m;}
						?>
                         <option value="<?php echo $m;?>" <?php if($sm==$m){echo "selected=selected";}?>><?php echo date('F', mktime(0,0,0,$m));?></option>
                         <?php $m++; }?>
                         </select>  
                                                 
                      <select name="syear" id="syear" class="small-select val_req_combo" title="Year" onchange="return setyear();">     
                   <option value="0">--Year--</option>
                         <?php $y= date('Y');	
						 $y1= date('Y')+4;					
						 while($y<=$y1){?>
                         <option value="<?php echo $y;?>" <?php if($sy==$y){echo "selected=selected";}?>><?php echo $y;?></option>
                         <?php $y++; }?>
                         </select>             
                        
                        <input name="rule" id="rule" type="checkbox" value="1"  <?php if($rule==1){echo "checked=checked";}?> checked="checked"/>Apply 7 Day Rule
                    </p>
                        
                      <p>
                        <label>End Date:<span style="color:#C00">*</span></label>  
                        <select name="eday" id="eday" class="small-select val_req_combo" title="Day">
                        <option value="0">--Day--</option>
                         <?php $d=1;	
						 while($d<=31){
							 if($d<10) {$d='0'.$d;}
						?>
                         <option value="<?php echo $d;?>" <?php if($ed==$d){echo "selected=selected";}?>><?php echo $d?></option>
                         <?php $d++; }?>
                         </select>
                         
                         
                          <select name="emonth" id="emonth" class="small-select val_req_combo" title="Month">
                         <option value="0">--Month--</option>
                         <?php $m=1;	
						 while($m<=12){
							 if($m<10) {$m='0'.$m;}
						?>
                         <option value="<?php echo $m;?>" <?php if($em==$m){echo "selected=selected";}?>><?php echo date('F', mktime(0,0,0,$m));?></option>
                         <?php $m++; }?>
                         </select>        
                         
                         <select name="eyear" id="eyear" class="small-select val_req_combo" title="Year">        
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
                       </div>
                       </div>
                      </div>                        
                        <?php } ?>                     
                        
                      <p>  
                      <?php if($this->uri->segment(2) != 'view'){?>         
               			<input type="submit" id="submit1" class="button" value="Add To Bag" name="submit1"/>
                      <? }?>
                       </fieldset>           
    	
 </form>   

</div>
<!--  ---------------------------------------Bag Detail start-------------------------------------------- -->
<div class="content-box">        
   <div class="content-box-header">
    <h3>Dress Booking List</h3>
    </div>
<div class="content-box-content">
<div class="tab-content"> 

<?php 
session_start();
if($this->uri->segment(2)!='edit' && $this->uri->segment(2)!='view')
{
	if(sizeof($_SESSION['BAG'])!="")
	{?>
<table width="100%">
 <thead> 
           <tr>
				<?php foreach($fields as $field_name => $field_display): ?>
                 <th <?php if ($sort_by == $field_name) echo "class=\"sort_$sort_order\"" ?>>
					<?php if(isset($_GET['find'])) 
					{
		     			echo anchor(base_url() . "index.php/dress_booking/dress_booking_detail/$field_name/" .
                        (($sort_order == 'asc' && $sort_by == $field_name) ? 'desc' : 'asc').'?find=' . $_GET['find'] ,
                        $field_display); 
                    }
                    else 
                    {
						echo anchor(base_url() . "index.php/dress_booking/dress_booking_detail/$field_name/" .
                        (($sort_order == 'asc' && $sort_by == $field_name) ? 'desc' : 'asc').'' ,
                        $field_display); 
                      
                    } ?>
                      
                </th>
                <?php endforeach; ?>   
                <th>Type</th>
                <th>Style</th>
                <th>Status</th>
                <th>Start Date</th>
                <th>End Date</th>              
                <th width="25">
                Delete	
                </th>                

	      </tr>
</thead>
<?php foreach ($_SESSION['BAG'] as $itemno => $item) 
{ 
	if($_SESSION['BAG'][$itemno]!="")
	{ ?> 
  <tfoot>
        <tr>
        <td colspan="5">
        <?php if (strlen($pagination)): ?>
	<div class="pagination">
		<?php echo $pagination; ?>
	</div>
	<?php endif; ?>
        </td>
        </tr>
  </tfoot>
   <tbody>  <?php $q1="select * from dress_type where did='".$item['type']."'";
					$rs1=mysql_query($q1);	
					$r1=mysql_fetch_array($rs1);
					$q2="select * from dress_style where did='".$item['style']."'";
					$rs2=mysql_query($q2);	
					$r2=mysql_fetch_array($rs2);	
					$q3="select * from dress_status where did='".$item['status']."'";
					$rs3=mysql_query($q3);	
					$r3=mysql_fetch_array($rs3);				
				?>      
            
            <tr> 
                <td><?php echo $r1['type']; ?></td>
                <td><?php echo $r2['styleno']; ?></td>
                <td><?php echo $r3['status']; ?></td>
                <td><?php echo date('d F Y',strtotime($item['sdate'])); ?></td>
                <td><?php echo date('d F Y',strtotime($item['edate'])); ?></td>
                <?php if($this->uri->segment(2)=='edit'){?>
                           
                 <td style="max-width:20px"><a href="<?php echo base_url().'index.php/dress_booking/delete_bag/?edit=true&did='.$this->uri->segment(3).'&ino='.$itemno;?>"><div class="delete_icon"></div></a></td>
                 	  
               <?php }else{ ?>
                <td style="max-width:20px"><a href="<?php echo base_url() . 'index.php/dress_booking/delete_bag/?ino='.$itemno.'&did='.$this->uri->segment(3);?>"><div class="delete_icon"></div></a>
				</td>
                
        	<?php }	?>
             </tr>
            <?php }?>
          
        </tbody>       
		<?php }	?>
             </table>             
               <p> 
                            
                 <form name="form1" id="form1" method="post" action="" onsubmit="javascript:if(!cvalidate('form1','eee')){return false};">
                 <?php if($this->uri->segment(2) != 'view'){?>  
                           <input type="submit" id="save" class="button" value="Save" name="save"/>
                           <? }?>
                            </form> 
                            
               </p>         
        <?php }}
else {if(sizeof($_SESSION['BAG_EDIT'])!=""){?>
<table width="100%">
 <thead> 
           <tr>
				<?php foreach($fields as $field_name => $field_display): ?>
                 <th <?php if ($sort_by == $field_name) echo "class=\"sort_$sort_order\"" ?>>
					<?php if(isset($_GET['find'])) 
					{
		     			echo anchor(base_url() . "index.php/dress_booking/dress_booking_detail/$field_name/" .
                        (($sort_order == 'asc' && $sort_by == $field_name) ? 'desc' : 'asc').'?find=' . $_GET['find'] ,
                        $field_display); 
                    }
                    else 
                    {
						echo anchor(base_url() . "index.php/dress_booking/dress_booking_detail/$field_name/" .
                        (($sort_order == 'asc' && $sort_by == $field_name) ? 'desc' : 'asc').'' ,
                        $field_display); 
                      
                    } ?>
                      
                </th>
                <?php endforeach; ?>  
                <th>Type</th>
                <th>Style</th>
                <th>Status</th>
                <th>Start Date</th>
                <th>End Date</th>              
                <?php if($this->uri->segment(2) != 'view'){?> 
                <th width="25">
                Delete	
                </th>                
                <?php } ?>

	      </tr>
</thead>
<?php foreach ($_SESSION['BAG_EDIT'] as $itemno => $item) 
{ 
	if($_SESSION['BAG_EDIT'][$itemno]!="")
	{ ?> 
  <tfoot>
        <tr>
        <td colspan="5">
        <?php if (strlen($pagination)): ?>
	<div class="pagination">
		<?php echo $pagination; ?>
	</div>
	<?php endif; ?>
        </td>
        </tr>
  </tfoot>
   <tbody>  <?php $q1="select * from dress_type where did='".$item['type']."'";
					$rs1=mysql_query($q1);	
					$r1=mysql_fetch_array($rs1);
					$q2="select * from dress_style where did='".$item['style']."'";
					$rs2=mysql_query($q2);	
					$r2=mysql_fetch_array($rs2);	
					$q3="select * from dress_status where did='".$item['status']."'";
					$rs3=mysql_query($q3);	
					$r3=mysql_fetch_array($rs3);				
				?>      
            
            <tr> 
                <td><?php echo $r1['type']; ?></td>
                <td><?php echo $r2['styleno']; ?></td>
                <td><?php echo $r3['status']; ?></td>
                <td><?php echo date('d F Y',strtotime($item['sdate'])); ?></td>
                <td><?php echo date('d F Y',strtotime($item['edate'])); ?></td>
                
                <?php if($this->uri->segment(2) != 'view'){?>  
                
                <?php if($this->uri->segment(2)=='edit'){?>
                    <td style="max-width:20px"><a href="<?php echo base_url().'index.php/dress_booking/delete_bag/?edit=true&did='.$this->uri->segment(3).'&ino='.$itemno;?>"><div class="delete_icon"></div></a></td>
                 	  
               <?php }else{ ?>
                <td style="max-width:20px"><a href="<?php echo base_url() . 'index.php/dress_booking/delete_bag/?ino='.$itemno.'&did='.$this->uri->segment(3);?>"><div class="delete_icon"></div></a>
				</td>
        	<?php } }	?>
            
             </tr>
            <?php }?>
          
        </tbody>       
		<?php }	?>
             </table>             
               <p>             
                <form name="form1" id="form1" method="post" action="" onsubmit="javascript:if(!cvalidate('form1','eee')){return false};">
                      <input name="ecno" id="ecno" type="hidden" value=""/>
                       <input name="esname" id="esname" type="hidden" value=""/>
                       <input name="eremarks" id="eremarks" type="hidden" value=""/>
                       <?php if($this->uri->segment(2) != 'view'){?>  
                       <input type="submit" id="save" class="button" value="Save" name="save" onclick="fun();"/>
                       <? }?>
                 </form> 
             </p>         
        <?php }}?>
            </div>
            </div>
   </div>
   <!--  ---------------------------------------Bag Detail End-------------------------------------------- -->