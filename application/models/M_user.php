<?php

class M_user extends CI_Model
{
    public function insert_user($data)
    {
        return $this->db->insert('user', $data);
    }

    public function get_user_byemail($email)
    {
        return $this->db->select('*')
                        ->from('user')
                        ->where('email', $email)
                        ->get()->row_array();
    }

    public function update_password($data, $where)
    {
        return $this->db->update('user', $data, $where);
    }
}
?>