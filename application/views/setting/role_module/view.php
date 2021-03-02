<style type="text/css">
table {
    border-collapse: collapse;
    /*border:1px solid #CCCCCC;*/
}

td,
th {
    padding: 5px;
}

th {
    text-align: center;
}

#listbody tr td a img {
    height: 20px !important;
    border: none !important;
}

fieldset {
    border: 1px solid #CCCCCC;
    padding: 10px;
}

#pgt {
    border: solid 0px !important;
}

a {
    cursor: pointer;
}
</style>
<!-- 	*************************List all of user******************************* -->
<div class="container top">
	<div class="panel panel-default">
		<h3 align='center' class="text-muted">LIST ROLE MODULE</h3>
		<div class="row">
		    <div class="col-sm-12">
		        <div class="panel panel-default">
		            <div class="panel-body">
		                <div class="table-responsive" id="tab_print">
		                    <table align='center' id='listrole' width='970' class='table'>
		                        <thead>
		                            <th>No</th>
		                            <th class="col-sm-3">Role Name</th>
		                            <?php
									foreach ($this->module->getmodule() as $row) {
									 	echo "<th>$row->module_name</th>";
									 } 
									
									
									?>
		                            <th>Action</th>
		                        </thead>
		                        <tbody>
		                            <td></td>
		                            <td><input class='form-control input-sm' id='txts_role' type='text' onkeyup='search(event);' value="<?php if(isset($_GET['role'])) echo $_GET['role']; ?> " name='txts_fname' /></td>
		                            <td></td>
		                            <td></td>
		                            <td></td>
		                            <td></td>
		                            <td></td>
		                        </tbody>
		                        <tbody id='listbody'>
		                            <?php
								 $i=1;
									foreach ($query as $row) {
										echo "
											<tr>
												<td align='center'>$i</td>
												<td>$row->role</td>";
												foreach ($this->module->getmodule() as $rowmo) {
													
													if($this->role->getrolemodule($row->roleid,$rowmo->moduleid)>0) echo "<td align='center'><img src='".base_url('assets/images/checked.png')."'/></td>"; else echo "<td align='center'><img src='".base_url('assets/images/unchecked.png')."'/></td>";

												 } 
										   echo "<td align='center' style='white-space: nowrap;'><a><label rel='$row->roleid' onclick='deleterole(event);'>Delete</label></a>  | <a ><label  rel='$row->roleid' onclick='updaterole(event);'>Edit</label></a> | <a href='".base_url('setting/permission?roleid='.$row->roleid)."'><label>Permission</label></a></td>
											</tr>

										";# code...
										$i++;
									}
								?>
		                            <!-- <tr>
										<td colspan='12' id='pgt'><div style='text-align:center'><ul class='pagination' style='text-align:center'><?php echo $this->pagination->create_links(); ?></ul></div></td>
									</tr>  -->
		                            </tbody>
		                    </table>
		                </div>
		            </div>
		        </div>
		    </div>
		</div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function() {


})

function search(event) {

    var role = jQuery('#txts_role').val();
    $.ajax({
        url: "<?php echo base_url(); ?>index.php/setting/role/search",
        data: { 'role': role },
        type: "POST",
        success: function(data) {
            //alert(data);
            jQuery('#listbody').html(data);

        }
    });
}

function deleterole(event) {
    var r = confirm("Are you sure to delet this item !");
    if (r == true) {
        var role_id = jQuery(event.target).attr("rel");
        location.href = "<?PHP echo site_url('setting/role/delete');?>/" + role_id;
    } else {
        txt = "You pressed Cancel!";
    }

}

function updaterole(event) {
    var role_id = jQuery(event.target).attr("rel");
    location.href = "<?PHP echo site_url('setting/role/edit');?>/" + role_id;

}
</script>