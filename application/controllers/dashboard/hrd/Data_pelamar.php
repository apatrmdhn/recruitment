<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Data_pelamar extends Auth_controller
{
    public function __construct()
    {
        parent::__construct();

        $this->data['title'] = 'Divisi &gt; FPK';

        if ($this->data['hak_akses'] !== $this->user_model::HAK_AKSES_HRD)
        {
            $this->session->set_flashdata('message_error', 'Hak akses anda bukan HRD');
            redirect('dashboard/front');
        }
    }

    public function index()
	{
        $q = $this->db->order_by('biodata_id', 'desc')
            ->get('biodata');
        $this->data['biodata'] = $q->num_rows() ? $q->result() : [];
		$this->data['content'] = 'dashboard/hrd/data_pelamar_index';
		$this->load->view('dashboard/index', $this->data);
	}

    public function detail()
    {
        $biodata_id = $this->input->get('biodata_id');
        $q = $this->db->where('biodata_id', $biodata_id)
            ->limit(1)
            ->get('biodata');

        if ( ! $q->num_rows())
        {
            $this->session->set_flashdata('message_error', 'Biodata tidak ditemukan');
            redirect('dashboard/hrd/data_pelamar');
        }

        $this->data['biodata'] = $q->row();
        $auser_id = $this->data['biodata']->user_id;

        $q = $this->db->where('user_id', $auser_id)
                ->get('riwayat_pendidikan');

        $this->data['riwayat'] = $q->num_rows() ? $q->result() : [];

        $q = $this->db->where('user_id', $auser_id)
                ->get('pengalaman_kerja');

        $this->data['pengalaman'] = $q->num_rows() ? $q->result() : [];

        $q = $this->db->where('user_id', $auser_id)
                ->get('pelatihan');

        $this->data['pelatihan'] = $q->num_rows() ? $q->result() : [];

        $q = $this->db->where('user_id', $auser_id)
                ->get('bahasa');

        $this->data['bahasa'] = $q->num_rows() ? $q->result() : [];

        $q = $this->db->where('user_id', $auser_id)
                ->get('keahlian');

        $this->data['keahlian'] = $q->num_rows() ? $q->result() : [];

        $this->data['content'] = 'dashboard/hrd/biodata_index';
		$this->load->view('dashboard/index', $this->data);
    }
}
