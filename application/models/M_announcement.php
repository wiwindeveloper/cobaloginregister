<?php

class M_announcement extends CI_Model
{
    var $table = 'announcement'; //nama tabel dari database
    var $column_order = array(null, 'title','content','user_id', 'status', 'date'); //field yang ada di table user
    var $column_search = array('title','content'); //field yang diizin untuk pencarian 
    var $order = array('title' => 'asc'); // default order 


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

    public function insert_batch($data)
    {
        return $this->db->insert_batch('announcement', $data);
    }

    public function get_announcement($userid)
    {
        return $this->db->select('*')
            ->from('announcement')
            ->where('user_id', $userid)
            ->order_by('id', 'DESC')
            ->get()->result();
    }

    private function _get_datatables_query($userid)
    {
             
            $this->db->from($this->table);

            $i = 0;
     
            foreach ($this->column_search as $item) // looping awal
            {
                    if($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
                    {
                             
                            if($i===0) // looping awal
                            {
                                    $this->db->group_start(); 
                                    $this->db->like($item, $_POST['search']['value']);
                            }
                            else
                            {
                                    $this->db->or_like($item, $_POST['search']['value']);
                            }

                            if(count($this->column_search) - 1 == $i) 
                                    $this->db->group_end(); 
                    }
                    $i++;
            }

            $this->db->where('user_id', $userid);
             
            if(isset($_POST['order'])) 
            {
                    $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            } 
            else if(isset($this->order))
            {
                    $order = $this->order;
                    $this->db->order_by(key($order), $order[key($order)]);
            }
    }

    function get_datatables($userid)
    {
            $this->_get_datatables_query($userid);
            if($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
            $query = $this->db->get();
            return $query->result();
    }

    function count_filtered($userid)
    {
            $this->_get_datatables_query($userid);
            $query = $this->db->get();
            return $query->num_rows();
    }

    public function count_all()
    {
            $this->db->from($this->table);
            return $this->db->count_all_results();
    }
}
?>