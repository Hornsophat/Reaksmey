<?php
class Admin_dashboard extends CI_Controller {

    /**
    * name of the folder responsible for the views 
    * which are manipulated by this controller
    * @constant string
    */
    const VIEW_FOLDER = 'customer/dashboard';
 
    /**
    * Responsable for auto load the model
    * @return void
    */
    public function __construct()
    {
        parent::__construct();
        
        //Load language Content 
        $this->load->helper('language');
        $this->lang->load("content", $this->session->userdata('language'));
        
        $this->load->model('dashboard_model');
        $this->load->model('reservation_model');

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

         
     	$data['customer_count'] = $this->dashboard_model->count_customer();
     	$data['today_reserv'] = $this->dashboard_model->count_today_reserv();
     	$data['today_checkout'] = $this->dashboard_model->count_today_checkout();
     	$data['not_verifued'] = $this->dashboard_model->count_not_verifyed();
        $data['total_rooms'] = $this->dashboard_model->count_all_rooms();
        $data['ground_rooms'] = $this->dashboard_model->count_ground_rooms();
        $data['first_rooms'] = $this->dashboard_model->count_first_rooms();
        $data['second_rooms'] = $this->dashboard_model->count_second_rooms();
        $data['third_rooms'] = $this->dashboard_model->count_third_rooms();
        $data['four_rooms'] = $this->dashboard_model->count_four_rooms();
        $data['five_rooms'] = $this->dashboard_model->count_five_rooms();
        $data['six_rooms'] = $this->dashboard_model->count_six_rooms();
        $data['seven_rooms'] = $this->dashboard_model->count_seven_rooms();
        $data['eight_rooms'] = $this->dashboard_model->count_eight_rooms();
        $data['total_checkin']= $this->dashboard_model->count_all_checkin();

        // var_dump($data['today_checkout']);die();
        //load the view
        $data['main_content'] = 'admin/dashboard/index';
        $this->load->view('includes/template', $data);  

    }//index

    public function view_rooms()
    {
        $data['rooms'] = $this->dashboard_model->get_all_room();

        //load the view
        $data['main_content'] = 'admin/dashboard/view_rooms';
        $this->load->view('includes/template', $data); 
    }

    public function first_floor()
    {
        $data['rooms'] = $this->dashboard_model->get_first_floor();

        //load the view
        $data['main_content'] = 'admin/dashboard/first_floor';
        $this->load->view('includes/template', $data); 
    }

    public function second_floor()
    {
        $data['rooms'] = $this->dashboard_model->get_second_floor();

        //load the view
        $data['main_content'] = 'admin/dashboard/second_floor';
        $this->load->view('includes/template', $data); 
    }
    public function third_floor()
    {
        $data['rooms'] = $this->dashboard_model->get_third_floor();

        //load the view
        $data['main_content'] = 'admin/dashboard/third_floor';
        $this->load->view('includes/template', $data); 
    }
    public function four_floor()
    {
        $data['rooms'] = $this->dashboard_model->get_four_floor();

        //load the view
        $data['main_content'] = 'admin/dashboard/four_floor';
        $this->load->view('includes/template', $data); 
    }
    public function five_floor()
    {
        $data['rooms'] = $this->dashboard_model->get_five_floor();

        //load the view
        $data['main_content'] = 'admin/dashboard/five_floor';
        $this->load->view('includes/template', $data); 
    }
    public function six_floor()
    {
        $data['rooms'] = $this->dashboard_model->get_six_floor();

        //load the view
        $data['main_content'] = 'admin/dashboard/six_floor';
        $this->load->view('includes/template', $data); 
    }
    public function seven_floor()
    {
        $data['rooms'] = $this->dashboard_model->get_seven_floor();

        //load the view
        $data['main_content'] = 'admin/dashboard/seven_floor';
        $this->load->view('includes/template', $data); 
    }
    public function eight_floor()
    {
        $data['rooms'] = $this->dashboard_model->get_eight_floor();

        //load the view
        $data['main_content'] = 'admin/dashboard/eight_floor';
        $this->load->view('includes/template', $data); 
    }

    public function reserve_cancel()
    {
        $id = $this->input->post('reserv_id');
        $result = $this->reservation_model->cancel($id);
        echo json_encode($result);
    }

}
