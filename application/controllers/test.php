<?php
class test extends CI_Controller
{
    function index(){
        $data = [];
        $this->load->view('test',$data);
    }
}