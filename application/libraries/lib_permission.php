<?php
class lib_permission
{
	public $roleid;
	public $arraction;
	public $arrallaction;
  	function __construct()
	{
		// $this->CI =& get_instance();
		$ci=& get_instance();
        $this->roleid = $ci->session->userdata('roleid');
        $this->arraction = $ci->session->userdata('arraction');
        $this->arrallaction = $ci->session->userdata('arrallaction');

        // $url= $_SERVER['HTTP_REFERER'];
        // echo $ci->uri->segment(3);
        // echo $ci->uri->segment(2);
        // echo $ci->uri->segment(1);
        // var_dump($ci->uri->segment());
        // print_r($this->arrallaction);die();
        $action_url = '';
        if($ci->uri->segment(1)!=''){
        	$action_url.=$ci->uri->segment(1);
        }
        if($ci->uri->segment(2)!=''){
        	if(!is_numeric($ci->uri->segment(2))){
        		$action_url.='/'.$ci->uri->segment(2);
        	}
        }
        if($ci->uri->segment(3)!=''){
        	if(!is_numeric($ci->uri->segment(3))){
        		$action_url.='/'.$ci->uri->segment(3);
        	}
        }
       	$action_url=trim($action_url,'/');
       	// echo $action_url; die();
       	// $action = $ci->db->where('action_url',$action_url)->get('sch_z_page_route')->row();
       	if(isset($this->arrallaction[$action_url])){
       		// echo 'test';
       		// $role_row = $ci->db->where('roleid',$roleid)->get('sch_z_role')->row();
       		if($this->roleid!=1 && $this->roleid!=33){
       			// $action = $ci->db->where('action',$action_url)->where('roleid',$roleid)->get('sch_z_page_route_action')->row();
       			if(!isset($this->arraction[$action_url])){
       				$ci->session->set_flashdata(array(
			                'message' => "Sorry, You don't have any permision to perform the action. Please contact administrator for help.", 
			                'alert-type' => 'danger'
			            )
	       			);
	       			redirect($_SERVER['HTTP_REFERER']);
       			}
       		}
       	}
	}

	function checkactionexist($action_url){
        
       	if(isset($this->arrallaction[$action_url])){
       		// echo 'test';
       		// $role_row = $ci->db->where('roleid',$roleid)->get('sch_z_role')->row();
       		if($this->roleid!=1 && $this->roleid!=33){
       			// $action = $ci->db->where('action',$action_url)->where('roleid',$roleid)->get('sch_z_page_route_action')->row();
       			if(!isset($this->arraction[$action_url])){
       				// redirect('/system/dashboard?error=1');
       				return false;
       			}else{
       				return true;
       			}
       		}else{
       			return true;
       		}
       	}else{
       		return true;
       	}
    }
	function checkPermission($is_edit=false){
	// 	$link = $this->CI->router->directory.$this->CI->router->class;
	// 	$pageinfo = $this->CI->modpermission->get_page_by_link($link);
	// 	$pageid = $pageinfo->pageid;
	// 	$pagename = $pageinfo->page_name;

	// 	$user_id = $this->CI->session->userdata('userid');
	// 	// $pageid = $this->CI->uri->segment(1);
	// 	$method = $this->CI->router->method;
	// 	// $id = $this->CI->uri->segment(3);
	// 	if ($this->CI->modpermission->check_admin($user_id)!=1 && $this->CI->modpermission->check_admin($user_id)!=2) {
	// 		$field = 'is_read';
	// 		if (strpos($method,'add')!==false || strpos($method,'save')!==false) {
	// 			$field = 'is_insert';
	// 		}
	// 		if (strpos($method,'edit')!==false || strpos($method,'update')!==false) {
	// 			$field = 'is_update';
	// 		}
	// 		if (strpos($method,'delete')!==false) {
	// 			$field = 'is_delete';
	// 		}
	// 		if (strpos($method,'export')!==false) {
	// 			$field = 'is_export';
	// 		}
	// 		if (strpos($method,'import')!==false) {
	// 			$field = 'is_import';
	// 		}
	// 		// var_dump(strpos($method,'save'));
	// 		// var_dump($link);
	// 		// var_dump($method);
	// 		// var_dump($field);die();
	// 		$condition = $this->CI->modpermission->check_permission($user_id,$pageid,$field);

	// 		// $condition=false;
	// 		// var_dump($condition);die();
	// 		if ($condition==false) {
	// 			redirect('no_access/?p='.$pageid);
	// 		}
	// 	}
	// 	// var_dump($link);
	// 	// var_dump($user_id);
	// 	// var_dump($pageid);
	// 	// var_dump($method);die();
		
	// }
	// function user_f($f){
	// 	$user_id = $this->CI->session->userdata('person_id');
	// 	$module_id = $this->CI->uri->segment(1);

	// 	$condition = $this->CI->modpermission->check_permission($user_id,$module_id,$f);
	// 	if ($condition) {
	// 		return 1;
	// 	}else{
	// 		return 0;
	// 	}
	}
}
?>