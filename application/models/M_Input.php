<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Input extends CI_Model{

	public function getInput($keyword=null, $id = null)
	{
		$this->db->select('
			user.name as name, date, divisi, jo, qty, time, status.nama_status, status.warna_status,
			input_spl.status_id, input_spl.id_input, input_spl.divisi, input_spl.reason_reject
		');
		$this->db->from('input_spl');
		$this->db->join('status', 'status.status_id = input_spl.status_id');
		$this->db->join('user', 'user.id = input_spl.user_id');
		if ($keyword)
		{
			$this->db->like('user.name', $keyword);
			$this->db->or_like('input_spl.divisi', $keyword);
		}
		if($id != null){
			$this->db->where('user_id', $id);
		}

		return $query = $this->db->get()->result_array();
	}

	public function getEdit($id)
	{
		$this->db->select('
			user.name as name, date, divisi, jo, qty, time, status.nama_status, status.warna_status,
			input_spl.status_id, input_spl.id_input
		');
		$this->db->from('input_spl');
		$this->db->join('status', 'status.status_id = input_spl.status_id');
		$this->db->join('user', 'user.id = input_spl.user_id');
		$this->db->where('input_spl.id_input
			', $id);
		return $query = $this->db->get()->row_array();
	}

	public function UpdateData($id)
	{
		$data = [
			'date' => $this->input->post('date'),
			'divisi' => $this->input->post('divisi'),
			'jo' => $this->input->post('jo'),
			'qty' => $this->input->post('qty'),
			'time' => $this->input->post('time'),
			'status_id' => 2,
			'baca' => ''
		];
		$this->db->where('id_input', $id);
		$this->db->update('input_spl', $data);
	}

	public function InsertData()
	{
		$data = [
			'user_id' => $this->input->post('id_user'),
			'date' => $this->input->post('date'),
			'divisi' => $this->input->post('divisi'),
			'jo' => $this->input->post('jo'),
			'qty' => $this->input->post('qty'),
			'time' => $this->input->post('time'),
			'status_id' => 2,
		];
		$this->db->insert('input_spl', $data);
	}

	public function get_lembur($keyword=null)
	{
		if ($keyword)
		{
			$this->db->like('name', $keyword);
			$this->db->or_like('divisi', $keyword);
		}

		$this->db->select('*');
		$this->db->from('input_spl');
		return $query = $this->db->get()->result_array();
	}

	public function reject($id, $reason){
		$data = [
			"status_id" => 3,
			"reason_reject" => $reason
		];
		$this->db->where("id_input", $id);
		$this->db->update("input_spl", $data);
	}

	public function delete($id){
		$this->db->where('id_input', $id);
		$this->db->delete('input_spl');
	}

	public function insertNotifications($input_spl_id, $user_id) {
		$data = [
			'input_spl_id' => $input_spl_id,
			'user_id' => $user_id,
		];
		$this->db->insert('notifications', $data);
	}

	public function getSPL($id) {
		$this->db->select('*');
         $this->db->from('input_spl');
         $this->db->where('id_input', $id);
         $query = $this->db->get();
         return $query;
	}
}