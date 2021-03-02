<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');	
class Green{

	public $roleid;
	public $roleinfor;
	public $moduleids;
	public $moduleinfos;
	public $pageids;
	public $pageinfos;		

	public $active_role;
	public $active_module;
	public $active_page;
	public $active_user;
	public $is_superadmin;
	public $arraction;
	public $arrallaction;
	public function __construct() {
        // parent::__construct();
        // $domainName = $this->siteURL();
        $serial = str_replace("(","",str_replace(")","",$this->GetVolumeLabel("C")));

        // echo $serial; die();
        // if(trim($serial)!='E2E3-896F'){
        //     echo $serial;
        //     echo "Please Contact to system Administrator : 010871181 "; die();
        // }

        $ci=& get_instance();
        $roleid = $ci->session->userdata('roleid');
        $arraction = $ci->session->userdata('arraction');
        $arrallaction = $ci->session->userdata('arrallaction');
        if($roleid != null) {
        	$this->setSuperAdmin($roleid);
        }
    }

    
    function getactionarr(){
        $ci=& get_instance();
    	
        $roleid = $ci->session->userdata('roleid');
    	$action = $ci->db->where('roleid',$roleid)->get('sch_z_page_route_action')->result();
    	$arr_action=array();
    	foreach ($action as $row) {
    		$arr_action[$row->action]=$row->action;
    	}
    	return $arr_action;
    }
    function getallactionarr(){
        $ci=& get_instance();

        $roleid = $ci->session->userdata('roleid');
    	$action = $ci->db->get('sch_z_page_route')->result();
    	$arr_action=array();
    	foreach ($action as $row) {
    		$arr_action[$row->action_url]=$row->action_url;
    	}
    	return $arr_action;
    }
    function GetVolumeLabel($drive) {
        // Try to grab the volume name
        if (preg_match('#Volume Serial Number is (.*)\n#i', shell_exec('dir '.$drive.':'), $m)) {
            $volname = ' ('.$m[1].')';
        } else {
            $volname = '';
        }
        return $volname;
    }
	public function runSQL($sql){
		$ci=& get_instance();               
		$query = $ci->db->query($sql);
		return $query ;
	}

	public function getTable($sql){
		$arrDatas=array();		         
		$query = $this->runSQL($sql);
		foreach ($query->result_array() as $row)		
		{
			$arrDatas[]=$row;			   
		}		
		return $arrDatas;
	}
	public function getOneRow($sql){
		$row = $this->runSQL($sql)->row_array();		
		return $row;
	}
	public function getValue($sql){		
		$row = $this->runSQL($sql)->row_array();
		$num_arr = array_values($row);			
		return isset($num_arr[0])?$num_arr[0]:"";				
	}		
	public function getTotalRow($sql){		
		$row = $this->runSQL($sql)->num_rows();
		return $row;
	}
	public function getFieldName($sql){		
		$query = $this->runSQL($sql)->list_fields();
		return $query;
	}	
	public function create_temp($sql){
		return $this->runSQL($sql);
	}
	public function drop_temp($tem_name){
		$ci=& get_instance();               
		$query = $this->runSQL("DROP TEMPORARY TABLE IF EXISTS $tem_name");		
	}

	public function gictEnc($str){
		$ci=& get_instance(); 
		$key=$ci->config->item('encryption_key');		
		return $ci->encrypt->encode($str,$key);
	}
	public function gictDec($str){
		$ci=& get_instance(); 
		$key=$ci->config->item('encryption_key');
		return $ci->encrypt->decode($str,$key);
	}
	public function goToPage($page){
		redirect($page, 'refresh');
	}
	public function clearSession(){
		$ci=& get_instance();
		foreach (array_keys($ci->session->userdata) as $key)
		{
			$ci->session->unset_userdata($key);
		}
	}

