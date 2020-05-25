<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class Produk extends CI_Controller
{
	public function hrms()
	{
        $data['is_login'] = $this->session->userdata('app_user') ? true : false;
		$data['content'] = 'produk/v_hrms';
		$this->load->view('index', $data);
	}

	public function vireo()
	{
        $data['is_login'] = $this->session->userdata('app_user') ? true : false;
		$data['content'] = 'produk/v_vireo';
		$this->load->view('index', $data);
	}

	public function cms()
	{
        $data['is_login'] = $this->session->userdata('app_user') ? true : false;
		$data['content'] = 'produk/v_cms';
		$this->load->view('index', $data);
	}

	public function wms()
	{
        $data['is_login'] = $this->session->userdata('app_user') ? true : false;
		$data['content'] = 'produk/v_wms';
		$this->load->view('index', $data);
	}

	public function parking()
	{
        $data['is_login'] = $this->session->userdata('app_user') ? true : false;
		$data['content'] = 'produk/v_parking';
		$this->load->view('index', $data);
	}

	public function vms()
	{
        $data['is_login'] = $this->session->userdata('app_user') ? true : false;
		$data['content'] = 'produk/v_vms';
		$this->load->view('index', $data);
	}

	public function sfa()
	{
        $data['is_login'] = $this->session->userdata('app_user') ? true : false;
		$data['content'] = 'produk/v_sfa';
		$this->load->view('index', $data);
	}

	public function dms()
	{
        $data['is_login'] = $this->session->userdata('app_user') ? true : false;
		$data['content'] = 'produk/v_dms';
		$this->load->view('index', $data);
	}
}
