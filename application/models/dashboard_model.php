<?php
class Dashboard_model extends CI_Model {
 
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
    public function count_customer()
    {
		$this->db->select('*');
		$this->db->from('tbl_customer');
		$query = $this->db->get();
		return $query->num_rows();  
    }    

    public function count_today_reserv()
    {
		// $this->db->select('*');
		// $this->db->from('tbl_checkin');
		// $this->db->where('date_in',date("Y/m/d"));
        $query=$this->db->query("SELECT count(*) as count FROM tbl_checkin where DATE(date_in)=CURDATE()");
		// $query = $this->db->get();
		return $query->row()->count;  
    }
    
    public function count_today_checkout()
    {
		// $this->db->select('*');
		// $this->db->from('tbl_checkin');
		// $this->db->where('date_out <= "' . date("Y/m/d") . '"' );
		// $query = $this->db->get();
        $query=$this->db->query("SELECT count(*) as count FROM tbl_checkin where DATE(date_out)=CURDATE()");
		return $query->row()->count;  
    }
	
	
	public function count_not_verifyed()
    {
		$this->db->select('*');
		$this->db->from('tbl_customer');
		$this->db->where('verifyed',0);
		$query = $this->db->get();
		return $query->num_rows();  
    }

    public function count_all_rooms()
    {
        $query = $this->db->get('tbl_room');
        return $query->num_rows();
    }

    public function get_all_room() 
    {
        $this->db->select('tbl_room.*');
        $this->db->select('tbl_roomtype.type as type');
        $this->db->select('tbl_roomtype.id as type_id');

        $this->db->order_by('tbl_room.floor');
        $this->db->order_by('tbl_room.room_no');

        $this->db->from('tbl_room');
        $this->db->join('tbl_roomtype', 'tbl_roomtype.id=tbl_room.type_id');

        return $this->db->get()->result();
    }

    public function has_reservation($room_id)
    {
        $this->db->select('tbl_reservation.*');
        $this->db->select('tbl_customer.Family as family');

        $this->db->from('tbl_reservation');
        $this->db->join('tbl_customer', 'tbl_customer.id=tbl_reservation.customer_id');

        $this->db->where('tbl_reservation.confirmed', 0);
        $this->db->where('tbl_reservation.canceled', 0);
        $this->db->where('tbl_reservation.room_id', $room_id);

        return $this->db->get()->row();
    } 

    public function has_checkin($room_id)
    {
        $this->db->select('tbl_checkin.*');
        $this->db->select('tbl_customer.Family as family');
        $this->db->select('tbl_customer.id as cid');

        $this->db->from('tbl_checkin');
        $this->db->join('tbl_customer', 'tbl_customer.id=tbl_checkin.customer_id');

        $this->db->where('tbl_checkin.checkouted', 0);
        $this->db->where('tbl_checkin.eject', 1);
        $this->db->where('tbl_checkin.room_no', $room_id);

        return $this->db->get()->row();
    }

    public function has_room_available($room_id)
    {
        $this->db->select('tbl_checkin.*');
        $this->db->select('tbl_customer.Family as family');

        $this->db->from('tbl_checkin');
        $this->db->join('tbl_customer', 'tbl_customer.id=tbl_checkin.customer_id');

        $this->db->where('.checkouted', 1);
        $this->db->where('tbl_checkin.eject', 0);
        $this->db->where('tbl_checkin.room_no', $room_id);

        return $this->db->get()->row();
    }

    public function get_roomtype($id) 
    {
        $this->db->where('id', $id);
        return $this->db->get('tbl_roomtype')->row();
    }

    public function get_checkin($id)
    {
        $this->db->where('room_no', $id);
        $this->db->where('eject', '1');
        $query = $this->db->get('tbl_checkin');
        return $query->row();
    }

    public function get_reservation($id)
    {
        $this->db->where('room_id', $id);
        $query = $this->db->get('tbl_reservation');
        return $query->row();
    }
    
    public function get_room_price($roomtype)
    {
        $this->db->select('price');
        $this->db->where('roomtype_id', $roomtype);
        $this->db->where('time', 'Overnight');
        return $this->db->get('tbl_staying')->row()->price;
    }
 
}
?>	
