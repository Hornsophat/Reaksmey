<?php 
class Checkout_model extends CI_Model {
 
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
    public function get_checkout_by_id($id)
    {
		$this->db->select('*');
	        $this->db->select('tbl_customer.family as family');
		$this->db->select('tbl_customer.Passport as Passport');
		$this->db->select('tbl_customer.Gender as Gender');
		$this->db->select('tbl_room.room_no as room_number');
		$this->db->select('tbl_roomtype.price as price');
		
		$this->db->from('tbl_checkin');
		
		$this->db->join('tbl_customer', 'tbl_checkin.customer_id = tbl_customer.id ', 'left');
		$this->db->join('tbl_room', 'tbl_checkin.room_no = tbl_room.id ', 'left');
		$this->db->join('tbl_roomtype', 'tbl_room.type_id = tbl_roomtype.id ', 'left');
		
		$this->db->where('tbl_checkin.id', $id);
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
    public function get_checkout($search_string=null, $order=null, $order_type='DESC', $limit_start=null, $limit_end=null)
    {
	    
		$this->db->select('tbl_checkin.*');
		//$this->db->select('tbl_checkin.id as chid');
        $this->db->select('tbl_customer.id as cid');
        $this->db->select('tbl_customer.family as customer_id');
        $this->db->select('tbl_room.room_no as room_no');
        $this->db->select('tbl_roomtype.type as room_type');
        $this->db->select('tbl_staying.time as checkin_type');

		$this->db->from('tbl_checkin');
		$this->db->join('tbl_customer', 'tbl_checkin.customer_id = tbl_customer.id','left');
        $this->db->join('tbl_room', 'tbl_room.id=tbl_checkin.room_no', 'left');
        $this->db->join('tbl_roomtype', 'tbl_roomtype.id=tbl_room.type_id', 'left');
        $this->db->join('tbl_staying', 'tbl_staying.id=tbl_checkin.checkin_type', 'left');

		$this->db->where('tbl_checkin.checkouted',1);
        $this->db->where('tbl_checkin.eject',1);
        if($search_string != null) {
            $this->db->like('tbl_customer.family', $search_string);
        }
		$this->db->group_by('tbl_checkin.id');

		if($order){
			$this->db->order_by($order, $order_type);
		}else{
		    $this->db->order_by('tbl_checkin.id', $order_type);
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
    function count_checkout($search_string=null, $order=null)
    {
		$this->db->select('tbl_checkin.*');
		$this->db->from('tbl_checkin');
        $this->db->join('tbl_customer', 'tbl_checkin.customer_id = tbl_customer.id','left');
		if($search_string){
			$this->db->like('tbl_customer.family', $search_string);
		}
		$this->db->where('checkouted',1);
        $this->db->where('tbl_checkin.eject',1);
		if($order){
			$this->db->order_by($order, 'Asc');
		}else{
		    $this->db->order_by('id', 'DESC');
		}
		$query = $this->db->get();
		return $query->num_rows();        
    }
    
    
    

    /**
    * Store the new item into the database
    * @param array $data - associative array with data to store
    * @return boolean 
    */
    
    function get_roomno ($id)
    {
      
		$this->db->select('room_no');
		$this->db->from('tbl_checkin');
		$this->db->where('id' , $id);
		$query = $this->db->get();
		
		return $query->result_array(); 

    }
    
    function free_room($room_no)
    {
	   $busy_room = array(
           'status' => '0'
           );
            
           $this->db->where('id' , $room_no);
           $this->db->update('tbl_room', $busy_room);

    }
    
    public function get_fields()
    {
    
    $fields = $this->db->list_fields('tbl_checkin');
    return $fields ; 
    }
    
    function checkout($id)
    {
        $ch_d=date('Y-m-d H:i:s');
	    $user = $this->session->userdata('user_name');
    	$data = array(
           'checkouted' => '1',
           'time' => '' , 
	       'user' => $user ,
           // 'date_out' => $ch_d,
           );
		$this->db->where('id', $id);
		$this->db->update('tbl_checkin', $data);
		$report = array();
		$report['error'] = $this->db->_error_number();
		$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	
	function checkout_report()
    {
        $this->db->select('ck.*, cu.family, ro.room_no, rot.type, sty.time');
        $this->db->from('tbl_checkin ck');
        $this->db->join('tbl_room ro', 'ck.room_no = ro.id', 'left');
        $this->db->join('tbl_roomtype rot', 'ro.type_id = rot.id', 'left');
        $this->db->join('tbl_customer cu', 'ck.customer_id = cu.id');
        $this->db->join('tbl_staying sty', 'ck.checkin_type = sty.id');

        $this->db->where('ck.checkouted', 1);
        $this->db->order_by('ck.id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    function today_checkout()
    {
		$today = date('Y-m-d', time());
		
		$this->db->select('ck.*, cu.family, ro.room_no, rot.type, sty.time,ckd.amount');
        $this->db->from('tbl_checkin ck');
        $this->db->join('tbl_checkin_detail ckd','ck.id = ckd.checkin_id');
        $this->db->join('tbl_room ro', 'ck.room_no = ro.id', 'left');
        $this->db->join('tbl_roomtype rot', 'ro.type_id = rot.id', 'left');
        $this->db->join('tbl_customer cu', 'ck.customer_id = cu.id');
        $this->db->join('tbl_staying sty', 'ck.checkin_type = sty.id');
		
		$this->db->where('checkouted', 1);
        $this->db->like('ck.date_out', $today);
		
		$query = $this->db->get();
		return $query->result();
    }
    
    function last_week_checkout($date_out,$last_date,$first_date)
    {
		// $today = date('Y-m-d', time());  
		// $last_week = date('Y-m-d', time()-(7*86400)) ;  
		



        
		$this->db->select('ck.*, cu.family, ro.room_no, rot.type, sty.time,ckd.amount,ckd.overtime');
        $this->db->from('tbl_checkin ck');
        $this->db->join('tbl_checkin_detail ckd','ckd.checkin_id = ck.id');
        $this->db->join('tbl_room ro', 'ck.room_no = ro.id', 'left');
        $this->db->join('tbl_roomtype rot', 'ro.type_id = rot.id', 'left');
        $this->db->join('tbl_customer cu', 'ck.customer_id = cu.id');
        $this->db->join('tbl_staying sty', 'ck.checkin_type = sty.id');
		
		// $this->db->where('ck.date_out >= ',  $last_week);
		// $this->db->where('ck.checkouted', 1);
        $this->db->order_by('ck.id', 'DESC');
		if($first_date!='' && $last_date!=''){
            $this->db->where('date_out >= ',$first_date);

            $this->db->where('date_out <= ',$last_date);
        }else{
            $this->db->where('date_format(date_out ," %Y-%m-%d ")',$date_out);
        }
		$query = $this->db->get();
		// return $query->result_array();
        return $query->result();
    }
     function get_amount_income($first_date,$last_date){
        if($first_date!='' AND $last_date!=''){
            $where .= "AND DATE(pay.date) >= '$first_date' AND DATE(pay.date) <= '$last_date'";
        }
        return $this->db->query("SELECT SUM(pay_detail.amount) as tmount
            ,SUM(chdetail.refun_amount) as refun
                                FROM
                                    tbl_payment_detail pay_detail
                                INNER JOIN tbl_payments pay ON pay_detail.payment_id = pay.id
                                LEFT JOIN tbl_checkin checkin ON checkin.id = pay.checkin_id
                                LEFT JOIN tbl_checkin_detail chdetail ON chdetail.detail_id=pay_detail.checkindetail_id
                                LEFT JOIN tbl_customer cus ON checkin.customer_id = cus.id
                                LEFT JOIN tbl_reservation reserva ON pay.reserva_id = reserva.id
                                LEFT JOIN tbl_customer cus_re ON reserva.Customer_id = cus_re.id
                                WHERE 1 = 1 AND (canceled = 0 OR canceled IS NULL)  {$where}")->result();
    }
    function get_amount_expend($first_date,$last_date){
        return $this->db->query("SELECT sum(amount) as emount 
                            from tbl_expense
                            WHERE date >= '$first_date'  
                            AND date <= '$last_date'")->result();
    }

    function load_item($id)
    {
    // {
    //     $Rest = $this->load->database('rest', TRUE);

    	$room = $this->db->query("SELECT * FROM tbl_checkin_detail WHERE checkin_id = '$id' ")->result();
        // $pos_products = $Rest->query("SELECT si.* FROM sma_sales s
        //                                 INNER JOIN sma_sale_items si ON s.id = si.sale_id
        //                                 LEFT JOIN sma_companies c ON s.customer_id = c.id
        //                                 WHERE c.cusHotel_id = '$customer_id'
        //                                 ")->result();
        // $sales = $Rest->query("SELECT s.* FROM sma_sales s
        //                                 WHERE s.hotel_checkin_id = '$id' AND s.payment_status = 'due'
        //                                 ")->result();


        $result =[
            'room'=>$room,
            'sales' => $sales
        ];

        return $result;

    }
    function getCustomer()
    {
    	return $this->db->query("SELECT * FROM tbl_customer ")->result();
    }
    function load_customer_name($cid)
    {
    	return $this->db->query("SELECT * FROM tbl_customer where id = '$cid' ")->row();
    }
    function load_item_all($id)
    {
    	$where=' AND';
    	for ($i=0; $i < count($id) ; $i++) { 
    		if($i!=0){
    			$where.=' OR ';
    		}
    		$where.=" checkin_id='".$id[$i]."'";
    	}
    	//echo $where;
    	return $this->db->query("SELECT * FROM tbl_checkin_detail WHERE 1=1 {$where}")->result();

        //print_r($a); die();
    }
    
    function check_time($checkin_id)
    {
        return $this->db->query("SELECT * FROM tbl_checkin_detail WHERE checkin_id = '$checkin_id' ")->row();
    }
    function checkout_all($id)
    {
        $ch_dat=date('Y-m-d H:i');
        $where='';
        for ($i=0; $i < count($id) ; $i++) { 
            if($i!=0){
                $where.=' OR ';
            }
            $where.=" id='".$id[$i]."'";
        }

        $user = $this->session->userdata('user_name');
        $data = array(
           'checkouted' => '1',
           'time' => '' , 
           'user' => $user ,
           'date_out' => $ch_dat,
           );

        $this->db->where('('.$where.')');
        $this->db->update('tbl_checkin', $data);
        $report = array();
        $report['error'] = $this->db->_error_number();
        $report['message'] = $this->db->_error_message();
        if($report !== 0){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    function paytime($id)
    {
        return $this->db->query("SELECT * FROM tbl_checkin WHERE id = '$id' ")->row();
    }
    function getrealprice($rid) 
    {
        return $this->db->query("SELECT * FROM tbl_room r
                                 INNER JOIN tbl_roomtype rt
                                 ON (r.type_id = rt.id)
                                 WHERE r.id = '$rid'
                                 ")->row();
    }
    function getUser()
    {
        return $this->db->query("SELECT * FROM tbl_employee WHERE type <> 2")->result();
    }
    function getUser_byID($id)
    {
        return $this->db->query("SELECT * FROM tbl_employee WHERE id = '$id' ")->row();
    }
    public function get_room_no_by_checkin_id($checkin){
        $data = $this->db->query("SELECT room_no FROM tbl_checkin_detail WHERE checkin_id = '$checkin' AND room_id IS NOT NULL")->result();
        $room_no = [];
        foreach ($data as  $value) {
           $room_no[] = $value->room_no;
        }
        return implode(', ', $room_no);

    }
    public function get_room_type_by_checkin_id($checkin){
        $data = $this->db->query("SELECT
                                        chek_d.room_id,
                                        room_type.type
                                FROM
                                    tbl_checkin_detail chek_d
                                INNER JOIN tbl_room room ON chek_d.room_id = room.id
                                INNER JOIN tbl_roomtype room_type ON room.type_id = room_type.id
                                WHERE
                                    chek_d.checkin_id = '$checkin'
                                AND chek_d.room_id IS NOT NULL
                                GROUP BY room.type_id")->result();
        $type = [];
        foreach ($data as  $value) {
           $type[] = $value->type;
        }
        return implode(', ', $type);
    }
}
?>
