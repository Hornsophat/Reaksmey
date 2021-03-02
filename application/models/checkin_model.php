<?php
class Checkin_model extends CI_Model {
 
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
    public function get_checkin_by_id($id)
    {
		$this->db->select('tbl_checkin.*');
	    $this->db->select('tbl_customer.Family as Family');
		$this->db->select('tbl_customer.Passport as Passport');
		$this->db->select('tbl_customer.Mobile as Mobile');
		$this->db->select('tbl_room.room_no as room_number');
		$this->db->select('tbl_room.type_id as roomtype');
		$this->db->select('tbl_staying.price as price');

		$this->db->from('tbl_checkin');
		$this->db->join('tbl_customer', 'tbl_checkin.customer_id = tbl_customer.id ', 'left');
		$this->db->join('tbl_room', 'tbl_checkin.room_no = tbl_room.id ', 'left');
		//$this->db->join('tbl_roomtype', 'tbl_roomtype.id=tbl_room.type_id');
		$this->db->join('tbl_checkin_detail', 'tbl_checkin_detail.checkin_id = tbl_checkin.id', 'inner');
		$this->db->join('tbl_staying', 'tbl_staying.id=tbl_checkin.checkin_type');
		
		$this->db->where('tbl_checkin.id', $id);
		$this->db->where('tbl_checkin_detail.item_name', 'staying');
		$query = $this->db->get();
		return $query->result_array();
    }    

