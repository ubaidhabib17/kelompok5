<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		//Do your magic here
	}

	public function index()
	{
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');

		if($this->form_validation->run() == false){
			$data['title'] = 'Login Page';
			$this->load->view('templates/auth_header', $data);
			$this->load->view('auth/login');
			$this->load->view('templates/auth_footer');
		}else{
			// validasi sukses
			$this->_login(); //uderscore tanda private
		}
		
	}

	private function _login(){
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		
		$user = $this->db->get_where('user', ['email' => $email])->row_array();
		if($user){
			// usernya ada
			if($user['is_active'] == 1){
				// cek password
				if(password_verify($password, $user['password'])){
					$data = [
						'email' => $user['email'],
						'role_id' => $user['role_id']
					];
					// menyimpan data ke session
					$this->session->set_userdata($data);
					redirect('user'); //video selanjutnya
				}else{
					$this->session->set_flashdata('message', '<div class="alert 
				alert-danger" role="alert">Wrong password!</div>');
				redirect('auth');
				}
			}else{
				$this->session->set_flashdata('message', '<div class="alert 
				alert-danger" role="alert">This email has not been activated!</div>');
				redirect('auth');
			}
		}else{
			$this->session->set_flashdata('message', '<div class="alert 
			alert-danger" role="alert">Email not registered!</div>');
			redirect('auth');
		}
		// var_dump($user);
	}

	public function registration()
	{
		
		$this->form_validation->set_rules('nama_depan', 'Nama Depan', 'required|trim');
		$this->form_validation->set_rules('nama_belakang', 'Nama Belakang', 'required|trim');
		$this->form_validation->set_rules('no_induk', 'No Induk', 'required|trim|is_unique[user.no_induk]', ['is_unique' => 'This No Induk has already registered!']);
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', ['is_unique' => 'This email has already registered!']);
		$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[5]|matches[password2]', ['matches' => 'password dont match!', 'min_length' => 'password too short!']);
		$this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
		if ($this->form_validation->run() == false) {
			$data['title'] = 'Registration Page';
			$this->load->view('templates/auth_header', $data);
			$this->load->view('auth/registration');
			$this->load->view('templates/auth_footer');
		} else {
			$data = [
				'nama_depan' => $this->input->post('nama_depan'),
				'nama_belakang' => $this->input->post('nama_belakang'),
				'email' => htmlspecialchars($this->input->post('email', 'true')),
				'no_induk' => $this->input->post('no_induk'),
				'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
				'role_id' => 2,
				'is_active' => 1,
				'date_created' => time()
			];
			$this->db->insert('user',  $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Congratulation! Your account has been created. Please Login</div>');
			redirect('auth');
		}
	}

	public function logout(){
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('role_id');
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">You have been logged out!</div>');
		redirect('auth');

	}
}
