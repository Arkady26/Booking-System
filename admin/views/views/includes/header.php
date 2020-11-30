<?php error_reporting(E_ALL ^ (E_NOTICE | E_WARNING)); ?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Cocoon Bridal System</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="<?php echo base_url(); ?>/resources/css/default.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo base_url(); ?>/resources/css/reset.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo base_url(); ?>/resources/css/style.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo base_url(); ?>/resources/css/invalid.css" type="text/css" media="screen" />	
	
<script src="<?php echo base_url();?>/resources/scripts/jquery-1.6.4.min.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>/resources/scripts/simpla.jquery.configuration.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>/resources/scripts/jquery.wysiwyg.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>/resources/scripts/facebox.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>/resources/scripts/jsDatePick.min.1.3.js"></script>
<script src="<?php echo base_url();?>/resources/scripts/jquery-impromptu.3.2.min.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url();?>/resources/scripts/validation.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" charset="utf-8">
		
		function vhconfirm(v,m)
        {
            if( v )
            {
               var f =  document.createElement("form");document.body.appendChild(f);f.method = "POST";f.action = $("#" + v ).attr( "href" );
			   f.submit(); 
            }
			 else 
            {
                return false;
            }
        }  
	</script>
</head>
<body>   
<div id="sidebar">
<?php 
$this->load->view('includes/sidebar'); ?>
</div>

<div id="main-content"> <!-- Main Content Section with everything -->
<div id="eee" class="flash_message message_error"  style="display:none;" ></div> 
 <?php echo validation_errors('<div class="error">','</div>'); ?>
  <?php echo $this->flash_message->show_all(); ?>
<div id="error" style="display:none;"></div>  
    
    
