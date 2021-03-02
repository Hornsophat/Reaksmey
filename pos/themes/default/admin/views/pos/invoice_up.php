  <!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="content-type" content="application/vnd.ms-excel; charset=UTF-8">
    <title><?php echo $this->lang->line("sales") . " " . $inv->reference_no; ?></title>
    <!-- <link href="<?php //echo $assets ?>styles/style.css" rel="stylesheet"> -->
    <link rel="shortcut icon" href="<?= $assets ?>images/icon.png"/>
    <link rel="stylesheet" href="<?= $assets ?>styles/theme.css" type="text/css"/>
    <style type="text/css">
        html, body {
            height: 100%;
            background: #FFF;
        }

        body:before, body:after{
            display: none !important;
        }
    	p{
    		/*font-size:11px !important;*/
    	   font-weight:bold !important;
    	}
    	.well{
    		/*border:1px solid black !important;*/
    	}
        #wrap{
            max-width: 700px;
            margin: 0px auto !important;
            padding: 0px;
        }
        .table th {
            text-align: center;
            padding: 3px !important;
            font-size: 13px !important;
		   font-weight:bold !important;
           white-space: nowrap;
           border: 2px solid #CCCCCC !important;
           /*background-color: yellow!important;*/
           /*color:blue !important;*/
           font-family:arial;

        }
        .table thead tr{
            background-color:rgba(0,0,0,0.1); !important;
        }
        td {
	       /*font-weight:bold !important;*/
            /*text-align: center;
            padding: 5px;*/
        }
        td label{
            /*color: blue !important;*/
        }
        td i{
            font-size:12px !important;
            /*color: blue !important;*/
        }
        .table td {
            /*padding: 2px !important;*/
		    /*font-weight:bold !important;*/
	        border:1px solid #CCCCCC !important;
            /*color: blue !important;*/
            line-height:5px !important;
        }
        .table td div{
            /*color:blue !important;*/
        }
        .table td span{
            /*color: blue !important;*/
        }
        .boldtable td{
	        /*font-weight:bold !important;*/
            /*font-weight: bold !important;*/
            font-size: 10px;
        }

        .break-after {
            /*height: 100px !important;*/
            display: block;
            page-break-after: always;
            position: relative;
        }

        .break {
            /*display: block;*/
            page-break-after: always;
            /*height: 100px !important;*/
        }

        .break-before {
            display: block;
            page-break-before: always;
            /*height: 100px !important;*/
            position: relative;
        }
        /*.break*/
        html, body, .main, .tabs, .tabbed-content { float: none; }
        .t_font{
            font-size:10px !important;
        }
        
    </style>
    <script type="text/javascript">
    var tableToExcel = (function() {
          var uri = 'data:application/vnd.ms-excel;base64,'
            , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><meta http-equiv="content-type" content="application/vnd.ms-excel; charset=UTF-8"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
            , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
            , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
          return function(table, name) {
            if (!table.nodeType) table = document.getElementById(table)
            var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
            window.location.href = uri + base64(format(template, ctx))
          }
        })()
