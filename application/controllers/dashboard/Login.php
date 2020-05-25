<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function index()
    {
        $data = [];
        $msg = $this->session->flashdata('message_success');
        if ($msg)
        {
            $data['message_success'] = $msg;
        }
        $this->load->view('dashboard/login', $data);
    }

    public function do_login()
    {
        $rules = [
            [
                'field' => 'username',
                'label' => 'Nama Pengguna',
                'rules' => 'required|max_length[128]'
            ],
            [
                'field' => 'password',
                'label' => 'Sandi',
                'rules' => 'required|min_length[8]|max_length[50]'
            ]
        ];

        $this->load->library('form_validation');
        $this->form_validation->set_rules($rules);

        $data = [];
        if ($this->form_validation->run())
        {
            $this->load->model('user_model');
            $user = $this->user_model->login($this->input->post('username'), $this->input->post('password'));
            if ($user)
            {
                $this->session->set_userdata('app_user', $user->user_id);
                redirect('dashboard/front');
            }
            else
            {
                $data['error'] = 'Kombinasi username dan password salah';
            }
        }

        $this->load->view('dashboard/login', $data);
    }
}
