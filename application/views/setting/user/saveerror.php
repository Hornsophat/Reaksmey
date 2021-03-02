<div class="result_info">
			      	<div class="col-sm-6">
			      		<strong>USER INFORMATION</strong>
			      		
			      	</div>
			      	<div class="col-sm-6" style="text-align: center">
			      		<strong>
			      			<center style='color:red;'><?php echo $save->error; ?></center>
			      		</strong>	
			      	</div>
			      </div> 
<div class="row">
	<div class="col-sm-12">
	    <div class="panel panel-default">
	      	<div class="panel-body">
		        <div class="table-responsive" id="tab_print">
					<form enctype="multipart/form-data" accept-charset="utf-8" method='post' id="defaultform" action='<?php echo site_url('setting/user/saveuser');?>'>
						<table align='center' width="900">
							<tr>
								<td><label for="emailField">First Name</label></td>
								<td> : </td>
								<td><input  type='text' class="form-control" name='txtf_name' id='txtf_name' value="<?php echo $save->first_name; ?>" required data-parsley-required-message="Enter First Name" placeholder="your First name"/>
								</td>
								<td><label for="emailField">last name</label></td>
								<td> : </td>
								<td><input type='text' class="form-control" name='txtl_name' id='txtl_name' value="<?php echo $save->last_name; ?>" required data-parsley-required-message="Enter Last Name" placeholder="your Last name"/>
								</td>
								<td rowspan='4' style='border:0px solid #CCCCCC; text-align:center;'>
									<img src="<?php echo site_url('../upload/No_person.jpg') ?>" id="uploadPreview" style='width:120px; height:150px'>
									<input id="uploadImage" type="file" accept="image/gif, image/jpeg, image/jpg, image/png" name="userfile" onchange="PreviewImage();" style="visibility:hidden;" />
									<input type='button' class="btn btn-success" onclick="$('#uploadImage').click();" value='Browse'/>
									
								</td>
							</tr>
							<tr>
								<td><label for="emailField">User Name</label></td>
								<td> : </td>
								<td><input type='text' class="form-control" name='txtu_name' id='txtu_name' value="<?php echo $save->user_name; ?>" required data-parsley-required-message="Enter User Name" placeholder="your User name"/></td>
								<td><label for="emailField">Password</label></td>
								<td> : </td>
								<td><input type='password' class="form-control" name='txtpwd' id='txtpwd' required data-parsley-required-message="Enter Password" placeholder="your Password"/></td>
								
							</tr>
							<tr>
								<td><label for="emailField">Email address</label></td>
								<td> : </td>
								<td class='control-group'><input type='text' class="form-control" value="<?php echo $save->email; ?>" name='txtemail' id='txtemail' required data-parsley-required-message="Enter Email" placeholder="your Email Address"/></td>
								
								<td><label for="emailField">Role</label></td>
								<td> : </td>
								<td>
									<select name='cborole' id='cborole' class="form-control">
										<?php
										foreach ($this->role->getallrole() as $role_row) {?>
											<option value='<?php echo $role_row->roleid; ?>' <?php if($save->roleid==$role_row->roleid) echo 'selected';?>> <?php echo $role_row->role ; ?></option>
										<?php }
										?>
									</select>
								</td>
							</tr>
							<tr>
							<td><label for="emailField">School Level</label></td>
							<td>:</td>
							<td>
								<select  class="form-control months" multiple  name="schlevelid[]" id="schlevel" >
									<?php foreach ($this->db->get('sch_school_level')->result() as $schl) {
										echo "<option value='$schl->schlevelid'>$schl->sch_level</option>";
									} ?>
								</select>
							</td>
							<td></td>
							<td></td>
							<td></td>
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
		<div style='text-align:center; color:red;'></div>
		<hr/>
		
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
		$(document).ready(function() {
		
        });
	</script>