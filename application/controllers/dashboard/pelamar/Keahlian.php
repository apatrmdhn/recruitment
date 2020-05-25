<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Keahlian extends Auth_controller
{
    public function __construct()
    {
        parent::__construct();

        $this->data['title'] = 'Pelamar &gt; Keahlian';

        if ($this->data['hak_akses'] !== $this->user_model::HAK_AKSES_PELAMAR)
        {
            $this->session->set_flashdata('message_error', 'Hak akses anda bukan Pelamar');
            redirect('dashboard/front');
        }
    }

    public function index()
	{
        $user_id = $this->session->userdata('app_user');
        $q = $this->db->where('user_id', $user_id)
                ->order_by('keahlian_id', 'desc')
                ->get('keahlian');
        $this->data['keahlian'] = $q->num_rows() ? $q->result() : [];
		$this->data['content'] = 'dashboard/pelamar/keahlian_index';
		$this->load->view('dashboard/index', $this->data);
	}

    public function delete()
    {
        $user_id = $this->session->userdata('app_user');
        $keahlian_id = $this->input->get('keahlian_id');

        $q = $this->db->where('user_id', $user_id)
                ->where('keahlian_id', $keahlian_id)
                ->limit(1)
                ->get('keahlian');

        if ( ! $q->num_rows())
        {
            $this->session->set_flashdata('message_error', 'Keahlian tidak ditemukan');
            redirect('dashboard/pelamar/keahlian');
        }

        $deleted = $this->db->where('keahlian_id', $keahlian_id)
                ->limit(1)
                ->delete('keahlian');

        if ($deleted)
        {
            $this->session->set_flashdata('message_success', 'Keahlian berhasil dihapus');
        }
        else
        {
            $this->session->set_flashdata('message_error', 'Keahlian tidak berhasil dihapus');
        }

        redirect('dashboard/pelamar/keahlian');
    }

    public function add()
    {
        $user_id = $this->session->userdata('app_user');

        $this->load->library('form_validation');

        if ($this->input->method() === 'post')
        {
            $rules = [
                [
                    'field' => 'nama',
                    'label' => 'Nama',
                    'rules' => 'required|max_length[100]'
                ],
                [
                    'field' => 'deskripsi',
                    'label' => 'Deskripsi',
                    'rules' => 'required|max_length[255]'
                ]
            ];

            $this->form_validation->set_rules($rules);

            if ($this->form_validation->run())
            {
                $data = [
                    'user_id' => $user_id,
                    'nama' => $this->input->post('nama'),
                    'deskripsi' => $this->input->post('deskripsi')
                ];

                $inserted = $this->db->insert('keahlian', $data);

                if ($inserted)
                {
                    $this->session->set_flashdata('message_success', 'Keahlian berhasil ditambahkan');
                    redirect('dashboard/pelamar/keahlian');
                }
                else
                {
                    $this->data['error'] = 'Keahlian tidak berhasil ditambahkan';
                }
            }
        }

        $this->data['content'] = 'dashboard/pelamar/keahlian_add';
		$this->load->view('dashboard/index', $this->data);
    }

    public function edit()
    {
        $user_id = $this->session->userdata('app_user');
        $keahlian_id = $this->input->get('keahlian_id');

        $q = $this->db->where('user_id', $user_id)
                ->where('keahlian_id', $keahlian_id)
                ->limit(1)
                ->get('keahlian');

        if ( ! $q->num_rows())
        {
            $this->session->set_flashdata('message_error', 'Keahlian tidak ditemukan');
            redirect('dashboard/pelamar/keahlian');
        }

        $this->data['keahlian'] = $q->row();

        $this->load->library('form_validation');

        if ($this->input->method() === 'post')
        {
            $rules = [
                [
                    'field' => 'nama',
                    'label' => 'Nama',
                    'rules' => 'required|max_length[100]'
                ],
                [
                    'field' => 'deskripsi',
                    'label' => 'Deskripsi',
                    'rules' => 'required|max_length[255]'
                ]
            ];

            $this->form_validation->set_rules($rules);

            if ($this->form_validation->run())
            {
                $data = [
                    'nama' => $this->input->post('nama'),
                    'deskripsi' => $this->input->post('deskripsi')
                ];

                $updated = $this->db->where('keahlian_id', $keahlian_id)
                    ->limit(1)
                    ->update('keahlian', $data);

                if ($updated)
                {
                    $this->session->set_flashdata('message_success', 'Keahlian berhasil diubah');
                    redirect('dashboard/pelamar/keahlian');
                }
                else
                {
                    $this->data['error'] = 'Keahlian tidak berhasil diubah';
                }
            }
        }

        if ($this->input->method() === 'post')
        {
            $this->data['content'] = 'dashboard/pelamar/keahlian_update';
        }
        else
        {
            $this->data['content'] = 'dashboard/pelamar/keahlian_edit';
        }

		$this->load->view('dashboard/index', $this->data);
    }
}
