<?php
defined('BASEPATH') or exit('No direct script access');

class Pertanyaan_model extends CI_MODEL {

    public function __construct()
	{
		parent::__construct();
	}

	function get_pertanyaan()
	{
		$query = $this->db->get('pertanyaan');
		return $this->db->query($query)->result_array();
	}
}
