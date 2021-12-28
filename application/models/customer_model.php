<?php
class Customer_model extends CI_Model {
 
    /**
    * Responsable for auto load the database
    * @return void
    */
    public function __construct()
    {
        $this->load->database();
    }

    /**
    * Get product by his is
    * @param int $product_id 
    * @return array
    */
    public function get_customer_by_id($id)
    {
		$this->db->select('*');
		$this->db->from('tbl_customer');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->result_array(); 
    }  
    
    public function get_all_customer($id) 
    {
        $this->db->select('tbl_reservation.*');
        $this->db->select('tbl_room.room_no ');
        $this->db->select('tbl_roomtype.type ');
        $this->db->select('tbl_customer.Family ');
        $this->db->select('tbl_customer.Mobile ');
        $this->db->select('tbl_customer.Gender ');
        $this->db->select('tbl_customer.Passport ');
        $this->db->select('tbl_customer.Country ');


        $this->db->from('tbl_reservation');
        $this->db->join('tbl_customer', 'tbl_customer.id = tbl_reservation.Customer_id','left');
        $this->db->join('tbl_room', 'tbl_room.id = tbl_reservation.room_id','left');
        $this->db->join('tbl_roomtype', 'tbl_roomtype.id = tbl_room.type_id','left');
       
        $this->db->where('tbl_customer.id', $id);
        $this->db->group_by('tbl_customer.id', $id);
        return $this->db->get()->result();
    }

    public function get_all_checkin($id) 
    {
        $this->db->select('ck.*, ro.room_no, rot.type, cu.Family, cu.id,cu.Mobile,cu.Gender,cu.Passport,cu.Country, sty.time,ckd.item_name,ckd.price as ckd_price,ckd.room_id,ckd.qty');
		$this->db->from('tbl_checkin ck');
        $this->db->join('tbl_checkin_detail ckd', 'ckd.checkin_id = ck.id', 'left');
		$this->db->join('tbl_room ro', 'ck.room_no = ro.id', 'left');
		$this->db->join('tbl_roomtype rot', 'ro.type_id = rot.id', 'left');
		$this->db->join('tbl_customer cu', 'ck.customer_id = cu.id');
		$this->db->join('tbl_staying sty', 'ck.checkin_type = sty.id', 'left');

        $this->db->where('cu.id', $id);
		$this->db->order_by('ck.id', 'DESC');
        $this->db->group_by('ck.id', 'DESC');
		$query = $this->db->get();
		return $query->result();
    }

    public function get_all_item($id) 
    {
        $this->db->select('ck.*, ro.room_no, rot.type, cu.Family, cu.id,cu.Mobile,cu.Gender,cu.Passport,cu.Country, sty.time,ckd.item_name,ckd.price as ckd_price,ckd.room_id,ckd.qty,ckd.amount,ckd.date_start,ckd.date_end,ckd.old_kw,ckd.new_kw');
		$this->db->from('tbl_checkin ck');
        $this->db->join('tbl_checkin_detail ckd', 'ckd.checkin_id = ck.id', 'left');
		$this->db->join('tbl_room ro', 'ck.room_no = ro.id', 'left');
		$this->db->join('tbl_roomtype rot', 'ro.type_id = rot.id', 'left');
		$this->db->join('tbl_customer cu', 'ck.customer_id = cu.id');
		$this->db->join('tbl_staying sty', 'ck.checkin_type = sty.id', 'left');

	   $this->db->where('cu.id', $id);
		$this->db->order_by('ck.id', 'DESC');
		$query = $this->db->get();
		return $query->result();
    }



    public function get_fields()
    
    {
    
    $fields = $this->db->list_fields('tbl_customer');
    return $fields ; 
    }

    /**
    * Fetch customer data from the database
    * possibility to mix search, filter and order
    * @param string $search_string 
    * @param strong $order
    * @param string $order_type 
    * @param int $limit_start
    * @param int $limit_end
    * @return array
    */
    public function get_customer($search_string=null, $order=null, $order_type='Asc', $limit_start=null, $limit_end=null)
    {
	    
		$this->db->select('tbl_customer.*');
        $this->db->select('tbl_room.room_no');
        $this->db->select('tbl_roomtype.type');
		$this->db->from('tbl_customer');
      

        $this->db->join('tbl_reservation', 'tbl_reservation.Customer_id = tbl_customer.id', 'left');
        $this->db->join('tbl_room', 'tbl_room.id = tbl_reservation.room_id', 'left');
        $this->db->join('tbl_roomtype', 'tbl_roomtype.id = tbl_room.type_id', 'left');
        


		if($search_string){
			$this->db->like('tbl_customer.Mobile', $search_string);
		}
		$this->db->group_by('tbl_customer.id');

		if($order){
			$this->db->order_by($order, $order_type);
		}else{
		    $this->db->order_by('tbl_customer.id', $order_type);
		}

        if($limit_start && $limit_end){
          $this->db->limit($limit_start, $limit_end);	
        }

        if($limit_start != null){
          $this->db->limit($limit_start, $limit_end);    
        }
        
		$query = $this->db->get();
		
		return $query->result_array(); 	
    }
    
    
    
    

    /**
    * Count the number of rows
    * @param int $search_string
    * @param int $order
    * @return int
    */
    function count_customer($search_string=null, $order=null)
    {
		$this->db->select('*');
		$this->db->from('tbl_customer');
		if($search_string){
			$this->db->like('Family', $search_string);
		}
		if($order){
			$this->db->order_by($order, 'Asc');
		}else{
		    $this->db->order_by('id', 'Asc');
		}
		$query = $this->db->get();
		return $query->num_rows();        
    }

    /**
    * Store the new item into the database
    * @param array $data - associative array with data to store
    * @return boolean 
    */
    function store_customer($data)
    {
	    $insert = $this->db->insert('tbl_customer', $data);
	    return $insert;
	}

    /**
    * Update customer
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_customer($id, $data)
    {
		$this->db->where('id', $id);
		$this->db->update('tbl_customer', $data);
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
    * Delete customerr
    * @param int $id - customer id
    * @return boolean
    */
	function delete_customer($id){
		$this->db->where('id', $id);
		$this->db->delete('tbl_customer'); 
	}
	
    /**
    * Delete customerr
    * @param int $id - customer id
    * @return boolean
    */
    
	function Search_customer($Family, $passport){
		
		$this->db->select('*');
		$this->db->from('tbl_customer');
		$this->db->like('Family', $Family);
        $this->db->where('verifyed', 1);
        //$this->db->like('Passport', $passport);
		$query = $this->db->get();
		return $query->result_array(); 	
	}

    function get_verified_customer() {
        $this->db->where('verifyed', 1);
        $this->db->from('tbl_customer');
        $query = $this->db->get();
        return $query->result_array();
    }
	
	
	function verify($id){
	   
	   $data = array(
	    'verifyed' => '1'
	   );
		
	   $this->db->where('id = ' . $id);
	   $this->db->update('tbl_customer', $data);
	}
	
    public function get_customer_id($id)
    {
        $this->db->like('Family', $id);
        $query = $this->db->get('tbl_customer');
        return $query->row();
    }

    public function get_customer_report() {
        $this->db->from('tbl_customer');        
        $query = $this->db->get();
        return $query->result();
    }
 
}
?>