<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller 
{
	public function __construct()
	{
		parent ::__construct();
		$this->load->library('form_validation');
	}

	public function index()
	{
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		if($this->form_validation->run() == false){
			$data['title'] = 'Login Page';
			$this->load->view('templates/auth_header', $data);
			$this->load->view('auth/login');
			$this->load->view('templates/auth_footer');
		} else{
			// validasi sukses
			$this->_login();
		}
		
	} 

	private function _login()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$user = $this->db->get_where('user', ['username' => $username])->row_array();
		
		if ($user != null) {
			if(password_verify($password, $user['password'])){
				$data = [
					'username' => $user['username'],
					'role_id' => $user['role_id'],
					'id' => $user['id']
				];

				$this->session->set_userdata($data);
				if ($user['role_id'] == 1 || $user['role_id'] == 4) {
					redirect('admin');
				}elseif ($user['role_id'] == 3 ) {
					redirect('menu');
				}
				else {
					redirect('user');
				}
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong password!</div>');
				redirect('auth');	
			}

		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Account is not exist!</div>');
			redirect('auth');
		}
		
		
	}
	

	
	public function logout()
	{
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('role_id');

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">You Have Been Logout!</div>');
			redirect('auth');
	}
}
