<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pelatihan extends Auth_controller
{
    public function __construct()
    {
        parent::__construct();

        $this->data['title'] = 'Pelamar &gt; Pelatihan';

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
                ->order_by('pelatihan_id', 'desc')
                ->get('pelatihan');
        $this->data['pelatihan'] = $q->num_rows() ? $q->result() : [];
		$this->data['content'] = 'dashboard/pelamar/pelatihan_index';
		$this->load->view('dashboard/index', $this->data);
	}

    public function delete()
    {
        $user_id = $this->session->userdata('app_user');
        $pelatihan_id = $this->input->get('pelatihan_id');

        $q = $this->db->where('user_id', $user_id)
                ->where('pelatihan_id', $pelatihan_id)
                ->limit(1)
                ->get('pelatihan');

        if ( ! $q->num_rows())
        {
            $this->session->set_flashdata('message_error', 'Pelatihan tidak ditemukan');
            redirect('dashboard/pelamar/pelatihan');
        }

        $deleted = $this->db->where('pelatihan_id', $pelatihan_id)
                ->limit(1)
                ->delete('pelatihan');

        if ($deleted)
        {
            $this->session->set_flashdata('message_success', 'Pelatihan berhasil dihapus');
        }
        else
        {
            $this->session->set_flashdata('message_error', 'Pelatihan tidak berhasil dihapus');
        }

        redirect('dashboard/pelamar/pelatihan');
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
                    'field' => 'penyelenggara',
                    'label' => 'Penyelenggara',
                    'rules' => 'required|max_length[50]'
                ],
                [
                    'field' => 'lokasi',
                    'label' => 'Lokasi',
                    'rules' => 'required|max_length[50]'
                ],
                [
                    'field' => 'tanggal_mulai',
                    'label' => 'Tanggal Mulai',
                    'rules' => 'required|callback_tanggal_check'
                ],
                [
                    'field' => 'tanggal_selesai',
                    'label' => 'Tanggal Selesai',
                    'rules' => 'required|callback_tanggal_check'
                ]
            ];

            $this->form_validation->set_rules($rules);

            if ($this->form_validation->run())
            {
                $data = [
                    'user_id' => $user_id,
                    'nama' => $this->input->post('nama'),
                    'penyelenggara' => $this->input->post('penyelenggara'),
                    'lokasi' => $this->input->post('lokasi'),
                    'tanggal_mulai' => $this->input->post('tanggal_mulai'),
                    'tanggal_selesai' => $this->input->post('tanggal_selesai')
                ];

                $inserted = $this->db->insert('pelatihan', $data);

                if ($inserted)
                {
                    $this->session->set_flashdata('message_success', 'Pelatihan berhasil ditambahkan');
                    redirect('dashboard/pelamar/pelatihan');
                }
                else
                {
                    $this->data['error'] = 'Pelatihan tidak berhasil ditambahkan';
                }
            }
        }

        $this->data['content'] = 'dashboard/pelamar/pelatihan_add';
		$this->load->view('dashboard/index', $this->data);
    }

    public function edit()
    {
        $user_id = $this->session->userdata('app_user');
        $pelatihan_id = $this->input->get('pelatihan_id');

        $q = $this->db->where('user_id', $user_id)
                ->where('pelatihan_id', $pelatihan_id)
                ->limit(1)
                ->get('pelatihan');

        if ( ! $q->num_rows())
        {
            $this->session->set_flashdata('message_error', 'Pelatihan tidak ditemukan');
            redirect('dashboard/pelamar/pelatihan');
        }

        $this->data['pelatihan'] = $q->row();

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
                    'field' => 'penyelenggara',
                    'label' => 'Penyelenggara',
                    'rules' => 'required|max_length[50]'
                ],
                [
                    'field' => 'lokasi',
                    'label' => 'Lokasi',
                    'rules' => 'required|max_length[50]'
                ],
                [
                    'field' => 'tanggal_mulai',
                    'label' => 'Tanggal Mulai',
                    'rules' => 'required|callback_tanggal_check'
                ],
                [
                    'field' => 'tanggal_selesai',
                    'label' => 'Tanggal Selesai',
                    'rules' => 'required|callback_tanggal_check'
                ]
            ];

            $this->form_validation->set_rules($rules);

            if ($this->form_validation->run())
            {
                $data = [
                    'nama' => $this->input->post('nama'),
                    'penyelenggara' => $this->input->post('penyelenggara'),
                    'lokasi' => $this->input->post('lokasi'),
                    'tanggal_mulai' => $this->input->post('tanggal_mulai'),
                    'tanggal_selesai' => $this->input->post('tanggal_selesai')
                ];

                $updated = $this->db->where('pelatihan_id', $pelatihan_id)
                    ->limit(1)
                    ->update('pelatihan', $data);

                if ($updated)
                {
                    $this->session->set_flashdata('message_success', 'Pelatihan berhasil diubah');
                    redirect('dashboard/pelamar/pelatihan');
                }
                else
                {
                    $this->data['error'] = 'Pelatihan tidak berhasil diubah';
                }
            }
        }

        if ($this->input->method() === 'post')
        {
            $this->data['content'] = 'dashboard/pelamar/pelatihan_update';
        }
        else
        {
            $this->data['content'] = 'dashboard/pelamar/pelatihan_edit';
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