	public function exportToXls($data,$fileName="Sheet"){			
			header('ETag: etagforie7download'); //IE7 requires this header
			header('Content-type: application/octet_stream');
			header('Content-disposition: attachment;filename="'.$fileName.' '.date('Y-m-d').'.xls');
			echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';	
			echo $data;
			die();	
		}
		
		
		public function myUpload($file,$new_name,$is_thumb=0){
			$ci=& get_instance();
			//================================ upload image ============================
			$path =$ci->config->item('image_upload_path')."/Promotions";	
			$sqlcheck = "SELECT * FROM folder where foldername='Promotions' and folderpath='".$path."'";
			$folder_check=$ci->db->query($sqlcheck);
			if($folder_check->num_rows()<=0){
				$sqlinsert = "INSERT INTO folder SET  foldername='Promotions',folderpath='".$path."'";
				$ci->db->query($sqlinsert);	
				mkdir($path,0777); 						
			}
			//============= Checking File To Upload ==============================
			if (isset($_FILES[$file]) AND $_FILES[$file]['name'] != '') {
				$AllowType=array("image/gif","image/jpeg","image/pjpeg","image/png","image/bmp");
				$result = $_FILES[$file]['error'];
				$UploadTheFile = 'Yes'; 
				$filename = $path . '/' .$new_name ;
				if($_FILES[$file]['size'] > $ci->config->item('max_size_upload') * 1024) {       
					$UploadTheFile = 'No';
					echo 'size';
				}elseif(!(in_array($_FILES[$file]['type'],$AllowType))){
					$UploadTheFile = 'No';
					echo 'Type';
				}
				elseif (file_exists($filename)) {       
					$result = unlink($filename);
					if (!$result) {           
						$UploadTheFile = 'No';
					}
				}
				if ($UploadTheFile == 'Yes') {
					$result = move_uploaded_file($_FILES[$file]['tmp_name'], $filename);     
				}
			}
			if($is_thumb==1){
				createThumbImg($new_name);
			}

		}
		public function createThumbImg($source_image,$height=70,$width=60){
			$ci=& get_instance();
			#============= Create Thumb Image ============
			$path =$ci->config->item('image_upload_path')."/Promotions";
			$config['image_library'] = 'gd2';
			$config['source_image']	= $path.'/'.$source_image;
			$config['create_thumb'] = TRUE;
			$config['maintain_ratio'] = TRUE;
			$config['width']	 = $width;
			$config['height']	= $height;
			
			#$config['new_image'] = $path.'/'.$filename;
			
			$ci->load->library('image_lib', $config);
			$ci->image_lib->initialize($config); 
			$ci->image_lib->resize();
			
			if ( ! $ci->image_lib->resize())
			{
				echo $ci->image_lib->display_errors();
			}
		}
		public function getCombo($source="",$key="",$display="",$sql=""){
			#==== $source=tablename,$key=idfield,display=field for show 
			$result=array();
			if($sql==""){
				$data=$this->getTable("SELECT `{$key}`,`{$display}` FROM `{$source}` ORDER BY `{$display}`");
			}else{
				$data=$this->getTable($sql);
			}
			if(count($data)>0){
				foreach($data as $d){
					$result[$d[0]]=$d[1];
				}
			}
			return $result;
		}		
		

