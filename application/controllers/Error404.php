<?php

class Error404 extends CI_Controller 
{
    public function __construct() 
    {
        parent::__construct(); 
    } 

    public function index() 
    { 
        $this->output->set_status_header('404'); 
        $data['title'] = 'Page not found'; // View title
        $this->load->view('templates/header', $data);
        $this->load->view('error_404',$data);//loading in my template 
    } 
} 