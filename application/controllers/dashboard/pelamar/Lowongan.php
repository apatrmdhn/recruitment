<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Lowongan extends Auth_controller
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
        $q = $this->db->where('status', 'dirut_approve')
                ->order_by('fpk_id', 'desc')
                ->get('fpk');
        $this->data['lowongan'] = $q->num_rows() ? $q->result() : [];
		$this->data['content'] = 'dashboard/pelamar/lowongan_index';
		$this->load->view('dashboard/index', $this->data);
	}

    public function detail()
    {
        $fpk_id = $this->input->get('fpk_id');

        $q = $this->db->where('fpk_id', $fpk_id)
                ->where('status', 'dirut_approve')
                ->limit(1)
                ->get('fpk');

        if ( ! $q->num_rows())
        {
            $this->session->set_flashdata('message_error', 'Lowongan tidak ditemukan');
            redirect('dashboard/pelamar/lowongan');
        }

        $this->data['lowongan'] = $q->row();
        $this->data['arr_tingkat_pendidikan'] = $this->get_arr_tingkat_pendidikan();
        $this->data['arr_status'] = $this->get_arr_status();
        $this->data['content'] = 'dashboard/pelamar/lowongan_detail';
        $this->load->view('dashboard/index', $this->data);
    }

    public function submit()
    {
        $fpk_id = $this->input->get('fpk_id');

        $q = $this->db->where('fpk_id', $fpk_id)
                ->where('status', 'dirut_approve')
                ->limit(1)
                ->get('fpk');

        if ( ! $q->num_rows())
        {
            $this->session->set_flashdata('message_error', 'Lowongan tidak ditemukan');
            redirect('dashboard/pelamar/lowongan');
        }

        $user_id = $this->session->userdata('app_user');

        $q = $this->db->where('user_id', $user_id)
                ->where('fpk_id', $fpk_id)
                ->limit(1)
                ->get('status_lamaran');

        if ($q->num_rows())
        {
            $this->session->set_flashdata('message_error', 'Anda sudah pernah mengajukan lamaran ini');
            redirect('dashboard/pelamar/lowongan');
        }

        $lamar = $this->db->insert('status_lamaran', [
            'fpk_id' => $fpk_id,
            'user_id' => $user_id,
            'status' => 'pelamar_submit'
        ]);

        if ($lamar)
        {
            $this->session->set_flashdata('message_success', 'Lamaran berhasil dikirimkan');
        }
        else
        {
            $this->session->set_flashdata('message_error', 'Lamaran tidak berhasil dikirimkan');
        }

        redirect('dashboard/pelamar/lowongan');
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

    protected function get_arra_status_lamaran()
    {
        $this->load->model('status_lamaran_model');
        return $this->status_lamaran_model->get_arr_status();
    }
}
