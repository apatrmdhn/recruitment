<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class Karir extends MY_Controller
{
	public function register()
	{
        $rules = [
            [
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'required|max_length[128]|valid_email|is_unique[user.email]'
            ],
            [
                'field' => 'password',
                'label' => 'Kata Sandi',
                'rules' => 'required|min_length[8]|max_length[50]'
            ],
            [
                'field' => 'password_confirm',
                'label' => 'Konfirmasi Kata Sandi',
                'rules' => 'matches[password]'
            ]
        ];

        $this->load->library('form_validation');
        $this->form_validation->set_rules($rules);

        if ($this->input->method() === 'post')
        {
            if ($this->form_validation->run())
            {
                $email = $this->input->post('email');
                $password = $this->input->post('password');
                $username = $email;
                $hak_akses = 5; //Hak Akses Pelamar

                $this->load->model('user_model');
                $user_id = $this->user_model->insert([
                    'email' => $email,
                    'username' => $username,
                    'password' => $password,
                    'hak_akses' => $hak_akses
                ]);

                if ($user_id)
                {
                    $q = $this->db->insert('biodata', [
                        'user_id' => $user_id,
                        'email' => $email
                    ]);

                    $this->session->set_flashdata('message_success', 'Registrasi Berhasil');
                    redirect('dashboard/login');
                }

                $data['error'] = 'Registrasi gagal';
            }
        }

        $data['is_login'] = $this->session->userdata('app_user') ? true : false;
        $data['content'] = 'v_register';
		$this->load->view('index', $data);
	}

	public function informasi()
	{
        $data['is_login'] = $this->session->userdata('app_user') ? true : false;
		$data['content'] = 'karir/v_informasi';
		$this->load->view('index', $data);
	}

    public function lowongan()
	{
        $user_id = $this->session->userdata('app_user');
        $this->data['is_login'] = $user_id ? true : false;
        $this->data['is_pelamar'] = false;
        if ($user_id)
        {
            $this->load->model('user_model');
            $user = $this->user_model->getby_id($user_id);
            $this->data['is_pelamar'] = $this->user_model->get_hak_akses()[$user->hak_akses] === $this->user_model::HAK_AKSES_PELAMAR;
        }
        $q = $this->db->where('status', 'dirut_approve')
                ->order_by('fpk_id', 'desc')
                ->get('fpk');
        $this->data['lowongan'] = $q->num_rows() ? $q->result() : [];
        $this->data['lowongan_content'] = 'karir/lowongan_index';
		$this->data['content'] = 'karir/v_lowongan';
		$this->load->view('index', $this->data);
	}

    public function lowongan_detail()
    {
        $fpk_id = $this->input->get('fpk_id');

        $q = $this->db->where('fpk_id', $fpk_id)
                ->where('status', 'dirut_approve')
                ->limit(1)
                ->get('fpk');

        if ( ! $q->num_rows())
        {
            $this->session->set_flashdata('message_error', 'Lowongan tidak ditemukan');
            redirect('karir/lowongan');
        }

        $user_id = $this->session->userdata('app_user');
        $this->data['is_login'] = $user_id ? true : false;
        $this->data['is_pelamar'] = false;
        if ($user_id)
        {
            $this->load->model('user_model');
            $user = $this->user_model->getby_id($user_id);
            $this->data['is_pelamar'] = $this->user_model->get_hak_akses()[$user->hak_akses] === $this->user_model::HAK_AKSES_PELAMAR;
        }

        $this->data['lowongan'] = $q->row();
        $this->data['arr_tingkat_pendidikan'] = $this->get_arr_tingkat_pendidikan();
        $this->data['arr_status'] = $this->get_arr_status();
        $this->data['content'] = 'karir/lowongan_detail';
        $this->load->view('index', $this->data);
    }

	public function panduan()
	{
        $data['is_login'] = $this->session->userdata('app_user') ? true : false;
		$data['content'] = 'karir/v_panduan';
		$this->load->view('index', $data);
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
