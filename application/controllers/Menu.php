<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller 
{
	public function __construct()
    {
        parent::__construct();

        $this->load->model("M_Input");
        $this->load->library('form_validation');
    }

	public function index()
	{
	$data['title'] = 'Data Lembur';
	$data['user'] = $this->db->get_where('user', ['username' =>
	$this->session->userdata('username')])->row_array();
	

	if ($this->input->post('search'))
	{
		$data['keyword'] = $this->input->post('keyword');
		$this->session->set_userdata('keyword', $data['keyword']);
	}
	else 
	{
		$data['keyword'] = $this->session->userdata('keyword');

	}

	$data['lembur'] = $this->M_Input->getInput($data['keyword']);
	
	$this->load->view('templates/header', $data);
	$this->load->view('templates/sidebar', $data);
	$this->load->view('templates/topbar_div', $data);
	$this->load->view('menu/index', $data);
	$this->load->view('templates/footer');
	}

	public function data_div()
	{
		$data['title'] = 'Data Lembur';
		$data['user'] = $this->db->get_where('user', ['username' =>
		$this->session->userdata('username')])->row_array();
		
	
		if ($this->input->post('search'))
		{
			$data['keyword'] = $this->input->post('keyword');
			$this->session->set_userdata('keyword', $data['keyword']);
		}
		else 
		{
			$data['keyword'] = $this->session->userdata('keyword');
	
		}
	
		$data['lembur'] = $this->M_Input->getInput($data['keyword']);
		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar_div', $data);
		$this->load->view('menu/data_div', $data);
		$this->load->view('templates/footer');
	}
	public function approve($id)
	{
		$this->db->where('status_id', 1);
        $this->db->select('status_id');
        $this->db->from('status');
        $status_approve = $this->db->get()->row_array();

        $this->db->set('status_id', $status_approve['status_id']);
        $this->db->where('id_input', $id);
        $this->db->update('input_spl');

		$splData = $this->M_Input->getSPL($id)->result();
		$this->M_Input->insertNotifications($id, $splData[0]->user_id);
        redirect('menu');
    }

    public function reject($id){
		
		$reason = $this->input->post('rejectReason', true);
    	$this->M_Input->reject($id, $reason);
    	if($this->db->affected_rows() == 0){
			echo "
				<script>alert('Gagal mengupdate data!')</script>
				";
    	};
		$splData = $this->M_Input->getSPL($id)->result();
		$this->M_Input->insertNotifications($id, $splData[0]->user_id);
		redirect('menu');

    }
}