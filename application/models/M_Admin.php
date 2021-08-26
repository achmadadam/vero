<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Admin extends CI_Model{
	
public function get_lembur($keyword, $startDate, $endDate)
	{
		$dateWhere = $startDate && $endDate ? ' AND input_spl.date BETWEEN ' . "'$startDate'" . ' AND ' . "'$endDate'"  : "";
		$keywordWhere = $keyword ? " AND (name LIKE '%". $keyword . "%' OR divisi LIKE '%" . $keyword . "%')"  : "";

		return $query = $this->db->query("
			SELECT user.name as name, date, divisi, jo, qty, time, status.nama_status, status.warna_status, 
				input_spl.status_id, input_spl.id_input 
			FROM input_spl
			JOIN status ON status.status_id = input_spl.status_id
			JOIN user ON user.id = input_spl.user_id
			WHERE input_spl.status_id = 1" . $dateWhere . $keywordWhere)->result_array();
	}

	public function get_lembur1($keyword=null)
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

	public function get_chart($condition)
	{
		
		if ($condition == 1) {
			$time = "DATE_FORMAT(date,'%d %b %Y') AS DATE,";
			$groupBy = "GROUP BY DATE_FORMAT(date,'%Y-%m-%d')";
		}

		if ($condition == 2) {
			$time = "CONCAT(DATE_FORMAT(DATE_ADD(date, INTERVAL(1-DAYOFWEEK(date)) DAY),'%e %b %Y'), ' - ',    
					DATE_FORMAT(DATE_ADD(date, INTERVAL(7-DAYOFWEEK(date)) DAY),'%e %b %Y')) AS DATE,";
			$groupBy = "GROUP BY DATE_FORMAT(date,'%Y-%U')";
		}

		if ($condition == 3) {
			$time = "DATE_FORMAT(date,'%M %Y') AS DATE,";
			$groupBy = "GROUP BY DATE_FORMAT(date,'%Y-%m')";
		};

		if ($condition == 4) {
			$time = "DATE_FORMAT(date,'%H') AS DATE,";
			$groupBy = "GROUP BY HOUR(date)";
		};

		$syntax = 'SELECT ' .
			$time .
			' COUNT(1) AS "all"
			FROM input_spl ' . $groupBy . 'ORDER BY date';
		return $query = $this->db->query($syntax)->result_array();
	}
}