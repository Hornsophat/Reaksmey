<style type="text/css">
table {
    border-collapse: collapse;
    /*border:1px solid #CCCCCC;*/
}

td,
th {
    padding: 5px;
}

#listbody tr td a img {
    height: 20px !important;
    border: none !important;
}

#pgt {
    border: solid 0px !important;
}

th {

    text-align: center;
}

a {
    cursor: pointer;
}
</style>
<div class="container top">
	<div class="panel panel-default">
		<h3 align='center' class="text-muted">PAGE PERMISSION LIST</h3>
		<div class="row">
		    <div class="col-sm-12">
		        <div class="panel panel-default">
		            <div class="panel-body">
		                <div class="table-responsive" id="tab_print">
		                    <table align='center' id='listuser' class='table'>
		                        <thead>
		                            <th>No</th>
		                            <th>Role</th>
		                            <th>Page</th>
		                            <th>Created_by</th>
		                            <th>Created_Date</th>
		                            <th>is_insert</th>
		                            <th>is_Delete</th>
		                            <th>is_Update</th>
		                            <th>is_Read</th>
		                            <th>is_print</th>
		                            <th>is_export</th>
		                            <th>is_import</th>
		                            <th colspan='2'>Action</th>
		                        </thead>
		                        <tbody>
		                            <td></td>
		                            <td>
		                                <select class="form-control input-sm" id='cboroleid' name='cboroleid' onchange='search(event);'>
		                                    <option value='0'>Select Role</option>
		                                    <?php
															$roleid=0;
															if(isset($_GET['role_id']))
																$roleid=$_GET['role_id'];
															foreach ($this->role->getallrole() as $role_row) {?>
		                                    <option value='<?php echo $role_row->roleid; ?>' <?PHP if($role_row->roleid==$roleid) echo "selected";?>>
		                                        <?php echo $role_row->role; ?>
		                                    </option>
		                                    <?php }
														?>
		                                </select>
		                            </td>
		                            <td>
		                                <select class="form-control input-sm" id='cbopageid' name='cbopageid' onchange='search(event);'>
		                                    <option value='0'>Select Page</option>
		                                    <?php
															$pageid=0;
															if(isset($_GET['pageid']))
																$roleid=$_GET['pageid'];
															foreach ($this->page->getallpage() as $page_row) {?>
		                                    <option value='<?php echo $page_row->pageid; ?>' <?PHP if($page_row->pageid==$pageid) echo "selected";?>>
		                                        <?php echo $page_row->page_name; ?>
		                                    </option>
		                                    <?php }
														?>
		                                </select>
		                            </td>
		                            <td></td>
		                            <td></td>
		                            <td></td>
		                            <td></td>
		                            <td></td>
		                            <td></td>
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
													<td>$row->role</td>
													<td>$row->page_name</td>
													<td>$row->created_by</td>
													<td>".date("d-m-Y", strtotime($row->created_date))."</td>
													<td align='center'>";if($row->is_insert>0) echo "<img src='".base_url('assets/images/checked.png')."'/></td>"; else echo "<img src='".base_url('assets/images/unchecked.png')."'/></td>";
													echo "<td align='center'>";if($row->is_delete>0) echo "<img src='".base_url('assets/images/checked.png')."'/></td>"; else echo "<img src='".base_url('assets/images/unchecked.png')."'/></td>";
													echo "<td align='center'>";if($row->is_update>0) echo "<img src='".base_url('assets/images/checked.png')."'/></td>"; else echo "<img src='".base_url('assets/images/unchecked.png')."'/></td>";
													echo "<td align='center'>";if($row->is_read>0) echo "<img src='".base_url('assets/images/checked.png')."'/></td>"; else echo "<img src='".base_url('assets/images/unchecked.png')."'/></td>";
													echo "<td align='center'>";if($row->is_print>0) echo "<img src='".base_url('assets/images/checked.png')."'/></td>"; else echo "<img src='".base_url('assets/images/unchecked.png')."'/></td>";
													echo "<td align='center'>";if($row->is_export>0) echo "<img src='".base_url('assets/images/checked.png')."'/></td>"; else echo "<img src='".base_url('assets/images/unchecked.png')."'/></td>";
													echo "<td align='center'>";if($row->is_import>0) echo "<img src='".base_url('assets/images/checked.png')."'/></td>"; else echo "<img src='".base_url('assets/images/unchecked.png')."'/></td>";
													echo "<td align='center'><a><img  rel='$row->role_page_id' onclick='deletepermission(event);' src='".base_url('assets/images/icons/delete.png')."'/></a></td><td align='center'> <a ><img rel='$row->role_page_id' onclick='updatepermission(event);' src='".site_url('../assets/images/icons/edit.png')."'/></a></td>
												</tr>

											";# code...
											$i++;
										}
									?>
		                            <tr>
		                                <td colspan='12' id='pgt'>
		                                    <div style='text-align:center'>
		                                        <ul class='pagination' style='text-align:center'>
		                                            <?php echo $this->pagination->create_links(); ?>
		                                        </ul>
		                                    </div>
		                                </td>
		                            </tr>
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
function search(event) {
    var role_id = jQuery('#cboroleid').val();
    var page_id = jQuery('#cbopageid').val();
    $.ajax({
        url: "<?php echo base_url(); ?>index.php/setting/permission/search",
        data: { 'role_id': role_id, 'page_id': page_id },
        type: "POST",
        success: function(data) {
            //alert(data);
            jQuery('#listbody').html(data);

        }
    });
}

function deletepermission(event) {
    var r = confirm("Are you sure to delet this item !");
    if (r == true) {
        var p_id = jQuery(event.target).attr("rel");
        location.href = "<?PHP echo site_url('setting/permission/delete');?>/" + p_id;
    } else {
        txt = "You pressed Cancel!";
    }

}

function updatepermission(event) {
    var p_id = jQuery(event.target).attr("rel");
    location.href = "<?PHP echo site_url('setting/permission/edit');?>/" + p_id;

}
</script>