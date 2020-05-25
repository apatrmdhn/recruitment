<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Riwayat_pendidikan_model extends CI_Model
{
    public function get_arr_tingkat_pendidikan()
    {
        return [
            'SD' => 'SD',
            'SMP' => 'SMP/SLTP',
            'SMA' => 'SMA/SMU/SLTA/SMK',
            'D3' => 'D3',
            'S1' => 'S1',
            'S2' => 'S2'
        ];
    }
}
