<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Fpk_model extends CI_Model
{
    public function get_arr_tingkat_pendidikan()
    {
        $this->load->model('riwayat_pendidikan_model');
        return $this->riwayat_pendidikan_model->get_arr_tingkat_pendidikan();
    }

    public function get_arr_status()
    {
        return [
            'divisi_submit' => 'Antrian HRD',
            'hrd_approve' => 'Antrian Dirut',
            'hrd_reject' => 'Ditolak HRD',
            'dirut_approve' => 'Disetujui Direktur Utama',
            'dirut_reject' => 'Ditolak Direktur Utama'
        ];
    }
}
