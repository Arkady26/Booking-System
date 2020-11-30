<?php $this->load->view('includes/header'); 
session_start();
unset($_SESSION['BAG_DATA']);
unset($_SESSION['BAG']);
?>
<div class="content-box"><!-- Start Content Box -->
        
        <div class="content-box-header">
            
            <h3>Walk-In Customer List</h3>
            
            <ul class="content-box-tabs">
             <li>
             <div style="margin:3px">
                <form method="get" action="<?php echo base_url(); ?>index.php/walkincustomer/walkincustomer_detail">
                <input type="text" width="100" id="find" name="find" value="<?php echo $_REQUEST['find'] ?>" />
                <input type="submit" class="button" id="search" value="Search"  />
                </form>
			</div>
            </li>
            <li>
            <?php
            if($this->session->userdata('security_level')!=1)
            {?>
              <div style="margin-top:3px">
              <a class="button_new" href="<?php echo base_url(); ?>index.php/walkincustomer/addnew">Add New Walk-In Customer</a>
             </div>
             <?php } ?>
             </li>   
            </ul>
              <div class="clear"></div>
         </div> 
<div class="content-box-grid">
<div class="tab-content"> 
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
              
                <th>View</th>  
              
                <?php if($this->session->userdata('security_level') == '3'){?>   
                               
                <th width="25">
                Delete	
                </th>
                <th width="25">
                Edit	 
                </th>
				<? }?>
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
             <?php foreach($records as $row):?>
            <tr>
             <td><?php echo $row->staffname; ?></td>
			 <td><?php echo $row->wname; ?></td>
             <td><?php echo $row->wtelephone; ?></td>
             <td><?php echo $row->cpname; ?></td>
             <td><?php echo $row->cptelephone; ?></td>
             <?php if(($row->weddingdate=='0000-00-00')) { ?>
                 <td></td>
             <?php } else if($row->weddingdate=='') { ?>
                 <td></td>
			 <?php } else { ?>     
             <td> <?php echo date('d F Y',strtotime($row->weddingdate)); ?> </td>
             <?php
			 }
			 ?>
			 <?php if(($row->wdate=='0000-00-00')) { ?>
                 <td></td>
             <?php } else if($row->wdate=='') { ?>
                 <td></td>
			 <?php } else { ?>     
             <td> <?php echo date('d F Y',strtotime($row->wdate)); ?> </td>
             <?php
			 }
			 ?> 
             <td><a class="button" href="<?php echo base_url() . "index.php/walkincustomer/onlyview/".$row->wcid;?>">View</a></td>
             <?php if(($this->session->userdata('security_level') == '3') || (($row->staffname==$this->session->userdata('username')) && ($this->session->userdata('security_level') == '2'))){?>   
             <td style="max-width:20px"><?=confirm(base_url() . 'index.php/walkincustomer/delete/'.$row->wcid , '<div class="delete_icon"></div>' , 'conf'.$row->wcid , array( 'class' => 'delete' ) , array( 'dialog' => 'Are you sure you want to delete '.$row->wname .'?' ) )?></td>                              
           	 <td style="max-width:20px"><?php echo anchor(base_url() . "index.php/walkincustomer/editview/".$row->wcid, '<div class="edit_icon"></div>'); ?></td>
             <? }?>
             </tr>
        	<?php endforeach;?>
            
           </tbody>
             </table>
            </div>
            </div>
            </div>

 <script type="text/javascript">
document.getElementById('addwcustomer').className='current';
document.getElementById('wcustomer').className='nav-top-item current';
</script>
<?php $this->load->view('includes/footer'); ?>
