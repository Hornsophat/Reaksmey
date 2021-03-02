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
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {

            //form validation
            $this->form_validation->set_rules('customer', 'customer', 'required');
            $this->form_validation->set_rules('date_in', 'Start Date', 'required');
            $this->form_validation->set_rules('date_out', 'End Date', 'required');
            $this->form_validation->set_rules('Price', 'Price', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            

            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
                $data_to_store = array(
                    'Customer_id' => $this->input->post('customer'),
                    'reservation_date' => date('Y-m-d'),
                    'price' => $this->input->post('Price'),
                    'checkin_data' => $this->input->post('date_in'),
                    'checkout_data' => $this->input->post('date_out'),
                    'confirmed' => 0,
                    'staying' => $this->input->post('staytime'),
                    'duration' => $this->input->post('per_day'),
                    'total_price' => $this->input->post('total'),
                    'note' => $this->input->post('note')                            
                );
                if($this->input->post('room_id') != 0) {
                    $data_to_store['room_id'] = $this->input->post('room_id');
                } else {
                    $data_to_store['room_id'] = $this->input->post('room');
                }
                //if the insert has returned true then we show the flash message
                if($this->reservation_model->store_reservation($data_to_store)){
                    $data['flash_message'] = TRUE; 
                }else{
                    $data['flash_message'] = FALSE; 
                }
                // print_r($data_to_store);
            }
        }

        if($this->input->get('type')) {
            $data['staytime'] = $this->staytime_model->get_staytime_all($this->input->get('type'));
        } else {
            $data['staytime'] = $this->staytime_model->get_staytime_all();
        }
        
        //load the view
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
            $result=$this->reservation_model->verify($id);
            $get_ser = $this->reservation_model->get_reservation_id($id);
        $verify_card=$this->get_verify_card();
        if ($verify_card == 'HD') {
            echo "<SCRIPT LANGUAGE='JavaScript'>
                            window.alert('Your Card is Have data!');
                            window.location.href='http://localhost/sv_hotel/admin/reservation';
                            </SCRIPT>";
        }elseif ($verify_card == 'NC') {
            echo ("<SCRIPT LANGUAGE='JavaScript'>
                            window.alert('".lang('Please put card on Encoder!')."');
                            window.location.href='http://localhost/sv_hotel/admin/checkin/add';
                            </SCRIPT>");
        }elseif ($verify_card == 'ND') {
            $id =  $this->input->get_post('reserv_id');
            $result=$this->reservation_model->verify($id);
            $get_ser = $this->reservation_model->get_reservation_id($id);
            $data = array(
                    'reserv_id' => $get_ser->id,
                    'customer_id' => $get_ser->Customer_id,
                    'date_in' => $get_ser->checkin_data,
                    'date_out'=> $get_ser->checkout_data,
                    'room_no' => $get_ser->room_id,
                    'staying' => $get_ser->duration,
                    'extra_charges' => 0,
                    'discount' => $get_ser->discount,
                    'price' => $get_ser->price,
                    'total' => $get_ser->total,
                    'grand_total' => $get_ser->grand_total,
                    'pay' => 'unpay',
                    'checkin_type' => $get_ser->staying,
                    'user' => $this->session->userdata('user_name')
                    );
            $this->db->insert('tbl_checkin',$data);
            $chid = $this->db->insert_id();

            $detail = array(
                'checkin_id' => $chid,
                'price' => $get_ser->price,
                'qty' => $get_ser->staying,
                'item_name' => 'staying',  
                'date_order' => date('Y-m-d'),              
                'discount' => 0,
                'amount' => $get_ser->total_price,
                'current_date' => date("Y-m-d")
               );
        $this->db->insert('tbl_checkin_detail',$detail);
        $room = array('status' => 1);
        $this->db->where('id',$get_ser->room_id)->update('tbl_room',$rooms);
// ===============================get data after insert===============================================
            $this->db->select('tbl_checkin.id,tbl_checkin.date_in , tbl_checkin.date_out , tbl_room.room_no');
            $this->db->from('tbl_checkin');
            $this->db->join('tbl_room','tbl_room.id=tbl_checkin.room_no','left');
            $this->db->where('tbl_checkin.id',$chid);
            $get_data=$this->db->get()->row();
            // print_r($get_data);die();

            $date_in= date('YmdHs',strtotime($get_data->date_in));
            $date_out=date('YmdHs',strtotime($get_data->date_out));
             // print_r($date_in);die();
             $fp = fsockopen("127.0.0.1", 8000, $errno, $errstr, 30);
                if (!$fp) {
                    echo "$errstr ($errno)<br />\n";
                } 
                else {
                    $con_string = "00000I|R".$get_data->room_no."|T04|D".$date_in."|O".$date_out; // WRITE 
                    $msg = chr(2).$con_string.chr(3);
                    fwrite($fp, $msg);
                    $buffer = fread($fp, 4096);
                        echo ("<SCRIPT LANGUAGE='JavaScript'>
                                    window.alert('".$buffer."')
                                    window.location.href='http://localhost/sv_hotel/admin/checkin';
                                    </SCRIPT>");
                    fclose($fp);
                }
            echo json_encode (array($result));

        }
        

        
// ==========================================get data to scan card========================
            // $this->db->where('id',$chid);
            //  $get_data=$this->db->get('tbl_checkin')->row();

            
    } 

    function get_verify_card(){
        $fp = fsockopen("127.0.0.1", 8000, $errno, $errstr, 30);
        $con_string='00000E';
        $msg = chr(2).$con_string.chr(3);
        fwrite($fp, $msg);
        $buffer = fread($fp, 4096);
        $buf=count(explode('|', $buffer));
        // var_dump($buf);die();
        if ($buf == 1) {
           fclose($fp);
           return 'NC';
        }elseif ($buf<=3) {
            fclose($fp);
            return 'ND';
        }elseif ($buf >3) {
            fclose($fp);
            return 'HD';
        }
   }

   


}
