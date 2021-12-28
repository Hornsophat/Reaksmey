    
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
      Customer List
    </h2>
  </div>


  <table style="width:100%;border:1px solid black !important" >
  <tr style="border:1px solid black !important;height:30px;background-color:aqua">
      <th class="text-left">Customer Name</th>
      <th>Mobile</th>
      <th>Gender</th>
      <th>Country</th>
      <th>Passport</th>
      <th>Room</th>
      <th>Room Type</th>
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
      <td  class="text-left"><?php echo $row->Gender ?></td>
      <td  class="text-left"><?php echo $row->Country ?></td>
      <td  class="text-left"><?php echo $row->Passport ?></td>
      <td  class="text-left"><?php echo $row->room_no ?></td>
      <td  class="text-left"><?php echo $row->type ?></td>
      <td  class="text-left"><?php echo $row->reservation_date ?></td>
      <td  class="text-left"><?php echo $row->checkout_data ?></td>
      <td  class="text-left" style="font-weight:bold"><?php echo number_format($row->total_price,2) ?></td>
      <td  class="text-left" style="font-weight:bold"><?php echo number_format($row->deposit,2) ?></td>
      
  </tr> 
  <?php }?> 
  <tr style="border: 1px solid black;">
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td style="font-weight: bold;">Total :</td>
      <td class="text-left" style="color:green;font-weight:bold"><?php echo number_format($total_price,2) ;  ?></td>
      <td class="text-left" style="color:red;font-weight:bold"><?php echo number_format($total_reser,2) ;  ?></td>
  </tr>
  </table>
  <h2>
      Customer History Payment
    </h2>
<table  style="width:100%;border:1px solid black !important">
  <tr style="border:1px solid black !important;height:30px;background-color:aqua">
      <th class="text-left">Customer Name</th>
      <th>Mobile</th>
      <th>Gender</th>
      <th>Country</th>
      <th>Passport</th>
      <th>Room</th>
      <th>Room Type</th>
      <th>Date Start</th>
      <th>Date Payment</th>
      <th>Price</th>
  </tr> 


<?php foreach($checkin as $checkin){ ?>

    <?php $total_checkin += $checkin->price; 
    ?>
    <tr  style="border:1px solid black !important;height:30px;">
      <td class="text-left" style="font-weight:bold"><?php echo $checkin->Family ?></td>
      <td  class="text-left"><?php echo  $checkin->Mobile ?></td>
      <td  class="text-left"><?php echo  $checkin->Gender ?></td>
      <td  class="text-left"><?php echo  $checkin->Country ?></td>
      <td  class="text-left"><?php echo  $checkin->Passport ?></td>
      <td  class="text-left"><?php echo  $checkin->room_no ?></td>
      <td  class="text-left"><?php echo  $checkin->type ?></td>
      <td  class="text-left"><?php echo  $checkin->new_month ?></td>
      <td  class="text-left"><?php echo  $checkin->date_in ?></td>
      <!-- <td  class="text-left"><?php echo  $checkin->checkout_data ?></td> -->
      <td  class="text-left" style="font-weight:bold"><?php echo number_format($checkin->price,2) ?></td>
  </tr> 
<?php }?> 

</table>


<h2>
     Items History
    </h2>
<table  style="width:100%;border:1px solid black !important">
  <tr style="border:1px solid black !important;height:30px;background-color:aqua">
      <th class="text-left">Customer Name</th>
      <th>Date Payment</th>
      <th>Item Name</th>
      <th>Price</th>
      <th>quantity</th>
      <th>Total</th>
      <th>Old Number</th>
      <th>New Number</th>
      <th>From Date </th>
      <th>To Date</th>
  </tr> 


<?php foreach($item as $item){ ?>
    <?php if($item->room_id == Null ){?>
    <tr  style="border:1px solid black !important;height:30px;">
   
      <td class="text-left" style="font-weight:bold;margin-left:12px;"><?php echo $item->Family ?></td>
      <td  class="text-left"><?php echo  $item->date_in ?></td>
      
        <td  class="text-left" style="color:red;font-weight:bold"><?php echo $item->item_name ?></td>
        <td  class="text-left" style="color:red;font-weight:bold"><?php echo number_format($item->ckd_price,2) ?></td> 
        <td  class="text-left" style="color:red;font-weight:bold"><?php echo number_format($item->qty,2) ?></td>
        <td  class="text-left" style="color:red;font-weight:bold"><?php echo number_format($item->amount,2) ?></td> 
        <td  class="text-left" style="color:red;font-weight:bold"><?php echo number_format($item->old_kw,2) ?></td> 
        <td  class="text-left" style="color:red;font-weight:bold"><?php echo number_format($item->new_kw,2) ?></td> 
        <td  class="text-left" style="color:red;font-weight:bold"><?php echo $item->date_start ?></td> 
        <td  class="text-left" style="color:red;font-weight:bold"><?php echo $item->date_end ?></td> 
       
  </tr> 
  <?php }?>
  

<?php }?> 


</table>

  </fieldset>
  <?php echo form_close(); ?>
</div>
     
