<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class Admin_auth
 */
class Admin_auth extends Backend_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->lang->load('auth/auth', 'polish');
        $this->load->model('auth/auth_model', 'auth');
    }

    /**
     * Login to cms
     */
    public function login()
    {
        // Redirect if logged in
        if ($this->auth->logged_in() === TRUE) {
            redirect(config_item('admin_folder'));
        }

        // Set up the form
        $rules = array(
            'email' => array('field' => 'email', 'label' => lang('auth.login.login'), 'rules' => 'trim|required|xss_clean'),
            'password' => array('field' => 'password', 'label' => lang('auth.login.password'), 'rules' => 'trim|required')
        );
        $this->form_validation->set_rules($rules);

        // Log in
        if ($this->form_validation->run() == TRUE) {
            // If success
            if ($this->auth->login()) {
                redirect(config_item('admin_folder'));
            }
            // If error
            else {
                $this->session->set_flashdata('error', lang('auth.login.error.login'));
                redirect(config_item('admin_folder').'/auth/login', 'refresh');
            }
        }

        $this->render('auth/login', $this->data);
    }

    /**
     * Logout from admin panel
     */
    public function logout()
    {
        $this->auth->logout();
        redirect(config_item('admin_folder').'/auth/login');
    }
}

/* End of file Admin_auth.php */
/* Location: ./application/modules/auth/controllers/admin/Admin_auth.php */