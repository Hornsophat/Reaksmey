<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class rolemodel extends CI_Model {

	public function getrole()
	{	
		$per_page='';
		if(isset($_GET['per_page']))
		$per_page=$_GET['per_page'];
		$config['base_url']=site_url("setting/role/index?");
		$config['per_page']=10;
		$config['full_tag_open'] = '<li>';
		$config['full_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<a><u>';
		$config['cur_tag_close'] = '</u></a>';
		$config['page_query_string']=TRUE;
		$config['num_link']=3;
		$this->db->where('is_active',1);
		$config['total_rows']=$this->db->get('sch_z_role')->num_rows();
		$this->pagination->initialize($config);
		$this->db->where('is_active',1);
		$this->db->where('is_admin',NULL);
		// $this->db->limit($config['per_page'],$per_page);
		$query=$this->db->get('sch_z_role');
		return $query->result();
	}
	function getrolevalidte($role){
		$this->db->select('count(*)');
		$this->db->from('sch_z_role');
		$this->db->where('role',$role);
		$this->db->where('is_active',1);
		return $this->db->count_all_results();
	}
	function getrolevalidteup($role,$roleid){
		$this->db->select('count(*)');
		$this->db->from('sch_z_role');
		$this->db->where('role',$role);
		$this->db->where_not_in('roleid',$roleid);
		$this->db->where('is_active',1);
		return $this->db->count_all_results();
	}
	function getrolerow($roleid){
		$this->db->where('roleid',$roleid);
		$this->db->where('is_active',1);
		$query=$this->db->get('sch_z_role');
		return $query->row();
	}
	function getallrole(){
		$this->db->where('is_active',1);
		$query=$this->db->get('sch_z_role');
		return $query->result();
	}
	function searchrole($role){
		$per_page='';
		if(isset($_GET['per_page']))
		$per_page=$_GET['per_page'];
		$config['base_url']=site_url("setting/role/search?role=$role");
		$config['per_page']=10;
		$config['full_tag_open'] = '<li>';
		$config['full_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<a><u>';
		$config['cur_tag_close'] = '</u></a>';
		$config['page_query_string']=TRUE;
		$config['num_link']=3;
		$this->db->where('is_active',1);
		$this->db->like('role',$role);

		$config['total_rows']=$this->db->get('sch_z_role')->num_rows();
		$this->pagination->initialize($config);
		$this->db->like('role',$role);
		$this->db->where('is_admin',NULL);
		$this->db->where('is_active',1);
		// $this->db->limit($config['per_page'],$per_page);
		$query=$this->db->get('sch_z_role');
		return $query->result();
	}
	public function getrolemodule($roleid,$moduleid)
	{	$this->db->select('count(*)');
		$this->db->from('sch_z_role_module_detail');
		$this->db->where('roleid',$roleid);
		$this->db->where('moduleid',$moduleid);
		return $this->db->count_all_results();
		
	}
}