<?php $this->load->view('includes/header'); 
session_start();
if($this->session->userdata('security_level')!=3)
{
	redirect(base_url());
}
?>
<div class="content-box"><!-- Start Content Box -->
        
        <div class="content-box-header">
            
            <h3>User List</h3>
            
            <ul class="content-box-tabs">
             <li>
             <div style="margin:3px">
                <form method="get" action="<?php echo base_url(); ?>index.php/user/userdetail">
                <input type="text" width="100" id="find" name="find" value="<?php echo $_REQUEST['find'] ?>" />
                <input type="submit" class="button" id="search" value="Search"  />
                </form>
			</div>
            </li>
            <li>
               <div style="margin-top:3px">
              <a class="button_new" href="<?php echo base_url(); ?>index.php/user/addnew">Add New User</a>
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
		     			echo anchor(base_url() . "index.php/user/userdetail/$field_name/" .
                        (($sort_order == 'asc' && $sort_by == $field_name) ? 'desc' : 'asc').'?find=' . $_GET['find'] ,
                        $field_display); 
                    }
                    else 
                    {
						echo anchor(base_url() . "index.php/user/userdetail/$field_name/" .
                        (($sort_order == 'asc' && $sort_by == $field_name) ? 'desc' : 'asc').'' ,
                        $field_display); 
                      
                    } ?>
                      
                </th>
                <?php endforeach; ?>                
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
             <?php foreach($records as $row):?>
            <tr>
			 <td width="250"><?php echo $row->username; ?></td>
             <td><?php echo $row->security_level ;?></td>            
              <td style="max-width:20px"><?=confirm(base_url() . 'index.php/user/delete/'.$row->uid , '<div class="delete_icon"></div>' , 'conf'.$row->uid , array( 'class' => 'delete' ) , array( 'dialog' => 'Are you sure you want to delete '.$row->username .'?' ) )?></td>                              
           	 <td style="max-width:20px"><?php echo anchor(base_url() . "index.php/user/edit/".$row->uid, '<div class="edit_icon"></div>'); ?></td>
             </tr>
        	<?php endforeach;?>
            
           </tbody>
             </table>
            </div>
            </div>
            </div>
<div class="content-box">
<div class="content-box-header">
<h3>Security Information</h3>         
<div class="clear"></div>
</div> 
         
<div class="content-box-content">
<div class="tab-content"> 
<br />
 <h2>Security Levels</h2><br />
 	<h3>Level 1</h3>
	<ul>
    <li>Can view/search Customer and Reports</li>
    </ul><br />
 	<h3>Level 2 : </h3>
    <ul>
    <li>Everything of Level 1</li>
    <li>Can CREATE Walk-In Customer</li>
    <li>Can CREATE Customer</li>
    <li>Can CREATE DRESS BOOKING</li>
    <li>Can DELETE/EDIT their OWN DRESS BOOKING RECORDS</li>
    </ul><br />
	<h3>Level 3 : </h3>
    <ul>
    <li>Everything of Level 1 & Level 2</li>
	<li>Can ADD/DELETE System Users.</li>
	<li>Can DELETE/EDIT Customer Record</li>
	<li>Full Access to DRESS</li>
	<li>Can DELETE/EDIT any DRESS BOOKING RECORDS</li>
	<li>Can EDIT the STAFF NAME field of DRESS BOOKING</li>
	<li>Can EDIT the STAFF NAME field of walk-in Customers.</li>
    </ul>
</div>
</div>
</div>
 <script type="text/javascript">
document.getElementById('user').className='current';
document.getElementById('systemuser').className='nav-top-item current';
</script>
<?php $this->load->view('includes/footer'); ?>
