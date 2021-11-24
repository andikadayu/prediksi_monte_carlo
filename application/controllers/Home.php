<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('M_basic', 'mp');
    }

    public function index()
    {
        // $data['data'] = $this->mp->dashboard()->result_array();
        // $data['maks'] = $this->mp->max()->result();
        // $data['avg'] = $this->mp->avg()->row() ;
        // $data['dataa'] = $this->mp->dashboardd()->result_array();
        // $this->load->view('template/header');
        // $this->load->view('index', $data);
        // $this->load->view('template/footer');
        redirect('login');
    }

    // public function addPenjualan()
    // {
    //     $data['barang'] = $this->mp->getData('barang')->result();
    //     $this->load->view('template/header');
    //     $this->load->view('add_penjualan', $data);
    //     $this->load->view('template/footer');
    // }

    // public function CreatePenjualan()
    // {
    //    $data = array(
    //        'barang' => $this->input->post('Barang'), 
    //        'jumlah' => $this->input->post('Jumlah'), 
    //        'tanggal' => $this->input->post('tanggal'), 
    //     );

    //     $this->mp->ins('penjualan',$data);

    //     redirect('Home','refresh');
    // }

    // public function EditPenjualan($id)
    // {
    //     $w = array('id' => $id);
    //     $data['data'] = $this->mp->getData('penjualan',$w)->row();
    //     $data['barang'] = $this->mp->getData('barang')->result();

    //     $this->load->view('template/header');
    //     $this->load->view('edit_penjualan', $data);
    //     $this->load->view('template/footer');
    // }

    // public function UpdatePenjualan($id)
    // {
    //     $data = array(
    //         'barang' => $this->input->post('barang'), 
    //         'jumlah' => $this->input->post('jumlah'), 
    //         'tanggal' => $this->input->post('tanggal'), 
    //     );

    //     $w = array('id' => $id);

    //     $this->mp->upd($data, $w);

    //     redirect('Home','refresh');
    // }

    // public function DeletePenjualan($id)
    // {
    //     $w = array('id' => $id);
    //     $this->mp->del('penjualan',$w);

    //     redirect('Home','refresh');
    // }

}

/* End of file Home.php */
