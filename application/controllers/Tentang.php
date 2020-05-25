<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class Tentang extends CI_Controller
{

	public function index()
	{
        $data['is_login'] = $this->session->userdata('app_user') ? true : false;
		$data['content'] = 'v_tentang';
		$this->load->view('index', $data);
	}
}
