<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pagemodel extends CI_Model {

	public function getpage()
	{	
		$per_page=0;
		if(isset($_GET['per_page']))
			$per_page=$_GET['per_page'];
		if($per_page == '')
			$per_page = 0;
		$config['base_url']=site_url("setting/page/index?");
		$config['per_page']=10;
		$config['full_tag_open'] = '<li>';
		$config['full_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<a><u>';
		$config['cur_tag_close'] = '</u></a>';
		$config['page_query_string']=TRUE;
		$config['num_link']=3;
		$this->db->where('is_active',1);
		$config['total_rows']=$this->db->get('sch_z_page')->num_rows();
		$this->pagination->initialize($config);
		// $this->db->select('p.*, m.*');
		// $this->db->from('sch_z_page p');
		// $this->db->join('sch_z_module m','p.moduleid=m.moduleid','inner');
		// $this->db->join('sch_z_page_route pr','pr.page_id = p.pageid','left');
		// $this->db->order_by("p.pageid", "desc"); 
		// $this->db->where('p.is_active',1);
		// $this->db->group_by('p.pageid');
		// $this->db->limit($config['per_page'],$per_page);
		$sql = "SELECT
					p.*,
					m.*,
					GROUP_CONCAT(pr.action_name SEPARATOR '<br>') AS action_name
				FROM
					(`sch_z_page` p)
				INNER JOIN `sch_z_module` m ON `p`.`moduleid` = `m`.`moduleid`
				LEFT JOIN sch_z_page_route pr 
				ON pr.page_id = p.pageid
				WHERE
					`p`.`is_active` = 1
				GROUP BY p.pageid
				ORDER BY
					`p`.`pageid` DESC ";
		$sql .= "LIMIT $per_page, ".$config['per_page'];
		
		$query=$this->db->query($sql);
		return $query->result();
	}
	function getpagevalidate($pagename,$moduleid){
		$this->db->select('count(*)');
		$this->db->from('sch_z_page');
		$this->db->where('page_name',$pagename);
		$this->db->where('moduleid',$moduleid);
		$this->db->where('is_active',1);
		return $this->db->count_all_results();
	}
	function getpagevalidateup($pagename,$moduleid,$pageid){
		$this->db->select('count(*)');
		$this->db->from('sch_z_page');
		$this->db->where('page_name',$pagename);
		$this->db->where('moduleid',$moduleid);
		$this->db->where_not_in('pageid',$pageid);
		$this->db->where('is_active',1);
		return $this->db->count_all_results();
	}
	function getpagerow($id){
		$this->db->where('pageid',$id);
		$this->db->where('is_active',1);
		$query=$this->db->get('sch_z_page');
		return $query->row();
	}
	function getallpage(){
		
		$this->db->where('is_active',1);
		$query=$this->db->get('sch_z_page');
		return $query->result();
	}
	function searchpage($p_name,$moduleid){
		$per_page='';
		if(isset($_GET['per_page']))
		$per_page=$_GET['per_page'];
		$config['base_url']=site_url("setting/page/search?p_name=$p_name&moduleid=$moduleid");
		$config['per_page']=10;
		$config['full_tag_open'] = '<li>';
		$config['full_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<a><u>';
		$config['cur_tag_close'] = '</u></a>';
		$config['page_query_string']=TRUE;
		$config['num_link']=3;
		$this->db->like('page_name',$p_name);
		if($moduleid!=0)
			$this->db->where('moduleid',$moduleid);
		$this->db->where('is_active',1);
		$config['total_rows']=$this->db->get('sch_z_page')->num_rows();
		$this->pagination->initialize($config);
		$this->db->select('*');
		$this->db->from('sch_z_page p');
		$this->db->join('sch_z_module m','p.moduleid=m.moduleid','inner');
		$this->db->order_by("p.pageid", "desc");
		$this->db->like('p.page_name',$p_name);
		if($moduleid!=0)
			$this->db->where('p.moduleid',$moduleid); 
		$this->db->where('p.is_active',1);
		$this->db->limit($config['per_page'],$per_page);
		$query=$this->db->get();
		return $query->result();
	}
}