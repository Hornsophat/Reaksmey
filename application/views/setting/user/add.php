<?php $schoolid = $this->session->userdata('schoolid'); ?>
<div class="row result_info">
		      	<div class="col-xs-6">
		      		<strong>USER INFORMATION</strong>
		      	</div>
</div>
<?php
	$dash= array('Full'=>'/system/dashboard',
				'Socail'=>'system/dashboard/view_soc',
				'Health'=>'/system/dashboard/view_health',
				'Employee'=>'/system/dashboard/view_staff',
				'Student'=>'/system/dashboard/view_std');
?>
<style type="text/css">
	tr ul{display: none !important;}
</style>
<div class="row">
	<div class="col-sm-12">
	    <div class="panel panel-default">
	      	<div class="panel-body">
		        <div class="table-responsive" id="tab_print">
				<form  enctype="multipart/form-data" accept-charset="utf-8" method="post" id="defaultform" action='<?php echo site_url('setting/user/saveuser');?>'>
					<table align='center' width="900">
						<tr>
							<td><label for="emailField">First Name</label></td>
							<td> : </td>
							<td><input  type='text' class="form-control" name='txtf_name' id='txtf_name' required data-parsley-required-message="Enter First Name" placeholder="your First name"/>
							</td>
							<td><label for="emailField">last name</label></td>
							<td> : </td>
							<td><input type='text' class="form-control" name='txtl_name' id='txtl_name' required data-parsley-required-message="Enter Last Name" placeholder="your Last name"/>
							</td>
							<td rowspan='4' style='border:0px solid #CCCCCC; text-align:center; width:200px'>
								<img src="<?php echo site_url('../assets/upload/No_person.jpg') ?>" id="uploadPreview" style='width:120px; height:150px; margin-bottom:15px'>
								<input id="uploadImage" accept="image/gif, image/jpeg, image/jpg, image/png" type="file" name="userfile" onchange="PreviewImage();" style="visibility:hidden; display:none" />
								<input type='button' class="btn btn-success" onclick="$('#uploadImage').click();" value='Browse'/>
								
							</td>
						</tr>
						<tr>
							<td><label for="emailField">User Name</label></td>
							<td> : </td>
							<td><input type='text' class="form-control" name='txtu_name' id='txtu_name' required data-parsley-required-message="Enter User Name" placeholder="your User name"/></td>
							<td><label for="emailField">Password</label></td>
							<td> : </td>
							<td><input type='password' class="form-control" name='txtpwd' id='txtpwd' required data-parsley-required-message="Enter Password" placeholder="your Password"/></td>
							
						</tr>
						<tr>
							<td><label for="emailField">Email address</label></td>
							<td> : </td>
							<td class='control-group'><input type='text' class="form-control" name='txtemail' id='txtemail' required data-parsley-required-message="Enter Email" placeholder="your Email Address"/></td>
							
							<td><label >Role</label></td>
							<td> : </td>
							<td>
								<select name='cborole' id='cborole' class="form-control">
									<?php
									foreach ($this->role->getallrole() as $role_row) {
										echo "<option value='$role_row->roleid'>$role_row->role</option>";
									}
									?>
								</select>
							</td>
						</tr>
						<tr class="hide" id="show_teacher">
							<td><label for="emailField">Select Teacher</label></td>
							<td> : </td>
							<td colspan="4">
								<select style="width: 100%; height: 30px !important" name='emp_id' id='emp_id' class="form-control">
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
										echo "<option value='$value'>$key</option>";
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
										$sSelect = $schoolid == $sRow->schoolid ? "selected" : "";
										echo "<option value='$sRow->schoolid' $sSelect>$sRow->name</option>";
									} ?>
								</select>
							</td>
							<td><label>School Level</label></td>
							<td>:</td>
							<td>
								<select  class="form-control months" multiple  name="schlevelid[]" id="schlevel" >
									<?php foreach ($this->branch->getSchoolLevel($schoolid) as $schl) {
										echo "<option value='$schl->schlevelid'>$schl->sch_level</option>";
									} ?>
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
										echo "<option value='$c->counter_id'>$c->counter_no</option>";
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
			$("#yearid").change(function(){
				$("#schoolid").change();
			});
			$("#schoolid").change(function(){
				//alert("schoolid change");
				var schools = $("#schoolid").val();
				var yearid = $("#yearid").val();
				var schoolid = schools.join();
				//alert(schoolid);
				$.ajax({
					url:"<?php echo base_url(); ?>index.php/branch_school/getSchoolLevel",    
					data: {
						'schoolid':schoolid,
						'yearid':yearid,
					},
					type:"post",
					dataType:"html",
					async:false,
					success: function(data){
						//alert(data);
						$("#schlevel").html(data);
					}
				});
				
			});

			$("#show_teacher #emp_id").select2();
			$("#cborole").change(function() {
				var roleid = $(this).val();
				// If it is a teacher role id
				if(roleid == 38) {
					$("#show_teacher").removeClass("hide");
					$.ajax({
						url: "<?= base_url('index.php/setting/user/getTeacher') ?>",
						type: "get",
						contentType: "html",
						async: false,
						success: function(data) {
							$("#show_teacher #emp_id").html(data);
							$("#show_teacher #emp_id").attr("required", true);
						}
					});
				} else {
					$("#show_teacher").addClass("hide");
					$("#show_teacher #emp_id").attr('required', false);
				}
			});

		</script>