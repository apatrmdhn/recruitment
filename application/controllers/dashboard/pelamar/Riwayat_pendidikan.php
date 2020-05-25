<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Riwayat_pendidikan extends Auth_controller
{
    public function __construct()
    {
        parent::__construct();

        $this->data['title'] = 'Pelamar &gt; Riwayat Pendidikan';

        if ($this->data['hak_akses'] !== $this->user_model::HAK_AKSES_PELAMAR)
        {
            $this->session->set_flashdata('message_error', 'Hak akses anda bukan Pelamar');
            redirect('dashboard/front');
        }
    }

    public function index()
	{
        $q = $this->db->where('user_id', $this->session->userdata('app_user'))
                ->order_by('riwayat_pendidikan_id', 'desc')
                ->get('riwayat_pendidikan');
        $this->data['riwayat'] = $q->num_rows() ? $q->result() : [];
		$this->data['content'] = 'dashboard/pelamar/riwayat_pendidikan_index';
		$this->load->view('dashboard/index', $this->data);
	}

    public function add()
    {
        $user_id = $this->session->userdata('app_user');

        $this->load->library('form_validation');

        if ($this->input->method() === 'post')
        {
            $rules = [
                [
                    'field' => 'sekolah',
                    'label' => 'Lembaga Pendidikan',
                    'rules' => 'required|max_length[100]'
                ],
                [
                    'field' => 'kota',
                    'label' => 'Kota',
                    'rules' => 'required|max_length[50]'
                ],
                [
                    'field' => 'tingkat_pendidikan',
                    'label' => 'Tingkat Pendidikan',
                    'rules' => 'required|max_length[10]|callback_tingkat_pendidikan_check'
                ],
                [
                    'field' => 'program_studi',
                    'label' => 'Program Studi',
                    'rules' => 'max_length[50]'
                ],
                [
                    'field' => 'tahun_masuk',
                    'label' => 'Tahun Masuk',
                    'rules' => 'required|integer'
                ],
                [
                    'field' => 'tahun_keluar',
                    'label' => 'Tahun Selesai',
                    'rules' => 'required|integer'
                ],
                [
                    'field' => 'nilai',
                    'label' => 'Nilai/IPK',
                    'rules' => 'required|numeric'
                ]
            ];

            $this->form_validation->set_rules($rules);
            if ($this->form_validation->run())
            {
                $data = [
                    'user_id' => $user_id,
                    'sekolah' => $this->input->post('sekolah'),
                    'kota' => $this->input->post('kota'),
                    'tingkat_pendidikan' => $this->input->post('tingkat_pendidikan'),
                    'program_studi' => $this->input->post('program_studi'),
                    'tahun_masuk' => $this->input->post('tahun_masuk'),
                    'tahun_keluar' => $this->input->post('tahun_keluar'),
                    'nilai' => $this->input->post('nilai')
                ];

                $inserted = $this->db->insert('riwayat_pendidikan', $data);

                if ($inserted)
                {
                    $this->session->set_flashdata('message_success', 'Riwayat pendidikan berhasil ditambahkan');
                    redirect('dashboard/pelamar/riwayat_pendidikan');
                }
                else
                {
                    $this->data['error'] = 'Riwayat pendidikan tidak berhasil ditambahkan';
                }
            }
        }

        $this->data['arr_tingkat_pendidikan'] = $this->get_arr_tingkat_pendidikan();
        $this->data['content'] = 'dashboard/pelamar/riwayat_pendidikan_add';
		$this->load->view('dashboard/index', $this->data);
    }

    public function delete()
    {
        $user_id = $this->session->userdata('app_user');
        $riwayat_pendidikan_id = $this->input->get('riwayat_pendidikan_id');

        $q = $this->db->where('user_id', $user_id)
                ->where('riwayat_pendidikan_id', $riwayat_pendidikan_id)
                ->limit(1)
                ->get('riwayat_pendidikan');

        if ( ! $q->num_rows())
        {
            $this->session->set_flashdata('message_error', 'Riwayat pendidikan tidak ditemukan');
            redirect('dashboard/pelamar/riwayat_pendidikan');
        }

        $deleted = $this->db->where('riwayat_pendidikan_id', $riwayat_pendidikan_id)
                ->limit(1)
                ->delete('riwayat_pendidikan');

        if ($deleted)
        {
            $this->session->set_flashdata('message_success', 'Riwayat Pendidikan berhasil dihapus');
        }
        else
        {
            $this->session->set_flashdata('message_error', 'Riwayat Pendidikan tidak berhasil dihapus');
        }

        redirect('dashboard/pelamar/riwayat_pendidikan');
    }

    public function edit()
    {
        $user_id = $this->session->userdata('app_user');
        $riwayat_pendidikan_id = $this->input->get('riwayat_pendidikan_id');

        $q = $this->db->where('user_id', $user_id)
                ->where('riwayat_pendidikan_id', $riwayat_pendidikan_id)
                ->limit(1)
                ->get('riwayat_pendidikan');

        if ( ! $q->num_rows())
        {
            $this->session->set_flashdata('message_error', 'Riwayat pendidikan tidak ditemukan');
            redirect('dashboard/pelamar/riwayat_pendidikan');
        }

        $this->data['rp'] = $q->row();

        $this->load->library('form_validation');

        if ($this->input->method() === 'post')
        {
            $rules = [
                [
                    'field' => 'sekolah',
                    'label' => 'Lembaga Pendidikan',
                    'rules' => 'required|max_length[100]'
                ],
                [
                    'field' => 'kota',
                    'label' => 'Kota',
                    'rules' => 'required|max_length[50]'
                ],
                [
                    'field' => 'tingkat_pendidikan',
                    'label' => 'Tingkat Pendidikan',
                    'rules' => 'required|max_length[10]|callback_tingkat_pendidikan_check'
                ],
                [
                    'field' => 'program_studi',
                    'label' => 'Program Studi',
                    'rules' => 'max_length[50]'
                ],
                [
                    'field' => 'tahun_masuk',
                    'label' => 'Tahun Masuk',
                    'rules' => 'required|integer'
                ],
                [
                    'field' => 'tahun_keluar',
                    'label' => 'Tahun Selesai',
                    'rules' => 'required|integer'
                ],
                [
                    'field' => 'nilai',
                    'label' => 'Nilai/IPK',
                    'rules' => 'required|numeric'
                ]
            ];

            $this->form_validation->set_rules($rules);
            if ($this->form_validation->run())
            {
                $data = [
                    'sekolah' => $this->input->post('sekolah'),
                    'kota' => $this->input->post('kota'),
                    'tingkat_pendidikan' => $this->input->post('tingkat_pendidikan'),
                    'program_studi' => $this->input->post('program_studi'),
                    'tahun_masuk' => $this->input->post('tahun_masuk'),
                    'tahun_keluar' => $this->input->post('tahun_keluar'),
                    'nilai' => $this->input->post('nilai')
                ];

                $updated = $this->db->where('riwayat_pendidikan_id', $riwayat_pendidikan_id)
                                ->update('riwayat_pendidikan', $data);

                if ($updated)
                {
                    $this->session->set_flashdata('message_success', 'Riwayat pendidikan berhasil diubah');
                    redirect('dashboard/pelamar/riwayat_pendidikan');
                }
                else
                {
                    $this->data['error'] = 'Riwayat pendidikan tidak berhasil diubah';
                }
            }
        }

        if ($this->input->method() === 'post')
        {
            $this->data['content'] = 'dashboard/pelamar/riwayat_pendidikan_update';
        }
        else
        {
            $this->data['content'] = 'dashboard/pelamar/riwayat_pendidikan_edit';
        }

        $this->data['arr_tingkat_pendidikan'] = $this->get_arr_tingkat_pendidikan();
		$this->load->view('dashboard/index', $this->data);
    }

    public function tingkat_pendidikan_check($str)
    {
        if ( ! in_array($str, array_keys($this->get_arr_tingkat_pendidikan())))
        {
            $this->form_validation->set_message('tingkat_pendidikan_check', 'Tingkat Pendidikan tidak valid');
            return false;
        }

        return true;
    }

    protected function get_arr_tingkat_pendidikan()
    {
        $this->load->model('riwayat_pendidikan_model');
        return $this->riwayat_pendidikan_model->get_arr_tingkat_pendidikan();
    }
}
