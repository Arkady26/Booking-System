<?php $this->load->view('includes/header');
session_start();
if($this->session->userdata('security_level')!=3)
{
	redirect(base_url());
}
 ?>
<div class="content-box"><!-- Start Content Box -->
        
        <div class="content-box-header">
            
            <h3>Dress Style List</h3>
            
            <ul class="content-box-tabs">
             <li>
             <div style="margin:3px">
                <form method="get" action="<?php echo base_url(); ?>index.php/dress_style/dress_styledetail">
                <input type="text" width="100" id="find" name="find" value="<?php echo $_REQUEST['find'] ?>" />
                <input type="submit" class="button" id="search" value="Search"  />
                </form>
			</div>
            </li>
            <li>
               <div style="margin-top:3px">
              <a class="button_new" href="<?php echo base_url(); ?>index.php/dress_style/addnew">Add New Dress Style</a>
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
		     			echo anchor(base_url() . "index.php/dress_style/dress_styledetail/$field_name/" .
                        (($sort_order == 'asc' && $sort_by == $field_name) ? 'desc' : 'asc').'?find=' . $_GET['find'] ,
                        $field_display); 
                    }
                    else 
                    {
						echo anchor(base_url() . "index.php/dress_style/dress_styledetail/$field_name/" .
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
   
             <?php foreach($records as $row):
			    $q1="select * from dress_type where did='".$row->type."'";
				$rs1=mysql_query($q1);
				$rr=mysql_fetch_array($rs1);
			 ?>
            <tr>
			  <td width="200px;" ><?php echo $row->styleno; ?></td>
              <td ><?php echo $rr['type']; ?></td>
              <td><?php echo $row->description;?></td>
              <?php /*?> <td ><?php echo $row->description; ?></td><?php */?>
              <td style="max-width:20px"><?=confirm(base_url() . 'index.php/dress_style/delete/'.$row->did , '<div class="delete_icon"></div>' , 'conf'.$row->did , array( 'class' => 'delete' ) , array( 'dialog' => 'Are you sure you want to delete '."Style No : ".$row->styleno .'?' ) )?></td>                              
           	 <td style="max-width:20px"><?php echo anchor(base_url() . "index.php/dress_style/edit/".$row->did, '<div class="edit_icon"></div>'); ?></td>
             </tr>
        	<?php endforeach;?>
            
           </tbody>
             </table>
            </div>
            </div>
            </div>
 <script type="text/javascript">
document.getElementById('dstyle').className='current';
document.getElementById('dress').className='nav-top-item current';
</script>
<?php $this->load->view('includes/footer'); ?>
