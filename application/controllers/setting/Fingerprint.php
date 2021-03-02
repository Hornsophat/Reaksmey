<?php defined('BASEPATH') OR exit('No direct script access allowed');
// include("zklib/zklib.php");
class Fingerprint extends CI_Controller
{
     function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('user_name')=="") {
            $this->session->set_userdata('requested_page', $this->uri->uri_string());
            redirect('login');
        }
        // if ($this->Customer || $this->Supplier) {
        //     $this->session->set_flashdata('warning', lang('access_denied'));
        //     redirect($_SERVER["HTTP_REFERER"]);
        // }
        // $this->lang->load('customers', $this->Settings->language);
        $this->load->library('form_validation');
        $this->load->model('fingerprint/Modfinger');
    }
    function index(){
        $this->load->view('header');        
        $this->load->view('setting/import_att_form');
        $this->load->view('footer');
    }
    // public function do_import()
    // {
    //     $start = $this->input->post('start_date');
    //     $end = $this->input->post('end_date');
        
     
    //     if($this->Modfinger->insert_attendence($start,$end)){
    //         $this->session->set_flashdata('message', 'Attendent has import successful');
           
    //     } else{
    //         $this->session->set_flashdata('error', 'Attendent has import error');

    //     }
    //     redirect("login");
    //     $this->load->view($this->theme . 'fingerprint/index', $this->data);
        
    // }
    // function clcearatt(){
    //     $this->Modfinger->clcearatt();
    // }
    // function testimport(){
    //     $this->Modfinger->insertstdattendence(1);

    // }
    function importstudent(){
        $fingerprint = $this->db->query("SELECT * FROM sch_fingerprint WHERE location = 'student'")->result();
        $fail_id = '';
        foreach ($fingerprint as $row ){
                $ip = $row->ip;//"192.168.22.15";
                exec("ping -n 1 $ip", $output, $status);
        // print_r($output);
                $count = count($output); 
                if($count>6){
                    $this->Modfinger->importstd($ip,$row->finger_id);
                    // echo 2;
                }else{
                    // echo 1;
                    $fail_id.=$row->ip." , ";
                }
        }
        if($fail_id!=''){
            echo 2;
        }else{
            echo $fail_id;
        }
    }
    function importdata($finger_id){
        $row = $this->db->query("SELECT * FROM sch_fingerprint WHERE finger_id = '$finger_id'")->row();
        $fail_id = '';
        $ip =   $row->ip;//"192.168.22.15";
        // echo $ip;
        //print_r($row);
        exec("ping -n 1 $ip", $output, $status);
        $count = count($output); 
        if($count>6){
            // echo 'test';
            if($row->location=='student'){
                $this->Modfinger->importstd($ip);
            }elseif ($row->location=='employee') {
                $this->Modfinger->importemp($ip,$row->finger_id);
                
            }
        }else{
             $fail_id.=$row->ip." , ";
        }
        // echo $fail_id;
        if($fail_id==''){
            echo 2;
        }else{
            echo $fail_id;
        }
       
    }

    // function ip_in_range( $ip='192.168.22.100', $range='192.168.22.1/24' ) {
    //     if ( strpos( $range, '/' ) == false ) {
    //         $range .= '/32';
    //     }
    //     // $range is in IP/CIDR format eg 127.0.0.1/24
    //     list( $range, $netmask ) = explode( '/', $range, 2 );
    //     $range_decimal = ip2long( $range );
    //     $ip_decimal = ip2long( $ip );
    //     $wildcard_decimal = pow( 2, ( 32 - $netmask ) ) - 1;
    //     $netmask_decimal = ~ $wildcard_decimal;
    //     var_dump ( ( $ip_decimal & $netmask_decimal ) == ( $range_decimal & $netmask_decimal ) );
    // }
    
    // public function clear()
    // {
        
    //     if($this->Modfinger->clear_attendence()){
    //         $this->session->set_flashdata('message', 'Attendent has clear successful');
           
    //     } else{
    //         $this->session->set_flashdata('error', 'Attendent has clear error');

    //     }
    //     redirect("login");
    //     // $this->load->view($this->theme . 'fingerprint/index', $this->data);
        
    // }
    // function test(){
    //     $this->db->query("INSERT INTO sma_test (test) VALUES('test')");
    //     die();
    // }

}
