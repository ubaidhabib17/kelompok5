<?php
defined('BASEPATH') or exit('No direct script access');

class Menu_model extends CI_MODEL {

    public function getSubMenu()
    {
        $query = "SELECT `user_sub_menu`.*, `user_menu`.`menu`
        FROM `user_sub_menu` JOIN `user_menu`
        ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
        ";
        return $this->db->query($query)->result_array();
    }

    public function delete_role($role_id){
        $this->db->where('id', $role_id);
        $this->db->delete('user_role');
    }

    public function getRolebyId($role_id){
        return $this->db->get_where('user_role', ['id' => $role_id])->row_array();
    }

    public function edit_role($role_id){
        $data=[
            "id" => $this->input->post('id', true),
            "role" => $this->input->post('role', true)
        ];

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('user_role', $data);
    }
}