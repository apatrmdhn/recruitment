<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class Home extends CI_Controller
{

	public function index()
	{
        $data['is_login'] = $this->session->userdata('app_user') ? true : false;
		$data['content'] = 'v_home';
		$this->load->view('index', $data);
	}
}
