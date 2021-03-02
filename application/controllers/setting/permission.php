<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class permission extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('setting/pagepermissionmodel','pagepermis');
		$this->load->model('setting/pagemodel','page');
		$this->load->model('setting/rolemodel','role');
		$this->load->library('pagination');
		$this->load->helper(array('form', 'url'));
		 $this->load->helper('language');
        $this->lang->load("content", $this->session->userdata('language'));        

        if(!$this->session->userdata('is_logged_in')){
            redirect('admin/login');
        }
	}
	public function index()
	{	
		$data['query']=$this->pagepermis->getpagepermission();
		$roleid = $_GET['roleid'];
		$data['roleid']=$roleid;//$this->pagepermis->getpagepermission();

		$this->load->view('includes/header');
		$this->load->view('setting/pagepermission/add',$data);
		// $this->load->view('setting/pagepermission/view',$data);
		$this->load->view('includes/footer');
	}
	function edit($id){
		$data1['query']=$this->pagepermis->getpagepermisrow($id);
		$this->load->view('includes/header');
		$this->load->view('setting/pagepermission/edit',$data1);
		$data['query']=$this->pagepermis->getpagepermission();
		// $this->load->view('setting/pagepermission/view',$data);
		$this->load->view('includes/footer');
	}
	function search(){
		
		if(isset($_GET['pageid'])){
			$pageid=$_GET['pageid'];
			$roleid=$_GET['role_id'];
			$data['query']=$this->pagepermis->searchpagepermis($roleid,$pageid);
			$this->load->view('includes/header');
			$this->load->view('setting/pagepermission/add');
			$this->load->view('setting/pagepermission/view',$data);
			$this->load->view('includes/footer');
		}
		if(!isset($_GET['pageid'])){
			$role_id=$this->input->post('role_id');
			$page_id=$this->input->post('page_id');
			$query=$this->pagepermis->searchpagepermis($role_id,$page_id);
				$i=1;
				foreach ($query as $row) {
					echo "
										<tr>
											<td align='center'>$i</td>
											<td>$row->role</td>
											<td>$row->page_name</td>
											<td>$row->created_by</td>
											<td>".date("d-m-Y", strtotime($row->created_date))."</td>
											<td align='center'>";if($row->is_insert>0) echo "<img src='".base_url('assets/images/checked.png')."'/></td>"; else echo "<img src='".base_url('assets/images/unchecked.png')."'/></td>";
											echo "<td align='center'>";if($row->is_delete>0) echo "<img src='".base_url('assets/images/checked.png')."'/></td>"; else echo "<img src='".base_url('assets/images/unchecked.png')."'/></td>";
											echo "<td align='center'>";if($row->is_update>0) echo "<img src='".base_url('assets/images/checked.png')."'/></td>"; else echo "<img src='".base_url('assets/images/unchecked.png')."'/></td>";
											echo "<td align='center'>";if($row->is_read>0) echo "<img src='".base_url('assets/images/checked.png')."'/></td>"; else echo "<img src='".base_url('assets/images/unchecked.png')."'/></td>";
											echo "<td align='center'>";if($row->is_print>0) echo "<img src='".base_url('assets/images/checked.png')."'/></td>"; else echo "<img src='".base_url('assets/images/unchecked.png')."'/></td>";
											echo "<td align='center'>";if($row->is_export>0) echo "<img src='".base_url('assets/images/checked.png')."'/></td>"; else echo "<img src='".base_url('assets/images/unchecked.png')."'/></td>";
											echo "<td align='center'>";if($row->is_import>0) echo "<img src='".base_url('assets/images/checked.png')."'/></td>"; else echo "<img src='".base_url('assets/images/unchecked.png')."'/></td>";
											echo "<td align='center'><a><img  rel='$row->role_page_id' onclick='deletepermission(event);' src='".base_url('assets/images/icons/delete.png')."'/></a></td><td align='center'> <a ><img rel='$row->role_page_id' onclick='updatepermission(event);' src='".base_url('assets/images/icons/edit.png')."'/></a></td>
										</tr>

									";# code...
				}
				echo "<tr>
					<td colspan='12' id='pgt'><div style='text-align:center'><ul class='pagination' style='text-align:center'>".$this->pagination->create_links()."</ul></div></td>
				</tr>";
		}

	}
	function save(){
		$is_insert=0;
		$is_delete=0;
		$is_update=0;
		$is_show=0;
		$is_print=0;
		$is_export=0;
		$is_import=0;
		if(isset($_POST['is_insert']))
			$is_insert=1;
		if(isset($_POST['is_delete']))
			$is_delete=1;
		if(isset($_POST['is_update']))
			$is_update=1;
		if(isset($_POST['is_show']))
			$is_show=1;
		if(isset($_POST['is_print']))
			$is_print=1;
		if(isset($_POST['is_export']))
			$is_export=1;
		if(isset($_POST['is_import']))
			$is_import=1;
		// $count=$this->pagepermis->getpagepermisvalidate($this->input->post('cborole_as'),$this->input->post('cbopage_as'));
		$count = 0;
		if($count!=0){
			// $this->load->view('includes/header');
			// $data1['error']=(object) array('error'=>"<div style='text-align:center; color:red;'>This Role exists Please choose other role or Page </div>");
			// $this->load->view('setting/pagepermission/add',$data1);
			// $data['query']=$this->pagepermis->getpagepermission();
			// $this->load->view('setting/pagepermission/view',$data);
			// $this->load->view('includes/footer');
			redirect('setting/role/');
		}else{
			
			$pages = $this->input->post('page_id');
			$role = $this->input->post('cborole_as');
			// $module = $this->input->post('cbomodule_as');
			$this->db->where('roleid',$role)->delete('sch_z_role_page');
			$this->db->where('roleid',$role)->delete('sch_z_page_route_action');
			for($i = 0; $i < count($pages); $i++) {
				$module=$this->db->where('pageid',$pages[$i])->get('sch_z_page')->row();
				$data=array(
					'roleid'=>$role,
					'pageid'=>$pages[$i],
					'moduleid'=>$module->moduleid,
					'is_insert'=>$is_insert,
					'is_delete'=>$is_delete,
					'is_update'=>$is_update,
					'is_print'=>$is_print,
					'is_read'=>$is_show,
					'is_export'=>$is_export,
					'is_import'=>$is_import,
					'created_by'=>1,
					'created_date'=>date('Y-m-d H:i:s'),
					
				);
				$this->db->insert('sch_z_role_page',$data);

				$action = $this->input->post('action_id_'.$pages[$i]);
				for ($j=0; $j < count($action); $j++) { 
					$actionrow = $this->db->where('id',$action[$j])->get('sch_z_page_route')->row();
					$action_data=array('roleid'=>$role,'action'=>trim($actionrow->action_url,'/'));
					if(isset($actionrow->action_url)){
						$this->db->insert('sch_z_page_route_action',$action_data);

					}
				}
			}

			
			redirect('setting/role/');
		}
		
	}
	function update(){
		$is_insert=0;
		$is_delete=0;
		$is_update=0;
		$is_show=0;
		$is_print=0;
		$is_export=0;
		$is_import=0;
		if(isset($_POST['is_insert']))
			$is_insert=1;
		if(isset($_POST['is_delete']))
			$is_delete=1;
		if(isset($_POST['is_update']))
			$is_update=1;
		if(isset($_POST['is_show']))
			$is_show=1;
		if(isset($_POST['is_print']))
			$is_print=1;
		if(isset($_POST['is_export']))
			$is_export=1;
		if(isset($_POST['is_import']))
			$is_import=1;
		$rolepageid=$this->input->post('txtrolepageid');
		$count=$this->pagepermis->getpagepermisvalidateu($this->input->post('cborole_as'),$this->input->post('cbopage_as'),$rolepageid);
		if($count!=0){
			
			$data1['error']=(object) array('error'=>"<div style='text-align:center; color:red;'>This Role exists Please choose other role or Page </div>");
			$data1['query']=$this->pagepermis->getpagepermisrow($rolepageid);
			$this->load->view('includes/header');
			$this->load->view('setting/pagepermission/edit',$data1);
			$data['query']=$this->pagepermis->getpagepermission();
			$this->load->view('setting/pagepermission/view',$data);
			$this->load->view('includes/footer');
		}else{
			
			$data=array(
					'roleid'=>$this->input->post('cborole_as'),
					'pageid'=>$this->input->post('cbopage_as'),
					'moduleid'=>$this->input->post('cbomodule_as'),
					'is_insert'=>$is_insert,
					'is_delete'=>$is_delete,
					'is_update'=>$is_update,
					'is_print'=>$is_print,
					'is_read'=>$is_show,
					'is_export'=>$is_export,
					'is_import'=>$is_import,
					'created_by'=>1,
					'created_date'=>date('Y-m-d H:i:s'),
					
				);
			$this->db->where('role_page_id',$rolepageid);
			$this->db->update('sch_z_role_page',$data);
			redirect('setting/permission/');
		}
		
	}
	function fillmodule(){
		$role=$this->input->post('roleid');
		//echo $role;
		$query=$this->pagepermis->getmodulebyrole($role);
		echo "<option value='0'>Select Module</option>";
		foreach ($query as $row) {
			echo "<option value='$row->moduleid'>$row->module_name</option>";
			# code...
		}
	}
	function fillpage(){
		$module=$this->input->post('moduleid');
		//echo $role;
		$query=$this->pagepermis->getpagebymodule($module);
		echo "<option value='0'>Select Module</option>";
		foreach ($query as $row) {
			echo "<option value='$row->pageid'>$row->page_name</option>";
			# code...
		}
	}

	function fillpagechk(){
		$module=$this->input->post('moduleid');
		$role=$this->input->post('roleid');
		//echo $role;
		$query=$this->pagepermis->getpagebymodulewithselected($module, $role);
	
		$tr = "";
		foreach ($query as $row) {
			$selected = $row->selected != null ? "checked" : "";
			$disabled = $row->selected != null ? "disabled" : "";
			$id = 'page'.$row->pageid;
			$tr .= "<div class='col-md-6'>
					<input type='checkbox'  name='cbopage_as[]' value='$row->pageid' id='$id' $selected $disabled> <label for='$id'>$row->page_name</label>
				</div>";
			//echo "<option value='$row->pageid'>$row->page_name</option>";
			# code...
		}
		echo $tr;
	}
	function getmodeleitem(){
		$roleid = $this->input->post('roleid');
		$moduleid = $this->db->query("SELECT * FROM sch_z_role_module_detail rm inner join sch_z_module m on rm.moduleid=m.moduleid where roleid='$roleid' and m.is_active=1 order by m.order asc")->result();
		$table_content = '';
		foreach ($moduleid as $mrow) {
			// $page = $this->db->where('moduleid',$mrow->moduleid)->where('is_active',1)->get('sch_z_page')->result();
			$page = $this->db->query("SELECT p.*,rp.role_page_id FROM sch_z_page p LEFT JOIN (SELECT * FROM sch_z_role_page where roleid='$roleid') as rp on (p.pageid=rp.pageid) where p.moduleid='$mrow->moduleid' and is_active=1 order by p.order asc")->result();
			$rowspan = count($page) + 1;
			$table_content.="<tr>
								<td rowspan='$rowspan' style='text-align:center;vertical-align:middle'><label>$mrow->module_name</label></td>
								";
			$table_content.="</tr>";
			foreach ($page as $prow) {
				// $action = $this->db->where('page_id',$prow->pageid)->get('sch_z_page_route')->result();
				$action = $this->db->query("SELECT * FROM sch_z_page_route pr LEFT JOIN (SELECT * FROM sch_z_page_route_action where roleid='$roleid') as ra on pr.action_url=ra.action where pr.page_id='$prow->pageid'")->result();
				$table_content.="<tr>";
				$table_content.="<td>
									<label><input type='checkbox' name='page_id[]' value='$prow->pageid' ".(isset($prow->role_page_id)?'checked':'')."/> $prow->page_name </label> </td>
							   <td>";
							   foreach ($action as $arow) {
								   	$table_content.="<label><input type='checkbox'  name='action_id_$prow->pageid[]' value='$arow->id' ".(isset($arow->role_actionid)?'checked':'')."/> $arow->action_name</label> <br>";
							   }
				$table_content.="</td>
				</tr>";
			}
		}
		echo $table_content;
	}
	function delete($id){
		$this->db->where('role_page_id',$id);
		$this->db->delete('sch_z_role_page');
		redirect('setting/permission/');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */