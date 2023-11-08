<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Announcement extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation', 'session');
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

        require 'vendor/autoload.php';
    
        $options = array(
            'cluster' => 'ap1',
            'useTLS' => true
        );
        // $pusher = new Pusher\Pusher(
        //     '576dbb126855ca1d691b',
        //     '3611930c7f7e74494e46',
        //     '1620581',
        //     $options
        // );
        $pusher = new Pusher\Pusher(
            '83737de8d744dc180234',
            '98d91917d0292ecc3ddc',
            '1654017',
            $options
          );

        if($user == 'all')
        {
            $get_user = $this->M_user->get_all_user();
            
            foreach($get_user as $row_user)
            {


                $data_insert[] = array(
                    'title' => $title,
                    'content' => $content,
                    'user_id' => $row_user->id,
                    'date' => date('Y-m-d')
                );
        
                
                $data['user'] = $row_user->id;
                $pusher->trigger('channel-announcement', 'event-annountcement', $data);
            }

           

            $insert = $this->M_announcement->insert_batch($data_insert);

            
            $this->session->set_flashdata('alert', '<div class="alert alert-info" role="alert">Success to send announcement</div>');
            redirect('Announcement/');
        }
        else
        {
            $data_insert = [
                'title' => $title,
                'content' => $content,
                'user_id' => $user,
                'date' => date('Y-m-d')
            ];
    
            $insert = $this->M_announcement->insert_announcement($data_insert);
            if($insert)
            {   
               
    
                $data['user'] = $user;
                $pusher->trigger('channel-announcement', 'event-annountcement', $data);
                $this->session->set_flashdata('alert', '<div class="alert alert-info" role="alert">Success to send announcement</div>');
                redirect('Announcement');
            }
            else
            {
                $this->session->set_flashdata('alert', '<div class="alert alert-danger" role="alert">Failed to send announcement</div>');
                redirect('Announcement');
            }
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

    public function alllist()
    {
        if(!empty($this->session->userdata('userid')))
        {
            $header['title'] = 'List Announcement';
            $data = $this->_get_announcement($this->session->userdata('userid'));

            $query_announcement = $this->M_announcement->get_announcement($this->session->userdata('userid'));
            $data['list_ann'] = $query_announcement;

            $this->load->view('templates/user-header.php', $header);
            $this->load->view('templates/user-sidebar.php', $header);
            $this->load->view('templates/user-topbar.php', $data);
            $this->load->view('announcement/list', $data);
            $this->load->view('templates/user-footer.php');
        }
        else
        {
            redirect('auth');
        }
    }

    public function get_data_announcement()
    {
            $list = $this->M_announcement->get_datatables($this->session->userdata('userid'));
            $data = array();
            $no = $_POST['start'];
            foreach ($list as $field) {
                    $no++;
                    $row = array();
                    $row[] = $no;
                    $row[] = $field->title;
                    $row[] = $field->content;
                    if($field->status == 0)
                    {
                        $row[] = '<span class="badge badge-secondary">unread</span>';
                    }else{
                        $row[] = '<span class="badge badge-info">read</span>';
                    }
                    
                    $row[] = $field->date;

                    $data[] = $row;
            }

            $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->M_announcement->count_all(),
                    "recordsFiltered" => $this->M_announcement->count_filtered($this->session->userdata('userid')),
                    "data" => $data,
            );
            //output dalam format JSON
            echo json_encode($output);
    }
}
?>