    /**
    * Fetch checkin data from the database
    * possibility to mix search, filter and order
    * @param string $search_string 
    * @param strong $order
    * @param string $order_type 
    * @param int $limit_start
    * @param int $limit_end
    * @return array
    */
    public function get_checkin($search_string=null, $order=null, $order_type='DESC', $limit_start=null, $limit_end=null)
    {
	    
		$this->db->select('tbl_checkin.*');
		//$this->db->select('tbl_checkin.id as checkin_id');
		$this->db->select('tbl_checkin.room_no as room_no_ch');
		$this->db->select('tbl_room.room_no as room_no');
		$this->db->select('tbl_roomtype.type as room_type');
		$this->db->select('tbl_customer.Family as customer_id');
		$this->db->select('tbl_customer.id as cid');
		$this->db->select('tbl_staying.time as checkin_type');
		$this->db->select('tbl_checkin.multi_checkin as m_ch');
		
		$this->db->from('tbl_checkin');
		
		$this->db->join('tbl_room', 'tbl_checkin.room_no = tbl_room.id ', 'left');
		$this->db->join('tbl_roomtype', 'tbl_room.type_id=tbl_roomtype.id','left');
		$this->db->join('tbl_customer', 'tbl_customer.id = tbl_checkin.customer_id','left');
		$this->db->join('tbl_staying', 'tbl_staying.id = tbl_checkin.checkin_type','left');
		
		if($search_string){
			$this->db->like('tbl_customer.Family', $search_string);
		}
		
		$this->db->where('checkouted',0);
		// $this->db->group_by('tbl_checkin.date_in');
		// $this->db->group_by('tbl_checkin.customer_id');

		if($order){
			$this->db->order_by('tbl_checkin.'.$order, $order_type);
		}else{
		    $this->db->order_by('id', $order_type);
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
    function count_checkin($search_string=null, $order=null)
    {
		$this->db->select('tbl_checkin.*');
		$this->db->select('tbl_checkin.id as checkin_id');
		$this->db->from('tbl_checkin');
		$this->db->join('tbl_customer', 'tbl_checkin.customer_id = tbl_customer.id','left');
		if($search_string){
			$this->db->like('tbl_customer.Family', $search_string);
		}
		$this->db->where('checkouted',0);
		if($order){
			$this->db->order_by($order, 'Asc');
		}else{
		    $this->db->order_by('checkin_id', 'Asc');
		}
		$query = $this->db->get();
		return $query->num_rows();        
    }

    public function get_room_row($checkin_id) {
    	$this->db->select('tbl_room.room_no as room_no');
    	$this->db->select('tbl_roomtype.type as room_type');
    	$this->db->from('tbl_checkin');
    	$this->db->join('tbl_room', 'tbl_room.id=tbl_checkin.room_no', 'right');
    	$this->db->join('tbl_roomtype', 'tbl_room.type_id=tbl_roomtype.id', 'left');

    	$this->db->where('tbl_checkin.id', $checkin_id);

    	$query = $this->db->get();
    	return $query->row();
    }

    public function get_room_by_id($id){
    	$this->db->select('tbl_room.room_no as room_no,tbl_room.type_id');
    	$this->db->from('tbl_room');
    	$this->db->where('tbl_room.id', $id);
    	$query = $this->db->get();
    	return $query->row();
    }
    public function get_room_multy_id($id){
    	$this->db->select('tbl_room.room_no as room_no');
    	$this->db->from('tbl_room');
    	$this->db->where_in('tbl_room.id', (explode(",", $id)));
    	$query = $this->db->get()->result();

    	return $query;
    }
    /**
    * Store the new item into the database
    * @param array $data - associative array with data to store
    * @return boolean 
    */
    function store_checkin($data,$detail)
    {
   		$id = "";
	    $this->db->insert('tbl_checkin', $data);
	    $id = $this->db->insert_id();
	    $ch = array(
	    	'checkin_id'=>$id,
        );
    	// var_dump($ch);die();
	    $this->db->insert('tbl_checkin_detail',array_merge($ch,$detail));
	    return $id;

    }
    function store_checkin_new($data){
    	$this->db->insert('tbl_checkin', $data);
	    $id = $this->db->insert_id();
	    return $id;
    }
    function store_checkin_detail($data){
    	 $this->db->insert_batch('tbl_checkin_detail',$data);
    }
    function set_bussy($room_no)
    {
	   $busy_room = array(
           'status' => '1'
           );
            
           $this->db->where('id', $room_no);
           $this->db->update('tbl_room', $busy_room);

    }
    
    /**
    * Update checkin
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_checkin($id, $data, $detail)
    {
		$this->db->where('id', $id);
		$this->db->update('tbl_checkin', $data);

		$this->db->where('checkin_id',$id);
		$this->db->where('item_name','staying');
		$this->db->update('tbl_checkin_detail',$detail);

		$report = array();
		$report['error'] = $this->db->_error_number();
		$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}
	
	
    public function get_fields()
    
    {
    
    $fields = $this->db->list_fields('tbl_checkin');
    return $fields ; 
    }


    /**
    * Delete checkinr
    * @param int $id - checkin id
    * @return boolean
    */
    function delete_checkin($id){
		$this->db->where('id', $id);
		$this->db->delete('tbl_checkin'); 
	}


	function checkin_report()
	{
		$this->db->select('ck.*, ro.room_no, rot.type, cu.Family, cu.id, sty.time');
		$this->db->from('tbl_checkin ck');
		$this->db->join('tbl_room ro', 'ck.room_no = ro.id', 'left');
		$this->db->join('tbl_roomtype rot', 'ro.type_id = rot.id', 'left');
		$this->db->join('tbl_customer cu', 'ck.customer_id = cu.id');
		$this->db->join('tbl_staying sty', 'ck.checkin_type = sty.id', 'left');

		$this->db->where('ck.checkouted', 0);
		$this->db->order_by('ck.id', 'DESC');
		$query = $this->db->get();
		return $query->result();
	}

    function today_checkin()
    {
		$today = date('Y-m-d', time());  
		
		$this->db->select('ck.*, ro.room_no, cu.Family, sty.time, rot.type, sty.price, tbl_checkin_detail.amount');
		$this->db->from('tbl_checkin ck');
		$this->db->join('tbl_room ro', 'ck.room_no = ro.id ', 'left');
		$this->db->join('tbl_roomtype rot', 'ro.type_id = rot.id', 'left');
		$this->db->join('tbl_customer cu', 'cu.id = ck.customer_id');
		$this->db->join('tbl_staying sty', 'sty.id = ck.checkin_type');
		$this->db->join('tbl_checkin_detail','tbl_checkin_detail.checkin_id = ck.id');
		
		// $this->db->where('checkouted', 0);
		// $this->db->where('eject', 1);
		$this->db->like('ck.date_in' , $today);
		$this->db->order_by('ck.id', 'DESC');
		
		$query = $this->db->get();
		// var_dump($query->result());die();
		// return $query->result_array();
		return $query->result();
    }
    
    function last_week_checkin($date_in,$first_date,$last_date)
    {
		// $today = date('m/d/Y', time()) ;  
		// $last_week = date('Y-m-d', time()-(7*86400));
		
		$this->db->select('ck.*, ro.room_no, cu.Family, sty.time, rot.type,tbl_checkin_detail.amount,tbl_checkin_detail.price');
		$this->db->from('tbl_checkin as ck');
		$this->db->join('tbl_checkin_detail','tbl_checkin_detail.checkin_id = ck.id');
		$this->db->join('tbl_room ro', 'ck.room_no = ro.id', 'left');
		$this->db->join('tbl_roomtype rot', 'ro.type_id = rot.id', 'left');
		$this->db->join('tbl_customer cu', 'cu.id = ck.customer_id');
		$this->db->join('tbl_staying sty', 'sty.id = ck.checkin_type');
		
		if($first_date!='' && $last_date!=''){
            $this->db->where('date_in >= ',$first_date);

            $this->db->where('date_in <= ',$last_date);
        }else{
            $this->db->where('date_format(date_in ," %Y-%m-%d ")',$date_in);
        }
		// $this->db->where('date_in >= ',  $last_week);
		$this->db->order_by('ck.date_in', 'DESC');
		
		$query = $this->db->get();
		// return $query->result_array();
		return $query->result();
    }

 	function get_price($room)
 	{
 		return $this->db->query("SELECT price FROM tbl_staying WHERE id = '$room' ")->row();
 	}
 	function get_price_more($room_id){
 		return $this->db->query("SELECT stay.price FROM `tbl_staying` stay 
								INNER JOIN tbl_roomtype room_type ON stay.roomtype_id = room_type.id
								INNER JOIN tbl_room room ON room.type_id = room_type.id 
								WHERE room.id IN ('".implode("','", explode(',',$room_id))."') ")->result();
 	}
 	function get_price_by_id($room_id){
 		return $this->db->query("SELECT stay.price FROM `tbl_staying` stay 
								INNER JOIN tbl_roomtype room_type ON stay.roomtype_id = room_type.id
								INNER JOIN tbl_room room ON room.type_id = room_type.id 
								WHERE room.id IN ('$room_id') ")->row();
 	}
 	function get_customer()
	{
		return $this->db->where('verifyed', 1)->get('tbl_customer')->result();
		//return $this->db->query("SELECT * FROM tbl_customer")->result();
	}
 	function load_allItem()
 	{
 		return $this->db->query("SELECT * FROM tbl_item ")->result();
 	}
 	function getPrice($itemid)
 	{
 		return $this->db->query("SELECT * FROM tbl_item WHERE p_name = '$itemid' ")->row();
 	}
 	function cut_stock($name,$qty)
 	{
 		$all = $this->db->query(" SELECT * FROM tbl_item WHERE p_name = '$name' ")->row();
 		if(!empty($all))
 		{
 			if($qty > $all->qty)
	 		{
	 			return false;
	 		}else{
	 			$this->db->query("UPDATE tbl_item SET qty = (qty - '$qty') WHERE p_name = '$name' ");
	 			return true;
	 		}

 		}
 	}
 	function get_extra_item($cid)
 	{
 		return $this->db->query("SELECT *, cd.qty as dqty, cd.item_name as d_name, cd.price as dprice
 			              FROM tbl_checkin_detail cd 
 						  LEFT JOIN tbl_item i 
 						  ON cd.item_name = i.p_name
 						  WHERE cd.checkin_id = '$cid' AND item_name <> 'staying' AND is_pay = 0
 						  ORDER BY  cd.detail_id DESC
 						 ")->result();
 	}
 	function return_stock($did, $qty, $name)
 	{
 		$defaul_qty = $this->db->query("SELECT * FROM tbl_checkin_detail WHERE detail_id = '$did' AND item_name ='$name' ")->row();
 		if(!empty($defaul_qty))
 		{
 			if($qty < $defaul_qty->qty)
	 		{
	 			$toqty = $defaul_qty->qty - $qty;
	 			$set  = "qty = (qty + '$toqty')";

	 		}else{
	 			$passqty = $qty - $defaul_qty->qty;
	 			$set = "qty = (qty - '$passqty')";

	 		}
	 		$this->db->query("UPDATE tbl_item SET {$set} WHERE p_name = '$defaul_qty->item_name' ");
 		}else{
 			$this->db->query("UPDATE tbl_item SET qty = (qty - '$qty') WHERE p_name = '$name' ");
 		}
 		
 	}
 	function returntoDefaul($did,$name)
 	{
 		$returnItem =  $this->db->query("SELECT * FROM tbl_checkin_detail WHERE detail_id = '$did' ")->row();
 		if(!empty($returnItem))
 		{
 			if($name <> $returnItem->item_name)
	 		{
	 			$this->db->query("UPDATE tbl_item SET qty = (qty + '$returnItem->qty') WHERE p_name = '$returnItem->item_name' ");
	 		}
 		}
 	}
 	function returnStockDelete($id,$name,$qty)
 	{
 		$this->db->query("UPDATE tbl_item SET qty = (qty + '$qty') WHERE p_name = '$name' ");
 	}

 	function get_roomtype_single($id) {
		$this->db->where('id', $id);
		return $this->db->get('tbl_roomtype')->row();
	}

	function get_card_data($id){
		$this->db->select('tbl_checkin.date_in,tbl_checkin.date_out,tbl_room.room_no');
        $this->db->from('tbl_checkin');
        $this->db->join('tbl_room','tbl_room.id=tbl_checkin.room_no','right');
        $this->db->where('tbl_checkin.id',$id);
        $data=$this->db->get();
        return $data->row();
        // var_dump($data);die();
	}

	function get_card_data_id(){
		$this->db->select('tbl_checkin.date_in,tbl_checkin.date_out,tbl_room.room_no');
        $this->db->from('tbl_checkin');
        $this->db->join('tbl_room','tbl_room.id=tbl_checkin.room_no','right');
        $this->db->where('tbl_checkin.id',$id);
        $data=$this->db->get();
        return $data->row();
	}
	function payment($payment_data=null,$payment_detail_data){
		$payment_id ='';
		if($payment_data){
			$this->db->insert('tbl_payments', $payment_data);
	    	$payment_id = $this->db->insert_id();
		}
		if($payment_detail_data){
			$i=0;
			foreach ($payment_detail_data as $value) {
				$payment_detail_data[$i]['payment_id'] = $payment_id;
				$i++;
			}
			// var_dump($payment_detail_data);die;
			$this->db->insert_batch('tbl_payment_detail',$payment_detail_data);
		}
	}
	public function getAllbanks(){
		$query = $this->db->get('tbl_bank');
		return $query->result();
	}
}
?>