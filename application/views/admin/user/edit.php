    <div class="container top">
      
      <ul class="breadcrumb">
        <li>
          <a href="<?php echo site_url("admin"); ?>">
            <?php echo ucfirst($this->uri->segment(1));?>
          </a> 
        </li>
        <li>
          <a href="<?php echo site_url("admin").'/'.$this->uri->segment(2); ?>">
            <?php echo ucfirst($this->uri->segment(2));?>
          </a> 
        </li>
        <li class="active">
          <a href="#">New</a>
        </li>
      </ul>
      
      <div class="page-header">
        <h2>
          Adding <?php echo ucfirst($this->uri->segment(2));?>
        </h2>
      </div>

      <?php
      //flash messages
      if(isset($flash_message)){
        if($flash_message == TRUE)
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> New User Success add to database';
          echo '</div>';       
        }else{
          echo '<div class="alert alert-error">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Oh snap!</strong> change a few things up and try submitting again.';
          echo '</div>';          
        }
      }
      ?>
      
      <?php
      //form data
      $attributes = array('class' => 'form-horizontal', 'id' => 'contact_form', 'name' => 'contact_form');

      //form validation
      echo validation_errors();
      
      echo form_open('admin/user/save_edit', $attributes);
      ?>
        <fieldset>
        
        <div class="row">
        
     <div class="col-md-3 hide">
	  <div class="control-group">
            <label for="inputError" class="control-label">User Id</label>         
            <div class="controls">
              <input type="text" id="uid" class="form-control input-sm" name="uid" value="<?php if(isset($x->id)) echo $x->id;?>" >
            </div>
          </div>
         </div>

	 <div class="col-md-3">
	  <div class="control-group">
            <label for="inputError" class="control-label">First Name</label>         
            <div class="controls">
              <input type="text" id="fname" class="form-control input-sm" name="fname" value="<?php if(isset($x->first_name)) echo $x->first_name;?>" >
            </div>
          </div>
         </div>

	 <div class="col-md-3">
	  <div class="control-group">
            <label for="inputError" class="control-label">Last Name</label>         
            <div class="controls">
              <input type="text" id="lname" class="form-control input-sm" name="lname" value="<?php if(isset($x->last_name)) echo $x->last_name;?>" >
            </div>
          </div>
         </div> 
         
	 <div class="col-md-3">
	  <div class="control-group">
            <label for="inputError" class="control-label">UserName</label>         
            <div class="controls">
              <input type="text" id="username" class="form-control input-sm" name="username" value="<?php if(isset($x->user_name)) echo $x->user_name;?>" >
            </div>
          </div>
         </div>          
         
	 <div class="col-md-3">
	  <div class="control-group">
            <label for="inputError" class="control-label">Email Address</label>         
            <div class="controls">
              <input type="text" id="email" class="form-control input-sm" name="email" value="<?php if(isset($x->email_addres)) echo $x->email_addres;?>" >
            </div>
          </div>
         </div> 

         <div class="col-md-3">
    <div class="control-group">
            <label for="inputError" class="control-label">Password</label>         
            <div class="controls">
              <input type="password" id="password" class="form-control input-sm" name="password" value="<?php echo set_value('credit_card'); ?>" >
            </div>
          </div>
         </div>  

         <div class="col-md-3">
	  <div class="control-group">
            <label for="inputError" class="control-label">Confirm Password</label>         
            <div class="controls">
              <input type="password" id="confirmpassword" class="form-control input-sm" name="confirmpassword" value="<?php echo set_value('Mobile'); ?>" >
            </div>
          </div>
         </div>

         <div class="col-md-3">
          <div class="control-group">
            <label>user Type</label>
            <div class="controls">
              <select name="user_type" class="form-control">
                <option>select user type</option>
                <?php 
                  foreach ($user_type as  $value){
                      $sel = '';
                      if($value->roleid == $x->type){
                          $sel = 'selected';
                      }
                      echo '<option value="'.$value->roleid.'" '.$sel.'>'.$value->role.'</option>';
                    }
                  ?>
              </select>
            </div>
          </div>
        </div>
          
         
       </div>
     
        <br />
          
          <div class="form-actions">
            <button class="btn btn-sm btn-primary" type="submit">Save changes</button>
            <button class="btn btn-sm" type="reset">Cancel</button>
          </div>
        </fieldset>

      <?php echo form_close(); ?>

    </div>
     





<script type="text/javascript">
      $(document).ready(function() {
    $('#contact_form').bootstrapValidator({
        // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            password: {
                validators: {
                    identical: {
                    	field: 'confirmpassword',
                    	messages: 'The password and its confirm are not the same'
                    }
                }
            },
            confirmpassword:{
            	validators:{
            		identical: {
            			field: 'password',
            			messages: 'The password and its confirm are not the same'
            		}
            	}
            }
           
        }
    });
});


  </script>