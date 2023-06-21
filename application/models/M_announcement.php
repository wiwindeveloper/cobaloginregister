<?php

class M_announcement extends CI_Model
{
    public function insert_announcement($data)
    {
        return $this->db->insert('announcement', $data);
    }

    public function count_new_announcement($userid)
    {
        return $this->db->select('*')
            ->from('announcement')
            ->where('user_id', $userid)
            ->count_all_results();
    }

    public function show_new_announcement($userid)
    {
        return $this->db->select('*')
            ->from('announcement')
            ->where('user_id', $userid)
            ->order_by('id', 'DESC')
            ->limit(5, 0)
            ->get()->result();
    }
}
?>