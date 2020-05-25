<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Bahasa extends Auth_controller
{
    public function __construct()
    {
        parent::__construct();

        $this->data['title'] = 'Pelamar &gt; Bahasa';

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
                ->order_by('bahasa_id', 'desc')
                ->get('bahasa');
        $this->data['bahasa'] = $q->num_rows() ? $q->result() : [];
        $this->data['arr_kemampuan'] = $this->get_arr_kemampuan();
		$this->data['content'] = 'dashboard/pelamar/bahasa_index';
		$this->load->view('dashboard/index', $this->data);
	}

    public function delete()
    {
        $user_id = $this->session->userdata('app_user');
        $bahasa_id = $this->input->get('bahasa_id');

        $q = $this->db->where('user_id', $user_id)
                ->where('bahasa_id', $bahasa_id)
                ->limit(1)
                ->get('bahasa');

        if ( ! $q->num_rows())
        {
            $this->session->set_flashdata('message_error', 'Bahasa tidak ditemukan');
            redirect('dashboard/pelamar/bahasa');
        }

        $deleted = $this->db->where('bahasa_id', $bahasa_id)
                ->limit(1)
                ->delete('bahasa');

        if ($deleted)
        {
            $this->session->set_flashdata('message_success', 'Bahasa berhasil dihapus');
        }
        else
        {
            $this->session->set_flashdata('message_error', 'Bahasa tidak berhasil dihapus');
        }

        redirect('dashboard/pelamar/bahasa');
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
                    'field' => 'baca',
                    'label' => 'Kemampuan Baca',
                    'rules' => 'required|max_length[10]|callback_kemampuan_check'
                ],
                [
                    'field' => 'tulis',
                    'label' => 'Kemampuan Tulis',
                    'rules' => 'required|max_length[10]|callback_kemampuan_check'
                ],
                [
                    'field' => 'dengar',
                    'label' => 'Kemampuan Dengar',
                    'rules' => 'required|max_length[10]|callback_kemampuan_check'
                ]
            ];

            $this->form_validation->set_rules($rules);

            if ($this->form_validation->run())
            {
                $data = [
                    'user_id' => $user_id,
                    'nama' => $this->input->post('nama'),
                    'baca' => $this->input->post('baca'),
                    'tulis' => $this->input->post('tulis'),
                    'dengar' => $this->input->post('dengar')
                ];

                $inserted = $this->db->insert('bahasa', $data);

                if ($inserted)
                {
                    $this->session->set_flashdata('message_success', 'Bahasa berhasil ditambahkan');
                    redirect('dashboard/pelamar/bahasa');
                }
                else
                {
                    $this->data['error'] = 'Bahasa tidak berhasil ditambahkan';
                }
            }
        }

        $this->data['arr_kemampuan'] = $this->get_arr_kemampuan();
        $this->data['content'] = 'dashboard/pelamar/bahasa_add';
		$this->load->view('dashboard/index', $this->data);
    }

    public function edit()
    {
        $user_id = $this->session->userdata('app_user');
        $bahasa_id = $this->input->get('bahasa_id');

        $q = $this->db->where('user_id', $user_id)
                ->where('bahasa_id', $bahasa_id)
                ->limit(1)
                ->get('bahasa');

        if ( ! $q->num_rows())
        {
            $this->session->set_flashdata('message_error', 'Bahasa tidak ditemukan');
            redirect('dashboard/pelamar/bahasa');
        }

        $this->data['bahasa'] = $q->row();

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
                    'field' => 'baca',
                    'label' => 'Kemampuan Baca',
                    'rules' => 'required|max_length[10]|callback_kemampuan_check'
                ],
                [
                    'field' => 'tulis',
                    'label' => 'Kemampuan Tulis',
                    'rules' => 'required|max_length[10]|callback_kemampuan_check'
                ],
                [
                    'field' => 'dengar',
                    'label' => 'Kemampuan Dengar',
                    'rules' => 'required|max_length[10]|callback_kemampuan_check'
                ]
            ];

            $this->form_validation->set_rules($rules);

            if ($this->form_validation->run())
            {
                $data = [
                    'nama' => $this->input->post('nama'),
                    'baca' => $this->input->post('baca'),
                    'tulis' => $this->input->post('tulis'),
                    'dengar' => $this->input->post('dengar')
                ];

                $updated = $this->db->where('bahasa_id', $bahasa_id)
                    ->limit(1)
                    ->update('bahasa', $data);

                if ($updated)
                {
                    $this->session->set_flashdata('message_success', 'Bahasa berhasil diubah');
                    redirect('dashboard/pelamar/bahasa');
                }
                else
                {
                    $this->data['error'] = 'Bahasa tidak berhasil diubah';
                }
            }
        }

        if ($this->input->method() === 'post')
        {
            $this->data['content'] = 'dashboard/pelamar/bahasa_update';
        }
        else
        {
            $this->data['content'] = 'dashboard/pelamar/bahasa_edit';
        }

        $this->data['arr_kemampuan'] = $this->get_arr_kemampuan();
		$this->load->view('dashboard/index', $this->data);
    }

    protected function get_arr_kemampuan()
    {
        return [
            'Baik' => 'Baik',
            'Cukup' => 'Cukup',
            'Kurang' => 'Kurang'
        ];
    }

    public function kemampuan_check($str)
    {
        if ( ! in_array($str, array_keys($this->get_arr_kemampuan())))
        {
            $this->form_validation->set_message('kemampuan_check', 'Nilai kemampuan tidak valid');
            return false;
        }

        return true;
    }
}
