<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setting extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('setting/usermodel','user');
		$this->load->model('setting/rolemodel','role');
		$this->load->library('pagination');	
		$this->load->helper(array('form', 'url'));	
	}
	public function index()
	{	
		$data['query']=$this->user->getuser();
		$this->load->view('header');		
		$this->load->view('setting/vsetting',$data);
		$this->load->view('footer');
	}
	function profile(){
		$userid=$this->session->userdata('userid');
		$data['userrow']=$this->db->where('userid',$userid)->get('sch_user')->row();
		// $this->data['view'] = array('setting/profile');
		$this->load->view('header');		
		$this->load->view('setting/profile',$data);
		$this->load->view('footer');
	}
	function system_settings(){
		$data['row']=$this->db->get('sch_school_setting')->row();
		$this->load->view('header');		
		$this->load->view('setting/school_setting',$data);
		$this->load->view('footer');
	}
	function save_setting(){
		$display = isset($_POST['display_sound_track'])?1:0;
		$this->db->set('display_track_sound',$display)->update('sch_school_setting');
		redirect('setting/setting/system_settings');
	}
	function changepwd(){
		$userid=$this->session->userdata('userid');
		$data['userrow']=$this->db->where('userid',$userid)->get('sch_user')->row();
		$data['view'] = array('setting/change_password');
		// $this->load->view('index', $this->data);
		$this->load->view('header');		
		$this->load->view('setting/change_password',$data);
		$this->load->view('footer');
	}
	function savechagepwd(){
		$old_password=$this->input->post('old_password');
		$password=$this->input->post('password');
		$userid=$this->session->userdata('userid');

		$pwd=$this->db->query("SELECT password FROM sch_user WHERE userid='$userid'")->row()->password;
		$msg='';
		if(md5($old_password)==$pwd){
			$this->db->where('userid',$userid)->set('password',md5($password))->update('sch_user');
			$msg='Your Password has been change.';

		}else{
			$msg='Your Old Password is incorect.';
			$userid='';
		}

		$arr=array('msg'=>$msg,'userid'=>$userid);
		header("Content-type:text/x-json");
		echo json_encode($arr);
	}
	function saveprofile(){
		$userid=$this->session->userdata('userid');
		$first_name=$this->input->post('first_name');
		$last_name=$this->input->post('last_name');
		$user_name=$this->input->post('user_name');
		$phone=$this->input->post('phone');
		$email=$this->input->post('email');
		$address=$this->input->post('address');
		$validat=$this->validat($user_name,$userid);
		$data=array('first_name'=>$first_name,
					'last_name'=>$last_name,
					'phone'=>$phone,
					'email'=>$email,
					'address'=>$address);
		if($validat>0){
			$msg="This User name is Already Exist";
			$userid="";
		}else{
			$this->db->where('userid',$userid)->update('sch_user',$data);
			$msg='User has been Save....!';
		}
		
		
		$arr=array('msg'=>$msg,'userid'=>$userid);
		header("Content-type:text/x-json");
		echo json_encode($arr);
	}
	function validat($user_name,$userid){
		return $this->db->query("SELECT COUNT(*) as count FROM sch_user WHERE user_name='$user_name' AND userid<>'$userid'")->row()->count;
	}
	function do_upload($id='')
	{
		if($id=='')
			$id=$this->session->userdata('userid');
		if(!file_exists('./assets/upload/adminuser/')){
		    if(mkdir('./assets/upload/adminuser/',0755,true)){
		        return true;
		    }
		}
		$config['upload_path'] ='./assets/upload/adminuser/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['file_name']  = "$id.png";
		$config['overwrite']=true;
		$config['file_type']='image/png';
		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('userfile'))
		{
			$error = array('error' => $this->upload->display_errors());			
			echo $error['error'];
		}
		else
		{				
		
			
		}
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */