<?php
class Admin_item extends CI_Controller {

 
    /**
    * Responsable for auto load the model
    * @return void
    */
    public function __construct()
    {
        parent::__construct();
        
        //Load language Content 
        $this->load->helper('language');
        $this->load->model('model_item','item');
        
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

        $data['main_content'] = 'admin/item/list';
        $data['listitem'] = $this->item->load_all_item();
        $this->load->view('includes/template', $data);

    }
    public function add()
    {
    	$data['main_content'] = 'admin/item/add';
        $data['listitem'] = $this->item->load_all_item();
        $this->load->view('includes/template', $data);
    }
    public function save()
    {
    	


    	if ($this->input->server('REQUEST_METHOD') === 'POST')
        {

            //form validation
            //$this->form_validation->set_rules('itemname', 'itemname', 'required');
            $this->form_validation->set_rules('itemname', 'itemname', 'trim|required|valid_p_name|is_unique[tbl_item.p_name]');
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            

            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
                
                $data  = array(
    				'p_name' => $this->input->post('itemname'),
    				'qty' => $this->input->post('qty'),
    				'price'  => $this->input->post('price')
    		    );

                //if the insert has returned true then we show the flash message
                
                if($this->db->insert('tbl_item',$data)){
                    $data['flash_message'] = TRUE; 
                }else{
                    $data['flash_message'] = FALSE; 
                }

            }

            $data['main_content'] = 'admin/item/add';
        	$this->load->view('includes/template', $data);  

        }


    }
    function edit($id)
    {
    	$data['x'] = $this->item->getItem_by_id($id);
    	$data['main_content'] = 'admin/item/add';
        $this->load->view('includes/template', $data); 
    }
    function update()
    {
    		$this->form_validation->set_rules('itemname', 'itemname', 'required');
            //$this->form_validation->set_rules('itemname', 'itemname', 'trim|required|valid_p_name|is_unique[tbl_item.p_name]');
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            
            $id = $this->input->post('itemid');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
                
                $data  = array(
    				'p_name' => $this->input->post('itemname'),
    				'qty' => $this->input->post('qty'),
    				'price'  => $this->input->post('price')
    		    );

                //if the insert has returned true then we show the flash message
                
                if($this->db->where('pid',$id)->update('tbl_item',$data)){
                    $data['flash_message'] = TRUE; 
                }else{
                    $data['flash_message'] = FALSE; 
                }

            }
            $data['id'] = $id;
            $data['main_content'] = 'admin/item/list';
            $data['listitem'] = $this->item->load_all_item();
        	$this->load->view('includes/template', $data);
    }
    function del($id)
    {
    	$this->db->where('pid',$id)->delete('tbl_item');
    	$data['main_content'] = 'admin/item/list';
        $data['listitem'] = $this->item->load_all_item();
        $this->load->view('includes/template', $data);
    }

}
?>