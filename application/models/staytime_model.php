<?php
class StayTime_model extends CI_Model {
 
    /**
    * Responsable for auto load the database
    * @return void
    */
    public function __construct()
    {
        $this->load->database();
    }

    /**
    * Get roomtype by his is
    * @param int $roomtype_id 
    * @return array
    */
    public function get_staytime_by_id($id)
    {
		$this->db->select('*');
		$this->db->from('tbl_staying');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
    
      function get_stayingtime_by_type($type)
    {
		
		$this->db->select('*');
		$this->db->from('tbl_staying');
		$this->db->where('roomtype_id', $type);
		$this->db->order_by('id',DESC);
		$query = $this->db->get();
		return $query->result_array(); 	
	}
    function get_by_stay_result($room_no){
		$this->db->select('*');
		$this->db->from('tbl_staying');
		$this->db->where('roomtype_id', $room_no);
		// $this->db->where('status = 0 ');
		$this->db->order_by('id','DESC');
		$query = $this->db->get();
		return $query->result();
	}
    /**
    * Get free roomtype 
    * @return array
    */
    public function get_staytime_all($roomtype=null)
    {
		$this->db->select('tbl_staying.*');
        $this->db->select('tbl_roomtype.type AS roomtype');

		$this->db->from('tbl_staying');
        $this->db->join('tbl_roomtype', 'tbl_staying.roomtype_id=tbl_roomtype.id');

        if($roomtype != NULL) {
            $this->db->where('tbl_staying.roomtype_id', $roomtype);
        }

        $this->db->group_by('tbl_staying.time');

		$query = $this->db->get();
		return $query->result_array(); 
    }      

    /**
    * Fetch roomtype data from the database
    * possibility to mix search, filter and order
    * @param string $search_string 
    * @param strong $order
    * @param string $order_type 
    * @param int $limit_start
    * @param int $limit_end
    * @return array
    */
    public function get_staytime($search_string=null, $order=null, $order_type='Asc', $limit_start=null, $limit_end=null)
    {
	    
		$this->db->select('tbl_staying.*');
        $this->db->select('tbl_roomtype.type AS roomtype');
	
		
		$this->db->from('tbl_staying');
        $this->db->join('tbl_roomtype', 'tbl_staying.roomtype_id=tbl_roomtype.id');
		

		if($search_string){
			$this->db->like('tbl_roomtype.type', $search_string);
		}
		$this->db->group_by('tbl_staying.id');

	    $this->db->order_by('tbl_staying.id', $order_type);


        if($limit_start && $limit_end){
          $this->db->limit($limit_start, $limit_end);	
        }

        if($limit_start != null){
          $this->db->limit($limit_start, $limit_end);    
        }
        
		$query = $this->db->get();
		
		return $query->result_array(); 	
    }

    function get_by_type($type) {
        $this->db->where('roomtype_id', $type);
        $this->db->order_by('time');
        $query = $this->db->get('tbl_staying');
        return $query->result_array();
    }
       
    // s
    /**
    * Count the number of rows
    * @param int $search_string
    * @param int $order
    * @return int
    */
    function count_staytime($search_string=null, $order=null)
    {
		$this->db->select('tbl_staying.*');
		$this->db->from('tbl_staying');
        $this->db->join('tbl_roomtype', 'tbl_staying.roomtype_id = tbl_roomtype.id');
		if($search_string){
			$this->db->like('tbl_roomtype.type', $search_string);
		}

		    $this->db->order_by('tbl_staying.id', 'Asc');

		$query = $this->db->get();
		return $query->num_rows();        
    }

    /**
    * Store the new item into the database
    * @param array $data - associative array with data to store
    * @return boolean 
    */
    function store_staytime($data)
    {
            $insert = $this->db->insert('tbl_staying', $data);
	    return $insert;
	}
	 
    /**
    * Update roomtype
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_staytime($id, $data)
    {
		$this->db->where('id', $id);
		$this->db->update('tbl_staying', $data);
		$report = array();
		$report['error'] = $this->db->_error_number();
		$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}

    /**
    * Delete roomtyper
    * @param int $id - roomtype id
    * @return boolean
    */
	function delete_staytime($id){
		$this->db->where('id', $id);
		$this->db->delete('tbl_staying'); 
	}
 
}
?>