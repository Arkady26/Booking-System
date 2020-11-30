<?php $this->load->view('includes/header');
session_start();
unset($_SESSION['BAG_DATA']);
unset($_SESSION['BAG']);
unset($_SESSION['DRESS_DETAIL']);
 ?>
<div class="content-box"><!-- Start Content Box -->
        
        <div class="content-box-header">
            
            <h3>Dress Booking List</h3>
            
            <ul class="content-box-tabs">
             <li>
             <div style="margin:3px">
                <form method="get" action="<?php echo base_url(); ?>index.php/dress_booking/dress_booking_detail">
                <input type="text" width="100" id="find" name="find" value="<?php echo $_REQUEST['find'] ?>" />
                <input type="submit" class="button" id="search" value="Search"  />
                </form>
			</div>
            </li>
            <li>
               <div style="margin-top:3px">
              <a class="button_new" href="<?php echo base_url(); ?>index.php/dress_booking/addnew">Add New Dress Booking</a>
             </div>
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
                <th>View</th>               
                <th width="25">
                Delete	
                </th>
                <th width="25">
                Edit	 
                </th>

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
             <?php foreach($records as $row):
				$qc="select * from customer where cno='".$row->customer_no."'";
				$rsc=mysql_query($qc);			
				$rr=mysql_fetch_array($rsc);
			 ?>
             
            <tr>
            <td width="150"><?php echo $row->id; ?></td>
            <td><?php echo $row->customer_no; ?></td>
            <td><?php echo $rr['cname']; ?></td> 
            <td><?php echo $row->staff_name; ?></td>   
            <td><a class="button" href="<?php echo base_url() . "index.php/dress_booking/onlyview/".$row->id;?>">View</a></td>           
            <?php 			
			if(($this->session->userdata('security_level') == '2') && ($this->session->userdata('username') == trim($row->staff_name))){?>         
            <td style="max-width:20px"><?=confirm(base_url() . 'index.php/dress_booking/delete/'.$row->id , '<div class="delete_icon"></div>' , 'conf'.$row->id , array( 'class' => 'delete' ) , array( 'dialog' => 'Are you sure you want to delete Order '.$row->id .'?' ) )?></td>             
     <td style="max-width:20px"><?php echo anchor(base_url() . "index.php/dress_booking/editview/".$row->id, '<div class="edit_icon"></div>'); ?></td>
             <? } ?>
             <?php if($this->session->userdata('security_level') == '3'){?>         
            <td style="max-width:20px"><?=confirm(base_url() . 'index.php/dress_booking/delete/'.$row->id , '<div class="delete_icon"></div>' , 'conf'.$row->id , array( 'class' => 'delete' ) , array( 'dialog' => 'Are you sure you want to delete Order '.$row->id .'?' ) )?></td>             
     <td style="max-width:20px"><?php echo anchor(base_url() . "index.php/dress_booking/editview/".$row->id, '<div class="edit_icon"></div>'); ?></td>
             <? } ?>
           </tr>
         <?php endforeach;?>
           </tbody>
           </table>
            </div>
            </div>
            </div>
 <script type="text/javascript">
document.getElementById('dbooking').className='current';
document.getElementById('dressbooking').className='nav-top-item current';
</script>
<?php $this->load->view('includes/footer'); ?>
