<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Auth_model extends CI_Model {

	function login($where)
	{
		$query = $this->db->get_where('usm_users',$where,1);
		if($query->num_rows()==1)
		{
		return $query->row();
		}
		else {
		return false;
		}
	}



}
