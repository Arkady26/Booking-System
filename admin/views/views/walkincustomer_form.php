<?php 
session_start();  ?>
<script type="text/javascript">
function fun1()
{
	//alert(document.getElementById('wname').value);
	//alert(document.getElementById('ewname').value);
	document.getElementById('etno').value=document.getElementById('tno').value;
	document.getElementById('ewname').value=document.getElementById('wname').value;
	document.getElementById('eyear').value=document.getElementById('year').value;
	document.getElementById('eday').value=document.getElementById('day').value;	
	document.getElementById('emonth').value=document.getElementById('month').value;
	document.getElementById('eyear1').value=document.getElementById('year1').value;
	document.getElementById('eday1').value=document.getElementById('day1').value;	
	document.getElementById('emonth1').value=document.getElementById('month1').value;
	document.getElementById('eremarks').value=document.getElementById('remarks').value;
	document.getElementById('estaffname').value=document.getElementById('staffname').value;
	document.getElementById('ecpname').value=document.getElementById('cpname').value;
	document.getElementById('ecptelephone').value=document.getElementById('cptelephone').value;
}
</script>
<div class="content-box">
  <div class="content-box-header">
  <?php if($this->uri->segment(2)=='edit'){?>
  <h3>Edit Walk-in Customer</h3>
  <? } else if($this->uri->segment(2)=='view') { ?>
  <h3>Walk-in Customer View</h3>
  <? }else{?>
  <h3>Add Walk-In Customer</h3>
  <? }?>
    </div>   
