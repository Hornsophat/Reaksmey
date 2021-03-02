<!DOCTYPE html> 
<html lang="en-US">
  <head>
    <title>Hotel Management System</title>
    <meta charset="utf-8">
    <link href="<?php echo base_url(); ?>assets/css/admin/global.css" rel="stylesheet" type="text/css">
  </head>
  <body>
    <div style="background-image: url(<?php echo base_url(); ?>assets/images/palm_river.jpg);  background-repeat: no-repeat, repeat;">
      <div class="container login">
        <?php 
        $attributes = array('class' => 'form-signin');
        echo form_open('admin/login/validate_credentials', $attributes);
        echo '<h2 class="form-signin-heading"><span class="glyphicon glyphicon-lock"></span> Login</h2>';
        echo form_input('user_name', '', 'placeholder="Username" class = "form-control input-sm"');
        echo form_password('password', '', 'placeholder="Password" class = "form-control input-sm"');
        $options_langugage = array('english' => 'English' , 'khmer' => 'Khmer','persian'=>'Persian' );
        echo form_dropdown('language', $options_langugage, 'Khmer' ,' class="form-control" ');
        
        echo "<br/>";

        if(isset($message_error) && $message_error){
            echo '<div class="alert alert-error">';
              echo '<a class="close" data-dismiss="alert">×</a>';
              echo '<strong>Oh snap!</strong> Change a few things up and try submitting again.';
            echo '</div>';             
        }
        echo form_submit('submit', 'Login', 'class="btn btn-large btn-danger"');
        echo form_close();
        ?>      
      </div>
    </div>
    <!--container-->
    <script src="<?php echo base_url(); ?>assets/js/jquery-1.7.1.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
  </body>
</html>  