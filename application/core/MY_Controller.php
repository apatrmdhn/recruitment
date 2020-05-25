<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class MY_Controller extends CI_Controller
{
    protected $data = [];

    public function __construct()
    {
        parent::__construct();
        $this->catch_flash_message();
    }

    protected function catch_flash_message()
    {
        $msg_success = $this->session->flashdata('message_success');
        if ($msg_success)
        {
            $this->data['message_success'] = $msg_success;
        }

        $msg_info = $this->session->flashdata('message_info');
        if ($msg_info)
        {
            $this->data['message_info'] = $msg_info;
        }

        $msg_error = $this->session->flashdata('message_error');
        if ($msg_error)
        {
            $this->data['message_error'] = $msg_error;
        }
    }
}


class Auth_controller extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        if ( ! $this->session->userdata('app_user'))
        {
            redirect('dashboard/login');
        }
        $this->load->model('user_model');

        $this->data['user'] = $this->get_login_user();
        $this->data['hak_akses'] = $this->get_hak_akses((int) $this->data['user']->hak_akses);
        $this->data['HAK_AKSES_ADMIN'] = $this->user_model::HAK_AKSES_ADMIN;
        $this->data['HAK_AKSES_DIRUT'] = $this->user_model::HAK_AKSES_DIRUT;
        $this->data['HAK_AKSES_HRD'] = $this->user_model::HAK_AKSES_HRD;
        $this->data['HAK_AKSES_DIVISI'] = $this->user_model::HAK_AKSES_DIVISI;
        $this->data['HAK_AKSES_PELAMAR'] = $this->user_model::HAK_AKSES_PELAMAR;
    }

    protected function get_hak_akses($id_hak_akses)
    {
        return $this->user_model->get_hak_akses()[$id_hak_akses];
    }

    protected function get_login_user()
    {
        return $this->user_model->getby_id($this->session->userdata('app_user'));
    }
}
