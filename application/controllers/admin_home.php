<?php
class Admin_home extends CI_Controller {

 
    /**
    * Responsable for auto load the model
    * @return void
    */
    public function __construct() 
    {
        parent::__construct();
        
        $this->load->helper('language');
        //Load language Content 
        $this->load->helper('language');
        $this->lang->load("content", $this->session->userdata('language'));

        //Load language Content 
        $this->load->helper('language');
        $this->load->model('model_item','item');
        $this->load->model('checkout_model');

    }
 
    /**
    * Load the main view with all the current model model's data.
    * @return void
    */
    public function index()
    {

        $this->load->view('home');  

    }//index

    function profile()
    {
        $data['main_content'] = 'admin/profile/profile';
        $data['x'] = $this->item->load_userprofile($this->session->userdata('user_name'));
        $this->load->view('includes/template', $data);
    }
    function save_profile()
    {
        $id = $this->input->post('uid');
      $data = array(
            'first_name' => $this->input->post('fname'),
            'last_name' => $this->input->post('lname'),
            'email_addres' => $this->input->post('email'),
            'user_name' => $this->input->post('username'),
            'pass_word'  => md5($this->input->post('confirmpassword'))
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
      $data['main_content'] = 'admin/user/edit';
      $this->load->view('includes/template', $data);
    }

}