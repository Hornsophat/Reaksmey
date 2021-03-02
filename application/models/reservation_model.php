<?php
class Reservation_model extends CI_Model {
 
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
    public function get_reservation_by_id($id)
    {
		$this->db->select('*');
		$this->db->from('tbl_reservation');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->result_array(); 
    }  
    
    
    public function get_fields()
    {    
    $fields = $this->db->list_fields('tbl_reservation');
    return $fields ; 
    }

    /**
    * Fetch reservation data from the database
    * possibility to mix search, filter and order
    * @param string $search_string 
    * @param strong $order
    * @param string $order_type 
    * @param int $limit_start
    * @param int $limit_end
    * @return array
    */
    public function get_reservation($search_string=null, $order=null, $order_type='Asc', $limit_start=null, $limit_end=null)
    {
		$this->db->select('tbl_reservation.*');
		$this->db->select('tbl_customer.Family as Family');
		$this->db->select('tbl_customer.Mobile as Mobile');
		$this->db->select('tbl_room.room_no as room_no');
		$this->db->select('tbl_roomtype.type as room_type');
		$this->db->select('tbl_staying.time as time');
		$this->db->select('tbl_multireservation.room_number');
		$this->db->from('tbl_reservation');
		$this->db->join('tbl_customer', 'tbl_reservation.customer_id = tbl_customer.id ', 'left');
		$this->db->join('tbl_room', 'tbl_reservation.room_id = tbl_room.id ', 'left');
		$this->db->join('tbl_roomtype', 'tbl_roomtype.id=tbl_room.type_id','left');
		$this->db->join('tbl_staying', 'tbl_staying.id=tbl_reservation.staying','left');
		$this->db->join('tbl_multireservation','tbl_multireservation.reserv_id = tbl_reservation.id','left');

		if($search_string){
			$this->db->like('Family', $search_string);
		}
		$this->db->group_by('tbl_reservation.id');

		if($order){
			$this->db->order_by('tbl_reservation.' . $order, $order_type);
		}else{
		    $this->db->order_by('tbl_reservation.id', $order_type);
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
    function count_reservation($search_string=null, $order=null)
    {
		$this->db->select('*');
		$this->db->select('tbl_customer.Family as Family');
		$this->db->from('tbl_reservation');
		$this->db->join('tbl_customer', 'tbl_reservation.customer_id = tbl_customer.id ', 'left');
		
		if($search_string){
			$this->db->like('Family', $search_string);
		}
		if($order){
			$this->db->order_by('tbl_reservation.' . $order, 'Asc');
		}else{
		    $this->db->order_by('tbl_reservation.id', 'Asc');
		}
		$query = $this->db->get();
		return $query->num_rows();        
    }

    /**
    * Store the new item into the database
    * @param array $data - associative array with data to store
    * @return boolean 
    */
    function store_reservation($data)
    {
	    $insert = $this->db->insert('tbl_reservation', $data);
	    $id = $this->db->insert_id();
	    if($data['deposit'] > 0){
	    	$payment_data = [
	            'reserva_id'    => $id,
	            'user_name'       => $this->session->userdata('user_name'),
	            'date'          => date('Y-m-d H:i:s'),
	            'deposit'       => $data['deposit'],
	            'discount'       => $data['discount'],
	            'total'         => $data['total_price'],
	            'grand_total'   => $data['grand_total']

	        ];
	        if($payment_data){
	        	$payment = $this->db->insert('tbl_payments', $payment_data);
	        	$payment_id = $this->db->insert_id();
	        	$payment_detail_data[] = [
	                                        'payment_id'        => $payment_id,
	                                        'checkindetail_id'  => null,
	                                        'room_id'           => null,
	                                        'sale_id'           => null,
	                                        'item_name'         => 'Deposit From reserva ('.$id.')',
	                                        'status'            => 'deposit',
	                                        'amount'            => str_replace(',', '', number_format($data['deposit'],2))
	                                    ];
	        	$this->db->insert_batch('tbl_payment_detail',$payment_detail_data);
	        }
	    }
		    


	    return $insert;
	}

	function store_multireservationo($room_det,$data_to_store){
		// var_dump($room_det);die();
		if ($data_to_store) {
			$this->db->insert('tbl_reservation',$data_to_store);
			$reserv_id = $this->db->insert_id();
		    	foreach ($room_det as $item) {
		    		// var_dump($item);
		    		$item['reserv_id'] = $reserv_id;
		    		$this->db->insert('tbl_multireservation',$item);
		    	}

		    if($data_to_store['deposit'] > 0){
		    	$payment_data = [
		            'reserva_id'    => $reserv_id,
		            'user_name'       => $this->session->userdata('user_name'),
		            'date'          => date('Y-m-d H:i:s'),
		            'deposit'       => $data_to_store['deposit'],
		            'discount'       => $data_to_store['discount'],
		            'total'         => $data_to_store['total_price'],
		            'grand_total'   => $data_to_store['grand_total']

		        ];
		        if($payment_data){
		        	$payment = $this->db->insert('tbl_payments', $payment_data);
		        	$payment_id = $this->db->insert_id();
		        	$payment_detail_data[] = [
		                                        'payment_id'        => $payment_id,
		                                        'checkindetail_id'  => null,
		                                        'room_id'           => null,
		                                        'sale_id'           => null,
		                                        'item_name'         => 'Deposit From reserva ('.$reserv_id.')',
		                                        'status'            => 'deposit',
		                                        'amount'            => str_replace(',', '', number_format($data_to_store['deposit'],2))
		                                    ];
		        	$this->db->insert_batch('tbl_payment_detail',$payment_detail_data);
		        }
		    }

		    	return true;
		}
		return false;
	}

    /**
    * Update reservation
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_reservation($id, $data)
    {
		$this->db->where('id', $id);
		$this->db->update('tbl_reservation', $data);
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
    * Delete reservation
    * @param int $id - reservation id
    * @return boolean
    */
	function delete_reservation($id){
		$this->db->where('id', $id);
		$this->db->delete('tbl_reservation'); 
	}
	function cancel_reservation($id){
		$data = array(
			'canceled' => '1',
			'canceled_by' =>$this->session->userdata('user_name')
	   );
	   $this->db->where('id',$id)->update('tbl_reservation', $data);
	}
	
	
	function verify($id){
	   
	   $data = array(
	    'confirmed' => '1'
	   );
		
	   $this->db->where('id',$id)->update('tbl_reservation', $data);
	}

	function cancel($id)
	{
		$this->db->where('id', $id)->update('tbl_reservation', array('canceled'=>1));
	}
	
	function get_customer()
	{
		return $this->db->where('verifyed', 1)->get('tbl_customer')->result();
		//return $this->db->query("SELECT * FROM tbl_customer")->result();
	}
	function get_roomtype()
	{
		return $this->db->query("SELECT * FROM tbl_roomtype")->result();
	}

	function get_reservation_id($id)
	{
		// $this->db->select('tbl_reservation.id,tbl_reservation.customer_id,tbl_reservation.room_id,tbl_reservation.reservation_date,tbl_reservation.checkin_data,tbl_reservation.checkout_data,tbl_reservation.confirmed,tbl_reservation.staying,tbl_reservation.duration,tbl_reservation.total_price,tbl_reservation.note,tbl_reservation.price,tbl_reservation.canceled,tbl_room.room_no');
		// $this->db->from('tbl_reservation');
		// $this->db->join('tbl_room','tbl_room.id=tbl_reservation.room_id','right');
		// // $this->db->group_by('tbl_reservation.id');
		// $this->db->where('tbl_reservation.id',$id);
		// $res=$this->db->get();
		// return $res->result();
		return $this->db->query("SELECT * FROM tbl_reservation WHERE id = '$id' ")->row();
	}

	function get_roomtype_single($id) {
		$this->db->where('id', $id);
		return $this->db->get('tbl_roomtype')->row();
	}
 
}
?>