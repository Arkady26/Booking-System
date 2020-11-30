<?php $this->load->view('includes/header'); 
session_start();
if($this->session->userdata('security_level')!=3)
{
	redirect(base_url());
}
?>
<div class="content-box"><!-- Start Content Box -->
        
        <div class="content-box-header">
            
            <h3>Dress Type List</h3>
            
            <ul class="content-box-tabs">
             <li>
             <div style="margin:3px">
                <form method="get" action="<?php echo base_url(); ?>index.php/dress_type/dress_typedetail">
                <input type="text" width="100" id="find" name="find" value="<?php echo $_REQUEST['find'] ?>" />
                <input type="submit" class="button" id="search" value="Search"  />
                </form>
			</div>
            </li>
            <li>
               <div style="margin-top:3px">
              <a class="button_new" href="<?php echo base_url(); ?>index.php/dress_type/addnew">Add New Dress Type</a>
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
		     			echo anchor(base_url() . "index.php/dress_type/dress_typedetail/$field_name/" .
                        (($sort_order == 'asc' && $sort_by == $field_name) ? 'desc' : 'asc').'?find=' . $_GET['find'] ,
                        $field_display); 
                    }
                    else 
                    {
						echo anchor(base_url() . "index.php/dress_type/dress_typedetail/$field_name/" .
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
		<td><?php echo $row->type; ?></td>
        <td style="max-width:20px">
        <?php 
	    $q = "Select type from dress_style where type = ".$row->did."";
		$res = mysql_query($q);
		$row1= mysql_fetch_array($res);?>
        <?php if($row1['type'] == $row->did){?>
        <?=confirm(base_url() . 'index.php/dress_type/dress_typedetail/'.$row->did ,'<div class="delete_icon"></div>' , 'conf'.$row->did , array( 'class' => 'delete' ) ,array( 'dialog' => 'Cannot delete this Dress Type, Already in use.') )?>
        <? }else {?>
		<?=confirm(base_url() . 'index.php/dress_type/delete/'.$row->did , '<div class="delete_icon"></div>' , 'conf'.$row->did , array( 'class' => 'delete' ) ,array( 'dialog' => 'Are you sure you want to delete '.$row->type .'?' ) )?>
        <? } ?>
              </td>
           	 <td style="max-width:20px"><?php echo anchor(base_url() . "index.php/dress_type/edit/".$row->did, '<div class="edit_icon"></div>'); ?></td>
             </tr>
        	<?php endforeach;?>
            
           </tbody>
             </table>
            </div>
            </div>
            </div>
 <script type="text/javascript">
document.getElementById('dtype').className='current';
document.getElementById('dress').className='nav-top-item current';
</script>
<?php $this->load->view('includes/footer'); ?>
