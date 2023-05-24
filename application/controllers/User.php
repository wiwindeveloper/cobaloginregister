<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->model('M_user');
    }

    public function index()
    {
        if(!empty($this->session->userdata('userid')))
        {
            $header['title'] = 'Win Dev - Dashboard';
    
            $this->load->view('templates/user-header.php', $header);
            $this->load->view('templates/user-sidebar.php', $header);
            $this->load->view('templates/user-topbar.php');
            $this->load->view('dashboard');
            $this->load->view('templates/user-footer.php');
        }
        else
        {
            redirect('auth');
        }
    }

    public function users()
    {
        if(!empty($this->session->userdata('userid')))
        {
            $header['title'] = 'User';

            $this->load->view('templates/user-header.php', $header);
            $this->load->view('templates/user-sidebar.php', $header);
            $this->load->view('templates/user-topbar.php');
            $this->load->view('user');
            $this->load->view('templates/user-footer.php');
        }else{
            redirect('auth');
        }
    }

    public function inputUser()
    {
        $json  = array();

        $this->form_validation->set_rules('firstname', 'First Name', 'required');
        $this->form_validation->set_rules('lastname', 'Last Name', 'required');
        $this->form_validation->set_rules('email', 'Email Address', 'required|valid_email|is_unique[user.email]');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('repeat-password', 'Repeat Password', 'required|matches[password]');

        if ($this->form_validation->run() == false) {
            $json = array(
                'firstname' => form_error('firstname', '<p><small class="text-danger pt-1">', '</small></p>'),
                'lastname' => form_error('lastname', '<p><small class="text-danger pt-1">', '</small></p>'),
                'email' => form_error('email', '<p><small class="text-danger pt-1">', '</small></p>'),
                'password' => form_error('password', '<p><small class="text-danger pt-1">', '</small></p>'),
                'repeat' => form_error('repeat-password', '<p><small class="text-danger pt-1">', '</small></p>')
            );
        }else{
            $firstname      = htmlspecialchars($this->input->post('firstname'), true);
            $lastname       = htmlspecialchars($this->input->post('lastname'), true);
            $email          = htmlspecialchars($this->input->post('email'), true);
            $password       = password_hash($this->input->post('password'), PASSWORD_DEFAULT);

            $data = [
                'first_name' => $firstname,
                'last_name' => $lastname,
                'email' => $email,
                'password' => $password,
                'datecreate' => time()
            ];

            $insert = $this->M_user->insert_user($data);

            if($insert)
            {
                $json = array(
                    'success' => 'Data has been insert'
                );
            }
            else
            {
                $json = array(
                    'failed' => 'Failed insert data'
                );
            }
            
        }
        
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }
}