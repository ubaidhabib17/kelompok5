<?php
    defined('BASEPATH') or exit('No direct script access');
    class User extends CI_Controller{

		public function __construct()
		{
			parent::__construct();
			cek_login();
		}
		
		public function index()
		{
			$data['title'] = 'My Profile';
            $data['user'] = $this->db->get_where('user', ['email' => 
            $this->session->userdata('email')])->row_array();
			
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('user/index', $data);
			$this->load->view('templates/footer');
		}
		
		public function edit(){
			$data['title'] = 'Edit Profile';
            $data['user'] = $this->db->get_where('user', ['email' => 
			$this->session->userdata('email')])->row_array();
			
			$this->form_validation->set_rules('nama_depan', 'Nama Depan', 'required|trim');
			
			if ($this->form_validation->run() == false) {
				$this->load->view('templates/header', $data);
				$this->load->view('templates/sidebar', $data);
				$this->load->view('templates/topbar', $data);
				$this->load->view('user/edit', $data);
				$this->load->view('templates/footer');
			}else{
				$nama_depan = $this->input->post('nama_depan');
				$nama_belakang = $this->input->post('nama_belakang');
				$email = $this->input->post('email');

				$this->db->set('nama_depan', $nama_depan);
				$this->db->set('nama_belakang', $nama_belakang);
				$this->db->where('email', $email);
				$this->db->update('user');

				$this->session->set_flashdata('message', '<div class="alert 
				alert-success" role="alert">Your Profile Has Been Updated</div>');
				redirect('user');
			}
		}

		public function changePassword()
		{
			$data['title'] = 'Change Password';
            $data['user'] = $this->db->get_where('user', ['email' => 
			$this->session->userdata('email')])->row_array();
			
			$this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
			$this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[3]|matches[new_password2]');
			$this->form_validation->set_rules('new_password2', 'Repeat Password', 'required|trim|min_length[3]|matches[new_password1]');
			
			if ($this->form_validation->run() == false) {
		
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('user/changepassword', $data);
			$this->load->view('templates/footer');
			}else{
				$current_password = $this->input->post('current_password');
				$new_password = $this->input->post('new_password1');
				if (!password_verify($current_password, $data['user']['password'])) {
					$this->session->set_flashdata('message', '<div class="alert 
					alert-danger" role="alert">Wrong current password</div>');
					redirect('user/changepassword');
				}else{
					if ($current_password == $new_password) {
						$this->session->set_flashdata('message', '<div class="alert 
						alert-danger" role="alert">New Password cannot be the same as current password!</div>');
						redirect('user/changepassword');
					}else{
						$password_hash = password_hash($new_password, PASSWORD_DEFAULT);

						$this->db->set('password', $password_hash);
						$this->db->where('email', $this->session->userdata('email'));
						$this->db->update('user');
						$this->session->set_flashdata('message', '<div class="alert 
						alert-success" role="alert">Password Change</div>');
						redirect('user/changepassword');
					}
				}
			}
		}

		public function presensi(){
			$data['title']= "Presensi Siswa";
			$data['pertanyaan'] = $this->db->get('pertanyaan')->result_array();
			$data['user'] = $this->db->get_where('user', ['email' => 
			$this->session->userdata('email')])->row_array();

			$this->form_validation->set_rules('pertanyaan', 'pertanyaan', 'required|trim');
			$this->form_validation->set_rules('jawaban', 'jawaban', 'required|trim');
			$this->form_validation->set_rules('email', 'email', 'required|trim');
			$this->form_validation->set_rules('id_user', 'id_user', 'required|trim');
			$this->form_validation->set_rules('tanggal', 'tanggal', 'required|trim');
			$this->form_validation->set_rules('status', 'status', 'required');
			
			if ($this->form_validation->run() == false) {
				$this->load->view('templates/header', $data);
				$this->load->view('templates/sidebar');
				$this->load->view('templates/topbar', $data);
				$this->load->view('user/presensi', $data);
				$this->load->view('templates/footer');
			}else {
				$data = [
					'status' => $this->input->post('status'),
					'id_user' => $this->input->post('id_user'),
					'tanggal' => date('Y-m-d')
				];
				// var_dump($_POST);
				// die();
			$this->db->insert('presensi', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Absen Telah Ditambahkan!</div');
			redirect('user/presensi');
			
			}
		}

		public function _cekDataPresensi(){
			$email = $this->input->post('email');
			$pertanyaan = $this->input->post('pertanyaan');
			$jawaban = strtolower($this->input->post('jawaban'));

			$user = $this->db->get_where('user', ['email' => $email])->row_array();

			

		}
	}
?>
