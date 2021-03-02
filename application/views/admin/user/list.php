    <div class="container top">

      <ul class="breadcrumb">
        <li>
          <a href="<?php echo site_url("admin"); ?>">
            <?php echo ucfirst($this->uri->segment(1));?>
          </a> 
        </li>
        <li class="active">
          <?php echo ucfirst($this->uri->segment(2));?>
        </li>
      </ul>

      <div class="page-header users-header">
        <h2>
          <?php echo ucfirst($this->uri->segment(2));?> 
          <a  href="<?php echo site_url("admin").'/'.$this->uri->segment(2); ?>/add" class="btn btn-sm btn-success">Add a new</a>
        </h2>
      </div>
      
       <?php

      if(isset($flash_message)){
        if($flash_message == 'checkout')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">Ã</a>';
            echo '<strong>Well done!</strong> Success Check outed !';
          echo '</div>';       
        }else{
          echo '<div class="alert alert-error">';
            echo '<a class="close" data-dismiss="alert">Ã</a>';
            echo '<strong>Oh snap!</strong> change a few things up and try submitting again.';
          echo '</div>';          
        }
      }
      ?>
      
   
      <div class="row">
        <div class="span12 columns col-sm-12">

          <table class="table table-striped table-bordered table-condensed">
            <thead>
              <tr>
                <th class="header">#</th>
                <th class="yellow header headerSortDown">User ID</th>
                <th class="yellow header headerSortDown">First Name</th>
                <th class="yellow header headerSortDown">Last Name</th>
                <th class="yellow header headerSortDown">User Name</th>
                <th class="yellow header headerSortDown">Email</th>
                <th class="yellow header headerSortDown" colspan="2">Action</th>
              </tr>
            </thead>
            <tbody>
                <?php 
                	foreach ($user as $user) {
                		echo "<tr>";
                		echo "<td></td>";
                		echo "<td>".$user->id."</td>";
                		echo "<td>".$user->first_name."</td>";
                		echo "<td>".$user->last_name."</td>";
                		echo "<td>".$user->user_name."</td>";
                		echo "<td>".$user->email_addres."</td>";
                		echo "<td><a href='".site_url('admin/user/edit/'.$user->id)."'>Edit</a></td>";
                		echo "<td><a href='".site_url('admin/user/del/'.$user->id)."'>Delete</a></td>";
                		echo "</tr>";
                	}
                ?> 	  
            </tbody>
          </table>

      </div>
    </div>


