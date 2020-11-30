<?php $this->load->view('includes/header'); 
session_start();
//unset($_SESSION['SEARCH_DATA']);
?>  
<?php $this->load->view('search_form'); ?>
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
						var opt = $('<option />');
								opt.val('0');
								opt.text('Select Style').attr('selected', 'selected');
								$('#style').append(opt);
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
document.getElementById('r1').className='current';
document.getElementById('report').className='nav-top-item current';
</script>
<?php $this->load->view('includes/footer'); ?>

