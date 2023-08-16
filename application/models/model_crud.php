<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_crud extends CI_Model {

	function read_data($table=NULL,$id=NULL,$limit=NULL,$offset=NULL,$order=NULL)
	{
		if(empty($id)) {
			return $this->db->select('*')
						->from($table['primary'])
						->limit($limit,$offset)
						->order_by($order,'ASC')
						->get();
		}
		else if(empty($id['join2'])) {
			return $this->db->select('*')
						->from($table['primary'])
						->join($table['join'],$id['join'],'inner')
						->get();
		}
		else {
			return $this->db->select('*')
						->from($table['primary'])
						->join($table['join'],$id['join'],'left')
						->join($table['join2'],$id['join2'],'left')
						->order_by($order,'DESC')
						->get();
		}
	}

	function create_data($table,$data){
		$this->db->insert($table,$data);
	}

	function update_data($table,$data,$id_name,$id){
		$this->db->where($id_name,$id);
		$this->db->update($table,$data);
	}

	function delete_data($table,$id_name,$id){
		$this->db->where($id_name,$id);
		$this->db->delete($table);
	}

	function get_one($table,$id_name,$id){
		$data = array($id_name=>$id);
		return $this->db->get_where($table,$data);
	}

	function get_where($table,$where){
		return $this->db
			->select('*')
			->from($table)
			->where($where)
			->get();
	}

	function count_data($table,$where=NULL,$field=NULL){
		if(empty($where)) {
			return $this->db->get($table)->num_rows();
		}
		else {
			return $this->db->get_where($table,array($where=>$field))->num_rows();
		}
	}

}

/* End of file model_crud.php */
/* Location: ./application/models/model_crud.php */