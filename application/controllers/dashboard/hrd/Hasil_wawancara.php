<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Hasil_wawancara extends Auth_controller
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
                ->order_by('status_lamaran.status_lamaran_id', 'desc')
                ->get();
        $this->data['lamaran'] = $q->num_rows() ? $q->result() : [];
        $this->data['arr_status_lamaran'] = $this->get_arr_status_lamaran();
		$this->data['content'] = 'dashboard/hrd/hasil_wawancara_index';
		$this->load->view('dashboard/index', $this->data);
	}

    public function approve()
    {
        $status_lamaran_id = $this->input->get('status_lamaran_id');

        $q = $this->db->where('status_lamaran_id', $status_lamaran_id)
                ->where('status', 'interview')
                ->limit(1)
                ->get('status_lamaran');

        if ( ! $q->num_rows())
        {
            $this->session->set_flashdata('message_error', 'Hasil wawancara tidak ditemukan');
            redirect('dashboard/hrd/hasil_wawancara');
        }

        $updated = $this->db->where('status_lamaran_id', $status_lamaran_id)
                        ->update('status_lamaran', ['status' => 'approved']);

        if ($updated)
        {
            $this->session->set_flashdata('message_success', 'Hasil wawancara berhasil disetujui');
        }
        else
        {
            $this->session->set_flashdata('message_error', 'Hasil wawancara tidak berhasil disetujui');
        }

        redirect('dashboard/hrd/hasil_wawancara');
    }

    public function reject()
    {
        $status_lamaran_id = $this->input->get('status_lamaran_id');

        $q = $this->db->where('status_lamaran_id', $status_lamaran_id)
                ->where_in('status', ['pelamar_submit', 'interview'])
                ->limit(1)
                ->get('status_lamaran');

        if ( ! $q->num_rows())
        {
            $this->session->set_flashdata('message_error', 'Hasil wawancara tidak ditemukan');
            redirect('dashboard/hrd/hasil_wawancara');
        }

        $updated = $this->db->where('status_lamaran_id', $status_lamaran_id)
                        ->update('status_lamaran', ['status' => 'rejected']);

        if ($updated)
        {
            $this->session->set_flashdata('message_success', 'Hasil wawancara berhasil ditolak');
        }
        else
        {
            $this->session->set_flashdata('message_error', 'Hasil wawancara tidak berhasil ditolak');
        }

        redirect('dashboard/hrd/hasil_wawancara');
    }

    public function interview()
    {
        $status_lamaran_id = $this->input->get('status_lamaran_id');

        $q = $this->db->where('status_lamaran_id', $status_lamaran_id)
                ->where_in('status', 'pelamar_submit')
                ->limit(1)
                ->get('status_lamaran');

        if ( ! $q->num_rows())
        {
            $this->session->set_flashdata('message_error', 'Hasil wawancara tidak ditemukan');
            redirect('dashboard/hrd/hasil_wawancara');
        }

        $updated = $this->db->where('status_lamaran_id', $status_lamaran_id)
                        ->update('status_lamaran', ['status' => 'interview']);

        if ($updated)
        {
            $this->session->set_flashdata('message_success', 'Melakukan proses wawancara');
        }
        else
        {
            $this->session->set_flashdata('message_error', 'Hasil wawancara tidak berhasil ditolak');
        }

        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'alfathramadhan42@gmail.com',
            'smtp_pass' => '02140915525a',
            'mailtype' => 'html',
            'charset' => 'iso-8859-1'
        );

        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from('alfathramadhan42@gmail.com', 'HRD SIS');
        $this->email->to('alfathrmdhn4@gmail.com');
        $this->email->subject('Panggilan Interview');
        $this->email->message('Berhubungan dengan lamaran yang telah kami terima, kami mengundang calon kandidat yang bersedia hadir untuk interview');

        if (!$this->email->send()) {
            show_error($this->email->print_debugger());
        } else {
        redirect('dashboard/hrd/hasil_wawancara');
        }
    }

    public function biodata_detail()
    {
        $biodata_id = $this->input->get('biodata_id');
        $q = $this->db->where('biodata_id', $biodata_id)
            ->limit(1)
            ->get('biodata');

        if ( ! $q->num_rows())
        {
            $this->session->set_flashdata('message_error', 'Biodata tidak ditemukan');
            redirect('dashboard/hrd/hasil_wawancara');
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

        $this->data['content'] = 'dashboard/hrd/hasil_wawancara_biodata';
		$this->load->view('dashboard/index', $this->data);
    }

    protected function get_arr_status_lamaran()
    {
        $this->load->model('status_lamaran_model');
        return $this->status_lamaran_model->get_arr_status();
    }

}
