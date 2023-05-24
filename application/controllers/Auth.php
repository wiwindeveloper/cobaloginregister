<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->model('M_user');
        $this->load->model('M_token');
    }

    public function index()
    {
        $this->form_validation->set_rules('email', 'Username', 'required|valid_email', [
            'required' => 'Email is require',
            'valid_email' => 'Your email not valid'
        ]);

        $this->form_validation->set_rules('password', 'Password', 'required', [
            'required' => 'Password is require'
        ]);

        if ($this->form_validation->run() == false) //check validation
        {
            $data['title'] = 'Login | Win Dev';
    
            $this->load->view('templates/auth-header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth-footer');
        }
        else
        {
            //proses login
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            $query_user = $this->M_user->get_user_byemail($email);
            
            if($query_user['email'])
            {
                if(password_verify($password, $query_user['password']))
                {
                    $data_session = [
                        'userid' => $query_user['id'],
                        'firstname' => $query_user['first_name']
                    ];

                    $this->session->set_userdata($data_session);

                    if(!empty($this->input->post("save_id"))) {
                        setcookie ("loginId", $email, time()+ (10 * 365 * 24 * 60 * 60));  
                        setcookie ("loginPass", $password,  time()+ (10 * 365 * 24 * 60 * 60));
                    }
                    else
                    {
                        setcookie ("loginId",""); 
                        setcookie ("loginPass","");
                    }

                    redirect('user');
                }
                else
                {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong password!</div>');
                    redirect('auth');
                }
            }
            else
            {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email tidak terdaftar!</div>');
                redirect('auth');
            }
        }
    }

    public function registration()
    {
        $this->form_validation->set_rules('firstname', 'First Name', 'required|max_length[100]', [
            'required' => 'First Name is require',
            'max_length' => 'First Name cannot be more than 100 characters'
        ]);

        $this->form_validation->set_rules('lastname', 'Last Name', 'required|max_length[100]', [
            'required' => 'Last Name is require',
            'max_length' => 'Last Name cannot be more than 100 characters'
        ]);

        $this->form_validation->set_rules('email', 'Email Address', 'required|valid_email', [
            'required' => 'Email is require',
            'valid_email' => 'Type a valid email'
        ]);
        
        $this->form_validation->set_rules('password', 'Password', 'required|callback_valid_password');
        $this->form_validation->set_rules('repeatpassword', 'Repeat Password', 'required|matches[password]');

        if ($this->form_validation->run() == false) //check validation
        {
            $data['title'] = 'Registration | Win Dev';
    
            $this->load->view('templates/auth-header', $data);
            $this->load->view('auth/registration');
            $this->load->view('templates/auth-footer');
        }
        else
        {
            //proses registrasi
            $firstname = htmlspecialchars($this->input->post('firstname'), true);
            $lastname = htmlspecialchars($this->input->post('lastname'), true);
            $email = htmlspecialchars($this->input->post('email'), true);
            $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);

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
                $this->session->set_flashdata('message', '<div class="alert alert-info" role="alert">Your registration is successful!</div>');
                redirect('auth/registration');
            }
            else
            {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Your registration failed to process!</div>');
                redirect('auth/registration');
            }
        }
    }

    //Create strong password 
    public function valid_password($password = '')
    {
        $password = trim($password);

        $regex_lowercase = '/[a-z]/';
        $regex_uppercase = '/[A-Z]/';
        $regex_number = '/[0-9]/';
        $regex_special = '/[!@#$%^&*()\-_=+{};:,<.>ยง~]/';

        if (empty($password)) {
            $this->form_validation->set_message('valid_password', 'Password is incorrect');

            return FALSE;
        }

        if (preg_match_all($regex_lowercase, $password) < 1) {
            $this->form_validation->set_message('valid_password', 'at least one lowercase letter (a-z)');

            return FALSE;
        }

        if (preg_match_all($regex_uppercase, $password) < 1) {
            $this->form_validation->set_message('valid_password', 'at least one uppercase letter (A-Z)');

            return FALSE;
        }

        if (preg_match_all($regex_number, $password) < 1) {
            $this->form_validation->set_message('valid_password', 'at least one number (0-9)');

            return FALSE;
        }

        if (strlen($password) < 10) {
            $this->form_validation->set_message('valid_password', 'at least 10 characters');

            return FALSE;
        }

        if (strlen($password) > 32) {
            $this->form_validation->set_message('valid_password', 'The {field} field cannot exceed 32 characters in length.');

            return FALSE;
        }

        return TRUE;
    }

    public function logout()
    {
        $this->session->unset_userdata('userid');
        $this->session->unset_userdata('firstname');

        $this->session->set_flashdata('message', '<div class="alert alert-info" role="alert">You have been logged out!</div>');
        redirect('auth');
    }

    public function forgot()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email', [
            'required' => 'Email is require',
            'valid_email' => 'Your email not valid'
        ]);

        if ($this->form_validation->run() == false) //check validation
        {
            $data['title'] = 'Forgot Password';
            $this->load->view('templates/auth-header', $data);
            $this->load->view('auth/forgot-password');
            $this->load->view('templates/auth-footer');
        }
        else
        {
            //proses
            $email = $this->input->post('email');
            $user  = $this->M_user->get_user_byemail($email);

            if($user)
            {
                $token = base64_encode(random_bytes(32));

                $user_token = [
                    'email' => $email,
                    'token' => $token,
                    'date_create' => time()
                ];

                $insert = $this->M_token->insert_token($user_token);

                if($insert)
                {
                    $sendemail = $this->_sendEmail($token);

                    if($sendemail)
                    {
                        $this->session->set_flashdata('message', '<div class="alert alert-info" role="alert">Please check your email to verify!</div>');
                        redirect('auth/forgotPassword');
                    }
                    else
                    {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Failed to send email!</div>');
                        redirect('auth/forgot');
                    }
                }else{
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Sorry, failed while saving data.</div>');
                    redirect('auth/forgot');
                }
            }
            else
            {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email is not registered!</div>');
                redirect('auth/forgot');
            }
        }
    }

    private function _sendEmail($token)
    {
        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'wiwin7120ck5@gmail.com',
            'smtp_pass' => 'Ik4npaUs',
            'smtp_port' => 465,
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n"
        ];

        $this->load->library('email', $config);
        $this->email->initialize($config);

        $this->email->from('wiwin7120ck5@gmail.com', 'Noreply Minning Login Test');
        $this->email->to($this->input->post('email'));
      
        $this->email->subject('Reset Password');
        $this->email->message('Click this link to reset your password: <a href="' . base_url() . 'auth/resetpassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Reset Password</a>');
        
        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }

    public function resetPassword()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->M_token->get_token($email);

        if ($user) 
        {
            if(str_replace(' ', '+',$token) == $user['token'])
            {
                $this->session->set_userdata('reset_email', $email);
                $this->changePassword();
            }else{
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Sorry wrong token.</div>');
                redirect('auth');
            }
        }
        else
        {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset password failed! Wrong email.</div>');
            redirect('auth');
        }
    }

    public function changePassword()
    {
        if (!$this->session->userdata('reset_email')) {
            redirect('auth');
        }

        $this->form_validation->set_rules('new_password', 'Password', 'trim|required|min_length[3]|callback_valid_password');
        $this->form_validation->set_rules('confirm_password', 'Repeat Password', 'trim|required|matches[new_password]');

        if ($this->form_validation->run() == false) //check validation
        {
            $data['title'] = 'Change Password';
            $this->load->view('templates/auth-header', $data);
            $this->load->view('auth/change-password');
            $this->load->view('templates/auth-footer');
        }
        else
        {
            $password = password_hash($this->input->post('new_password'), PASSWORD_DEFAULT);
            $email = $this->session->userdata('reset_email');

            $data = [
                'password' => $password
            ];

            $where = [
                'email' => $email
            ];

            $update = $this->M_user->update_password($data, $where);

            if($update)
            {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password has been change. Please login!</div>');
                redirect('auth');
            }else{
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Failed change Password!</div>');
                redirect('auth/changePassword');
            }
        }
    }
}