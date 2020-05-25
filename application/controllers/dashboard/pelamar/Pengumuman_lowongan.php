<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pengumuman_lowongan extends Auth_controller
{
    public function __construct()
    {
        parent::__construct();

        $this->data['title'] = 'Pelamar &gt; Lowongan';

        if ($this->data['hak_akses'] !== $this->user_model::HAK_AKSES_PELAMAR)
        {
            $this->session->set_flashdata('message_error', 'Hak akses anda bukan Pelamar');
            redirect('dashboard/front');
        }
    }

    public function index()
	{
        $user_id = $this->session->userdata('app_user');
        $q = $this->db
                ->select('
                    status_lamaran.status_lamaran_id as status_lamaran_id,
                    biodata.nama as nama_pelamar,
                    biodata.email as email_pelamar,
                    fpk.jabatan as jabatan,
                    status_lamaran.status as status_lamaran,
                    biodata.biodata_id as biodata_id
                ')
                ->from('status_lamaran')
                ->join('biodata', 'biodata.user_id=status_lamaran.user_id')
                ->join('fpk', 'fpk.fpk_id=status_lamaran.fpk_id')
                ->where('status_lamaran.user_id', $user_id)
                ->order_by('status_lamaran.status_lamaran_id', 'desc')
                ->get();
        $this->data['lamaran'] = $q->num_rows() ? $q->result() : [];
        $this->data['arr_status_lamaran'] = $this->get_arr_status_lamaran();
		$this->data['content'] = 'dashboard/pelamar/pengumuman_lowongan_index';
		$this->load->view('dashboard/index', $this->data);
	}

    protected function get_arr_status_lamaran()
    {
        $this->load->model('status_lamaran_model');
        return $this->status_lamaran_model->get_arr_status();
    }
}
