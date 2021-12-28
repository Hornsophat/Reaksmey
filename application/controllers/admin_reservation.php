<?php
class Admin_Reservation extends CI_Controller {

    /**
    * name of the folder responsible for the views 
    * which are manipulated by this controller
    * @constant string
    */
    const VIEW_FOLDER = 'admin/reservation';
 
    /**
    * Responsable for auto load the model
    * @return void
    */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('reservation_model');
        $this->load->model('staytime_model');
        $this->load->model('room_model');
        $this->load->model('checkin_model');
        
        $this->load->library('form_validation');
        
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
        $config['per_page'] = 10;

        $config['base_url'] = base_url().'admin/reservation';
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
                $order_type = 'Asc';
            }
        }
        //make the data type var avaible to our view
        $data['order_type_selected'] = $order_type;        

        if($search_string !== false && $order !== false || $this->uri->segment(3) == true){ 
           
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
            $data['count_products']= $this->reservation_model->count_reservation($search_string, $order);
            $config['total_rows'] = $data['count_products'];

            //fetch sql data into arrays
            if($search_string){
                if($order){ 
                    $data['reservation'] = $this->reservation_model->get_reservation($search_string, $order, $order_type, $config['per_page'],$limit_end);        
                }else{
                    $data['reservation'] = $this->reservation_model->get_reservation($search_string, '', $order_type, $config['per_page'],$limit_end);           
                }
            }else{
                if($order){
                    $data['reservation'] = $this->reservation_model->get_reservation('', $order, $order_type, $config['per_page'],$limit_end);        
                }else{
                    $data['reservation'] = $this->reservation_model->get_reservation('', '', $order_type, $config['per_page'],$limit_end);        
                }
            }

        }else{

            //clean filter data inside section
            $filter_session_data['manufacture_selected'] = null;
            $filter_session_data['search_string_selected'] = null;
            $filter_session_data['order'] = null;
            $filter_session_data['order_type'] = null;
            $this->session->set_userdata($filter_session_data);

            //pre selected options
            $data['search_string_selected'] = '';
            $data['order'] = 'id';
          
            //fetch sql data into arrays
            $data['count_products']= $this->reservation_model->count_reservation();
            $data['reservation'] = $this->reservation_model->get_reservation('', '', $order_type, $config['per_page'],$limit_end); 
                  // var_dump($data['reservation']);die();
            $config['total_rows'] = $data['count_products'];

        }//!isset($search_string) && !isset($order)
         
        //initializate the panination helper 
        $this->pagination->initialize($config);

        $data['reservationfield'] = $this->db->select(array('id','customer_id','room_id','checkin_data','checkout_data','staying','total_price','price'))->get('tbl_reservation')->result_array();


        //load the view
        $data['main_content'] = 'admin/reservation/list';
        $this->load->view('includes/template', $data);  

    }//index

    public function add()
    {
        //if save button was clicked, get the data sent via post

        // var_dump($_POST);die;
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {

            //form validation
            $this->form_validation->set_rules('customer', 'customer', 'required');
            $this->form_validation->set_rules('date_in', 'Start Date', 'required');
            $this->form_validation->set_rules('date_out', 'End Date', 'required');
            $this->form_validation->set_rules('Price', 'Price', 'required');
            $this->form_validation->set_rules('room','Room Number','required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert"><span class="text-danger">x</span></a><strong class="text-danger">', '</strong></div>');
            

            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
                $deposit = $this->input->post('deposit_am');
                $total = $this->input->post('total');
                $rese_percentage = '%';
                if($deposit !='' || $deposit > 0){
                    $diposit_fix =  $deposit;
                    if (isset($diposit_fix)) {
                        $dipo_fix = $diposit_fix;
                        $dpos = strpos($dipo_fix, $rese_percentage);
                        if ($dpos !== false) {
                            $dipsd = explode("%", $dipo_fix);
                            $deposit_usd = str_replace(',', '', number_format((($total * ((Float)($dipsd[0])) / 100)),2));
                        } else {
                            $deposit_usd = str_replace(',', '', number_format((Float)($deposit),2));
                        }
                    }
                    $deposit = $deposit_usd;
                }

                $data_to_store = array(
                    'Customer_id' => $this->input->post('customer'),
                    'reservation_date' => date('Y-m-d'),
                    'price' => $this->input->post('Price'),
                    'create_by' => $this->session->userdata('user_name'),
                    'checkin_data' => $this->input->post('date_in'),
                    'checkout_data' => $this->input->post('date_out'),
                    'confirmed' => 0,
                    'staying' => $this->input->post('staytime'),
                    'duration' => $this->input->post('per_day'),
                    'total_price' => $this->input->post('total'),
                    'note' => $this->input->post('note'),
                    'deposit' => $deposit,
                    'deposit_type' => $this->input->post('acc_name'),
                    'bank_acc_name' => $this->input->post('bank_acc_name'),
                    'bank_acc_number' => $this->input->post('bank_acc_number'),
                    'discount'  => $this->input->post('discount_re'),
                    'grand_total' => $this->input->post('grand_total')

                );
                if($this->input->post('room_id') != 0) {
                    $data_to_store['room_id'] = $this->input->post('room_id');
                } else {
                    $data_to_store['room_id'] = $this->input->post('room');
                }

                


                //if the insert has returned true then we show the flash message
                if($this->reservation_model->store_reservation($data_to_store)){
                    $data['flash_message'] = TRUE;
                    $this->session->set_flashdata(array(
                            'message' => "Reservation Success !", 
                            'alert-type' => 'success'
                        )
                    ); 
                    redirect('admin/reservation/add');
                }else{
                     $this->session->set_flashdata(array(
                            'message' => "Reservation Fail !", 
                            'alert-type' => 'warning'
                        )
                    );
                    $data['flash_message'] = FALSE; 
                }
            }
        }

        if($this->input->get('type')) {
            //$data['staytime'] = $this->staytime_model->get_staytime_all($this->input->get('type'));
        } else {
            //$data['staytime'] = $this->staytime_model->get_staytime_all();
        }
        
        //load the view
        $data['list_bank'] = $this->getAllBank();
        $data['customer'] = $this->reservation_model->get_customer();
        $data['roomtype'] = $this->reservation_model->get_roomtype();
        $data['main_content'] = 'admin/reservation/add';
        $this->load->view('includes/template', $data);
    }       

    /**
    * Update item by his id
    * @return void
    */
    public function update()
    {
        //reservation id 
        $id = $this->uri->segment(4);
  
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
    
                $data_to_store = array(
                    'Name' => $this->input->post('Name'),
                    'Family' => $this->input->post('Family'),
                    'Age' => $this->input->post('Age'),
                    'Passport' => $this->input->post('Passport'),
                    'Mobile' => $this->input->post('Mobile'),
                    'Country' => $this->input->post('Country'),
                    'Nationality' => $this->input->post('Nationality'),
                    'City' => $this->input->post('City'),
                    'Company' => $this->input->post('Company'),
                    'Adress' => $this->input->post('Adress'),
                    'Note' => $this->input->post('Note'),                                    
                );
                //if the insert has returned true then we show the flash message
                if($this->reservation_model->update_reservation($id, $data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('admin/reservation/update/'.$id.'');


        }

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

        //product data 
        $data['reservation'] = $this->reservation_model->get_reservation_by_id($id);
        //load the view
        $data['main_content'] = 'admin/reservation/edit';
        $this->load->view('includes/template', $data);            

    }//update
    


    /**
    * Delete product by his id
    * @return void
    */
    public function delete($id)
    {
        //product id 
        //$id = $this->uri->segment(4);
        $this->reservation_model->delete_reservation($id);
        redirect('admin/reservation');
    }//Delete
   
    
    
    public function confirm()
    {
        $id =  $this->input->get_post('reserv_id');
        // var_dump($id);die();
        $result=$this->reservation_model->verify($id);
        $get_ser = $this->reservation_model->get_reservation_id($id);
        $disc_checkin = [];
        $detail = [];
        $data = array(
                'reserv_id' => $get_ser->id,
                'customer_id' => $get_ser->Customer_id,
                'date_in' => date('Y-m-d H:i:s',strtotime($get_ser->checkin_data.''.date('H:i:s'))),
                'date_out'=> $get_ser->checkout_data,
                'room_no' => $get_ser->room_id,
                'staying' => $get_ser->duration,
                'extra_charges' => 0,
                'price' => $get_ser->price,
                'total' => $get_ser->total_price,
                'deposit' => $get_ser->deposit,
                'grand_total' => $get_ser->grand_total,
                'pay' => 'unpay',
                'checkin_type' => $get_ser->staying,
                'user' => $this->session->userdata('user_name')
                );

        $percentage = '%';
        $discount = $get_ser->discount;
        if($discount !='' || $discount > 0){
            $discount_fix =  $discount;
            if (isset($discount_fix)) {
                $dis_fix = $discount_fix;
                $dpos = strpos($dis_fix, $percentage);
                if ($dpos !== false) {
                   $disc_checkin = ['percent_dis' => $discount];
                } else {
                  $disc_checkin = ['discount' => $discount];
                }
            }
        }
        
        // var_dump($get_ser);die;
        $this->db->insert('tbl_checkin',array_merge($data,$disc_checkin));
        $chid = $this->db->insert_id();

        if($get_ser->is_multy == 1){
            $resev_mul = $this->db->query("SELECT * FROM tbl_multireservation WHERE reserv_id ='$id' ")->result();
            foreach ($resev_mul as $res_mul) {
                $detail[] = array(
                    'checkin_id' => $chid,
                    'room_id' => $res_mul->room_id,
                    'room_no'  => $res_mul->room_number,
                    'room_type' => $res_mul->room_type,
                    'price' => $res_mul->room_price,
                    'price_more' => $res_mul->room_price_more,
                    'qty' => $get_ser->duration,
                    'item_name' => 'staying',  
                    'date_order' => date('Y-m-d'),              
                    'discount' => $get_ser->discount,
                    'amount' => $res_mul->amount,
                    'current_date' => date("Y-m-d")
                );
            }

        }else{
            
            $room_data = $this->checkin_model->get_room_by_id($get_ser->room_id);
            $room_no = $room_data->room_no;
            $detail[] = array(
                'checkin_id' => $chid,
                'room_id' => $get_ser->room_id,
                'room_no'  => $room_no,
                'room_type' => $room_data->type_id,
                'price' => $get_ser->total_price,
                'price_more' => $get_ser->price,
                'qty' => $get_ser->duration,
                'item_name' => 'staying',  
                'date_order' => date('Y-m-d'),              
                'discount' => $get_ser->discount,
                'amount' => $get_ser->total_price,
                'current_date' => date("Y-m-d")
            ); 
        }


        $this->db->insert_batch('tbl_checkin_detail',$detail);
        $room = array('status' => 1);
        $room_up = $this->db->where('id',$get_ser->room_id)->update('tbl_room',$room);
        if ($room_up) {
            $smg = 'true';
        }else{
            $smg = 'false';
        }
        
// ==========================================get data to scan card========================
        //     $this->db->select('tbl_checkin.id,tbl_checkin.date_in,tbl_checkin.date_out,tbl_room.room_no');
        //     $this->db->from('tbl_checkin');
        //     $this->db->join('tbl_room','tbl_room.id=tbl_checkin.room_no','left');
        //     $this->db->where('tbl_checkin.id',$chid);
        //      $get_data=$this->db->get()->row();
        //      // print_r($get_data);die();

        //     $date_in= date('YmdHs',strtotime($get_data->date_in));
        //     $date_out=date('YmdHs',strtotime($get_data->date_out));
        //      // print_r($date_in);die();
        //      $fp = fsockopen("127.0.0.1", 8000, $errno, $errstr, 30);
        //         if (!$fp) {
        //             echo "$errstr ($errno)<br />\n";
        //         } 
        //         else {
        //             $con_string = "00000I|R".$get_data->room_no."|T04|D".$date_in."|O".$date_out; // WRITE 
        //             $msg = chr(2).$con_string.chr(3);
        //             fwrite($fp, $msg);
        //             $buffer = fread($fp, 4096);
        //                 echo ("<SCRIPT LANGUAGE='JavaScript'>
        //                 window.alert('".$buffer."')  local.reload();
        //                 </SCRIPT>");
        //             fclose($fp);
        //         }
        echo json_encode (array($smg));
    } 

    function add_multi(){

        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            // //form validation
            $this->form_validation->set_rules('customer_id', 'Customer', 'required');
            $this->form_validation->set_rules('duration', 'Duration', 'required');
            $this->form_validation->set_rules('date_in', 'Start Date', 'required');
            $this->form_validation->set_rules('date_out', 'End Date', 'required');
            // $this->form_validation->set_rules('Price', 'Price', 'required');
             $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert"><span class="text-danger">x</span></a><strong class="text-danger">', '</strong></div>');
            

            //if the form has passed through the validation
            if ($this->form_validation->run())
            {

                $i = isset($_POST['reserva_room_id']) ? sizeof($_POST['reserva_room_id']) : 0;
                // var_dump($i);die();
                for ($r=0; $r < $i; $r++) {
                    $room_id    = $_POST['reserva_room_id'][$r]; 
                    $r_type     = $_POST['reserva_rootype_id'][$r];
                    $r_no       = $_POST['reserva_room_no'][$r];
                    $r_floor    = $_POST['reserva_floor'][$r];
                    $r_time     = $_POST['reserva_chekin_type'][$r];
                    $r_price    = $_POST['reserva_price'][$r];
                    $r_amount    = $_POST['reserva_amount'][$r];
                    $room_num[]  = $_POST['reserva_room_no'][$r];
                    $room_det[] = array(
                            'room_id' => $room_id,
                            'room_number' => $r_no,
                            'room_type' => $r_type,
                            'room_price' => $r_price,
                            'room_price_more' => $r_price,
                            'amount' => $r_amount
                    );
                    
                }
                
                $deposit = $this->input->post('deposit_am');
                $total = $this->input->post('total');
                $rese_percentage = '%';
                if($deposit !='' || $deposit > 0){
                    $diposit_fix =  $deposit;
                    if (isset($diposit_fix)) {
                        $dipo_fix = $diposit_fix;
                        $dpos = strpos($dipo_fix, $rese_percentage);
                        if ($dpos !== false) {
                            $dipsd = explode("%", $dipo_fix);
                            $deposit_usd = str_replace(',', '', number_format((($total * ((Float)($dipsd[0])) / 100)),2));
                        } else {
                            $deposit_usd = str_replace(',', '', number_format((Float)($deposit),2));
                        }
                    }
                    $deposit = $deposit_usd;
                }

                // var_dump($room_det);die();
                $romm_checkin = implode(',',$room_num);
                $data_to_store = array(
                    'Customer_id' => $this->input->post('customer_id'),
                    'reservation_date' => date('Y-m-d'),
                    'price' => 0,
                    'create_by' => $this->session->userdata('user_name'),
                    'checkin_data' => $this->input->post('date_in'),
                    'checkout_data' => $this->input->post('date_out'),
                    'confirmed' => 0,
                    'staying' => 12,
                    'duration' => $this->input->post('duration'),
                    'discount' => $this->input->post('discount'),
                    'total_price' => $this->input->post('total'),
                    'grand_total' => $this->input->post('grand_total'),
                    'note' => $this->input->post('note'),
                    'deposit' => $deposit?$deposit:0,
                    'deposit_type' => $this->input->post('acc_name'),
                    'bank_acc_name' => $this->input->post('bank_acc_name'),
                    'bank_acc_number' => $this->input->post('bank_acc_number'),
                    'is_multy' => 1
                );
                // var_dump($data_to_store);die();
                if($this->input->post('room_id') != 0) {
                    $data_to_store['room_id'] = 0;
                } else {
                    $data_to_store['room_id'] = 0;
                }
                //if the insert has returned true then we show the flash message
                if($this->reservation_model->store_multireservationo($room_det,$data_to_store)){
                    $data['flash_message'] = TRUE;
                    $this->session->set_flashdata(array(
                            'message' => "Reservation Success !", 
                            'alert-type' => 'success'
                        )
                    );
                    redirect('admin_reservation/index','refresh'); 
                }else{
                    $data['flash_message'] = FALSE; 
                }
            }
        }

        if($this->input->get('type')) {
            $data['staytime'] = $this->staytime_model->get_staytime_all($this->input->get('type'));
        } else {
            $data['staytime'] = $this->staytime_model->get_staytime_all();
        }
        $data['list_bank'] = $this->getAllBank();
        
        //load the view
        $data['customer'] = $this->reservation_model->get_customer();
        $data['room_type'] = $this->reservation_model->get_roomtype();
        $data['main_content'] = 'admin/reservation/addMulti';
        $this->load->view('includes/template', $data);
    }
    function getAllBank(){
        $sql = $this->db->query("SELECT * FROM tbl_bank");
        return $sql->result();
    }
    function get_room_type_by_reservation_id($id){
        $data = $this->db->query("SELECT r_type.type FROM tbl_multireservation m_re
                                    INNER JOIN tbl_room room ON m_re.room_id = room.id
                                    INNER JOIN tbl_roomtype r_type ON room.type_id = r_type.id
                                    WHERE m_re.reserv_id = '$id'
                                    GROUP BY r_type.id")->result_array();
        return $data;

    }
    function view_reservation(){
        $id = $this->input->get_post('reservation_id');
        $data = $this->db->query("SELECT reserva.*,cus.Family,cus.Mobile,bank.account_name 
                                FROM tbl_reservation reserva 
                                INNER JOIN tbl_customer cus ON reserva.Customer_id = cus.id
                                LEFT JOIN tbl_bank bank ON reserva.deposit_type  = bank.id
                                WHERE reserva.id = '$id'")->row();
        $data_table = "";
        $ro_number ='';
        if($data){
            if ($data->room_no == 0) {
                $rimpol = array();
                $rn = $this->db->query("SELECT reserv_id,room_number FROM tbl_multireservation WHERE reserv_id = '".$data->id."'")->result();
                foreach ($rn as $ro_item) {
                  $rimpol[] = $ro_item->room_number;
                  $ro_number = implode(',',$rimpol);
                }
                // var_dump($ro_number);die();
            }else{
                $ro_number = $data->room_no;
            }


            $data_table .='
                            <tr>
                    <th>From Date:</th>
                    <td>'.date('d-m-Y',strtotime($data->checkin_data)).'</td>
                  </tr>
                  <tr>
                    <th>To Date:</th>
                    <td>'.date('d-m-Y',strtotime($data->checkout_data)).'</td>
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
                    <td>'.$data->duration.'</td>
                  </tr>
                  <tr>
                    <th>Room Number:</th>
                    <td>'.$ro_number.'</td>
                  </tr>
                  <tr>
                    <th>Total:</th>
                    <td>'.number_format($data->total_price,2).'</td>
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
                    <td>'.$data->discount.'</td>
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
     public function cancel($id){
        $this->reservation_model->cancel_reservation($id);
        redirect('admin/reservation');
    }//cancel

}
