<?php
class Admin_Checkout extends CI_Controller {

    /**
    * name of the folder responsible for the views 
    * which are manipulated by this controller
    * @constant string
    */
    const VIEW_FOLDER = 'admin/checkout';
 
    /**
    * Responsable for auto load the model
    * @return void
    */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('checkout_model');
        $this->load->model('checkin_model');
        $this->load->model('room_model');
        $this->load->model('currencies_model');

        
        //Load language Content 
        $this->load->helper('language');
        $this->lang->load("content", $this->session->userdata('language'));
        

        if(!$this->session->userdata('is_logged_in')){
            redirect('admin/login');
        }
    }
 
    /**
    * Load the main view with all the current model model's data.
    * @return void
    */
    public function index()
    {

        //all the posts sent by the view
        $search_string = $this->input->post('search_string');        
        $order = $this->input->post('order'); 
        $order_type = $this->input->post('order_type'); 
        $payment = $this->input->post('payment');

        //pagination settings
        $config['per_page'] = 20;
        $config['base_url'] = base_url().'admin/checkout';
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = 20;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '</a></li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';

        //limit end
        // $page = 0;
        // if(isset($_GET['per_page']))
        //   $page = $_GET['per_page'];
        $page = $this->uri->segment(3);

        //math to get the initial record to be select in the database
        $limit_end = ($page * $config['per_page']) - $config['per_page'];
        if ($limit_end < 0){
            $limit_end = 0;
        } 

        //if order type was changed
        if($order_type){
            $filter_session_data['order_type'] = $order_type;
        }
        else{
            //we have something stored in the session? 
            if($this->session->userdata('order_type')){
                $order_type = $this->session->userdata('order_type');    
            }else{
                //if we have nothing inside session, so it's the default "Asc"
                $order_type = 'DESC';    
            }
        }
        //make the data type var avaible to our view
        $data['order_type_selected'] = $order_type;        


        //we must avoid a page reload with the previous session data
        //if any filter post was sent, then it's the first time we load the content
        //in this case we clean the session filter data
        //if any filter post was sent but we are in some page, we must load the session data

        //filtered && || paginated
        if($search_string !== false && $order !== false || $this->uri->segment(3) == true){ 
           
            /*
            The comments here are the same for line 79 until 99

            if post is not null, we store it in session data array
            if is null, we use the session data already stored
            we save order into the the var to load the view with the param already selected       
            */
            if($search_string){
                $filter_session_data['search_string_selected'] = $search_string;
            }else{
                $search_string = $this->session->userdata('search_string_selected');
            }
            $data['search_string_selected'] = $search_string;

            if($order){
                $filter_session_data['order'] = $order;
            }else{
                $order = $this->session->userdata('order');
            }
            $data['order'] = $order;

            // if($payment) {
            //   $filter = $payment;
            // } else {
            //   $filter = '';
            // }

            //save session data into the session
            if(isset($filter_session_data)){
              $this->session->set_userdata($filter_session_data);    
            }
            
            //fetch sql data into arrays
            $data['count_checkout']= $this->checkout_model->count_checkout($search_string, $order);
            $config['total_rows'] = $data['count_checkout'];

            //fetch sql data into arrays
            if($search_string){
                if($order){
                    $data['checkout'] = $this->checkout_model->get_checkout($search_string, $order, $order_type, $config['per_page'],$limit_end);        
                }else{
                    $data['checkout'] = $this->checkout_model->get_checkout($search_string, '', $order_type, $config['per_page'],$limit_end);           
                }
            }else{
                if($order){
                    $data['checkout'] = $this->checkout_model->get_checkout('', $order, $order_type, $config['per_page'],$limit_end);        
                }else{
                    $data['checkout'] = $this->checkout_model->get_checkout('', '', $order_type, $config['per_page'],$limit_end);        
                }
            }

        }else{

            //clean filter data inside section
            $filter_session_data['search_string_selected'] = null;
            $filter_session_data['order'] = null;
            $filter_session_data['order_type'] = null;
            $this->session->set_userdata($filter_session_data);

            //pre selected options
            $data['search_string_selected'] = '';
            $data['order'] = 'id';

            //fetch sql data into arrays
            $data['count_checkout']= $this->checkout_model->count_checkout();
            $data['checkout'] = $this->checkout_model->get_checkout('', '', $order_type, $config['per_page'],$limit_end);        
            $config['total_rows'] = $data['count_checkout'];

        }//!isset($search_string) && !isset($order)
         
        //initializate the panination helper 
        $this->pagination->initialize($config);   


        //load the view
        $data['main_content'] = 'admin/checkout/list';
        $data['customer'] = $this->checkout_model->getCustomer();
        $this->load->view('includes/template', $data);  

    }//index
    
    
    public function out($id=null)
    {
      header("Content-Type: text/html; charset=utf-8");
      // $checkin_id = $this->uri->segment(4);
      $checkin_id = $id;
      $extra = [];
      $room_no = $this->checkout_model->get_roomno($checkin_id);
      $payment_data =[];
      $payment_detail_data =[];
      $room_number=$this->db->query("SELECT * FROM tbl_room where id IN ('".implode("','", explode(',',$room_no[0]['room_no']))."')")->row()->room_no;
      $this->checkout_model->free_room($room_no[0]['room_no']) ; 
      $time = $this->checkout_model->check_time($checkin_id);
      $paytime = $this->checkout_model->paytime($checkin_id);
      //echo $room_no->room_no; die();
      // var_dump($paytime);die();

      $cur_date=date('Y-m-d H:i:s');
      $d1=date_create($paytime->date_in);
      $d2=date_create($cur_date);
      $result = date_diff($d1,$d2);

      $sum_date=$result->days;
      //var_dump($cur_date);die();

      // ========================================end count date==========================
      //echo $room_no->room_no; die();
      //print_r($paytime); die();
      $realprice = $this->checkout_model->getrealprice($room_no[0]['room_no']);

       //var_dump($realprice);die();
      if ($paytime->checkin_type ) {//== 11 OR $paytime->checkin_type == 12
        if ($sum_date == $sum_date) {
          $extra = array('overtime'=>$time->price*$sum_date);
          // $extra =$time->price*$sum_date;
        }else{
          $extra = array('overtime' => $time->amount);
          // $extra="no";
        }
      }
      // ===========================|end update 28 02 2018|=================

      // $ftime = substr($paytime->date_in,11);
      // $ltime = substr($paytime->date_out,11,-3); 
      // $ltime = date("G", strtotime($paytime->date_out));

      // date_default_timezone_set("Asia/Phnom_penh");
      // $timenow = date("G:i A");
      // $realtime = date("G");
      //$timeout = substr($time->date_out,13);

      // if($paytime->checkin_type == 1 OR $paytime->checkin_type == 6)
      // {
      //   if($timenow >= "12:00 PM" && $timenow <= "13:00 PM" )
      //   {
      //      $extra = array('overtime' => 5);
      //    }else if($timenow > "13:00 PM" && $timenow <= "15:00 PM")
      //    {
      //     $x = $time->amount / 2;
      //     $extra = array('overtime' => $x);
      //   }else if( $timenow > "15:00 PM" && $timenow <= "24:00 PM")
      //   {
      //     $extra = array('overtime' => $time->amount);
      //   }else{
      //     $extra = array('overtime' => ($time->amount));
      //   }
      // }else{

      //   if($realtime > $ltime)
      //   {
      //     //echo "No::".$realtime.' '.$ltime; die();
      //     $extra = array('amount' => $realprice->price);
      //   }else{
      //     $extra = array('amount' => $time->amount);
      //     //echo  "Yes".$realtime.' '.$ltime; die();
      //   }
      // }

        //print_r($extra); die();
        // $ch_card=$this->check_card($room_number);
        // if ($ch_card == 'RD') {
      if($extra){
        $this->db->where('checkin_id', $checkin_id)
                   ->where('item_name', 'staying')
                   ->update('tbl_checkin_detail', $extra);
      }

      // Check is Add Exstra

       $rate=$this->db->where('symbol','R')->get('tbl_currencies')->row()->cur_exchange;
        // print_r($data['exchange_rate']);die();
        $items = $this->checkout_model->load_item($id);
        $data['items'] = $items['room'];
        $data['sales'] = $items['sales'];

        $row_checkin =  $this->db->where('id',$id)->get('tbl_checkin')->row();
        $cid = $row_checkin->customer_id;
        $data['row_checkin'] = $row_checkin;
        $data['customer'] =  $this->checkout_model->load_customer_name($cid);
        $Rest = $this->load->database('rest', TRUE);

        // $sales = $Rest->query("SELECT s.* FROM sma_sales s
        //                                 WHERE s.hotel_checkin_id = '$id' AND s.payment_status ='due'
        //                                 ")->result();
        // if ($sales) {
        //   foreach ($sales as $sale) {
        //     $data_sales = [
        //       'payment_status' => 'paid',
        //       'paid'=>$sale->grand_total,
        //       'pos' => 2
        //     ];
        //     $Rest->where('id',$sale->id)->update('sma_sales',$data_sales);
        //   }
        // }
        
        $checkin_data = $this->db->query("SELECT ch_dt.*,room_t.type,ch.bank_amount,b.account_name as bank 
                                        FROM tbl_checkin_detail ch_dt 
                                        LEFT JOIN tbl_roomtype room_t ON room_t.id = ch_dt.room_type
                                        LEFT JOIN tbl_checkin ch
                                        ON ch.id=ch_dt.checkin_id
                                        LEFT JOIN tbl_bank b 
                                        ON b.id=ch.bank_id
                                        WHERE ch_dt.checkin_id = '$id' AND ch_dt.is_pay = 0 ")->result();

        $is_payment = $this->db->where('checkin_id',$id)->where('is_pay',0)->update('tbl_checkin_detail',['is_pay'=>1]);
        
        $i = 1; 
        $total = 0; 
        $totals = 0; 
        $tqty = 0;
        $sales_total = 0;
        $dicount_p = 0;
        $extra_ch = 0;
        $data_table = "";
        $room_no = "";
        $extra_charge = 0;
        $deposit_price = 0;
        $total_pay = 0;
        $total_pay_riel = 0;
        $dicount_text = '';
        $total_extra = 0;

        if($row_checkin->pay == 'unpay'){
          $extra_charge = $row_checkin->extra_charges;
        }
        
              $data_table .= '<tbody>';
        foreach ($checkin_data as $checkin) {
            if($checkin->room_id > 0){
                $data_table .= '<tr>';
                $data_table .= '<td class="text-center">'.$i++.'</td>';
                $data_table .= '<td colspan="2">'.$checkin->type.' ( '.$checkin->room_no.' )</td>';
                $data_table .= '<td class="text-center">'.$checkin->price_more.'</td>';
                $data_table .= '<td class="text-center">'.$checkin->qty.'</td>';
                $data_table .= '<td class="text-right">'.number_format($checkin->amount,2).'</td>';
                $total += str_replace(',', '', number_format($checkin->amount,2));
                $data_table .= '</tr>';
                $payment_detail_data[] = [
                                        'payment_id'        => '',
                                        'checkindetail_id'  => $checkin->detail_id,
                                        'room_id'           => $checkin->room_id,
                                        'sale_id'           => null,
                                        'item_name'         => $checkin->type.' ( '.$checkin->room_no.' )',
                                        'status'            => 'room',
                                        'amount'            => str_replace(',', '', number_format($checkin->amount,2))
                                    ];

            }else{
                $data_table .= '<tr>';
                $data_table .= '<td class="text-center">'.$i++.'</td>';
                $data_table .= '<td colspan="2">'.$checkin->item_name.'</td>';
                $data_table .= '<td class="text-center">'.$checkin->price.'</td>';
                $data_table .= '<td class="text-center">'.$checkin->qty.'</td>';
                $data_table .= '<td class="text-right">'.number_format($checkin->amount,2).'</td>';
                $data_table .= '</tr>';
                $total_extra += str_replace(',', '', number_format($checkin->amount,2));
                $payment_detail_data[] = [
                                        'payment_id'        => '',
                                        'checkindetail_id'  => $checkin->detail_id,
                                        'room_id'           => null,
                                        'sale_id'           => null,
                                        'item_name'         => $checkin->item_name,
                                        'status'            => 'extra_item',
                                        'amount'            => str_replace(',', '', number_format($checkin->amount,2))
                                    ];
            }
        }
        if($extra_charge > 0){
            $data_table .= '<tr>';
            $data_table .= '<td class="text-center">'.$i++.'</td>';
            $data_table .= '<td colspan="3"><span style="margin:0px 5px 0px 10px"></span>
                        Extra Charges</td>';
            $data_table .= '<td class="text-center"></td>';
            $data_table .= '<td class="text-right">'.number_format($extra_charge,2).'</td>';
            $data_table .= '</tr>';
            $total_extra += str_replace(',', '', number_format($extra_charge,2));
            $payment_detail_data[] = [
                                        'payment_id'        => '',
                                        'checkindetail_id'  => null,
                                        'room_id'           => null,
                                        'sale_id'           => null,
                                        'item_name'         => 'Extra Charges',
                                        'status'            => 'extra_charges',
                                        'amount'            => str_replace(',', '', number_format($extra_charge,2))
                                    ];
        }
        if($sales){
            foreach ($sales as $sale_res) {
                $data_table .= '<tr>';
                $data_table .= '<td class="text-center">'.$i++.'</td>';
                $data_table .= '<td colspan="2">'.$sale_res->reference_no.'</td>';
                $data_table .= '<td class="text-center">'.number_format($sale_res->grand_total,2).'</td>';
                $data_table .= '<td class="text-center">1</td>';
                $data_table .= '<td class="text-right">'.number_format($sale_res->grand_total,2).'</td>';
                $data_table .= '</tr>';
                $sales_total += str_replace(',', '', number_format($sale_res->grand_total,2));
                $payment_detail_data[] = [
                                        'payment_id'        => '',
                                        'checkindetail_id'  => null,
                                        'room_id'           => null,
                                        'sale_id'           => $sale_res->id,
                                        'item_name'         => $sale_res->reference_no,
                                        'status'            => 'pos_sale',
                                        'amount'            => str_replace(',', '', number_format($sale_res->grand_total,2))
                                    ];
            }
            
        }


            for ($j=$i; $j <=6 ; $j++) { 
                $data_table .= '<tr>';
                $data_table .= '<td class="text-center">'.$j.'</td>';
                $data_table .= '<td colspan="2">'.''.'</td>';
                $data_table .= '<td>'.''.'</td>';
                $data_table .= '<td>'.''.'</td>';
                $data_table .= '<td>'.''.'</td>';
                $data_table .= '</tr>';
            }

            $data_table .= '</tbody>';
            $rows = '';
            if ($row_checkin->reserv_id != 0) {
                $rows = 6;
                if($row_checkin->pay == 'unpay'){
                  $deposit_price = $row_checkin->deposit;
                }
                
            }else{
                $rows = 5;
            }
            $percentage = '%';
            $discount = $row_checkin->discount;
            if($row_checkin->percent_dis){
                $discount = $row_checkin->percent_dis;
            }
            if(!$row_checkin->pay == 'unpay'){
              $discount = 0;
                if($discount !='' || $discount > 0){
                  $discount_fix =  $discount;
                  if (isset($discount_fix)) {
                      $dis_fix = $discount_fix;
                      $dpos = strpos($dis_fix, $percentage);
                      if ($dpos !== false) {
                          $pds = explode("%", $dis_fix);
                          $dicount_text = '('.$row_checkin->percent_dis.')';
                          $discount_usd = str_replace(',', '', number_format((($total * ((Float)($pds[0])) / 100)),2));
                      } else {
                          $discount_usd = str_replace(',', '', number_format((Float)($discount),2));
                      }
                  }
                  $dicount_p =  $discount_usd;
              }
            }
            

            $total_pay = $total + $sales_total + $total_extra - ($deposit_price + $dicount_p);
            $total_pay_riel​ = $total_pay * $rate;
            if($row_checkin->pay == 'unpay'){
               $pay = array('pay' => 'pay');
                $this->db->where('id',$id)->update('tbl_checkin',$pay);
                $status =  array('status' => 0);
                $this->db->where('checkin_id',$id)->update('tbl_checkin_detail',$status); 
            }


            $data_table .='<tfoot>';
                $data_table .= '<tr>';
                $data_table .= '<th colspan="3" rowspan="'.$rows.'" style="vertical-align:center !important;"><span>Exch rate :</span><span>'.$rate.'&nbsp;៛</span></th>';
                $data_table .= '<th class="text-right" style="white-space: nowrap !important;">Sub Total(USD)</th>';
                $data_table .= '<th colspan="2" class="text-right" style="white-space: nowrap !important;">$ '.(number_format($total + $sales_total + $total_extra,2)).'</th>';
                $data_table .= '</tr>';

                if($row_checkin->reserv_id != 0){
                    $data_table .= '<tr>';
                    $data_table .= '<th class="text-right">Deposit</th>';
                    $data_table .= '<th colspan="2" style="text-align: right;">$ '.number_format($deposit_price,2).'</th>';
                    $data_table .= '</tr>';
                }
                $data_table .= '<tr>';
                $data_table .= '<th class="text-right">Discount '.$dicount_text.'</th>';
                $data_table .= '<th colspan="2" style="text-align: right;">$ '.number_format($dicount_p,2).'</th>';
                $data_table .= '</tr>';

                $data_table .= '<tr>';
                $data_table .= '<th class="text-right">Total Pay(Cash)</th>';
                $data_table .= '<th colspan="2" style="text-align: right;">$ '.number_format($total_pay-$checkin->bank_amount,2).'</th>';
                $data_table .= '</tr>';

                $data_table .= '<tr>';
                $data_table .= '<th class="text-right">Total Pay('.$checkin->bank.')</th>';
                $data_table .= '<th colspan="2" style="text-align: right;">$ '.number_format($checkin->bank_amount,2).'</th>';
                $data_table .= '</tr>';

                $data_table .= '<tr>';
                $data_table .= '<th class="text-right">Total Pay(RIEL)</th>';
                $data_table .= '<th colspan="2" style="text-align: right;">៛ '.number_format($total_pay_riel​,0).'</th>';
                $data_table .= '</tr>';         

            $data_table .='</tfoot>';
            $payment_data = [
                'checkin_id'    => $id,
                'user_name'       => $this->session->userdata('user_name'),
                'date'          => date('Y-m-d H:i:s'),
                'deposit'       => $deposit_price,
                'discount'       => $discount,
                'total'         => ($row_checkin->total + $sales_total),
                'grand_total'   => $total_pay

            ];
        if($total_pay > 0){
          $pay_data = $this->checkin_model->payment($payment_data,$payment_detail_data);
        }

        $data['sales_total'] = $sales_total;
        $data['total'] = $total;
        $data['data_table'] = $data_table;

      if($this->checkout_model->checkout($checkin_id) == TRUE){
        $this->session->set_flashdata('flash_message', 'checkout');
        if($total_pay > 0){
          $this->load->view('admin/checkout/checkout_reciept', $data);
        }else{
          redirect('admin/checkout/');
        }
        

      }else{
        $this->session->set_flashdata('flash_message', 'not_checout');
        redirect('admin/checkout/');
      }
        //   echo ("<SCRIPT LANGUAGE='JavaScript'>
        //             window.alert('".lang('Card have been clear')."')
        //             window.location.href='http://localhost/sv_hotel/admin/checkout';
        //             </SCRIPT>");
        // }elseif ($ch_card == 'NC') {
        //   echo ("<SCRIPT LANGUAGE='JavaScript'>
        //             window.alert('".lang('Please put card on Encoder!')."')
        //             window.location.href='http://localhost/sv_hotel/admin/checkin';
        //             </SCRIPT>");
        // }elseif ($ch_card == 'ND') {
        //   echo ("<SCRIPT LANGUAGE='JavaScript'>
        //             window.alert('".lang('Card is Empty!')."');
        //             window.location.href='http://localhost/sv_hotel/admin/checkin';
        //             </SCRIPT>");
        // }elseif ($ch_card == 'WC') {
        //   echo ("<SCRIPT LANGUAGE='JavaScript'>
        //             window.alert('".lang('The Card Wrong Number')."');
        //             window.location.href='http://localhost/sv_hotel/admin/checkin';
        //             </SCRIPT>");
        // }elseif ($ch_card == 'ER') {
        //   echo ("<SCRIPT LANGUAGE='JavaScript'>
        //             window.alert('".lang('Error Clear Card')."');
        //             window.location.href='http://localhost/sv_hotel/admin/checkin';
        //             </SCRIPT>");
        // }
      
      // redirect('admin/checkout/');

    }
    function check_card($room_out){
      // ====================================clear card===============================
      $fp = fsockopen("127.0.0.1", 8000, $errno, $errstr, 30);
            if (!$fp) {
                echo "$errstr ($errno)<br />\n";
            } 
            else {
                $con_string = "00000E";
                
                $msg = chr(2).$con_string.chr(3);

                fwrite($fp, $msg);
                $buffer = fread($fp, 4096);
                $buf=count(explode('|', $buffer));
                if ($buf==1) {
                  fclose($fp);
                  return 'NC';
                }elseif ($buf<=3) {
                  fclose($fp);
                  return 'ND';
                }elseif ($buf>3) {
                   $room_card = str_replace('R','',explode('|', $buffer)[3]);
                   if ($room_card == $room_out) {
                     //Right Card
                    fclose($fp);
                    if ($this->clear_card() == true) {
                      return 'RD';
                    }else{
                      //error
                      return 'ER';
                    }
                  
                   }else{
                    //wrong Card
                    fclose($fp);
                    return 'WC';
                   }
                  
                }
              }

      // ====================================end clear card===============================
    }
    function clear_card(){
      $fp = fsockopen("127.0.0.1", 8000, $errno, $errstr, 30);
      $con_string = "00000B";
      $msg = chr(2).$con_string.chr(3);

      fwrite($fp, $msg);
      $buffer = fread($fp, 4096);

      fclose($fp);

        return true;
    }
    function reciept($id = null, $cid = null)
    {
        // $id=$this->uri->segment(4);
        // $pay = array('pay' => 'pay');
        // $this->db->where('id',$id)->update('tbl_checkin',$pay);
        // $status =  array('status' => 0);
        // $this->db->where('checkin_id',$id)->update('tbl_checkin_detail',$status); 
        // $this->load->model('currencies_model');
        // $data['exchange_rate']=$this->currencies_model->get_cure();
        $data['items'] = $this->checkout_model->load_item($id);
        $data['row_checkin'] = $this->db->where('id',$id)->get('tbl_checkin')->row();
        $data['customer'] =  $this->checkout_model->load_customer_name($cid);
        $this->load->view('admin/checkout/reciept_new', $data);
    }
    
    function pay($id) 
    {
      if($id) {
        $Rest = $this->load->database('rest', TRUE);

        $this->db->where('id', $id)->update('tbl_checkin', array('pay' => 'pay'));

        $this->db->where('checkin_id',$id)->update('tbl_checkin_detail',array('status' => 0));
        // $Rest = $this->load->database('rest', TRUE);
        
        // $sales = $Rest->query("SELECT s.* FROM sma_sales s
        //                                 WHERE s.hotel_checkin_id = '$id' AND s.payment_status ='due'
        //                                 ")->result();
        // if ($sales) {
        //   foreach ($sales as $sale) {
        //     $data = [
        //       'payment_status' => 'paid',
        //       'paid'=>$sale->grand_total,
        //       'pos' => 2
        //     ];
        //     $Rest->where('id',$sale->id)->update('sma_sales',$data);
        //   }
        // }

        echo 'Payment is successfully!!!';
      } else {
        echo 'ID is not exist...';
      }
    }
    function checkout_all()
    {
        $did = $this->input->post('ch_store');
        $cid = $this->input->post('store_cus');
        $payment = $this->input->post('payment');


        if($payment == 1){

            $item = $this->checkout_model->load_item_all($did);
            foreach ($did as $id) {
                $pay = array('pay' => 'pay');
                $this->db->where('id',$id)->update('tbl_checkin',$pay);
                $status =  array('status' => 0);
                $this->db->where('checkin_id',$id)->update('tbl_checkin_detail',$status);
            }

            $cusid = $this->db->query("SELECT * FROM tbl_checkin  where id  = '$id' ")->row();



            $data['items'] = $item;
            if($cid !='')
                $c = $cid;
            else
                $c = $cusid->customer_id;
            $data['customer'] =  $this->checkout_model->load_customer_name($c);
		$data['row_checkin']= $cusid ;//$this->db->query("SELECT * FROM sma_checkin WHERE customer_id='$c'")->row();
            $this->load->view('admin/checkout/reciept', $data);

        }else{

            foreach ($did as $checkin_id) {

              $room_no = $this->checkout_model->get_roomno($checkin_id) ; 
              $this->checkout_model->free_room($room_no[0]['room_no']) ; 
              $time = $this->checkout_model->check_time($checkin_id);
              $paytime = $this->checkout_model->paytime($checkin_id);
              $realprice = $this->checkout_model->getrealprice($room_no[0]['room_no']);

              $ftime = substr($paytime->date_in,11);
              $ltime = substr($paytime->date_out,11);

              date_default_timezone_set("Asia/Phnom_penh");
              $timenow = date("G:i A");
              $realtime = date("G:i");
              //$timeout = substr($time->date_out,13);

              if($paytime->checkin_type == 1 OR $paytime->checkin_type == 6)
              {
                if($timenow >= "12:00 PM" && $timenow <= "13:00 PM" )
                {
                   $extra = array('overtime' => 5);
                }else if($timenow > "13:00 PM" && $timenow <= "15:00 PM")
                {
                  $x = $time->amount / 2;
                  $extra = array('overtime' => $x);
                }else if( $timenow > "15:00 PM" && $timenow <= "24:00 PM")
                {
                  $extra = array('overtime' => $time->amount);
                }else{
                  $extra = array('overtime' => ($time->amount));
                }
              }else{
                  if($realtime > $ltime)
                  {
                    $extra = array('amount' => $realprice->price);
                  }else{
                    $extra = array('amount' => $time->amount);
                  }
              }

              //print_r($extra); die();
               $this->db->where('checkin_id', $checkin_id)
                       ->where('item_name', 'staying')
                       ->update('tbl_checkin_detail', $extra);
              
            }

              
              if($this->checkout_model->checkout_all($did) == TRUE){
                $this->session->set_flashdata('flash_message', 'checkout');
              }else{
                $this->session->set_flashdata('flash_message', 'not_checout');
              }

              redirect('admin/checkout/');

        }

    }

    function get_reciept_all()
    {
      $this->load->model('currencies_model');
        $allid = $this->input->post('ch_store');
        foreach ($allid as $id) {
          $status =  array('status' => 0);
          $this->db->where('checkin_id',$id)->update('tbl_checkin_detail',$status); 
        }
        $cusid = $this->db->query("SELECT * FROM tbl_checkin  where id  = '$id' ")->row();
        // $data['cur']=$this->currencies_model->get_cure();
        $data['items'] = $this->checkout_model->load_item_all($allid);
        $data['customer'] =  $this->checkout_model->load_customer_name($cusid->customer_id);
        $this->load->view('admin/checkout/reciept', $data); 
    }
    function create_user()
    {
        $data['main_content'] = 'admin/user/list';
        $data['user'] = $this->checkout_model->getUser();
        // var_dump($data['user_type']);die;
        $this->load->view('includes/template', $data); 
    }
    function add_user()
    {
        $data['user_type'] = $this->db->get('sch_z_role')->result();
        $data['main_content'] = 'admin/user/add';
        $this->load->view('includes/template', $data); 
    }
    function save_user()
    {
      if ($this->input->server('REQUEST_METHOD') === 'POST')
      {
            $id = $this->input->post('uid');
            $data = array(
                  'first_name' => $this->input->post('fname'),
                  'last_name' => $this->input->post('lname'),
                  'email_addres' => $this->input->post('email'),
                  'user_name' => $this->input->post('username'),
                  'pass_word'  => md5($this->input->post('confirmpassword')),
                  'type' => $this->input->post('user_type'),
              );
            //form validation
            

            if($id !='')
            {
              $this->form_validation->set_rules('password', 'Password', 'required');
              $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

                if ($this->form_validation->run())
                {
                  if($this->db->where('id',$id)->update('tbl_employee',$data)){
                      $data['flash_message'] = TRUE; 
                  }else{
                      $data['flash_message'] = FALSE; 
                  }
                }

            }else{
              $this->form_validation->set_rules('password', 'Password', 'required');
              $this->form_validation->set_rules('username', 'User Name', 'trim|required|valid_p_name|is_unique[tbl_employee.user_name]');
              $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
              
              
              //if the form has passed through the validation
              if ($this->form_validation->run())
              {           
                  if($this->db->insert('tbl_employee',$data)){
                      $data['flash_message'] = TRUE; 
                      
                  }else{
                      $data['flash_message'] = FALSE; 
                  }
              }
          }

          $data['user_type'] = $this->db->get('sch_z_role')->result();

          $data['main_content'] = 'admin/user/add';
          $this->load->view('includes/template', $data); 
      }

       
    }
    function edit_user($id)
    {

      $data['x'] = $this->checkout_model->getUser_byID($id);
      $data['user_type'] = $this->db->get('sch_z_role')->result();
      $data['main_content'] = 'admin/user/edit';
      $this->load->view('includes/template', $data); 
    }
    function del_user($id)
    {
        $this->db->where('id',$id)->delete('tbl_employee');
        $data['main_content'] = 'admin/user/list';
        $data['user'] = $this->checkout_model->getUser();
        $this->load->view('includes/template', $data); 
    }
    function save_edit()
    {
      $id = $this->input->post('uid');
      $data = array(
            'first_name' => $this->input->post('fname'),
            'last_name' => $this->input->post('lname'),
            'email_addres' => $this->input->post('email'),
            'user_name' => $this->input->post('username'),
            'pass_word'  => md5($this->input->post('confirmpassword')),
            'type' => $this->input->post('user_type'),
        );
      //form validation
      
        $this->form_validation->set_rules('password', 'pass_word', 'required');
        $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

          if ($this->form_validation->run())
          {
            if($this->db->where('id',$id)->update('tbl_employee',$data)){
                $data['flash_message'] = TRUE; 
            }else{
                $data['flash_message'] = FALSE; 
            }
          }

      $data['x'] = $this->checkout_model->getUser_byID($id);
      $data['user_type'] = $this->db->get('sch_z_role')->result();
      $data['main_content'] = 'admin/user/edit';

      $this->load->view('includes/template', $data);

    }
    function eject($id)
    {
      $data = array('eject' => 0);
      $this->db->where('id',$id)->update('tbl_checkin',$data);
      redirect('admin/checkout');
    }

        
}