		public function getModule($roleid){
			
			// $ci=& get_instance();
			// $is_superadmin = $ci->db->where('roleid', $roleid)->get('sch_z_role')->row()->is_admin;

			$this->roleinfor=$this->getOneRow("SELECT
				sch_z_role.roleid,
				sch_z_role.role,
				sch_z_role.is_admin
				FROM
				sch_z_role
				WHERE
				is_active = 1
				AND roleid = '".$roleid."'
				");
			
			$where=" WHERE roleid = '".$roleid."'";
			if($roleid==1 || $this->is_superadmin == 2){
				$where="";
			}
			$arrModules=$this->getTable("SELECT
				DISTINCT
				rolmod.moduleid
				FROM
				sch_z_role_module_detail as rolmod
				INNER JOIN sch_z_module m on rolmod.moduleid=m.moduleid
				{$where}
				ORDER BY m.`order`
				");
			$this->moduleids=$arrModules;
			$this->roleid=$this->roleinfor['roleid'];						

		}
		public function getModuleInfo($moduleid){			
			
			$where=" AND moduleid = '".$moduleid."'";			

			$arrModule=$this->getOneRow("SELECT
				sch_z_module.moduleid,
				sch_z_module.module_name,
        		sch_z_module.module_name_kh,
				sch_z_module.sort_mod,
				sch_z_module.icon,
				sch_z_module.icon_color,
				sch_z_module.mod_position
				FROM
				sch_z_module											
				WHERE
				is_active = 1

				{$where}
				ORDER BY `order`;
				");
			return $arrModule;
		}

		public function getRolePage($moduleid){
			
			// $ci=& get_instance();
			// $is_superadmin = $ci->db->where('roleid', $this->roleid)->get('sch_z_role')->row()->is_admin;

			$where="";				
			if($this->roleid==1 || $this->is_superadmin == 2){
				$where.=" AND moduleid = '".$moduleid."'";					
				
				$arrPages=$this->getTable("SELECT
					page.pageid,
					page.page_name,
          			page.page_name_kh,
					page.link,
					page.moduleid,
					page.`order`,
					page.is_insert,
					page.is_update,
					page.is_delete,
					page.is_show as is_read,
					page.is_print,
					page.is_export,
					page.created_by,
					page.created_date
					FROM
					sch_z_page AS page
					WHERE
					is_active = 1											
					{$where}										
					ORDER BY moduleid,`order`																				
					");				
			}else{
				$where.=" AND roleid = '".$this->roleid."'";							
				$where.=" AND moduleid = '".$moduleid."'";	

				$arrPages=$this->getTable("SELECT
					rolepage.pageid,
					rolepage.moduleid,
					rolepage.roleid,
					rolepage.is_read,
					rolepage.is_insert,
					rolepage.is_delete,
					rolepage.is_update,
					rolepage.is_print,
					rolepage.is_export,
					rolepage.is_import
					FROM
					sch_z_role_page as rolepage							
					WHERE
					1 = 1
					{$where}										
					");	
			}			

			$this->pageids=$arrPages;
			
		}
		public function getPageInfo($pageid){
			$where=" AND pageid = '".$pageid."'";					
			$arrPages=$this->getOneRow("SELECT
				page.pageid,
				page.page_name,
        page.page_name_kh,
				page.link,
				page.moduleid,
				page.`order`,
				page.is_insert,
				page.is_update,
				page.is_delete,
				page.is_show,
				page.is_print,
				page.is_export,
				page.created_by,
				page.created_date,
				page.icon
				FROM
				sch_z_page AS page
				WHERE
				is_active = 1											
				{$where}
				ORDER BY moduleid,`order`										
				");
			$this->pageinfos=$arrPages;
		}

		function setSuperAdmin($roleid) {
			$ci=& get_instance();
			$this->is_superadmin = $ci->db->where('roleid', $roleid)->get('sch_z_role')->row()->is_admin;
		}

		function getSuperAdmin() {
			
			return $this->is_superadmin;
		}

		function setActiveRole($role){
			$this->active_role=$role;
		}
		function getActiveRole(){
			return $this->active_role;
		}
		function setActiveModule($module){
			$this->active_module=$module;
		}
		function getActiveModule(){
			return $this->active_module;
		}
		function setActivePage($page){
			$this->active_page=$page;
		}
		function getActivePage(){
			return $this->active_page;
		}
		function setActiveUser($user){
			$this->active_user=$user;
		}
		function getActiveUser(){
			return $this->active_user;
		}

		public function gAction($action){			
			$arrAct=array('C'=>'is_insert',
				'D'=>'is_delete',
				'U'=>'is_update',
				'R'=>'is_read',
				'E'=>'is_export',	
				'P'=>'is_print',
				'I'=>'is_import'
				);

			$sqlAction="SELECT ".$arrAct[$action]."					
			FROM sch_z_role_page 
			WHERE roleid='".$this->getActiveRole()."' 
			AND moduleid='".$this->getActiveModule()."' 
			AND pageid='".$this->getActivePage()."'";

			$res=$this->getValue($sqlAction)-0;		
			
			if($res==1 || $this->getActiveRole()==1 || $this->getSuperAdmin()==2){
				return true;
			}else{
				return false;
			}

			
		}

		public function displayDate($date){
			$date=date_create($date);
			return date_format($date,"d-m-Y");
		}

		public function GetSchool()
		{
			
			$sql="SELECT
			sch_school_infor.schoolid,
			sch_school_infor.`name`
			FROM
			sch_school_infor
			WHERE
			is_active = 1
			";
			$data=$this->getTable($sql);	
			$op='';
			if(count($data)>0){				
				foreach ($data as $row) {
					$op.='<option value="'.$row['schoolid'].'">'.$row['name'].'</option>';
				}
			}	

			return $op;
		}

		public function GetSchYear($schid="",$yearid="")
		{
			echo  $yearid;	
			if($schid!=""){
				$WHERE=" AND schoolid='".$schid."'";
			}
			$sql="SELECT
			sch_school_year.yearid,
			sch_school_year.sch_year,
			sch_school_year.from_date,
			sch_school_year.to_date,
			sch_school_year.schoolid
			FROM
			sch_school_year
			ORDER BY to_date DESC
			";
			$data=$this->getTable($sql);	
			$op='';

			if(count($data)>0){				

				foreach ($data as $row) {
					$op.='<option value="'.$row['yearid'].'" '.($yearid==$row['yearid']?"selected":"").'>'.$row['sch_year'].'</option>';
				}
			}	

			return $op;
		}

		public function GetSchLevel($schid="",$selected="",$blank=1,$yearid='')
		{
			if($schid!=""){
				$WHERE=" AND schoolid='".$schid."'";
			}
			if($yearid!='') {
				$WHERE .= " AND yearid='".$yearid."'";
			}
			$sql="SELECT
			sch_school_level.schlevelid,
			sch_school_level.sch_level,
			sch_school_level.note,
			sch_school_level.schoolid,
			sch_school_level.orders
			FROM
			sch_school_level WHERE 1=1 {$WHERE}
			ORDER BY
			schoolid,
			orders
			";
			$data=$this->getTable($sql);	

			$op='';			
			if(count($data)>0){			
				$i=0;	
				foreach ($data as $row) {
					if($this->getActiveRole()<>1){
						$getSchlevelByUser=$this->getValue("SELECT count(schlevelid) 
							FROM sch_user_schlevel 
							WHERE userid='".$this->getActiveUser()."'
							AND schlevelid='".$row['schlevelid']."'
							");
						if($getSchlevelByUser<>0){
							$op.='<option value="'.$row['schlevelid'].'" '.($selected==$row['schlevelid']?"selected":"").'>'.$row['sch_level'].'</option>';
						}
					}else{
						if($i==0 && $blank==1) {
							$op.='<option value="">All</option>';
						}
						$op.='<option value="'.$row['schlevelid'].'" '.($selected==$row['schlevelid']?"selected":"").'>'.$row['sch_level'].'</option>';

					}	

					$i++;
				}
			}	

			return $op;
		}		
		public function GetgradeLevel($selected="",$blank=1)
		{
			
			$sql="SELECT * FROM sch_grade_level gl INNER JOIN sch_school_level sl on gl.schlevelid=sl.schlevelid";
			$data=$this->getTable($sql);	

			$op='';			
			if(count($data)>0){			
				$i=0;	
				foreach ($data as $row) {
					if($this->getActiveRole()<>1){
						$getSchlevelByUser=$this->getValue("SELECT count(schlevelid) 
							FROM sch_user_schlevel 
							WHERE userid='".$this->getActiveUser()."'
							AND schlevelid='".$row['schlevelid']."'
							");
						if($getSchlevelByUser<>0){
							$op.='<option value="'.$row['grade_levelid'].'" '.($selected==$row['grade_levelid']?"selected":"").'>'.$row['sch_level'].' - '.$row['grade_level'].'</option>';
						}
					}else{
						if($i==0 && $blank==1) {
							$op.='<option value="">All</option>';
						}
						$op.='<option value="'.$row['grade_levelid'].'" '.($selected==$row['grade_levelid']?"selected":"").'>'.$row['sch_level'].' - '.$row['grade_level'].'</option>';

					}	

					$i++;
				}
			}	

			return $op;
		}		

		function getEmpInf($empid){
			if($empid!=""){
				return $this->getOneRow("SELECT empcode,last_name,first_name,last_name_kh,first_name_kh FROM sch_emp_profile WHERE empid='".$empid."'");
			}
		}
		function getEmpID($empcode){
			$empid='';	
			if($empcode!=""){
				$data=$this->getTable("SELECT empid FROM sch_emp_profile WHERE empcode like '".$empcode."%'");
				if(count($data)>0){					
					foreach($data as $row){
						$empid.=$row['empid'].',';
					}
					$empid=trim($empid,",");					
				}	
			}
			return $empid;
		}
		
		function getStatusOp($isblank,$selected,$isYesNo){
			$opStat="";
			if($isblank==1){
				//$opStat.="<option value=''></option>";
			}

			if($isYesNo==1){
				$active="Yes";
				$inactive="No";
			}else{
				$active="Active";
				$inactive="Inactive";
			}

			$opStat.="<option value='1' ".($selected==1?'selected="selected"':'').">".$active."</option>";
			$opStat.="<option value='0' ".($selected==0?'selected=selected':'').">".$inactive."</option>";
			echo $opStat;
		}

		function gOption($arr,$selected){
			if(count($arr)>0){
				$op="";
				foreach ($arr as $key => $value) {
					$op.="<option value='".$key."' ".($key==$selected?"selected":"").">$value</option>";
				}
			}
			return $op;
		}

		function formatSQLDate($date){
			if($date!=""){
				if(strpos($date,"-")!== false){
					$datepart=explode("-", $date);
				}else if(strpos($date,".")!== false){
					$datepart=explode(".", $date);
				}
				else{
					$datepart=explode("/", $date);
				}
				return $datepart[2].'-'.$datepart[1].'-'.$datepart[0];
			}else{
				return "";
			}
		}

		function convertSQLDate($date){
			if($date!=""){
				$datepart=explode("-", $date);
				return $datepart[2].'-'.$datepart[1].'-'.$datepart[0];
			}
			
		}

		function nextTran($typeid,$type){
			$last_seq=$this->getValue("SELECT sequence FROM sch_z_systype WHERE typeid='".$typeid."'");
			if($last_seq==""){
				$this->runSQL("INSERT INTO sch_z_systype SET sequence=1,type='".$type."',typeid='".$typeid."'");
				$last_seq=1;				
			}
			$this->runSQL("UPDATE sch_z_systype SET sequence=sequence+1 WHERE typeid='".$typeid."'");		

			return $last_seq;
		}
		function getStudentID($studenid,$schlevelid){
			return $this->getOneRow("SELECT DISTINCT
				smo.moeys_id
				FROM
				v_student_profile spro
				INNER JOIN sch_student_moeysid smo ON smo.studentid = spro.studentid
				WHERE
				spro.studentid = '".$studenid."'
				AND smo.schlevelid='".$schlevelid."'
				");
		}
		function getclasslevel($schlevelid='',$yearid='',$grade_levelid='',$classid='',$group='',$order='',$term=''){
			$ci=$ci=& get_instance();   
			$where='';
			if($schlevelid!=''){
				$where.=" AND schlevelid='$schlevelid'";
			}
			if($yearid!=''){
				$where.=" AND yearid='$yearid'";
			}
			if($grade_levelid!=''){
				$where.=" AND grade_levelid='$grade_levelid'";
			}
			if($classid!=''){
				$where.=" AND classid='$classid'";
			}
			if($term!=''){
				$where.=" AND term_id='$term'";
			}
			if($group!=''){
				$where.=" GROUP BY $group";
			}
			// if($group!=''){
			// 	$where.=" ORDER BY $order";
			// }

			$where.=" ORDER BY $order";
			$data = $ci->db->query("SELECT * FROM v_class WHERE is_active=1 AND 1=1 {$where}");
			
			if($classid!=''){
				return $data->row();
			}else{
				return $data->result();
			}
		}

		function ajax_pagination($total_row, $url, $limit=5){
		//$limit=10; //********** Number for select from DB **********		
		$start=0; //********** Number for start select from DB **********
		$adjacents = 2;
		
		if (isset($_POST["page"])) {
			$page = $_POST["page"];
		}
		else{
			$page=1;
		}
		
		if($page!=0) 
			$start = ($page - 1) * $limit;
		else
			$start = 0;			
		
		$total_pages = $total_row;
		
		if ($page == 0) $page = 1;
		$prev = $page - 1;
		$next = $page + 1;
		$lastpage = ceil($total_pages/$limit);
		$lpm1 = $lastpage - 1;
		
		//=========================================================================			
		$pagination ="";
		$pagination .= "<div class='dataTables_paginate'>";
		if($lastpage > 1)
		{	
			if ($page > 1) 
				$pagination.= "<a class=\"pagenav fg-button ui-button ui-state-default\" id='1' href='javascript:void(0)' id=1><span class='fa fa-fast-backward'></span></a>
			<a class=\"pagenav fg-button ui-button ui-state-default\" href='javascript:void(0)' id='$prev'><span class='fa fa-backward'></span></a>";
			else
				$pagination.= "<span class='fa fa-fast-backward fg-button ui-button ui-state-default'></span>
			<span class='fa fa-backward fg-button ui-button ui-state-default'></span>";
			if ($lastpage < 2 + ($adjacents * 2))
			{	
				for ($counter = 1; $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<a class=\"fg-button ui-button ui-state-default ui-state-disabled \">$counter</a>";
					else
						$pagination.= "<a class=\"pagenav fg-button ui-button ui-state-default\" href='javascript:void(0)' id='$counter'>$counter</a>";					
				}
			}
				elseif($lastpage >= ($adjacents * 2))	//enough pages to hide some
				{
					//close to beginning; only hide later pages
					
					if($page <= 2 + ($adjacents) && $page >= $lastpage-$adjacents-1)		
					{

						for ($counter = 1; $counter < $page - 1 + ($adjacents * 2); $counter++)
						{
							if ($counter == $page)
								$pagination.= "<span class=\"pagenav fg-button ui-button ui-state-default ui-state-disabled\">$counter</span>";
							else
								$pagination.= "<a class=\"pagenav fg-button ui-button ui-state-default\" href='javascript:void(0)' id='$counter'>$counter</a>";					
						}
						$pagination.= "<a class=\"pagenav fg-button ui-button ui-state-default\" href='javascript:void(0)' id='$lastpage'>$lastpage</a>";		
					}
					//in middle; hide some front and some back
					elseif($page <= 2 + ($adjacents) && $page < $lastpage-$adjacents-1)
					{
						if ($page<4){$page_=3;}
						else{$page_=$page;}
						for ($counter = 1; $counter <=$page_ + ($adjacents); $counter++)
						{
							if ($counter == $page)
								$pagination.= "<span class=\"pagenav fg-button ui-button ui-state-default ui-state-disabled\">$counter</span>";
							else
								$pagination.= "<a class=\"pagenav fg-button ui-button ui-state-default\" href='javascript:void(0)' id='$counter'>$counter</a>";					
						}
						$pagination.= "<a href='javascript:void(0)'>...</a>";
						$pagination.= "<a class=\"pagenav fg-button ui-button ui-state-default\" href='javascript:void(0)' id='$lastpage'>$lastpage</a>";		
					}
					elseif($page > 2 + ($adjacents) && $page >= $lastpage-$adjacents-1)		
					{
						$pagination.="<a class=\"pagenav fg-button ui-button ui-state-default\" href='javascript:void(0)' id=1>1</a>";
						$pagination.= "<a href='javascript:void(0)'>...</a>";
						if($page>$lastpage-3){$page_=$lastpage-4;}
						else{$page_=$page-2;}
						for ($counter = $page_; $counter <= $lastpage; $counter++)
						{
							if ($counter == $page)
								$pagination.= "<span class=\"pagenav fg-button ui-button ui-state-default ui-state-disabled\">$counter</span>";
							else
								$pagination.= "<a class=\"pagenav fg-button ui-button ui-state-default\" href='javascript:void(0)' id='$counter'>$counter</a>";					
						}		
					}
					elseif($page > 2 + ($adjacents) && $page < $lastpage-$adjacents-1)		
					{
						$pagination.="<a class=\"pagenav fg-button ui-button ui-state-default\" href='javascript:void(0)' id=1>1</a>";
						$pagination.= "<a href='javascript:void(0)'>...</a>";
						for ($counter = $page-2; $counter < $page - 1 + ($adjacents * 2); $counter++)
						{
							if ($counter == $page)
								$pagination.= "<span class=\"pagenav fg-button ui-button ui-state-default ui-state-disabled\">$counter</span>";
							else
								$pagination.= "<a class=\"pagenav fg-button ui-button ui-state-default\" href='javascript:void(0)' id='$counter'>$counter</a>";					
						}
						$pagination.= "<a href='javascript:void(0)'>...</a>";
						$pagination.= "<a class=\"pagenav fg-button ui-button ui-state-default\" href='javascript:void(0)' id='$lastpage'>$lastpage</a>";		
					}
					//close to end; only hide early pages
				}
				if ($page < $counter - 1) 
					$pagination.= "<a class=\"pagenav fg-button ui-button ui-state-default\" href='javascript:void(0)' id='$next'><span class='fa fa-forward'></span></a>
				<a class=\"pagenav fg-button ui-button ui-state-default\" href='javascript:void(0)' id='$lastpage'><span class='fa fa-fast-forward'></span></a>";
				else
					$pagination.="<span class='fa fa-forward fg-button ui-button ui-state-default'></span>
				<span class='fa fa-fast-forward fg-button ui-button ui-state-default'></span>";

			}
			else
				$pagination.="&nbsp;";
			$pagination.="</div>";
			$arr_pag= array();
			$arr_pag['start']=$start;
			$arr_pag['limit']=$limit;
			$arr_pag['pagination']=$pagination;
			return $arr_pag;
		}

    function isWeekend($date) {
      $day = date('l', strtotime($date));
      $normalized_day = strtoupper($day);
      if(($normalized_day == 'SATURDAY') || ($normalized_day == 'SUNDAY')) {
        return TRUE;
      } else {
        return FALSE;
      }
    }

    function getWorkdays($date1, $date2, $workSat = FALSE, $patron = NULL) {
      if (!defined('SATURDAY')) define('SATURDAY', 6);
      if (!defined('SUNDAY')) define('SUNDAY', 0);
      // Array of all public festivities
      // $publicHolidays = array('01-01', '01-06', '04-25', '05-01', '06-02', '08-15', '11-01', '12-08', '12-25', '12-26');
      $publicHolidays = array();
      // The Patron day (if any) is added to public festivities
      if ($patron) {
        $publicHolidays = $patron;
      }
      /*
       * Array of all Easter Mondays in the given interval
       */
      $yearStart = date('Y', strtotime($date1));
      $yearEnd   = date('Y', strtotime($date2));
      for ($i = $yearStart; $i <= $yearEnd; $i++) {
        $easter = date('Y-m-d', easter_date($i));
        list($y, $m, $g) = explode("-", $easter);
        $monday = mktime(0,0,0, date($m), date($g)+1, date($y));
        $easterMondays[] = $monday;
      }
      $start = strtotime($date1);
      $end   = strtotime($date2);
      $workdays = 0;
      for ($i = $start; $i <= $end; $i = strtotime("+1 day", $i)) {
        $day = date("w", $i);  // 0=sun, 1=mon, ..., 6=sat
        $mmgg = date('m-d', $i);
        if ($day != SUNDAY && !in_array($mmgg, $publicHolidays) && !in_array($i, $easterMondays) && !($day == SATURDAY && $workSat == FALSE)) {
          $workdays++;
        }
      }
      return intval($workdays);
    } 

    function cal_inv_amount($invoice_id=null) {
			$total_amount = 0;

			if($invoice_id != NULL) {
				$inv_detail = $this->runSQL("SELECT * FROM sch_pay_invoice_detail WHERE invoice_id='$invoice_id'")->result();
				foreach($inv_detail as $detail) {
		      $check_bus = '';
          if($detail->is_sch_fee == 0) {
            $check_bus = $this->runSQL("SELECT ser_cate_name FROM sch_pay_service WHERE deleted=0 AND service_id='$detail->service_id'")->row()->ser_cate_name;
          }
          $subtotal = $detail->subtotal;
          if(count($check_bus) > 0 && $detail->bus_time == 'both') {
            $pr_discount = $subtotal * 2;
          } else {
            $pr_discount = $subtotal;
          }

		      if($detail->discount != 0) {
		        $discount = $detail->discount;
		        $dpos = strpos($discount, '%');
		        if ($dpos !== false) {
		          $pds = explode("%", $discount);
		          $pr_discount = $subtotal - (($subtotal * (Float)($pds[0])) / 100);
		          // print_r($pr_discount);die();
		        } else {
		        	 if(count($check_bus) > 0 && $detail->bus_time == 'both') {
			            $pr_discount = ($subtotal*2)- $discount;

			          }else{
			            $pr_discount = $subtotal - $discount;

			          }
		          // $pr_discount = $subtotal - $discount;
		        }
		      }

		      // if($detail->is_product == 1) {
		      //   $pr_discount = $pr_discount;
		      // } else {
		      //   $pr_discount = fmod($pr_discount, 1) > 0 ? (int)$pr_discount + 1 : $pr_discount;
		      // }

		      $total_amount = $total_amount + ($pr_discount * $detail->quantity);
				}
			}
    		$invoicerow = $this->runSQL("SELECT * from sch_pay_invoice where  invoice_id = '$invoice_id'")->row();
    		if(isset($invoicerow->invoice_id)){
    			$total_amount = $total_amount - $invoicerow->deposit_amount - $invoicerow->placement_amount;
    		}
			// return ceil($total_amount);
			return $total_amount;
			// return round($total_amount);

      // return ($total_amount);
		}
	function numberToKhNumber($input){
      $inputNum = str_split($input);
      $latinNum = array("0","1","2","3","4","5","6","7","8","9");
      $KhNum = array("០","១","២","៣","៤","៥","៦","៧","៨","៩");
      $output = '';
      for($i=0;$i<count($inputNum);$i++){
          for($index=0;$index<count($latinNum);$index++){
              if($inputNum[$i]==$latinNum[$index]){
                  $output .= $KhNum[$index];
                  break;
              }
          }
      }
      return $output;
  }
  
  function checksaturdaysunday($date){
  	$days = date('N',strtotime($date));
  	if($days ==6 || $days==7){
  	 	return false;
  	}else{
	 		return true;
  	}
  }

  function my_simple_crypt( $string, $action = 'e' ) {
    // you may change these values to your own
    $secret_key = 'my_simple_secret_key';
    $secret_iv = 'my_simple_secret_iv';
 
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $key = hash( 'sha256', $secret_key );
    $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );
 
    if( $action == 'e' ) {
        $output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
    }
    else if( $action == 'd' ){
        $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
    }
 
    return $output;
	}
}
?>