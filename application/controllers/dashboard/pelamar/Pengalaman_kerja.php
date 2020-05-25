<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pengalaman_kerja extends Auth_controller
{
    public function __construct()
    {
        parent::__construct();

        $this->data['title'] = 'Pelamar &gt; Pengalaman Kerja';

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
                ->order_by('pengalaman_id', 'desc')
                ->get('pengalaman_kerja');
        $this->data['pengalaman'] = $q->num_rows() ? $q->result() : [];
		$this->data['content'] = 'dashboard/pelamar/pengalaman_kerja_index';
		$this->load->view('dashboard/index', $this->data);
	}

    public function delete()
    {
        $user_id = $this->session->userdata('app_user');
        $pengalaman_id = $this->input->get('pengalaman_id');

        $q = $this->db->where('user_id', $user_id)
                ->where('pengalaman_id', $pengalaman_id)
                ->limit(1)
                ->get('pengalaman_kerja');

        if ( ! $q->num_rows())
        {
            $this->session->set_flashdata('message_error', 'Pengalaman kerja tidak ditemukan');
            redirect('dashboard/pelamar/pengalaman_kerja');
        }

        $deleted = $this->db->where('pengalaman_id', $pengalaman_id)
                ->limit(1)
                ->delete('pengalaman_kerja');

        if ($deleted)
        {
            $this->session->set_flashdata('message_success', 'Pengalaman kerja berhasil dihapus');
        }
        else
        {
            $this->session->set_flashdata('message_error', 'Pengalaman kerja tidak berhasil dihapus');
        }

        redirect('dashboard/pelamar/pengalaman_kerja');
    }

    public function add()
    {
        $user_id = $this->session->userdata('app_user');

        $this->load->library('form_validation');

        if ($this->input->method() === 'post')
        {
            $rules = [
                [
                    'field' => 'nama_perusahaan',
                    'label' => 'Nama Perusahaan',
                    'rules' => 'required|max_length[50]'
                ],
                [
                    'field' => 'tanggal_masuk',
                    'label' => 'Tanggal Masuk',
                    'rules' => 'required|callback_tanggal_check'
                ],
                [
                    'field' => 'tanggal_keluar',
                    'label' => 'Tanggal Keluar',
                    'rules' => 'required|callback_tanggal_check'
                ],
                [
                    'field' => 'jabatan',
                    'label' => 'Jabatan',
                    'rules' => 'required|max_length[50]'
                ]
            ];

            $this->form_validation->set_rules($rules);

            if ($this->form_validation->run())
            {
                $data = [
                    'user_id' => $user_id,
                    'nama_perusahaan' => $this->input->post('nama_perusahaan'),
                    'tanggal_masuk' => $this->input->post('tanggal_masuk'),
                    'tanggal_keluar' => $this->input->post('tanggal_keluar'),
                    'jabatan' => $this->input->post('jabatan')
                ];

                $inserted = $this->db->insert('pengalaman_kerja', $data);

                if ($inserted)
                {
                    $this->session->set_flashdata('message_success', 'Pengalaman kerja berhasil ditambahkan');
                    redirect('dashboard/pelamar/pengalaman_kerja');
                }
                else
                {
                    $this->data['error'] = 'Pengalaman kerja tidak berhasil ditambahkan';
                }
            }
        }

        $this->data['content'] = 'dashboard/pelamar/pengalaman_kerja_add';
		$this->load->view('dashboard/index', $this->data);
    }

    public function edit()
    {
        $user_id = $this->session->userdata('app_user');
        $pengalaman_id = $this->input->get('pengalaman_id');

        $q = $this->db->where('user_id', $user_id)
                ->where('pengalaman_id', $pengalaman_id)
                ->limit(1)
                ->get('pengalaman_kerja');

        if ( ! $q->num_rows())
        {
            $this->session->set_flashdata('message_error', 'Pengalaman kerja tidak ditemukan');
            redirect('dashboard/pelamar/pengalaman_kerja');
        }

        $this->data['pengalaman'] = $q->row();

        $this->load->library('form_validation');

        if ($this->input->method() === 'post')
        {
            $rules = [
                [
                    'field' => 'nama_perusahaan',
                    'label' => 'Nama Perusahaan',
                    'rules' => 'required|max_length[50]'
                ],
                [
                    'field' => 'tanggal_masuk',
                    'label' => 'Tanggal Masuk',
                    'rules' => 'required|callback_tanggal_check'
                ],
                [
                    'field' => 'tanggal_keluar',
                    'label' => 'Tanggal Keluar',
                    'rules' => 'required|callback_tanggal_check'
                ],
                [
                    'field' => 'jabatan',
                    'label' => 'Jabatan',
                    'rules' => 'required|max_length[50]'
                ]
            ];

            $this->form_validation->set_rules($rules);

            if ($this->form_validation->run())
            {
                $data = [
                    'nama_perusahaan' => $this->input->post('nama_perusahaan'),
                    'tanggal_masuk' => $this->input->post('tanggal_masuk'),
                    'tanggal_keluar' => $this->input->post('tanggal_keluar'),
                    'jabatan' => $this->input->post('jabatan')
                ];

                $updated = $this->db->where('pengalaman_id', $pengalaman_id)
                    ->limit(1)
                    ->update('pengalaman_kerja', $data);

                if ($updated)
                {
                    $this->session->set_flashdata('message_success', 'Pengalaman kerja berhasil diubah');
                    redirect('dashboard/pelamar/pengalaman_kerja');
                }
                else
                {
                    $this->data['error'] = 'Pengalaman kerja tidak berhasil diubah';
                }
            }
        }

        if ($this->input->method() === 'post')
        {
            $this->data['content'] = 'dashboard/pelamar/pengalaman_kerja_update';
        }
        else
        {
            $this->data['content'] = 'dashboard/pelamar/pengalaman_kerja_edit';
        }

		$this->load->view('dashboard/index', $this->data);
    }

    public function tanggal_check($str)
    {
        if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$str)) {
            return true;
        }

        $this->form_validation->set_message('tanggal_check', 'Format tanggal salah');
        return false;
    }
}
