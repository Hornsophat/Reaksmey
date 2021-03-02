<?php
class Currencies extends CI_Controller {

    /**
    * name of the folder responsible for the views 
    * which are manipulated by this controller
    * @constant string
    */
    const VIEW_FOLDER = 'admin/currencies';
 
    /**
    * Responsable for auto load the model
    * @return void
    */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('roomtype_model');
        $this->load->model('room_model');
        $this->load->model('currencies_model');
        
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

      	$data['cur']=$this->currencies_model->get_cure();
        $data['main_content'] = 'admin/currencies/list';
        $this->load->view('includes/template', $data);  
        // print_r($data['cur']);die();

    }//index

    public function add()
    {
        $data['main_content'] = 'admin/currencies/add';
        $this->load->view('includes/template', $data);  
        // echo "hello";
    } 
    function test_cart(){
        $data['main_content'] = 'admin/currencies/cart';
        $this->load->view('includes/template', $data);  
        // echo "hello";
    } 

    function get_insert(){

    	 $this->load->library('form_validation');
      $this->form_validation->set_rules('cu_name','please fill currencies name','tirm|required');
      $this->form_validation->set_rules('ex_rate','please fill exchange rate','trim|required');
      if ($this->form_validation->run() == false) {
      	redirect('Currencies');
      }else{

      		$insert_cur=array(
      				'cur_code'=>$this->input->post('cu_code'),
      				'cur_name'=>$this->input->post('cu_name'),
      				'cur_exchange'=>$this->input->post('ex_rate'),
      				'symbol'=>$this->input->post('cu_symbol')
      			);
      		$this->currencies_model->add_curr($insert_cur);
      		redirect('Currencies');
      }

    }     

    public function update($id)
    {
        //product id 
       
  
        //if save button was clicked, get the data sent via post
        // if ($this->input->server('REQUEST_METHOD') === 'POST')
        // {
        //         $data_to_store = array(
        //             'room_no' => $this->input->post('room_no'),
        //             'type_id' => $this->input->post('type_id'),
        //             'floor' => $this->input->post('floor'),
        //         );
        //         //if the insert has returned true then we show the flash message
        //         if($this->room_model->update_room($id, $data_to_store) == TRUE){
        //             $this->session->set_flashdata('flash_message', 'updated');
        //         }else{
        //             $this->session->set_flashdata('flash_message', 'not_updated');
        //         }
        //         redirect('admin/room/update/'.$id.'');


        // }	



        //room data 
        // $data['room_type'] = $this->roomtype_model->get_roomtype_all();
        // $data['room'] = $this->room_model->get_room_by_id($id);
        //load the view
        $data['get_dat']=$this->currencies_model->get_data_edit($id);
        $data['main_content'] = 'admin/currencies/edit';
        $this->load->view('includes/template', $data);            

    }//update

    function edit_cur(){ 
    	// $id = $this->uri->segment(4);
    	$id=$this->input->post('c_id');
    	$get_update=array(
    			// 'id'=>$this->input->post('c_id'),
    			'cur_code'=>$this->input->post('cu_code'),
    			'cur_name'=>$this->input->post('cu_name'),
    			'cur_exchange'=>$this->input->post('ex_rate'),
    			'symbol'=>$this->input->post('cu_symbol')
    		);
    	$this->currencies_model->get_update_currencies($get_update,$id);
    	redirect('currencies');
    }

   
    public function delete($id)
    {
        //product id 
        $id = $this->uri->segment(3);
        $this->currencies_model->delete_cur($id);
        redirect('Currencies');
    }//edit
    
    public function get_by_roomtype()
    {
        $type =  $this->input->get_post('room_type');
        $result=$this->room_model->get_by_type($type);
        echo json_encode (array($result));
        
    }//search
    function select_ex_type(){
        $this->db->select('*');
        $this->db->from('tbl_expense_type');
        $this->db->order_by('id','desc');
        return $this->db->get()->result();
    }
    function exspanse_type_insert(){
        $arr_ex=array(
            'ex_type'=>$this->input->post('exspanes_type')
        );

        $re=$this->db->insert('tbl_expense_type',$arr_ex);
        if ($re) {
            redirect('currencies/expense_list');
        }else{
            redirect('currencies/expense_list');
        }
    }

    function expense_list(){

        $date_in = date("Y-m-d");
        $first_date = $this->input->get('first_date');
        $last_date = $this->input->get('last_date');

        $data['expenes'] = $this->get_all_expenes($date_in,$first_date,$last_date);
        // var_dump($data['expenes']);die();
        $data['main_content'] = 'admin/currencies/expense';
        $this->load->view('includes/template', $data);  
    }
    function add_exspanse(){
        $data['ex_t'] = $this->select_ex_type();
        // var_dump($data['ex_t']);die();
        $data['main_content'] = 'admin/currencies/add_exspand';
        $this->load->view('includes/template', $data);  
    }

    function exspanse_insert(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('ex_amount','please fill amounts','trim|required');
        if ($this->form_validation->run() == false) {
            redirect('currencies/add_exspanse');
        }else{
            $exp_arr=array(
                    'date'=>$this->input->post('ex_date'),
                    'ex_type_id'=>$this->input->post('ex_type'),
                    'amount'=>$this->input->post('ex_amount'),
                    'note'=>$this->input->post('ex_note')
            );
            // var_dump($exp_arr);die();

            $ex_re = $this->db->insert('tbl_expense',$exp_arr);
            if ($ex_re) {
                redirect('currencies/expense_list');
            }else{
                redirect('currencies/expense_list');
            }

        }
    }
    
    function get_all_expenes($date_in,$first_date,$last_date){

        $this->db->select('te.id as tdid,te.amount,te.date,te.note,tet.ex_type');
        $this->db->from('tbl_expense te');
        $this->db->join('tbl_expense_type tet','te.ex_type_id = tet.id','left');
        
        if($first_date!='' && $last_date!=''){
            $this->db->where('date >= ',$first_date);
            $this->db->where('date <= ',$last_date);

            $this->db->order_by('te.id', 'DESC');
            $query = $this->db->get();
            return $query->result();
        }else{
            return false;

        }


        // $ress= "SELECT te.id as tdid,te.amount,te.date,te.note,tet.ex_type
        //         FROM tbl_expense te
        //         LEFT JOIN tbl_expense_type tet
        //         ON te.ex_type_id = tet.id
        //         WHERE 
        //         ORDER BY te.id DESC";
        // return $this->db->query($ress)->result();
    }
    function delete_expenes($id){
        $id = $this->uri->segment(3);
        $this->currencies_model->delete_ex($id);
        redirect('Currencies/expense_list');
    }

    function update_expenes($tdid){
        // $ex_id = $this->input->post('tdid');
        $data['ex_t'] = $this->select_ex_type();
        $datas="SELECT te.id as tdid,te.amount,te.date,te.note,tet.ex_type
                FROM tbl_expense te
                LEFT JOIN tbl_expense_type tet
                ON te.ex_type_id = tet.id
                WHERE te.id = $tdid";
        $datass=$this->db->query($datas)->row();
        $data['ex_up']=$datass;
        // var_dump($data['ex_up']);die();
        $data['main_content'] = 'admin/currencies/edit_expense';
        $this->load->view('includes/template', $data);


    }
    function exspanse_update(){
        $id =  $this->input->post('c_id');
        // var_dump($id);die();
        $ex_update=array(
                    'date'=>$this->input->post('ex_date'),
                    'ex_type_id'=>$this->input->post('ex_type'),
                    'amount'=>$this->input->post('ex_amount'),
                    'note'=>$this->input->post('ex_note')
            );

        $this->currencies_model->get_update_expense($ex_update,$id);
            redirect('currencies/expense_list');
        
    }

    function add_bank(){
        $data['list_bank'] = $this->getAllBank();
        $data['main_content'] = 'admin/currencies/add_bank';
        $this->load->view('includes/template', $data);
    }
    function getAllBank(){
        $sql = $this->db->query("SELECT * FROM tbl_bank");
        return $sql->result();
    }

    function bank_insert(){
        $this->form_validation->set_rules('bname','please fill bname','trim|required');
      if ($this->form_validation->run() == true) {

                $bank = array(
                    'account_name' => $this->input->post('bname'),
                    'account_number' => $this->input->post('accnumber'),
                    'date'          =>$this->input->post('ex_date'),
                );
                if ($this->db->insert('tbl_bank',$bank)) {
                    redirect('currencies/add_bank');
                }else{
                    redirect('currencies/add_bank');
                }

       }
    }

}