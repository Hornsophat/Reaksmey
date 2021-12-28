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
    public function count_ground_rooms()
    {
        $this->db->where('floor', 'Ground floor');
        $query = $this->db->get('tbl_room');
        return $query->num_rows();
    }
    public function count_first_rooms()
    {
        $this->db->where('floor', 'First floor');
        $query = $this->db->get('tbl_room');
        return $query->num_rows();
    }
    public function count_second_rooms()
    {
        $this->db->where('floor', 'Second floor');
        $query = $this->db->get('tbl_room');
        return $query->num_rows();
    }
    public function count_third_rooms()
    {
        $this->db->where('floor', 'Third floor');
        $query = $this->db->get('tbl_room');
        return $query->num_rows();
    }
    public function count_four_rooms()
    {
        $this->db->where('floor', 'Four floor');
        $query = $this->db->get('tbl_room');
        return $query->num_rows();
    }
    public function count_five_rooms()
    {
        $this->db->where('floor', 'Five floor');
        $query = $this->db->get('tbl_room');
        return $query->num_rows();
    }
    public function count_six_rooms()
    {
        $this->db->where('floor', 'Six floor');
        $query = $this->db->get('tbl_room');
        return $query->num_rows();
    }
    public function count_seven_rooms()
    {
        $this->db->where('floor', 'Seven floor');
        $query = $this->db->get('tbl_room');
        return $query->num_rows();
    }
    public function count_eight_rooms()
    {
        $this->db->where('floor', 'Eight floor');
        $query = $this->db->get('tbl_room');
        return $query->num_rows();
    }
    public function count_all_checkin()
    {
        $query=$this->db->query("SELECT count(*) as count FROM tbl_reservation where DATE(checkin_data)=CURDATE()");
		return $query->row()->count;  
    }

    public function get_all_room() 
    {
        $this->db->select('tbl_room.*');
        $this->db->select('tbl_roomtype.type as type');
        $this->db->select('tbl_roomtype.id as type_id');

       
        $this->db->order_by('tbl_room.room_no');

        $this->db->from('tbl_room');
        $this->db->join('tbl_roomtype', 'tbl_roomtype.id=tbl_room.type_id');

        $this->db->where('tbl_room.floor', 'Ground Floor');
        return $this->db->get()->result();
    }

    public function get_first_floor() 
    {
        $this->db->select('tbl_room.*');
        $this->db->select('tbl_roomtype.type as type');
        $this->db->select('tbl_roomtype.id as type_id');

       
        $this->db->order_by('tbl_room.room_no');

        $this->db->from('tbl_room');
        $this->db->join('tbl_roomtype', 'tbl_roomtype.id=tbl_room.type_id');

        $this->db->where('tbl_room.floor', 'First Floor');
        return $this->db->get()->result();
    }

    public function get_second_floor() 
    {
        $this->db->select('tbl_room.*');
        $this->db->select('tbl_roomtype.type as type');
        $this->db->select('tbl_roomtype.id as type_id');

       
        $this->db->order_by('tbl_room.room_no');

        $this->db->from('tbl_room');
        $this->db->join('tbl_roomtype', 'tbl_roomtype.id=tbl_room.type_id');

        $this->db->where('tbl_room.floor', 'Second Floor');
        return $this->db->get()->result();
    }

    public function get_third_floor() 
    {
        $this->db->select('tbl_room.*');
        $this->db->select('tbl_roomtype.type as type');
        $this->db->select('tbl_roomtype.id as type_id');

       
        $this->db->order_by('tbl_room.room_no');

        $this->db->from('tbl_room');
        $this->db->join('tbl_roomtype', 'tbl_roomtype.id=tbl_room.type_id');

        $this->db->where('tbl_room.floor', 'third Floor');
        return $this->db->get()->result();
    }

    public function get_four_floor() 
    {
        $this->db->select('tbl_room.*');
        $this->db->select('tbl_roomtype.type as type');
        $this->db->select('tbl_roomtype.id as type_id');

       
        $this->db->order_by('tbl_room.room_no');

        $this->db->from('tbl_room');
        $this->db->join('tbl_roomtype', 'tbl_roomtype.id=tbl_room.type_id');

        $this->db->where('tbl_room.floor', 'Four Floor');
        return $this->db->get()->result();
    }

    public function get_five_floor() 
    {
        $this->db->select('tbl_room.*');
        $this->db->select('tbl_roomtype.type as type');
        $this->db->select('tbl_roomtype.id as type_id');

       
        $this->db->order_by('tbl_room.room_no');

        $this->db->from('tbl_room');
        $this->db->join('tbl_roomtype', 'tbl_roomtype.id=tbl_room.type_id');

        $this->db->where('tbl_room.floor', 'Five Floor');
        return $this->db->get()->result();
    }
    public function get_six_floor() 
    {
        $this->db->select('tbl_room.*');
        $this->db->select('tbl_roomtype.type as type');
        $this->db->select('tbl_roomtype.id as type_id');

       
        $this->db->order_by('tbl_room.room_no');

        $this->db->from('tbl_room');
        $this->db->join('tbl_roomtype', 'tbl_roomtype.id=tbl_room.type_id');

        $this->db->where('tbl_room.floor', 'Six Floor');
        return $this->db->get()->result();
    }
    public function get_seven_floor() 
    {
        $this->db->select('tbl_room.*');
        $this->db->select('tbl_roomtype.type as type');
        $this->db->select('tbl_roomtype.id as type_id');

       
        $this->db->order_by('tbl_room.room_no');

        $this->db->from('tbl_room');
        $this->db->join('tbl_roomtype', 'tbl_roomtype.id=tbl_room.type_id');

        $this->db->where('tbl_room.floor', 'Seven Floor');
        return $this->db->get()->result();
    }
    public function get_eight_floor() 
    {
        $this->db->select('tbl_room.*');
        $this->db->select('tbl_roomtype.type as type');
        $this->db->select('tbl_roomtype.id as type_id');

       
        $this->db->order_by('tbl_room.room_no');

        $this->db->from('tbl_room');
        $this->db->join('tbl_roomtype', 'tbl_roomtype.id=tbl_room.type_id');

        $this->db->where('tbl_room.floor', 'Eight Floor');
        return $this->db->get()->result();
    }

    public function has_reservation($room_id)
    {
        $this->db->select('tbl_reservation.*');
        $this->db->select('tbl_customer.Family as family');
        $this->db->select('tbl_customer.id as cid');
        $this->db->select('tbl_customer.Mobile as mobile');
        $this->db->select('tbl_customer.Gender as gender');


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
        $this->db->select('price_month');
        $this->db->where('roomtype_id', $roomtype);
        $this->db->where('time', 'Month');
        return $this->db->get('tbl_staying')->row()->price_month;
    }
 
}
?>	
