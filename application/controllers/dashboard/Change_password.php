<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Change_password extends Auth_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->data['title'] = 'Akun &gt; Ubah Kata Sandi';
    }
    
    public function index()
    {
        $msg = $this->session->flashdata('message_success');

        if ($msg)
        {
            $this->data['message_success'] = $msg;
        }

        $this->data['content'] = 'dashboard/change_password';
        $this->load->view('dashboard/index', $this->data);
    }

    public function change()
    {
        $rules = [
            [
                'field' => 'old_password',
                'label' => 'Kata Sandi Lama',
                'rules' => 'required|min_length[8]|max_length[50]'
            ],
            [
                'field' => 'new_password',
                'label' => 'Kata Sandi Baru',
                'rules' => 'required|min_length[8]|max_length[50]'
            ],
            [
                'field' => 'new_password_confirm',
                'label' => 'Konfirmasi Kata Sandi Lama',
                'rules' => 'matches[new_password]'
            ]
        ];

        $this->load->library('form_validation');
        $this->form_validation->set_rules($rules);

        if ($this->form_validation->run())
        {
            $user_id = $this->session->userdata('app_user');
            $old_password = $this->input->post('old_password');
            $new_password = $this->input->post('new_password');

            $this->load->model('user_model');

            if ($this->user_model->password_match($user_id, $old_password))
            {
                $update = $this->user_model->update($user_id, [
                    'password' => $new_password
                ]);

                if ($update)
                {
                    $this->session->set_flashdata('message_success', 'Kata Sandi berhasil diganti');
                    redirect('dashboard/change_password');
                }
                else
                {
                    $this->data['error'] = 'Kata Sandi tidak berhasil diganti';
                }
            }
            else
            {
                $this->data['error'] = 'Kata Sandi Lama salah';
            }
        }

        $this->data['content'] = 'dashboard/change_password';
        $this->load->view('dashboard/index', $this->data);
    }
}
