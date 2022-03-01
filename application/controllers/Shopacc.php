<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Shopacc extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        //To use site_url and redirect on this controller.
        $this->load->helper('url');
        $this->load->model('shop_model');
        $this->load->library('session');

    }


    public function index()
    {
        $this->load->library('facebook');

        $user = $this->facebook->getUser();

        if ($user) {
            try {
                if (!$this->session->userdata("user_profile")) $this->session->set_userdata("user_profile", ['email' => 'admin@gmail.com', 'id' => 1231234, 'name' => 'Le vinh Loc']);
                $data['user_profile'] = $this->session->userdata("user_profile");
            } catch (FacebookApiException $e) {
                $user = null;
            }
        } else {
            // Solves first time login issue. (Issue: #10)
            //$this->facebook->destroySession();
        }

        if ($user) {
            $emaila = "";
            $datadb = $data['user_profile'];
            if (isset($datadb['email'])) $emaila = $datadb['email'];
            $getuserif = $this->shop_model->checkUser($datadb['id'], $emaila, $datadb['name']);
            $data['money'] = $getuserif[0]['cash'];
            if ($getuserif[0]['trangthai'] == 0) $data['admin'] = true;
            $data['logout_url'] = site_url('shopacc/logout'); // Logs off application
            // OR
            // Logs off FB!
            // $data['logout_url'] = $this->facebook->getLogoutUrl();

        } else {
            $data['login_url'] = site_url();
        }
        $lmht = ['loainick' => 'LMHT', 'trangthai' => 'on'];

        $data['querylmht'] = $this->db->where($lmht)->order_by("id", "desc")->get("baidang");
        $data['lmht'] = $this->db->where($lmht)->count_all_results("baidang");

        $cf = ['loainick' => 'CF', 'trangthai' => 'on'];

        $data['querycf'] = $this->db->where($cf)->order_by('id','desc')->get("baidang");
        $data['cf'] = $this->db->where($cf)->count_all_results("baidang");

        $data['user'] = $this->db->count_all('nguoidung');

        $data['memonline'] = $this->shop_model->getAmungStats("fa3k1r2sr3fg");
        $data['useronline'] = $this->shop_model->getAmungStats("dmrfqe4prez6");

        //load view
        $this->load->view('shop_view',$data);
    }
}