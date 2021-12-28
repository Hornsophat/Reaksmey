<?php $schoolid = $this->session->userdata('schoolid'); ?>
<div class="result_info">
			      	<div class="col-sm-6">
			      		<strong>USER INFORMATION</strong>
			      		
			      	</div>
			      	<div class="col-sm-6" style="text-align: center">
			      		<strong>
			      			<center style='color:red;'>
			      				<?php if(isset($error->error))
									echo $error->error;?>
							</center>
			      		</strong>	
			      	</div>
</div> 
<?php
	$dash= array('Full'=>'/system/dashboard',
				'Socail'=>'system/dashboard/view_soc/',
				'Health'=>'/system/dashboard/view_health/',
				'Employee'=>'/system/dashboard/view_staff',
				'Student'=>'/system/dashboard/view_std/');
?>
<style type="text/css">
	tr ul{display: none !important;}
</style>

<div class="row">
	<div class="col-sm-12">
	    <div class="panel panel-default">
	      	<div class="panel-body">
		        <div class="table-responsive" id="tab_print">
						<form enctype="multipart/form-data" accept-charset="utf-8" method='post' id="defaultform" action='<?php echo site_url('setting/user/update');?>'>
							<input type="hidden" id="h_userid" value="<?= $query->userid ?>">
							<input type='text' id='txtuserid' style='display:none;' name='txtuserid' value="<?php echo $query->userid;?>">
							<table align='center' width="900">
								<tr>
									<td><label for="emailField">First Name</label></td>
									<td> : </td>
									<td><input  type='text' class="form-control" name='txtf_name' value="<?php echo $query->first_name;?>" id='txtf_name' required data-parsley-required-message="Enter First Name" placeholder="your First name"/>
									</td>
									<td><label for="emailField">last name</label></td>
									<td> : </td>
									<td><input type='text' class="form-control" name='txtl_name' value="<?php echo $query->last_name;?>" id='txtl_name' required data-parsley-required-message="Enter Last Name" placeholder="your Last name"/>
									</td>
									<td rowspan='4' style='border:0px solid #CCCCCC; text-align:center; width:200px'>
										<img src="<?php if(@ file_get_contents(site_url('../assets/upload/'.$query->userid.'.png'))) echo site_url('../assets/upload/'.$query->userid.'.png'); else echo site_url('../assets/upload/No_person.jpg') ?>" id="uploadPreview" style='width:120px; height:150px; margin-bottom:15px'>
										<input id="uploadImage" type="file" accept="image/gif, image/jpeg, image/jpg, image/png" name="userfile" onchange="PreviewImage();" style="visibility:hidden; display:none;" />
										<input type='button' class="btn btn-success" onclick="$('#uploadImage').click();" value='Browse'/>
									</td>
								</tr>
								<tr>
									<td><label for="emailField">User Name</label></td>
									<td> : </td>
									<td><input type='text' class="form-control" name='txtu_name' value="<?php echo $query->user_name;?>" id='txtu_name' required data-parsley-required-message="Enter User Name" placeholder="your User name"/></td>
									<td><label for="emailField">Password</label></td>
									<td> : </td>
									<td><input type='password' class="form-control" name='txtpwd' id='txtpwd' value="<?php echo $query->password;?>" required data-parsley-required-message="Enter Password" placeholder="your Password"/></td>

								</tr>
								<tr>
									<td><label for="emailField">Email address</label></td>
									<td> : </td>
									<td class='control-group'><input type='text' class="form-control" value="<?php echo $query->email;?>" name='txtemail' id='txtemail' required data-parsley-required-message="Enter Email" placeholder="your Email Address"/></td>
									<td><label for="emailField">Role</label></td>
									<td> : </td>
									<td>
										<select name='cborole' id='cborole' class="form-control">
											<?php
											foreach ($this->role->getallrole() as $role_row) {?>
												<option value='<?php echo $role_row->roleid; ?>' <?php if($query->roleid==$role_row->roleid) echo 'selected';?>> <?php echo $role_row->role ; ?></option>
											<?php }
											?>
										</select>
									</td>
									
								</tr>
								<tr class="<?= $query->roleid != 38 ? '': '' ?>" id="show_teacher">
									<td><label for="emailField">Select Teacher</label></td>
									<td> : </td>
									<td colspan="4">
										<select style="width: 100%; height: 30px !important" name='emp_id' id='emp_id' class="form-control">
											<option value="">Select match teacher</option>
											<?php foreach ($teachers as $teacher): ?>
												<option <?= $query->emp_id == $teacher->empid ? 'selected' : '' ?> value="<?= $teacher->empid ?>"><?= $teacher->first_name ." ". $teacher->last_name ." (". $teacher->empcode .")" ?></option>
											<?php endforeach ?>
										</select>
									</td>
								</tr>
								<tr>
									<td><label for="emailField">Year</label></td>
									<td> : </td>
									<td>
										<select  class="form-control months"  name="yearid" id="yearid" >
											<?php foreach ($this->branch->getYear() as $sRow) {
												$sSelect = $schoolid == $sRow->schoolid ? "selected" : "";
												echo "<option value='$sRow->yearid' $sSelect>$sRow->sch_year</option>";
											} ?>
										</select>
									</td>
									
									<td><label for="emailField">Dashboard</label></td>
									<td>:</td>
									<td>
										<select  class="form-control months"  name="dashboard" id="dashboard" >
											<?php foreach ($dash as $key => $value) {
												$dSelect = $query->def_dashboard == $value ? "selected" : "";
												echo "<option value='$value' $dSelect>$key</option>";
											} ?>
										</select>
									</td>
								</tr>
								<tr>
									<td><label for="emailField">School</label></td>
									<td> : </td>
									<td>
										<select  class="form-control months"  name="schoolid[]" id="schoolid" multiple>
											<?php foreach ($this->branch->getSchool() as $sRow) {
												$q = $this->db->where('userid', $query->userid)->get('sch_user_school')->result();
												$sSelect = "";
												foreach($q as $r) {
													if($r->schoolid == $sRow->schoolid) {
														$sSelect = "selected";
													}
												}
												
												echo "<option value='$sRow->schoolid' $sSelect>$sRow->name</option>";
											} ?>
										</select>
									</td>
									<td><label for="emailField">School Level</label></td>
									<td>:</td>
									<td>
										<select  class="form-control months" multiple  name="schlevelid[]" id="schlevel" >
											
										</select>
									</td>
								</tr>
								<tr>
									
									<td><label for="emailField">Counter: </label></td>
									<td>:</td>
									<td>
										<select  class="form-control months"  name="counter_id" id="counter_id" >
											<option value="">Select Counter</option>}
											
											<?php 
											$counters = $this->db->get('sch_school_food_counter')->result();
											foreach ($counters as $c) {
												$select = $query->counter_id == $c->counter_id ? "selected" : "";
												echo "<option value='$c->counter_id' $select>$c->counter_no</option>";
											} ?>
										</select>
									</td>
									
								</tr>
								<tr>
									<td></td>
									<td></td>
									<td colspan='2'>
										<input type='submit' class="btn btn-primary" name='btnsubmit' id='btnsubmit' value='Save User'>
										<input type='reset' class="btn btn-warning" name='btnreset' id='btnreset'>
										<button type="button" class="btn btn-danger" id='btncancel'>Cancel</button>
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
		
		<script type="text/javascript">
		function PreviewImage() {
		        var oFReader = new FileReader();
		        oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);

		        oFReader.onload = function (oFREvent) {
		            document.getElementById("uploadPreview").src = oFREvent.target.result;
		            document.getElementById("uploadPreview").style.backgroundImage = "none";
		        };
		    };
		    $(function(){
				$('#defaultform').parsley();				
			})
			$("#show_teacher #emp_id").select2();

		$(document).ready(function() {
			
			$('#btncancel').click(function(){
				var r = confirm("Are you sure to cancel !");
				if (r == true) {
					location.href="<?PHP echo site_url('setting/user/');?>";
				} else {
				   
				}
			})

			$("#yearid").change(function(){
				$("#schoolid").change();
			});

			$("#schoolid").change(function(){
				var yearid = $("#yearid").val();
				var schools = $("#schoolid").val();
				var schoolid = schools.join();
				var userid = $("#h_userid").val();
				$.ajax({
					url:"<?php echo base_url(); ?>index.php/branch_school/getSchoolLevel",    
					data: {
						'schoolid':schoolid,
						'yearid': yearid,
						'userid': userid
					},
					type:"post",
					dataType:"html",
					async:false,
					success: function(data){
						$("#schlevel").html(data);
					}
				});
				
			});

			function changeSchlvl() {
				var yearid = $("#yearid").val();
				var schools = $("#schoolid").val();
				var schoolid = schools.join();
				var userid = <?= $query->userid ?>;
				//alert(userid);
				$.ajax({
					url:"<?php echo base_url(); ?>index.php/branch_school/getSchoolLevel",    
					data: {
						'schoolid':schoolid,
						'userid': userid,
						'yearid': yearid
					},
					type:"post",
					dataType:"html",
					async:false,
					success: function(data){
						$("#schlevel").html(data);
					}
				});
			}

			changeSchlvl();

			$("#cborole").change(function() {
				var roleid = $(this).val();
				// If it is a teacher role id
				if(roleid == 38) {
					$("#show_teacher").removeClass("hide");
					$("#show_teacher #emp_id").attr("required", true);
				} else {
					$("#show_teacher").addClass("hide");
					$("#show_teacher #emp_id").attr('required', false);
					$("#show_teacher #emp_id").val('0');
				}
			});
			
       });
	</script>