<div class="content-box-content">
<div class="tab-content">

   <?php 
   
 	  if(isset($_POST['save']))
		{		
			if($this->uri->segment(2)=='edit' || $this->uri->segment(2)=='view')
			{	
					$tablename = 'walkincustomer';	
					$tablename1 = 'walkincustomer_detail';
					$value= $this->uri->segment(3);
					$ins='0';
					$id='wcid';
					$this->global_model->delete_row($tablename1,'wcid',$value);
					
					$wdate=$this->input->post('eyear')."-".$this->input->post('emonth')."-".$this->input->post('eday');
					$weddingdate=$this->input->post('eyear1')."-".$this->input->post('emonth1')."-".$this->input->post('eday1');
					$data = array(
								'wname' => $this->input->post('ewname'),	
								'wtelephone' =>$this->input->post('etno'),	
								'wremarks' => $this->input->post('eremarks'),
								'staffname' => $this->session->userdata('username'),
								'wdate' => $wdate,
								'weddingdate' => $weddingdate,	
								'cpname' => $this->input->post('ecpname'),
								'cptelephone' => $this->input->post('ecptelephone')										
								);	
															
					$this->global_model->update_record($tablename,$data,$id,$value);
					
					
					foreach ($_SESSION['BAG_EDIT'] as $itemno => $item) 
					{ 
								
						if($_SESSION['BAG_EDIT'][$itemno]!="")
						{ 
							$data1= array(
								'wcid' => $value,	
								'wdstyle' => $item['wstyle'],	
								'wdtype' => $item['wtype'],																
								);
								$this->global_model->add_record($tablename1,$data1);
						}
				}
				$this->flash_message->success('Updated Successfully');
				redirect(base_url() . 'index.php/walkincustomer/walkincustomer_detail');			
			}
			else
			{
				$tablename = 'walkincustomer';	
				$tablename1 = 'walkincustomer_detail';
				$ins='0';
				
			//echo "fgfgfg".sizeof($_SESSION['BAG']);
			if(sizeof($_SESSION['BAG'])<=0)
			{	
					    $criteria=" wtelephone='". $this->input->post('etno') ."' ";
						$query = $this->global_model->checkunique($tablename,$criteria);
						if($query) // if the city already exists
						{
							$this->flash_message->warning('Telephone No already exists');	
							//redirect(base_url() . 'index.php/walkincustomer/walkincustomer_detail');			
						}
						else
						{						
								$wdate=$this->input->post('eyear')."-".$this->input->post('emonth')."-".$this->input->post('eday');
								$weddingdate=$this->input->post('eyear1')."-".$this->input->post('emonth1')."-".$this->input->post('eday1');
								$data_n = array(
								'wname' => $this->input->post('ewname'),	
								'wtelephone' =>$this->input->post('etno'),	
								'wremarks' => $this->input->post('eremarks'),
								'staffname' => $this->session->userdata('username'),
								'wdate' => $wdate,
								'weddingdate' => $weddingdate,
								'cpname' => $this->input->post('ecpname'),
								'cptelephone' => $this->input->post('ecptelephone')										
								);	
								//echo print_r($data_n);
								$ins=$this->global_model->add_record($tablename,$data_n);							
						}
			}	 
				foreach ($_SESSION['BAG'] as $itemno => $item) 
				{ 
					if($_SESSION['BAG'][$itemno]!="")
					{ 
						/*$criteria=" wtelephone='". $item['wtelephone'] ."' ";
						$query = $this->global_model->checkunique($tablename,$criteria);
						if($query) // if the city already exists
						{
							//$this->flash_message->warning('Telephone No already exists');	
							//redirect(base_url() . 'index.php/walkincustomer/walkincustomer_detail');			
						}
						else
						{*/						
							if($itemno=='0')
							{
								$wcid=$item['wcid'];
								$data = array(								
								'wname' => $item['wname'],	
								'wtelephone' =>$item['wtelephone'],	
								'wdate' =>$item['wdate'],
								'wremarks' => $item['wremarks'],
								'staffname' =>$item['staffname'],
								'weddingdate' => $item['weddingdate'],
								'cpname' =>$item['cpname'],
								'cptelephone' => $item['cptelephone']											
								);
								$ins=$this->global_model->add_record($tablename,$data);
								//$ins=$this->db->insert_id();
							}
							if($item['wtype']!='0')	
							{
								$data1= array(
								'wcid' => $ins,								
								'wdstyle' => $item['wstyle'],
								'wdtype' => $item['wtype']						
								);
								$this->global_model->add_record($tablename1,$data1);
							}
							//}
						}
					}
				}
					//echo print_r($data1);	
					unset($_SESSION['BAG']);
					$this->flash_message->success('Record inserted successfully');			
					redirect(base_url() . 'index.php/walkincustomer/walkincustomer_detail');
				
		}
		else if(isset($_POST['submit1']))
		{	
			unset($_SESSION['BAG_DATA']);
			$wdate=$this->input->post('year')."-".$this->input->post('month')."-".$this->input->post('day');		
			$weddingdate=$this->input->post('year1')."-".$this->input->post('month1')."-".$this->input->post('day1');	
			if($this->session->userdata('security_level')==3)
			{
				if($this->uri->segment(2)=='edit')
				{
					$staffname = $this->input->post('staffname');
				}
				else {
					$staffname = $this->session->userdata('username');
				}
			}
			else 
			{
				$staffname = $this->session->userdata('username');
			}
			$data1 = array(
						'wname' => $this->input->post('wname'),	
						'wtelephone' =>$this->input->post('tno'),	
						'wdate' => $wdate,
						'weddingdate' => $weddingdate,
						'staffname' => $staffname,
						'wremarks' => $this->input->post('remarks'),
						'cpname' => $this->input->post('cpname')	,
						'cptelephone' => $this->input->post('cptelephone')										
						);	
			$_SESSION['BAG_DATA'][] =  $data1;	
			
			$data = array(
				'wcid' => $this->uri->segment(3),	
				'wname' => $this->input->post('wname'),	
				'wtelephone' =>$this->input->post('tno'),
				'staffname' => $this->session->userdata('username'),	
				'wyear' =>$this->input->post('year'),
				'wmonth' =>$this->input->post('month'),
				'wday' =>$this->input->post('day'),
				'wdate' => $wdate,	
				'weddingdate' => $weddingdate,			
				'wtype' => $this->input->post('type'),
				'wstyle'=> $this->input->post('style'),	
				'wremarks' =>$this->input->post('remarks'),	
				'cpname' => $this->input->post('cpname')	,
				'cptelephone' => $this->input->post('cptelephone'),			
				'BAG'=>'true'
			);
						
			//$_SESSION['BAG'][] =  $data;
			$this->session->set_userdata($data);
			if($this->uri->segment(2)=='edit' || $this->uri->segment(2)=='view')
			{	
				$_SESSION['BAG_EDIT'][] =  $data;
				$this->flash_message->success('Dress Added to Bag Succesfully');
				redirect(base_url() . 'index.php/walkincustomer/edit/'.$this->uri->segment(3));							
			}
			else
			{
				$_SESSION['BAG'][] =  $data;	
				$this->flash_message->success('Dress Added to Bag Succesfully');
				redirect(base_url() . 'index.php/walkincustomer/addnew');
			}	
		}		
		if($this->uri->segment(2)=='edit' || $this->uri->segment(2)=='view')
		{
		//echo print_r($_SESSION['BAG_DATA']);
			if($_SESSION['BAG_DATA']!='')
			{	
				$wtelephone =$_SESSION['BAG_DATA'][0]['wtelephone'];			
				$wname = $_SESSION['BAG_DATA'][0]['wname'];
				$wdate= $_SESSION['BAG_DATA'][0]['wdate'];
				$weddingdate= $_SESSION['BAG_DATA'][0]['weddingdate'];
				$staffname=$_SESSION['BAG_DATA'][0]['staffname'];
				$wremarks = $_SESSION['BAG_DATA']['0']['wremarks'];
				$cpname = $_SESSION['BAG_DATA']['0']['cpname'];
				$cptelephone = $_SESSION['BAG_DATA']['0']['cptelephone'];
			}
			else
			{
				$wname = $formrecord[0]->wname;
				$wtelephone = $formrecord[0]->wtelephone;
				$wdate = $formrecord[0]->wdate;
				$weddingdate = $formrecord[0]->weddingdate;
				$staffname = $formrecord[0]->staffname;
				$wstyle = $formrecord1[0]->wdstyle;
				$wtype = $formrecord1[0]->wtype;	
				$wremarks = $formrecord[0]->wremarks;	
				$cpname = $formrecord[0]->cpname;	
				$cptelephone = $formrecord[0]->cptelephone;				
			}				
		
				 if($wdate!='0000-00-00')
				 {
					 $wy=date('Y',strtotime($wdate));	
					 $wm=date('m',strtotime($wdate));
					 $wd=date('d',strtotime($wdate));	
				 }
				 if($weddingdate!='0000-00-00')
				 {
				 	 $wy1=date('Y',strtotime($weddingdate));	
					 $wm1=date('m',strtotime($weddingdate));
					 $wd1=date('d',strtotime($weddingdate));	
				 } 
		}
		else
		{
			
			//	echo "fgfg".print_r($_SESSION['BAG']);
			if($_SESSION['BAG_DATA']!='')
			{	
				$wtelephone =$_SESSION['BAG_DATA'][0]['wtelephone'];			
				$wname = $_SESSION['BAG_DATA'][0]['wname'];
				$wdate= $_SESSION['BAG_DATA'][0]['wdate'];
				$weddingdate= $_SESSION['BAG_DATA'][0]['weddingdate'];
				$staffname=$_SESSION['BAG_DATA'][0]['staffname'];
				$wremarks = $_SESSION['BAG_DATA']['0']['wremarks'];
				$cpname = $_SESSION['BAG_DATA']['0']['cpname'];
				$cptelephone = $_SESSION['BAG_DATA']['0']['cptelephone'];
			}
			else
			{
				$wname = set_value('wname');
				$wtelephone=set_value('wtelephone');
				$wstyle=set_value('style');
				$wtype=set_value('type');	
				$wdate=set_value('wdate');
				$weddingdate=set_value('weddingdate');
				$staffname=set_value('staffname');	
				$wremarks =set_value('remarks');			
				$cpname=set_value('cpname');	
				$cptelephone =set_value('cptelephone');		
			}
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
			 if($weddingdate!='0000-00-00')
			 {
				 $wy1=date('Y',strtotime($weddingdate));	
				 $wm1=date('m',strtotime($weddingdate));
				 $wd1=date('d',strtotime($weddingdate));	
			 }
			if($weddingdate=='')
			 {
				$weddingdate = date('Y-m-d');
				 $wy1=date('Y',strtotime($weddingdate));	
				 $wm1=date('m',strtotime($weddingdate));
				 $wd1=date('d',strtotime($weddingdate));	
			 }	
		} 		
	?>
     <div id="eee" class="flash_message message_error"  style="display:none;" ></div> 
   <?php echo validation_errors('<p class="error">');?>
	<form name="form" id="form" method="post" action="" onsubmit="javascript:if(!cvalidate('form','eee')){return false};">

    		<fieldset id="personal">
            			<div class="align-left" style="width:350px;">
                        <p>
                        <label>Walk-In Name:<span style="color:#C00">*</span></h4></label>
                        <?php if($this->uri->segment(2)=='view') {?>
                        <label><?php echo $wname; ?></label>
                        <?php }else{?>      
                        <input type="text" id="wname"  class="text-input val_req" title="Username" name="wname" value="<?php echo $wname; ?>"/>
                        <? }?>
                        </p>
                         <p>
                        <label>Telephone No:<span style="color:#C00">*</span></label>    
                        <?php if($this->uri->segment(2)=='view') {?>
                        <label><?php echo $wtelephone; ?></label>
                        <?php }else{?>   
                        <input type="text" id="tno" name="tno" class="text-input" value="<?php echo $wtelephone; ?>"/>			
                         <? }?>
                        </p>
                        <p>
                        <?php  if($this->session->userdata('security_level')!=3)
						{
							?>
                        <label>Staff Name:<span style="color:#C00">*</span></h4><input type="hidden" id="staffname" name="staffname" value="<?php echo $this->session->userdata('username'); ?>"/></label>      
                       <label><?php if($staffname==''){ echo $this->session->userdata('username'); }else{echo $staffname;} ?></label> 
                       <?php }else{?>
                       	
                        <label>Staff Name:<span style="color:#C00">*</span></h4></label>
                        <?php if($this->uri->segment(2)=='view') {?>
                        <label><?php if($staffname==''){ echo $this->session->userdata('username'); }else{echo $staffname;} ?></label>
                        <?php }else{?>  
                        <input type="text" id="staffname"  class="text-input val_req" name="staffname" value="<?php if($staffname==''){ echo $this->session->userdata('username'); }else{ echo $staffname;} ?>"/>
                        <? } 
                        }
                        ?> 
                        </p>  
                        <p>
                        <div style="height:22px"></div>
                        </p>
                            <p>
                        <label>Walk-In Date:<span style="color:#C00">*</span></label> 
                        <?php if($this->uri->segment(2)=='view') {?>
                        <label><?php echo date('d F Y',strtotime($wdate)); ?></label>
                        <?php }else{?>     
                          <select class="small-select" name="day" id="day">
                        <option value="00">--Day--</option>
                         <?php $d=1;	
						 while($d<=31){
							 if($d<10) {$d='0'.$d;}
						?>
                         <option value="<?php echo $d;?>" <?php if($wd==$d){echo "selected=selected";}?>><?php echo $d?></option>
                         <?php $d++; }?>
                         </select>
                         
                          <select class="small-select" name="month" id="month">
                         <option value="00">--Month--</option>
                         <?php $m=1;	
						 while($m<=12){
							 if($m<10) {$m='0'.$m;}
						?>
                         <option value="<?php echo $m;?>" <?php if($wm==$m){echo "selected=selected";}?>><?php echo date('F', mktime(0,0,0,$m));?></option>
                         <?php $m++; }?>
                         </select>   
                         
                          <select  class="small-select" name="year" id="year">
                         <option value="0000">--Year--</option>
                         <?php $y= date('Y');	
						 $y1= date('Y')+4;					
						 while($y<=$y1){?>
                         <option value="<?php echo $y;?>" <?php if($wy==$y){echo "selected=selected";}?>><?php echo $y;?></option>
                         <?php $y++; }?>
                         </select>
                         <?php } ?>
                        </p>
                        </div>
                        <div class="align-left">
                         <p>
                        <label>Partner Name:</h4></label>   
                        <?php if($this->uri->segment(2)=='view') {?>
                        <label><?php echo $cpname; ?></label>
                        <?php }else{?>     
                        <input type="text" id="cpname"  class="text-input" title="Partner Name" name="cpname" value="<?php echo $cpname; ?>"/>
                        <?php } ?>
                        </p>  
                         <p>
                        <label>Partner Telephone No:</h4></label>  
                        <?php if($this->uri->segment(2)=='view') {?>
                        <label><?php echo $cptelephone; ?></label>
                        <?php }else{?>     
                        <input type="text" id="cptelephone"  class="text-input" title="Partner Telephone No" name="cptelephone" value="<?php echo $cptelephone; ?>"/>
                        <? } ?>
                        </p>   
                        <p>
                        <label>Remarks:</h4></label>  
                        <?php if($this->uri->segment(2)=='view') {?>
                        <label><?php echo $wremarks; ?></label>
                        <?php }else{?>   
                        <textarea name="remarks" cols="5" rows="3" style="height:65px;" id="remarks" class="text-input" title="Remarks"><?php echo $wremarks; ?></textarea>    
                        <? } ?>                        
                        </p>
                            <p>
                     	<label>Wedding Date:<span style="color:red;">*</span></label>  
                     	<?php if($this->uri->segment(2)=='view') {
                     		?>
                        <label><?php
                        			if($weddingdate=='0000-00-00' || $weddingdate=='' )
									{
										echo "";
									}
									else if($weddingdate!='0000-00-00')
									{
										echo date('d F Y',strtotime($weddingdate));
									}  ?></label>
                        <?php }else{?>      
						  <select class="small-select" name="day1" id="day1">
                        <option value="00">--Day--</option>
                         <?php $d=1;	
						 while($d<=31){
							 if($d<10) {$d='0'.$d;}
						?>
                         <option value="<?php echo $d;?>" <?php if($wd1==$d){echo "selected=selected";}?>><?php echo $d?></option>
                         
                         <?php $d++; }?>
                         </select> 
                         
                          <select class="small-select" name="month1" id="month1">
                         <option value="00">--Month--</option>
                         <?php $m=1;	
						 while($m<=12){
							 if($m<10) {$m='0'.$m;}
						?>
                         <option value="<?php echo $m;?>" <?php if($wm1==$m){echo "selected=selected";}?>><?php echo date('F', mktime(0,0,0,$m));?></option>
                         <?php $m++; }?>
                         </select>   
                         
                          <select class="small-select" name="year1" id="year1">
                         <option value="0000">--Year--</option>
                         <?php $y= date('Y');	
						 $y1= date('Y')+4;					
						 while($y<=$y1){?>
                         <option value="<?php echo $y;?>" <?php if($wy1==$y){echo "selected=selected";}?>><?php echo $y;?></option>
                         <?php $y++; }?>
                         </select>
                         <? } ?>
                        </p>   
                        </div>
                        <div class="clear"></div>                
                    <?php if($this->uri->segment(2) != 'view'){?> 
                        
                  <div class="content-box">
                  <div class="content-box-header">
                    <h3>Dress Style(s) Tried :</h3>
                    </div>
                    <div class="content-box-content">
                    <div> 
                        <p>
                        <?php $q="select * from dress_type order by type";
						$rs=mysql_query($q);			
						?>
                        <label>Dress Type:</label>       
                        <select id="type" class="text-input small-input" title="Dress Type" name="type" onchange="if(this.options[this.selectedIndex].onclick && document.all) {this.options[this.selectedIndex].onclick();}else{this.options[this.selectedIndex].onclick();}">
                        <option value="0">Select Type</option>
                        <?php while($row=mysql_fetch_array($rs)){?>    
                        <option value="<?php echo $row['did'];?>" <?php if($type==$row['did']){echo "selected=selected";}?>><?php echo $row['type'];?></option>
                      <?php }?>
                      </select>
                        </p>
                        
                        <p id="style111">
                        <?php /*?><?php $q="select * from dress_style order by did";
						$rs=mysql_query($q);			
						?><?php */?>
                        <label>Dress Style:</label>      
                        <select id="style" class="text-input small-input" title="Dress Style" name="style" size="7">
                           <option value="0">Select Style</option>
                        <?php /*?><?php while($row=mysql_fetch_array($rs)){?>    
                        <option value="<?php echo $row['did'];?>" <?php if($type==$row['did']){echo "selected=selected";}?>><?php echo $row['styleno'];?></option>
                      <?php }?><?php */?>
                      </select>
                        </p>
                    </div>
                   </div>
                  </div>         
                     <? } ?>  
                      <p>         
                      	<?php if($this->uri->segment(2) != 'view'){?>             
               			<input type="submit" id="submit1" class="button" value="Add To Bag" name="submit1"/>
               			<? } ?>
                     </p>    
                       </fieldset>            

    </form>
    </div>	
    </div>
