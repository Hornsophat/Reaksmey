<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class user extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('setting/usermodel','user');
		$this->load->model('setting/rolemodel','role');
		$this->load->library('pagination');	
		$this->load->helper(array('form', 'url'));	
	}
	public function index()
	{	
		$this->lib_permission->checkPermission();

		$data['query']=$this->user->getuser();
		$this->load->view('header');
		$this->load->view('setting/user/add');
		$this->load->view('setting/user/view',$data);
		$this->load->view('footer');
	}
	function do_upload($id)
	{
		$config['upload_path'] ='./assets/upload/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['file_name']  = "$id.png";
		$config['overwrite']=true;
		$config['file_type']='image/png';
		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('userfile'))
		{
			$error = array('error' => $this->upload->display_errors());			
		}
		else
		{				
			//$data = array('upload_data' => $this->upload->data());			
			$config2['image_library'] = 'gd2';
                    $config2['source_image'] = $this->upload->upload_path.$this->upload->file_name;
                    $config2['new_image'] = './assets/upload/';
                    $config2['maintain_ratio'] = TRUE;
                    $config2['create_thumb'] = TRUE;
                    $config2['thumb_marker'] = '_thumb';
                    $config2['width'] = 120;
                    $config2['height'] = 180;
                    $config2['overwrite']=true;
                    $this->load->library('image_lib',$config2); 

                    if ( !$this->image_lib->resize()){
	                	$this->session->set_flashdata('errors', $this->image_lib->display_errors('', ''));
					}else{
						unlink('./assets/upload/'.$id.'.png');
						redirect('setting/user');
					}
			
			
		}
	}
	function edit($id){
		$this->lib_permission->checkPermission();
		$data1['query']=$this->user->getuserrow($id);
		$this->load->view('header');
		$this->load->view('setting/user/edit',$data1);
		$data['query']=$this->user->getuser();
		$this->load->view('setting/user/view',$data);
		$this->load->view('footer');
	}
	function search(){
		
		if(isset($_GET['f_name'])){
			$f_name=$_GET['f_name'];
			$l_name=$_GET['l_name'];
			$u_name=$_GET['u_name'];
			$email=$_GET['email'];
			$roleid=$_GET['roleid'];
			$schoolid=$_GET['schoolid'];
			$year=$_GET['year'];
			$data['query']=$this->user->searchuser($f_name,$l_name,$u_name,$email,$roleid,$schoolid,$year);
			$this->load->view('header');
			$this->load->view('setting/user/add');
			$this->load->view('setting/user/view',$data);
			$this->load->view('footer');
		}
		if(!isset($_GET['f_name'])){
			$f_name=$this->input->post('f_name');
			$l_name=$this->input->post('l_name');
			$u_name=$this->input->post('u_name');
			$email=$this->input->post('email');
			$roleid=$this->input->post('roleid');
			$schoolid=$this->input->post('schoolid');
			$year=$this->input->post('year');
		
			$query=$this->user->searchuser($f_name,$l_name,$u_name,$email,$roleid,$schoolid,$year);
				
				 $i=1;
				foreach ($query as $row) {
					echo "
									<tr>
										<td align='center'>$i</td>
										<td>$row->first_name</td>
										<td>$row->last_name</td>
										<td>$row->user_name</td>
										<td>$row->email</td>
										<td>$row->role</td>
										<td>$row->schoolid</td>
										<td>$row->year</td>
										<td>".date("d-m-Y", strtotime($row->last_visit))."</td>
										<td>".date("d-m-Y", strtotime($row->created_date))."</td>
										<td align='center'><a><img rel='$row->userid' onclick='deleteuser(event);' src='".site_url('../assets/images/icons/delete.png')."'/></a> <a><img  rel='$row->userid' onclick='updateuser(event);' src='".site_url('../assets/images/icons/edit.png')."'/></a></td>
									</tr>

								";# code...
								$i++;
				}
				echo "<tr>
					<td colspan='12' id='pgt'><div style='text-align:center'><ul class='pagination' style='text-align:center'>".$this->pagination->create_links()."</ul></div></td>
				</tr>";
		}
	}
	function saveuser(){
	$this->lib_permission->checkPermission();
		//$schoolid=1;
		$schoolid=$this->input->post('schoolid');
		$creat_date=date('Y-m-d H:i:s');
		$year=date('Y');
		$f_name=$this->input->post('txtf_name');
		$l_name=$this->input->post('txtl_name');
		$username=$this->input->post('txtu_name');
		$pwd=md5($this->input->post('txtpwd'));
		$email=$this->input->post('txtemail');
		$role=$this->input->post('cborole');
		$dash=$this->input->post('dashboard');
		$schlevel=$this->input->post('schlevelid');
		$count=$this->user->getuservalidate($username,$email);
		$yearid=$this->input->post('yearid');
		$def_schoolid=$this->input->post('def_schoolid');
		if($count!=0){
			$data1['save']=(object) array(
					'first_name'=>$f_name,
					'last_name'=>$l_name,
					'user_name'=>$username,
					'email'=>$email,
					'roleid'=>$role,
					'error'=>'this username and your email has been created before Please choose other username '
				);
			$this->load->view('header');
			$this->load->view('setting/user/saveerror',$data1);
			$data['query']=$this->user->getuser();
			$this->load->view('setting/user/view',$data);
			$this->load->view('footer');
		}else{
			if($role==1)
				$admin=1;
			else
				$admin=0;
			$data=array(
					'first_name'=>$f_name,
					'last_name'=>$l_name,
					'user_name'=>$username,
					'password'=>$pwd,
					'email'=>$email,
					
					'roleid'=>$role,
					//'schoolid'=>$schoolid,
					'def_dashboard'=>$dash,
					'created_date'=>$creat_date,
					'year'=>$year,
					'is_admin'=>$admin,
					'is_active'=>1,
					'def_schoolid' => $def_schoolid
				);
			$this->db->insert('sch_user',$data);
			$id=$this->db->insert_id();			
			$this->do_upload($id);
			$this->db->where('userid',$id)->delete('sch_user_school');
			$this->db->where('userid',$id,'yearid',$yearid)->delete('sch_user_schlevel');

			foreach ($schlevel as $schlevelid) {
				$this->saveteacherschl($schlevelid,$id, $yearid);
			}

			foreach ($schoolid as $sid) {
				$this->saveUserSchool($sid, $id);
			}
			redirect('setting/user/');
		}
		
	}
	function saveUserSchool($schoolid, $userid){
		$this->db->where('userid',$userid)->where('schoolid',$schoolid)->delete('sch_user_school');

		$data=array('userid'=>$userid,'schoolid'=>$schoolid);
		$this->db->insert('sch_user_school',$data);
	}
	function saveteacherschl($schlevelid,$userid, $yearid){
		$this->db->where('userid',$userid)->where('schlevelid',$schlevelid)->where('yearid',$yearid)->delete('sch_user_schlevel');

		$data=array('userid'=>$userid,'schlevelid'=>$schlevelid, 'yearid'=>$yearid);
		$this->db->insert('sch_user_schlevel',$data);
	}
	function update(){
		$schoolid=$this->input->post('schoolid');
		$userid=$this->input->post('txtuserid');
		$f_name=$this->input->post('txtf_name');
		$l_name=$this->input->post('txtl_name');
		$username=$this->input->post('txtu_name');
		$pwd=md5($this->input->post('txtpwd'));
		$dash=$this->input->post('dashboard');
		$email=$this->input->post('txtemail');
		$role=$this->input->post('cborole');
		$schlevel=$this->input->post('schlevelid');
		$yearid=$this->input->post('yearid');
		$def_schoolid=$this->input->post('def_schoolid');
		$count=$this->user->getuservalidateup($username,$email,$userid);
		if($count!=0){
			$data1['query']=$this->user->getuserrow($userid);
			$data1['error']=(object) array('error'=>"<div style='text-align:center; color:red;'>This username and your email has been created before Please choose other username </div>");
			$this->load->view('header');
			$data['query']=$this->user->getuser();
			$this->load->view('setting/user/edit',$data1);
			$data['query']=$this->user->getuser();
			$this->load->view('setting/user/view');
			$this->load->view('footer');
		}else{
			if($role==1)
			$admin=1;
			else
				$admin=0;
			$u_row=$this->user->getuserrow($userid);
			if($u_row->password!=$this->input->post('txtpwd')){
				$data=array(
					'first_name'=>$f_name,
					'last_name'=>$l_name,
					'user_name'=>$username,
					'email'=>$email,
					'password'=>$pwd,
					'roleid'=>$role,
					'def_dashboard'=>$dash,
					//'schoolid'=>$schoolid,
					'is_admin'=>$admin,
					'is_active'=>1,
					'def_schoolid' => $def_schoolid
				);
			}else{
					$data=array(
					'first_name'=>$f_name,
					'last_name'=>$l_name,
					'user_name'=>$username,
					'email'=>$email,
					'roleid'=>$role,
					'def_dashboard'=>$dash,
					//'schoolid'=>$schoolid,
					'is_admin'=>$admin,
					'is_active'=>1,
					'def_schoolid' => $def_schoolid
				);
			}
			
			$this->db->where('userid',$userid);
			$this->db->update('sch_user',$data);
			$this->do_upload($userid);
			$this->clearusersch($userid, $yearid);
			$this->clearUserSchool($userid);
			foreach ($schlevel as $schlevelid) {
				$this->saveteacherschl($schlevelid,$userid, $yearid);
			}
			foreach ($schoolid as $sid) {
				$this->saveUserSchool($sid, $userid);
			}
			redirect('setting/user/');
			}
		
	}
	function clearUserSchool($userid){
		$this->db->where('userid',$userid)->delete('sch_user_school');
	}
	function clearusersch($userid){
		$this->db->where('userid',$userid)->where('yearid',$yearid)->delete('sch_user_schlevel');
	}
	function delete($id){
		$this->lib_permission->checkPermission();
		$data=array('is_active'=>0);
		$this->db->where('userid',$id);
		$this->db->update('sch_user',$data);
		unlink('./assets/upload/'.$id.'.png');
		redirect('setting/user/');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */