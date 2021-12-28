    
<div class="container top">      
  <ul class="breadcrumb">
    <li>
      <a href="<?php echo site_url("admin"); ?>">
        <?php echo ucfirst($this->uri->segment(1));?>
      </a> 
      <span class="divider">/</span>
    </li>
    <li>
      <a href="<?php echo site_url("admin").'/'.$this->uri->segment(2); ?>">
        <?php echo ucfirst($this->uri->segment(2));?>
      </a> 
      <span class="divider">/</span>
    </li>
    <li class="active">
      <a href="#">Update</a>
    </li>
  </ul>
  
  <div class="page-header">
    <h2>
     History Room
    </h2>
  </div>


  <table style="width:100%;border:1px solid black !important" >
  <tr style="border:1px solid black !important;height:30px;background-color:aqua">
      <th class="text-left">Customer Name</th>
      <th>Mobile</th>
      <th>Date In</th>
      <th>Date Out</th>
      <th>Total Price</th>
      <th>Deposit</th>
  </tr>
 
  <?php foreach($customer as $row) {?>
    <?php $total_price += $row->total_price; 
          $total_reser += $row->deposit;
    ?>
  <tr >
      <td class="text-left" style="font-weight:bold"><?php echo $row->Family ?></td>
      <td  class="text-left"><?php echo $row->Mobile ?></td>
      <td  class="text-left"><?php echo $row->type ?></td>
      <td  class="text-left"><?php echo $row->reservation_date ?></td>
      <td  class="text-left"><?php echo $row->checkout_data ?></td>
      <td  class="text-left" style="font-weight:bold"><?php echo number_format($row->total_price,2) ?></td>
      <td  class="text-left" style="font-weight:bold"><?php echo number_format($row->deposit,2) ?></td>
      
  </tr> 
  

<?php }?> 


</table>

  </fieldset>
  <?php echo form_close(); ?>
</div>
     
