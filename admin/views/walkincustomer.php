<?php $this->load->view('includes/header'); 

?>  
<?php $this->load->view('walkincustomer_form'); ?>
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
					url: "<?php echo base_url(); ?>index.php/walkincustomer/get_style/"+fid,
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
document.getElementById('addwcustomer').className='current';
document.getElementById('wcustomer').className='nav-top-item current';
</script>
<?php $this->load->view('includes/footer'); ?>

