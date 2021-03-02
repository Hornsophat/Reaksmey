<style type="text/css">
    .pointer{
      cursor: pointer;
    }
</style>

    
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
            echo '<a class="close" data-dismiss="alert">Ã</a>';
            if(isset($id))
        {
              echo '<strong>Well done!</strong> Update Item Success add to database';
            }else{
              echo '<strong>Well done!</strong> New Item Success add to database';
            }
          echo '</div>';       
        }else{
          echo '<div class="alert alert-error">';
            echo '<a class="close" data-dismiss="alert">Ã</a>';
            echo '<strong>Oh snap!</strong> change a few things up and try submitting again.';
          echo '</div>';          
        }
      }
      ?>
      

        



 <?php 
     foreach ($check_detail as $in) {
    }
?>
<?php
  //form data
  $attributes = array('class' => 'form-horizontal', 'id' => 'additem', 'name', 'additem');

  //form validation
  $id=$in->detail_id;
  echo validation_errors();
  if(isset($x->pid))
  {
    echo form_open('item/update', $attributes); 
  }else{
    echo form_open('admin_checkin/update_checkin/'.$id); 
  }
  
?>
<fieldset>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">Item</div>
                <div class="panel-body">
                    <div class="row">
                      <div class="col-md-4 hide">
                            <div class="form-group">
                                <label for="inputError" class="control-label">Item ID</label>
                                <div class="col-sm-12">
                                    <input class="form-control input-sm itemid" type="text" id="itemid" name="itemid" value="<?php if(isset($x->pid)) echo $x->pid?>">
                                </div>
                            </div>
                        </div>
                       
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="inputError" class="control-label">Room Number</label>
                                <div class="col-sm-12">
                                    <input readonly="" class="form-control input-sm itemname" type="text" id="room_no" name="room_no" value="<?php  echo $in->room_no?>">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="inputError" class="control-label">Refun Amount</label>
                                <div class="col-sm-12">
                                    <input required="" class="form-control input-sm price" type="text" id="re_amount" name="re_amount"  value="<?php if(isset($x->price)) echo $x->price?>">  <!-- onkeypress="return isNumberKey(event)" -->
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="inputError" class="control-label">Date Out</label>
                                <div class="col-sm-12">
                                   <input readonly="" class="dtpicker form-control input-sm" type="text" id="date_out" name="date_out" value="<?php echo date('Y-m-d') ?>" >
                                </div>
                            </div>
                        </div>

            </div><br>
            <div class="form-actions col-sm-12 form-horizontal">
                          <button class="btn btn-sm btn-primary btn_add_item">Save Item</button>
                          <button class="btn btn-sm" type="reset">Cancel</button>
                      </div>

                </div>
            </div>
        </div>

    </div>
    <!-- End Row two -->
   
</fieldset>
<?php echo form_close(); ?>


</div>
<script>
  function isNumberKey(evt){
      var charCode = (evt.which) ? evt.which : event.keyCode
      if (charCode > 31 && (charCode < 48 || charCode > 57))
          return false;
      return true;
  }

</script>