<?php
    defined('BASEPATH') or exit('No direct script access');
    class Admin extends CI_Controller{
		
		public function __construct()
		{
			parent::__construct();
			cek_login();
			$this->load->library('form_validation');
			$this->load->model('menu_model');
			$this->load->model('presensi_model');
			
		}
		public function index()
		{
			$data['title'] = 'Dashboard';
            $data['user'] = $this->db->get_where('user', ['email' => 
            $this->session->userdata('email')])->row_array();
			
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/index', $data);
			$this->load->view('templates/footer');
        }
		public function role()
		{
			$data['title'] = 'Role';
            $data['user'] = $this->db->get_where('user', ['email' => 
            $this->session->userdata('email')])->row_array();
			
			$data['role'] = $this->db->get('user_role')->result_array();

			$this->form_validation->set_rules('role', 'Role', 'required');
	
			if ($this->form_validation->run() == false) {
				$this->load->view('templates/header', $data);
				$this->load->view('templates/sidebar', $data);
				$this->load->view('templates/topbar', $data);
				$this->load->view('admin/role', $data);
				$this->load->view('templates/footer');
			} else {
				$this->db->insert('user_role', ['role' => $this->input->post('role')]);
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Role telah ditambahkan!</div');
				redirect('admin/role');
			}
		}
		
		public function roleAccess($role_id)
		{
			$data['title'] = 'Role Access';
            $data['user'] = $this->db->get_where('user', ['email' => 
            $this->session->userdata('email')])->row_array();
			
			$data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();

			$this->db->where('id !=' , 1);
			$data['menu'] = $this->db->get('user_menu')->result_array();
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/role_access', $data);
			$this->load->view('templates/footer');
		}
		
		public function changeAccess(){
			$menu_id = $this->input->post('menuId');
			$role_id = $this->input->post('roleId');

			$data = [
				'role_id' => $role_id,
				'menu_id' => $menu_id
			];

			$result = $this->db->get_where('user_access_menu', $data);

			if($result->num_rows() < 1){
				$this->db->insert('user_access_menu', $data);
			}else{
				$this->db->delete('user_access_menu', $data);
			}

			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Access Changed!</div>');

		}

		public function deleteRole($role_id){
			$this->menu_model->delete_role($role_id);
			// untuk flashdata mempunyai 2 parameter (nama flashdata/alias, isi dari flashdatanya)
			$this->session->set_flashdata('flash-data', 'Role was deleted!');
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">The menu has ben deleted!</div>');
			redirect('admin/role','refresh');
		}

		public function editRole($id){
			// $data['title'] = 'Form Edit Data Role';
			// $data['user_role'] = $this->menu_model->getRolebyId($role_id);

			// $this->form_validation->set_rules('id', 'ROLE ID', 'required');
			// $this->form_validation->set_rules('role', 'ROLE NAME', 'required');

			// if($this->form_validation->run() == FALSE){
			// 	$this->load->view('templates/header', $data);
			// 	$this->load->view('templates/sidebar', $data);
			// 	$this->load->view('templates/topbar', $data);
			// 	$this->load->view('admin/edit_role', $data);
			// 	$this->load->view('templates/footer');
			// }else{
			// 	$this->menu_model->edit_role($role_id);
			// 	$this->session->set_flashdata('flash-data','Role was edited!');
            // 	redirect('admin/role','refresh');
			// }

			$this->db->update('user_role', ['role' => $this->input->post('role') ] ,[ 'id' => $id ]);
        	$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">The Role has ben edited!</div>');
        	redirect('admin/role');
		}

		public function get_presensi(){
			$data['title'] = 'Presensi Siswa';
			$data['user'] = $this->db->get_where('user', ['email' => 
            $this->session->userdata('email')])->row_array();
			
			$this->db->select('b.nama_depan, b.nama_belakang, a.tanggal, a.status');
			$this->db->from('presensi AS a');
			$this->db->join('user AS b', 'b.id = a.id_user');
			$this->db->get();
			$this->load->model('presensi_model', 'presensi');
        	$data['presensi'] = $this->presensi->get_presensi();

			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/presensi', $data);
			$this->load->view('templates/footer');
		}

		public function editPresensi($id){
			$this->db->update('presensi', ['tanggal' => $this->input->post('tanggal') ],[ 'id_presen' => $id ]);
			$this->db->update('presensi', ['status' => $this->input->post('status') ],[ 'id_presen' => $id ]);
        	$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Presensi has ben edited!</div>');
        	redirect('admin/get_presensi', 'refresh');
		}

		public function deletePresensi($presen_id){
			$this->presensi_model->delete_presensi($presen_id);
			// untuk flashdata mempunyai 2 parameter (nama flashdata/alias, isi dari flashdatanya)
			$this->session->set_flashdata('flash-data', 'Presensi was deleted!');
			redirect('admin/get_presensi','refresh');
		}
    }
