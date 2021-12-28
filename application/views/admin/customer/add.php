    
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
  <form action="ins-form" method="post" enctype="multipart/form-data" >
                                <div class="col-md-12 mt-4">
                                    <div class="form-group">
                                        <h5>Upload Contract in pdf</h5>
                                        <hr>
                                    </div>
                                </div>
                                <div class="col-lg-6 form-group d-lg-flex align-items-center">
                                    <label for="profile" class="control-label col-lg-3 p-0">pdf : </label>
                                    <div class="col-lg-9 p-0">
                                        <input type="file" name="pdffile" class="form-control" value="123" accept=".jpg,.jpeg,.png,.pdf">
                                    </div>
                                </div>
                                </form>
  <div class="page-header">
    <h2>Adding <?php echo ucfirst($this->uri->segment(2));?></h2>
  </div>

  <?php
  //flash messages
  if(isset($flash_message)) {
    if($flash_message == TRUE) {
      echo '<div class="alert alert-success">';
        echo '<a class="close" data-dismiss="alert">×</a>';
        echo '<strong>Well done!</strong> New Customer Success add to database';
      echo '</div>';       
    } else {
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
  
  echo form_open('admin/customer/add', $attributes);
  ?>
  <fieldset>        
    <div class="row">
      <div class="col-md-3 hide">
        <div class="control-group">
          <label for="inputError" class="control-label">Customer Name</label>         
          <div class="controls">
            <input type="text" id="Name" class="form-control" name="Name" value="<?php echo set_value('Name'); ?>" >
          </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="control-group">
          <label for="inputError" class="control-label">Customer Name</label>         
          <div class="controls">
            <input type="text" id="Family" class="form-control" name="Family" value="<?php echo set_value('Family'); ?>" >
          </div>
        </div>
      </div> 
         
      <div class="col-md-3">
        <div class="control-group">
          <label for="inputError" class="control-label">Age</label>         
          <div class="controls">
            <input type="number" id="" class="form-control" name="Age" value="<?php echo set_value('Age'); ?>" >
          </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="control-group">
          <label for="inputError" class="control-label">Gender</label>
          <div class="controls">
            <select name="Gender" id="Gender" class="form-control">
              <option value=""> select </option>
              <option value="male">Male</option>
              <option value="female">Female</option>
            </select>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-3">
        <div class="control-group">
          <label for="inputError" class="control-label">Passport / ID Card</label>         
          <div class="controls">
            <input type="text" id="Passport" class="form-control" name="Passport" value="<?php echo set_value('Passport'); ?>" >
          </div>
        </div>
      </div> 

      <div class="col-md-3">
        <div class="control-group">
          <label for="inputError" class="control-label">Credit Card</label>         
          <div class="controls">
            <input type="text" id="credit_card" class="form-control" name="credit_card" value="<?php echo set_value('credit_card'); ?>" >
          </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="control-group">
          <label for="inputError" class="control-label">Mobile</label>         
          <div class="controls">
            <input type="text" id="Mobile" class="form-control" name="Mobile" value="<?php echo set_value('Mobile'); ?>" >
          </div>
        </div>
      </div>
    </div>
       
    <div class="row">
      
         
      <div class="col-md-3">
        <div class="control-group">
          <label for="inputError" class="control-label">Country</label>         
          <div class="controls">
            <input type="text" id="" class="form-control" name="Country" value="<?php echo set_value('Country'); ?>" >
          </div>
        </div>
      </div>          
         
      <div class="col-md-3">
        <div class="control-group">
          <label for="inputError" class="control-label">Nationality</label>         
          <div class="controls">
            <input type="text" id="" class="form-control" name="Nationality" value="<?php echo set_value('Nationality'); ?>" >
          </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="control-group">
          <label for="inputError" class="control-label">City</label>         
          <div class="controls">
            <input type="text" id="" class="form-control" name="City" value="<?php echo set_value('City'); ?>" >
          </div>
        </div>
      </div>
    </div>
       
    <div class="row">
      <div class="col-md-3">
        <div class="control-group">
          <label for="inputError" class="control-label">Company</label>         
          <div class="controls">
            <input type="text" id="" class="form-control" name="Company" value="<?php echo set_value('Company'); ?>" >
          </div>
        </div>
      </div> 
         
      <div class="col-md-3">
        <div class="control-group">
          <label for="inputError" class="control-label">Address</label>         
          <div class="controls">
            <textarea type="text" id="" class="form-control" name="Adress" value="<?php echo set_value('Adress'); ?>" ></textarea>
          </div>
        </div>
      </div>

      <div class="col-sm-3">
        <div class="control-group">
          <label for="inputError" class="control-label">Note</label>         
          <div class="controls">
            <textarea type="text" id="" class="form-control" name="Note" value="<?php echo set_value('Note'); ?>" ></textarea>
          </div>
        </div>
      </div>
    </div>
          
    <div class="form-actions" style="margin-top:20px;">
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
        // Name: {
        //   validators: {
        //     stringLength: {
        //       min: 2,
        //     },
        //       notEmpty: {
        //       message: 'Please supply your First name'
        //     }
        //   }
        // },
        Family: {
          validators: {
            stringLength: {
              min: 2,
            },
            notEmpty: {
              message: 'Please supply your Customer Name'
            }
          }
        },
        // Passport: {
        //   validators: {
        //     stringLength: {
        //       min: 6,
        //     },
        //     notEmpty: {
        //       message: 'Please supply your Passport'
        //     }
        //   }
        // },
        // credit_card: {
        //   validators: {
        //     stringLength: {
        //       min: 8,
        //     },
        //     notEmpty: {
        //       message: 'Please supply your Cradit_card'
        //     }
        //   }s
        // },
        Mobile: {
          validators: {
            stringLength: {
              min: 8,
            },
            notEmpty: {
              message: 'Please supply your Mobile'
            }
          }
        },
      }
    });
  });
</script>