</script> 
</head>
<body>
<div id="wrap">
    <div class="row" id="xls_export">
        
        <div style="width:100%; margin:0px auto !important;">
            <div class="clearfix"></div>
            
            <div class="">
                <div class="pull-center" style="margin: 0 auto; text-align: center;">
                    <!-- <img style="width:100%;" src="<?php echo base_url();?>/assets/uploads/logos/header_logo2.png"> -->
                </div>
                <div class="col-xs-10 col-lg-6 pull-left">
                    <img style="width:100%; margin-left:-30px !important;padding:0px; margin:0px;" src="<?php echo base_url();?>/assets/uploads/logos/<?= $biller->logo ?>">
                    
                </div><br>
                <div class="col-xs-9 col-lg-6 pull-right" style="margin:0px; padding:0px;">
                    <p class="text-center" style="font-size:14px !important;"><?php echo $biller->address;?> <br><?php echo $biller->phone;?></p>
                </div>
            </div>
            <div class="clearfix"></div>
            <div id="table-responsive">
            <div class="padding10">               
                    <div class="col-xs-6 pull-right" style="margin-top: 0px !important; padding:5px;padding-right:0px;">
                    <p style="font-size: 16px;font-weight: bold; height: 5px;"></p>

                     <div class="" style="margin-bottom:0px;margin-top:-21px;">
                        <div class="text-right" style="">
                        <table class='hide'>
                               <!--  <tr style="color: blue !important">
                                   <td align="left" style="vertical-align: top !important"><i class="fa fa-phone"></i></td>

                                    <td style="padding-bottom: 0px;" width="10"></td>
                                    <td style="padding-bottom: 0px;" align="left"><?= $biller->phone ?></td>
                                </tr> -->
                                <tr>
                                    <td align="left" style="vertical-align: top !important"><b class="">វិក្កយបត្រ<!-- No:  --></b></td>
                                    <td style="padding-bottom: 0px;" width="10"></td>
                                    <td style="padding-bottom: 0px;" align="left"><?= $inv->reference_no; ?></td>
                                </tr>
                                <tr>
                                    <td align="left" style="vertical-align: top !important">លេខទូរស័ព្ទ</td>
                                    <td style="padding-bottom: 0px;" width="10"></td>
                                    <td style="padding-bottom: 0px;" align="left"><?= $biller->phone ?></td>
                                </tr>
                                <tr>
                                    <td align="left" style="vertical-align: top !important">អ៊ីម៉ែល</td>
                                    <td style="padding-bottom: 0px;" width="10"></td>
                                    <td style="padding-bottom: 0px;" align="left"><?= $biller->email ?></td>
                                </tr>
                                <!-- <tr>
                                   <td align="left"><i class="fa fa-user"></i></td>

                                    <td style="padding-bottom: 0px;" width="10"></td>
                                    <td style="padding-bottom: 0px;" align="left"><?= ($this->db->where('id',$inv->created_by)->get('users')->row()->username) ?></td>
                                </tr> -->
                                <!-- <tr>
                                    <td colspan="3" rowspan="2" align="center" style="padding-bottom: 15px;">
                                                <?php $br = $this->sma->save_barcode($inv->reference_no, 'code39', 40, false); ?>
                                    <img src="<?= base_url() ?>assets/uploads/barcode<?= $this->session->userdata('user_id') ?>.png"
                                         alt="<?= $inv->reference_no ?>"/>
                                    <?php $this->sma->qrcode('link', urlencode(site_url('sales/view/' . $inv->id)), 1); ?>
                                    <img src="<?= base_url() ?>assets/uploads/qrcode<?= $this->session->userdata('user_id') ?>.png"
                                         alt="<?= $inv->reference_no ?>"/>
                                    </td>
                                </tr> -->
                                
                            </table>
                        </div>
                        <div class="clearfix"></div>
                        </div>
                    </div>
                    <!-- <div>អតិថិជន</div> -->
                  
                        <!-- <div class="col-md-6" style="font-size:25px; text-align: center;">
                            <label class="col-md-2" style="color:blue !important;">No:&nbsp;&nbsp;&nbsp;<span style="color:red !important;"><?= $inv->reference_no; ?></span></label>

                        </div> -->
              
                    <!-- <table>
                        <tr class="col-xs-6 col-xs-offset-5" style="color: #ff0000; font-size: 40px !important;">
                            <td style="" align="left">N0:&nbsp; </td>
                            <td  width="10"></td>
                            <td  align="left" > </td>
                        </tr>
                    </table> -->
                    <div class="col-xs-6 pull-left" style="padding:0px ;">
                        <!-- <p style="font-size: 16px;font-weight: bold;"><img src="<?= $assets ?>/invoice/customer.png" style='width:160px;' /></p> -->
                        
                        <div class="" style="">
                            <div class="text-right"  style="">
                                <table class=''>                                    
                                    <tr >
                                        <td align="left">លេខតុ: </td>
                                        <td width="10"></td>
                                        <td align="left"><?=  $customer->company; ?></td>
                                    </tr>
                                
                                   <!--  <tr​​>
                                        <td align="left" style="vertical-align: top !important">លេខទូរស័ព្ទ</td>
                                        <td width="10"></td>
                                        <td align="left"><?= lang( $customer->phone); ?></td>
                                    </tr>
 -->                                    <!-- <tr>
                                        <td align="left">កាលបរិច្ឆេទ </td>
                                        <td width="10"></td>
                                        <td align="left"><?= $this->sma->hrld($inv->date) ?></td> -->
                                    </tr>
                                     <?php if($biller->id==4){ ?>
                                    <tr>
                                        <td style="padding-bottom: 0px;" align="left">អាស័យដ្ឋាន</td>
                                        <td style="padding-bottom: 0px;" width="10"></td>
                                        <td style="padding-bottom: 0px;" align="left"><?= lang($biller->city) ; ?></td>
                                    </tr> 
                                      <tr>
                                        <td style="padding-bottom: 0px;" align="left">អត្តសញ្ញាណកម្ម​ អតប(VATIN)</td>
                                        <td style="padding-bottom: 0px;" width="10"></td>
                                        <td style="padding-bottom: 0px;" align="left"><?= lang( $customer->vat_no); ?></td>
                                    </tr>
                                 <?php } ?>                     
                                  
                                    
                                </table>
                           
                        </div>
                        <div class="clearfix"></div>
                         </div>
                    </div>
                    <div class="clearfix"></div>

            </div>
            <div class="clearfix"></div>

            <div class="clearfix"></div>
            <style type="text/css">
                table thead tr th{
                    border-top:1px solid #ddd !important;
                }
            </style>
                <table class="table table-hover table-responsive table-bordered" style="border-top:1px solid #ddd !important;">
                    <thead style="border-top:1px solid #ddd !important;">
                    <tr style="opacity:2;">
                        <th style="border-top:1px solid #ddd !important;"><?= 'ល.រ';//lang("no"); ?></th>
                        <th style="border-top:1px solid #ddd !important;"><?= 'រាយមុខម្ហូប'?></span></th>
                        <!-- <th style="width:300px;border-top:1px solid #ddd !important;"><?= 'បរិយាយមុខទំនិញ';//lang("description"); ?></th> -->
                        <th style="border-top:1px solid #ddd !important;width:30px !important;"><?= 'ចំនួន';//lang("quantity"); ?></th>
                        <!-- <th style="border-top:1px solid #ddd !important;"><?= 'ឯកតា';//lang("unit"); ?></th> -->
                        <th style="border-top:1px solid #ddd !important;"><?= 'តំលៃ';//lang("unit_price"); ?></span></th>
                        <th style="border-top:1px solid #ddd !important;"><?php echo 'បញ្ចុះតំលៃ' ?></span></th>
                        <!-- <?php
                        if ($Settings->tax1) {
                            echo '<th>' . lang("tax") . '</th>';
                        }
                        if ($Settings->product_discount && $inv->product_discount != 0) {
                            echo '<th>' . lang("discount") . '</th>';
                        }
                        ?> -->
                        <th colspan="2" style="border-top:1px solid #ddd !important;"><?= 'សរុប';//lang("subtotal"); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $r = 1;
                        
                        $t_u=0;
                        $t_b=0;
                       // print_r($rows);
                    foreach ($rows as $row):

                        $p_row = $this->db->where('id',$row->product_id)->get('products')->row();
                        $unit = $this->db->query("SELECT * FROM sma_units where id=$p_row->unit")->row()->name;
                        $subtotal_usd = 0;
                        $subtotal_bth = 0;
                        if($r==17){
                            echo '<tr class="break"></tr>';
                            echo '<tr class="break-after"></tr>';
                            echo '<tr class="break-before"></tr>';
                        }

                        ?>
                        <tr>
                            <td style="text-align:center; width:40px; vertical-align:middle;"><?= $r; ?></td>
                            <!-- <td style="width:40px; vertical-align:middle;"><?= $row->product_code;?></td> -->
                            <td style="vertical-align:middle; width:350px !important; "><?= $row->product_name ?></td>
                            <td style="width: 50px; text-align:center; vertical-align:middle;white-space: nowrap;"><?php echo  number_format($row->unit_quantity,2).''.$unit; //$this->sma->formatNumber($row->quantity); ?></td>
                            <!-- <td style="vertical-align:middle;"><?= $row->product_unit_code ?></td> --> 
                            <?php
                               
                                $price = 0;
                                $cur = '';
                                $subtotal_usd = $row->unit_quantity * $row->unit_price;

                                // if ($row->ctype==1) {
                                //     $price = $row->unit_price;
                                //     $cur = '($)';
                                //     $subtotal_usd = $row->quantity * $row->unit_price;
                                // }
                                // if ($row->ctype==2) {
                                //     $price = $row->unit_price;s
                                //     $cur = '(B)';
                                //     $subtotal_bth = $row->quantity * $row->unit_price;
                                // }
                                $dis = $row->discount.$cur;
                                $ds = strpos($row->discount,'%');
                                if ($ds) {
                                    $dis = $row->discount;
                                }
                                $base_price = $subtotal_usd / $row->quantity;
                            ?>
                            <?php if(($inv->total_tax_usd!=0 || $inv->total_tax_b!=0) && $biller->id==4) {?>
                                <td style="text-align:right; width:100px;"><?= $this->sma->formatMoney(($base_price/1.1)).$cur; ?></td>
                            <?php }else{ ?>
                                <td style="text-align:right; width:50px;"><?= number_format($row->real_unit_price,2).$cur; ?>&nbsp;$</td>
                                <?php } ?>
                            <td style="text-align:center; width:100px;" class=""><?php echo $dis !=''? $dis : ''; ?></td>
                            <!-- <?php
                            if ($Settings->tax1) {
                                echo '<td style="width: 100px; text-align:right; vertical-align:middle;">' . ($row->item_tax != 0 && $row->tax_code ? '<small>('.$row->tax_code.')</small>' : '') . ' ' . $this->sma->formatMoney($row->item_tax) . '</td>';
                            }
                            if ($Settings->product_discount && $inv->product_discount != 0) {
                                echo '<td style="width: 100px; text-align:right; vertical-align:middle;">' . ($row->discount != 0 ? '<small>(' . $row->discount . ')</small> ' : '') . $this->sma->formatMoney($row->item_discount) . '</td>';
                            }
                            ?> -->
                            <?php if(($inv->total_tax_usd!=0 || $inv->total_tax_b!=0) && $biller->id==4) {

                            ?>


                            <!-- <td colspan='2' style="text-align:right; width:120px;"><?= $this->sma->formatMoney($row->ctype==1?($subtotal_usd/1.1):($subtotal_bth/1.1)).$cur; ?></td> -->
                            <?php }else{ ?>
                            <td colspan='2' style="text-align:right; width:70px;"><?= number_format($subtotal_usd,2) ?>&nbsp;$</td>

                                <?php } ?>
                          <!--   <td>0</td> -->
                        </tr>
                        <?php
                        $r++;
                        if(($inv->total_tax_usd!=0 || $inv->total_tax_b!=0) && $biller->id==4) {
                            $t_u+=$subtotal_usd;
                            //$t_b+=$subtotal_bth;
                        }else{
                            $t_u+=$subtotal_usd;
                            //$t_b+=$subtotal_bth;
                        }

                    endforeach;
                    ?>
			<?php
				for($j=$r;$j<=17;$j++){
					echo "<tr>
						<td style='text-align:center !important'>$j</td>

						<td></td>

						<td></td>

						<td></td>

                        <td></td>

						<td></td>						</tr>";
				}
			?>
                    
                    <?php
                        $col = 4;
                        if ($Settings->product_serial) {
                            $col++;
                        }
                        if ($Settings->product_discount && $inv->product_discount != 0) {
                            $col++;
                        }
                        if ($Settings->tax1) {
                            $col++;
                        }
                        if ($Settings->product_discount && $inv->product_discount != 0 && $Settings->tax1) {
                            $tcol = $col - 2;
                        } elseif ($Settings->product_discount && $inv->product_discount != 0) {
                            $tcol = $col - 1;
                        } elseif ($Settings->tax1) {
                            $tcol = $col - 1;
                        } else {
                            $tcol = $col;
                        }
                         $col=4;
                        ?>
                        <?php if ($inv->grand_total != $inv->total) { ?>
                            <tr>
                                
                              <!--   <td colspan="4"
                                    style="text-align:right; padding-right:10px;font-weight:bold;"><?= lang("សរុបមុនគិតអាករ"); ?>
                                    
                                </td> -->
                                <?php
                                if ($Settings->tax1) {
                                    //echo '<td style="text-align:right;">' . $this->sma->formatMoney($inv->product_tax) . '</td>';
                                }
                                if ($Settings->product_discount && $inv->product_discount != 0) {
                                    //echo '<td style="text-align:right;">' . $this->sma->formatMoney($inv->product_discount) . '</td>';
                                }
                                ?>
                               <!--  <td></td>
                                <td styl e="text-align:right; padding-right:10px;"><?= $this->sma->formatMoney($t_u/1.1); ?>($)</td>-->
                               <!--  <td style="text-align:right; padding-right:10px;"><?php echo $this->sma->formatMoney($t_b/1.1) ?>(B)</td> -->
                            </tr>
                        <?php } ?>
                        <?php if ($return_sale && $return_sale->surcharge != 0) {
                            echo '<tr><td colspan="' . $col . '" style="text-align:right; padding-right:10px;font-weight:bold;">' . lang("return_surcharge") . ' (' . $default_currency->code . ')</td><td style="text-align:right; padding-right:10px;">' . $this->sma->formatMoney($return_sale->surcharge) . '</td></tr>';
                        }
                        ?>
                        <?php if ($inv->order_discount != 0) {
                            if (strpos($inv->order_discount_id,"%")) {
                                $disc_percent= "($inv->order_discount_id)";
                            }else{
                                $disc_percent='';
                            }

                            // echo '<tr><td colspan="' . $col . '" style="text-align:right; padding-right:10px;font-weight:bold;">' . lang("បញ្ចុះតំលៃ") .$disc_percent. '</td><td style="text-align:right; padding-right:10px;">' . $this->sma->formatMoney($inv->total_disc_usd) . '($)</td><td></td></tr>';
                            // <td style="text-align:right; padding-right:10px;">'.$this->sma->formatMoney($inv->total_disc_b).'(B)</td>
                        }
                        ?>
                        <?php if ($Settings->tax2 && ($inv->total_tax_usd != 0 || $inv->total_tax_b!=0) && $biller->id==4){
                            echo '<tr><td colspan="' . $col . '" style="text-align:right; padding-right:10px;font-weight:bold;">' . lang("តំលៃអារក").'</td><td style="text-align:right; padding-right:10px;">' . $this->sma->formatMoney((($t_u/1.1)*0.1)) . '($)</td></tr>';
                            // <td style="text-align:right; padding-right:10px;">' . $this->sma->formatMoney((($t_b/1.1)*0.1)) . '(B)</td>
                        }
                        ?>
                        <?php if ($inv->shipping != 0) {
                            echo '<tr><td colspan="' . $col . '" style="text-align:right; padding-right:10px;;">' . lang("shipping") . ' (' . $default_currency->code . ')</td><td style="text-align:right; padding-right:10px;">' . $this->sma->formatMoney($inv->shipping) . '</td></tr>';
                        }
                        ?>
                        <tfoot>
                <!-- <tr>
                    <th ><br></th>
                    <th class="text-right"></th>
                </tr> -->
                <tr style="border-top:dotted 2px black !important; padding-top: 20px !important;">
                    <!-- <th colspan="3"><?= lang("Totalqty"); ?> : <?php echo $qty?> </th> -->
                    <!-- <th colspan="6"></th> -->
                    <?php $date=date('Y-m-d');?>
                    <th colspan="3" rowspan="5">ថ្ងៃខែឆ្នាំចេញវិក័យប័ត្រ​ &nbsp;&nbsp;&nbsp;&nbsp;<?php echo $date;?><br><br>
                        <div class="col-xs-6">
                            <p>អ្នកទិញ / The Buyer
                            <hr>
                            </p>
                        </div>
                        <div class="col-xs-6">
                            <p>អ្នកលក់ / The Seller
                            <hr>
                            </p>
                        </div>
                    </th>
                    <th class="text-right" style="white-space: nowrap !important;text-align:right;"><?= lang("សរុប"); ?></th>
                    <th class="text-right" colspan="2" style="white-space: nowrap !important;text-align:right;"><?= number_format(($inv->total + $inv->product_tax),2); ?>&nbsp;$</th>
                </tr>
                <!-- <tr style="padding-bottom: 20px !important;" class="hide">
                    <th colspan="6" class="text-right"style="white-space: nowrap !important;text-align:right;" colspan="4"><?= lang("សរុបរៀល"); ?></th>
                    <th class="text-right" style="white-space: nowrap !important;">R <?= $this->sma->formatMoney(($inv->total+ $rounding)*$rate->rate); ?></th>
                </tr> -->
                <!-- <tr>
                    <th colspan="2"></th>
                    <th><?= lang("total"); ?></th>
                    <th class="text-right">$ <?= $this->sma->formatMoney($inv->total + $inv->product_tax); ?></th>
                </tr> -->
                <?php
                
                if ($inv->is_pub_tax != 0) {
                    echo '<tr><th>Public Tax</th><th class="text-right">' . number_format($inv->total*0.03,0) . '</th></tr>';
                }
                if ($inv->order_tax != 0) {
                    echo '<tr><th colspan="0" style="text-align:right;">' . lang("VAT") . '</th><th class="text-right" style="text-align:right;">' . number_format($inv->order_tax,0) . ' $</th></tr>';
                }
                if ($inv->order_discount != 0) {
                    echo '<tr style="border-bottom:dotted 2px black !important;"><th colspan="0" style="text-align:right;">' . lang("order_discount") . '</th><th class="text-right" style="text-align:right;">'.number_format($inv->order_discount,0) . ' $</th></tr>';
                }

                if ($pos_settings->rounding) { 
                    $round_total = $this->sma->roundNumber($inv->grand_total, $pos_settings->rounding);
                    $rounding = $this->sma->formatMoney($round_total - $inv->grand_total);
                ?>
                    <tr  style="border-bottom:dotted 3px black;">
                        <th colspan="3"><?= lang("rounding"); ?></th>
                        <th class="text-right"><?= $rounding; ?></th>
                    </tr>
                    <tr>
                        <th colspan="0" style="text-align:right;"><?= lang("សរុបដុល្លា"); ?></th>
                        <th class="text-right">$ <?= $this->sma->formatMoney($inv->grand_total + $rounding); ?></th>
                    </tr>
                    <tr>

                        <th colspan="3"><?= lang("grand_total_reils"); ?></th>
                        <th class="text-right"><?= $this->sma->formatMoney(($inv->grand_total+ $rounding)); ?></th>
                    </tr>

                <?php } else { ?>
                    <tr>
                        <th colspan="0" style="text-align:right;"><?= lang("សរុបដុល្លា"); ?></th>
                        <th colspan="2" class="text-right" style="text-align:right !important;">&nbsp;&nbsp;<?= number_format($inv->grand_total+$inv->order_tax,2); ?>&nbsp;$</th>
                    </tr>
                   <!--  <tr class="hide">
                        <th colspan="2"  style="text-align: left !important;"><?= lang("Paid_amount"); ?></th>
                        <th colspan="3" class="text-right" style="text-align:right !important;">$&nbsp;&nbsp;<?= $paid_amount=$this->sma->formatMoney($payments[0]->pos_paid == 0 ? $payments[0]->amount : $payments[0]->pos_paid) . ($payments[0]->return_id ? ' (' . lang('returned') . ')' : '') ; ?></th>
                        <th colspan="3" class="text-right" style="text-align:right !important;">R&nbsp;&nbsp;<?= $this->sma->formatMoney($paid_amount*$rate->rate); ?></th>
                    </tr> -->
                    <tr style="">
                        <th colspan="0" style="text-align: right !important;"><?= lang("គិតជារៀល"); ?></th>
                        <th colspan="2" class="text-right" style="text-align:right !important;"><?= $this->sma->formatMoney(($inv->grand_total+$inv->order_tax)*$rate->rate); ?>&nbsp;R</th>
                    </tr>
                <?php }
                if ($inv->paid < $inv->grand_total) { ?>
                    <tr>
                        <th colspan="0" style="text-align: left !important;" ><?= lang("លុយបានបង់"); ?></th>
                        <th class="text-center" colspan="2" style="text-align:right !important;"><?= $this->sma->formatMoney($inv->paid); ?> R</th>
                    </tr>
                    <tr>
                        <th ><?= lang("លុយសល់"); ?></th>
                        <th class="text-right" colspan="2"  style="text-align:right !important;"><?= $this->sma->formatMoney($inv->grand_total - $inv->paid);?> R</th>
                    </tr>
                <?php } ?>
                </tfoot>
                    </tbody>
                </table>
              
            <style type="text/css">
                #rfooter hr{
                    margin: 0;
                }
                p{
                    font-size:11px !important;

                }
            </style>
            <div class="row hide" align="center" id="rfooter">
                <div class="col-xs-4">
                    <p>ហត្ថលេខា & ឈ្មោះអតិថិជន
                    <hr>
                    <br>
                    </p>
                </div>
                <div class="col-xs-4">
                    <p>ហត្ថលេខា & ឈ្មោះអ្នកដឹកជញ្ជូន
                    <hr>
                    <br>
                    </p>
                </div>
                <div class="col-xs-4">
                    <p>ហត្ថលេខា & ឈ្មោះអ្នកលក់
                    <hr>
                    <br>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div id="buttons" style="padding-top:10px; text-transform:uppercase;" class="no-print">
        <hr>
        <?php if ($message) { ?>
        <div class="alert alert-success">
            <button data-dismiss="alert" class="close" type="button">×</button>
            <?= is_array($message) ? print_r($message, true) : $message; ?>
        </div>
    <?php } ?>

        <?php if ($pos_settings->java_applet) { ?>
            <span class="col-xs-12"><a class="btn btn-block btn-primary" onClick="printReceipt()"><?= lang("print"); ?></a></span>
            <span class="col-xs-12"><a class="btn btn-block btn-info" type="button" onClick="openCashDrawer()">Open Cash
                    Drawer</a></span>
            <div style="clear:both;"></div>
        <?php } else { ?>
            <span class="pull-right col-xs-12">
            <a href="javascript:window.print()" id="web_print" class="btn btn-block btn-primary"
               onClick="window.print();return false;"><?= lang("web_print"); ?></a>
        </span>
        <span class="pull-right col-xs-12">
            <a href="javascript:void(0)" id="web_print" class="btn btn-block btn-primary export_inv"
              ><?= lang("Export"); ?></a>
        </span>
        <?php } ?>
        <span class="pull-left col-xs-12"><a class="btn btn-block btn-success" href="#" id="email"><?= lang("email"); ?></a></span>

        <span class="col-xs-12">
            <a class="btn btn-block btn-warning" id="back_to_sale" href="javascript:void(0);">Back To Sale</a>
        </span>
        <?php if (!$pos_settings->java_applet) { ?>
            <div style="clear:both;"></div>
            <div class="col-xs-12" style="background:#F5F5F5; padding:10px;">
                <p style="font-weight:bold;">Please don't forget to disble the header and footer in browser print
                    settings.</p>

                <p style="text-transform: capitalize;"><strong>FF:</strong> File &gt; Print Setup &gt; Margin &amp;
                    Header/Footer Make all --blank--</p>

                <p style="text-transform: capitalize;"><strong>chrome:</strong> Menu &gt; Print &gt; Disable Header/Footer
                    in Option &amp; Set Margins to None</p></div>
        <?php } ?>
        <div style="clear:both;"></div>

    </div>
    <script type="text/javascript" src="<?= $assets ?>pos/js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript">
        $(function(){
            $(".export_inv").on("click", function(e){
                    //  var export_data = $("#table-responsive").html();
                    // export_data +='<style type="text/css">'+
                    //                 'td,th,h5,h6,h2,h3,p,h1,div,span,label{'+
                    //                     'font-family: Cambria;'+
                    //                 '}'+
                    //                 'th{'+
                    //                     'font-size: 11px;'+
                    //                     'font-weight: bold;'+
                    //                 '}'+
                    //                 'td{'+
                    //                     'font-size: 11px;'+
                    //                 '}'+
                    //             '</style>';
                    //     window.open('data:application/vnd.ms-excel,' + encodeURIComponent(export_data));
                    //     e.preventDefault();
                     tableToExcel('xls_export', 'test.xls')
            });
        })
        // var tableToExcel = (function() {
        //   var uri = 'data:application/vnd.ms-excel;base64,'
        //     , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--><meta http-equiv="content-type" content="text/plain; charset=UTF-8"/></head><body><table>{table}</table></body></html>'
        //     , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
        //     , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
        //   return function(table, name) {
        //     if (!table.nodeType) table = document.getElementById(table)
        //     var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
        //     window.location.href = uri + base64(format(template, ctx))
        //   }
        // })()
        $(window).load(function () {
            window.print();
            $('#back_to_sale').click(function (e) {
                // bootbox.confirm(lang.r_u_sure, function (result) {
                    // if (result) {
                        if (localStorage.getItem('slitems')) {
                            localStorage.removeItem('slitems');
                        }
                        if (localStorage.getItem('sldiscount')) {
                            localStorage.removeItem('sldiscount');
                        }
                        if (localStorage.getItem('sltax2')) {
                            localStorage.removeItem('sltax2');
                        }
                        if (localStorage.getItem('slshipping')) {
                            localStorage.removeItem('slshipping');
                        }
                        if (localStorage.getItem('slref')) {
                            localStorage.removeItem('slref');
                        }
                        if (localStorage.getItem('slwarehouse')) {
                            localStorage.removeItem('slwarehouse');
                        }
                        if (localStorage.getItem('slnote')) {
                            localStorage.removeItem('slnote');
                        }
                        if (localStorage.getItem('slinnote')) {
                            localStorage.removeItem('slinnote');
                        }
                        if (localStorage.getItem('slcustomer')) {
                            localStorage.removeItem('slcustomer');
                        }
                        if (localStorage.getItem('slcurrency')) {
                            localStorage.removeItem('slcurrency');
                        }
                        if (localStorage.getItem('sldate')) {
                            localStorage.removeItem('sldate');
                        }
                        if (localStorage.getItem('slstatus')) {
                            localStorage.removeItem('slstatus');
                        }
                        if (localStorage.getItem('slbiller')) {
                            localStorage.removeItem('slbiller');
                        }
                        if (localStorage.getItem('gift_card_no')) {
                            localStorage.removeItem('gift_card_no');
                        }
                        location.href="<?= site_url('admin/pos'); ?>";
                        // $('#modal-loading').show();
                        // location.reload();
                    // }
                });
        });
    </script>
</div>
</body>
</html>