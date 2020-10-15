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
		var_dump($user);
	}

	public function registration()
	{
		$this->form_validation->set_rules('firstname', 'Firstname', 'required|trim');
		$this->form_validation->set_rules('lastname', 'Lasttname', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', ['is_unique' => 'This email has already registered!']);
		$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[5]|matches[password2]', ['matches' => 'password dont match!', 'min_length' => 'password too short!']);
		$this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
		if ($this->form_validation->run() == false) {
			$data['title'] = 'Absensi Registration';
			$this->load->view('templates/auth_header');
			$this->load->view('auth/registration');
			$this->load->view('templates/auth_footer');
		} else {
			$data = [
				'firstname' => $this->input->post('firstname'),
				'lastname' => $this->input->post('lastname'),
				'email' => htmlspecialchars($this->input->post('email', 'true')),
				'no_induk' => $this->input->post('no_induk'),
				'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
				'role_id' => 2,
				'is_active' => 1,
				'date_created' => time()
			];
			$this->db->insert('user',  $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Congratulation! Your account has been created. Please Login</div>');
			redirect('auth');
		}
	}
}
