<?php

class M_token extends CI_Model
{
    public function insert_token($data)
    {
        return $this->db->insert('user_token', $data);
    }

    public function get_token($email)
    {
       return $this->db->select('*')
                        ->from('user_token')
                        ->where('email', $email)
                        ->order_by('id', 'DESC')
                        ->limit(1, 0)
                        ->get()
                        ->row_array();
    }
}
?>