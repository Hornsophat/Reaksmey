<div class="panel panel-default">
	<div class="panel-body">
		<div class="result_info">
		    <div class="col-sm-6">
		        <h3>ROLE ACCESS INFORMATION</h3>
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
		                    <form enctype="multipart/form-data" accept-charset="utf-8" method="post" id="defaultform" action='<?php echo site_url('setting/permission/update');?>'> <input type='text' style='display:none' name='txtrolepageid' value='<?php echo $query->role_page_id; ?>' />
		                    <table align='center' width="700">
		                        <tr>
		                            <td width='100'><label for="emailField">Role Name</label></td>
		                            <td> : </td>
		                            <td><select class="form-control" id='cborole_as' name='cborole_as' onchange='fillmodule(event);' required data-parsley-required-message="Please Choose Role" min="1">
		                                    <option value='0'>Select Role</option>
		                                    <?php
														foreach ($this->role->getallrole() as $role_add) {?>
		                                    <option value='<?php echo $role_add->roleid; ?>' <?php if($query->roleid==$role_add->roleid) echo 'selected';?>>
		                                        <?php echo $role_add->role ; ?>
		                                    </option>
		                                    <?php }
													?>
		                                </select>
		                            </td>
		                            <td rowspan='4' style='border:0px solid #CCCCCC; width:200px'>
		                                <fieldset style='border:solid 1px #CCCCCC; padding:10px;'>
		                                    <input type='checkbox' name='is_insert' <?php if($query->is_insert!=0) echo 'checked' ?> > <label for="emailField"> is_Insert</label></br>
		                                    <input type='checkbox' name='is_delete' <?php if($query->is_delete!=0) echo 'checked' ?>> <label for="emailField"> is_Delete</label></br>
		                                    <input type='checkbox' name='is_update' <?php if($query->is_update!=0) echo 'checked' ?>> <label for="emailField"> is_Update</label></br>
		                                    <input type='checkbox' name='is_show' <?php if($query->is_read!=0) echo 'checked' ?>> <label for="emailField"> is_Read</label></br>
		                                    <input type='checkbox' name='is_print' <?php if($query->is_print!=0) echo 'checked' ?>> <label for="emailField"> is_Print</label></br>
		                                    <input type='checkbox' name='is_export' <?php if($query->is_export!=0) echo 'checked' ?>> <label for="emailField"> is_Export</label></br>
		                                    <input type='checkbox' name='is_import' <?php if($query->is_import!=0) echo 'checked' ?>> <label for="emailField"> is_Import</label></br>
		                                </fieldset>
		                            </td>
		                        </tr>
		                        <tr>
		                            <td><label for="emailField">Module Name</label></td>
		                            <td> : </td>
		                            <td><select class="form-control" id='cbomodule_as' name='cbomodule_as' onchange='filpage(event);'>
		                                    <option value='0'>Select Module</option>
		                                    <?php
														foreach ($this->pagepermis->getmodulebyrole($query->roleid) as $module_add) {?>
		                                    <option value='<?php echo $module_add->moduleid; ?>' <?php if($module_add->moduleid==$query->moduleid) echo 'selected';?> >
		                                        <?php echo $module_add->module_name ; ?>
		                                    </option>
		                                    <?php }
													?>
		                                </select>
		                            </td>
		                        </tr>
		                        <tr>
		                            <td><label for="emailField">Page Name</label></td>
		                            <td> : </td>
		                            <td class='control-group'>
		                                <select class="form-control" id='cbopage_as' name='cbopage_as' required data-parsley-required-message="Please Choose Page" min="1">
		                                    <?php $page=$this->page->getpagerow($query->pageid);?>
		                                    <option value='0'>Select Page</option>
		                                    <option value='<?php echo $page->pageid; ?>' selected>
		                                        <?php echo $page->page_name ; ?>
		                                    </option>
		                                    <button type="button" class="btn btn-danger" id='btncancel'>Cancel</button>
		                                </select>
		                            </td>
		                        </tr>
		                        <td></td>
		                        <td></td>
		                        <td colspan='2'>
		                            <input type='submit' class="btn btn-primary" name='btnsubmit' id='btnsubmit' value='Save Page'>
		                            <input type='reset' class="btn btn-warning" name='btnreset' id='btnreset'>
		                        </td>
		                        <td></td>
		                        <td></td>
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
<script type="text/javascript">
function PreviewImage() {
    var oFReader = new FileReader();
    oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);

    oFReader.onload = function(oFREvent) {
        document.getElementById("uploadPreview").src = oFREvent.target.result;
        document.getElementById("uploadPreview").style.backgroundImage = "none";
    };
};
$(function() {
    $('#defaultform').parsley();
})

function fillmodule(event) {
    var roleid = jQuery('#cborole_as').val();
    $.ajax({
        url: "<?php echo base_url(); ?>index.php/setting/permission/fillmodule",
        data: { 'roleid': roleid },
        type: "POST",
        success: function(data) {
            jQuery('#cbomodule_as').html(data);
            jQuery('#cbopage_as').html("");

        }
    });
}

function filpage(event) {
    var moduleid = jQuery('#cbomodule_as').val();
    $.ajax({
        url: "<?php echo base_url(); ?>index.php/setting/permission/fillpage",
        data: { 'moduleid': moduleid },
        type: "POST",
        success: function(data) {
            //alert(data);
            jQuery('#cbopage_as').html(data);
        }
    });
}
$(document).ready(function() {

    $('#btncancel').click(function() {
        var r = confirm("Are you sure to cancel !");
        if (r == true) {
            location.href = "<?PHP echo site_url('setting/permission/');?>";
        } else {

        }
    })

});
</script>