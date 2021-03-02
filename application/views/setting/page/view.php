<style type="text/css">
table {
    border-collapse: collapse;
    /*border:1px solid #CCCCCC;*/
}

/*#listuser td,#listuser th{
			border:1px solid #CCCCCC;
			padding: 5px ;
		}*/
td,
th {
    padding: 5px;
}

#pgt {
    border: solid 0px !important;
}

#listbody tr td a img {
    height: 20px !important;
    border: none !important;
}

/*th{
				background-color: #383547; 
				text-align: center;
				color: white;
		}*/
a {
    cursor: pointer;
}
</style>
<!-- 	*************************List all of user******************************* -->
<div class="container top">
	<div class="panel panel-default">
		<h3 align='center' class="text-muted">LIST PAGE</h3>
		<div class="row">
		    <div class="col-sm-12">
		        <div class="panel panel-default">
		            <div class="panel-body">
		                <div class="table-responsive" id="tab_print">
		                    <table align='center' id='listuser' class='table'>
		                        <thead>
		                            <th>No</th>
		                            <th>Page_Name</th>
		                            <th>Page_Link </th>
		                            <th>Module</th>
		                            <th>Action Name</th>
		                            <!-- <th>B_insert</th>
									<th>B_Delete</th>
									<th>B_Update</th>
									<th>B_show</th>
									<th>B_print</th>
									<th>B_export</th> -->
		                            <th>Created_by</th>
		                            <th>Created_Date</th>
		                            <th width="130" colspan='2'>Action</th>
		                        </thead>
		                        <tbody>
		                            <td></td>
		                            <td><input class='form-control input-sm' id='txtsp_name' type='text' onkeyup='search(event);' value='<?Php if(isset($_GET[' p_name'])) echo $_GET['p_name'];?>' name='txts_fname'/></td>
		                            <td></td>
		                            <td>
		                                <select class="form-control input-sm" id='cbomodule_id' name='cbomodule_id' onchange='search(event);'>
		                                    <option value='0'>Select Module</option>
		                                    <?php
														$moduleid=0;
														if(isset($_GET['moduleid']))
															$moduleid=$_GET['moduleid'];
														foreach ($this->module->getmodule() as $role_row) {?>
		                                    <option value='<?php echo $role_row->moduleid; ?>' <?php if($role_row->moduleid==$moduleid) echo 'selected';?>>
		                                        <?php echo $role_row->module_name; ?>
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
		                        </tbody>
		                        <tbody id='listbody'>
		                            <?php
								 $i=1;
									foreach ($query as $row) {
										echo "
											<tr>
												<td align='center'>$i</td>
												<td>$row->page_name</td>
												<td>$row->link</td>
												<td>$row->module_name</td>
												<td>$row->action_name</td>
												<td>".date("d-m-Y", strtotime($row->created_date))."</td>
												<td align='center'><a ><img rel='$row->pageid' onclick='deletepage(event);' src='".base_url('assets/images/icons/delete.png')."'/></a></td><td> <a ><img rel='$row->pageid' onclick='updatepage(event);' src='".base_url('assets/images/icons/edit.png')."'/></a></td>
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
    var page_name = jQuery('#txtsp_name').val();
    var m_id = jQuery('#cbomodule_id').val();
    $.ajax({
        url: "<?php echo base_url(); ?>index.php/setting/page/search",
        data: { 'page_name': page_name, 'm_id': m_id },
        type: "POST",
        success: function(data) {
            //alert(data);
            jQuery('#listbody').html(data);

        }
    });
}

function deletepage(event) {
    var r = confirm("Are you sure to delet this item !");
    if (r == true) {
        var p_id = jQuery(event.target).attr("rel");
        location.href = "<?PHP echo site_url('setting/page/delete');?>/" + p_id;
    } else {
        txt = "You pressed Cancel!";
    }

}

function updatepage(event) {
    var p_id = jQuery(event.target).attr("rel");
    location.href = "<?PHP echo site_url('setting/page/edit');?>/" + p_id;

}
</script>