<?php
class Room_model extends CI_Model {
 
    /**
    * Responsable for auto load the database
    * @return void
    */
    public function __construct()
    {
        $this->load->database();
    }

    /**
    * Get room by his is
    * @param int $room_id 
    * @return array
    */
    public function get_room_by_id($id)
    {
		$this->db->select('*');
		$this->db->from('tbl_room');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
    
    public function get_room($search_string=null, $order=null, $order_type='Asc', $limit_start=null, $limit_end=null)
    {
	    
		$this->db->select('tbl_room.*');
		$this->db->select('tbl_roomtype.type as type_id');
		
		$this->db->from('tbl_room');
		
		$this->db->join('tbl_roomtype', 'tbl_room.type_id = tbl_roomtype.id ', 'left');

		if($search_string){
			$this->db->like('tbl_room.room_no', $search_string);
		}
		$this->db->group_by('tbl_room.id');

		if($order){
			$this->db->order_by('tbl_room.'.$order, $order_type);
		}else{
		    $this->db->order_by('tbl_room.id', $order_type);
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
    function count_room($search_string=null, $order=null)
    {
		$this->db->select('*');
		$this->db->from('tbl_room');
		if($search_string){
			$this->db->like('room_no', $search_string);
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
    function store_room($data)
    {
            $insert = $this->db->insert('tbl_room', $data);
	    return $insert;
	}

    /**
    * Update room
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_room($id, $data)
    {
		$this->db->where('id', $id);
		$this->db->update('tbl_room', $data);
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
    * Delete roomr
    * @param int $id - room id
    * @return boolean
    */
	function delete_room($id){
		$this->db->where('id', $id);
		$this->db->delete('tbl_room'); 
	}

    function get_by_type($type)
    {
		
		$this->db->select('tbl_room.id');
		$this->db->select('room_no');
		$this->db->from('tbl_room');
		$this->db->join('tbl_roomtype', 'tbl_room.type_id = tbl_roomtype.id ', 'left');
		$this->db->where('type_id', $type);
		$this->db->where('status = 0 ');
		$this->db->order_by('tbl_room.id',DESC);
		$query = $this->db->get();
		return $query->result_array(); 	
	}
	function get_by_type_resullt($type,$reserva_room_id=null){
		$this->db->select('tbl_room.id');
		$this->db->select('room_no');
		$this->db->from('tbl_room');
		$this->db->join('tbl_roomtype', 'tbl_room.type_id = tbl_roomtype.id ', 'left');
		$this->db->where('type_id', $type);
		if($reserva_room_id){
			$this->db->where_not_in('tbl_room.id', $reserva_room_id);
		}
		// $this->db->where('status = 0 ');
		$this->db->order_by('tbl_room.room_no','ASC');
		$query = $this->db->get();
		return $query->result();
	}
	 function get_room_no_id($room_multi)
	 {
		$sql = $this->db->query("SELECT tr.id as room_id ,trt.id as roomType_id,trt.price,tr.room_no,tr.floor,ts.id as stayingid,ts.time,ts.price as staying_price,trt.type,ts.price_weekend,ts.price_cereymony
								FROM tbl_room tr 
								LEFT JOIN tbl_roomtype trt ON tr.type_id = trt.id
								LEFT JOIN tbl_staying ts ON ts.roomtype_id = trt.id
								WHERE tr.id = '".$room_multi."'")->result();
		// var_dump($sql);die();
		return $sql;
	}
	public function get_roomdetail_by_id($room_id=''){
		$sql = $this->db->query("SELECT tr.id as room_id ,trt.id as roomType_id,trt.price,tr.room_no,tr.floor,ts.id as stayingid,ts.time,ts.price as staying_price,trt.type,ts.price_weekend,ts.price_cereymony
								FROM tbl_room tr 
								LEFT JOIN tbl_roomtype trt ON tr.type_id = trt.id
								LEFT JOIN tbl_staying ts ON ts.roomtype_id = trt.id
								WHERE tr.id = '".$room_id."'")->row();
		// var_dump($sql);die();
		return $sql;
	}
	public function get_room_type($type)
	{
		$this->db->select('tbl_room.id');
		$this->db->select('room_no');
		$this->db->from('tbl_room');
		$this->db->join('tbl_roomtype', 'tbl_room.type_id = tbl_roomtype.id ', 'left');
		$this->db->where('type_id', $type);
		$query = $this->db->get();

		return $query->result_array(); 
	}
	
    public function get_fields()
    
    {
    
    $fields = $this->db->list_fields('tbl_room');
    return $fields ; 
    }

    public function room_report()
    {
    	$this->db->select('ro.*, rot.type');
    	$this->db->from('tbl_room ro');
    	$this->db->join('tbl_roomtype rot', 'ro.type_id = rot.id');

    	$query = $this->db->get();
    	return $query->result();
    }

    public function free_room_report() {
    	$this->db->select('ro.*, rot.type');

		$this->db->from('tbl_room ro');
		$this->db->join('tbl_roomtype rot', 'rot.id = ro.type_id');

		$this->db->where('ro.status', 0);
		$this->db->order_by('ro.id');

		$query = $this->db->get();
		return $query->result();
    }

    public function busy_room_report() {
    	// $this->db->select('ro.*, rot.type');
		
		// $this->db->from('tbl_room ro');
		// $this->db->join('tbl_roomtype rot', 'rot.id = ro.type_id');

		// $this->db->where('ro.status', 1);
		// $this->db->order_by('ro.id');

		// $query = $this->db->get();
        $date = date('Y-m-d');
        $query = $this->db->query("SELECT * FROM tbl_checkin LEFT JOIN tbl_checkin_detail
            ON tbl_checkin.id=tbl_checkin_detail. checkin_id 
            LEFT JOIN tbl_roomtype
            ON tbl_checkin_detail.room_type=tbl_roomtype.id
            WHERE date_in>='$date'
            ");
		return $query->result();
    }

    /**
    * Get free room 
    * @return array
    */
    public function get_free_room()
    {
		$this->db->select('ro.*, rot.type');

		$this->db->from('tbl_room ro');
		$this->db->join('tbl_roomtype rot', 'rot.id = ro.type_id');

		$this->db->where('ro.status', 0);
		$this->db->order_by('ro.id');

		$query = $this->db->get();
		return $query->result_array(); 
    }   
    
    public function get_busy_room()
    {
		$this->db->select('ro.*, rot.type');
		
		$this->db->from('tbl_room ro');
		$this->db->join('tbl_roomtype rot', 'rot.id = ro.type_id');

		$this->db->where('ro.status', 1);
		$this->db->order_by('ro.id');

		$query = $this->db->get();
		return $query->result_array(); 
    }   

  //   function get_unpay_by_user($user, $search_string)
  //   {
  //   	return $this->db->query(
  //   		"SELECT cu.family, ck.checkouted, ck.date_in, ck.date_out, ck.checkin_type, ck.pay, rot.type, ro.room_no, ckd.amount, sty.time, ck.`user`, ckd.`current_date`
		// 	FROM tbl_checkin ck
		// 	INNER JOIN tbl_checkin_detail ckd ON ck.id = ckd.checkin_id
		// 	LEFT JOIN tbl_customer cu ON ck.customer_id = cu.id
		// 	LEFT JOIN tbl_room ro ON ck.room_no = ro.id
		// 	INNER JOIN tbl_roomtype rot ON ro.type_id = rot.id 
		// 	INNER JOIN tbl_staying sty ON sty.id = ck.checkin_type
		// 	WHERE ck.`user` = '$user' AND ck.`pay` = 'unpay' AND ck.`eject` = '1' 
		// 	ORDER BY ck.`id` DESC"
		// )->result();
  //   }

    function get_unpay($search=null, $start=null, $end=null)
    {
  //   	return $this->db->query(
  //   		"SELECT cu.family, ck.checkouted, ck.date_in, ck.date_out, ck.checkin_type, ck.pay, rot.type, ro.room_no, ckd.amount, sty.time, ck.`user`, ckd.`current_date`
		// 	FROM tbl_checkin ck
		// 	INNER JOIN tbl_checkin_detail ckd ON ck.id = ckd.checkin_id
		// 	LEFT JOIN tbl_customer cu ON ck.customer_id = cu.id
		// 	LEFT JOIN tbl_room ro ON ck.room_no = ro.id
		// 	INNER JOIN tbl_roomtype rot ON ro.type_id = rot.id 
		// 	INNER JOIN tbl_staying sty ON sty.id = ck.checkin_type
		// 	WHERE ck.`pay` = 'unpay' AND ck.`eject` = '1' 
		// 	ORDER BY ck.`id` DESC" 
		// )->result();

    	$this->db->select('cu.family, ck.checkouted, ck.date_in, ck.date_out, ck.checkin_type, ck.pay, rot.type, ro.room_no, ckd.amount, sty.time, ck.user, ckd.current_date');
    	$this->db->from('tbl_checkin ck');
    	$this->db->join('tbl_checkin_detail ckd', 'ck.id = ckd.checkin_id');
    	$this->db->join('tbl_customer cu', 'ck.customer_id = cu.id', 'left');
    	$this->db->join('tbl_room ro', 'ck.room_no = ro.id', 'left');
    	$this->db->join('tbl_roomtype rot', 'ro.type_id = rot.id');
    	$this->db->join('tbl_staying sty', 'sty.id = ck.checkin_type');

    	$this->db->where('ck.pay', 'unpay');
    	$this->db->where('ck.eject', 1);

    	if($search != NULL) {
    		$this->db->where('ck.customer_id', $search);
    	}
    	if($start != NULL) {
    		$this->db->where('ckd.date_order >= ', $start);
    	}
    	if($end != NULL) {
    		$this->db->where('ckd.date_order <= ', $end);
    	}

    	$this->db->order_by('ck.id', 'DESC');
    	$query = $this->db->get();
		return $query->result();
    }

    function get_fields_daily($user)
    {
    	$date = date('Y-m-d');

    	return $this->db->query("SELECT
								cu.family,
								ck.date_in,
								ck.date_out,
								ck.checkin_type,
								ck.pay,
							    rot.type,
								ro.room_no,
								ckd.amount,
								sty.time,
								ck.`user`,
							    ckd.`current_date`
							FROM
								tbl_checkin ck
							INNER JOIN tbl_checkin_detail ckd ON ck.id = ckd.checkin_id
							LEFT JOIN tbl_customer cu ON ck.customer_id = cu.id
							LEFT JOIN tbl_room ro ON ck.room_no = ro.id
							INNER JOIN tbl_roomtype rot ON ro.type_id = rot.id 
							INNER JOIN tbl_staying sty ON sty.id = ck.checkin_type
							WHERE
								ck.`user` = '$user'
							AND ckd.`current_date` = '$date' 
							ORDER BY ck.`id` DESC
							")->result();
    }

    function get_daily_report() {
    	$date = date('Y-m-d');
    	$sql = "SELECT cu.family, ck.date_in, ck.date_out, ck.checkin_type, ck.pay, rot.type, ro.room_no, ckd.amount, sty.time, ck.user, ckd.current_date
				FROM tbl_checkin ck
				INNER JOIN tbl_checkin_detail ckd ON ck.id = ckd.checkin_id
				LEFT JOIN tbl_customer cu ON ck.customer_id = cu.id
				LEFT JOIN tbl_room ro ON ck.room_no = ro.id
				INNER JOIN tbl_roomtype rot ON ro.type_id = rot.id 
				INNER JOIN tbl_staying sty ON sty.id = ck.checkin_type
				WHERE ckd.`current_date` = '$date' 
				ORDER BY ck.`id` DESC";
    	return $this->db->query($sql)->result();
    }

    function check_available_room($room_no='',$date_in=''){
        $date_in = date('Y-m-d',strtotime($date_in));
        $date_ins = date('Y-m-d',strtotime($date_in. ' -1hour'));
        $date=date('Y-m-d H:i:s');
        $data = $this->db->query("SELECT reserva.*,reserva.checkin_data AS date_in,reserva.checkout_data AS date_out
                                    FROM tbl_reservation reserva 
                                    LEFT JOIN tbl_multireservation mul_re ON reserva.id = mul_re.reserv_id
                                    WHERE reserva.canceled = 0 AND reserva.confirmed = 0
                                    AND 
                                    (
                                     reserva.room_id = '$room_no' 
                                      OR mul_re.room_id = '$room_no' 
                                    )
                                    AND DATE(reserva.checkin_data) <= '$date_in' 
                                    AND DATE(DATE_SUB(reserva.checkout_data, INTERVAL 1 DAY)) >= '$date_in'
                                    GROUP BY reserva.id")->row();
        if($data){
            return $data;
        }

        $data = $this->db->query("SELECT
                                            checkin.*,
                                            check_detail.room_id,check_detail.date_out AS room_checkout
                                        FROM
                                            tbl_checkin checkin
                                    INNER JOIN tbl_checkin_detail check_detail ON checkin.id = check_detail.checkin_id 
                                    WHERE  check_detail.room_id LIKE '%".$room_no."%'
                                    AND DATE(checkin.date_in) <= '$date_in' 
                                    AND DATE(DATE_SUB(checkin.date_out, INTERVAL 1 HOUR)) >= '$date_in'")->row();
        return $data;
    }
    function getPriceByDay($date=null,$duration='',$r_type='',$rtypeIds=''){

        $date = $date;
        $duration = $duration;
        $r_type = $r_type;
        $rtypeIds = $rtypeIds;

        $checkin = [];
        $weekend = [];
        $hdays = [];
        for ($i=0; $i < $duration ; $i++) { 

            $checkin_days[] = date('Y-m-d', strtotime($date. ' + '.$i.' days'));

            $current_day = date('D', strtotime($date. ' + '.$i.' days'));

            if ($current_day == "Fri" || $current_day == "Sat" || $current_day == "Sun") {

                $weekend[] = date('Y-m-d', strtotime($date. ' + '.$i.' days'));
                
            }else{

                $checkin[] = date('Y-m-d', strtotime($date. ' + '.$i.' days'));

            }
            

        }
        if($date){
            $date = date('Y-m-d',strtotime($date));
        }
        $start_date = $date;
        $end_date = date('Y-m-d',strtotime($date.' +'.($duration - 1).'day'));

        $holidays = $this->db->query("SELECT DATE(`date`) as holiday FROM tbl_holiday WHERE DATE(`date`) BETWEEN '$start_date' AND '$end_date'")->result();
        $checkin_fl = array_flip($checkin);
        $weekend_fl = array_flip($weekend);
        
        foreach ($holidays as $holiday) {
            $hdays[] = $holiday->holiday;
            if (isset($checkin_fl[$holiday->holiday])) {
                unset($checkin_fl[$holiday->holiday]);
            }
            if (isset($weekend_fl[$holiday->holiday])) {
                unset($weekend_fl[$holiday->holiday]);
            }

        }
        $checkin = array_flip($checkin_fl);
        $weekend = array_flip($weekend_fl);



        $data["date_normal"] = $checkin;
        $data["date_weekend"] = $weekend;
        $data["date_holiday"] = $hdays;



        $type_price = $this->db->query("SELECT * FROM tbl_staying WHERE roomtype_id ='".$r_type."'")->row();


        $total_price = ($type_price->price * count($checkin)) + 
                        ($type_price->price_weekend * count($weekend)) + 
                        ($type_price->price_cereymony * count($hdays));

        // var_dump($checkin_days);
        // MULTI
        if ($rtypeIds) {
            $rtype = array_unique($rtypeIds);

            $type_price = $this->db->query("SELECT * FROM tbl_staying WHERE roomtype_id IN(".implode(',', $rtype).")")->result();

            $count_rtype = array_count_values($rtypeIds);
            $room_type_total = 0;
            foreach ($type_price as $price) {
                $sub_total_price = ($price->price * count($checkin)) + 
                        ($price->price_weekend * count($weekend)) + 
                        ($price->price_cereymony * count($hdays));


                $room_type_total += $sub_total_price * $count_rtype[$price->roomtype_id];
            }


            $total_price = $room_type_total;
        }

        $price_arr = [];
        foreach ($checkin_days as $key => $value) {
            if (in_array($value, $data['date_normal'])) {
                $price_arr[] = ($type_price->price * 1);
            }
            if (in_array($value, $data['date_weekend'])) {
                $price_arr[] = ($type_price->price_weekend * 1);
            }
            if (in_array($value, $data['date_holiday'])) {
                $price_arr[] = ($type_price->price_cereymony * 1);
            }
        }

        $price_arr = implode(",", $price_arr);
       
                       
        $datas = [
        		'data' => $price_arr,
        		'total' => $total_price
        	];
        return $datas;
      

	}
	
	function getAllPrice($r_type='',$staying_time =''){

        $time = $this->db->query("SELECT * FROM tbl_staying WHERE roomtype_id ='".$r_type."' and id ='".$staying_time."' ")->row();
		$price_month = $time->price_month;
		$price = $time->price;
		$price_weekend = $time->price_weekend;
		$price_ceremony = $time->price_ceremony;
		$month = $time->time;
		$data = [
			'price'=>$price,
			'price_weekend'=>$price_weekend,
			'price_ceremony'=>$price_ceremony,
			'price_month'=>$price_month,
			'time'=>$month
		];
        return $data;
    
    }
 
}
?>