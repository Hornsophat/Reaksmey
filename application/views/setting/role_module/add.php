<div class="container top">
	<div class="panel panel-default">
		<div class="panel-header">
	        <div class="col-sm-12">
	            <h3>ROLE INFORMATION</h3>
	        </div>
	    </div>
		<div class="panel-body">
			<div class="result_info">
			    <!-- <div class="col-sm-6">
			        <strong>ROLE INFORMATION</strong>
			    </div> -->
			    <div class="col-sm-6" style="text-align: center">
			        <strong>
			            <center class='member_error' style='color:red;'>
			                <?php if(isset($error->error))
								echo $error->error;
							?>
			            </center>
			        </strong>
			    </div>
			</div>
			<div class="row">
			    <div class="col-sm-12">
			        <div class="panel panel-default">
			            <div class="panel-body">
			                <div class="table-responsive" id="tab_print">
			                    <form enctype="multipart/form-data" accept-charset="utf-8" method="post" id="defaultform" action='<?php echo site_url('setting/role/saverole');?>'> <table align='center' width="600">
			                        <tr>
			                            <td valign="top"><label for="emailField">Role Name</label></td>
			                            <td valign="top"> : </td>
			                            <td valign="top"><input type='text' class="form-control" name='txtrole_name' id='txtf_name' required data-parsley-required-message="Enter Role Name" placeholder="your First name" /><br />
			                            <td rowspan='2'>
			                                <fieldset>
			                                    <?php
													$i=0;
														foreach ($this->module->getmodule() as $row) {
														 	echo "<input type='checkbox'  value='$row->moduleid' name='ch_".$i."'/>  <label for='emailField'>$row->module_name</label></br>";
														 $i++;
														 } 
													?>
			                                </fieldset>
			                                <input style='display:none;' type='text' name='txtm-count' value='<?php echo $i; ?>' />
			                            </td>
			                        </tr>
			                        <tr>
			                            <td></td>
			                            <td></td>
			                            <td>
			                                <input type='submit' class="btn btn-primary" name='btnsubmit' id='btnsubmit' value='Save Role'>
			                                <input type='reset' class="btn btn-warning" name='btnreset' id='btnreset'>
			                            </td>
			                        </tr>
			                        </table>
			                    </form>
			                </div>
			            </div>
			        </div>
			    </div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
$(function() {
    $('#defaultform').parsley();
})

function PreviewImage() {
    var oFReader = new FileReader();
    oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);

    oFReader.onload = function(oFREvent) {
        document.getElementById("uploadPreview").src = oFREvent.target.result;
        document.getElementById("uploadPreview").style.backgroundImage = "none";
    };
};
$(document).ready(function() {

});
</script>