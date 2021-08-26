<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Data extends CI_Model{

	public function getInput($keyword=null, $id = null)
	{
		$this->db->select('id, name, username, password, role_id');
		$this->db->from('user');
		return $query = $this->db->get()->result_array();
	}

	public function getEdit($id)
	{
		$this->db->select('id, name, username,  role_id');
		$this->db->from('user');
		$this->db->where('id',$id);
		return $query = $this->db->get()->row_array();
	}

	public function UpdateData($id)
	{
		$data = [
			'name' => $this->input->post('name'),
			'username' => $this->input->post('username'),
			'role_id' => $this->input->post('role_id'),
			'password' => $this->input->post('password'),
		];
		$this->db->where('id', $id);
		$this->db->update('user', $data);
	}

	public function InsertData()
	{
		// var_dump($this->input->post('role_id'));
		// die;
		$data = [
			'name' => $this->input->post('name'),
			'username' => $this->input->post('username'),
			'role_id' => $this->input->post('role_id'),
			'password' => password_hash($this->input->post('password'),PASSWORD_DEFAULT),
		];
		$this->db->insert('user', $data);
	}

	public function delete($id){
		$this->db->where('id', $id);
		$this->db->delete('user');
	}
}