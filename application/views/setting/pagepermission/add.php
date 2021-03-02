<div class="container top">
	<div class="panel panel-default">
		<div class="result_info">
		    <div class="col-sm-6">
		        <h4>ROLE ACCESS INFORMATION</h4>
		    </div>
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
		                    <form enctype="multipart/form-data" accept-charset="utf-8" method="post" id="defaultform" action='<?php echo site_url('setting/permission/save');?>'> <table align='center' width="700">
		                        <tr>
		                            <td width='100'><label for="emailField">Role Name</label></td>
		                            <td> : </td>
		                            <td><select class="form-control" id='cborole_as' name='cborole_as' onchange='loadmoduledetail(event);' required data-parsley-required-message="Please Choose Page" min="1">
		                                    <option value='0'>Select Role</option>
		                                    <?php
												foreach ($this->role->getallrole() as $role_add) {
													echo "<option value='$role_add->roleid' ".($roleid==$role_add->roleid?'selected':'').">$role_add->role</option>";
												}
											?>
		                                </select>
		                            </td>
		                        </tr>
		                        <!-- <tr>
											<td><label for="emailField">Module Name</label></td>
											<td> : </td>
											<td><select class="form-control" id='cbomodule_as' name='cbomodule_as'  onchange='filpage(event);'>
														
												
												</select>
											</td>
											
										</tr>
										<tr>
											<td><label for="emailField">Page Name</label></td>
											<td> : </td>
											<td class='control-group'>
												
												<fieldset style='border:solid 1px #CCCCCC; padding:10px;' id="cbopage_as">
													

													
													
												</fieldset>
											</td>
											
										</tr>
										<tr>
											<td width='100'><label for="emailField">Permission</label></td>
											<td> : </td>
											

											<td >
												<fieldset style='border:solid 1px #CCCCCC; padding:10px;'>

														<div class="col-sm-3">
															<input type='checkbox' name='is_insert' > <label> is_Insert</label>
														</div>
														<div class="col-sm-3">
															<input type='checkbox' name='is_delete' > <label> is_Delete</label>
														</div>
														<div class="col-sm-3">
															<input type='checkbox' name='is_update' > <label> is_Update</label>
														</div>
														<div class="col-sm-3">
															<input type='checkbox' name='is_show' > <label> is_Show</label>
														</div>
														<div class="col-sm-3">
															<input type='checkbox' name='is_print' > <label> is_Print</label>
														</div>
														<div class="col-sm-3">
															<input type='checkbox' name='is_export' > <label> is_Export</label>
														</div>
														<div class="col-sm-3">
															<input type='checkbox' name='is_import' > <label> is_import</label>
														</div>
												</fieldset>	
												
											</td>
										</tr> -->
		                        </table>
		                        <table id="show_action" class="table table-bordered" style="margin-top: 20px;">
		                            <thead>
		                                <tr>
		                                    <th>Module Name</th>
		                                    <th>Page Name</th>
		                                    <th>Action</th>
		                                </tr>
		                            </thead>
		                            <tbody id="permission_detail">
		                            </tbody>
		                        </table>
		                        <input type='reset' class="btn btn-warning pull-right" name='btnreset' id='btnreset'>
		                        <input type='submit' class="btn btn-primary pull-right" name='btnsubmit' id='btnsubmit' value='Save Page'>
		                    </form>
		                </div>
		            </div>
		        </div>
		    </div>
		</div>
	</div>
</div>
<script type="text/javascript">
function PreviewImage() {
    var oFReader = new FileReader();
    oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);
    oFReader.onload = function(oFREvent) {
        document.getElementById("uploadPreview").src = oFREvent.target.result;
        document.getElementById("uploadPreview").style.backgroundImage = "none";
    };
};

function loadmoduledetail() {
    var roleid = jQuery('#cborole_as').val();
    $.ajax({
        url: "<?php echo base_url(); ?>index.php/setting/permission/getmodeleitem",
        data: { 'roleid': roleid },
        type: "POST",
        success: function(data) {
            // alert(data);
            $("#permission_detail").html(data);
            // jQuery('#cbomodule_as').html(data);
            // jQuery('#cbopage_as').html("");
        }
    });
}
//    function fillmodule(event){
// 	var roleid=jQuery('#cborole_as').val();
// 		$.ajax({
// 				url:"<?php echo base_url(); ?>index.php/setting/permission/fillmodule",    
// 				data: {'roleid':roleid},
// 				type: "POST",
// 				success: function(data){
//                             jQuery('#cbomodule_as').html(data);
//                             jQuery('#cbopage_as').html("");

// 			}
// 		});
// }
//  function filpage(event){
// 	var moduleid=jQuery('#cbomodule_as').val();
// 	var roleid = jQuery('#cborole_as').val();
// 		$.ajax({
// 				url:"<?php echo base_url(); ?>index.php/setting/permission/fillpagechk",    
// 				data: {
// 					'moduleid':moduleid,
// 					'roleid':roleid,
// 				},
// 				type: "POST",
// 				success: function(data){
// 					//alert(data);
//                             jQuery('#cbopage_as').html(data);
// 			}
// 		});
// }
$(function() {
    $('#defaultform').parsley();
})
loadmoduledetail();
$(document).ready(function() {

});
</script>