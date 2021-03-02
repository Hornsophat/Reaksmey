<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class page extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('setting/pagemodel','page');
		$this->load->model('setting/modulemodel','module');
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
		// //$this->lib_permission->checkPermission();

		$data['query']=$this->page->getpage();
		$this->load->view('includes/header');
		$this->load->view('setting/page/add');
		$this->load->view('setting/page/view',$data);
		$this->load->view('includes/footer');
	}
	function edit($id){
		//$this->lib_permission->checkPermission();

		$data1['query']=$this->page->getpagerow($id);
		$data1['action_detail']=$this->db->where('page_id',$id)->get('sch_z_page_route')->result();
		$this->load->view('includes/header');
		$this->load->view('setting/page/new_edit',$data1);
		$data['query']=$this->page->getpage();
		$this->load->view('setting/page/view',$data);
		$this->load->view('includes/footer');
	}
	function search(){
		
		if(isset($_GET['p_name'])){
			$p_name=$_GET['p_name'];
			$moduleid=$_GET['moduleid'];
			$data['query']=$this->page->searchpage($p_name,$moduleid);
			$this->load->view('includes/header');
			$this->load->view('setting/page/add');
			$this->load->view('setting/page/view',$data);
			$this->load->view('includes/footer');
		}
		if(!isset($_GET['p_name'])){
			$p_name=$this->input->post('page_name');
			$moduleid=$this->input->post('m_id');
			$query=$this->page->searchpage($p_name,$moduleid);
				$i=1;
				foreach ($query as $row) {
					echo "
									<tr>
										<td align='center'>$i</td>
										<td>$row->page_name</td>
										<td>$row->link</td>
										<td>$row->module_name</td>
										<td align='center'>";if($row->is_insert>0) echo "<img src='".base_url('assets/images/checked.png')."'/></td>"; else echo "<img src='".base_url('assets/images/unchecked.png')."'/></td>";
										echo "<td align='center'>";if($row->is_delete>0) echo "<img src='".base_url('assets/images/checked.png')."'/></td>"; else echo "<img src='".base_url('assets/images/unchecked.png')."'/></td>";
										echo "<td align='center'>";if($row->is_update>0) echo "<img src='".base_url('assets/images/checked.png')."'/></td>"; else echo "<img src='".base_url('assets/images/unchecked.png')."'/></td>";
										echo "<td align='center'>";if($row->is_show>0) echo "<img src='".base_url('assets/images/checked.png')."'/></td>"; else echo "<img src='".base_url('assets/images/unchecked.png')."'/></td>";
										echo "<td align='center'>";if($row->is_print>0) echo "<img src='".base_url('assets/images/checked.png')."'/></td>"; else echo "<img src='".base_url('assets/images/unchecked.png')."'/></td>";
										echo "<td align='center'>";if($row->is_export>0) echo "<img src='".base_url('assets/images/checked.png')."'/></td>"; else echo "<img src='".base_url('assets/images/unchecked.png')."'/></td>";
										echo "<td>$row->created_by</td>
										<td>".date("d-m-Y", strtotime($row->created_date))."</td>
										<td align='center'><a ><img rel='$row->pageid' onclick='deletepage(event);' src='".base_url('assets/images/icons/delete.png')."'/></a></td><td> <a ><img rel='$row->pageid' onclick='updatepage(event);' src='".base_url('assets/images/icons/edit.png')."'/></a></td>
									</tr>

								";# code...
								$i++;
				}
				echo "<tr>
					<td colspan='12' id='pgt'><div style='text-align:center'><ul class='pagination' style='text-align:center'>".$this->pagination->create_links()."</ul></div></td>
				</tr>";
		}

	}
	function savepage(){
	
		//$this->lib_permission->checkPermission();
		$is_insert=0;
		$is_delete=0;
		$is_update=0;
		$is_show=0;
		$is_print=0;
		$is_export=0;
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

		$count=$this->page->getpagevalidate($this->input->post('txtp_name'),$this->input->post('cbomodule'));
		if($count!=0){
			$this->load->view('includes/header');
			$data1['error']=(object) array('error'=>"<div style='text-align:center; color:red;'>This Page Name  and Module is already exists Please choose other Name or module </div>");
			$this->load->view('setting/page/add',$data1);
			$data['query']=$this->page->getpage();
			$this->load->view('setting/page/view',$data);
			$this->load->view('includes/footer');
		}else{
			
			// $max_order=$this->green->getValue("SELECT MAX(`order`)+1 orders FROM sch_z_page WHERE moduleid='".$this->input->post('cbomodule')."'");
			$data=array(
					'page_name'=>$this->input->post('txtp_name'),
					'link'=>$this->input->post('txtp_link'),
					'moduleid'=>$this->input->post('cbomodule'),
					'is_insert'=>$is_insert,
					'is_delete'=>$is_delete,
					'is_update'=>$is_update,
					'is_print'=>$is_print,
					'is_show'=>$is_show,
					'is_export'=>$is_export,
					'created_by'=>1,
					'created_date'=>date('Y-m-d H:i:s'),
					'is_active'=>1,
					'order'=>$max_order
				);

			$this->db->insert('sch_z_page',$data);
			$insert_id = $this->db->insert_id();
			$this->save_page_route($insert_id);
			redirect('setting/page/');
		}
		
	}


	function save_page_route($page_id) {
		$page_action = $this->input->post('page_action');
		$page_url = $this->input->post('page_url');
		$is_mudule = $this->input->post('is_mudule');
		$page_count = count($page_action);
		if($page_count > 0) {
			$this->db->where('page_id',$page_id)->delete('sch_z_page_route');
			for($i = 0; $i < $page_count; $i++) {
				$data = [
					'page_id' => $page_id,
					'action_name' => $page_action[$i],
					'action_url' => trim($page_url[$i],'/'),
					'is_mudule' => $is_mudule[$i]
				];

				$this->db->insert('sch_z_page_route', $data);
			}
		}

	}

	function update(){
		$is_insert=0;
		$is_delete=0;
		$is_update=0;
		$is_show=0;
		$is_print=0;
		$is_export=0;
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
		$pageid=$this->input->post('txtpageid');
		$count=$this->page->getpagevalidateup($this->input->post('txtp_name'),$this->input->post('cbomodule'),$pageid);
		if($count!=0){
			$this->load->view('includes/header');
			$data1['query']=$this->page->getpagerow($pageid);
			$data1['error']=(object) array('error'=>"<div style='text-align:center; color:red;'>This Page Name  and Module is already exists Please choose other Name or module </div>");
			$this->load->view('setting/page/edit',$data1);
			$data['query']=$this->page->getpage();
			$this->load->view('setting/page/view',$data);
			$this->load->view('includes/footer');
		}else{
			
			$data=array(
					'page_name'=>$this->input->post('txtp_name'),
					'link'=>$this->input->post('txtp_link'),
					'moduleid'=>$this->input->post('cbomodule'),
					'is_insert'=>$is_insert,
					'is_delete'=>$is_delete,
					'is_update'=>$is_update,
					'is_print'=>$is_print,
					'is_show'=>$is_show,
					'is_export'=>$is_export,
					'created_by'=>1,
					'created_date'=>date('Y-m-d H:i:s'),
					'is_active'=>1
				);
			$this->db->where('pageid',$pageid);
			$this->db->update('sch_z_page',$data);
			$this->save_page_route($pageid);

			redirect('setting/page/');
		}
		
	}
	function delete($id){
		//$this->lib_permission->checkPermission();

		$data=array('is_active'=>0);
		$this->db->where('pageid',$id);
		$this->db->update('sch_z_page',$data);
		redirect('setting/page/');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */