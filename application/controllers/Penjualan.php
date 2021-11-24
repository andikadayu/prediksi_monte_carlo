<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualan extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('M_basic', 'mp');        
    }    

    public function index()
    {
        $data['data'] = $this->mp->getData('penjualan')->result();
        $this->load->view('template/header');
        $this->load->view('penjualan/index', $data);
        $this->load->view('template/footer');
    }

    public function addPenjualan()
    {
        $data['barang'] = $this->mp->getData('barang')->result();
        $this->load->view('template/header');
        $this->load->view('penjualan/add_penjualan',$data);
        $this->load->view('template/footer');
    }

    public function CreatePenjualan()
    {
       $data = array(
           'id_barang' => $this->input->post('Barang'), 
           'jumlah' => $this->input->post('Jumlah'), 
           'tanggal' => $this->input->post('tanggal'), 
        );

        $this->mp->ins('penjualan',$data);
		$this->session->set_flashdata('msg', 'Data berhasil ditambahkan !');
        redirect('Penjualan','refresh');
    }
    
    public function EditPenjualan($id)
    {
        $w = array('id' => $id);
        $data['data'] = $this->mp->getData('penjualan',$w)->row();
        $data['barang'] = $this->mp->getData('barang')->result();

        $this->load->view('template/header');
        $this->load->view('penjualan/edit_penjualan', $data);
        $this->load->view('template/footer');
    }

    public function UpdatePenjualan()
    {
        $data = array(
            'id_barang' => $this->input->post('Barang'), 
            'jumlah' => $this->input->post('Jumlah'), 
            'tanggal' => $this->input->post('tanggal'), 
        );

        $w = array('penjualan.id' => $this->input->post('id'));

        $this->mp->upd('penjualan',$data, $w);
		$this->session->set_flashdata('msg', 'Data berhasil diupdate !');
        redirect('Penjualan','refresh');
    }

    public function DeletePenjualan($id)
    {
        $w = array('id' => $id);
        $this->mp->del('penjualan',$w);
		$this->session->set_flashdata('del', 'Data berhasil dihapus !');
        redirect('Penjualan','refresh');
    }

}

/* End of file Penjualan.php */
