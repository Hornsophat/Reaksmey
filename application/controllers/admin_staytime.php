<?php
class Admin_staytime extends CI_Controller {

    /**
    * name of the folder responsible for the views 
    * which are manipulated by this controller
    * @constant string
    */
    const VIEW_FOLDER = 'admin/staytime';
 
    /**
    * Responsable for auto load the model
    * @return void
    */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('staytime_model');
        $this->load->model('roomtype_model');
        
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
        $config['per_page'] = 5;

        $config['base_url'] = base_url().'admin/staying';
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
            $data['count_products']= $this->staytime_model->count_staytime($search_string, $order);
            $config['total_rows'] = $data['count_products'];

            //fetch sql data into arrays
            if($search_string){
                if($order){
                    $data['staytime'] = $this->staytime_model->get_staytime($search_string, $order, $order_type, $config['per_page'],$limit_end);        
                }else{
                    $data['staytime'] = $this->staytime_model->get_staytime($search_string, '', $order_type, $config['per_page'],$limit_end);           
                }
            }else{
                if($order){
                    $data['staytime'] = $this->staytime_model->get_staytime('', $order, $order_type, $config['per_page'],$limit_end);        
                }else{
                    $data['staytime'] = $this->staytime_model->get_staytime('', '', $order_type, $config['per_page'],$limit_end);        
                }
            }

        }else{

            //clean filter data inside section
            $filter_session_data['roomtime_selected'] = null;
            $filter_session_data['search_string_selected'] = null;
            $filter_session_data['order'] = null;
            $filter_session_data['order_type'] = null;
            $this->session->set_userdata($filter_session_data);

            //pre selected options
            $data['search_string_selected'] = '';
            $data['order'] = 'id';

            //fetch sql data into arrays
            $data['count_staytimes']= $this->staytime_model->count_staytime();
            $data['staytime'] = $this->staytime_model->get_staytime('', '', $order_type, $config['per_page'],$limit_end);        
            $config['total_rows'] = $data['count_staytimes'];

        }//!isset($search_string) && !isset($order)
         
        //initializate the panination helper 
        $this->pagination->initialize($config);   

        //load the view
        $data['main_content'] = 'admin/staytime/list';
        $this->load->view('includes/template', $data);  

    }//index
     public function get_by_stay_ajax(){
        $room_no =  $this->input->get_post('room_type');
        $reserva_room_id  = $this->input->get_post('reserva_room_id');
        // var_dump($type->result);die();
        $result=$this->staytime_model->get_by_stay_result($room_no);
        $options = "";
        $options = "<option value=''> Select Stay type </option>";
        foreach ($result as $room) {
            $options.= '<option value="'.$room->id.'">'.$room->time.'</option>';
        }
        echo $options;
    }
    public function add()
    {
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {

            
                $data_to_store = array(
                    'roomtype_id' => $this->input->post('roomtype'),
                    'time' => $this->input->post('time'),
                    'price' => $this->input->post('price'),
                    'note' => $this->input->post('note'),
                    'price_weekend' => $this->input->post('price_weekend'),
                    'price_cereymony' => $this->input->post('price_cereymony'),
                    'price_month' => $this->input->post('price_month'),
                );
                //if the insert has returned true then we show the flash message
                if($this->staytime_model->store_staytime($data_to_store)){
                    $data['flash_message'] = TRUE; 
                }else{
                    $data['flash_message'] = FALSE; 


            }

        }

        $data['roomtype'] = $this->roomtype_model->get_roomtype_all();

        //load the view
        $data['main_content'] = 'admin/staytime/add';
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
                    'roomtype_id' => $this->input->post('roomtype'),
                    'time' => $this->input->post('time'),
                    'price' => $this->input->post('price'),
                    'note' => $this->input->post('note'),
                    'price_weekend' => $this->input->post('price_weekend'),
                    'price_cereymony' => $this->input->post('price_cereymony'),
                    'price_month' => $this->input->post('price_month'),
                );
                //if the insert has returned true then we show the flash message
                if($this->staytime_model->update_staytime($id, $data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('admin/staying/update/'.$id.'');


        }

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

        //product data
        $data['roomtype'] = $this->roomtype_model->get_roomtype_all();
        $data['staytime'] = $this->staytime_model->get_staytime_by_id($id);
        //load the view
        $data['main_content'] = 'admin/staytime/edit';
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
        $this->staytime_model->delete_staytime($id);
        redirect('admin/staying');
    }//edit
    
   public function search()
    {
        $LastName =  $this->input->get_post('LastName');
        $result=$this->customer_model->Search_customer($LastName);
        echo json_encode (array($result));
        
    }//search

    public function get_price() {
        // $id = $this->input->get('id');
        $roomtype =  $this->input->get_post('roomtype');


        $this->db->select('price');
        // $this->db->where('id', $id);
        $this->db->where('roomtype_id', $roomtype);
        $query = $this->db->get('tbl_staying')->row();
        //var_dump($query);die();
        $data = array('price'=>$query->price);
        echo json_encode($data);
    }

    public function get_available()
    {
        $type =  $this->input->get_post('room_type');
        $result=$this->staytime_model->get_by_type($type);
        echo json_encode (array($result));
    }
    function get_room_ajax(){
        $type =  $this->input->get_post('room_type');
        $result=$this->staytime_model->get_by_type($type);

        $options = "";
        foreach ($result as $room) {
            $options.= '<option value="'.$room->id.'">'.$room->room_no.'</option>';
        }
        echo $options;
    }
    public function getDayType(){
        $dt_id = $_GET['dt_id'];
        $rt_id = $_GET['r_typeid'];
        if ($dt_id == 2) {
            $sql = $this->db->query("SELECT price_weekend as addprice FROM tbl_staying WHERE roomtype_id ='".$rt_id."'")->row();
        }else if($dt_id == 3){
            $sql = $this->db->query("SELECT price_cereymony as addprice FROM tbl_staying WHERE roomtype_id ='".$rt_id."'")->row();
        }else{
            $sql = $this->db->query("SELECT price as addprice FROM tbl_staying WHERE roomtype_id ='".$rt_id."'")->row();
        }
        
       echo json_encode($sql);
    }

   function getPriceByDay(){

        $date = $_GET['d1'];
        $duration = $_GET['per_day'];
        $r_type = $_GET['r_typeid'];
        $rtypeIds = $_GET['rtype_ids'];

        $checkin = [];
        $weekend = [];

        for ($i=0; $i < $duration ; $i++) { 

            $current_day = date('D', strtotime($date. ' + '.$i.' days'));

            if ($current_day == "Fri" || $current_day == "Sat" || $current_day == "Sun") {

                $weekend[] = date('Y-m-d', strtotime($date. ' + '.$i.' days'));
                
            }else{

                $checkin[] = date('Y-m-d', strtotime($date. ' + '.$i.' days'));

            }
            

        }

        $start_date = $checkin[0];
        $end_date = $checkin[count($checkin)-1];

        $holidays = $this->db->query("SELECT DATE(`date`) as holiday FROM tbl_holiday WHERE DATE(`date`) BETWEEN '$start_date' AND '$end_date'")->result();
        $checkin_fl = array_flip($checkin);
        
        foreach ($holidays as $holiday) {
            $hdays[] = $holiday->holiday;
            if (isset($checkin_fl[$holiday->holiday])) {
                unset($checkin_fl[$holiday->holiday]);
            }

        }
        $checkin = array_flip($checkin_fl);

        $data["date_normal"] = $checkin;
        $data["date_weekend"] = $weekend;
        $data["date_holiday"] = $hdays;

        $type_price = $this->db->query("SELECT * FROM tbl_staying WHERE roomtype_id ='".$r_type."'")->row();


        $total_price = ($type_price->price * count($checkin)) + 
                        ($type_price->price_weekend * count($weekend)) + 
                        ($type_price->price_cereymony * count($hdays));

        if ($rtypeIds) {
            $rtype = array_unique($rtypeIds);

            $type_price = $this->db->query("SELECT * FROM tbl_staying WHERE roomtype_id IN(".implode(',', $rtype).")")->result();
            $count_rtype = array_count_values($rtypeIds);
            $room_type_total = 0;
            foreach ($type_price as $price) {
                $sub_total_price = ($price->price * count($checkin)) + 
                        ($price->price_weekend * count($weekend)) + 
                        ($price->price_cereymony * count($hdays));


                $room_type_total += $sub_total_price * $count_rtype[$price->roomtype_id];
            }


            $total_price = $room_type_total;
        }



        echo json_encode($total_price);
      

    }
}