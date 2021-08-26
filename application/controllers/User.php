<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller 
{
	public function __construct(){
		parent ::__construct();
		$this->load->model(['M_Input', 'M_User']);
		$this->load->library('form_validation');
	}

public function index()
{
	$data['title'] = 'My Profile';
	$data['user'] = $this->db->get_where('user', ['username' =>
	$this->session->userdata('username')])->row_array();
	
	$this->load->view('templates/header', $data);
	$this->load->view('templates/sidebar', $data);
	$this->load->view('templates/topbar', $data);
	$this->load->view('user/index', $data);
	$this->load->view('templates/footer');

}

public function home()
{
	$data['title'] = 'Laporan Lembur';
	$data['user'] = $this->db->get_where('user', ['username' =>
	$this->session->userdata('username')])->row_array();
	$data['lembur'] = $this->M_Input->getInput(null, $this->fungsi->user_login()->id);
	
	$this->load->view('templates/header', $data);
	$this->load->view('templates/sidebar', $data);
	$this->load->view('templates/topbar', $data);
	$this->load->view('user/home', $data);
	$this->load->view('templates/footer');
}
public function data()
{
	$data['title'] = 'Laporan Lembur';
	$data['user'] = $this->db->get_where('user', ['username' =>
	$this->session->userdata('username')])->row_array();
	$data['lembur'] = $this->M_Input->getInput(null, $this->fungsi->user_login()->id);
	
	$this->load->view('templates/header', $data);
	$this->load->view('templates/sidebar', $data);
	$this->load->view('templates/topbar', $data);
	$this->load->view('user/data', $data);
	$this->load->view('templates/footer');
}

public function update() 
{
	$this->load->view('user/update');
}

public function input()
{
	$data['title'] = 'Input Surat Perintah Lembur';
	$data['user'] = $this->db->get_where('user', ['username' =>
	$this->session->userdata('username')])->row_array();

	$this->form_validation->set_rules('name', 'Name', 'required');
	$this->form_validation->set_rules('date', 'Date', 'required');
	$this->form_validation->set_rules('divisi', 'Divisi', 'required');
	$this->form_validation->set_rules('jo', 'No. Job Order', 'required');
	$this->form_validation->set_rules('qty', 'Qty', 'required');
	$this->form_validation->set_rules('time', 'Time', 'required');

	if ($this->form_validation->run() == false)
	{
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('user/input', $data);
		$this->load->view('templates/footer');
	}
	else
	{
		$this->M_Input->InsertData();
		$this->session->set_flashdata('success', '<div class="alert alert-success" role="alert">Input Success!</div>');
				redirect('user/home');
	} 

}

public function edit($id)
{
	$data['title'] = 'Edit Surat Perintah Lembur';
	$data['user'] = $this->db->get_where('user', ['username' =>
	$this->session->userdata('username')])->row_array();
	$data['lembur'] = $this->M_Input->getEdit($id);

	
	$this->form_validation->set_rules('name', 'Name', 'required');
	$this->form_validation->set_rules('date', 'Date', 'required');
	$this->form_validation->set_rules('divisi', 'Divisi', 'required');
	$this->form_validation->set_rules('jo', 'No. Job Order', 'required');
	$this->form_validation->set_rules('qty', 'Qty', 'required');
	$this->form_validation->set_rules('time', 'Time', 'required');

	if ($this->form_validation->run() == false)
	{
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('user/edit', $data);
		$this->load->view('templates/footer');
	}
	else 
	{
		$this->M_Input->UpdateData($id);
		$this->session->set_flashdata('editsuccess', '<div class="alert alert-success" role="alert">Edit Success!</div>');
				redirect('user/home');
	}
		
}

public function delete($id){
	
		$this->M_Input->delete($id);
    	if($this->db->affected_rows() == 0){
			echo "
				<script>alert('Gagal menghapus data!')</script>
				";
    	}
		redirect('user/home');
}
}