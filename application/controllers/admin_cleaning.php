<?php
class Admin_cleaning extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        
        //Load language Content 
        $this->load->helper('language');
        $this->load->model('checkin_model');
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
        $data['room_clean'] = $this->getRoomCheckoutByDay();
        // var_dump($data['room_clean']);die();

        $data['main_content'] = 'admin/cleaning/list';
        // $data['listitem'] = $this->item->load_all_item();
        $this->load->view('includes/template', $data);

    }

    function getRoomCheckoutByDay(){
        $today = date('Y-m-d H:i:s',strtotime("-1 days"));
        $sql = $this->db->query("SELECT
                                    tchd.detail_id,
                                    tch.date_in,
                                    tch.date_out,
                                    tchd.room_no,
                                    tchd.amount,
                                    tch.cleaning_status,
                                    rtype.type,
                                    tchd.is_clean
                                FROM
                                    tbl_checkin tch
                                INNER  JOIN tbl_checkin_detail tchd ON tchd.checkin_id = tch.id
                                INNER JOIN tbl_roomtype rtype ON tchd.room_type = rtype.id
                                WHERE
                                    tch.checkouted = 1 
                                    AND tchd.room_id IS NOT NULL 
                                    AND tchd.is_clean = 0 
                                    AND tch.date_out >= '".$today."'
        ");
        // var_dump($sql);die();

        return $sql->result();
    }

    public function update($id){
        // var_dump($id);die();
        if ($id) {
            $this->db->where('detail_id',$id)->update('tbl_checkin_detail',array('is_clean' => 1));
            redirect('admin_cleaning');

        }
    }

    public function addHoliday(){
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            $this->form_validation->set_rules('d_holiday', 'd_holiday', 'required');
            if ($this->form_validation->run() == TRUE) {
                $date = $this->input->post('d_holiday');
                $hol_dis = $this->input->post('holiday_dis');
                // var_dump($date);die();
                $check = $this->check_is_alredyadd(date('Y-m-d',strtotime($date)),$id);
                if($check){
                    $this->session->set_flashdata(array(
                            'message' => "This date create already ".date('d-m-Y',strtotime($check->date))."", 
                            'alert-type' => 'danger'
                        )
                    );
                    redirect('admin/cleaning/list_holiday');
                }
                $holiday = array(
                        'date' => $date,
                        'descripton' => $hol_dis,
                );
                $this->db->insert('tbl_holiday',$holiday);
                redirect('admin/cleaning/list_holiday');
            }
            
        }
        
    }

    public function list_holiday(){
        $data['allHoliday'] = $this->getAllHoliday();

        $data['main_content'] = 'admin/cleaning/listHoliday';
        $this->load->view('includes/template', $data);
    }


    function getAllHoliday(){
        $sql = $this->db->query("SELECT * FROM tbl_holiday");
        return $sql->result();
    }

    function updateHoliday(){
        $id = $_GET['id'];
        // var_dump($id);die();
        $data = $this->db->query("SELECT * FROM tbl_holiday WHERE id ='".$id."'")->row();
        $datas = [
                'id'        => $data->id,
                'date'      => date('Y-m-d',strtotime($data->date)),
                'descripton'=>  $data->descripton
        ];
        echo json_encode($datas);
    }

    function editHoliday(){
        
        $this->form_validation->set_rules('d_holiday', 'd_holiday', 'required');
        if ($this->form_validation->run() == TRUE) {
            $date = $this->input->post('d_holiday');
            $hol_dis = $this->input->post('holiday_dis');
            $id = $this->input->post('ro_id');
            $check = $this->check_is_alredyadd(date('Y-m-d',strtotime($date)),$id);
            if($check){
                $this->session->set_flashdata(array(
                        'message' => "This date create already ".date('d-m-Y',strtotime($check->date))."", 
                        'alert-type' => 'danger'
                    )
                );
                redirect('admin/cleaning/list_holiday');
            }
            $holiday = array(
                    'date' => $date,
                    'descripton' => $hol_dis,
            );
            $this->db->where('id',$id)->update('tbl_holiday',$holiday);
            redirect('admin/cleaning/list_holiday');
        }
    }
    function check_is_alredyadd($date,$id=null){
            $where ="";
            if($id !=''){
                $where ="AND id <> '$id'";
            }
            $data = $this->db->query("SELECT * FROM tbl_holiday  WHERE DATE(`date`) = '$date' {$where}")->row();
            return $data;
    }
    function deletHoliday(){
        $id = $_GET['id'];
        // var_dump($id);die();
        if ($id) {
            $del = $this->db->where('id',$id)->delete('tbl_holiday');
            if ($del) {
                $smg = 'delete success';
                echo json_encode($smg);
            }
        }
    }
}