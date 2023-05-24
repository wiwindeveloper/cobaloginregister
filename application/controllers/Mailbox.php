<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mailbox extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
    }

    public function send()
    {
        $header['title'] = 'Send Message';

        $this->load->view('templates/user-header.php', $header);
        $this->load->view('templates/user-sidebar.php', $header);
        $this->load->view('templates/user-topbar.php');
        $this->load->view('mailbox/send');
        $this->load->view('templates/user-footer.php');
    }

    public function sendEmail()
    {
        $json  = array();

        $this->form_validation->set_rules('subject', 'Subject', 'required');
        $this->form_validation->set_rules('to', 'To', 'required|valid_email');
        $this->form_validation->set_rules('write', 'Write', 'required');

        if ($this->form_validation->run() == false) 
        {
            //error
            $json = array(
                'subject' => form_error('subject', '<p><small class="text-danger pt-1">', '</small></p>'),
                'to' => form_error('to', '<p><small class="text-danger pt-1">', '</small></p>'),
                'write' => form_error('write', '<p><small class="text-danger pt-1">', '</small></p>')
            );
        }
        else
        {
            $subject = $this->input->post('subject');
            $to = $this->input->post('to');
            $write = $this->input->post('write');

            $send = $this->_emailProcess($subject, $to, $write);

            if($send)
            {
                $json = array(
                    'success' => 'Email has been send'
                );
            } else {
                $json = array(
                    'failed' => 'Failed to send email'
                );
            }
        }


        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }

    private function _emailProcess($subject, $to, $write)
    {
        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'wiwin7120ck5@gmail.com',
            'smtp_pass' => 'ghlvlxyyqtrfwmrz',
            'smtp_port' => 465,
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n"
        ];

        $this->load->library('email', $config);
        $this->email->initialize($config);

        $this->email->from('wiwin7120ck5@gmail.com', 'Noreply Email from Win Dev');
        $this->email->to($to);
      
        $this->email->subject($subject);
        $this->email->message($write);
        
        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }
}