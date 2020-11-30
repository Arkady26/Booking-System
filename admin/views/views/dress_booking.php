<?php $this->load->view('includes/header'); 
session_start();

//unset($_SESSION['BAG']);
//unset($_SESSION['BAG_EDIT']);
?>  
<?php $this->load->view('dress_booking_form'); ?>
<script type="text/javascript">
	$(document).ready(function(){       
		$('#type').change(function()
		{ 
		//alert('');
			$("#style > option").remove();
			var fid = $('#type').val();
				$.ajax(
				{
					type: "POST",
					url: "<?php echo base_url(); ?>index.php/dress_booking/get_style/"+fid,
					success: function(style)
					{ 
						$.each(style,function(id,s)
							{
								var opt = $('<option />');
								opt.val(id);
								opt.text(s);
								$('#style').append(opt);
							});
					}
				});
		});		
	});
</script>

 <script type="text/javascript">
document.getElementById('dbooking').className='current';
document.getElementById('dressbooking').className='nav-top-item current';
</script>
<?php $this->load->view('includes/footer'); ?>

