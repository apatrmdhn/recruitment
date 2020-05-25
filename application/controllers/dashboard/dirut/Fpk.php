<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Fpk extends Auth_controller
{
    public function __construct()
    {
        parent::__construct();

        $this->data['title'] = 'Divisi &gt; FPK';

        if ($this->data['hak_akses'] !== $this->user_model::HAK_AKSES_DIRUT)
        {
            $this->session->set_flashdata('message_error', 'Hak akses anda bukan Dirut');
            redirect('dashboard/front');
        }
    }

    public function index()
	{
        $q = $this->db->where_in('status', ['hrd_approve', 'dirut_approve', 'dirut_reject'])
            ->order_by('fpk_id', 'desc')
            ->get('fpk');
        $this->data['fpk'] = $q->num_rows() ? $q->result() : [];
		$this->data['content'] = 'dashboard/dirut/fpk_index';
        $this->data['arr_tingkat_pendidikan'] = $this->get_arr_tingkat_pendidikan();
        $this->data['arr_status'] = $this->get_arr_status();
		$this->load->view('dashboard/index', $this->data);
	}

    public function detail()
    {
        $fpk_id = $this->input->get('fpk_id');

        $q = $this->db->where('fpk_id', $fpk_id)
                ->limit(1)
                ->get('fpk');

        $arr_status = $this->get_arr_status();

        if ( ! $q->num_rows())
        {
            $this->session->set_flashdata('message_error', 'Formulir Permintaan Karyawan tidak ditemukan atau status bukan '.$arr_status['divisi_submit']);
            redirect('dashboard/dirut/fpk');
        }

        $this->data['fpk'] = $q->row();
        $this->data['arr_tingkat_pendidikan'] = $this->get_arr_tingkat_pendidikan();
        $this->data['arr_status'] = $this->get_arr_status();
        $this->data['content'] = 'dashboard/dirut/fpk_detail';
        $this->load->view('dashboard/index', $this->data);
    }

    public function approve()
    {
        $fpk_id = $this->input->get('fpk_id');

        $q = $this->db->where('fpk_id', $fpk_id)
                ->where('status', 'hrd_approve')
                ->limit(1)
                ->get('fpk');

        $arr_status = $this->get_arr_status();

        if ( ! $q->num_rows())
        {
            $this->session->set_flashdata('message_error', 'Formulir Permintaan Karyawan tidak ditemukan atau status bukan '.$arr_status['hrd_approve']);
            redirect('dashboard/dirut/fpk');
        }

        $updated = $this->db->where('fpk_id', $fpk_id)
                ->limit(1)
                ->update('fpk', ['status' => 'dirut_approve']);

        if ($updated)
        {
            $this->session->set_flashdata('message_success', 'Formulir Permintaan Karyawan berhasil disetujui');
        }
        else
        {
            $this->session->set_flashdata('message_error', 'Formulir Permintaan Karyawan tidak berhasil disetujui');
        }

        redirect('dashboard/dirut/fpk');
    }

    public function reject()
    {
        $fpk_id = $this->input->get('fpk_id');

        $q = $this->db->where('fpk_id', $fpk_id)
                ->where('status', 'hrd_approve')
                ->limit(1)
                ->get('fpk');

        $arr_status = $this->get_arr_status();

        if ( ! $q->num_rows())
        {
            $this->session->set_flashdata('message_error', 'Formulir Permintaan Karyawan tidak ditemukan atau status bukan '.$arr_status['hrd_approve']);
            redirect('dashboard/dirut/fpk');
        }

        $updated = $this->db->where('fpk_id', $fpk_id)
                ->limit(1)
                ->update('fpk', ['status' => 'dirut_reject']);

        if ($updated)
        {
            $this->session->set_flashdata('message_success', 'Formulir Permintaan Karyawan berhasil ditolak');
        }
        else
        {
            $this->session->set_flashdata('message_error', 'Formulir Permintaan Karyawan tidak berhasil ditolak');
        }

        redirect('dashboard/dirut/fpk');
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
