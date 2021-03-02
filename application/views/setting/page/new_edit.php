<div class="container top">
	<div class="panel panel-default">
		<div class="result_info">
		    <div class="col-sm-6">
		        <strong>PAGE INFORMATION</strong>
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
		                    <form enctype="multipart/form-data" accept-charset="utf-8" method="post" action='<?php echo site_url('setting/page/update');?>'> <input type='text' style='display:none;' value='<?php echo $query->pageid; ?>' name='txtpageid' />
		                    <table align='center' width="700">
		                        <tr>
		                            <td><label for="emailField">Page Name</label></td>
		                            <td> : </td>
		                            <td><input type='text' class="form-control" name='txtp_name' id='txtp_name' value='<?php echo $query->page_name; ?>' required data-parsley-required-message="Enter Page Name" placeholder="Place Page name" /></td>
		                                <!-- <td rowspan='4' style='border:0px solid #CCCCCC; width:200px'>
											<fieldset style='border:solid 1px #CCCCCC; padding:10px;'>
													<input type='checkbox' name='is_insert' > <label for="emailField"> B_Insert</label></br>
													<input type='checkbox' name='is_delete' > <label for="emailField"> B_Delete</label></br>
													<input type='checkbox' name='is_update' > <label for="emailField"> B_Update</label></br>
													<input type='checkbox' name='is_show' > <label for="emailField"> B_Show</label></br>
													<input type='checkbox' name='is_print' > <label for="emailField"> B_Print</label></br>
													<input type='checkbox' name='is_export' > <label for="emailField"> B_Export</label></br>
											</fieldset>	
											
										</td> -->
		                        </tr>
		                        <tr>
		                            <td><label for="emailField">Page Link</label></td>
		                            <td> : </td>
		                            <td><input type='text' class="form-control" name='txtp_link' value='<?php echo $query->link; ?>' id='txtp_link' required data-parsley-required-message="Enter Page Link" placeholder="Place Menu Link " /></td>
		                        </tr>
		                        <tr>
		                            <td><label for="emailField">Module</label></td>
		                            <td> : </td>
		                            <td class='control-group'>
		                                <select class="form-control" id='cbomodule' name='cbomodule' placeholder='select Module'>
		                                    <?php
														foreach ($this->module->getmodule() as $role_row) {?>
		                                    <option value='<?php echo $role_row->moduleid; ?>' <?php if($role_row->moduleid==$query->moduleid) echo 'selected'; ?>>
		                                        <?php echo $role_row->module_name; ?>
		                                    </option>";
		                                    <?php	}
													?>
		                                </select>
		                            </td>
		                        </tr>
		                        <tr>
		                            <td></td>
		                            <td></td>
		                            <td colspan='2'>
		                                <input type='button' class="btn btn-primary" name='btn_add_action' id='btn_add_action' value='Add Action'>
		                                <a href="" class="btn btn-warning" name='btnreset' id='btnreset'>Reset</a>
		                                <input type='submit' class="btn btn-success" name='btnsubmit' id='btnsubmit' value='Save Page'>
		                            </td>
		                            <td></td>
		                            <td></td>
		                        </tr>
		                    </table>
		                    <table id="show_action" class="table table-bordered" style="margin-top: 20px;">
		                        <thead>
		                            <tr>
		                                <th>Action</th>
		                                <th>Url</th>
		                                <th style="width: 20px;">Mudule</th>
		                                <th style="width: 20px;">
		                                    <a href="javascript:void(0)" id="add_new_row">
		                                        <img src="<?= base_url('assets/images/icons/add.png') ?>">
		                                    </a>
		                                </th>
		                            </tr>
		                        </thead>
		                        <tbody id="action_row">
		                            <?php 

											foreach ($action_detail as $act) {
												$delete_img_path = base_url('assets/images/icons/delete.png');
												 echo  "<tr>";
														echo  "<td>";
															echo  "<input type='text' class='form-control' name='page_action[]' required placeholder='Enter Page Action' value='$act->action_name'>";
														echo  "</td>";
														echo  "<td>";
															echo  "<input type='text' class='form-control' name='page_url[]' required placeholder='Enter Page Url' value='$act->action_url'>";
														echo  "</td>";
														echo  "<td>";
															echo  "<input type='checkbox' class='form-control' name='is_mudule[]' value='1' style='width: 20px;' ".($act->is_module==1?'checked':'')." ";
														echo  "</td>";
														echo  "<td>";
															echo  "<a href='javascript:void(0)' class='pull-right remove_row'>";
															echo  "<img src='" . $delete_img_path . "'>";
															echo "</a>";
														echo  "</td>";
													echo  "</tr>";
											}
										?>
		                        </tbody>
		                    </table>
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

//    $(function(){
// 	$('#defaultform').parsley();				
// })
$(document).ready(function() {

    $("#add_new_row").click(function() {
        var delete_img_path = "<?= base_url('assets/images/icons/delete.png') ?>";
        var tr = "<tr>";
        tr += "<td>";
        tr += "<input type='text' class='form-control' name='page_action[]' required placeholder='Enter Page Action'>";
        tr += "</td>";
        tr += "<td>";
        tr += "<input type='text' class='form-control' name='page_url[]' required placeholder='Enter Page Url'>";
        tr += "</td>";
        tr += "<td>";
        tr += "<input type='checkbox' class='form-control' name='is_mudule[]' value='1' style='width: 20px;'";
        tr += "</td>";
        tr += "<td>";
        tr += "<a href='javascript:void(0)' class='pull-right remove_row'>";
        tr += "<img src='" + delete_img_path + "'>";
        tr += "</a>";
        tr += "</td>";
        tr += "</tr>";

        $("#action_row").append(tr);


    });

    $("#action_row").on('click', '.remove_row', function() {
        $(this).parents("tr").remove();
    });

    $("#btn_add_action").click(function() {
        $("#show_action").show();
        $("#add_new_row").click();
    });
    // $("#show_action").hide();

});
</script>