<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class barang extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('M_basic', 'barang');
    }
    

    public function index()
    {
        $data['data'] = $this->barang->getData('barang')->result();
        $this->load->view('template/header');
        $this->load->view('barang/index', $data);
        $this->load->view('template/footer');
    }

    public function addBarang()
    {
        $this->load->view('template/header');
        $this->load->view('barang/add_barang');
        $this->load->view('template/footer');
    }

    public function CreateBarang()
    {
       $data = array(
           'barang' => $this->input->post('Barang'), 
           'harga' => $this->input->post('harga'), 
        );

        $this->barang->ins('barang',$data);
        $this->session->set_flashdata('msg', 'Data berhasil ditambahkan !');
        redirect('Barang','refresh');
    }
    
    public function EditBarang($id)
    {
        $w = array('id_brg' => $id);
        $data['data'] = $this->barang->getData('barang',$w)->row();
        $this->load->view('template/header');
        $this->load->view('barang/edit_barang', $data);
        $this->load->view('template/footer');
    }

    public function UpdateBarang()
    {
        $data = array(
            'barang' => $this->input->post('Barang'), 
			'harga' => $this->input->post('harga'), 
        );

        $w = array('id_brg' => $this->input->post('id'));

        $this->barang->upd('barang',$data, $w);
		$this->session->set_flashdata('msg', 'Data berhasil diupdate !');
        redirect('Barang','refresh');
    }

    public function DeleteBarang($id)
    {
        $w = array('id_brg' => $id);
        $this->barang->del('barang',$w);
		$this->session->set_flashdata('del', 'Data berhasil dihapus !');
        redirect('Barang','refresh');
    }

}

/* End of file barang.php */
