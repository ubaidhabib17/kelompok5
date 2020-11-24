<?php
defined('BASEPATH') or exit('No direct script access');

class Presensi_model extends CI_MODEL {

    public function __construct()
	{
		parent::__construct();
    }
    
    function get_presensi()
	{
		$query = $this->db->get('presensi');
		return $this->db->query($query)->result_array();
    }
    
    public function delete_presensi($presensi_id){
        $this->db->where('id_presen', $presensi_id);
        $this->db->delete('presensi');
    }

    public function edit_presensi($presensi_id){
        $data=[
            "id_presen" => $this->input->post('id_presen', true),
            "status" => $this->input->post('status', true)
        ];

        $this->db->where('id_presen', $this->input->post('id_presen'));
        $this->db->update('presensi', $data);
	}
}