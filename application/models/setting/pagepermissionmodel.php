<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pagepermissionmodel extends CI_Model {

	public function getpagepermission()
	{	
		$per_page='';
		if(isset($_GET['per_page']))
		$per_page=$_GET['per_page'];
		$config['base_url']=site_url("setting/permission/index?");
		$config['per_page']=10;
		$config['full_tag_open'] = '<li>';
		$config['full_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<a><u>';
		$config['cur_tag_close'] = '</u></a>';
		$config['page_query_string']=TRUE;
		$config['num_link']=3;
		$this->db->select('*');
		$this->db->from('sch_z_role r');
		$this->db->join('sch_z_role_page rp','r.roleid=rp.roleid','inner');
		$this->db->join('sch_z_page p','rp.pageid=p.pageid','inner');
		$this->db->where('r.is_active',1);
		$this->db->where('p.is_active',1);
		$config['total_rows']=$this->db->get()->num_rows();
		$this->pagination->initialize($config);
		$this->db->select('r.roleid,r.role,rp.is_print,rp.role_page_id,rp.is_insert,rp.is_delete,rp.is_update,rp.is_export,rp.is_import,rp.is_read,rp.created_date,rp.created_by,p.pageid,p.page_name,rp.moduleid');
		$this->db->from('sch_z_role r');
		$this->db->join('sch_z_role_page rp','r.roleid=rp.roleid','inner');
		$this->db->join('sch_z_page p','rp.pageid=p.pageid','inner');
		$this->db->where('r.is_active',1);
		$this->db->where('p.is_active',1);
		$this->db->limit($config['per_page'],$per_page);
		$query=$this->db->get();
		return $query->result();
	}
	function getpagepermisvalidate($roleid,$pageid){
		$this->db->select('count(*)');
		$this->db->from('sch_z_role_page');
		$this->db->where('roleid',$roleid);
		$this->db->where('pageid',$pageid);
		return $this->db->count_all_results();
	}
	function getpagepermisvalidateu($roleid,$pageid,$rolepageid){
		$this->db->select('count(*)');
		$this->db->from('sch_z_role_page');
		$this->db->where('roleid',$roleid);
		$this->db->where('pageid',$pageid);
		$this->db->where_not_in('role_page_id',$rolepageid);
		return $this->db->count_all_results();
	}
	function getpagepermisrow($id){
		$this->db->where('role_page_id',$id);
		$query=$this->db->get('sch_z_role_page');
		return $query->row();
	}
	function getpagebymodule($moduleid){
		$this->db->where('moduleid',$moduleid);
		$this->db->where('is_active',1);
		$query=$this->db->get('sch_z_page');
		return $query->result();
	}

	function getpagebymodulewithselected($moduleid, $roleid){
		$sql = "SELECT p.pageid, p.page_name, rp.pageid AS selected
				FROM sch_z_page p
				LEFT JOIN sch_z_role_page rp 
				ON (rp.moduleid = p.moduleid AND rp.roleid = '$roleid' AND p.pageid = rp.pageid)
				WHERE p.moduleid = '$moduleid' 
				ORDER BY p.page_name ";
		$query = $this->db->query($sql)->result();
		return $query;
	}

	function getmodulebyrole($roleid){
		$this->db->select('m.moduleid,m.module_name');
		$this->db->from('sch_z_role r');
		$this->db->join('sch_z_role_module_detail rm','r.roleid=rm.roleid','inner');
		$this->db->join('sch_z_module m','rm.moduleid=m.moduleid','inner');
		$this->db->where('rm.roleid',$roleid);
		$this->db->where('m.is_active',1);
		$query=$this->db->get();
		return $query->result();
	}
	function searchpagepermis($role_id,$page_id){
		$per_page='';
		if(isset($_GET['per_page']))
		$per_page=$_GET['per_page'];
		$config['base_url']=site_url("setting/permission/search?role_id=$role_id&pageid=$page_id");
		$config['per_page']=10;
		$config['full_tag_open'] = '<li>';
		$config['full_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<a><u>';
		$config['cur_tag_close'] = '</u></a>';
		$config['page_query_string']=TRUE;
		$config['num_link']=3;
		$this->db->select('*');
		$this->db->from('sch_z_role r');
		$this->db->join('sch_z_role_page rp','r.roleid=rp.roleid','inner');
		$this->db->join('sch_z_page p','rp.pageid=p.pageid','inner');
		if($role_id>0)
			$this->db->where('rp.roleid',$role_id);
		if($page_id>0)
			$this->db->where('rp.pageid',$page_id);
		$this->db->where('r.is_active',1);
		$this->db->where('p.is_active',1);
		$config['total_rows']=$this->db->get()->num_rows();
		$this->pagination->initialize($config);
		$this->db->select('r.roleid,r.role,rp.is_print,rp.role_page_id,rp.is_insert,rp.is_delete,rp.is_update,rp.is_export,rp.is_import,rp.is_read,rp.created_date,rp.created_by,p.pageid,p.page_name');
		$this->db->from('sch_z_role r');
		$this->db->join('sch_z_role_page rp','r.roleid=rp.roleid','inner');
		$this->db->join('sch_z_page p','rp.pageid=p.pageid','inner');
		if($role_id>0)
			$this->db->where('rp.roleid',$role_id);
		if($page_id>0)
			$this->db->where('rp.pageid',$page_id);
		$this->db->where('r.is_active',1);
		$this->db->where('p.is_active',1);
		$this->db->limit($config['per_page'],$per_page);
		$query=$this->db->get();
		return $query->result();
	}
}