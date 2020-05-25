<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fpk extends Auth_controller
{
    public function __construct()
    {
        parent::__construct();

        $this->data['title'] = 'Divisi &gt; FPK';

        if ($this->data['hak_akses'] !== $this->user_model::HAK_AKSES_DIVISI)
        {
            $this->session->set_flashdata('message_error', 'Hak akses anda bukan Divisi');
            redirect('dashboard/front');
        }
    }

    public function index()
	{
        $user_id = $this->session->userdata('app_user');
        $q = $this->db->where('user_id', $user_id)
                ->order_by('fpk_id', 'desc')
                ->get('fpk');
        $this->data['fpk'] = $q->num_rows() ? $q->result() : [];
		$this->data['content'] = 'dashboard/divisi/fpk_index';
        $this->data['arr_tingkat_pendidikan'] = $this->get_arr_tingkat_pendidikan();
        $this->data['arr_status'] = $this->get_arr_status();
		$this->load->view('dashboard/index', $this->data);
	}

    public function detail()
    {
        $user_id = $this->session->userdata('app_user');
        $fpk_id = $this->input->get('fpk_id');

        $q = $this->db->where('user_id', $user_id)
                ->where('fpk_id', $fpk_id)
                ->limit(1)
                ->get('fpk');

        if ( ! $q->num_rows())
        {
            $this->session->set_flashdata('message_error', 'Formulir Permintaan Karyawan tidak ditemukan');
            redirect('dashboard/divisi/fpk');
        }

        $this->data['fpk'] = $q->row();
        $this->data['arr_tingkat_pendidikan'] = $this->get_arr_tingkat_pendidikan();
        $this->data['arr_status'] = $this->get_arr_status();
        $this->data['content'] = 'dashboard/divisi/fpk_detail';
        $this->load->view('dashboard/index', $this->data);
    }

    public function delete()
    {
        $user_id = $this->session->userdata('app_user');
        $fpk_id = $this->input->get('fpk_id');

        $q = $this->db->where('user_id', $user_id)
                ->where('fpk_id', $fpk_id)
                ->where('status', 'divisi_submit')
                ->limit(1)
                ->get('fpk');

        $arr_status = $this->get_arr_status();

        if ( ! $q->num_rows())
        {
            $this->session->set_flashdata('message_error', 'Formulir Permintaan Karyawan tidak ditemukan atau status bukan '.$arr_status['divisi_submit']);
            redirect('dashboard/divisi/fpk');
        }

        $deleted = $this->db->where('fpk_id', $fpk_id)
                ->limit(1)
                ->delete('fpk');

        if ($deleted)
        {
            $this->session->set_flashdata('message_success', 'Formulir Permintaan Karyawan berhasil dihapus');
        }
        else
        {
            $this->session->set_flashdata('message_error', 'Formulir Permintaan Karyawan tidak berhasil dihapus');
        }

        redirect('dashboard/divisi/fpk');
    }

    public function add()
    {
        $user_id = $this->session->userdata('app_user');

        $this->load->library('form_validation');

        if ($this->input->method() === 'post')
        {
            $rules = [
                [
                    'field' => 'nama_pemohon',
                    'label' => 'Nama Pemohon',
                    'rules' => 'required|max_length[100]'
                ],
                [
                    'field' => 'jabatan_pemohon',
                    'label' => 'Jabatan Pemohon',
                    'rules' => 'required|max_length[50]'
                ],
                [
                    'field' => 'lokasi',
                    'label' => 'Lokasi',
                    'rules' => 'required|max_length[255]'
                ],
                [
                    'field' => 'jabatan',
                    'label' => 'Jabatan Yang Dibutuhkan',
                    'rules' => 'required|max_length[50]'
                ],
                [
                    'field' => 'jumlah_kebutuhan',
                    'label' => 'Jumlah Kebutuhan (Orang)',
                    'rules' => 'required|integer|greater_than_equal_to[1]'
                ],
                [
                    'field' => 'usia_min',
                    'label' => 'Usia Minimum (Thn)',
                    'rules' => 'required|integer|greater_than_equal_to[1]'
                ],
                [
                    'field' => 'usia_max',
                    'label' => 'Usia Maksimum (Thn)',
                    'rules' => 'required|integer|greater_than_equal_to[1]|callback_usia_max_check'
                ],
                [
                    'field' => 'pendidikan_min',
                    'label' => 'Pendidikan Minimum',
                    'rules' => 'required|max_length[10]|callback_pendidikan_check'
                ],
                [
                    'field' => 'pengalaman_min',
                    'label' => 'Pengalaman Minimum (Thn)',
                    'rules' => 'required|integer|greater_than_equal_to[1]'
                ],
                [
                    'field' => 'deskripsi_pekerjaan',
                    'label' => 'Deskripsi Pekerjaan',
                    'rules' => 'required|max_length[1024]'
                ],
                [
                    'field' => 'alasan',
                    'label' => 'Alasan',
                    'rules' => 'required|max_length[512]'
                ]
            ];

            $this->form_validation->set_rules($rules);

            if ($this->form_validation->run())
            {
                $data = [
                    'user_id' => $user_id,
                    'nama_pemohon' => $this->input->post('nama_pemohon'),
                    'jabatan_pemohon' => $this->input->post('jabatan_pemohon'),
                    'lokasi' => $this->input->post('lokasi'),
                    'jabatan' => $this->input->post('jabatan'),
                    'jumlah_kebutuhan' => $this->input->post('jumlah_kebutuhan'),
                    'usia_min' => $this->input->post('usia_min'),
                    'usia_max' => $this->input->post('usia_max'),
                    'pendidikan_min' => $this->input->post('pendidikan_min'),
                    'pengalaman_min' => $this->input->post('pengalaman_min'),
                    'deskripsi_pekerjaan' => $this->input->post('deskripsi_pekerjaan'),
                    'alasan' => $this->input->post('alasan'),
                    'status' => 'divisi_submit'
                ];

                $inserted = $this->db->insert('fpk', $data);

                if ($inserted)
                {
                    $this->session->set_flashdata('message_success', 'Formulir Permintaan Karyawan berhasil ditambahkan');
                    redirect('dashboard/divisi/fpk');
                }
                else
                {
                    $this->data['error'] = 'Formulir Permintaan Karyawan tidak berhasil ditambahkan';
                }
            }
        }

        $this->data['arr_tingkat_pendidikan'] = $this->get_arr_tingkat_pendidikan();
        $this->data['arr_status'] = $this->get_arr_status();
        $this->data['content'] = 'dashboard/divisi/fpk_add';
		$this->load->view('dashboard/index', $this->data);
    }

    public function edit()
    {
        $user_id = $this->session->userdata('app_user');
        $fpk_id = $this->input->get('fpk_id');

        $q = $this->db->where('user_id', $user_id)
                ->where('fpk_id', $fpk_id)
                ->where('status', 'divisi_submit')
                ->limit(1)
                ->get('fpk');

        if ( ! $q->num_rows())
        {
            $this->session->set_flashdata('message_error', 'Formulir Permintaan Karyawan tidak ditemukan');
            redirect('dashboard/divisi/fpk');
        }

        $this->data['fpk'] = $q->row();

        $this->load->library('form_validation');

        if ($this->input->method() === 'post')
        {
            $rules = [
                [
                    'field' => 'nama_pemohon',
                    'label' => 'Nama Pemohon',
                    'rules' => 'required|max_length[100]'
                ],
                [
                    'field' => 'jabatan_pemohon',
                    'label' => 'Jabatan Pemohon',
                    'rules' => 'required|max_length[50]'
                ],
                [
                    'field' => 'lokasi',
                    'label' => 'Lokasi',
                    'rules' => 'required|max_length[255]'
                ],
                [
                    'field' => 'jabatan',
                    'label' => 'Jabatan Yang Dibutuhkan',
                    'rules' => 'required|max_length[50]'
                ],
                [
                    'field' => 'jumlah_kebutuhan',
                    'label' => 'Jumlah Kebutuhan (Orang)',
                    'rules' => 'required|integer|greater_than_equal_to[1]'
                ],
                [
                    'field' => 'usia_min',
                    'label' => 'Usia Minimum (Thn)',
                    'rules' => 'required|integer|greater_than_equal_to[1]'
                ],
                [
                    'field' => 'usia_max',
                    'label' => 'Usia Maksimum (Thn)',
                    'rules' => 'required|integer|greater_than_equal_to[1]|callback_usia_max_check'
                ],
                [
                    'field' => 'pendidikan_min',
                    'label' => 'Pendidikan Minimum',
                    'rules' => 'required|max_length[10]|callback_pendidikan_check'
                ],
                [
                    'field' => 'pengalaman_min',
                    'label' => 'Pengalaman Minimum (Thn)',
                    'rules' => 'required|integer|greater_than_equal_to[1]'
                ],
                [
                    'field' => 'deskripsi_pekerjaan',
                    'label' => 'Deskripsi Pekerjaan',
                    'rules' => 'required|max_length[1024]'
                ],
                [
                    'field' => 'alasan',
                    'label' => 'Alasan',
                    'rules' => 'required|max_length[512]'
                ]
            ];

            $this->form_validation->set_rules($rules);

            if ($this->form_validation->run())
            {
                $data = [
                    'nama_pemohon' => $this->input->post('nama_pemohon'),
                    'jabatan_pemohon' => $this->input->post('jabatan_pemohon'),
                    'lokasi' => $this->input->post('lokasi'),
                    'jabatan' => $this->input->post('jabatan'),
                    'jumlah_kebutuhan' => $this->input->post('jumlah_kebutuhan'),
                    'usia_min' => $this->input->post('usia_min'),
                    'usia_max' => $this->input->post('usia_max'),
                    'pendidikan_min' => $this->input->post('pendidikan_min'),
                    'pengalaman_min' => $this->input->post('pengalaman_min'),
                    'deskripsi_pekerjaan' => $this->input->post('deskripsi_pekerjaan'),
                    'alasan' => $this->input->post('alasan')
                ];

                $updated = $this->db->where('fpk_id', $fpk_id)
                    ->where('status', 'divisi_submit')
                    ->limit(1)
                    ->update('fpk', $data);

                if ($updated)
                {
                    $this->session->set_flashdata('message_success', 'Formulir Permintaan Karyawan berhasil diubah');
                    redirect('dashboard/divisi/fpk');
                }
                else
                {
                    $this->data['error'] = 'Formulir Permintaan Karyawan tidak berhasil diubah';
                }
            }
        }

        if ($this->input->method() === 'post')
        {
            $this->data['content'] = 'dashboard/divisi/fpk_update';
        }
        else
        {
            $this->data['content'] = 'dashboard/divisi/fpk_edit';
        }

        $this->data['arr_tingkat_pendidikan'] = $this->get_arr_tingkat_pendidikan();
        $this->data['arr_status'] = $this->get_arr_status();
		$this->load->view('dashboard/index', $this->data);
    }

    public function pendidikan_check($str)
    {
        if ( ! in_array($str, array_keys($this->get_arr_tingkat_pendidikan())))
        {
            $this->form_validation->set_message('pendidikan_check', 'Tingkat Pendidikan tidak valid');
            return false;
        }

        return true;
    }

    public function usia_max_check($str)
    {
        $usia_min = (int) $this->input->post('usia_min');
        $usia_max = (int) $str;

        if ($usia_min > $usia_max)
        {
            $this->form_validation->set_message('usia_max_check', 'Usia maximum harus >= usia minimum');
            return false;
        }

        return true;
    }

    protected function get_arr_tingkat_pendidikan()
    {
        $this->load->model('fpk_model');
        return $this->fpk_model->get_arr_tingkat_pendidikan();
    }

    protected function get_arr_status()
    {
        $this->load->model('fpk_model');
        return $this->fpk_model->get_arr_status();
    }

}
