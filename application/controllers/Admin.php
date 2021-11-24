<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("M_all", "stock");
    }

    public function index()
    {
        if ($this->session->has_userdata('log')) {
            $all = $this->getAll();

            $data = array(
                'login' => $all
            );
            $judul = array('judul' => 'Kelola Admin');
            $this->load->view('template/nHeader', $judul);
            $this->load->view('admin/index', $data);
            $this->load->view('template/nFooter');
            $this->load->view('template/endFooter');
        } else {
            redirect("Login");
        }
    }

    public function getAll()
    {
        $temp = $this->stock->getData("login", "*")->result();
        return $temp;
    }

    public function Insert()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $data = array(
            "email" => $email,
            "password" => $password
        );

        $this->stock->ins("login", $data);
        redirect("Admin");
    }

    public function Update()
    {
        $iduser = $this->input->post('iduser');
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $data = array(
            "email" => $email,
            "password" => $password
        );

        $where = array(
            'iduser' => $iduser
        );

        $this->stock->upd("login", $data, $where);
        redirect("Admin");
    }

    public function Delete()
    {
        $iduser = $this->input->post('iduser');
        $where = array(
            'iduser' => $iduser
        );

        $this->stock->del("login", $where);
        redirect("Admin");
    }
}
