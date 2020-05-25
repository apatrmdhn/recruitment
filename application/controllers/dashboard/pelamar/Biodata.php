<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Biodata extends Auth_controller
{
    public function __construct()
    {
        parent::__construct();

        $this->data['title'] = 'Pelamar &gt; Biodata';

        if ($this->data['hak_akses'] !== $this->user_model::HAK_AKSES_PELAMAR)
        {
            $this->session->set_flashdata('message_error', 'Hak akses anda bukan Pelamar');
            redirect('dashboard/front');
        }
    }

    public function index()
	{
        $q = $this->db->where('user_id', $this->session->userdata('app_user'))
                ->limit(1)
                ->get('biodata');

		$this->data['content'] = 'dashboard/pelamar/biodata_index';
        $this->data['biodata'] = $q->row();
		$this->load->view('dashboard/index', $this->data);
	}

    public function edit()
    {
        $user_id = $this->session->userdata('app_user');
        $q = $this->db->where('user_id', $user_id)->limit(1)->get('biodata');
        $this->data['biodata'] = $q->row();

        $this->load->library('form_validation');

        if ($this->input->method() === 'post')
        {
            $rules = [
                [
                    'field' => 'nama',
                    'label' => 'Nama',
                    'rules' => 'required|max_length[100]'
                ],
                [
                    'field' => 'tempat_lahir',
                    'label' => 'Tempat Lahir',
                    'rules' => 'required|max_length[100]'
                ],
                [
                    'field' => 'tanggal_lahir',
                    'label' => 'Tanggal Lahir',
                    'rules' => 'required|callback_tanggal_lahir_check'
                ],
                [
                    'field' => 'agama',
                    'label' => 'Agama',
                    'rules' => 'required|in_list[Islam,Kristen,Hindu,Budha,Katholik,Kepercayaan]'
                ],
                [
                    'field' => 'jenis_kelamin',
                    'label' => 'Jenis Kelamin',
                    'rules' => 'required|in_list[P,W]'
                ],
                [
                    'field' => 'alamat',
                    'label' => 'Alamat',
                    'rules' => 'required|max_length[255]'
                ],
                [
                    'field' => 'no_hp',
                    'label' => 'No HP',
                    'rules' => 'required|numeric|max_length[15]'
                ],
                [
                    'field' => 'email',
                    'label' => 'Email',
                    'rules' => 'required|valid_email|callback_email_check'
                ],
                [
                    'field' => 'jabatan1',
                    'label' => 'Jabatan Yang Diinginkan #1',
                    'rules' => 'max_length[100]'
                ],
                [
                    'field' => 'jabatan2',
                    'label' => 'Jabatan Yang Diinginkan #2',
                    'rules' => 'max_length[100]'
                ],
                [
                    'field' => 'jabatan3',
                    'label' => 'Jabatan Yang Diinginkan #3',
                    'rules' => 'max_length[100]'
                ],
                [
                    'field' => 'ekspetasi_gaji',
                    'label' => 'Ekspetasi Gaji (Rp)',
                    'rules' => 'required|integer'
                ]
            ];

            $this->form_validation->set_rules($rules);

            if ($this->form_validation->run())
            {
                $data = [
                    'nama' => $this->input->post('nama'),
                    'tempat_lahir' => $this->input->post('tempat_lahir'),
                    'tanggal_lahir' => $this->input->post('tanggal_lahir'),
                    'agama' => $this->input->post('agama'),
                    'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                    'alamat' => $this->input->post('alamat'),
                    'no_hp' => $this->input->post('no_hp'),
                    'email' => $this->input->post('email'),
                    'jabatan1' => $this->input->post('jabatan1'),
                    'jabatan2' => $this->input->post('jabatan2'),
                    'jabatan3' => $this->input->post('jabatan3'),
                    'ekspetasi_gaji' => $this->input->post('ekspetasi_gaji')
                ];

                $has_upload_error = false;

                if ($_FILES['foto']['name'])
                {
                    $foto = $this->do_upload_foto();

                    if ( ! $foto)
                    {
                        $has_upload_error = true;
                    }
                    else
                    {
                        $data['foto'] = $foto['file_name'];
                    }
                }

                if ($_FILES['cv']['name'])
                {
                    $cv = $this->do_upload_cv();

                    if ( ! $cv)
                    {
                        $has_upload_error = true;
                    }
                    else
                    {
                        $data['cv'] = $cv['file_name'];
                    }
                }

                $updated = $this->db->where('user_id', $user_id)->update('biodata', $data);

                if ($updated && ! $has_upload_error)
                {
                    $this->session->set_flashdata('message_success', 'Biodata berhasil diupdate');
                    redirect('dashboard/pelamar/biodata');
                }

                if ( ! $has_upload_error)
                {
                    $this->data['error'] = 'Biodata tidak berhasil diupdate';
                }
            }
        }

        if ($this->input->method() === 'post')
        {
            $this->data['content'] = 'dashboard/pelamar/biodata_update';
        }
        else
        {
            $this->data['content'] = 'dashboard/pelamar/biodata_edit';
        }

        $this->data['arr_agama'] = $this->get_arr_agama();
        $this->data['arr_jenis_kelamin'] = $this->get_arr_jenis_kelamin();
        $this->load->view('dashboard/index', $this->data);
    }

    public function email_check($str)
    {
        $user_id = $this->session->userdata('app_user');
        $q = $this->db->where('user_id !=', $user_id)
                ->where('email', $str)
                ->limit(1)
                ->get('user');
        if ($q->num_rows())
        {
            $this->form_validation->set_message('email_check', 'Email ini sudah ada yang memiliki');
            return false;
        }

        return true;
    }

    public function tanggal_lahir_check($str)
    {
        if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$str)) {
            return true;
        }

        $this->form_validation->set_message('tanggal_lahir_check', 'Format tanggal salah');
        return false;
    }

    protected function do_upload_foto()
    {
        $config['upload_path']      = './storage/fotos/';
        $config['allowed_types']    = 'jpg|jpeg|png';
        $config['max_size']         = 1024;
        $config['max_width']        = 1024;
        $config['max_height']       = 768;
        $config['encrypt_name']     = true;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('foto'))
        {
            $this->data['error'] = $this->upload->display_errors();
            return null;
        }
        else
        {
            return $this->upload->data();
        }
    }

    protected function do_upload_cv()
    {
        $config['upload_path']      = './storage/cv/';
        $config['allowed_types']    = 'pdf';
        $config['max_size']         = 4096;
        $config['encrypt_name']     = true;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('cv'))
        {
            $this->data['error'] = $this->upload->display_errors();
            return null;
        }
        else
        {
            return $this->upload->data();
        }
    }

    protected function get_arr_agama()
    {
        $this->load->model('biodata_model');
        return $this->biodata_model->get_arr_agama();
    }

    protected function get_arr_jenis_kelamin()
    {
        $this->load->model('biodata_model');
        return $this->biodata_model->get_arr_jenis_kelamin();
    }

}
