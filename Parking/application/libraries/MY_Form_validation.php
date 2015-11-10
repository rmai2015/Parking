<?php if (!defined('BASEPATH')) exit('No direct script access allowed.');

class MY_Form_validation extends CI_Form_validation
{	
	public function is_not_unique($str, $field)
	{
		list($table, $field) = explode('.', $field);
		return $this->CI->db->limit(1)->get_where($table, array($field => $str))->num_rows() !== 0;
	}
}