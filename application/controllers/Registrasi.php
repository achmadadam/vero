<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registrasi extends CI_Controller 
{
	public function __construct()
	{
		parent ::__construct();
		$this->load->model(['M_Data', 'M_Input']);
		$this->load->library('form_validation');
	}

public function index()
{
	$data['title'] = 'Registrasi';
	$data['user'] = $this->db->get_where('user', ['username' =>
	$this->session->userdata('username')])->row_array();
	$data['role'] = $this->db->get('user_role')->result_array();
	$data['data'] = $this->M_Data->getInput(null, $this->fungsi->user_login()->id);
	
	$this->load->view('templates/header', $data);
	$this->load->view('templates/sidebar', $data);
	$this->load->view('templates/topbar', $data);
	$this->load->view('regis/index', $data);
	$this->load->view('templates/footer');

}

public function input()
{
	$data['title'] = 'Input Data Karyawan';
	$data['user'] = $this->db->get_where('user', ['username' =>
	$this->session->userdata('username')])->row_array();
	$data['role'] = $this->db->get('user_role')->result_array();

	$this->form_validation->set_rules('name', 'Name', 'required');
	$this->form_validation->set_rules('username', 'Username', 'required');
	$this->form_validation->set_rules('role_id', 'Role_id', 'required');
	$this->form_validation->set_rules('password', 'Password', 'required');

	if ($this->form_validation->run() == false)
	{
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('regis/input', $data);
		$this->load->view('templates/footer');
	}
	else
	{
		$data = $this->input->post();
		$this->M_Data->InsertData();
		$this->session->set_flashdata('success', '<div class="alert alert-success" role="alert">Input Success!</div>');
				redirect('registrasi');
	} 

}


	public function registration()
	{
		$this->form_validation->set_rules('name', 'Name', 'required|trim');
		$this->form_validation->set_rules('username', 'Username', 'required|trim');
		$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', ['matches' => 'Password dont match!',
				'min_length' => 'Password too short!']);
		$this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

		if( $this->form_validation->run() == false){
			$data['title'] = 'Permintaan Lembur';
			$data['role'] = $this->db->get('user_role')->result_array();
		$this->load->view('templates/auth_header', $data);
		$this->load->view('regis/index', $data);
		$this->load->view('templates/auth_footer');	
		} else {
			$data = [
				'name' => htmlspecialchars($this->input->post('name', true)),
				'username' => htmlspecialchars($this->input->post('username', true)),
				'password' => password_hash($this->input->post('password1'),PASSWORD_DEFAULT),
				'role_id' => $this->input->post('role'),	
				'date_created' => time()
			];

			$this->db->insert('user', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Congratulation! Your Account has been Created. </div>');
			redirect('registrasi');
		}
	}

	public function edit($id)
{
	$data['title'] = 'Edit Data Karyawan';
	$data['user'] = $this->db->get_where('user', ['username' =>
	$this->session->userdata('username')])->row_array();
	$data['role'] = $this->db->get('user_role')->result_array();
	$data['lembur'] = $this->M_Data->getEdit($id);

	
	$this->form_validation->set_rules('name', 'Name', 'required');
	$this->form_validation->set_rules('username', 'Username', 'required');
	$this->form_validation->set_rules('role_id', 'Role_id', 'required');

	if ($this->form_validation->run() == false)
	{
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('regis/edit', $data);
		// $this->load->view('templates/footer');
	}
	else 
	{
		$this->M_Data->UpdateData($id);
		$this->session->set_flashdata('editsuccess', '<div class="alert alert-success" role="alert">Edit Success!</div>');
				redirect('registrasi/index');
	}
		
}

public function delete($id){
	
		$this->M_Data->delete($id);
    	if($this->db->affected_rows() == 0){
			echo "
				<script>alert('Gagal menghapus data!')</script>
				";
    	}
		redirect('registrasi/index');
}

}

