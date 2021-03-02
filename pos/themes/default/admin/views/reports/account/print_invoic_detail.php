  <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $this->lang->line("sales") . " " . $inv->reference_no; ?></title>
    <link href="<?php //echo $assets ?>styles/style.css" rel="stylesheet">
    <link rel="shortcut icon" href="<?= $assets ?>images/icon.png"/>
    <link rel="stylesheet" href="<?php echo base_url(); ?>themes/default/admin/assets/styles/theme.css" type="text/css"/>
    <!-- http://[::1]/pos_simreap_new/themes/default/admin/assets/styles/theme.css -->

    <style type="text/css">
        html, body {
            height: 100%;
            font-family: khmer os;
           
        }

        body:before, body:after {
            display: none !important;
        }
        .text-center{
            text-align: center !important;
        }
        #wrap{
            max-width: 900px;
            margin: 1px auto !important;
            padding: 10px;
        }
        .table th {
            text-align: center;
            padding: 5px;
            font-size: 12px !important;
        }
        td {
            /*text-align: center;
            padding: 5px;*/
            font-size: 11px !important;
        }

        .table td {
            padding: 4px;
        }
        .boldtable td{
            font-weight: bold !important;
            font-size: 12px !important;
        }
        body{
            /*background: rgb(254,254,195) !important;*/
        }
        ul>li{
            list-style: none;
        }
    </style>
</head>

