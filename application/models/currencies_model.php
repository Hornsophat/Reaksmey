<?php 
	class Currencies_model extends CI_Model{
		function __construct(){
			parent::__construct();
		}
		function get_cure(){
			$this->db->select('*');
			$this->db->from('tbl_currencies');
			$result = $this->db->get();
			return $result->result();
		}
		function get_exchange_rate(){
			// $this->db->where('cur_code','KH');
			$this->db->select('*');
			$this->db->from('tbl_currencies');
			$result=$this->db->get();
			return $result->row();
		}
		function add_curr($insert_cur){
			$this->db->insert('tbl_currencies',$insert_cur);
		}
		function delete_cur($id){
			$this->db->where('id',$id);
			$this->db->delete('tbl_currencies');
		}
		function get_data_edit($id){
			$this->db->where('id',$id);
			$this->db->select('*');
			$this->db->from('tbl_currencies');
			$result = $this->db->get();
			return $result->result();
		}
		function get_update_currencies($get_update,$id){
			$this->db->where('id',$id);
			$this->db->update('tbl_currencies',$get_update);
		}

		function delete_ba($id){
			$this->db->where('id',$id);
			$this->db->delete('tbl_bank');
		}
		function delete_ex($id){
			$this->db->where('id',$id);
			$this->db->delete('tbl_expense');
		}

		function get_update_expense($ex_update,$id){
			$this->db->where('id',$id);
			$this->db->update('tbl_expense',$ex_update);
		}
	}
 ?>