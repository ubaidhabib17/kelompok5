<?php
    function cek_login(){
        // instansiasi CI
        $ci = get_instance();

        if(!$ci->session->userdata('email')){
            redirect('auth');
        }else{
            $role_id = $ci->session->userdata('role_id');
            $menu = $ci->uri->segment(1); 
            // segment = urutan url setelah base url
            
            $queryMenu = $ci->db->get_where('user_menu', ['menu' => $menu])->row_array();
            $menu_id = $queryMenu['id'];

            $userAccess = $ci->db->get_where('user_access_menu', [
                'role_id' => $role_id, 
                'menu_id' => $menu_id
            ]);

            if($userAccess->num_rows() < 1){
                redirect('auth/blocked');
            }
        }
    }
?>