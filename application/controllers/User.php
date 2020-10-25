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
    }
?>
