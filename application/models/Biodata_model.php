<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Biodata_model extends CI_Model
{
    public function get_arr_agama()
    {
        return [
            'Islam' => 'Islam',
            'Kristen' => 'Kristen',
            'Hindu' => 'Hindu',
            'Budha' => 'Budha',
            'Katholik' => 'Katholik',
            'Kepercayaan' => 'Kepercayaan'
        ];
    }

    public function get_arr_jenis_kelamin()
    {
        return [
            'P' => 'Pria',
            'W' => 'Wanita'
        ];
    }
}
