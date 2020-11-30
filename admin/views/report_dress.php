<?php $this->load->view('includes/header'); 
session_start();
//unset($_SESSION['SEARCH_DATA']);
?>  
<?php $this->load->view('search_dress_form'); ?>
<script type="text/javascript">
	$(document).ready(function(){       
		$('#type').change(function()
		{ 
		//alert('');
			$("#selstyle > option").remove();
			var fid = $('#type').val();
				$.ajax(
				{
					type: "POST",
					url: "<?php echo base_url(); ?>index.php/dress_booking/get_style/"+fid,
					success: function(style)
					{
						$.each(style,function(id,s)
							{
								//alert(style);
								//alert(id);
								var opt = $('<option />');
								opt.val(id);
								opt.text(s);
								$('#selstyle').append(opt);
							});
					}
				});
		});		
	});
</script>

 <script type="text/javascript">
document.getElementById('r2').className='current';
document.getElementById('report').className='nav-top-item current';
</script>
<?php $this->load->view('includes/footer'); ?>

