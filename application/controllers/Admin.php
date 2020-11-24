<?php
    defined('BASEPATH') or exit('No direct script access');
    class Admin extends CI_Controller{
		
		public function __construct()
		{
			parent::__construct();
			cek_login();
			$this->load->library('form_validation');
			$this->load->model('menu_model');
			
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

			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/role', $data);
			$this->load->view('templates/footer');

			
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
			redirect('admin/role','refresh');
		}

		public function editRole($role_id){
			$data['title'] = 'Form Edit Data Role';
			$data['user_role'] = $this->menu_model->getRolebyId($role_id);

			$this->form_validation->set_rules('id', 'ROLE ID', 'required');
			$this->form_validation->set_rules('role', 'ROLE NAME', 'required');

			if($this->form_validation->run() == FALSE){
				$this->load->view('templates/header', $data);
				$this->load->view('templates/sidebar', $data);
				$this->load->view('templates/topbar', $data);
				$this->load->view('admin/edit_role', $data);
				$this->load->view('templates/footer');
			}else{
				$this->menu_model->edit_role($role_id);
				$this->session->set_flashdata('flash-data','Role was edited!');
            	redirect('admin/role','refresh');
			}
		}

		public function get_presensi(){
			$data['title'] = 'Presensi Siswa';
			// $data['admin'] = $this->db->get('presensi')->result_array();
			
			$this->db->select('b.nama_depan, b.nama_belakang, a.tanggal, a.status');
			$this->db->from('presensi AS a');
			$this->db->join('user AS b', 'b.id_user = a.id');
			$query = $this->db->get();

			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/presensi', $data);
			$this->load->view('templates/footer');
		}

		public function editPresensi($presen_id){
			$data['title'] = 'Form Edit Data Role';
			$data['user_presensi'] = $this->menu_model->getRolebyId($presen_id);

			$this->form_validation->set_rules('id_presen', 'ID PRESEN', 'required');
			$this->form_validation->set_rules('status', 'Status', 'required');

			if($this->form_validation->run() == FALSE){
				$this->load->view('templates/header', $data);
				$this->load->view('templates/sidebar', $data);
				$this->load->view('templates/topbar', $data);
				$this->load->view('admin/edit_presensi', $data);
				$this->load->view('templates/footer');
			}else{
				$this->menu_model->edit_role($presen_id);
				$this->session->set_flashdata('flash-data','Presensi was edited!');
            	redirect('admin/presensi','refresh');
			}
		}

		public function deletePresensi($presen_id){
			$this->menu_model->delete_presensi($presen_id);
			// untuk flashdata mempunyai 2 parameter (nama flashdata/alias, isi dari flashdatanya)
			$this->session->set_flashdata('flash-data', 'Presensi was deleted!');
			redirect('admin/presensi','refresh');
		}
    }
