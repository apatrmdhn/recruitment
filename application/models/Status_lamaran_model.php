<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Status_lamaran_model extends CI_Model
{
    public function get_arr_status()
    {
        return [
            'pelamar_submit' => 'Menunggu Direview',
            'interview' => 'Menunggu Interview',
            'approved' => 'Diterima',
            'rejected' => 'Ditolak'
        ];
    }
}
