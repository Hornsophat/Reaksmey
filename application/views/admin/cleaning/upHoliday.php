<div id="myHoliday" class="modal fade" role="dialog">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Add Holiday</h4>
	      </div>
	      <form method="post" action="<?php echo site_url('admin/cleaning/addHoliday')?>">
		      <div class="modal-body">
		        <div class="row">
		        	<div class="col-md-12">
		        		<div class="form-group">
		        			<label>Date</label>
		        			<input class="dtpicker form-control input-sm" type="text" id="d_holiday" name="d_holiday" value="" > 
		        		</div>
		        	</div>
		        	<div class="col-md-12">
		        		<div class="form-group">
		        			<label>Description</label>
		        			<textarea rows="3" class="form-control" name="holiday_dis"></textarea>
		        		</div>
		        	</div>
		        </div>
		      </div>
		      <div class="modal-footer">
		      	<button type="submit" class="btn btn-primary">Submit</button>
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		      </div>
	     </form>
	    </div>

	  </div>
	</div>