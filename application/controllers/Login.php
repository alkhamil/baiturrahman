<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{
        $data['title'] = 'Login Page';
		$this->load->view('login', $data);
    }
    
    public function do_login()
    {
        $username = $this->input->post('username', TRUE);
        $password = $this->input->post('password', TRUE);
        
        $user = $this->db->get_where('m_user', ['username'=>$username])->row();

        if ($user) {
            if (password_verify($password, $user->password)) {
                $this->session->set_userdata('userdata', $user);
                redirect(base_url('admin/dashboard'), 'refresh');
            }else{
                $this->session->set_flashdata('message', 'Invalid password!');
                redirect(base_url('login'), 'refresh');
            }
        }else{
            $this->session->set_flashdata('message', 'Account not found!');
            redirect(base_url('login'),'refresh');
        }
    }

    public function do_logout()
    {
        $this->session->unset_userdata('userdata');
        redirect(base_url('login'), 'refresh');
    }
}
