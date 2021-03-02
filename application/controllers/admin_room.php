<?php
class Admin_room extends CI_Controller {

    /**
    * name of the folder responsible for the views 
    * which are manipulated by this controller
    * @constant string
    */
    const VIEW_FOLDER = 'admin/room';
 
    /**
    * Responsable for auto load the model
    * @return void
    */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('roomtype_model');
        $this->load->model('room_model');
        
        $this->load->helper('language');
        $this->lang->load("content", $this->session->userdata('language'));

        if(!$this->session->userdata('is_logged_in')) {
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

        $config['base_url'] = base_url().'admin/room';
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = 20;
        $config['full_tag_open'] = '<li>';
        $config['full_tag_close'] = '</li>';
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
            $data['count_products']= $this->room_model->count_room($search_string, $order);
            $config['total_rows'] = $data['count_products'];

            //fetch sql data into arrays
            if($search_string){
                if($order){
                    $data['room'] = $this->room_model->get_room($search_string, $order, $order_type, $config['per_page'],$limit_end);        
                }else{
                    $data['room'] = $this->room_model->get_room($search_string, '', $order_type, $config['per_page'],$limit_end);           
                }
            }else{
                if($order){
                    $data['room'] = $this->room_model->get_room('', $order, $order_type, $config['per_page'],$limit_end);        
                }else{
                    $data['room'] = $this->room_model->get_room('', '', $order_type, $config['per_page'],$limit_end);        
                }
            }

        }else{

            //clean filter data inside section
            $filter_session_data['room_selected'] = null;
            $filter_session_data['search_string_selected'] = null;
            $filter_session_data['order'] = null;
            $filter_session_data['order_type'] = null;
            $this->session->set_userdata($filter_session_data);

            //pre selected options
            $data['search_string_selected'] = '';
            $data['order'] = 'id';

            //fetch sql data into arrays
            $data['count_rooms']= $this->room_model->count_room();
            $data['room'] = $this->room_model->get_room('', '', $order_type, $config['per_page'],$limit_end);        
            $config['total_rows'] = $data['count_rooms'];

        }//!isset($search_string) && !isset($order)
         
        //initializate the panination helper 
        $this->pagination->initialize($config);   

