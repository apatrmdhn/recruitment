<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Front extends Auth_controller
{
    public function index()
    {
        $this->data['content'] = 'dashboard/front';
        $this->load->view('dashboard/index', $this->data);
    }
}
