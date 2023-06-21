<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Announcement extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->model('M_announcement');
        $this->load->model('M_user');
    }

    public function index()
    {
        if(!empty($this->session->userdata('userid')))
        {
            $header['title'] = 'Announcement';
            $data = $this->_get_announcement($this->session->userdata('userid'));

            $query_all_user = $this->M_user->get_user_list($this->session->userdata('userid'));
            $data['list_user'] = $query_all_user;

            $this->load->view('templates/user-header.php', $header);
            $this->load->view('templates/user-sidebar.php', $header);
            $this->load->view('templates/user-topbar.php', $data);
            $this->load->view('announcement/index', $data);
            $this->load->view('templates/user-footer.php');
        }
        else
        {
            redirect('auth');
        }
    }

    public function send()
    {
        $title = $this->input->post('title');
        $content = $this->input->post('content');
        $user = $this->input->post('select-user');

        $data_insert = [
            'title' => $title,
            'content' => $content,
            'user_id' => $user,
            'date' => date('Y-m-d')
        ];

        $insert = $this->M_announcement->insert_announcement($data_insert);

        if($insert)
        {   
            require 'vendor/autoload.php';

            $options = array(
                'cluster' => 'ap1',
                'useTLS' => true
            );
            $pusher = new Pusher\Pusher(
                '576dbb126855ca1d691b',
                '3611930c7f7e74494e46',
                '1620581',
                $options
            );

            $data['user'] = $user;
            $pusher->trigger('channel-announcement', 'event-annountcement', $data);
            redirect('Announcement');
        }
        else
        {
            $this->session->set_flashdata('alert', '<div class="alert alert-danger" role="alert">Failed to send announcement</div>');
            redirect('Announcement');
        }
    }

    public function list()
    {
        $user = $this->input->post('user');
        $data = $this->_get_announcement($user);

        $this->load->view('templates/announcement', $data);
    }

    private function _get_announcement($user)
    {
        $query_count_ann = $this->M_announcement->count_new_announcement($user);
        $query_new_ann = $this->M_announcement->show_new_announcement($user);
        $data['list_annount'] = $query_new_ann;
        $data['amount_annount'] = $query_count_ann;

        return $data;
    }
}
?>