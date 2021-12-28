<?php


class Admin_report extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('customer_model');
        $this->load->model('checkin_model');
        $this->load->model('checkout_model');
        $this->load->model('room_model');
        $this->load->model('roomtype_model');
        
        //Load language Content 
        $this->load->helper('language');
        $this->lang->load("content", $this->session->userdata('language'));
        

        if(!$this->session->userdata('is_logged_in')){
            redirect('admin/login');
        }
    }
    
    
	function index()
	{
		if($this->session->userdata('is_logged_in')){
			redirect('admin/dashboard/');
        }else{
        	$this->load->view('admin/login');	
        }
	}
	
	function  room_report()
	{
		// $data['fields'] = $this->room_model->get_fields();
		$data['data']  = $this->room_model->room_report();
		
		$data['main_content'] = 'admin/report/room';
        $this->load->view('includes/template', $data);
	}
	
	function  free_room()
	{
		// $data['fields'] = $this->room_model->get_fields();
		$data['data']  = $this->room_model->free_room_report();
		
		$data['main_content'] = 'admin/report/room';
        $this->load->view('includes/template', $data);
	}
	
	function  busy_room()
	{
		// $data['fields'] = $this->room_model->get_fields();
		$data['data']  = $this->room_model->busy_room_report();
		
		$data['main_content'] = 'admin/report/room';
        $this->load->view('includes/template', $data);
	}

	function customer_report()
	{
		$data['fields'] = $this->customer_model->get_fields();
		$data['data']  = $this->customer_model->get_customer_report();
		
		
		$data['main_content'] = 'admin/report/customer';
        $this->load->view('includes/template', $data); 
	}

	function daily()
	{
		$from_date = $this->input->get('from_date');
		$to_date = $this->input->get('to_date');
		$type = $this->input->get('type');
		$from_date = $from_date?$from_date:date('Y-m-d');
		$to_date = $to_date?$to_date:date('Y-m-d ');
		$where = "";
		if($from_date && $to_date){
			$where .= "AND DATE(pay.date) >= '$from_date' AND DATE(pay.date) <= '$to_date'";
		}
		if($type){
			if($type == 'hotel'){
				$where .= "AND pay_detail.status <> 'pos_sale'";
			}
			if($type == 'restaurant'){
				$where .= "AND pay_detail.status = 'pos_sale'";
			}
		}
		$data = $this->db->query("SELECT
									pay_detail.*, pay.date,
									pay.user_name,
									pay.grand_total,
									checkin.date_in,
									checkin.date_out,
									checkin.price,
									cus.Family,
									reserva.canceled,
									cus.Mobile,
									cus_re.Family AS re_family,
									cus_re.Mobile AS re_mobile,
									pay.id AS pay_id,
									reserva.create_by as reserva_by,
									reserva.checkin_data,
									pay.reserva_id,
									chdetail.refun_amount,
									checkin.deposit as deposit	
								FROM
									tbl_payment_detail pay_detail
								INNER JOIN tbl_payments pay ON pay_detail.payment_id = pay.id
								LEFT JOIN tbl_checkin checkin ON checkin.id = pay.checkin_id
								LEFT JOIN tbl_checkin_detail chdetail ON chdetail.detail_id=pay_detail.checkindetail_id
								LEFT JOIN tbl_customer cus ON checkin.customer_id = cus.id
								LEFT JOIN tbl_reservation reserva ON pay.reserva_id = reserva.id
								LEFT JOIN tbl_customer cus_re ON reserva.Customer_id = cus_re.id
								WHERE 1 = 1 AND (canceled = 0 OR canceled IS NULL)  {$where}  ORDER BY pay.id ASC ")->result();

		$data_table ="";

		$total_sale = 0;
		$total_extra = 0;
		$extra_item = 0;
		$total_room = 0;
		$total = 0;
		$data_table .='<tbody>';
		$i= 1;
		// foreach ($data as $row) {
			
		// 	$data_table .='<tr>';


		// 		$data_table .='<td style="text-align:center;">'.$i++.'</td>';
		// 		$data_table .='<td>'.date('d-m-Y',strtotime($row->date_in)).'</td>';
		// 		$data_table .='<td>'.$row->Family.'</td>';
		// 		$data_table .='<td>'.$row->Mobile.'</td>';
		// 		$data_table .='<td>'.date('d-m-Y',strtotime($row->date)).'</td>';
		// 		$data_table .='<td>'.$row->item_name.'</td>';
		// 		$data_table .='<td class="text-right">'.number_format($row->amount,2).'</td>';




		// 	$data_table .='<tr>';
			

		// }
		$pay_id = '';
		$a = 1;
		foreach ($data as $row) {
			$data_table .='<tr>';
				if($pay_id == $row->payment_id){
					$data_table .='<td style="text-align:center;"></td>';
					$data_table .='<td></td>';
					$data_table .='<td></td>';
					$data_table .='<td></td>';
					$data_table .='<td></td>';
					$data_table .='<td></td>';
					$data_table .='<td>'.$row->item_name.'</td>';
					$data_table .='<td>'.$row->qty.'</td>';
					$data_table .='<td style="text-align:right;">'.number_format($row->price,2).'</td>';
					$total +=str_replace(',', '', number_format($row->price,2));
				}else{
					if($row->reserva_id != '' || $row->date_in==''){
						$data_table .='<td style="text-align:center;">'.$a++.'</td>';
						$data_table .='<td>'.date('d-m-Y H:i:s',strtotime($row->date)).'</td>';
						$data_table .='<td>'.$row->re_family.'</td>';
						$data_table .='<td>'.$row->re_mobile.'</td>';
						$data_table .='<td>'.$row->reserva_by.'</td>';
						$data_table .='<td>'.date('d-m-Y H:i:s',strtotime($row->date)).'</td>';
						$data_table .='<td>'.date('d-m-Y ',strtotime($row->date)).'</td>';
						$data_table .='<td>'.$row->item_name.'</td>';
						$data_table .='<td style="text-align:right;">'.number_format($row->amount*(-1),2).'</td>';
						$total +=str_replace(',', '', number_format($row->amount*(-1),2));
					}else{
						$data_table .='<td style="text-align:center;">'.$a++.'</td>';
						$data_table .='<td>'.date('d-m-Y H:i:s',strtotime($row->date)).'</td>';
						$data_table .='<td>'.$row->Family.'</td>';
						$data_table .='<td>'.$row->Mobile.'</td>';
						$data_table .='<td>'.$row->user_name.'</td>';
						$data_table .='<td>'.date('d-m-Y ',strtotime($row->date_in)).'</td>';
						$data_table .='<td>'.$row->item_name.'</td>';
						if ($row->refun_amount>0) {
							$data_table .='<td style="text-align:right;">'.number_format(($row->amount-$row->refun_amount),2).'('.'Refun'.')'.'</td>';
						}else{
						$data_table .='<td style="text-align:right;">'.number_format(($row->amount),2).'</td>';
						}
						
						$total +=str_replace(',', '', number_format(($row->amount-$row->refun_amount),2));
					}
					
				}
			$data_table .='</tr>';
			$pay_id = $row->pay_id;


		}
		$data_table .='<tr>';
			$data_table .='<th colspan="7" style="text-align:right;">Total: </th>';
			$data_table .='<th style="text-align:right;">'.number_format($total,2).'</th>';
		$data_table .='</tr>';

		$data_table .='</tbody>';
		$data['from_date'] = $from_date;
		$data['to_date'] = $to_date;
		$data['type'] = $type;
		$data['main_content'] = 'admin/report/daily';
		$data['data_table'] = $data_table;
 	    $this->load->view('includes/template', $data);
    }

	function unpay_report()
	{
		$search = $this->input->get('search_string');
		$start = $this->input->get('start');
		$end = $this->input->get('end');

		// $user = $this->session->userdata('user_name');
		// $permission = $this->db->where('user_name', $user)->get('tbl_employee')->row();
		// if($permission->type == 1) {
		// 	$data['data'] = $this->room_model->get_unpay($user, $search);
		// } else if($permission->type == 2) {
			if($search) {
				$customer = $this->customer_model->get_customer_id($search);
				$customer_id = $customer->id;
			}
			else { 
				$customer_id = null; 
			}

			$data['data'] = $this->room_model->get_unpay($customer_id, $start, $end);
		// }		

		$data['main_content'] = 'admin/report/unpay';
		$this->load->view('includes/template', $data);
	}

	function  checkin_report()
	{
		// $data['fields'] = $this->checkin_model->get_fields();
		// $data['data']  = $this->checkin_model->get_checkin();
		$data['data']  = $this->checkin_model->checkin_report();
		
		$data['main_content'] = 'admin/report/checkin';
        $this->load->view('includes/template', $data); 	
	}

	function  today_checkin()
	{
		// $data['fields'] = $this->checkin_model->get_fields();
		$data['data']  = $this->checkin_model->today_checkin();
		
		$data['main_content'] = 'admin/report/checkin';
	    $this->load->view('includes/template', $data); 
	}

	function  last_week_checkin()
	{
		$date_in = date("Y-m-d");
        $first_date = $this->input->get('first_date');
        $last_date = $this->input->get('last_date');
		// $data['fields'] = $this->checkin_model->get_fields();
		$data['data']  = $this->checkin_model->last_week_checkin($date_in,$first_date,$last_date);
		// print_r($data['data']);die();
		
		$data['main_content'] = 'admin/report/checkin';
	    $this->load->view('includes/template', $data); 
	}

	function  last_week_checkin_item()
	{
		$date_in = date("Y-m-d");
        $first_date = $this->input->get('first_date');
        $last_date = $this->input->get('last_date');
		// $data['fields'] = $this->checkin_model->get_fields();
		$data['data']  = $this->checkin_model->last_week_checkin($date_in,$first_date,$last_date);
		// print_r($data['data']);die();
		
		$data['main_content'] = 'admin/report/item_report';
	    $this->load->view('includes/template', $data); 
	}

	function checkout_report()
	{	
		// $data['fields'] = $this->checkout_model->get_fields();
		// $data['data']  = $this->checkout_model->get_checkout();
		$data['data'] = $this->checkout_model->checkout_report();
		
		$data['main_content'] = 'admin/report/checkout';
        $this->load->view('includes/template', $data);
	}

	function today_checkout()
	{
		// $data['fields'] = $this->checkout_model->get_fields();
		$data['data']  = $this->checkout_model->today_checkout();
		
		$data['main_content'] = 'admin/report/checkout';
        $this->load->view('includes/template', $data);
	}

	function  last_week_checkout()
	{
		$date_out = date("Y-m-d");

        $from_date = $this->input->get('from_date');
        $to_date = $this->input->get('to_date');
        $from_date = $from_date?$from_date:date('Y-m-d ');
        $to_date = $to_date?$to_date:date('Y-m-d ');

		// $data['fields'] = $this->checkout_model->get_fields();
        $data = $this->db->query("SELECT checkin.*,customer.Family,customer.Mobile 
        						FROM tbl_checkin checkin 
								INNER JOIN tbl_customer customer ON checkin.customer_id = customer.id
								WHERE checkin.checkouted = 1 
								AND DATE(checkin.date_out) >= '$from_date' 
								AND DATE(checkin.date_out) <= '$to_date'
								")->result();
        $data_table ="";
        $discount_usd = 0;
		$total_sale = 0;
		$total_extra = 0;
		$extra_item = 0;
		$total_room = 0;
		$total = 0;
		$total_dicount = 0;
		$total_deposit = 0;
		$total_grand_total = 0;
		$data_table .='<tbody>';
		$i= 1;

		// $data['data']  = $this->checkout_model->last_week_checkout($date_out,$last_date,$first_date);
		

		$pay_id = '';
		$a = 1;
		foreach ($data as $row) {
			$room_no = $this->checkout_model->get_room_no_by_checkin_id($row->id);
            $type = $this->checkout_model->get_room_type_by_checkin_id($row->id);
            $discount_usd = 0;
            $percentage = '%';
            $discount = $row->discount;
            if($row->percent_dis){
                $discount = $row->percent_dis;
            }
            if($discount !='' || $discount > 0){
                $discount_fix =  $discount;
                if (isset($discount_fix)) {
                    $dis_fix = $discount_fix;
                    $dpos = strpos($dis_fix, $percentage);
                    if ($dpos !== false) {
                        $pds = explode("%", $dis_fix);
                        $dicount_text = '('.$row->percent_dis.')';
                        $discount_usd = str_replace(',', '', number_format((($row->total * ((Float)($pds[0])) / 100)),2));
                    } else {
                        $discount_usd = str_replace(',', '', number_format((Float)($discount),2));
                    }
                }
            }


			$data_table .='<tr>';
				$data_table .='<td style="text-align:center;">'.$a++.'</td>';
				$data_table .='<td>'.$row->user.'</td>';
				$data_table .='<td>'.$row->Family.'</td>';
				$data_table .='<td>'.date('d-m-Y H:i:s',strtotime($row->date_in)).'</td>';
				$data_table .='<td>'.date('d-m-Y H:i:s',strtotime($row->date_out)).'</td>';
				$data_table .='<td>'.$type.'</td>';
				$data_table .='<td>'.$room_no.'</td>';
				$data_table .='<td style="text-align:center;">'.$row->staying.'</td>';

				$data_table .='<td style="text-align:right;">'.number_format($row->total,2).'</td>';
				$data_table .='<td style="text-align:right;">'.number_format($discount_usd,2).'</td>';
				$data_table .='<td style="text-align:right;">'.number_format($row->deposit,2).'</td>';
				$data_table .='<td style="text-align:right;">'.number_format($row->extra_charges,2).'</td>';
				$data_table .='<td style="text-align:right;">'.number_format($row->grand_total,2).'</td>';

				$total +=str_replace(',', '', number_format($row->total,2));
				$total_dicount +=str_replace(',', '', number_format($discount_usd,2));
				$total_deposit +=str_replace(',', '', number_format($row->deposit,2));
				$total_extra +=str_replace(',', '', number_format($row->extra_charges,2));
				$total_grand_total +=str_replace(',', '', number_format($row->grand_total,2));

			$data_table .='</tr>';
			$pay_id = $row->pay_id;


		}
		$data_table .='<tr>';
			$data_table .='<th colspan="8" style="text-align:right;">Total: </th>';
			$data_table .='<th style="text-align:right;">'.number_format($total,2).'</th>';
			$data_table .='<th style="text-align:right;">'.number_format($total_dicount,2).'</th>';
			$data_table .='<th style="text-align:right;">'.number_format($total_deposit,2).'</th>';
			$data_table .='<th style="text-align:right;">'.number_format($total_extra,2).'</th>';
			$data_table .='<th style="text-align:right;">'.number_format($total_grand_total,2).'</th>';
		$data_table .='</tr>';

		$data_table .='</tbody>';
		// var_dump($data['data']);die();
		$data['data_table'] = $data_table;
		$data['from_date'] = $from_date;
		$data['to_date'] = $to_date;
		$data['data']  = $data;
		$data['main_content'] = 'admin/report/checkout';
        $this->load->view('includes/template', $data);
	}
	function profit_report(){
		// echo "hello";
        // var_dump($data['in_amount']);die();
		$data['main_content'] = 'admin/report/profit_report';
 	    $this->load->view('includes/template', $data);
	}
	function get_all_amount_in(){
		$date = date("Y-m-d");
		$first_date = $this->input->get('first_date');
        $last_date = $this->input->get('last_date');

        $data['in_amount'] = $this->checkout_model->get_amount_income($first_date,$last_date);
        $data['ex_amount'] = $this->checkout_model->get_amount_expend($first_date,$last_date);
        // var_dump($data);die();
        $data['main_content'] = 'admin/report/profit_report';
 	    $this->load->view('includes/template', $data);
	}
	function payment_report(){

		$from_date = $this->input->get('from_date');
		$to_date = $this->input->get('to_date');
		$type = $this->input->get('type');
		$from_date = $from_date?$from_date:date('Y-m-d');
		$to_date = $to_date?$to_date:date('Y-m-d ');
		$where = "";
		if($from_date && $to_date){
			$where .= "AND DATE(pay.date) >= '$from_date' AND DATE(pay.date) <= '$to_date'";
		}
		if($type){
			if($type == 'hotel'){
				$where .= "AND pay_detail.status <> 'pos_sale'";
			}
			if($type == 'restaurant'){
				$where .= "AND pay_detail.status = 'pos_sale'";
			}
		}
		$data = $this->db->query("SELECT
									pay_detail.*, pay.date,
									pay.user_name,
									pay.grand_total,
									checkin.date_in,
									checkin.date_out,
									checkin.price,
									chdetail.room_no,
									cus.Family,
									reserva.canceled,
									cus.Mobile,
									cus_re.Family AS re_family,
									cus_re.Mobile AS re_mobile,
									pay.id AS pay_id,
									reserva.create_by as reserva_by,
									reserva.checkin_data,
									pay.reserva_id,
									chdetail.refun_amount,
									chdetail.qty,
									checkin.deposit as deposit	
								FROM
									tbl_payment_detail pay_detail
								INNER JOIN tbl_payments pay ON pay_detail.payment_id = pay.id
								LEFT JOIN tbl_checkin checkin ON checkin.id = pay.checkin_id
								LEFT JOIN tbl_checkin_detail chdetail ON chdetail.detail_id=pay_detail.checkindetail_id
								LEFT JOIN tbl_customer cus ON checkin.customer_id = cus.id
								LEFT JOIN tbl_reservation reserva ON pay.reserva_id = reserva.id
								LEFT JOIN tbl_customer cus_re ON reserva.Customer_id = cus_re.id
								WHERE 1 = 1 AND (canceled = 0 OR canceled IS NULL)  {$where}  ORDER BY pay.id ASC ")->result();

		$data_table ="";

		$total_sale = 0;
		$total_extra = 0;
		$extra_item = 0;
		$total_room = 0;
		$total = 0;
		$data_table .='<tbody>';
		$i= 1;
		// foreach ($data as $row) {
			
		// 	$data_table .='<tr>';


		// 		$data_table .='<td style="text-align:center;">'.$i++.'</td>';
		// 		$data_table .='<td>'.date('d-m-Y',strtotime($row->date_in)).'</td>';
		// 		$data_table .='<td>'.$row->Family.'</td>';
		// 		$data_table .='<td>'.$row->Mobile.'</td>';
		// 		$data_table .='<td>'.date('d-m-Y',strtotime($row->date)).'</td>';
		// 		$data_table .='<td>'.$row->item_name.'</td>';
		// 		$data_table .='<td class="text-right">'.number_format($row->amount,2).'</td>';




		// 	$data_table .='<tr>';
			

		// }
		$pay_id = '';
		$a = 1;
		foreach ($data as $row) {
			$data_table .='<tr>';
				if($row->room_id == Null){
					$data_table .='<td style="text-align:center;"></td>';
					$data_table .='<td></td>';
					$data_table .='<td></td>';
					$data_table .='<td></td>';
					$data_table .='<td></td>';
					$data_table .='<td></td>';
					$data_table .='<td></td>';
					$data_table .='<td></td>';
					$data_table .='<td style="color:red">'.$row->item_name.'</td>';
					$data_table .='<td style="text-align:right;color:red">'.number_format($row->qty,2).'</td>';
					$data_table .='<td style="text-align:right;color:red">'.number_format($row->amount,2).'</td>';
					 $totalitem +=str_replace(',', '', number_format($row->amount,2));
					 $totalqty +=  $row->qty;
				}else{
					if($row->reserva_id != '' || $row->date_in==''){
						// $data_table .='<td style="text-align:center;">'.$a++.'</td>';
						// $data_table .='<td>'.date('d-m-Y H:i:s',strtotime($row->date)).'</td>';
						// $data_table .='<td>'.$row->re_family.'</td>';
						// $data_table .='<td>'.$row->re_mobile.'</td>';
						// $data_table .='<td>'.$row->reserva_by.'</td>';
						// $data_table .='<td>'.date('d-m-Y H:i:s',strtotime($row->date)).'</td>';
						// $data_table .='<td>'.$row->item_name.'</td>';
						// $data_table .='<td style="text-align:right;">'.number_format($row->amount*(-1),2).'</td>';
					 
					}else{
						$data_table .='<td style="text-align:center;">'.$a++.'</td>';
						$data_table .='<td>'.date('d-m-Y H:i:s',strtotime($row->date)).'</td>';
						$data_table .='<td>'.$row->Family.'</td>';
						$data_table .='<td>'.$row->Mobile.'</td>';
						$data_table .='<td>'.$row->user_name.'</td>';
						$data_table .='<td>'.date('d-m-Y H:i:s',strtotime($row->date_in)).'</td>';
						$data_table .='<td>'.$row->item_name.'</td>';
						if ($row->refun_amount>0) {
							$data_table .='<td style="text-align:right;">'.number_format(($row->amount-$row->refun_amount),2).'('.'Refun'.')'.'</td>';
						}else{
						$data_table .='<td style="text-align:right;">'.number_format(($row->price),2).'</td>';
						}
						$total +=str_replace(',', '', number_format(($row->price-$row->refun_amount),2));
					
						$data_table .='<td></td>';
						$data_table .='<td></td>';
					}
					
					
				}
			$data_table .='</tr>';
			$pay_id = $row->pay_id;


		}
		$data_table .='<tr>';
			$data_table .='<th colspan="7" style="text-align:right;">Total: </th>';
			$data_table .='<th style="text-align:right;">'.number_format($total,2).'</th>';
			$data_table .='<th style="text-align:right;"></th>';
			$data_table .='<th style="text-align:right;color:red">'.number_format($totalqty,2).'</th>';
			$data_table .='<th style="text-align:right;color:red">'.number_format($totalitem,2).'</th>';
		$data_table .='</tr>';

		$data_table .='</tbody>';
		$data['from_date'] = $from_date;
		$data['to_date'] = $to_date;
		$data['type'] = $type;
		$data['main_content'] = 'admin/report/payment_report';
		$data['data_table'] = $data_table;
 	    $this->load->view('includes/template', $data);
	}


	function item_report($id=Null){

		$data['data']  = $this->checkin_model->checkin_report();
		
		$data['main_content'] = 'admin/report/item_report';
        $this->load->view('includes/template', $data); 	
	}

	function report_room_by_date(){

		$year_arr = [];
        $month_arr = [];
		$months = ($this->input->get('month')) ? $this->input->get('month'):date('m');
        $years = ($this->input->get('year'))?$this->input->get('year'):date('Y');
		$from_date = date('Y-m-01',strtotime($years.'-'.$months.'-01'));
        $to_date = date('Y-m-t',strtotime($years.'-'.$months.'-01'));
        $from_dates = date('Y-m-d ',strtotime($from_date .' -5day'));
        $to_dates = date('Y-m-d ',strtotime($to_date .' +5day'));

        $room_type_id = $this->input->get('room_type');
        $room_id = $this->input->get('room_id');

        $room_no = $this->db->query("SELECT * FROM tbl_room WHERE id = '$room_id'")->row()->room_no;

        $day_arr = [
            'Mon',
            'Tue',
            'Wed',
            'Thu',
            'Fri',
            'Sat',
            'Sun',
        ];
        
        $room_data = $this->room_model->get_by_type_resullt($room_type_id);
		$reservation_year = $this->db->query("SELECT DATE(checkin_data) AS years FROM tbl_reservation GROUP BY YEAR(checkin_data)")->result();
		$checkin_year = $this->db->query("SELECT DATE(date_in) AS years FROM tbl_checkin GROUP BY YEAR(date_in)")->result();

		if($reservation_year){
            foreach ($reservation_year as $re_year) {
                $year_arr[date('Y',strtotime($re_year->years))] = date('Y',strtotime($re_year->years));
            }
        }
        if($checkin_year){
            foreach ($checkin_year as $checkin_year) {
                $year_arr[date('Y',strtotime($checkin_year->years))] = date('Y',strtotime($checkin_year->years));
            }
        }

        $checkin_data = $this->db->query("SELECT
											checkin.*,
											check_detail.room_id 
										FROM
											tbl_checkin checkin
										INNER JOIN tbl_checkin_detail check_detail ON checkin.id = check_detail.checkin_id 
										WHERE
											check_detail.room_id = '$room_id'
										AND DATE(checkin.date_in) >= '$from_dates' 
										AND DATE(checkin.date_out) <= '$to_dates'
											")->result();
        $reservation = $this->db->query("SELECT
										reserva.* 
										FROM
											tbl_reservation reserva
											LEFT JOIN tbl_multireservation re_mul ON reserva.id = re_mul.reserv_id 
										WHERE
											(
												reserva.room_id = '$room_id' 
												OR re_mul.room_id = '$room_id' 
											)
										AND DATE(reserva.checkin_data) >= '$from_dates' 
										AND DATE(reserva.checkout_data) <= '$to_dates'
										")->result();

        $d1 = new DateTime($from_date);
        $d2 = new DateTime($to_date);
        $d2 = $d2->modify( '+1 day' ); 
        $intervals = DateInterval::createFromDateString('1 day');
        $period = new DatePeriod($d1, $intervals, $d2);
        foreach ($period as $dt) {
            $date_month_arr[$dt->format('Y-m-d H:i:s')] = $dt->format('Y-m-d H:i:s');
        }
        $checkin_arr = [];
        if($room_id){
        	foreach ($date_month_arr as $corrent_date_re) {
	        	foreach ($reservation as $reserva) {
	        		if($corrent_date_re >= date('Y-m-d H:i:s',strtotime($reserva->checkin_data)) && $corrent_date_re <= date('Y-m-d',strtotime($reserva->checkout_data.' -1day'))){
	        			$checkin_arr[$corrent_date_re] = 'Reservation';
	        		}
	        	}
	        	
	        }
	        foreach ($date_month_arr as $corrent_date) {
	        	foreach ($checkin_data as $checkin) {
	        		if($corrent_date >= date('Y-m-d H:i:s',strtotime($checkin->date_in)) && $corrent_date <= date('Y-m-d',strtotime($checkin->date_out.' -1day'))){
	        			$checkin_arr[$corrent_date] = 'Check-In';
	        		}
	        	}
	        	
	        }
        }
        

		 for ($m=1; $m<=12; $m++) {
            $month = date('F', mktime(0,0,0,$m, 1, date('Y')));
            $month_arr[date('m',strtotime($month))] = $month;
         }
        
        $data['room_type'] = $this->roomtype_model->get_roomtype_all();
        $data['from_date'] = $from_date;
        $data['to_date'] = $to_date;
        $data['month'] = $months;
        $data['room_no'] = $room_no;
        $data['room_type_id'] = $room_type_id;
        $data['room_id'] = $room_id;
        $data['year'] = $years;
        $data['checkin_arr'] = $checkin_arr;
        $data['room_data'] = $room_data;
        $data['year_arr'] = $year_arr;
        $data['month_arr'] = $month_arr;
        $data['day_arr'] = array_flip($day_arr);
        $data['date_month_arr'] = $date_month_arr;
        $data['main_content'] = 'admin/report/report_room_by_date';
		$data['data_table'] = $data_table;
 	    $this->load->view('includes/template', $data);
	}
	function report_room_by_month(){
		$year_arr = [];
        $month_arr = [];
        $holiday_data_arr = [];
		$months = ($this->input->get('month')) ? $this->input->get('month'):date('m');
        $years = ($this->input->get('year'))?$this->input->get('year'):date('Y');
		$from_date = date('Y-m-01',strtotime($years.'-'.$months.'-01'));
        $to_date = date('Y-m-t',strtotime($years.'-'.$months.'-01'));
        $from_dates = date('Y-m-d ',strtotime($from_date .' -5day'));
        $to_dates = date('Y-m-d ',strtotime($to_date .' +5day'));

        $room_type_id = $this->input->get('room_type');
        $room_id = $this->input->get('room_id');

        $roomtype_data = $this->db->query("SELECT * FROM tbl_roomtype")->result();
        $room_data_all = $this->db->query("SELECT * FROM tbl_room ORDER BY type_id ASC,room_no ASC")->result();
        $holiday_data = $this->db->query("SELECT * FROM tbl_holiday WHERE YEAR(date) = '$years'")->result();

        foreach ($holiday_data as $holiday) {
        	$holiday_data_arr[(date('Y-m-d',strtotime($holiday->date)))] = date('Y-m-d H:i:s',strtotime($holiday->date));
        }
        $room_no = $this->db->query("SELECT * FROM tbl_room WHERE id = '$room_id'")->row()->room_no;

        $day_arr = [
            'Mon',
            'Tue',
            'Wed',
            'Thu',
            'Fri',
            'Sat',
            'Sun',
        ];
        
        $room_data = $this->room_model->get_by_type_resullt($room_type_id);
		$reservation_year = $this->db->query("SELECT DATE(checkin_data) AS years FROM tbl_reservation GROUP BY YEAR(checkin_data)")->result();
		$checkin_year = $this->db->query("SELECT DATE(date_in) AS years FROM tbl_checkin GROUP BY YEAR(date_in)")->result();

		if($reservation_year){
            foreach ($reservation_year as $re_year) {
                $year_arr[date('Y',strtotime($re_year->years))] = date('Y',strtotime($re_year->years));
            }
        }
        if($checkin_year){
            foreach ($checkin_year as $checkin_year) {
                $year_arr[date('Y',strtotime($checkin_year->years))] = date('Y',strtotime($checkin_year->years));
            }
        }
        // check_detail.room_id = '$room_id'
        $checkin_data = $this->db->query("SELECT
											checkin.*,
											check_detail.room_id ,cus.Mobile,cus.Family
										FROM
											tbl_checkin checkin
										INNER JOIN tbl_checkin_detail check_detail ON checkin.id = check_detail.checkin_id 
										INNER JOIN tbl_customer cus ON  checkin.customer_id = cus.id
										WHERE
										1 = 1
										AND DATE(checkin.date_in) >= '$from_dates' 
										AND DATE(checkin.date_out) <= '$to_dates'
											")->result();
  //      	(
		// 	reserva.room_id = '$room_id' 
		// 	OR re_mul.room_id = '$room_id' 
		// )
		// var_dump($checkin_data);
        $reservation = $this->db->query("SELECT
										reserva.*,re_mul.room_id room_reservaid,cus.Mobile,cus.Family
										FROM
											tbl_reservation reserva
											LEFT JOIN tbl_multireservation re_mul ON reserva.id = re_mul.reserv_id
											INNER JOIN tbl_customer cus ON  reserva.customer_id = cus.id
										WHERE
										1 = 1
										AND DATE(reserva.checkin_data) >= '$from_dates' 
										AND DATE(reserva.checkout_data) <= '$to_dates'
										")->result();

        $d1 = new DateTime($from_date);
        $d2 = new DateTime($to_date);
        $d2 = $d2->modify( '+1 day' ); 
        $intervals = DateInterval::createFromDateString('1 day');
        $period = new DatePeriod($d1, $intervals, $d2);
        foreach ($period as $dt) {
            $date_month_arr[$dt->format('Y-m-d H:i:s')] = $dt->format('Y-m-d H:i:s');
        }
        $checkin_arr = [];
        	foreach ($date_month_arr as $corrent_date_re) {
	        	foreach ($reservation as $reserva) {
	        		if($corrent_date_re >= date('Y-m-d H:i:s',strtotime($reserva->checkin_data)) && $corrent_date_re <= date('Y-m-d',strtotime($reserva->checkout_data.' -1day'))){
	        			$room_re_id = $reserva->room_id;
	        			if($reserva->is_multy == 1){
	        				$room_re_id = $reserva->room_reservaid;
	        			}
	        			$checkin_arr[$room_re_id][$corrent_date_re] = [
	        															'type' => 'R',
	        															'cus_name' => $reserva->Family,
	        															'cus_phone' => $reserva->Mobile,
	        															'deposit' => $reserva->deposit,
	        															'note' => $reserva->note
	        															];
	        		}
	        	}
	        	
	        }
	        foreach ($date_month_arr as $corrent_date) {
	        	foreach ($checkin_data as $checkin) {
	        		if($corrent_date >= date('Y-m-d H:i:s',strtotime($checkin->date_in)) && $corrent_date <= date('Y-m-d H:i:s',strtotime($checkin->date_out.' -1day'))){
	        			$checkin_arr[$checkin->room_id][$corrent_date] = [
	        															'type' => 'C',
	        															'cus_name' => $checkin->Family,
	        															'cus_phone' => $checkin->Mobile,
	        															'deposit' => $checkin->deposit,
	        															'note' => ''
	        															];
	        		}
	        	}
	        	
	        }

		 for ($m=1; $m<=12; $m++) {
            $month = date('F', mktime(0,0,0,$m, 1, date('Y')));
            $month_arr[date('m',strtotime($month))] = $month;
         }
        $data['room_data_all'] = $room_data_all;
        $data['holiday_data_arr'] = $holiday_data_arr;
        $data['roomtype_data'] = $roomtype_data;
        $data['room_type'] = $this->roomtype_model->get_roomtype_all();
        $data['from_date'] = $from_date;
        $data['to_date'] = $to_date;
        $data['month'] = $months;
        $data['room_no'] = $room_no;
        $data['room_type_id'] = $room_type_id;
        $data['room_id'] = $room_id;
        $data['year'] = $years;
        $data['checkin_arr'] = $checkin_arr;
        $data['room_data'] = $room_data;
        $data['year_arr'] = $year_arr;
        $data['month_arr'] = $month_arr;
        $data['day_arr'] = array_flip($day_arr);
        $data['date_month_arr'] = $date_month_arr;
        $data['main_content'] = 'admin/report/report_room_by_month';
		$data['data_table'] = $data_table;
 	    $this->load->view('includes/template', $data);
	}
	function banks(){
		$from_date = $this->input->get('from_date');
		$to_date = $this->input->get('to_date');
		$type = $this->input->get('type');
		$from_date = $from_date?$from_date:date('Y-m-d ');
		$to_date = $to_date?$to_date:date('Y-m-d ');
		$where = "";
		if($from_date && $to_date){
			$where .= "AND DATE(tbl_reservation.reservation_date) >= '$from_date' AND DATE(tbl_reservation.reservation_date) <= '$to_date'";
		}
		if($type){
				$where .= "AND tbl_reservation.deposit_type = '$type'";
		}
		$data = $this->db->query("SELECT * FROM tbl_reservation
								LEFT JOIN tbl_bank b ON tbl_reservation.deposit_type = b.id
								INNER JOIN tbl_customer c ON tbl_reservation.Customer_id = c.id
								WHERE 1 = 1 {$where} ORDER BY tbl_reservation.id ASC")->result();
		$data_table ="";

		$total_sale = 0;
		$total_extra = 0;
		$extra_item = 0;
		$total_room = 0;
		$total = 0;
		$data_table .='<tbody>';
		$i= 1;
		// foreach ($data as $row) {
			
		// 	$data_table .='<tr>';


		// 		$data_table .='<td style="text-align:center;">'.$i++.'</td>';
		// 		$data_table .='<td>'.date('d-m-Y',strtotime($row->date_in)).'</td>';
		// 		$data_table .='<td>'.$row->Family.'</td>';
		// 		$data_table .='<td>'.$row->Mobile.'</td>';
		// 		$data_table .='<td>'.date('d-m-Y',strtotime($row->date)).'</td>';
		// 		$data_table .='<td>'.$row->item_name.'</td>';
		// 		$data_table .='<td class="text-right">'.number_format($row->amount,2).'</td>';




		// 	$data_table .='<tr>';
			

		// }
		$pay_id = '';
		$a = 1;
		foreach ($data as $row) {	
			$data_table .='<tr>';
					$data_table .='<td style="text-align:center;">'.$a.'</td>';
					$data_table .='<td>'.$row->Family.'</td>';
					$data_table .='<td>'.$row->Mobile.'</td>';
					$data_table .='<td>'.$row->reservation_date.'</td>';
					$data_table .='<td>'.$row->create_by.'</td>';
					$data_table .='<td>'.$row->account_name.'</td>';
					$data_table .='<td>'.$row->bank_acc_name.'</td>';
					$data_table .='<td>'.$row->account_number.'</td>';
					$data_table .='<td style="text-align:right;">'.number_format($row->deposit,2).'</td>';
					$total +=str_replace(',', '', number_format($row->deposit,2));
			$data_table .='</tr>';
			$pay_id = $row->pay_id;

		}
		$data_table .='<tr>';
			$data_table .='<th colspan="8" style="text-align:right;">Total: </th>';
			$data_table .='<th style="text-align:right;">'.number_format($total,2).'</th>';
		$data_table .='</tr>';

		$data_table .='</tbody>';
		$data['from_date'] = $from_date;
		$data['to_date'] = $to_date;
		$data['type'] = $type;
		$data['main_content'] = 'admin/report/bank';
		$data['data_table'] = $data_table;
 	    $this->load->view('includes/template', $data);
	}
}