        //load the view
        $data['main_content'] = 'admin/room/list';
        $this->load->view('includes/template', $data);  

    }//index

    public function add()
    {
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {

            

                $data_to_store = array(
                    'room_no' => $this->input->post('room_no'),
                    'type_id' => $this->input->post('type_id'),
                    'floor' => $this->input->post('floor'),
                );
                //if the insert has returned true then we show the flash message
                if($this->room_model->store_room($data_to_store)){
                    $data['flash_message'] = TRUE; 
                }else{
                    $data['flash_message'] = FALSE; 
                }

   

        }
        //load the view
        $data['room_type'] = $this->roomtype_model->get_roomtype_all();
        
        $data['main_content'] = 'admin/room/add';
        $this->load->view('includes/template', $data);  
    }       

    /**
    * Update item by his id
    * @return void
    */
    public function update()
    {
        //product id 
        $id = $this->uri->segment(4);
  
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
                $data_to_store = array(
                    'room_no' => $this->input->post('room_no'),
                    'type_id' => $this->input->post('type_id'),
                    'floor' => $this->input->post('floor'),
                );
                //if the insert has returned true then we show the flash message
                if($this->room_model->update_room($id, $data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('admin/room/update/'.$id.'');


        }

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

        //room data 
        $data['room_type'] = $this->roomtype_model->get_roomtype_all();
        $data['room'] = $this->room_model->get_room_by_id($id);
        //load the view
        $data['main_content'] = 'admin/room/edit';
        $this->load->view('includes/template', $data);            

    }//update

    /**
    * Delete product by his id
    * @return void
    */
    public function delete()
    {
        //product id 
        $id = $this->uri->segment(4);
        $this->room_model->delete_room($id);
        redirect('admin/room');
    }//edit
    
    public function get_by_roomtype()
    {
        $type =  $this->input->get_post('room_type');
        // var_dump($type->result);die();
        $result=$this->room_model->get_by_type($type);
        echo json_encode (array($result));
        
    }//search
    public function get_by_roomtype_ajax(){
        $type =  $this->input->get_post('room_type');
        $reserva_room_id  = $this->input->get_post('reserva_room_id');
        // var_dump($type->result);die();
        $result=$this->room_model->get_by_type_resullt($type,$reserva_room_id);
        $options = "";
        $options = "<option value=''> Select Room </option>";
        foreach ($result as $room) {
            $options.= '<option value="'.$room->id.'">'.$room->room_no.'</option>';
        }
        echo $options;
    }
    public function total_reservation(){
        // session_start();
        $today = date('Y-m-d');
        $staing_time =  $this->input->get_post('staing_time');
        $duration =  $this->input->get_post('duration');
        $price =  $this->input->get_post('price');
        $date_in =  $this->input->get_post('date_in');
        $deposit =  $this->input->get_post('deposit_am');
        $discount =  $this->input->get_post('discount');
        $room_type = $this->input->get_post('room_type');
        $room_no = $this->input->get_post('room_no');
        $data = [];
        $date_out = "";
        $total = 0;
        $grand_total = 0;
        $staing_time = $staing_time?$staing_time:0;
        $duration = $duration?$duration:0;
        $price = $price?$price:0;
        $deposit = $deposit?$deposit:0;
        $discount = $discount?$discount:0;
        $isMonth = "false";
 
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
                    if(!(strtotime(date('Y-m-d',strtotime($date_in))) == strtotime(date('Y-m-d',strtotime($check_room->room_checkout))))){

                        if(strtotime(date('Y-m-d',strtotime($date_in))) <= strtotime(date('Y-m-d',strtotime($check_room->room_checkout))) ){
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
        if($price == false){
            $price = 0;
        }
        $data = [
            'price' => $price,
            'total' => $total,
            'grand_total' => $grand_total,
            'date_out' => $date_out,
            'isMonth' =>$isMonth
        ];

        // $_SESSION['total_reservation'] = $data;

         echo json_encode ($data);

    }
    public function total_reservation_multy(){
        $reserva_room_id = $this->input->get_post('reserva_room_id');
        $reserva_rootype_id = $this->input->get_post('reserva_rootype_id');
        $reserva_chekin_type = $this->input->get_post('reserva_chekin_type');
        $duration =  $this->input->get_post('duration');
        $date_in =  $this->input->get_post('date_in');
        $deposit =  $this->input->get_post('deposit_am');
        $discount =  $this->input->get_post('discount');
        $date_out = "";
        $datatable ="";
        $duration = $duration ? $duration : 0;
        $discount = $discount ? $discount : 0;
        $deposit = $deposit ? $deposit : 0;
        $total = 0;
        $amount = 0;
        $grand_total = 0;
        // $date_out = date('Y-m-d',strtotime($date_in.' +'.$duration.' day'));
        if($duration == 0 || $duration < 1){
            $data = [
                'error' => 1,
                'type' => 'warning',
                'message' => 'Please Input Duration First !'
            ];
            echo json_encode ($data);
            exit;
        }
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
            // if($check_room){
            //     if($check_room->room_checkout){
            //         if(!(strtotime(date('Y-m-d',strtotime($date_in))) == strtotime(date('Y-m-d',strtotime($check_room->room_checkout))))){

            //             if(strtotime(date('Y-m-d',strtotime($date_in))) <= strtotime(date('Y-m-d',strtotime($check_room->room_checkout))) ){
            //                 $data = [
            //                     'not_free' => 1,
            //                     'type' => 'info',
            //                     'message' => 'This room not available form :'.date('d-m-Y',strtotime($check_room->date_in)).' to '.date('d-m-Y',strtotime($check_room->room_checkout)).' Pleae Select Other room !'
            //                 ];
            //                 echo json_encode ($data);
            //                 exit;
            //         }
            //     }
            //     }else{
            //         $data = [
            //             'not_free' => 1,
            //             'type' => 'info',
            //             'message' => 'This room not available form :'.date('d-m-Y',strtotime($check_room->date_in)).' to '.date('d-m-Y',strtotime($check_room->date_out)).' Pleae Select Other room !'
            //         ];
            //         echo json_encode ($data);
            //         exit;
            //     }
                
            // }
            $date_out = date('Y-m-d',strtotime($date_in.' +'.$duration.' day'));
            $total = $this->room_model->getPriceByDay($date_in,$duration,$room_type)['total'];
            $price = $this->room_model->getPriceByDay($date_in,$duration,$room_type)['data'];
        }
        if($reserva_room_id){
            $a = 1;
            for ($i=0; $i <= (count($reserva_room_id) -1) ; $i++) { 

                $amount = $this->room_model->getPriceByDay($date_in,$duration,$reserva_rootype_id[$i])['total'];
                $price = $this->room_model->getPriceByDay($date_in,$duration,$reserva_rootype_id[$i])['data'];
                $result=$this->room_model->get_roomdetail_by_id($reserva_room_id[$i]);
                $total += $amount;
                $datatable .= '<tr id="tr_room_id_'.$result->room_id.'" class="item_'.$result->room_id.'">';
                $datatable .= '<input type="hidden" id="reserva_room_id" name="reserva_room_id[]" value="'.$result->room_id.'">';
                $datatable .= '<input type="hidden" id="reserva_rootype_id" name="reserva_rootype_id[]" value="'.$result->roomType_id.'">';
                $datatable .= '<input type="hidden" id="reserva_chekin_type" name="reserva_chekin_type[]" value="'.$result->stayingid.'">';
                $datatable .= '<input type="hidden" id="reserva_floor" name="reserva_floor[]" value="'.$result->floor.'">';
                $datatable .= '<input type="hidden" id="reserva_room_no" name="reserva_room_no[]" value="'.$result->room_no.'">';
                $datatable .= '<input type="hidden" id="reserva_price" name="reserva_price[]" value="'.$price.'">';
                $datatable .= '<input type="hidden" id="reserva_amount" name="reserva_amount[]" value="'.$amount.'">';

                $datatable .= '<td class="text-center">'.$a++.'</td>';
                $datatable .= '<td>'.$result->type.'</td>';
                $datatable .= '<td>'.$result->room_no.'</td>';
                $datatable .= '<td>'.$result->floor.'</td>';
                $datatable .= '<td>'.$result->time.'</td>';
                $datatable .= '<td>'.$price.'</td>';
                $datatable .= '<td>'.$amount.'</td>';
                $datatable .= '<td class="text-center"><a href="javascript:function();" onclick="remove_room_tr('.$result->room_id.');"><span class="glyphicon glyphicon-trash text-danger delete_room_tr"></span></a></td>';
            $datatable .= '</tr>';

            }
        }
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
        if($price == false){
            $price = 0;
        }

        $data['datatable'] = $datatable;
        $data['date_out'] = $date_out;
        $data['total'] = $total;
        $data['grand_total'] = $grand_total;
        echo json_encode($data);

    }
    public function get_multiromm_ajax(){

        $today = date('Y-m-d');
        $room_id =  $this->input->get_post('room_id');
        $reserva_room_id = $this->input->get_post('reserva_room_id');
        $result=$this->room_model->get_roomdetail_by_id($room_id);
        $dayType = $this->input->get_post('dtype');
        $date_in  = $this->input->get_post('date_in');
        $duration =  $this->input->get_post('duration')?$this->input->get_post('duration'):0;
        $room_type = $this->input->get_post('room_type');
        $datatable = "";
        $date_out = "";
        $data = [];
        // $date_out = date('Y-m-d',strtotime($date_in.' +'.$duration.' day'));
        if($duration == 0 || $duration < 1){
            $data = [
                'error' => 1,
                'type' => 'warning',
                'message' => 'Please Input Duration First !'
            ];
            echo json_encode ($data);
            exit;
        }
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
            $check_room = $this->room_model->check_available_room($room_id,$date_in);
            if($check_room){
                if($check_room->room_checkout){
                    if(!(strtotime(date('Y-m-d',strtotime($date_in))) == strtotime(date('Y-m-d',strtotime($check_room->room_checkout))))){

                        if(strtotime(date('Y-m-d',strtotime($date_in))) <= strtotime(date('Y-m-d',strtotime($check_room->room_checkout))) ){
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

            $date_out = date('Y-m-d',strtotime($date_in.' +'.$duration.' day'));
            $total = $this->room_model->getPriceByDay($date_in,$duration,$room_type)['total'];
            $price = $this->room_model->getPriceByDay($date_in,$duration,$room_type)['data'];
        }

        $total = $this->room_model->getPriceByDay($date_in,$duration,$room_type)['total'];
        $price = $this->room_model->getPriceByDay($date_in,$duration,$room_type)['data'];
        $i = 0;
        if($reserva_room_id){
           $i = count($reserva_room_id);
        }
        $i = $i? $i : 0;
        if($result){
            $i =$i+1;
            $datatable .= '<tr id="tr_room_id_'.$result->room_id.'" class="item_'.$result->room_id.'">';

                $datatable .= '<input type="hidden" id="reserva_room_id" name="reserva_room_id[]" value="'.$result->room_id.'">';
                $datatable .= '<input type="hidden" id="reserva_rootype_id" name="reserva_rootype_id[]" value="'.$result->roomType_id.'">';
                $datatable .= '<input type="hidden" id="reserva_chekin_type" name="reserva_chekin_type[]" value="'.$result->stayingid.'">';
                $datatable .= '<input type="hidden" id="reserva_floor" name="reserva_floor[]" value="'.$result->floor.'">';
                $datatable .= '<input type="hidden" id="reserva_room_no" name="reserva_room_no[]" value="'.$result->room_no.'">';
                $datatable .= '<input type="hidden" id="reserva_price" name="reserva_price[]" value="'.$price.'">';
                $datatable .= '<input type="hidden" id="reserva_amount" name="reserva_amount[]" value="'.$total.'">';

                $datatable .= '<td class="text-center">'.$i.'</td>';
                $datatable .= '<td>'.$result->type.'</td>';
                $datatable .= '<td>'.$result->room_no.'</td>';
                $datatable .= '<td>'.$result->floor.'</td>';
                $datatable .= '<td>'.$result->time.'</td>';
                $datatable .= '<td>'.$price.'</td>';
                $datatable .= '<td>'.$total.'</td>';
                $datatable .= '<td class="text-center"><a href="javascript:function();" onclick="remove_room_tr('.$result->room_id.');"><span class="glyphicon glyphicon-trash text-danger delete_room_tr"></span></a></td>';
            $datatable .= '</tr>';
        }
            // $data = [
            //     'datatable' => $datatable,
            //     'date_out' => $date_out
            // ];
            $data['datatable'] = $datatable;
            $data['date_out'] = $date_out;
        echo json_encode($data);
    }
    public function get_multiroom_by_id()
    {
        
        $room_multi =  $this->input->get_post('room_id');

        $result=$this->room_model->get_room_no_id($room_multi);
        $dayType = $this->input->get_post('dtype');
        // echo json_encode($result);
        if ($result) {
            $rp = 0;
            foreach ($result as $item) {
                if ($dayType == 1) {
                    $rp = $item->staying_price;
                }elseif ($dayType == 2) {
                   $rp = $item->price_weekend;
                }else{
                    $rp = $item->price_cereymony;
                }

                $data[] = array('ro_id' => $item->room_id,'ro_no' => $item->room_no, 'staying_id' => $item->stayingid,'staying_time' => $item->time,'room_price' => $rp,'ro_type' => $item->type,'floor'=> $item->floor);
                echo json_encode($data);
            }
        }
        
     
        // $room_row = "<tr>
        //                 <td class='order' style='text-align:center;vertical-align:inherit'></td>
        //                 <td style='vertical-align:inherit'>". $result->type ."<input type='hidden' name='r_type[]' class='form-control room_type' id='room_type' value='".$result->type."'><input type='hidden' name='ro_id[]' class='form-control ro_id' id='ro_id' value='".$result->id."'></td>
        //                 <td style='vertical-align:inherit'>". $result->room_no ."<input type='hidden' name='r_no[]' class='form-control r_no' id='r_no' value='".$result->room_no."'></td>
        //                 <td style='text-align:center;vertical-align:inherit'>". $result->floor ."<input type='hidden' name='r_floor[]' class='form-control r_floor' id='r_floor' value='".$result->floor."'><input type='hidden' name='r_no[]' class='form-control r_no' id='r_no' value='".$result->room_no."'></td>
        //                 <td style='text-align:center;vertical-align:inherit'>". $result->time ."<input type='hidden' name='r_time[]' class='form-control r_time' id='r_time' value='".$result->time."'></td>
        //                 <td class='hide'>
        //                     <input type='hidden' class='form-control staying' style='margin: 0px auto;width: 110px;text-align:center;vertical-align:inherit'>
        //                 </td>
        //                 <td > 
        //                     <input type='text' readonly class='form-control price' name='r_price[]' value='".$result->price."'style='margin: 0px auto;width: 110px;text-align:center;vertical-align:inherit'>
        //                 </td>
        //                 <td style='text-align:center;vertical-align:inherit;width: 55px;'><a href='' class='btn form-control '>x</a></td>
        //             </tr>";

        // echo $room_row;
        
    }//search
}