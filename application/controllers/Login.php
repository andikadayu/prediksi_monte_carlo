<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("M_basic", "logins");
    }

    public function index()
    {
        if ($this->session->has_userdata('log')) {
            redirect("Stock");
        } else {
            $this->load->view('login');
        }
    }

    public function Proses()
    {
        $email = $this->input->post("email");
        $password = $this->input->post("password");

        $log = $this->logins->login($email, $password)->result();
        $status  = $log[0]->jumlah;
        if ($status == 1) {
            $this->session->set_userdata('log', true);
            $this->session->set_userdata('email', $email);
            redirect("Stock");
        } else {
            redirect("Login");
        }
    }

    public function Logout()
    {
        $this->session->unset_userdata('log');
        $this->session->unset_userdata('email');
        redirect("Login");
    }
}
