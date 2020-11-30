<?php $this->load->view('includes/header'); ?>
<div class="content-box"><!-- Start Content Box -->
        
        <div class="content-box-header">
            
            <h3>Dress Customer List</h3>
            
            <ul class="content-box-tabs">
             <li>
             <div style="margin:3px">
                <form method="get" action="<?php echo base_url(); ?>index.php/customer/customerdetail">
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
              <a class="button_new" href="<?php echo base_url(); ?>index.php/customer/addnew">Add New Customer</a>
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
		     			echo anchor(base_url() . "index.php/customer/customerdetail/$field_name/" .
                        (($sort_order == 'asc' && $sort_by == $field_name) ? 'desc' : 'asc').'?find=' . $_GET['find'] ,
                        $field_display); 
                    }
                    else 
                    {
						echo anchor(base_url() . "index.php/customer/customerdetail/$field_name/" .
                        (($sort_order == 'asc' && $sort_by == $field_name) ? 'desc' : 'asc').'' ,
                        $field_display); 
                      
                    } ?>
                      
                </th>
                <?php endforeach; ?>
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
            <td width="150" ><?php echo $row->cno; ?></td>
            <td ><?php echo $row->cname; ?></td>
            <td ><?php echo $row->ctelephone; ?></td>
            <td ><?php echo $row->cpname; ?></td>
			 <td ><?php echo $row->cptelephone; ?></td>
             <td ><?php echo date('d F Y',strtotime($row->	cweddingdate)); ?></td>
             <?php if($this->session->userdata('security_level') == '3'){?>   
              <td style="max-width:20px"><?=confirm(base_url() . 'index.php/customer/delete/'.$row->cid.'/'.$row->cno, '<div class="delete_icon"></div>' , 'conf'.$row->cid , array( 'class' => 'delete' ) , array( 'dialog' => 'Are you sure you want to delete '.$row->cname.'? All dress booking of the selected customer will be deleted' ) )?></td>                              
           	 <td style="max-width:20px"><?php echo anchor(base_url() . "index.php/customer/edit/".$row->cid, '<div class="edit_icon"></div>'); ?></td>
             <? }?>
             </tr>
        	<?php endforeach;?>
            
           </tbody>
             </table>
            </div>
            </div>
            </div>
 <script type="text/javascript">
document.getElementById('addcustomer').className='current';
document.getElementById('customer').className='nav-top-item current';
</script>
<?php $this->load->view('includes/footer'); ?>
