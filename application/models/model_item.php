<?php
class Model_item extends CI_Model {
 
    /**
    * Responsable for auto load the database
    * @return void
    */
    public function __construct()
    {
        $this->load->database();
    }

    function load_all_item()
    {
    	$page=0;
        if(isset($_GET['per_page']))
        $page=$_GET['per_page']; 
        $config['base_url']=site_url('admin_item/index/?');
        $config['per_page']=10;
        $config['num_link']=6;
        $config['page_query_string'] = TRUE;

        $config['page_query_string'] = TRUE;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = 'Prev';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = 'Next';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

    	$sql = "SELECT * FROM tbl_item";

    	$config['total_rows']=count($this->db->query($sql)->result());
        $this->pagination->initialize($config);
        $limit=" LIMIT ".$config['per_page'];
        if($page>0)
            $limit=" LIMIT $page,".$config['per_page'];
        $sql.=" {$limit}";
        return $this->db->query($sql)->result();
    }
    function getItem_by_id($id)
    {
    	return $this->db->query("SELECT * FROM tbl_item WHERE pid = '$id' ")->row();
    }
    function load_userprofile($user)
    {
        return $this->db->query("SELECT * FROM tbl_employee WHERE user_name = '$user' ")->row();
    }
}
?>