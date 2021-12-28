<?php
class Admin_Checkin extends CI_Controller {

    /**
    * name of the folder responsible for the views 
    * which are manipulated by this controller
    * @constant string
    */
    const VIEW_FOLDER = 'admin/checkin';
 
    /**
    * Responsable for auto load the model
    * @return void
    */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('checkin_model');
        $this->load->model('checkin_model');
        $this->load->model('room_model');
        $this->load->model('roomtype_model');
        $this->load->model('checkout_model');
        $this->load->model('staytime_model');
        $this->load->model('customer_model');
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

        //pagination settings
        $config['per_page'] = 20;

        $config['base_url'] = base_url().'admin/checkin';
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

        //limit end
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
            }
            else{
                $order = $this->session->userdata('order');
            }
            $data['order'] = $order;

            //save session data into the session
            if(isset($filter_session_data)){
              $this->session->set_userdata($filter_session_data);
            }
            
            //fetch sql data into arrays
            $data['count_checkin']= $this->checkin_model->count_checkin($search_string, $order);
            $config['total_rows'] = $data['count_checkin'];

            //fetch sql data into arrays
            if($search_string){
                if($order){
                    $data['checkin'] = $this->checkin_model->get_checkin($search_string, $order, $order_type, $config['per_page'],$limit_end);        
                }else{
                    $data['checkin'] = $this->checkin_model->get_checkin($search_string, '', $order_type, $config['per_page'],$limit_end);           
                }
            }else{
                if($order){
                    $data['checkin'] = $this->checkin_model->get_checkin('', $order, $order_type, $config['per_page'],$limit_end);        
                }else{
                    $data['checkin'] = $this->checkin_model->get_checkin('', '', $order_type, $config['per_page'],$limit_end);        
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
            $data['order'] = 'checkin_id';

            //fetch sql data into arrays
            $data['count_checkin']= $this->checkin_model->count_checkin();
            $data['checkin'] = $this->checkin_model->get_checkin('', '', $order_type, $config['per_page'],$limit_end);      
            // var_dump($data['checkin']);die();  
            $config['total_rows'] = $data['count_checkin'];

        }//!isset($search_string) && !isset($order)
        $data['checkinfield'] = $this->db->select(array('id','reserv_id','customer_id','date_in','date_out','room_no','discount','checkin_type','pay'))->get('tbl_checkin')->result_array();
         
        //initializate the panination helper 
        $this->pagination->initialize($config);


        //load the view
        $data['main_content'] = 'admin/checkin/list';
        $this->load->view('includes/template', $data);  

    }//index
    function edit_checkin($id){
        $checkin=$this->db->query("SELECT * FROM tbl_checkin_detail cd LEFT JOIN tbl_checkin c ON cd.checkin_id=c.id LEFT JOIN tbl_customer ct ON ct.id=c.customer_id 
            LEFT JOIN tbl_room r ON r.id=cd.room_id WHERE checkin_id=$id")->result();
            foreach ($checkin as $row) { 
                $data_table .='<tr>';
                        $data_table .='<td style="text-align:center;">'.$row->room_no.'</td>';
                        $data_table .='<td>'.date('d-m-Y H:i:s',strtotime($row->date_in)).'</td>';
                        $data_table .='<td>'.$row->Family.'</td>';
                        $data_table .='<td>'.$row->Mobile.'</td>';
                        $data_table .='<td>'.date('d-m-Y H:i:s',strtotime($row->date_out)).'</td>';
                        $data_table .='<td>'.$row->item_name.'</td>';
                        $data_table .='<td style="text-align:right;">'.number_format($row->amount,2).'</td>';
                        $total +=str_replace(',', '', number_format($row->amount,2)); 
                        $data_table .='<td>  
                                            <a href="'.base_url("admin_checkin").'/edit/'.$row->detail_id.'"<span class="btn btn-danger" id="modalSubscriptionForm">CheckOut</span></a>
                                       </td>';
                }
                $data_table .='</tr>';
            $pay_id = $row->pay_id;
        $data_table .='</tbody>';
        $data['from_date'] = $from_date;
        $data['to_date'] = $to_date;
        $data['type'] = $type;
        $data['main_content'] = 'admin/report/checkin_detail';
        $data['data_table'] = $data_table;
        $this->load->view('includes/template', $data);
    }
    function write_card($id){
        // $data= $this->db->select(array('date_in','date_out','room_no'))->where('id',$id)->get('tbl_checkin')->row();
        // $this->db->select('tbl_checkin.date_in,tbl_checkin.date_out,tbl_room.room_no');
        // $this->db->from('tbl_checkin');
        // $this->db->join('tbl_room','tbl_room.id=tbl_checkin.room_no','right');
        // $this->db->where('id',$id);
        // $data=$this->db->get();
        // return $data->result();
        // $data=date_parse('date_in');
        // echo $data->date_in;
        // echo $data->date_out;
        // echo $data->room_no;
        $data=$this->checkin_model->get_card_data($id);
        // print_r($data);die();
        $date_in= date('YmdHs',strtotime($data->date_in));
        $date_out=date('YmdHs',strtotime($data->date_out));
         // print_r($date_in);die();
         $fp = fsockopen("127.0.0.1", 8000, $errno, $errstr, 30);
            if (!$fp) {
                echo "$errstr ($errno)<br />\n";
            } 
            else {
                // $con_string = "00000E"; //READ CARD
                $con_string = "00000I|R".$data->room_no."|T04|D".$date_in."|O".$date_out; // WRITE CARD EXAMPLE
                // print_r($con_string);die();
                // 00000B //CHECK OUT(Empty Card)
                // $con_string ="00000I|R101|T04|D200901141300|O200901171800";
                
                $msg = chr(2).$con_string.chr(3);
                fwrite($fp, $msg);
                $buffer = fread($fp, 4096);
                // if ($buffer = fread($fp, 0)) {
                //     echo ("<SCRIPT LANGUAGE='JavaScript'>
                //     window.alert('No Card')
                //     window.location.href='http://localhost/sv_hotel/admin/checkin';
                //     </SCRIPT>");
                // }
                echo ("<SCRIPT LANGUAGE='JavaScript'>
                    window.alert('".$buffer."')
                    window.location.href='http://localhost/sv_hotel/admin/checkin';
                    </SCRIPT>");
                echo $buffer;
                fclose($fp);
            }
    }

     function read_card(){
        header("Content-Type:text/html; charset=utf-8");
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
                  echo ("<SCRIPT LANGUAGE='JavaScript'>
                    window.alert('".lang('Please put card on Encoder!')."');
                    window.location.href='http://localhost/sv_hotel/admin/checkin';
                    </SCRIPT>");
                }elseif ($buf<=3) {
                  fclose($fp);
                  echo ("<SCRIPT LANGUAGE='JavaScript'>
                    window.alert('".lang('Card is Empty!')."');
                    window.location.href='http://localhost/sv_hotel/admin/checkin';
                    </SCRIPT>");
                }elseif ($buf>3) {
                   $room_card = str_replace('R','',explode('|', $buffer)[3]);
                   // $r_d= str_replace('D','',explode('|', $buffer)[5]);
                   // $r_do= str_replace('O','',explode('|', $buffer)[6]);
                   
                    fclose($fp);
                    echo ("<SCRIPT LANGUAGE='JavaScript'>
                    window.alert('".lang('Room').$room_card."');
                    window.location.href='http://localhost/sv_hotel/admin/checkin';
                    </SCRIPT>");
                    
                  
                   }
                  
                }
             
    }
    public function multi_add()
    {
        
        //if save button was clicked, get the data sent via post
        
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            //form validation
            $this->form_validation->set_rules('customer_id', 'customer_id', 'required');
            $this->form_validation->set_rules('date_in', 'CheckIn Date', 'required');
            $this->form_validation->set_rules('date_out', 'CheckOut Date', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">x</a><strong>', '</strong></div>');
            $this->form_validation->set_rules('reserva_rootype_id','select room number','required');

            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
                $i = isset($_POST['reserva_rootype_id']) ? sizeof($_POST['reserva_rootype_id']) : 0;
                // var_dump($i);die();
                for ($r=0; $r < $i; $r++) { 
                    $r_type     = $_POST['reserva_rootype_id'][$r];
                    $r_no[]       = $_POST['reserva_room_id'][$r];
                    $r_floor    = $_POST['reserva_floor'][$r];
                    $r_time     = $_POST['reserva_chekin_type'][$r];
                    $r_price     = $_POST['reserva_price'][$r];
                    $r_amount     = $_POST['reserva_amount'][$r];

                }

                $romm_checkin = implode(',',$r_no);
                // var_dump($romm_checkin);die();

                    // ==================================function confirmed card===============================
                // $con_card=$this->confirm_card();
                // if ($con_card == 'ND') {
                     $data_to_store  = array(
                        'customer_id'   => $this->input->post('customer_id'),
                        'date_in'       => $this->input->post('date_in'),
                        'date_out'      => $this->input->post('date_out'),
                        'staying'       => $this->input->post('duration'),
                        'extra_charges' => $this->input->post('extra_charges'),
                        'total'      => $this->input->post('total'),
                        'grand_total'      => $this->input->post('grand_total'),
                        'bank_id'    => $this->input->post('bank_name'),
                        'account_name'    => $this->input->post('account_name'),
                        'note'    => $this->input->post('note'),
                        'account_number'    => $this->input->post('account_number'),
                        'bank_amount'       =>$this->input->post('bank_amount'),
                        'pay'           => 'unpay',
                        'time'          => '',
                        'checkin_type'  => 13,
                        'user'          => $this->session->userdata('user_name'),
                        'multi_checkin' => 'multiple',
                    );
                    // var_dump($data_to_store);die;
                    $dis   = $this->input->post('discount');
                    $room  = $romm_checkin;
                    $stay  = $this->input->post('duration');
                    $price = $this->checkin_model->get_price($room);
                    $price_more_data = $this->checkin_model->get_price_more($room);
                    $price_more = [];
                    foreach ($price_more_data as $price_m) {
                       $price_more[] = $price_m->price;
                    }

                    $price_more = (implode(",", $price_more));

                    $percentage = '%';
                    $discount = $this->input->post('discount');
                    if($discount !='' || $discount > 0){
                        $discount_fix =  $discount;
                        if (isset($discount_fix)) {
                            $dis_fix = $discount_fix;
                            $dpos = strpos($dis_fix, $percentage);
                            if ($dpos !== false) {
                               $data_to_store['percent_dis'] = $discount;
                            } else {
                              $data_to_store['discount'] = $discount;
                            }
                        }
                    }


                    // $p = $price->price * $stay;
                    // $per = ($p * $dis) / 100;
                    // $amount = $p - $per;

                    $reserva_room_id = $_POST['reserva_room_id'];
                    $reserva_rootype_id = $_POST['reserva_rootype_id'];
                    $reserva_chekin_type = $_POST['reserva_chekin_type'];
                    $reserva_floor = $_POST['reserva_floor'];
                    $reserva_room_no = $_POST['reserva_room_no'];
                    $reserva_price = $_POST['reserva_price'];
                    $reserva_amount = $_POST['reserva_amount'];
                    $price = 0;
                    
                    
                    //if the insert has returned true then we show the flash message
                    if($romm_checkin != 0) {
                        $room_number = $romm_checkin;
                        $data_to_store['room_no'] = $romm_checkin;
                    } else {
                        $room_number = $romm_checkin;
                        $data_to_store['room_no'] = $romm_checkin;
                    }
                    // var_dump($room_number);die();
                    $ch_id = '';
                    if($data_to_store){
                        $this->checkin_model->set_bussy($room_number); 
                        $ch_id = $this->checkin_model->store_checkin_new($data_to_store);
                    }

                    for ($reserva=0; $reserva <= (count($reserva_room_id) -1); $reserva++) { 
                        $price = $this->checkin_model->get_price_by_id($reserva_room_id[$reserva]);
                        $detail[] = array(
                            'checkin_id'      => $ch_id,
                            'room_id'      => $reserva_room_id[$reserva],
                            'room_no'      => $reserva_room_no[$reserva],
                            'room_type'    => $reserva_rootype_id[$reserva],
                            'price'        => $price->price,
                            'qty'          => $this->input->post('duration'),
                            'item_name'    => "staying",
                            'date_order'   => date('Y-m-d'),
                            'discount'     => $this->input->post('discount'),
                            'amount'       => $reserva_amount[$reserva],
                            'current_date' => date('Y-m-d'),
                            'price_more' => $reserva_price[$reserva]
                        );
                    }

                    $check_detail = $this->checkin_model->store_checkin_detail($detail);


                    // $get_data=$this->checkin_model->store_checkin($data_to_store,$detail);
                    // $this->db->select('tbl_checkin.date_in,tbl_checkin.date_out,tbl_room.room_no');
                    // $this->db->from('tbl_checkin');
                    // $this->db->join('tbl_room','tbl_room.id=tbl_checkin.room_no','left');
                    // $this->db->where('tbl_checkin.id',$ch);
                    // $get_data=$this->db->get()->row();
                    // if($get_data){
                    //     $data['flash_message'] = TRUE;
                    //     $this->write_key();
                    //     $date_in= date('YmdHs',strtotime($get_data->date_in));
                    //     $date_out=date('YmdHs',strtotime($get_data->date_out));
                    //      $fp = fsockopen("127.0.0.1", 8000, $errno, $errstr, 30);
                    //         if (!$fp) {
                    //             echo "$errstr ($errno)<br />\n";
                    //         } 
                    //         else {
                    //             // $con_string = "00000E"; //READ CARD
                    //             $con_string = "00000I|R".$get_data->room_no."|T04|D".$date_in."|O".$date_out; // WRITE CARD EXAMPLE
                    //             // print_r($con_string);die();
                    //             // 00000B //CHECK OUT(Empty Card)
                    //             // $con_string ="00000I|R101|T04|D200901141300|O200901171800";
                                
                    //             $msg = chr(2).$con_string.chr(3);
                    //             fwrite($fp, $msg);
                    //             $buffer = fread($fp, 4096);
                    //             echo ("<SCRIPT LANGUAGE='JavaScript'>
                    //                 window.alert('".$buffer."')
                    //                 window.location.href='http://localhost/sv_hotel/admin/checkin';
                    //                 </SCRIPT>");
                    //             // echo $buffer;
                    //             fclose($fp);
                    //         }
                        
                    // }else{
                    //     $data['flash_message'] = FALSE; 
                    // }
                    // print_r($data_to_store);
                    // print_r($detail);
                // }elseif ($con_card == 'NC') {
                //     echo ("<SCRIPT LANGUAGE='JavaScript'>
                //             window.alert('".lang('Please put card on Encoder!')."');
                //             window.location.href='http://localhost/sv_hotel/admin/checkin/add';
                //             </SCRIPT>");
                // }elseif ($con_card == 'HD') {
                //     echo ("<SCRIPT LANGUAGE='JavaScript'>
                //             window.alert('".lang('Your Card is Have data!')."');
                //             window.location.href='http://localhost/sv_hotel/admin/checkin/add';
                //             </SCRIPT>");
                // }
                // var_dump($_price);die();
            }
        }

        if($this->input->get('roomtype')) {
            $check_roomtype = $this->db->where('id', $this->input->get('roomtype'))->get('tbl_roomtype')->row();
        }
        $data['staytime'] = $this->staytime_model->get_staytime_all($this->input->get('type'));
        $data['customer'] = $this->checkin_model->get_customer();

        $data['free_rooms'] = $this->room_model->get_free_room();
        $data['room_type'] = $this->roomtype_model->get_roomtype_all();
        $data['banks'] = $this->checkin_model->getAllbanks();
        //load the view
        $data['main_content'] = 'admin/checkin/multi_add';
        $this->load->view('includes/template', $data);
        if ($data_to_store) {
            redirect('admin/show_rooms');
        }
    
        // $this->index(); 
    }

    public function add()
    {
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {

            //form validation
            $this->form_validation->set_rules('customer_id', 'customer_id', 'required');
            $this->form_validation->set_rules('date_in', 'CheckIn Date', 'required');
            $this->form_validation->set_rules('date_out', 'CheckOut Date', 'required');
            $this->form_validation->set_rules('room_no','select room number','required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
                
                
// ==================================function confirmed card===============================
                // $con_card=$this->confirm_card();
                // if ($con_card == 'ND') {
                    $data_to_store  = array(
                        'customer_id'   => $this->input->post('customer_id'),
                        'date_in'       => date('Y-m-d H:i:s',strtotime($this->input->post('date_in').''.date('H:i:s'))),
                        'date_out'      => $this->input->post('date_out'),
                        'staying'       => $this->input->post('duration'),
                        'extra_charges' => $this->input->post('extra_charges'),
                        'discount'      => $this->input->post('discount'),
                        'total'      => $this->input->post('total'),
                        'price'      => $this->input->post('Price'),
                        'grand_total'      => $this->input->post('grand_total'),
                        'bank_id'       =>$this->input->post('bank'),
                        'account_name'       =>$this->input->post('account_name'),
                        'account_number'       =>$this->input->post('account_number'),
                        'bank_amount'       =>$this->input->post('bank_amount'),
                        'note'       =>$this->input->post('note'),
                        'pay'           => 'unpay',
                        'time'          => '',
                        'checkin_type'  => $this->input->post('chtype'),
                        'user'          => $this->session->userdata('user_name'),
                    );

                    
                    $dis   = $this->input->post('discount');
                    $room  = $this->input->post('chtype');
                    $stay  = $this->input->post('duration');

                    $price = $this->checkin_model->get_price($room);

                    $percentage = '%';
                    $discount = $this->input->post('discount');
                    if($discount !='' || $discount > 0){
                        $discount_fix =  $discount;
                        if (isset($discount_fix)) {
                            $dis_fix = $discount_fix;
                            $dpos = strpos($dis_fix, $percentage);
                            if ($dpos !== false) {
                               $data_to_store['percent_dis'] = $discount;
                            } else {
                              $data_to_store['discount'] = $discount;
                            }
                        }
                    }
                    $p = $price->price * $stay;


                    $per = ($p * $dis) / 100;
                    $amount = $p - $per;
                    $mul_det = $this->checkin_model->get_room_by_id($this->input->post('room_no'))->room_no;
                    $detail = array(
                        'price'        => $price->price,
                        'room_id'        => $this->input->post('room_no'),
                        'room_type'        => $this->input->post('roomtype'),
                        'room_no'        => $mul_det,
                        'qty'          => $this->input->post('duration'),
                        'item_name'    => "staying",
                        'date_order'   => date('Y-m-d'),
                        'discount'     => $this->input->post('discount'),
                        'amount'       => $this->input->post('total'),
                        'current_date' => date('Y-m-d'),
                        'price_more' => $this->input->post('Price')
                        );
                    //if the insert has returned true then we show the flash message
                    
                    if($this->input->post('roomnumber') != 0) {
                        $room_number = $this->input->post('roomnumber');
                        $data_to_store['room_no'] = $this->input->post('roomnumber');
                    } else {
                        $room_number = $this->input->post('room_no');
                        $data_to_store['room_no'] = $this->input->post('room_no');
                    }
                    $this->checkin_model->set_bussy($room_number); 
                    $ch=$this->checkin_model->store_checkin($data_to_store,$detail);
                    // $get_data=$this->checkin_model->store_checkin($data_to_store,$detail);
                    // $this->db->select('tbl_checkin.date_in,tbl_checkin.date_out,tbl_room.room_no');
                    // $this->db->from('tbl_checkin');
                    // $this->db->join('tbl_room','tbl_room.id=tbl_checkin.room_no','left');
                    // $this->db->where('tbl_checkin.id',$ch);
                    // $get_data=$this->db->get()->row();
                    // // var_dump($get_data);die();
                    // if($get_data){
                    //     $data['flash_message'] = TRUE;
                    //     $this->write_key();
                    //     $date_in= date('YmdHs',strtotime($get_data->date_in));
                    //     $date_out=date('YmdHs',strtotime($get_data->date_out));
                    //      // print_r($date_in);die();
                    //      $fp = fsockopen("127.0.0.1", 8000, $errno, $errstr, 30);
                    //         if (!$fp) {
                    //             echo "$errstr ($errno)<br />\n";
                    //         } 
                    //         else {
                    //             // $con_string = "00000E"; //READ CARD
                    //             $con_string = "00000I|R".$get_data->room_no."|T04|D".$date_in."|O".$date_out; // WRITE CARD EXAMPLE
                    //             // print_r($con_string);die();
                    //             // 00000B //CHECK OUT(Empty Card)
                    //             // $con_string ="00000I|R101|T04|D200901141300|O200901171800";
                                
                    //             $msg = chr(2).$con_string.chr(3);
                    //             fwrite($fp, $msg);
                    //             $buffer = fread($fp, 4096);
                    //             echo ("<SCRIPT LANGUAGE='JavaScript'>
                    //                 window.alert('".$buffer."')
                    //                 window.location.href='http://localhost/sv_hotel/admin/checkin';
                    //                 </SCRIPT>");
                    //             // echo $buffer;
                    //             fclose($fp);
                    //         }
                        
                    // }else{
                    //     $data['flash_message'] = FALSE; 
                    // }
                    // print_r($data_to_store);
                    // print_r($detail);
                // }elseif ($con_card == 'NC') {
                //     echo ("<SCRIPT LANGUAGE='JavaScript'>
                //             window.alert('".lang('Please put card on Encoder!')."');
                //             window.location.href='http://localhost/sv_hotel/admin/checkin/add';
                //             </SCRIPT>");
                // }elseif ($con_card == 'HD') {
                //     echo ("<SCRIPT LANGUAGE='JavaScript'>
                //             window.alert('".lang('Your Card is Have data!')."');
                //             window.location.href='http://localhost/sv_hotel/admin/checkin/add';
                //             </SCRIPT>");
                // }
                

            }
        }

        if($this->input->get('roomtype')) {
            $check_roomtype = $this->db->where('id', $this->input->get('roomtype'))->get('tbl_roomtype')->row();
        }
        $data['staytime'] = $this->staytime_model->get_staytime_all($this->input->get('type'));
        $data['customer'] = $this->checkin_model->get_customer();
        $data['banks'] = $this->checkin_model->getAllbanks();
        $data['free_rooms'] = $this->room_model->get_free_room();
        $data['room_type'] = $this->roomtype_model->get_roomtype_all();
        //load the view
        $data['main_content'] = 'admin/checkin/add';
        $this->load->view('includes/template', $data);
        if ($data_to_store) {
            redirect('admin/show_rooms');
        }
    
        // $this->index(); 
    }
    function confirm_card(){
        $fp = fsockopen("127.0.0.1", 8000, $errno, $errstr, 30);
        $con_string='00000E';
        $msg = chr(2).$con_string.chr(3);
        fwrite($fp, $msg);
        $buffer = fread($fp, 4096);
        $buf=count(explode('|', $buffer));
        if ($buf == 1) {
           fclose($fp);
           return 'NC';
        }elseif ($buf <=3) {
            fclose($fp);
            return 'ND';
        }elseif ($buf >3) {
            fclose($fp);
            return 'HD';
        }
        
    }

    function write_key(){
        echo "connect";
    }       

    /**
    * Update item by his id
    * @return void
    */
    public function update()
    {
        //checkin id 
        $id = $this->uri->segment(4);
       
        //checkin data 
        //   $data['checkin'] = $checkin = $this->checkin_model->get_checkin_by_id($id);
        // $data['staytime'] = $this->staytime_model->get_staytime_all($checkin[0]['roomtype']);
        // $data['room_type'] = $this->roomtype_model->get_roomtype_all();
        // $data['free_rooms'] = $this->room_model->get_room_type($checkin[0]['roomtype']);
        // $data['customer'] = $this->checkin_model->get_customer();
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            $data_to_store = array(
                'customer_id'   => $this->input->post('customer_id'),
                'date_in'       => date('Y-m-d H:i:s',strtotime($this->input->post('date_in').''.date('H:i:s'))),
                'date_out'      => $this->input->post('date_out'),
                'room_no'      => $this->input->post('room_no'),
                'staying'       => $this->input->post('duration'),
                'extra_charges' => $this->input->post('extra_charges'),
                'discount'      => $this->input->post('discount'),
                'total'      => $this->input->post('total'),
                'price'      => $this->input->post('Price'),
                'deposit'      => $this->input->post('deposit'),
                'grand_total'      => $this->input->post('grand_total'),
                'bank_id'       =>$this->input->post('bank'),
                'account_name'       =>$this->input->post('account_name'),
                'account_number'       =>$this->input->post('account_number'),
                'bank_amount'       =>$this->input->post('bank_amount'),
                'note'       =>$this->input->post('note'),
                'time'          => '',
                'checkin_type'  => $this->input->post('chtype'),
                'user'          => $this->session->userdata('user_name'),
            );

            //update available room if room is changed
            // if($checkin[0]['room_no'] != $this->input->post('room_number')) {
            //     $this->db->where('id', $checkin[0]['room_no']);
            //     $this->db->update('tbl_room', array('status'=>0));
            //     $data_to_store['room_no'] = $this->input->post('room_number');
            // }

              
            $dis   = $this->input->post('discount');
            $room  = $this->input->post('chtype');
            $stay  = $this->input->post('duration');

            $price = $this->checkin_model->get_price($room);

            $percentage = '%';
            $discount = $this->input->post('discount');
            if($discount !='' || $discount > 0){
                $discount_fix =  $discount;
                if (isset($discount_fix)) {
                    $dis_fix = $discount_fix;
                    $dpos = strpos($dis_fix, $percentage);
                    if ($dpos !== false) {
                       $data_to_store['percent_dis'] = $discount;
                    } else {
                      $data_to_store['discount'] = $discount;
                    }
                }
            }
            $p = $price->price * $stay;


            $per = ($p * $dis) / 100;
            $amount = $p - $per;
            $mul_det = $this->checkin_model->get_room_by_id($this->input->post('room_no'))->room_no;

            $detail = array(
                        'price'        => $price->price,
                        'room_id'      => $this->input->post('room_no'),
                        'room_type'    => $this->input->post('roomtype'),
                        'room_no'        => $mul_det,
                        'qty'          => $this->input->post('duration'),
                        'item_name'    => "staying",
                        'date_order'   => date('Y-m-d H:i:s'),
                        'discount'     => $this->input->post('discount'),
                        'amount'       => $this->input->post('total'),
                        'current_date' => date('Y-m-d H:i:s'),
                        'price_more'   => $this->input->post('Price')
            );
                
            //if the insert has returned true then we show the flash message
            
          
            if($this->checkin_model->update_checkin($data_to_store,$detail,$id)){
                $data['flash_message'] = TRUE;
                    $this->session->set_flashdata(array(
                            'message' => "Update Checkin Success !!!!", 
                            'alert-type' => 'success'
                        )
                );
         
            redirect('admin/checkin');
        }else{
            $data['flash_message'] = FALSE; 
        }
        }

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

           //rooms data
           
        //    $data['staytime'] = $this->staytime_model->get_staytime_all($checkin[0]['roomtype']);
           $data['room_type'] = $this->roomtype_model->get_roomtype_all();
        //    $data['free_rooms'] = $this->room_model->get_room_type($checkin[0]['roomtype']);
           $data['free_rooms'] = $this->room_model->get_free_room();
           $data['customer'] = $this->checkin_model->get_customer($id);
           $data['banks'] = $this->checkin_model->getAllbanks();
           $data['chec'] = $this->checkin_model->getAllchk($id);
           //load the view
        $data['main_content'] = 'admin/checkin/edit';
        $this->load->view('includes/template', $data);
        if ($data_to_store) {
            redirect('admin/show_rooms');
        }

    }//update

    /**
    * Delete checkin by his id
    * @return void
    */
    public function delete()
    {
        //checkin id 
        $id = $this->uri->segment(4);
        $this->checkin_model->delete_checkin($id);
        redirect('admin/checkin');
    }//edit

    function extra($cid)
    {
        $data['cid'] = $cid;
        $data['allitem'] = $this->checkin_model->load_allItem();
        $data['list_item'] = $this->checkin_model->get_extra_item($cid);
        $data['main_content'] = 'admin/extra/add';
        $this->load->view('includes/template', $data);
    }

    function save_all_item()
    {
        header('Content-Type: application/json');

        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $qty = $this->input->post('qty');
        $datefrom = $this->input->post('datefrom');
        $dateto = $this->input->post('dateto');
        $oldnum = $this->input->post('oldnum');
        $newnum = $this->input->post('newnum');
        $dis = $this->input->post('dis');
        $price = $this->input->post('price');
        $total = $this->input->post('total');
        $did = $this->input->post('did');
        $data = array(
            'checkin_id' => $this->input->post('id'),
            'item_name' => $this->input->post('name'),
            'price' => $this->input->post('price'),
            'date_start' => $this->input->post('datefrom'),
            'date_end' => $this->input->post('dateto'),
            'old_kw' => $this->input->post('oldnum'),
            'new_kw' => $this->input->post('newnum'),
            'qty' => $this->input->post('qty'),
            'date_order' => date('y-m-d'),
            'discount' => $this->input->post('dis'),
            'amount' => $this->input->post('total'),
            'status' => 1,
            'current_date' => date('Y-m-d')
        );

        
            if($did !='')
            {
                $this->checkin_model->return_stock($did, $qty, $name);
                $this->checkin_model->returntoDefaul($did, $name);
                if($this->db->where('detail_id', $did)->update('tbl_checkin_detail', $data))
                {
                    echo json_encode("success");
                }else{
                    echo json_encode("false");
                }
            }else{
                if($this->checkin_model->cut_stock($name,$qty))
                {   
                    if($this->db->insert('tbl_checkin_detail', $data))
                    {
                        echo json_encode("success");
                    }else{ 
                        echo json_encode("false");
                    }
                }else{
                     if($this->db->insert('tbl_checkin_detail', $data))
                    {
                        echo json_encode("success");
                    }else{ 
                        echo json_encode("false");
                    }
                }
            }

    }
    
    function getItemPrice()
    {
        $itemid = $this->input->post('value');
        $price  = $this->checkin_model->getPrice($itemid);
        header('Content-Type: application/json');
        echo json_encode( $price ); 
    }
    function delectItem()
    {
        header('Content-Type: application/json');
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $qty = $this->input->post('qty');

        $this->checkin_model->returnStockDelete($id,$name,$qty);

        if($this->db->where('detail_id',$id)->delete('tbl_checkin_detail'))
        {
            echo json_encode("success");
        }else{
            echo json_encode("false");
        }
    }
    function reciept($id=null, $cid=null)
    {
        // var_dump($id);die();
        // $pay = array('pay' => 'pay');
        // $this->db->where('id',$id)->update('tbl_checkin',$pay);
        // $status =  array('status' => 0);
        // $this->db->where('checkin_id',$id)->update('tbl_checkin_detail',$status); 

        
        $data['exchange_rate']=$this->currencies_model->get_exchange_rate();
        $rate=$this->db->get('tbl_currencies')->row()->cur_exchange;
        // print_r($data['exchange_rate']);die();
        $items = $this->checkout_model->load_item($id);
        $data['items'] = $items['room'];
        $data['sales'] = $items['sales'];

        $row_checkin =  $this->db->where('id',$id)->get('tbl_checkin')->row();
        
        $data['row_checkin'] = $row_checkin;
        $data['customer'] =  $this->checkout_model->load_customer_name($cid);
        // $Rest = $this->load->database('rest', TRUE);

        // $sales = $Rest->query("SELECT s.* FROM sma_sales s
        //                                 WHERE s.hotel_checkin_id = '$id'
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

        $checkin_data = $this->db->query("SELECT ch_dt.*,room_t.type,b.account_name as bank,b.account_number as banknumber,ch.bank_amount,ch.note,ch_dt.date_start,ch_dt.date_end,ch.new_month,ch.date_in,ch_dt.old_kw,ch_dt.new_kw 
                                        FROM tbl_checkin_detail ch_dt 
                                        LEFT JOIN tbl_roomtype room_t 
                                        ON room_t.id = ch_dt.room_type
                                        LEFT JOIN tbl_checkin ch
                                        ON ch.id=ch_dt.checkin_id
                                        LEFT JOIN tbl_bank b 
                                        ON b.id=ch.bank_id
                                        WHERE ch_dt.checkin_id = '$id'")->result();
        $is_payment = $this->db->where('checkin_id',$id)->update('tbl_checkin_detail',['is_pay'=>1]);

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
        $deposit = 0;
        if($row_checkin->pay == 'unpay' || $row_checkin->pay == 'PANDING' ){
          $extra_charge = $row_checkin->extra_charges;
        }
                $data_table .= '<tbody>';
        foreach ($checkin_data as $checkin) {
            $quntity=$checkin->qty;
            $quntity_month=$quntity / $quntity ;
            if($checkin->room_id > 0){
                $data_table .= '<tr>';
                $data_table .= '<td class="text-center" style="font-size:15px">'.$i++.'</td>';
                $data_table .= '<td colspan="2" style="font-size:15px">'.$checkin->type.' ( '.$checkin->room_no.' ) <br> Rental Fee from ' .$checkin->new_month.' to '.$checkin->date_in.'</td>';
                $data_table .= '<td class="text-center" style="font-size:15px">'.$checkin->price_more.'</td>';
                // $data_table .= '<td class="text-center">'.$checkin->qty.'</td>';
                $data_table .= '<td class="text-center" style="font-size:15px">'.$quntity_month.'</td>';
                $data_table .= '<td class="text-right" style="font-size:15px">'.number_format($checkin->price_more,2).'</td>';
                $total += str_replace(',', '', number_format($checkin->price_more * $checkin->qty,2));
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
                $data_table .= '<td class="text-center" style="font-size:15px">'.$i++.'</td>';
                $data_table .= '<td colspan="2" style="font-size:15px">'.$checkin->item_name.' </br> Usage from '.$checkin->date_start.' to '.$checkin->date_end.' <br> Old Number - New Number <br> '.$checkin->old_kw.' - '.$checkin->new_kw.' = '.number_format($checkin->new_kw - $checkin->old_kw,2).' <br><br> Note: '.$checkin->note.'</td>';
                $data_table .= '<td class="text-center" style="font-size:15px">'.$checkin->price.'</td>';
                $data_table .= '<td class="text-center" style="font-size:15px">'.$checkin->qty.'</td>';
                $data_table .= '<td class="text-right" style="font-size:15px">'.number_format($checkin->price * $checkin->qty,2).'</td>';
                $data_table .= '</tr>';
                $total_extra += str_replace(',', '', number_format($checkin->price * $checkin->qty,2));
                $payment_detail_data[] = [
                                        'payment_id'        => '',
                                        'checkindetail_id'  => $checkin->detail_id,
                                        'room_id'           => null,
                                        'sale_id'           => null,
                                        'item_name'         => $checkin->item_name,
                                        'status'            => 'extra_item',
                                        'amount'            => str_replace(',', '', number_format($checkin->price * $checkin->qty,2))
                                    ];
            }
        }
        if($extra_charge > 0){
            $data_table .= '<tr>';
            $data_table .= '<td class="text-center" style="font-size:15px">'.$i++.'</td>';
            $data_table .= '<td colspan="3" style="font-size:15px"><span style="margin:0px 5px 0px 12px"></span>
                        Extra Charges</td>';
            $data_table .= '<td class="text-center" style="font-size:15px"></td>';
            $data_table .= '<td class="text-right" style="font-size:15px">'.number_format($extra_charge,2).'</td>';
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


            for ($j=$i; $j <=3 ; $j++) { 
                $data_table .= '<tr>';
                $data_table .= '<td class="text-center" style="font-size:15px">'.$j.'</td>';
                $data_table .= '<td colspan="2">'.''.'</td>';
                $data_table .= '<td>'.''.'</td>';
                $data_table .= '<td>'.''.'</td>';
                $data_table .= '<td>'.''.'</td>';
                $data_table .= '</tr>';
            
            }
            $data_table .= '</tbody>';
            $rows = '';
            if ($row_checkin->reserv_id != 0) {
                $rows = 7;
                $deposit_price = $row_checkin->deposit;
            }else{
                $rows = 6;
            }
            $percentage = '%';
            $discount = $row_checkin->discount;
            if($row_checkin->percent_dis){
                $discount = $row_checkin->percent_dis;
            }
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

            $total_pay = $total + $sales_total + $total_extra - ($deposit_price + $dicount_p);
            $total_pay_riel​ = $total_pay * $rate;

            $data_table .='<tfoot>';
                $data_table .= '<tr>';
                $data_table .= '<th colspan="3" rowspan="'.$rows.'" style="vertical-align:center !important;"><span style="font-size:12px">Exch rate :</span><span  style="font-size:12px">'.$rate.'&nbsp;៛</span><br><span> </span><span style="font-family:Khmer OS;font-size:15px"></span></th>';
                $data_table .= '<th class="text-right" style="white-space: nowrap !important;">Sub Total(USD)</th>';
                $data_table .= '<th colspan="2" class="text-right" style="white-space: nowrap !important;">$ '.(number_format($total + $sales_total + $total_extra,2)).'</th>';
                $data_table .= '</tr>';
                    // $data_table .= '<tr>';
                    // $data_table .= '<th class="text-right" style="font-size:11px">Deposit</th>';
                    // $data_table .= '<th colspan="2" style="text-align: right;">$ '.number_format($deposit_price,2).'</th>';
                    // $data_table .= '</tr>';
                // $data_table .= '<tr>';
                // $data_table .= '<th class="text-right" style="font-size:12px">Discount '.$dicount_text.'</th>';
                // $data_table .= '<th colspan="2" style="text-align: right;">$ '.number_format($dicount_p,2).'</th>';
                // $data_table .= '</tr>';

                // $data_table .= '<tr>';
                // $data_table .= '<th class="text-right" style="font-size:12px">Total Pay(Cash)</th>';
                // $data_table .= '<th colspan="2" style="text-align: right;">$ '.number_format($total_pay-$checkin->bank_amount,2).'</th>';
                // $data_table .= '</tr>';

                // $data_table .= '<tr>';
                // $data_table .= '<th class="text-right" style="font-size:12px">Total Pay('.$checkin->bank.' / '.$checkin->banknumber.')</th>';
                // $data_table .= '<th colspan="2" style="text-align: right;">$ '.number_format($checkin->bank_amount,2).'</th>';
                // $data_table .= '</tr>';

                $data_table .= '<tr>';
                $data_table .= '<th class="text-right" style="font-size:12px">Sub Total(RIEL)</th>';
                $data_table .= '<th colspan="2" style="text-align: right;">៛ '.number_format($total_pay_riel​,0).'</th>';
                $data_table .= '</tr>';         

            $data_table .='</tfoot>';



        $data['sales_total'] = $sales_total;
        $data['total'] = $total;
        $data['data_table'] = $data_table;
        // var_dump($data['row_checkin']);die();
        $this->load->view('admin/checkout/reciept', $data);
    }
    public function payment_befor_checkout(){
        $id=$this->input->post('id');
        $cid=$this->input->post('cid');
        // $date_start=$this->input->post('date_start');
        $new_month=$this->input->post('new_month');
        // $date_end=$this->input->post('date_end');
        // $old_kw=$this->input->post('old_kw');
        // $new_kw=$this->input->post('new_kw');
        $bank_id=$this->input->post('bank');
        $account_number=$this->input->post('account_number');
        $account_name=$this->input->post('account_name');
        $bank_amount=$this->input->post('bank_amount');
        $note=$this->input->post('note');
        $payment_data =[];
        $payment_detail_data =[];
        $pay = array('pay' => 'pay');
        $this->db->query("UPDATE tbl_checkin SET pay='pay',bank_id='$bank_id',old_kw='$old_kw',new_kw='$new_kw',date_start='$date_start',new_month= '$new_month',date_end='$date_end',account_name='$account_name',note='$note',account_number='$account_number',bank_amount='$bank_amount'WHERE id='$id'");
        // $data['exchange_rate']=$this->currencies_model->get_exchange_rate();
        $rate=$this->db->get('tbl_currencies')->row()->cur_exchange;
        // print_r($data['exchange_rate']);die();
        $items = $this->checkout_model->load_item($id);
        $data['items'] = $items['room'];
        $data['sales'] = $items['sales'];

        $row_checkin =  $this->db->where('id',$id)->get('tbl_checkin')->row();
        
        $data['row_checkin'] = $row_checkin;
        $data['customer'] =  $this->checkout_model->load_customer_name($cid);
        // $Rest = $this->load->database('rest', TRUE);

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

        $checkin_data = $this->db->query("SELECT ch_dt.*,room_t.type,b.account_name as bank,b.account_number as banknumber,ch.bank_amount,ch.note,ch_dt.date_start,ch_dt.date_end,ch.new_month,ch.date_in,ch_dt.old_kw,ch_dt.new_kw 
        FROM tbl_checkin_detail ch_dt 
        LEFT JOIN tbl_roomtype room_t 
        ON room_t.id = ch_dt.room_type
        LEFT JOIN tbl_checkin ch
        ON ch.id=ch_dt.checkin_id
        LEFT JOIN tbl_bank b 
        ON b.id=ch.bank_id
        WHERE ch_dt.checkin_id = '$id'")->result();
        $is_payment = $this->db->where('checkin_id',$id)->update('tbl_checkin_detail',['is_pay'=>1]);

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
        $deposit = 0;
        if($row_checkin->pay == 'unpay' || $row_checkin->pay == 'PANDING' ){
          $extra_charge = $row_checkin->extra_charges;
        }
                $data_table .= '<tbody>';
        foreach ($checkin_data as $checkin) {
            $quntity=$checkin->qty;
            $quntity_month=$quntity / $quntity ;
            if($checkin->room_id > 0){
                $data_table .= '<tr>';
                $data_table .= '<td class="text-center" style="font-size:15px">'.$i++.'</td>';
                $data_table .= '<td colspan="2" style="font-size:15px">'.$checkin->type.' ( '.$checkin->room_no.' ) <br> Rental Fee from ' .$checkin->new_month.' to '.$checkin->date_in.'</td>';
                $data_table .= '<td class="text-center" style="font-size:15px">'.$checkin->price_more.'</td>';
                // $data_table .= '<td class="text-center">'.$checkin->qty.'</td>';
                $data_table .= '<td class="text-center" style="font-size:15px">'.$quntity_month.'</td>';
                $data_table .= '<td class="text-right" style="font-size:15px">'.number_format($checkin->price_more,2).'</td>';
                $total += str_replace(',', '', number_format($checkin->price_more * $checkin->qty,2));
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
                $data_table .= '<td class="text-center" style="font-size:15px">'.$i++.'</td>';
                $data_table .= '<td colspan="2" style="font-size:15px">'.$checkin->item_name.' </br> Usage from '.$checkin->date_start.' to '.$checkin->date_end.' <br> Old Number - New Number <br> '.$checkin->old_kw.' - '.$checkin->new_kw.' = '.number_format($checkin->new_kw - $checkin->old_kw,2).' <br><br> Note: '.$checkin->note.'</td>';
                $data_table .= '<td class="text-center" style="font-size:15px">'.$checkin->price.'</td>';
                $data_table .= '<td class="text-center" style="font-size:15px">'.$checkin->qty.'</td>';
                $data_table .= '<td class="text-right" style="font-size:15px">'.number_format($checkin->price * $checkin->qty,2).'</td>';
                $data_table .= '</tr>';
                $total_extra += str_replace(',', '', number_format($checkin->price * $checkin->qty,2));
                $payment_detail_data[] = [
                                        'payment_id'        => '',
                                        'checkindetail_id'  => $checkin->detail_id,
                                        'room_id'           => null,
                                        'sale_id'           => null,
                                        'item_name'         => $checkin->item_name,
                                        'status'            => 'extra_item',
                                        'amount'            => str_replace(',', '', number_format($checkin->price * $checkin->qty,2))
                                    ];
            }
        }
        if($extra_charge > 0){
            $data_table .= '<tr>';
            $data_table .= '<td class="text-center" style="font-size:15px">'.$i++.'</td>';
            $data_table .= '<td colspan="3" style="font-size:15px"><span style="margin:0px 5px 0px 12px"></span>
                        Extra Charges</td>';
            $data_table .= '<td class="text-center" style="font-size:15px"></td>';
            $data_table .= '<td class="text-right" style="font-size:15px">'.number_format($extra_charge,2).'</td>';
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


            for ($j=$i; $j <=3 ; $j++) { 
                $data_table .= '<tr>';
                $data_table .= '<td class="text-center" style="font-size:15px">'.$j.'</td>';
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
                $deposit_price = $row_checkin->deposit;
            }else{
                $rows = 5;
            }
            $percentage = '%';
            $discount = $row_checkin->discount;
            if($row_checkin->percent_dis){
                $discount = $row_checkin->percent_dis;
            }
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
            $total_pay = $total + $sales_total + $total_extra - ($dicount_p);
            $total_pay_riel​ = $total_pay * $rate;

            $data_table .='<tfoot>';
                $data_table .= '<tr>';
                $data_table .= '<th colspan="3" rowspan="'.$rows.'" style="vertical-align:center !important;"><span>Exch rate :</span><span>'.$rate.'&nbsp;៛</span><br><span> </span></th>';
                $data_table .= '<th class="text-right" style="white-space: nowrap !important;">Sub Total(USD)</th>';
                $data_table .= '<th colspan="2" class="text-right" style="white-space: nowrap !important;">$ '.(number_format($total + $sales_total + $total_extra,2)).'</th>';
                $data_table .= '</tr>';

                if($row_checkin->reserv_id != 0){
                    // $data_table .= '<tr>';
                    // $data_table .= '<th class="text-right" style="font-size:12px">Deposit</th>';
                    // $data_table .= '<th colspan="2" style="text-align: right;">$ '.number_format($deposit_price,2).'</th>';
                    // $data_table .= '</tr>';
                }
                // $data_table .= '<tr>';
                // $data_table .= '<th class="text-right" style="font-size:11px">Discount '.$dicount_text.'</th>';
                // $data_table .= '<th colspan="2" style="text-align: right;">$ '.number_format($dicount_p,2).'</th>';
                // $data_table .= '</tr>';

                $data_table .= '<tr>';
                $data_table .= '<th  style="text-align: right;font-size:11px">Total Pay (Cash)</th>';
                $data_table .= '<th colspan="2" style="text-align: right;">$ '.number_format($total_pay-$checkin->bank_amount,2).'</th>';
                $data_table .= '</tr>';

                $data_table .= '<tr>';
                $data_table .= '<th  style="text-align: right;font-size:11px">Total Pay ('.$checkin->bank.' / '.$checkin->banknumber.')</th>';
                $data_table .= '<th colspan="2" style="text-align: right;">$ '.number_format($checkin->bank_amount,2).'</th>';
                $data_table .= '</tr>';

                $data_table .= '<tr>';
                $data_table .= '<th class="text-right" style="font-size:11px"> Total Pay(RIEL)</th>';
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
            // $this->db->where('id',$id)->update('tbl_checkin',$pay);
            $status =  array('status' => 0);
            $this->db->where('checkin_id',$id)->update('tbl_checkin_detail',$status); 
        // var_dump($payment_detail_data);die;
            if($total_pay > 0){
                $pay_data = $this->checkin_model->payment($payment_data,$payment_detail_data);
            }else{
                redirect('admin/checkin');
            }
        

        $data['sales_total'] = $sales_total;
        $data['total'] = $total;
        $data['data_table'] = $data_table;
        // var_dump($data['row_checkin']);die();
        $this->load->view('admin/checkout/reciept_new', $data);
    }


    public function total_checkin(){
        // session_start();
        $today = date('Y-m-d H:i:s');
        $staing_time =  $this->input->get_post('staing_time');
        $duration =  $this->input->get_post('duration');
        $price =  $this->input->get_post('price');
        $date_in =  $this->input->get_post('date_in');
        $deposit =  $this->input->get_post('deposit_am');
        $discount =  $this->input->get_post('discount');
        $room_type = $this->input->get_post('room_type');
        $room_no = $this->input->get_post('room_no');
        $extra_charge = $this->input->get_post('extra_charge');
        $data = [];
        $date_out = "";
        $total = 0;
        $grand_total = 0;
        $staing_time = $staing_time?$staing_time:0;
        $duration = $duration?$duration:0;
        $price = $price?$price:0;
        $deposit = $deposit?$deposit:0;
        $discount = $discount?$discount:0;
        $extra_charge = $extra_charge?$extra_charge:0;
        $this->db->select('price');
        $isMonth="false";
        // $this->db->where('id', $id); 
        // if((strtotime($date_in) < strtotime($today)) && $date_in !=''){
        //     $data = [
        //         'error' => 1,
        //         'type' => 'warning',
        //         'message' => 'Please select correct date !'
        //     ];
        //     echo json_encode ($data);
        //     exit;
        // }
        if($date_in !='' && $date_in != NULL){
            $check_room = $this->room_model->check_available_room($room_no,$date_in);
            if($check_room){
                var_dump($check_room);
                if($check_room->room_checkout){
                    if(!(strtotime(date('Y-m-d ',strtotime($date_in))) == strtotime(date('Y-m-d ',strtotime($check_room->room_checkout))))){

                        if(strtotime(date('Y-m-d ',strtotime($date_in))) <= strtotime(date('Y-m-d ',strtotime($check_room->room_checkout))) ){
                            $data = [
                                'not_free' => 1,
                                'type' => 'info',
                                'message' => 'This room not available form :'.date('d-m-Y',strtotime($check_room->date_in)).' to '.date('d-m-Y',strtotime($check_room->room_checkout)).' Pleae Select Other room !'
                            ];
                            echo json_encode ($data);
                            exit;
                    }
                }
                }else{
                    $data = [
                        'not_free' => 1,
                        'type' => 'info',
                        'message' => 'This room not available form :'.date('d-m-Y',strtotime($check_room->date_in)).' to '.date('d-m-Y',strtotime($check_room->date_out)).' Pleae Select Other room !'
                    ];
                    echo json_encode ($data);
                    exit;
                }
                
            }
            $time = $this->room_model->getAllPrice($room_type,$staing_time);
            if($time['time']=="Month")
            {
                $price = $time['price_month'];
                $total = $price *  $duration;
                $duration_month = $duration;
                $date_out =  date('Y-m-d',strtotime($date_in.' +'.$duration_month.' month'));
                // $date_out = date('Y-m-d',strtotime($date_in.' +'.$duration.' day'));
            }else if($time['time']=="Time")
            {
                $price = $time['price'];
                $total = $price *  $duration;
              $duration_time= $duration + date('H:i:s',strtotime($this->input->post('date_out').''.date('H:i:s')));
                 //$duration_time = $duration + 3;
               $date_out = date('Y-m-d H:i:s',strtotime($date_in.' +'.$duration_time.' hour'));
            }
            else{
                $date_out = date('Y-m-d',strtotime($date_in.' +'.$duration.' day'));
                $total = $this->room_model->getPriceByDay($date_in,$duration,$room_type)['total'];
                 $price = $time['price'];
                // $price = $this->room_model->getPriceByDay($date_in,$duration,$room_type)['data'];
            }
        }else{
                   //check if duration is exceed then 30days
                if($duration>30)
                {
                    $isMonth = 'true'; 
                }
                $this->db->select('price');
                // $this->db->where('id', $id);
                $this->db->where('roomtype_id', $room_type);
                $query = $this->db->get('tbl_staying')->row();
                if($query){
                $price = $query->price;
                }
        }
        if($deposit > $total){
           $deposit =  $total;
        }
        $grand_total = $total;
        $percentage = '%';
        if($discount !='' || $discount > 0){
            $discount_fix =  $discount;
            if (isset($discount_fix)) {
                $dis_fix = $discount_fix;
                $dpos = strpos($dis_fix, $percentage);
                if ($dpos !== false) {
                    $pds = explode("%", $dis_fix);
                    $discount_usd = str_replace(',', '', number_format((($total * ((Float)($pds[0])) / 100)),2));
                } else {
                    $discount_usd = str_replace(',', '', number_format((Float)($discount),2));
                }
            }
            $grand_total = $grand_total - $discount_usd;
        }
        if($deposit > 0){
            $grand_total = $grand_total - $deposit;
        }
        if($extra_charge > 0){
            $grand_total = $grand_total + $extra_charge;
        }
        if($price == false){
            $price = 0;
        }
        $data = [
            'price' => $price,
            'total' => $total,
            'grand_total' => $grand_total,
            'date_out' => $date_out,
            'isMonth' => $isMonth,
        ];

        // $_SESSION['total_reservation'] = $data;

         echo json_encode ($data);

    }
    function dis_invoice(){
        $percent_tage = '%';
        $percent_dis = 0;
        $room_dis = 0;
        $row_id = $this->input->post('rowDis_id');

        $valDis = $this->input->post('dis_in');

        $getTprice = $this->db->query("SELECT chd.amount FROM tbl_checkin ch LEFT JOIN tbl_checkin_detail chd ON ch.id = chd.checkin_id WHERE id='".$row_id."'")->row()->amount;
        // var_dump($getTprice);die();
        
            $discount = $valDis;
            $disroom = strpos($discount, $percent_tage);
            if ($disroom !== FALSE) {
                $pds = explode("%", $discount);
                $room_dis = number_format((($getTprice * (Float)($pds[0])) / 100), 2);
                $percent_dis = $valDis;
            }else{
                $room_dis = $discount;
            }

            $tam = $getTprice - $room_dis;

            $rt_dis = array(
                'discount' => $room_dis,
                'percent_dis' => $percent_dis,
            );

            if ($row_id) {
                $this->db->where('id',$row_id)->update('tbl_checkin',$rt_dis);
                $this->db->where('checkin_id',$row_id)->update('tbl_checkin_detail',array('amount'=>$tam,'discount'=>$room_dis));
            }
            redirect('admin/checkin');
    }
    function view_checkin(){

        $id = $this->input->get_post('checkin_id');

        $data = $this->db->query("SELECT checkin.*,reserva.bank_acc_name,reserva.bank_acc_number,cus.Family,cus.Mobile,bank.account_name,reserva.create_by                    FROM tbl_checkin checkin
                                INNER JOIN tbl_customer cus ON cus.id = checkin.customer_id
                                LEFT JOIN tbl_reservation reserva ON checkin.reserv_id = reserva.id
                                LEFT JOIN tbl_bank bank ON reserva.deposit_type  = bank.id
                                WHERE checkin.id = '$id'")->row();
        $data_table = "";
        $ro_number ='';
        if($data){
            $discount = number_format($data->discount,2);
            if($data->percent_dis){
                $discount = $data->percent_dis;
            }

            $ro_no = $this->checkout_model->get_room_no_by_checkin_id($data->id);
            $data_table .='
                            <tr>
                                <th>From Date:</th>
                                <td>'.date('d-m-Y H:i:s',strtotime($data->date_in)).'</td>
                            </tr>
                            <tr>
                                <th>To Date:</th>
                                <td>'.date('d-m-Y H:i:s',strtotime($data->date_out)).'</td>
                            </tr>';
                        if($data->reserv_id > 0){
            $data_table .=' 
                            <tr>
                                <th>Reservation By:</th>
                                <td>'.$data->create_by.'</td>
                            </tr>';
                        }

            $data_table .=' 
                            <tr>
                                <th>Checkin By:</th>
                                <td>'.$data->user.'</td>
                            </tr>
                            <tr>
                                <th>Customer Name:</th>
                                <td>'.$data->Family.'</td>
                            </tr>
                            <tr>
                                <th>Phone Number:</th>
                                <td>'.$data->Mobile.'</td>
                            </tr>
                            <tr>
                                <th>Duration:</th>
                                <td>'.$data->staying.' </td>
                            </tr>
                            <tr>
                                <th>Room Number:</th>
                                <td>'.$ro_no.'</td>
                            </tr>
                            <tr>
                                <th>Total:</th>
                                <td>'.number_format($data->total,2).'</td>
                            </tr>
                            <tr>
                                <th>Deposit:</th>
                                <td>'.number_format($data->deposit,2).'</td>
                            </tr>
                            <tr>
                                <th>Bank Type:</th>
                                <td>'.$data->account_name.'</td>
                            </tr>
                            <tr>
                                <th>Account Name:</th>
                                <td>'.$data->bank_acc_name.'</td>
                            </tr>
                            <tr>
                                <th>Account Number:</th>
                                <td>'.$data->bank_acc_number.'</td>
                            </tr>
                            <tr>
                                <th>Discount:</th>
                                <td>'.$discount.'</td>
                            </tr>
                            <tr>
                                <th>Grand Total:</th>
                                <td>'.number_format($data->grand_total,2).'</td>
                            </tr>
                            <tr>
                                <th>Note:</th>
                                <td><p>'.$data->note.'</p></td>
                            </tr>
            ';
        }

    echo json_encode($data_table);
    }
    function edit($id){
        $data['check_detail'] = $this->db->query("SELECT * FROM tbl_checkin_detail WHERE detail_id=$id")->result();
        $data['main_content'] = 'admin/checkin/edit';
        $this->load->view('includes/template', $data);
    }
    function update_checkin($id){
        $checkin = $this->db->query("SELECT * FROM tbl_checkin_detail WHERE detail_id=$id")->result();
        $date_out=date('Y-m-d H:i:s');
        $amount=$this->input->post('refun_amount');
        $refun_by = $this->session->userdata('user_name');
        $data=array(
            'date_out' => $date_out,
            'refun_amount' => $amount,
            'amount' => $check->amount-$amount,
            'price_more' => $check->price_more.',('.($amount * -1).')',
            'refun_by' => $refun_by
        );
        $this ->db->where('detail_id',$id);
        $this->db->update('tbl_checkin_detail',$data);
        redirect('admin/checkin');
    }
    function payment_method($id=null,$cid=null)    {
        if($this->input->get('roomtype')) {
            $check_roomtype = $this->db->where('id', $this->input->get('roomtype'))->get('tbl_roomtype')->row();
        }
        $data['customer_id']= $cid;
        $data['id']= $id;
        $data['banks'] = $this->checkin_model->getAllbanks();
        $data['free_rooms'] = $this->room_model->get_free_room();
        $data['room_type'] = $this->roomtype_model->get_roomtype_all();
        $data['chec'] = $this->checkin_model->getAllchk($id);
        $data['main_content'] = 'admin/checkin/payment_method';
        $this->load->view('includes/template', $data);
    }
}