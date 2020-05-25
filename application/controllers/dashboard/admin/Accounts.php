<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Accounts extends Auth_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->data['title'] = 'Admin &gt; Akun';

        if ($this->data['hak_akses'] !== $this->user_model::HAK_AKSES_ADMIN)
        {
            $this->session->set_flashdata('message_error', 'Hak akses anda bukan Admin');
            redirect('dashboard/front');
        }
    }

    public function index()
    {
        $q = $this->db->order_by('id', 'desc')->get('user');
        $this->data['users'] = $q->num_rows() ? $q->result() : [];
        $this->data['content'] = 'dashboard/admin/account_index';
        $this->load->view('dashboard/index', $this->data);
    }

    public function delete()
    {
        $user_id = $this->input->get('user_id');

        if ( ! $user_id)
        {
            $this->session->set_flashdata('message_error', 'User ID tidak ditemukan');
            redirect('dashboard/admin/accounts');
        }

        $q = $this->db->where('user_id', $user_id)->limit(1)->get('user');

        if ( ! $q->num_rows())
        {
            $this->session->set_flashdata('message_error', 'Akun tidak ditemukan');
            redirect('dashboard/admin/accounts');
        }

        $q = $this->db->where('user_id', $user_id)->limit(1)->delete('user');

        if ($q)
        {
            $this->session->set_flashdata('message_success', 'Akun berhasil dihapus');
        }
        else
        {
            $this->session->set_flashdata('message_error', 'Akun gagal dihapus');
        }

        redirect('dashboard/admin/accounts');
    }

    public function add()
    {
        $this->load->library('form_validation');

        if ($this->input->method() === 'post')
        {
            $rules = [
                [
                    'field' => 'username',
                    'label' => 'Username',
                    'rules' => 'required|max_length[128]|is_unique[user.username]'
                ],
                [
                    'field' => 'email',
                    'label' => 'Email',
                    'rules' => 'required|max_length[128]|valid_email|is_unique[user.email]'
                ],
                [
                    'field' => 'hak_akses',
                    'label' => 'Hak Akses',
                    'rule' => 'required|in_list[1,2,3,4,5]'
                ],
                [
                    'field' => 'password',
                    'label' => 'Kata Sandi',
                    'rules' => 'required|min_length[8]|max_length[50]'
                ],
                [
                    'field' => 'password_confirm',
                    'label' => 'Konfirmasi Kata Sandi',
                    'rules' => 'matches[password]'
                ]
            ];

            $this->form_validation->set_rules($rules);

            if ($this->form_validation->run())
            {
                $username = $this->input->post('username');
                $email = $this->input->post('email');
                $password = $this->input->post('password');
                $hak_akses = $this->input->post('hak_akses');

                $this->load->model('user_model');
                $user_id = $this->user_model->insert([
                    'email' => $email,
                    'username' => $username,
                    'password' => $password,
                    'hak_akses' => $hak_akses
                ]);

                if ($user_id)
                {
                    $this->session->set_flashdata('message_success', 'Akun berhasil ditambahkan');
                    redirect('dashboard/admin/accounts');
                }

                $data['error'] = 'Akun gagal ditambahkan';
            }
        }

        $this->data['content'] = 'dashboard/admin/account_add';
        $this->load->view('dashboard/index', $this->data);
    }

    public function edit()
    {
        $user_id = $this->input->get('user_id');

        if ( ! $user_id)
        {
            $this->session->set_flashdata('message_error', 'User ID tidak ditemukan');
            redirect('dashboard/admin/accounts');
        }

        $q = $this->db->where('user_id', $user_id)->limit(1)->get('user');

        if ( ! $q->num_rows())
        {
            $this->session->set_flashdata('message_error', 'Akun tidak ditemukan');
            redirect('dashboard/admin/accounts');
        }

        $user = $q->row();

        $this->load->library('form_validation');

        if ($this->input->method() === 'post')
        {
            $rules = [
                [
                    'field' => 'username',
                    'label' => 'Username',
                    'rules' => 'required|max_length[128]|callback_username_check'
                ],
                [
                    'field' => 'email',
                    'label' => 'Email',
                    'rules' => 'required|max_length[128]|valid_email|callback_email_check'
                ],
                [
                    'field' => 'hak_akses',
                    'label' => 'Hak Akses',
                    'rule' => 'required|in_list[1,2,3,4,5]'
                ]
            ];

            if ($this->input->post('password'))
            {
                $rules[] = [
                    'field' => 'password',
                    'label' => 'Kata Sandi',
                    'rules' => 'required|min_length[8]|max_length[50]'
                ];
                $rules[] = [
                    'field' => 'password_confirm',
                    'label' => 'Konfirmasi Kata Sandi',
                    'rules' => 'matches[password]'
                ];
            }

            $this->form_validation->set_rules($rules);

            if ($this->form_validation->run())
            {
                $data = [
                    'username' => $this->input->post('username'),
                    'email' => $this->input->post('email'),
                    'hak_akses' => $this->input->post('hak_akses')
                ];

                if ($this->input->post('password'))
                {
                    $data['password'] = $this->input->post('password');
                }

                $this->load->model('user_model');
                $updated = $this->user_model->update($user_id, $data);

                if ($updated)
                {
                    $this->session->set_flashdata('message_success', 'Akun berhasil diubah');
                    redirect('dashboard/admin/accounts');
                }

                $data['error'] = 'Akun gagal diubah';
            }
        }

        if ($this->input->method() === 'post')
        {
            $this->data['content'] = 'dashboard/admin/account_update';
        }
        else
        {
            $this->data['content'] = 'dashboard/admin/account_edit';
        }
        $this->data['user_data'] = $user;
        $this->load->view('dashboard/index', $this->data);
    }

    public function username_check($str)
    {
        $user_id = $this->input->get('user_id');
        $q = $this->db->where('user_id !=', $user_id)
                ->where('username', $str)
                ->limit(1)
                ->get('user');
        if ($q->num_rows())
        {
            $this->form_validation->set_message('username_check', 'Username ini sudah ada yang memiliki');
            return false;
        }

        return true;
    }

    public function email_check($str)
    {
        $user_id = $this->input->get('user_id');
        $q = $this->db->where('user_id !=', $user_id)
                ->where('email', $str)
                ->limit(1)
                ->get('user');
        if ($q->num_rows())
        {
            $this->form_validation->set_message('email_check', 'Email ini sudah ada yang memiliki');
            return false;
        }

        return true;
    }

}