</div>

<div class="content-box">        
   <div class="content-box-header">
    <h3>Dress Style(s) Tried</h3>
    </div>
<div class="content-box-content">
<div class="tab-content"> 

<?php  
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
		     			echo anchor(base_url() . "index.php/walkincustomer/walkincustomer_detail/$field_name/" .
                        (($sort_order == 'asc' && $sort_by == $field_name) ? 'desc' : 'asc').'?find=' . $_GET['find'] ,
                        $field_display); 
                    }
                    else 
                    {
						echo anchor(base_url() . "index.php/walkincustomer/walkincustomer_detail/$field_name/" .
                        (($sort_order == 'asc' && $sort_by == $field_name) ? 'desc' : 'asc').'' ,
                        $field_display); 
                      
                    } ?>
                      
                </th>
                <?php endforeach; ?>               
                 <!-- <th>Name</th>
                <th>Phone No</th>
                <th>Date</th>-->                   
                <th>Type</th>
                <th>Style</th> 
                             
                <th width="25">
                Delete
                </th>        
             

	      </tr>
</thead>
<?php 
 foreach ($_SESSION['BAG'] as $itemno => $item) 
{ 
	if($_SESSION['BAG'][$itemno]!="")
	{ ?> 
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
   <tbody>  <?php $q1="select * from dress_type where did='".$item['wtype']."'";
					$rs1=mysql_query($q1);	
					$r1=mysql_fetch_array($rs1);
					$q2="select * from dress_style where did='".$item['wstyle']."'";
					$rs2=mysql_query($q2);	
					$r2=mysql_fetch_array($rs2);									
				?>      
            
            <tr> 
            	<?php /*?> <td><?php echo $item['wname']; ?></td> 
                 <td><?php echo $item['wtelephone']; ?></td>
                <td><?php echo $item['wdate']; ?></td>  <?php */?>   
                <td><?php echo $r1['type']; ?></td>
                <td><?php echo $r2['styleno']; ?></td>
            
               
                <?php if($this->uri->segment(2)=='edit' || $this->uri->segment(2)=='view')
			{?>
            
            <td style="max-width:20px"><a href="<?php echo base_url().'index.php/walkincustomer/delete_bag/?edit=true&did='.$this->uri->segment(3).'&ino='.$itemno;?>"><div class="delete_icon"></div></a></td>
                 	  
               <?php }else{ ?>
                <td style="max-width:20px"><a href="<?php echo base_url() . 'index.php/walkincustomer/delete_bag/?ino='.$itemno .'&did='.$this->uri->segment(3);?>"><div class="delete_icon"></div></a>
				</td>                
             
        	<?php }	?>
             </tr>
            <?php }?>
          
        </tbody>       
		<?php }	?>
             </table>             
               <!--<p>             
                 <div  align="center">                      
                    <div  align="center">
                    <form name="form1" id="form1" method="post" action="" onsubmit="javascript:if(!cvalidate('form1','eee')){return false};">
                           <input type="submit" id="save" class="button" value="Save" name="save"/>
                            </form> 
                     </div>
                </div>
             </p>   -->      
        <?php }
}
else
{
	if(sizeof($_SESSION['BAG_EDIT'])!="")
	{?>
<table width="100%">
 <thead> 
           <tr>
				<?php foreach($fields as $field_name => $field_display): ?>
                 <th <?php if ($sort_by == $field_name) echo "class=\"sort_$sort_order\"" ?>>
					<?php if(isset($_GET['find'])) 
					{
		     			echo anchor(base_url() . "index.php/walkincustomer/walkincustomerdetail/$field_name/" .
                        (($sort_order == 'asc' && $sort_by == $field_name) ? 'desc' : 'asc').'?find=' . $_GET['find'] ,
                        $field_display); 
                    }
                    else 
                    {
						echo anchor(base_url() . "index.php/walkincustomer/walkincustomerdetail/$field_name/" .
                        (($sort_order == 'asc' && $sort_by == $field_name) ? 'desc' : 'asc').'' ,
                        $field_display); 
                      
                    } ?>
                      
                </th>
                <?php endforeach; ?> 
               <!--  <th>Name</th>
                <th>Phone No</th>
                <th>Date</th>    -->               
                <th>Type</th>
                <th>Style</th>
                <?php if($this->uri->segment(2) != 'view'){?>                          
                <th width="25">
                Delete
                </th>          
                <? } ?>      

	      </tr>
</thead>
<?php
//echo print_r($_SESSION['BAG_EDIT']);

 foreach ($_SESSION['BAG_EDIT'] as $itemno => $item) 
{ 
	if($_SESSION['BAG_EDIT'][$itemno]!="")
	{ ?> 
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
   <tbody>  <?php $q1="select * from dress_type where did='".$item['wtype']."'";
					$rs1=mysql_query($q1);	
					$r1=mysql_fetch_array($rs1);
					$q2="select * from dress_style where did='".$item['wstyle']."'";
					$rs2=mysql_query($q2);	
					$r2=mysql_fetch_array($rs2);	
									
				?>      
            
            <tr>
              <?php /*?> <td><?php echo $item['wname']; ?></td> 
                 <td><?php echo $item['wtelephone']; ?></td>
                <td><?php echo $item['wdate']; ?></td>       <?php */?>
                <td><?php echo $r1['type']; ?></td>
                <td><?php echo $r2['styleno']; ?></td>
                <?php if($this->uri->segment(2)=='edit')
			{?>
               <td style="max-width:20px"><a href="<?php echo base_url().'index.php/walkincustomer/delete_bag/?edit=true&did='.$this->uri->segment(3).'&ino='.$itemno;?>"><div class="delete_icon"></div></a></td>
                 	  
               <?php }else if($this->uri->segment(2)!='view'){ ?>
                <td style="max-width:20px"><a href="<?php echo base_url() . 'index.php/walkincustomer/delete_bag/?ino='.$itemno .'&did='.$this->uri->segment(3);?>"><div class="delete_icon"></div></a>
				</td>
        	<?php }	?>
             </tr>
            <?php }?>
          
        </tbody>       
		<?php }	?>
             </table>             
               <!--<p>             
                 <div  align="center">                      
                    <div  align="center">
                    <form name="form1" id="form1" method="post" action="" onsubmit="javascript:if(!cvalidate('form1','eee')){return false};">
                          <input name="etno" id="etno" type="hidden" value=""/>
                           <input name="ewname" id="ewname" type="hidden" value=""/>
                           <input name="eyear" id="eyear" type="hidden" value=""/>
                           <input name="emonth" id="emonth" type="hidden" value=""/>
                           <input name="eday" id="eday" type="hidden" value=""/>
                           <input name="eremarks" id="eremarks" type="hidden" value=""/>
                           <input type="submit" id="save" class="button" value="Save" name="save" onclick="fun1();"/>
                     </form> 
                     </div>
                </div>
             </p>    -->     
        <?php }
}
?>       
     
     <p>             
        
        <form name="form1" id="form1" method="post" action="" onsubmit="javascript:if(!cvalidate('form1','eee')){return false};">
              <input name="etno" id="etno" type="hidden" value=""/>
               <input name="ewname" id="ewname" type="hidden" value=""/>
               <input name="eyear" id="eyear" type="hidden" value=""/>
               <input name="emonth" id="emonth" type="hidden" value=""/>
               <input name="eday" id="eday" type="hidden" value=""/>
                <input name="eyear1" id="eyear1" type="hidden" value=""/>
               <input name="emonth1" id="emonth1" type="hidden" value=""/>
               <input name="eday1" id="eday1" type="hidden" value=""/>
               <input name="eremarks" id="eremarks" type="hidden" value=""/>
                <input name="estaffname" id="estaffname" type="hidden" value=""/>
                <input name="ecpname" id="ecpname" type="hidden" value=""/>
                <input name="ecptelephone" id="ecptelephone" type="hidden" value=""/>
                <?php if($this->uri->segment(2) != 'view'){?>  
               <input type="submit" id="save" class="button" value="Save" name="save" onclick="fun1();"/>
               <? } ?>
         </form> 
             </p>
            </div>
            </div>
   </div> 	
