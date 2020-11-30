<?php $this->load->view('includes/header1'); ?>
<div id="signup">
	<div id="box" style="width:400px; margin:20px auto; background-color:#ffffff">
		<h1 align="center" style="margin-top:10px;">Create Account</h1>
    	<div id="eee" name="err" style="color:#FF0000"> <?php echo validation_errors('<p class="error">'); ?> </div>
      <h3 align="center" style="padding:10px;">Signup</h3> 
    <form action="<?php echo base_url(); ?>/index.php/admin/create_member" name="form" id="form" method="post" style="padding:10px;">
              <fieldset>
    	 			<table>
                    <tr>
                    <td width="150"><label><strong>First Name:</strong></label> </td>
               		<td><input type="text" style="width:200px;" id="fname"  name="fname"  value=""  class ="val_req"/></td>
                    </tr><tr>
                    <td><label><strong>Last Name:</strong></label></td>
               		<td><input type="text" style="width:200px;" id="lname" name="lname"  value=""  class ="val_req"/></td>
                    </tr><tr>
                    <td><label><strong>Email Address:</strong></label></td>
               		<td><input type="text" style="width:200px;"  id="email"  name="email"  value=""  class ="val_req"/></td>
          			</tr><tr>
                    <td><label><strong>Password:</strong></label></td>
               	    <td><input type="password" style="width:200px;" id="password"  name="password"  value=""  class ="val_req"/></td>
           			</tr><tr>
                    <td><label><strong>Confirm Password:</strong></label></td>
               		<td><input type="password" style="width:200px;" id="confirmpassword" name="confirmpassword" value=""  class= "val_pass"/></td>
                    </tr><tr>
                    <td colspan="2"><input type="submit" id="submit1" class="button" value="Submit" onClick="javascript:if(cvalidate('form','eee')){document.getElementById('form').submit()};" name="submit1"/>
             </td></tr>
             </table>
          </fieldset>   	
          </form>  	  		 
	</div>
</div>
<?php $this->load->view('includes/footer');