<?php
defined('BASEPATH') or exit('No direct script access');

class Presensi_model extends CI_MODEL {

    public function __construct()
	{
		parent::__construct();
	}
	
	public function getRolebyId($id){
        return $this->db->get_where('presensi', ['id_presen' => $id])->row_array();
    }
    
    function get_presensi()
	{
		$query = "SELECT `presensi`.*, `user`.*
        FROM `user` JOIN `presensi`
        ON `user`.`id` = `presensi`.`id_user`
        ";
		return $this->db->query($query)->result_array();
    }
    
    public function delete_presensi($presensi_id){
        $this->db->where('id_presen', $presensi_id);
        $this->db->delete('presensi');
    }

    public function edit_presensi($id_presen){
        $data=[
            "id_presen" => $this->input->post('id_presen', true),
            "status" => $this->input->post('status', true)
        ];

        $this->db->where('id_presen', $this->input->post('id_presen'));
        $this->db->update('presensi', $data);
	}
}
