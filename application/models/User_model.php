<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{
    const HAK_AKSES_ADMIN = 'admin';
    const HAK_AKSES_DIRUT = 'dirut';
    const HAK_AKSES_HRD = 'hrd';
    const HAK_AKSES_DIVISI = 'divisi';
    const HAK_AKSES_PELAMAR = 'pelamar';

    public function get_hak_akses()
    {
        return [
            1 => self::HAK_AKSES_ADMIN,
            2 => self::HAK_AKSES_DIRUT,
            3 => self::HAK_AKSES_HRD,
            4 => self::HAK_AKSES_DIVISI,
            5 => self::HAK_AKSES_PELAMAR
        ];
    }

    public function login($username, $password)
    {
        $q = $this->db->where('username', $username)
                ->where('password', $password)
                ->limit(1)
                ->get('user');
        return $q->num_rows() ? $q->row() : false;
    }

    public function password_match($id, $password)
    {
        $q = $this->db->where('user_id', $id)
                ->where('password', $password)
                ->limit(1)
                ->get('user');

        return $q->num_rows() ? true : false;
    }

    public function getby_id($id)
    {
        $q = $this->db->where('user_id', $id)
                ->limit(1)
                ->get('user');
        return $q->num_rows() ? $q->row() : null;
    }

    public function insert(array $data)
    {
        $q = $this->db->insert('user', $data);
        return $q ? ((int) $this->db->insert_id()) : null;
    }

    public function update($id, array $data)
    {
        return $this->db->where('user_id', $id)->limit(1)->update('user', $data);
    }

    public function delete($id)
    {
        return $this->db->where('user_id', $id)->limit(1)->delete('user');
    }
}
