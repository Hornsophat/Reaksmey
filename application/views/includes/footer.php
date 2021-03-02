	<div id="footer">
		<hr>
		<div class="inner">
			<div class="container">
				<p class="right"><a href="<?php echo site_url('admin')?>">Back to top</a></p>
				<p>
				</p>
			</div>
		</div>
	</div>
	
	<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrapvalidator.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/admin.js?<?=time();?>"></script>
	
	<script src="<?php echo site_url('assets/moment/moment.js'); ?>"></script>
	<script src="<?php echo base_url(); ?>assets/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js"></script>
	<script src="<?php echo site_url('assets/js/jquery.validate-1.14.0.min.js')?>"></script>
	<script src="<?php echo site_url('assets/js/formValidation.min.js')?>"></script>
	<?php 
		$date = date('Y-m-d');
	 ?>
	<!-- <script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.fa.min.js"></script> -->

	
	
	<!-- Script -->
	<script type="text/javascript">
	
    $(document).ready(function() {
        $('#btnEdit').tooltip();
        $('#btnDel').tooltip();
                
		// $(".dtpicker").datepicker({
		//         changeMonth: true,
		//         changeYear: true,
		//         yearRange: 'c-50:c+10'
		// });

		// $(".dtpicker, .dtpickerend").datetimepicker({
	 //        format: "dd MM yyyy - HH:ii P",
	 //        showMeridian: true,
	 //        autoclose: true,
	 //        todayBtn: true
	 //    });
		$(".dtpicker, .dtpickerend").datetimepicker({
		 	format : "YYYY-MM-DD"
		 });
	    $('input').attr('autocomplete','off');
	 //    $('.dtpicker, .dtpickerend').datetimepicker().on('dp.show', function () {
	 //    	var this_date = $(this).val();
	 //    	var date = ('<?=$date?>');
	 //    	if(this_date > date){
	 //    		date = new Date(date);
	 //    		date.setDate(date.getDate() -1);
	 //    	}
	 //        return $(this).data('DateTimePicker').minDate(new Date(date));
		// });            
	                
	    });
    </script>
        
</body>
</html>