<body>
<div id="wrap">
    <div class="row">
            <div class="col-xs-12" align="center">
            <H2 class="text-center" style="margin-top:0px;">វិក្កយបត្រ​រាយមុខទំនិញ</H2>
               <!--  <img style="max-width:100% !important" src="<?php echo base_url();?>/assets/uploads/logos/<?= $biller->logo ?>"> -->
            </div>
            <div class="clearfix"></div>
            <div class="row padding10">
               
                    <div class="col-xs-6 pull-right" style="margin-top: -20px !important; padding:5px;">
                    <p style="font-size: 16px;font-weight: bold; height: 5px;"></p>

                     <div class="well well-sm" style="margin-bottom:0px; background: white !Important;">
                        <div class="col-xs-12 text-right" style="padding-left:0px; padding-right:0px;">
                        <table class='boldtable' style="background: white !Important; ">
                                
                                <tr>
                                    <!-- <td  align="left">វិក្កយបត្រ​ </td> -->
                                    <td  width="10"></td>
                                    <td  align="left"><?php echo $inv_re_det[0]->reference_no; ?></td>
                                </tr>
                              
                                <tr >
                                    <td align="left">កាលបរិច្ឆេទ </td>
                                    <td width="10"></td>
                                    <td align="left"><?= $this->sma->hrld($inv_re_det[0]->date) ?></td>
                                </tr>
                                
                                
                            </table>
                        </div>
                        <div class="clearfix"></div>
                        </div>
                    </div>
                    <!-- <div>អតិថិជន <?php echo $voucher->company ?></div> -->
                    <div class="col-xs-6 pull-left" style="padding:0px ; background: white !Important; ">
                        
                        <div class="well well-sm" style="margin-bottom:0px !important;">
                            <div class="col-xs-12 text-right"  style="padding-left:0px; padding-right:0px;">
                                <table class='boldtable'>
                                    
                                    <tr >
                                        <td align="left">អតិថិជន </td>
                                        <td width="10"></td>
                                        <td align="left"><?php echo $inv_re_det[0]->company; ?></td>
                                    </tr>
                                    <tr>
                                        <td align="left">លេខទូរស័ព្ទ</td>
                                        <td width="10"></td>
                                        <td align="left"><?= $inv_re_det[0]->phone; ?></td>
                                    </tr>
                                    
                                    <tr>
                                        <td style="padding-bottom: 5px;" align="left">អាស័យដ្ឋាន</td>
                                        <td style="padding-bottom: 5px;" width="10"></td>
                                        <td style="padding-bottom: 5px;" align="left"><?= $inv_re_det[0]->address ; ?></td>
                                    </tr> 
                                </table>
                            
                        </div>
                        <div class="clearfix"></div>
                         </div>
                    </div>
            </div>
            <h3 style="font-family: 'Khmer OS Muol Light'; font-weight: bold;font-size: 14px;margin-top: 5px;margin-bottom: 5px; text-align:center">VOUCHER</h3>
            <!-- <h3 style="font-family: 'Khmer OS Muol Light'; font-weight: bold;font-size: 9px;margin-top: 5px;margin-bottom: 5px; text-align:center">VOUCHER</h3> -->

            <div class="clearfix"></div>
            <!-- <div class="table-responsive"> -->
                <table class="table table-bordered table-hover table-striped" style="background: white !important; margin: 0px !important">
                    <thead style="background:#2085d8;color:#fff;">
                    <tr>
                        <th><?= "ល.រ <br> No";//lang("no"); ?></th>
                        <th><?php echo "លេខវិក័យបត្រ";?></th>
                        <th><?php echo "កាលបរិច្ឆេទ"; ?></th>
                        <th><?php echo  "បរិយាយទំនិញ";?></th>
                        <th><?php echo "លេខ Reference"; ?></th>
                        <th><?php echo "បរិមាណ";?></th>
                        <th><?php echo "ប្រភេទ";?></th>
                        <th><?php echo "តំលៃរាយ";?></th>
                        <th><?= "ដុល្លា <br> USD";//lang("no"); ?></th>
                        <th><?php echo "រៀល <br> RIEL" ?></th>
                        <!-- <th><?= 'តំលៃសរុប';//lang("subtotal"); ?><br> Amount</th> -->
                    </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $total_am=0;
                            $total_usd=0;
                            $i=0;
                            foreach ($inv_re_det as $det_re): $i++;

                            $total_usd = $det_re->unit_price * $det_re->quantity;
                            $total_am+=$total_usd;
                        ?>

                            <tr>
                                <td><?php echo $i ?></td>
                                <th><?php echo $det_re->sale_id;?></th>
                                <td><?php echo $det_re->date; ?></td>
                                <td><?php echo $det_re->product_name;?></td>
                                <td><?php echo $det_re->reference_no ?></td>
                                <th><?php echo $det_re->quantity;?></th>
                                <th><?php echo $det_re->product_unit_code;?></th>
                                <th><?php echo $this->sma->formatMoney($det_re->unit_price);?>(USD)</th>
                                <td><?php echo $this->sma->formatMoney($total_usd) ?>(USD)</td>
                                <td><?php echo $this->sma->formatMoney($total_usd*$rate->rate)?>(R)</td>
                                <!-- <td><?php //echo $this->sma->formatMoney($vd->total - $vd->amount_usd) ?>(USD)</td> -->
                            </tr>
                        <?php endforeach ?>
                        
                    </tbody>
                </table>
                <div class="col-sm-12" style="padding: 0 !important">
                    <table class="table table-bordered" style="background: white !important">
                        <tbody>
                            <tr>
                                <td colspan="8" style="text-align:left  ; padding-right:10px; font-weight:bold;">សរុប/<?= lang("total_amount"); ?></td>
                                <td style="text-align:right; padding-right:10px 0px;font-weight:bold;"><?= $this->sma->formatMoney($total_am); ?>&nbsp;(USD)</td>
                                <td style="text-align:right; padding-right:10px 0px;font-weight:bold;"><?php echo $this->sma->formatMoney($total_am*$rate->rate); ?>&nbsp;(R)</td>
                            </tr>
                            <tr class="hide">
                                <td style="text-align:left  ; padding-right:10px; font-weight:bold;">សរុប/ប្រាក់ខ្វះ</td>
                                <td style="text-align:right;font-weight:bold;"><?= $this->sma->formatMoney($remain);?>&nbsp;(USD)</td>
                                <td style="text-align:right;font-weight:bold;"><?= $this->sma->formatMoney($remain_r);?>&nbsp;(R)</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- <?php var_dump($balance) ?> -->
                <div class="col-sm-12 hidden" style="padding: 0 !important; background: rgb(254,254,195) !important;">
                    <table class="" style="width: 100%">
                            <tr>
                                <td style="padding: 7px; vertical-align: top;"><h4 style="color: red !important; text-decoration: underline; font-style: bold;">ចំណាំ</h4></td>
                                <td style="padding: 7px;">
                                    <ul>
                                        <li style="padding: 4px;">-សូមពិនិត្យនឹងរាប់ទំនិញអោយបានត្រឹមត្រូវ</li>
                                        <li style="padding: 4px;">-ក្រោយពីអ្នកទិញបានឯកភាពចុះហត្ថលេខាគឺផុតការទទួលខុសត្រូវពីអ្នកលក់ហើយ</li>
                                        <li style="padding: 4px;">-រាល់ពេលទូទាត់ប្រាក់ត្រវមានហត្ថលេខាអ្នកទទួលទេីបយើខ្ញុំទទួលខុសត្រូវ</li>
                                    </ul>
                                </td>
                            </tr>
                    </table>
                </div>
                 
                <p style="clear: both;"></p>
                <div class="col-sm-12">
                    <table style="width: 100%">
                        <tr style="height: 100px !important;">
                            <td style="vertical-align: top;text-align: center;">
                                <span>ថ្ងៃទី......ខែ.....ឆ្នាំ 201...</span><br>
                                <label style="font-style: bold !important">អ្នកទិញ</label>
                            </td>
                            <td style="vertical-align: top;text-align: center;">
                                <span>ថ្ងៃទី......ខែ.....ឆ្នាំ 201...</span><br>
                                <label style="font-style: bold !important">អ្នកដឹកជញ្ជួន</label>
                            </td>
                            <td style="vertical-align: top;text-align: center;">
                                <span>ថ្ងៃទី......ខែ.....ឆ្នាំ 201...</span><br>
                                <label style="font-style: bold !important">អ្នកកាន់ស្តុក</label>
                            </td>
                            <td style="vertical-align: top;text-align: center;">
                                <span>ថ្ងៃទី......ខែ.....ឆ្នាំ 201...</span><br>
                                <label style="font-style: bold !important">អ្នកបញ្ជា</label>
                            </td>
                            <td style="vertical-align: top;text-align: center;">
                                <span>ថ្ងៃទី......ខែ.....ឆ្នាំ 201...</span><br>
                                <label style="font-style: bold !important">អ្នកលក់</label>
                            </td>
                           
                        </tr>
                        <tr style="padding: 4px !important; border-top:solid 1px red !important;display:none; ">
                            <td style="text-align: center;">
                                <label style="font-style: bold !important;color: red !important;">ពណ៍ស - ឯកសារ</label><br>
                                <label style="font-style: bold !important">White - File</label>
                            </td>
                            <td style="text-align: center;">
                                <label style="font-style: bold !important;color: red !important;">ពណ៍លឿង - អតិថិជន</label><br>
                                <label style="font-style: bold !important">Yellow - Customer</label>
                            </td>
                            <td style="text-align: center;">
                                <label style="font-style: bold !important;color: red !important;">ពណ៍ផ្ទៃមេឃ - ស្តុក</label><br>
                                <label style="font-style: bold !important">Blue - Stock</label>
                            </td>
                            <td style="text-align: center;">
                                <label style="font-style: bold !important;color: red !important;">ពណ៍ផ្កាឈូក - គណនី</label><br>
                                <label style="font-style: bold !important">Pink - Accountant</label>
                            </td>
                            <td style="text-align: center;">
                                <label style="font-style: bold !important;color: red !important;">ទឹកសណ្តែក - បេឡា</label><br>
                                <label style="font-style: bold !important">Light Yellow - Cashier</label>
                            </td>
                        
                           
                        </tr>
                    </table>
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
        <?php } ?>
        <span class="pull-left col-xs-12"><a class="btn btn-block btn-success" href="#" id="email"><?= lang("email"); ?></a></span>

        <span class="col-xs-12">
            <a class="btn btn-block btn-warning" href="<?= site_url('admin/sales/sale_payment'); ?>">Back to Dashboard</a>
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
                        location.href="<?= site_url('admin/purchases/print_payment'); ?>";
                        // $('#modal-loading').show();
                        // location.reload();
                    // }
                });
        });
    </script>
</div>
</body>
</html>